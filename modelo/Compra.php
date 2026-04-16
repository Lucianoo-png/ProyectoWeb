<?php
class Compra {
    private $foliocompra;
    private $rfc_empleado;
    private $rfc_proveedor;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function setFolio($f) { $this->foliocompra = $f; }
    public function setRfcEmpleado($e) { $this->rfc_empleado = $e; }
    public function setRfcProveedor($p) { $this->rfc_proveedor = $p; }

    public function buscar($tabla, $opciones = []) {
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        $limit = $opciones['limit'] ?? '';
        
        $query = 'SELECT '.$select.' FROM '.$tabla.'';
        if ($join != '') $query .= ' '. $join;
        if ($where != '') $query .= ' WHERE ' . $where;
        if ($orderBy != '') $query .= ' ORDER BY ' . $orderBy;
        if ($limit != '') $query .=' LIMIT '.$limit;
        
        return $this->conexion->ejecutarConsulta($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarCompraCompleta($productos, $folio_solicitud) {
        $this->conexion->comenzarTransaccion();
        $queryC = 'INSERT INTO "Veracruz".compra (fechayhora, rfc_empleado, rfc_proveedor) 
                VALUES (:fyh, :emp, :prov) RETURNING foliocompra';
        
        $paramsC = [
            ":fyh" => date('Y-m-d H:i:s'),
            ":emp" => $this->rfc_empleado,
            ":prov" => $this->rfc_proveedor
        ];
        
        $resC = $this->conexion->ejecutarConsulta($queryC, $paramsC);
        if(!$resC){
            $this->conexion->cancelarTransaccion();
            return false;
        }
        $fetchC = $resC->fetch(PDO::FETCH_ASSOC);
        $idCompra = $fetchC['foliocompra'];

        if($idCompra) {
            $this->conexion->ejecutarConsulta(
            'UPDATE "Veracruz".solicitud_reabastecimiento SET foliocompra = ? WHERE folio_solicitud = ?',
                [$idCompra, $folio_solicitud]
            );
            foreach($productos as $id_prod => $cantidad) {
                if($cantidad > 0) {
                    $pData = $this->conexion->ejecutarConsulta('SELECT precio_compra, stockminimo, stock FROM "Veracruz".producto WHERE no_producto = ?', [$id_prod])->fetchAll();
                    $precio = $pData[0]['precio_compra'];
                    $stockActual = $pData[0]['stock'];
                    $stockMinimo = $pData[0]['stockminimo'];
                    $total = $precio * $cantidad;
                    $queryD = 'INSERT INTO "Veracruz".detallecompra (precio_compra, cantidad, total, foliocompra) 
                            VALUES (:pre, :cant, :tot, :fol) RETURNING folio_compra_detalle';
                    $paramsD = [
                        ":pre" => $precio,
                        ":cant" => $cantidad,
                        ":tot" => $total,
                        ":fol" => $idCompra
                    ];
                    $resD = $this->conexion->ejecutarConsulta($queryD, $paramsD);
                    if(!$resD){
                        $this->conexion->cancelarTransaccion();
                        return false;
                    }
                    $fetchD = $resD->fetchAll(PDO::FETCH_ASSOC);
                    $idDetalle = $fetchD[0]['folio_compra_detalle'];

                    $queryPDC = 'INSERT INTO "Veracruz".producto_detalle_compra (no_producto, folio_compra_detalle) 
                                VALUES (?, ?)';
                    $this->conexion->ejecutarConsulta($queryPDC, [$id_prod, $idDetalle]);

                    $nuevoStock = $stockActual + $cantidad;
                    $this->conexion->ejecutarConsulta('UPDATE "Veracruz".producto SET stock = ? WHERE no_producto = ?', [$nuevoStock, $id_prod]);

                    if($nuevoStock >= $stockMinimo) {
                        $this->conexion->ejecutarConsulta('UPDATE "Veracruz".producto SET estado = \'S\' WHERE no_producto = ?', [$id_prod]);
                    }
                }
            }
           $this->conexion->confirmarTransaccion();
            return true;
        }
        $this->conexion->cancelarTransaccion();
        return false;
    }

    public function actualizarEstado($folio, $estado) {
        $query = 'UPDATE "Veracruz".solicitud_reabastecimiento SET estado = :est WHERE folio_solicitud = :fol';
        return $this->conexion->ejecutarConsulta($query, [":est" => $estado, ":fol" => $folio]);
    }
}
?>