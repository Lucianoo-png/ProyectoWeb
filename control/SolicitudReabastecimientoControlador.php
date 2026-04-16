<?php
class SolicitudReabastecimientoControlador {
    private SolicitudReabastecimiento $soli;

    public function __construct() {
        $this->soli = new SolicitudReabastecimiento();
    }

    public function getSoli() { 
        return $this->soli; 
    }

    public function registrarSolicitud($datos, $rfc_admin, $log) {
        if (empty($datos['rfc_proveedor']) || empty($datos['productos_json'])) {
            return ["error", "Selecciona un proveedor y al menos un producto."];
        }

        $productosArray = json_decode($datos['productos_json'], true);

        if (!$productosArray || count($productosArray) === 0) {
            return ["error", "La lista de productos no es válida."];
        }

        $this->soli->setFolio(trim($datos['folio']));
        $this->soli->setRfcEmpleado($rfc_admin);
        $this->soli->setRfcProveedor(trim($datos['rfc_proveedor']));
        $this->soli->setObservaciones(trim($datos['nota'] ?? ''));

        $exito = $this->soli->insertarCompleto($productosArray);
        $prov = new EmpleadoControlador();
        $nombre = $prov->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"rfc='".$datos['rfc_proveedor']."'"]);
        if ($exito) {
            $log->registrarLog($rfc_admin, "Se generó solicitud a proveedor ".$nombre[0]['nombre']." ".$nombre[0]['apellidospama']." con folio: " . $datos['folio'], "C");
            return ["exito", "Solicitud enviada correctamente al proveedor."];
        } else {
            return ["error", "Error al procesar la solicitud en la base de datos."];
        }
    }

    public function obtenerDetalles($folio) {
        $resultado = $this->soli->buscar('"Veracruz".detalle_solicitud', [
            "join" => "d JOIN \"Veracruz\".producto p ON d.no_producto = p.no_producto",
            "select" => "p.nombre, p.precio_compra, d.cantidad_pedida, (p.precio_compra * d.cantidad_pedida) as subtotal",
            "where" => "d.folio_solicitud = :fol",
            "params" => [":fol" => $folio]
        ]);
        return $resultado;
    }

    public function obtenerHistorialCompletoVista() {
        return $this->soli->obtenerHistorial();
    }
}
?>