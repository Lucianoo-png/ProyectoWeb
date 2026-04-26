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

    public function registrarVentaWeb($productos, $id_direccion) {
        $this->conexion->comenzarTransaccion();
        try {
            $queryP = 'INSERT INTO "Veracruz".pedido (fechayhora, no_cliente, tipo_pago, total, pagado) 
                    VALUES (:fyh, :cli, :pag, :tot, :pagado) RETURNING no_referencia';
            $resP = $this->conexion->ejecutarConsulta($queryP, [
                ":fyh" => date('Y-m-d H:i:s'),
                ":cli" => $this->no_cliente,
                ":pag" => $this->tipo_pago,
                ":tot" => $this->total,
                ":pagado" => $this->pagado
            ]);
            $idPedido = $resP->fetch(PDO::FETCH_ASSOC)['no_referencia'];

           // 1. Insertar en "envio" incluyendo la dirección que seleccionó el cliente
            $queryE = 'INSERT INTO "Veracruz".envio (no_referencia, fechayhora, no_direccion) 
                    VALUES (?, ?, ?) RETURNING no_orden';

            // El $id_direccion es el que recibes por parámetro en la función
            $resE = $this->conexion->ejecutarConsulta($queryE, [$idPedido, date('Y-m-d H:i:s'), $id_direccion]);
            $idOrden = $resE->fetch(PDO::FETCH_ASSOC)['no_orden'];

            // 3. Insertar en "detalleenvio" (Estado 'P' de Pendiente)
            $queryDE = 'INSERT INTO "Veracruz".detalleenvio (estado, total, no_orden) VALUES (?, ?, ?)';
            $this->conexion->ejecutarConsulta($queryDE, ['P', $this->total, $idOrden]);
            foreach ($productos as $item) {
                // Insertar detallepedido
                $totalProd = ($item['precio'] * $item['cantidad']) * 1.16;
                $colorSeleccionado = $item['no_color'] ?? 'N/A';
                $queryD = 'INSERT INTO "Veracruz".detallepedido (no_referencia, cantidad, precio_venta, total, color) 
                        VALUES (?, ?, ?, ?, ?) RETURNING no_referencia_detalle';
                $resD = $this->conexion->ejecutarConsulta($queryD, [$idPedido, $item['cantidad'], $item['precio'], $totalProd, $colorSeleccionado]);
                $idDetalle = $resD->fetch(PDO::FETCH_ASSOC)['no_referencia_detalle'];

                // Relación producto_detalle_pedido
                $this->conexion->ejecutarConsulta('INSERT INTO "Veracruz".producto_detalle_pedido (no_producto, no_referencia_detalle) VALUES (?, ?)', 
                    [$item['sku'], $idDetalle]);
                    
                // 2. CONSULTAR STOCK Y MÍNIMO ANTES DE ACTUALIZAR
                    // Necesitamos el stockminimo para decidir si el estado pasa a 'B'
                    $prodInfo = $this->conexion->ejecutarConsulta(
                        'SELECT stock, stockminimo FROM "Veracruz".producto WHERE no_producto = ?', 
                        [$item['sku']]
                    )->fetch(PDO::FETCH_ASSOC);

                    $nuevoStock = $prodInfo['stock'] - $item['cantidad'];
                    $stockMinimo = $prodInfo['stockminimo'];

                    // 3. LÓGICA DE ESTADOS (Tu lógica de la venta física)
                    $nuevoEstado = 'S'; // Disponible / Suficiente
                    if ($nuevoStock <= 0) {
                        $nuevoEstado = 'A'; // Agotado
                    } elseif ($nuevoStock < $stockMinimo) {
                        $nuevoEstado = 'B'; // Bajo Stock
                    }

                   // 4. ACTUALIZAR PRODUCTO (Stock Físico, Reservado y Estado al mismo tiempo)
                    $this->conexion->ejecutarConsulta(
                        'UPDATE "Veracruz".producto 
                        SET stock = stock - ?, 
                            stock_reservado = stock_reservado - ?, 
                            estado = ? 
                        WHERE no_producto = ?', 
                        [
                            $item['cantidad'], 
                            $item['cantidad'], 
                            $nuevoEstado, 
                            $item['sku']
                        ]
                    );

                $this->conexion->ejecutarConsulta('DELETE FROM "Veracruz".carrito_reserva WHERE no_cliente = ? AND no_producto = ?', 
                    [$this->no_cliente, $item['sku']]);
            }

            $this->conexion->confirmarTransaccion();
            return $idPedido;
        } catch (Exception $e) {
            $this->conexion->cancelarTransaccion();
            return false;
        }
    }

   public function obtenerHistorialPorCliente($no_cliente) {
        $query = 'SELECT p.no_referencia, p.fechayhora, p.total as total_pedido, 
                        de.estado as estado_envio,
                        dp.cantidad, dp.precio_venta, dp.color,
                        prod.nombre, prod.imagen, prod.categoria
                FROM "Veracruz".pedido p
                JOIN "Veracruz".envio e ON p.no_referencia = e.no_referencia
                JOIN "Veracruz".detalleenvio de ON e.no_orden = de.no_orden
                JOIN "Veracruz".detallepedido dp ON p.no_referencia = dp.no_referencia
                JOIN "Veracruz".producto_detalle_pedido pdp ON dp.no_referencia_detalle = pdp.no_referencia_detalle
                JOIN "Veracruz".producto prod ON pdp.no_producto = prod.no_producto
                WHERE p.no_cliente = ?
                ORDER BY p.fechayhora DESC';

        $res = $this->conexion->ejecutarConsulta($query, [$no_cliente]);
        return $res->fetchAll(PDO::FETCH_ASSOC);
    }

   public function generarReporteVentasEmpleado($fFolio, $fDesde, $fHasta, $fCliente) {
    // Usamos comillas dobles externas para el query de PHP
    // Corregimos la comparación de fechas para evitar el cast de strings vacíos
    $query = "SELECT 
                p.no_referencia, 
                p.fechayhora, 
                p.tipo_pago, 
                p.total, 
                p.nombre_cliente, 
                p.no_cliente, 
                SUM(dp.cantidad) as total_articulos
              FROM \"Veracruz\".pedido p
              JOIN \"Veracruz\".detallepedido dp ON p.no_referencia = dp.no_referencia
              WHERE p.rfc = '{$_SESSION["RFC"]}'
              AND (p.no_referencia::text = '{$fFolio}' OR '{$fFolio}' = '')
              
              /* Cambiamos el orden: primero evaluamos si el string está vacío */
              AND ('{$fDesde}' = '' OR DATE(p.fechayhora) >= CAST(NULLIF('{$fDesde}', '') AS DATE))
              AND ('{$fHasta}' = '' OR DATE(p.fechayhora) <= CAST(NULLIF('{$fHasta}', '') AS DATE))
              
              AND (p.nombre_cliente ILIKE '%{$fCliente}%' OR '{$fCliente}' = '')
              GROUP BY p.no_referencia, p.fechayhora, p.tipo_pago, p.total, p.nombre_cliente, p.no_cliente
              ORDER BY p.fechayhora DESC";

    return $this->conexion->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerVentasAdminFiltradas($desde, $hasta, $vendedor, $pago, $cantMin, $cantMax, $precioMin, $precioMax) {
    $query = "SELECT 
                p.no_referencia, p.fechayhora, p.tipo_pago, p.total, 
                p.nombre_cliente, p.no_cliente, p.rfc,
                e.nombre AS vend_nombre, e.apellidospama AS vend_apellidos,
                SUM(dp.cantidad) as total_articulos
              FROM \"Veracruz\".pedido p
              JOIN \"Veracruz\".detallepedido dp ON p.no_referencia = dp.no_referencia
              LEFT JOIN \"Veracruz\".empleado e ON p.rfc = e.rfc
              WHERE p.rfc IS NOT NULL 
              
              AND ('{$desde}' = '' OR DATE(p.fechayhora) >= CAST(NULLIF('{$desde}', '') AS DATE))
              AND ('{$hasta}' = '' OR DATE(p.fechayhora) <= CAST(NULLIF('{$hasta}', '') AS DATE))
              AND ('{$vendedor}' = '' OR p.rfc = '{$vendedor}')
              AND ('{$pago}' = '' OR p.tipo_pago ILIKE '%{$pago}%')
              AND ('{$precioMin}' = '' OR p.total >= CAST(NULLIF('{$precioMin}', '') AS NUMERIC))
              AND ('{$precioMax}' = '' OR p.total <= CAST(NULLIF('{$precioMax}', '') AS NUMERIC))
              
              GROUP BY p.no_referencia, p.fechayhora, p.tipo_pago, p.total, p.nombre_cliente, p.no_cliente, p.rfc, e.nombre, e.apellidospama
              
              HAVING ('{$cantMin}' = '' OR SUM(dp.cantidad) >= CAST(NULLIF('{$cantMin}', '') AS INTEGER))
                 AND ('{$cantMax}' = '' OR SUM(dp.cantidad) <= CAST(NULLIF('{$cantMax}', '') AS INTEGER))
                 
              ORDER BY p.fechayhora DESC";

    return $this->conexion->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
}

public function obtenerPedidosAdminFiltradas($desde, $hasta, $cliente, $repartidor, $estado, $montoMin, $montoMax) {
    $query = "SELECT 
                p.no_referencia, p.fechayhora, p.tipo_pago, p.total, p.nombre_cliente, p.no_cliente, p.rfc,
                de.estado, de.no_orden_detalle,
                c.nombre AS cli_nombre, c.apellidospama AS cli_apellidos
              FROM \"Veracruz\".pedido p
              
              /* AQUÍ ESTÁ LA CORRECCIÓN: El puente correcto con la tabla envio */
              JOIN \"Veracruz\".envio env ON p.no_referencia = env.no_referencia
              JOIN \"Veracruz\".detalleenvio de ON env.no_orden = de.no_orden
              
              LEFT JOIN \"Veracruz\".cliente c ON p.no_cliente = c.no_cliente
              
              /* Regla estricta de venta en línea */
              WHERE (p.rfc IS NULL OR p.rfc = '') 
                AND p.no_cliente IS NOT NULL 
              
              AND ('{$desde}' = '' OR DATE(p.fechayhora) >= CAST(NULLIF('{$desde}', '') AS DATE))
              AND ('{$hasta}' = '' OR DATE(p.fechayhora) <= CAST(NULLIF('{$hasta}', '') AS DATE))
              AND ('{$cliente}' = '' OR p.no_cliente = CAST(NULLIF('{$cliente}', '') AS INTEGER))
              AND ('{$estado}' = '' OR de.estado = '{$estado}')
              AND ('{$montoMin}' = '' OR p.total >= CAST(NULLIF('{$montoMin}', '') AS NUMERIC))
              AND ('{$montoMax}' = '' OR p.total <= CAST(NULLIF('{$montoMax}', '') AS NUMERIC))
              
              ORDER BY p.fechayhora DESC";

    return $this->conexion->ejecutarConsulta($query)->fetchAll(PDO::FETCH_ASSOC);
}
}
?>