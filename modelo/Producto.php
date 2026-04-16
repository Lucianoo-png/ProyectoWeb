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

    

    public function buscar($tabla, $opciones = []) {
        $select = $opciones['select'] ?? '*';
        $join = $opciones['join'] ?? '';
        $where = $opciones['where'] ?? '';
        $group = $opciones['group'] ?? '';
        $orderBy = $opciones['order'] ?? '';
        $params = $opciones['params'] ?? [];
        $limit = $opciones['limit'] ?? '';
        
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

        if($limit !=''){
            $query .=' LIMIT '.$limit;
        }
        
        $resultado = $this->conexion->ejecutarConsulta($query, $params);
        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar() {
        $query = 'INSERT INTO "Veracruz".producto (nombre, "descripción", precio_venta, alto, ancho, imagen, manual, categoria, stock, stockminimo, estado, precio_compra, estatus) 
                  VALUES (:nom, :des, :pv, :alt, :anc, :img, :man, :cat, :stk, :stm, :estd, :pc, :ests) RETURNING no_producto';
        $params = [
            ":nom" => $this->nombre, ":des" => $this->descripcion, ":pv" => $this->precio_venta,
            ":alt" => $this->alto, ":anc" => $this->ancho, ":img" => $this->imagen,
            ":man" => $this->manual, ":cat" => $this->categoria, ":stk" => $this->stock,
            ":stm" => $this->stockminimo, ":estd" => $this->estado, ":pc" => $this->precio_compra,
            ":ests" => 'true'
        ];
        
        $stmt = $this->conexion->ejecutarConsulta($query, $params);
        if($stmt && $stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['no_producto'];
        }
        return false;
    }

    public function editar() {
        $query = 'UPDATE "Veracruz".producto SET nombre=:nom, "descripción"=:des, precio_venta=:pv, alto=:alt, ancho=:anc, 
                  imagen=COALESCE(:img, imagen), manual=COALESCE(:man, manual), categoria=:cat, stock=:stk, stockminimo=:stm,
                  estado=:estado, precio_compra=:pc WHERE no_producto=:id';
        $params = [
            ":nom" => $this->nombre, ":des" => $this->descripcion, ":pv" => $this->precio_venta,
            ":alt" => $this->alto, ":anc" => $this->ancho, ":img" => $this->imagen,
            ":man" => $this->manual, ":cat" => $this->categoria, ":stk" => $this->stock,
            ":stm" => $this->stockminimo, ":estado"=>$this->estado,":pc" => $this->precio_compra,
            ":id" => $this->no_producto
        ];
        return $this->conexion->ejecutarConsulta($query, $params)->rowCount() > 0;
    }

    public function eliminar($borrar) {
        $query = 'UPDATE "Veracruz".producto SET estatus=:est WHERE no_producto=:id';
        return $this->conexion->ejecutarConsulta($query, [":est" => $borrar?'false':'true', ":id" => $this->no_producto])->rowCount() > 0;
    }

    public function insertarColores($id_producto, $colores) {
        foreach($colores as $color) {
            $query = 'INSERT INTO "Veracruz".productocolor (no_producto, color) VALUES (:id, :color)';
            $this->conexion->ejecutarConsulta($query, [":id" => $id_producto, ":color" => $color]);
        }
        return true;
    }

    public function eliminarColores($id_producto) {
        $query = 'DELETE FROM "Veracruz".productocolor WHERE no_producto = :id';
        $this->conexion->ejecutarConsulta($query, [":id" => $id_producto]);
        return true;
    } 
    public function getNo_producto(){return $this->no_producto;}
    public function setNo_producto($no_producto){$this->no_producto = $no_producto;}
    public function getNombre(){return $this->nombre;} 
    public function setNombre($nombre){$this->nombre = $nombre;}
    public function getDescripcion(){return $this->descripcion;}
    public function setDescripcion($descripcion){$this->descripcion = $descripcion;}
    public function getPrecio_venta(){return $this->precio_venta;}
    public function setPrecio_venta($precio_venta){$this->precio_venta = $precio_venta;}
    public function getAlto(){return $this->alto;}
    public function setAlto($alto){$this->alto = $alto;}
    public function getAncho(){return $this->ancho;}
    public function setAncho($ancho){$this->ancho = $ancho;}
    public function getImagen(){return $this->imagen;}
    public function setImagen($imagen){$this->imagen = $imagen;}
    public function getManual(){return $this->manual;}
    public function setManual($manual){$this->manual = $manual;}
    public function getCategoria(){return $this->categoria;}
    public function setCategoria($categoria){$this->categoria = $categoria;}
    public function getStock(){return $this->stock;} 
    public function setStock($stock){$this->stock = $stock;}
    public function getStockminimo(){return $this->stockminimo;}
    public function setStockminimo($stockminimo){$this->stockminimo = $stockminimo;}
    public function getEstado(){return $this->estado;}
    public function setEstado($estado){$this->estado = $estado;}
    public function getPrecio_compra(){return $this->precio_compra;}
    public function setPrecio_compra($precio_compra){$this->precio_compra = $precio_compra;}
    public function getEstatus(){return $this->estatus;}
    public function setEstatus($estatus){$this->estatus = $estatus;}
}
?>