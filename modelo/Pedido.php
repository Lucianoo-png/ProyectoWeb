<?php
class Pedido {
    private $no_referencia;
    private $rfc;
    private $fechayhora;
    private $no_cliente;
    private $tipo_pago;
    private $nombre_cliente;
    private $total;
    private $pagado;
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function getNoReferencia() { return $this->no_referencia; }
    public function getRfc() { return $this->rfc; }
    public function getFechaYHora() { return $this->fechayhora; }
    public function getNoCliente() { return $this->no_cliente; }
    public function getTipoPago() { return $this->tipo_pago; }
    public function getNombre_cliente(){return $this->nombre_cliente;}
    public function getTotal(){return $this->total;}
    public function getPagado(){return $this->pagado;}
    public function setNoReferencia($n) { $this->no_referencia = $n; }
    public function setRfc($r) { $this->rfc = $r; }
    public function setFechaYHora($f) { $this->fechayhora = $f; }
    public function setNoCliente($c) { $this->no_cliente = $c; }
    public function setTipoPago($t) { $this->tipo_pago = $t; }
    public function setNombre_cliente($nombre_cliente){$this->nombre_cliente = $nombre_cliente;}
    public function setTotal($total){$this->total = $total;}
    public function setPagado($pagado){$this->pagado = $pagado;}

    public function buscar($tabla, $opciones = []) {
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        $limit = $opciones['limit'] ?? '';
        
        $query = 'SELECT '.$select.' FROM '.$tabla;
        if ($join != '') $query .= ' '. $join;
        if ($where != '') $query .= ' WHERE ' . $where;
        if ($orderBy != '') $query .= ' ORDER BY ' . $orderBy;
        if ($limit != '') $query .=' LIMIT '.$limit;
        
        return $this->conexion->ejecutarConsulta($query, $params)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function registrarVentaCompleta($productos, $tipo_pago) {
        $this->conexion->comenzarTransaccion();

        $queryC = 'INSERT INTO "Veracruz".pedido (rfc, fechayhora, no_cliente, tipo_pago, nombre_cliente, total, pagado) 
                   VALUES (:rfc, :fyh, :cli, :pag, :nocli, :total, :pagado) RETURNING no_referencia';
        
        $paramsC = [
            ":rfc" => $this->rfc,
            ":fyh" => date('Y-m-d H:i:s'),
            ":cli" => $this->no_cliente, 
            ":pag" => $tipo_pago,
            ":nocli"=>$this->nombre_cliente,
            ":total"=>$this->total,
            ":pagado"=>$this->pagado
        ];

        $resC = $this->conexion->ejecutarConsulta($queryC, $paramsC);
        if (!$resC) {
            $this->conexion->cancelarTransaccion();
            return false;
        }

        $fetchC = $resC->fetch(PDO::FETCH_ASSOC);
        $idPedido = $fetchC['no_referencia'];

        if ($idPedido) {
            foreach ($productos as $item) {
                $pData = $this->conexion->ejecutarConsulta(
                    'SELECT no_producto, stock, stockminimo FROM "Veracruz".producto WHERE no_producto = ?', 
                    [$item['id_producto']]
                )->fetchAll(PDO::FETCH_ASSOC);

                if (empty($pData)) {
                    $this->conexion->cancelarTransaccion();
                    return false;
                }

                $idProd = $pData[0]['no_producto'];
                $stockActual = $pData[0]['stock'];
                $stockMinimo = $pData[0]['stockminimo'];
                $cantidad = $item['qty'];
                $precioSinIva = $item['precio'];
                $subtotalProducto = $precioSinIva * $cantidad;
                $totalConIva = $subtotalProducto * 1.16;

                $queryD = 'INSERT INTO "Veracruz".detallepedido (no_referencia, cantidad, precio_venta, total) 
                           VALUES (:ref, :cant, :pre, :tot) RETURNING no_referencia_detalle';
                
                $paramsD = [
                    ":ref"  => $idPedido,
                    ":cant" => $cantidad,
                    ":pre"  => $precioSinIva,
                    ":tot"  => $totalConIva
                ];

                $resD = $this->conexion->ejecutarConsulta($queryD, $paramsD);
                if (!$resD) {
                    $this->conexion->cancelarTransaccion();
                    return false;
                }

                $fetchD = $resD->fetch(PDO::FETCH_ASSOC);
                $idDetalle = $fetchD['no_referencia_detalle'];

                $queryPDC = 'INSERT INTO "Veracruz".producto_detalle_pedido (no_producto, no_referencia_detalle) 
                             VALUES (?, ?)';
                $this->conexion->ejecutarConsulta($queryPDC, [$idProd, $idDetalle]);

                $nuevoStock = $stockActual - $cantidad;
                $this->conexion->ejecutarConsulta(
                    'UPDATE "Veracruz".producto SET stock = ? WHERE no_producto = ?', 
                    [$nuevoStock, $idProd]
                );

                $nuevoEstado = 'S';
                if ($nuevoStock <= 0) {
                    $nuevoEstado = 'A';
                } elseif ($nuevoStock < $stockMinimo) {
                    $nuevoEstado = 'B';
                }

                $this->conexion->ejecutarConsulta(
                    'UPDATE "Veracruz".producto SET estado = ? WHERE no_producto = ?', 
                    [$nuevoEstado, $idProd]
                );
            }
            $this->conexion->confirmarTransaccion();
            return $idPedido;
        }

        $this->conexion->cancelarTransaccion();
        return false;
    }

}
?>