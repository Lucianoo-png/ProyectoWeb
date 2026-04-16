<?php
class Reserva {
    private $conexion;

    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function reservarStock($no_producto, $cantidad, $sid) {
        $no_cliente = $_SESSION["NoCliente"] ?? null;
        $this->liberarReservasExpiradas();
        if ($cantidad <= 0) {
            $sqlCant = 'SELECT cantidad FROM "Veracruz".carrito_reserva WHERE no_producto = ? AND (no_cliente = ? OR session_id = ?)';
            $res = $this->conexion->ejecutarConsulta($sqlCant, [$no_producto, $no_cliente, $sid])->fetch(PDO::FETCH_ASSOC);
            
            if ($res) {
                $cantAnterior = (int)$res['cantidad'];
                $this->conexion->ejecutarConsulta('UPDATE "Veracruz".producto SET stock_reservado = stock_reservado - ? WHERE no_producto = ?', [$cantAnterior, $no_producto]);
                $this->conexion->ejecutarConsulta('DELETE FROM "Veracruz".carrito_reserva WHERE no_producto = ? AND (no_cliente = ? OR session_id = ?)', [$no_producto, $no_cliente, $sid]);
            }
            return true;
        }

        $expira = date('Y-m-d H:i:s', strtotime('+15 minutes'));
        $prod = $this->conexion->ejecutarConsulta('SELECT stock, stock_reservado FROM "Veracruz".producto WHERE no_producto = ?', [$no_producto])->fetch(PDO::FETCH_ASSOC);
        
        if (!$prod) return false;
        $resAnt = $this->conexion->ejecutarConsulta('SELECT cantidad FROM "Veracruz".carrito_reserva WHERE no_producto = ? AND (no_cliente = ? OR session_id = ?)', [$no_producto, $no_cliente, $sid])->fetch(PDO::FETCH_ASSOC);
        $stockTotal     = (int)$prod['stock'];
        $stockReservado = (int)$prod['stock_reservado'];
        $cantYaReservada = $resAnt ? (int)$resAnt['cantidad'] : 0;
        $cantidadNueva  = (int)$cantidad;
        $disponible = $stockTotal - ($stockReservado - $cantYaReservada);

        if ($cantidadNueva <= $disponible) {
            $diferencia = $cantidadNueva - $cantYaReservada;
            $this->conexion->ejecutarConsulta('DELETE FROM "Veracruz".carrito_reserva WHERE no_producto = ? AND (no_cliente = ? OR session_id = ?)', [$no_producto, $no_cliente, $sid]);
            
            $queryIns = 'INSERT INTO "Veracruz".carrito_reserva (session_id, no_producto, cantidad, expiracion, no_cliente) VALUES (?, ?, ?, ?, ?)';
            $this->conexion->ejecutarConsulta($queryIns, [$sid, $no_producto, $cantidadNueva, $expira, $no_cliente]);
            $this->conexion->ejecutarConsulta('UPDATE "Veracruz".producto SET stock_reservado = stock_reservado + ? WHERE no_producto = ?', [$diferencia, $no_producto]);
            
            return true;
        }

        return false;
    }

    public function liberarReservasExpiradas() {
        $querySel = 'SELECT no_producto, cantidad FROM "Veracruz".carrito_reserva WHERE expiracion < NOW()';
        $expirados = $this->conexion->ejecutarConsulta($querySel)->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($expirados as $res) {
            $queryDev = 'UPDATE "Veracruz".producto SET stock_reservado = stock_reservado - ? WHERE no_producto = ?';
            $this->conexion->ejecutarConsulta($queryDev, [$res['cantidad'], $res['no_producto']]);
        }
        
        $queryDel = 'DELETE FROM "Veracruz".carrito_reserva WHERE expiracion < NOW()';
        $this->conexion->ejecutarConsulta($queryDel);
    }

    public function obtenerItemsReservados($sid, $no_cliente) {
    $sql = 'SELECT 
                p.no_producto as sku, 
                p.nombre, 
                p.precio_venta as precio, 
                p.imagen, 
                r.cantidad,
                (p.stock - p.stock_reservado + r.cantidad) as stock_disponible,
                EXTRACT(EPOCH FROM (r.expiracion - NOW())) as segundos_restantes
            FROM "Veracruz".carrito_reserva r
            JOIN "Veracruz".producto p ON r.no_producto = p.no_producto
            WHERE r.no_cliente = ? OR r.session_id = ?
            ORDER BY r.expiracion DESC';
            return $this->conexion->ejecutarConsulta($sql, [$no_cliente, $sid])->fetchAll(PDO::FETCH_ASSOC);
    
    }
}