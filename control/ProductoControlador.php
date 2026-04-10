<?php 
class ProductoControlador {
    private Producto $producto;

    public function __construct() {
        $this->producto = new Producto();
    }

    public function getProducto() { return $this->producto; }

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
            return $ruta;
        }
        
        return null;
    }

    public function agregarProducto($datos, $files) {
        if (empty($datos['nombre']) || empty($datos['precio_venta']) || empty($datos['categoria'])) {
            return ["error", "Ingrese los campos que son obligatorios."];
        }

        $precio_compra = isset($datos['precio_compra']) && trim($datos['precio_compra']) !== '' ? floatval($datos['precio_compra']) : 0;
        $precio_venta = floatval($datos['precio_venta']);
        $stock = isset($datos['stock']) && trim($datos['stock']) !== '' ? intval($datos['stock']) : 0;
        $stock_minimo = isset($datos['stock_minimo']) && trim($datos['stock_minimo']) !== '' ? intval($datos['stock_minimo']) : 0;

        if ($precio_compra > 0 && $precio_venta <= $precio_compra) {
            return ["error", "El precio de venta debe ser mayor al precio de compra."];
        }

        if ($stock < $stock_minimo) {
            return ["error", "El stock inicial no puede ser menor al stock mínimo."];
        }

        $img = $this->subirArchivo($files['imagen'], 'img');
        if (!$img) return ["error", "La imagen del producto es obligatoria."];
        
        $manual = $this->subirArchivo($files['manual'], 'pdf');

        $this->producto->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->producto->setDescripcion(trim($datos['descripcion']));
        $this->producto->setPrecioVenta($precio_venta);
        $this->producto->setAlto($datos['alto'] ?? 0);
        $this->producto->setAncho($datos['ancho'] ?? 0);
        $this->producto->setCategoria($datos['categoria']);
        $this->producto->setStock($stock);
        $this->producto->setStockMinimo($stock_minimo);
        $this->producto->setPrecioCompra($precio_compra);
        $this->producto->setEstado('S');
        $this->producto->setImagen($img);
        $this->producto->setManual($manual);

        return $this->producto->insertar() ? ["exito", "Producto registrado correctamente."] : ["error", "Error al registrar el producto. Intente más tarde."];
    }

    public function editarProducto($datos, $files) {
        if (empty($datos['nombre']) || empty($datos['precio_venta']) || empty($datos['categoria'])) {
            return ["error", "Nombre, Precio de Venta y Categoría son obligatorios."];
        }
        $precio_compra = isset($datos['precio_compra']) && trim($datos['precio_compra']) !== '' ? floatval($datos['precio_compra']) : 0;
        $precio_venta = floatval($datos['precio_venta']);
        $stock = isset($datos['stock']) && trim($datos['stock']) !== '' ? intval($datos['stock']) : 0;
        $stock_minimo = isset($datos['stock_minimo']) && trim($datos['stock_minimo']) !== '' ? intval($datos['stock_minimo']) : 0;

        if ($precio_compra > 0 && $precio_venta <= $precio_compra) {
            return ["error", "El precio de venta debe ser mayor al precio de compra."];
        }

        if ($stock < $stock_minimo) {
            return ["error", "El stock actual no puede ser menor al stock mínimo."];
        }
        
        $this->producto->setNoProducto($datos['no_producto']);
        $this->producto->setNombre(trim(mb_strtoupper($datos['nombre'])));
        $this->producto->setDescripcion(trim($datos['descripcion']));
        $this->producto->setPrecioVenta($precio_venta);
        $this->producto->setAlto($datos['alto'] ?? 0);
        $this->producto->setAncho($datos['ancho'] ?? 0);
        $this->producto->setCategoria($datos['categoria']);
        $this->producto->setStock($stock);
        $this->producto->setStockMinimo($stock_minimo);
        $this->producto->setPrecioCompra($precio_compra);
        $this->producto->setEstado($datos['estado'] ?? 'N');
        
        $this->producto->setImagen($this->subirArchivo($files['imagen'], 'img'));
        $this->producto->setManual($this->subirArchivo($files['manual'], 'pdf'));

        return $this->producto->editar() ? ["exito", "Producto actualizado."] : ["info", "No hubo cambios."];
    }

    public function eliminarProducto($datos) {
        $this->producto->setNoProducto($datos['no_producto']);
        $this->producto->eliminar(true);
        return ["exito", "Producto dado de baja."];
    }

    public function activarProducto($datos) {
        $this->producto->setNoProducto($datos['no_producto']);
        $this->producto->eliminar(false);
        return ["exito", "Producto reactivado."];
    }
}
?>