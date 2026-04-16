<?php
class CompraControlador {
    private Compra $compra;

    public function __construct() {
        $this->compra = new Compra();
    }

     public function getCompra(){
        return $this->compra;
    }

    public function procesarRespuestaProveedor($datos, $rfc_prov, $log, $soliControl) {
        $folio_solicitud = $datos['folio_respuesta'];
        $nuevo_estado = $datos['nuevo_estado'];
        $cantidades = $datos['cantidades'] ?? [];

        if (empty($folio_solicitud)) {
            return ["error", "Folio de solicitud no válido."];
        }

        if ($nuevo_estado === 'cancelada') {
            $soliControl->getSoli()->actualizarEstado($folio_solicitud, "cancelada");
            
            $log->registrarLog($rfc_prov, "Proveedor rechazó solicitud de reabastecimiento: $folio_solicitud", "C");
            return ["exito", "Solicitud cancelada correctamente."];
        }

        if ($nuevo_estado === 'respondida') {
            $datosSoli = $soliControl->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento', [
                "where" => "folio_solicitud = :fol",
                "params" => [":fol" => $folio_solicitud]
            ]);

            $detallesOriginales = $soliControl->getSoli()->buscar('"Veracruz".detalle_solicitud', [
                "where" => "folio_solicitud = :fol",
                "params" => [":fol" => $folio_solicitud]
            ]);

            $mapaSolicitado = [];
            foreach ($detallesOriginales as $do) {
                $mapaSolicitado[$do['no_producto']] = $do['cantidad_pedida'];
            }

            $totalSuministrado = 0;
            foreach ($cantidades as $id_prod => $cant_enviada) {
                if (isset($mapaSolicitado[$id_prod])) {
                    if ($cant_enviada > $mapaSolicitado[$id_prod]) {
                        return ["error", "La cantidad enviada del producto con número: $id_prod excede lo solicitado."];
                    }
                    $totalSuministrado += $cant_enviada;
                }
            }

            $unidades_totales = array_sum($cantidades);
            if ($unidades_totales <= 0) {
                return ["error", "No puedes confirmar un suministro con 0 unidades. Si no tienes existencias, selecciona 'Rechazar Solicitud'."];
            }

            if (empty($datosSoli)) return ["error", "No se encontró la solicitud."];
            $this->compra->setRfcEmpleado($datosSoli[0]['rfc_empleado']);
            $this->compra->setRfcProveedor($rfc_prov);

            $exito = $this->compra->registrarCompraCompleta($cantidades, $folio_solicitud);
            if ($exito) {
                $soliControl->getSoli()->actualizarEstado($folio_solicitud, "respondida");
                
                $log->registrarLog($rfc_prov, "Suministro confirmado. Compra generada para el folio $folio_solicitud", "C");
                return ["exito", "Suministro procesado correctamente."];
            }
        }
        return ["error", "Ocurrió un error al procesar la respuesta."];
    }

}
?>