<?php
class SolicitudReabastecimiento {
    private $folio_solicitud;
    private $rfc_empleado;
    private $rfc_proveedor;
    private $observaciones;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function setFolio($f) { $this->folio_solicitud = $f; }
    public function setRfcEmpleado($e) { $this->rfc_empleado = $e; }
    public function setRfcProveedor($p) { $this->rfc_proveedor = $p; }
    public function setObservaciones($o) { $this->observaciones = $o; }

    public function buscar($tabla, $opciones = []) {
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $group = $opciones['group'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        $limit = $opciones['limit'] ?? '';
        
        $query = 'SELECT '.$select.' FROM '.$tabla.'';
        if ($join != '') { $query .= ' '. $join; }
        if ($where != '') { $query .= ' WHERE ' . $where; }
        if ($group != '') { $query .= ' GROUP BY ' . $group; }
        if ($orderBy != '') { $query .= ' ORDER BY ' . $orderBy; }
        if ($limit != '') { $query .=' LIMIT '.$limit; }
        
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertarCompleto($detalles) {
        $queryCabecera = 'INSERT INTO "Veracruz".solicitud_reabastecimiento 
                          (folio_solicitud, rfc_empleado, rfc_proveedor, observaciones, estado) 
                          VALUES (:fol, :emp, :prov, :obs, :est)';
        $paramsCabecera = [
            ":fol" => $this->folio_solicitud,
            ":emp" => $this->rfc_empleado,
            ":prov" => $this->rfc_proveedor,
            ":obs" => $this->observaciones,
            ":est" => 'enviada'
        ];
        
        $insertCab = $this->conexion->ejecutarConsulta($queryCabecera, $paramsCabecera);
        
        if ($insertCab) {
            $queryDetalle = 'INSERT INTO "Veracruz".detalle_solicitud 
                             (folio_solicitud, no_producto, cantidad_pedida) 
                             VALUES (:fol, :prod, :cant)';
            foreach ($detalles as $d) {
                $paramsDetalle = [
                    ":fol" => $this->folio_solicitud,
                    ":prod" => $d['id_producto'],
                    ":cant" => $d['cantidad']
                ];
                $this->conexion->ejecutarConsulta($queryDetalle, $paramsDetalle);
            }
            return true;
        }
        return false;
    }

    public function obtenerHistorial() {
        $query = "SELECT 
                    s.folio_solicitud, 
                    TO_CHAR(s.fecha_envio, 'DD/MM/YYYY HH24:MI') as fecha_formato,
                    s.estado,
                    s.observaciones,
                    (p.nombre || ' ' || p.apellidospama) as proveedor_nombre,
                    COUNT(d.no_producto) as total_productos,
                    SUM(d.cantidad_pedida * prod.precio_compra) as total_estimado
                  FROM \"Veracruz\".solicitud_reabastecimiento s
                  JOIN \"Veracruz\".empleado p ON s.rfc_proveedor = p.rfc
                  LEFT JOIN \"Veracruz\".detalle_solicitud d ON s.folio_solicitud = d.folio_solicitud
                  LEFT JOIN \"Veracruz\".producto prod ON d.no_producto = prod.no_producto
                  GROUP BY s.folio_solicitud, s.fecha_envio, s.estado, s.observaciones, p.nombre, p.apellidospama
                  ORDER BY s.fecha_envio DESC";
        return $this->conexion->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($folio, $edo){
        $query = 'UPDATE "Veracruz".solicitud_reabastecimiento SET estado=:estado WHERE folio_solicitud=:folio';
        $params = [
            ":estado"=>$edo,
            ":folio"=>$folio
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount()>0;
    }

    public function obtenerHistorialDetallado($rfc_proveedor) {
        $query = "SELECT 
            s.folio_solicitud, 
            TO_CHAR(s.fecha_envio, 'DD/MM/YYYY HH24:MI') as fecha_solicitud,
            TO_CHAR(c.fechayhora, 'DD/MM/YYYY HH24:MI') as fecha_respuesta,
            s.estado,
            s.observaciones,
            COUNT(DISTINCT ds.no_producto) as total_productos,
            COALESCE(SUM(dc.cantidad), 0) as unidades_suministradas
          FROM \"Veracruz\".solicitud_reabastecimiento s
          LEFT JOIN \"Veracruz\".compra c ON s.foliocompra = c.foliocompra
          LEFT JOIN \"Veracruz\".detalle_solicitud ds ON s.folio_solicitud = ds.folio_solicitud
          LEFT JOIN \"Veracruz\".detallecompra dc ON c.foliocompra = dc.foliocompra
          LEFT JOIN \"Veracruz\".producto_detalle_compra pdc ON dc.folio_compra_detalle = pdc.folio_compra_detalle 
               AND pdc.no_producto = ds.no_producto
          WHERE s.rfc_proveedor = :rfc
          GROUP BY s.folio_solicitud, s.fecha_envio, c.fechayhora, s.estado, s.observaciones
          ORDER BY s.fecha_envio DESC";

        return $this->conexion->ejecutarConsulta($query, [":rfc" => $rfc_proveedor])->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>