<?php

class PedidoControlador {
    private Pedido $pedido;

    public function __construct() {
        $this->pedido = new Pedido();
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function procesarVentaFisica($datos, $rfc_vendedor, $log) {
        $productos = json_decode($datos['items_json'] ?? '[]', true);
        $tipo_pago = $datos['pago'] ?? 'efectivo';
       $no_cliente = $datos['cliente']==''?null:$datos['cliente'];
        $nombre_cliente_log = !empty($datos['nombre_cliente_nuevo']) ? $datos['nombre_cliente_nuevo'] : 'Mostrador';

        if (empty($productos)) {
            return ["error", "No se han añadido productos a la venta."];
        }

        $this->pedido->setRfc($rfc_vendedor);
        $this->pedido->setNoCliente($no_cliente);
        $this->pedido->setTipoPago($tipo_pago);
        $this->pedido->getNoCliente()!=null?$this->pedido->setNombre_cliente(null):$this->pedido->setNombre_cliente($nombre_cliente_log);
        $total = 0;
        for($i = 0; $i < count($productos);$i++){
            $total+=$productos[$i]['precio'];
        }
        $total+=$total*0.16;
        if($tipo_pago=='tarjeta'){
            $this->pedido->setTotal($total);
            $this->pedido->setPagado($total);
        }
        else{
            $this->pedido->setTotal($total);
            $this->pedido->setPagado($datos['cantidad']);
        }
        $no_referencia = $this->pedido->registrarVentaCompleta($productos, $tipo_pago);

        if ($no_referencia) {
            $detalle_log = "Venta física registrada. Folio: $no_referencia. Cliente: $nombre_cliente_log";
            $log->registrarLog($rfc_vendedor, $detalle_log, "C"); 

            return ["exito", "Venta #$no_referencia registrada correctamente."];
        }

        $log->registrarLog($rfc_vendedor, "Error al intentar registrar venta física.", "E");
        return ["error", "Error al procesar la venta. Verifique el stock disponible."];
    }
}

?>