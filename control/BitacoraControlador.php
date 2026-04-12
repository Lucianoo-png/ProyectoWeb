<?php 
class BitacoraControlador {
    private Bitacora $bitacora;

    public function __construct() {
        $this->bitacora = new Bitacora();
    }

    public function getBitacora() { 
        return $this->bitacora; 
    }

    public function registrarLog($rfc, $descripcion, $estado = 'C') {
        $descripcion_limpia = trim($descripcion);
        if (empty($descripcion_limpia)) {
            return ["error", "La descripción del log es obligatoria."];
        }

        $estado_limpio = strtoupper(trim($estado));
        if ($estado_limpio !== 'C' && $estado_limpio !== 'E') {
            $estado_limpio = 'E';
            $descripcion_limpia = "[ESTADO INVÁLIDO ENVIADO] " . $descripcion_limpia;
        }

        $rfc_limpio = null;
        if (!empty($rfc)) {
            $rfc_trim = strtoupper(trim($rfc));
            if (strlen($rfc_trim) <= 13) {
                $rfc_limpio = $rfc_trim;
            } else {
                return ["error", "El RFC proporcionado excede los 13 caracteres."];
            }
        }

        $this->bitacora->setRfc($rfc_limpio);
        $this->bitacora->setDescripcion($descripcion_limpia);
        $this->bitacora->setEstado($estado_limpio);

        if ($this->bitacora->insertar()) {
            return ["exito", "Evento registrado en la bitácora."];
        } else {
            return ["error", "Error interno al intentar guardar la bitácora."];
        }
    }

    public function consultarLogs($estado = null, $rfc = null, $limite = 500) {
        $whereFilters = [];
        
        if ($estado === 'C' || $estado === 'E') {
            $whereFilters[] = "estado = '" . $estado . "'";
        }
        
        if (!empty($rfc)) {
            $whereFilters[] = "rfc = '" . strtoupper(trim($rfc)) . "'";
        }

        $whereClause = count($whereFilters) > 0 ? implode(" AND ", $whereFilters) : "";

        return $this->bitacora->buscar('"Veracruz".bitacora', [
            "where" => $whereClause,
            "order" => "fechayhora DESC",
            "limit" => $limite
        ]);
    }
}
?>