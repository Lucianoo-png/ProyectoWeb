<?php
class CarritoControlador {
    private $reserva;

    public function __construct() {
        $this->reserva = new Reserva();
    }

    public function accionReservar() {
        $no_producto = $_GET['sku'] ?? null;
        $cantidad    = $_GET['cantidad'] ?? 0;
        $sid         = session_id();
        
        $exito = $this->reserva->reservarStock($no_producto, $cantidad, $sid);

        if ($exito) {
            $this->responderConCarrito();
        } else {
            $this->enviarError("No hay suficiente stock disponible");
        }
    }

    public function accionObtenerCarrito() {
        $this->responderConCarrito();
    }

    public function responderConCarrito() {
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        $sid = session_id();
        $no_cliente = $_SESSION['NoCliente'] ?? null;
        
        $items = $this->reserva->obtenerItemsReservados($sid, $no_cliente);
        $items = $items ? $items : [];
        
        $segundos = (count($items) > 0) ? (int)$items[0]['segundos_restantes'] : 900;

        echo json_encode([
            "success" => true,
            "items" => $items,
            "segundos" => $segundos
        ]);
        exit;
    }

    private function enviarError($mensaje) {
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');
        echo json_encode(["success" => false, "message" => $mensaje]);
        exit;
    }
}