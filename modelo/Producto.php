<?php 
class Producto {
    private $no_producto;
    private $nombre;
    private $descripcion;
    private $precio_venta;
    private $alto;
    private $ancho;
    private $imagen;
    private $manual;
    private $categoria;
    private $stock;
    private $stockminimo;
    private $estado;
    private $precio_compra;
    private $estatus;
    private $conexion;
   
    public function __construct() {
        $this->conexion = new Conexion();
    }

    public function setNoProducto($id){ $this->no_producto = $id; }
    public function getNoProducto(){ return $this->no_producto; }
    public function setNombre($n){ $this->nombre = $n; }
    public function setDescripcion($d){ $this->descripcion = $d; }
    public function setPrecioVenta($p){ $this->precio_venta = $p; }
    public function setAlto($a){ $this->alto = $a; }
    public function setAncho($an){ $this->ancho = $an; }
    public function setImagen($i){ $this->imagen = $i; }
    public function setManual($m){ $this->manual = $m; }
    public function setCategoria($c){ $this->categoria = $c; }
    public function setStock($s){ $this->stock = $s; }
    public function setStockMinimo($sm){ $this->stockminimo = $sm; }
    public function setEstado($e){ $this->estado = $e; }
    public function setPrecioCompra($pc){ $this->precio_compra = $pc; }
    public function setEstatus($est){ $this->estatus = $est; }

    public function buscar($tabla, $opciones = []) {
        
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $group = $opciones['group'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        
        $query = 'SELECT '.$select.' FROM '.$tabla.'';

        if ($join != '') {
            $query .= ' '. $join;
        }

        if($where != ''){
            $query .= ' WHERE ' . $where;
        }

        if($group != ''){
            $query .= ' GROUP BY ' . $group;
        }

        if ($orderBy != '') {
            $query .= ' ORDER BY ' . $orderBy;
        }
        $resultado = $this->conexion->ejecutarConsulta($query, $params);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    
    }

    public function insertar() {
        $query = 'INSERT INTO "Veracruz".producto (nombre, descripción, precio_venta, alto, ancho, imagen, manual, categoria, stock, stockminimo, estado, precio_compra, estatus) 
                  VALUES (:nom, :des, :pv, :alt, :anc, :img, :man, :cat, :stk, :stm, :estd, :pc, :ests)';
        $params = [
            ":nom" => $this->nombre, ":des" => $this->descripcion, ":pv" => $this->precio_venta,
            ":alt" => $this->alto, ":anc" => $this->ancho, ":img" => $this->imagen,
            ":man" => $this->manual, ":cat" => $this->categoria, ":stk" => $this->stock,
            ":stm" => $this->stockminimo, ":estd" => $this->estado, ":pc" => $this->precio_compra,
            ":ests" => 'true'
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;
    }

    public function editar() {
        $query = 'UPDATE "Veracruz".producto SET nombre=:nom, "descripción"=:des, precio_venta=:pv, alto=:alt, ancho=:anc, 
                  imagen=COALESCE(:img, imagen), manual=COALESCE(:man, manual), categoria=:cat, stock=:stk, stockminimo=:stm, 
                  estado=:estd, precio_compra=:pc WHERE no_producto=:id';
        $params = [
            ":nom" => $this->nombre, ":des" => $this->descripcion, ":pv" => $this->precio_venta,
            ":alt" => $this->alto, ":anc" => $this->ancho, ":img" => $this->imagen,
            ":man" => $this->manual, ":cat" => $this->categoria, ":stk" => $this->stock,
            ":stm" => $this->stockminimo, ":estd" => $this->estado, ":pc" => $this->precio_compra,
            ":id" => $this->no_producto
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;
    }

    public function eliminar($borrar) {
        $query = 'UPDATE "Veracruz".producto SET estatus=:est WHERE no_producto=:id';
        return $this->conexion->ejecutarConsulta($query, [":est" => $borrar?'false':'true', ":id" => $this->no_producto])->rowCount() > 0;
    }
}