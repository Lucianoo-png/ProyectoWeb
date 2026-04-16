<?php 
class ProductoControlador {
    private Producto $producto;
    private BitacoraControlador $log;

    public function __construct() {
        $this->producto = new Producto();
        $this->log = new BitacoraControlador();
    }

    public function getProducto() { return $this->producto; }
    public function getBitacora(){return $this->log;}

    private function subirArchivo($file, $folder) {
        if (!isset($file) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $nombreFisico = uniqid('prod_') . '.' . $ext;
        $directorio = $_SERVER['DOCUMENT_ROOT'] . "/proyectoweb/public/uploads/$folder/";
        
        if (!file_exists($directorio)) {
            mkdir($directorio, 0777, true);
        }
        
        $ruta = $directorio . $nombreFisico;
        if (move_uploaded_file($file['tmp_name'], $ruta)) {
            return $nombreFisico;
        }
        
        return null;
    }

    public function agregarProducto($datos, $files) {
        if (empty($datos['nombre']) || empty($datos['precio_venta']) || empty($datos['categoria'])) {
            return ["error", "Ingrese los campos que son obligatorios."];
        }

        if (empty($datos['colores']) || !is_array($datos['colores'])) {
            return ["error", "Debe seleccionar al menos un color para el producto."];
        }
        $precio_compra = isset($datos['precio_compra']) && trim($datos['precio_compra']) !== '' ? floatval($datos['precio_compra']) : 0;
        $precio_venta = floatval($datos['precio_venta']);
        $stock = isset($datos['stock']) && trim($datos['stock']) !== '' ? intval($datos['stock']) : 0;
        $stock_minimo = isset($datos['stock_minimo']) && trim($datos['stock_minimo']) !== '' ? intval($datos['stock_minimo']) : 0;

        if ($precio_compra > 0 && $precio_venta <= $precio_compra) {
            return ["error", "El precio de venta debe ser mayor al precio de compra."];
        }

        if ($stock < $stock_minimo) {
            return ["error", "El stock inicial no puede ser menor al stock mínimo permitido."];
        }

        $img = $this->subirArchivo($files['imagen'], 'img');
        if (!$img) return ["error", "La imagen del producto es obligatoria."];
        
        $manual = $this->subirArchivo($files['manual'], 'pdf');

        $this->producto->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->producto->setDescripcion(trim($datos['descripcion']));
        $this->producto->setPrecio_venta($precio_venta);
        $this->producto->setAlto($datos['alto'] ?? 0);
        $this->producto->setAncho($datos['ancho'] ?? 0);
        $this->producto->setCategoria($datos['categoria']);
        $this->producto->setStock($stock);
        $this->producto->setStockMinimo($stock_minimo);
        $this->producto->setPrecio_compra($precio_compra);
        $this->producto->setEstado('S');
        $this->producto->setImagen($img);
        $this->producto->setManual($manual);

        $id_insertado = $this->producto->insertar();
        
        if ($id_insertado) {
            $this->producto->insertarColores($id_insertado, $datos['colores']);
            $this->log->registrarLog($_SESSION['RFC'], "Producto ".$this->producto->getNombre()." registrado exitosamente", "C");
            return ["exito", "Producto registrado correctamente."];
        } else {
            return ["error", "Error al registrar el producto. Intente más tarde."];
        }
    }

    public function editarProducto($datos, $files) {
        if (empty($datos['nombre']) || empty($datos['precio_venta']) || empty($datos['categoria'])) {
            return ["error", "Nombre, Precio de Venta y Categoría son obligatorios."];
        }

        if (empty($datos['colores']) || !is_array($datos['colores'])) {
            return ["error", "Debe seleccionar al menos un color para el producto."];
        }

        $precio_compra = isset($datos['precio_compra']) && trim($datos['precio_compra']) !== '' ? floatval($datos['precio_compra']) : 0;
        $precio_venta = floatval($datos['precio_venta']);
        $stock = isset($datos['stock']) && trim($datos['stock']) !== '' ? intval($datos['stock']) : 0;
        $stock_minimo = isset($datos['stock_minimo']) && trim($datos['stock_minimo']) !== '' ? intval($datos['stock_minimo']) : 0;

        if ($precio_compra > 0 && $precio_venta <= $precio_compra) {
            return ["error", "El precio de venta debe ser mayor al precio de compra."];
        }

        if ($stock < $stock_minimo) {
            $this->producto->setEstado('B');
            if($stock==0){
                $this->producto->setEstado('A');
            }
        }
        else if($stock >= $stock_minimo){
            $this->producto->setEstado('S');
        }

        
        $this->producto->setNo_producto($datos['no_producto']);
        $this->producto->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->producto->setDescripcion(trim($datos['descripcion']));
        $this->producto->setPrecio_venta($precio_venta);
        $this->producto->setAlto($datos['alto'] ?? 0);
        $this->producto->setAncho($datos['ancho'] ?? 0);
        $this->producto->setCategoria($datos['categoria']);
        $this->producto->setStock($stock);
        $this->producto->setStockMinimo($stock_minimo);
        $this->producto->setPrecio_compra($precio_compra);
        
        $this->producto->setImagen($this->subirArchivo($files['imagen'], 'img'));
        $this->producto->setManual($this->subirArchivo($files['manual'], 'pdf'));

        $this->producto->editar();
        
        $this->producto->eliminarColores($datos['no_producto']);
        $this->producto->insertarColores($datos['no_producto'], $datos['colores']);
         $this->log->registrarLog($_SESSION['RFC'], "Información del producto ".$this->producto->getNombre()." editada correctamente", "C");
        return ["exito", "Producto actualizado correctamente."];
    }

    public function eliminarProducto($datos) {
        $this->producto->setNo_producto($datos['no_producto']);
        $this->producto->eliminar(true);
        $nombre = $this->producto->buscar('"Veracruz".producto',["select"=>"nombre","where"=>"no_producto=".$this->producto->getNo_producto()])[0]['nombre'];
        $this->log->registrarLog($_SESSION['RFC'], "Producto ".$nombre." dado de baja", "C");
        return ["exito", "Producto dado de baja."];
    }

    public function activarProducto($datos) {
        $this->producto->setNo_producto($datos['no_producto']);
        $this->producto->eliminar(false);
        $nombre = $this->producto->buscar('"Veracruz".producto',["select"=>"nombre","where"=>"no_producto=".$this->producto->getNo_producto()])[0]['nombre'];
        $this->log->registrarLog($_SESSION['RFC'], "Producto ".$nombre." reactivado", "C");
        return ["exito", "Producto reactivado."];
    }
}
?>