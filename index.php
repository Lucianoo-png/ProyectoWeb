<?php 

ob_start();
date_default_timezone_set("America/Mexico_City");
session_start();


require('modelo/Conexion.php');


require('modelo/Empleado.php');
require('modelo/Producto.php');
require('modelo/Bitacora.php');
require('modelo/Cliente.php');
require('modelo/SolicitudReabastecimiento.php');
require('modelo/Compra.php');
require('modelo/Pedido.php');
require('modelo/Reserva.php');



require('control/EmpleadoControlador.php');
require('control/ProductoControlador.php');
require('control/BitacoraControlador.php');
require('control/ClienteControlador.php');
require('control/SolicitudReabastecimientoControlador.php');
require('control/CompraControlador.php');
require('control/PedidoControlador.php');
require('control/CarritoControlador.php');


require('enviar_correo.php');



require('helpers/Helpers.php');


if(isset($_GET["obtener_detalle"])){
    $soli = new SolicitudReabastecimientoControlador();
            header('Content-Type: application/json');
            echo json_encode($soli->obtenerDetalles($_GET['folio']));
            exit;
        }

if(!isset($_SESSION["NoCliente"])){
    header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
    header("Pragma: no-cache");
    header("Expires: 0");
}


if (isset($_GET['ajax'])) {
    $cli = new ClienteControlador();
    $datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
    $direcciones = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                header('Content-Type: application/json');
                echo json_encode([
                    "success" => true,
                    "nombre_cliente" => (count($datos_cli) > 0) ? $datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'] : 'Usuario',
                    "direcciones" => $direcciones
                ]);
                exit;
            }

if(isset($_GET["q"])){
     header('Content-Type: application/json');
            
            $termino = isset($_GET['q']) ? trim($_GET['q']) : '';
            
            if(strlen($termino) < 1) {
                echo json_encode([]);
                exit;
            }

            $productoControlador = new ProductoControlador();
            
            $productos = $productoControlador->getProducto()->buscar('"Veracruz".producto', [
                "select" => "no_producto, nombre, precio_venta",
                "where" => "nombre ILIKE '%$termino%' AND stock > 0",
                "limit" => "8"
            ]);

            echo json_encode($productos ?: []);
        exit;
}

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp<?php if(isset($_SESSION["RFC"])){echo " | ".$_SESSION["RFC"];}else if(isset($_SESSION["NoCliente"])){echo " | Mi Perfil";} ?></title>
    <link rel="icon" href="data:,">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="/proyectoweb/estilos/styles.css">
    <link rel="stylesheet" href="/proyectoweb/estilos/vendedor.css">
    <link rel="stylesheet" href="/proyectoweb/estilos/proveedor.css">
    <link rel="stylesheet" href="/proyectoweb/estilos/contacto.css">
    <link rel="stylesheet" href="/proyectoweb/estilos/solicitud.css">
</head>
<body>

<?php
$pathBase          = '';           
$mostrarCategorias = true;
$categoriaActiva   = '';
include 'includes/../control/navbar.php';
?>


</body>
<script>var EXISTE_CLIENTE = <?php echo isset($_SESSION["NoCliente"])?'1':'0'; ?></script>
<?php if(isset($_SESSION["RFC"]) || isset($_SESSION["NoCliente"])){ ?><script src="/proyectoweb/js/sesion.js"></script><?php } ?>
<script src="/proyectoweb/js/buscador.js"></script>
<script src="/proyectoweb/js/scripts.js"></script>
<link rel="stylesheet" href="/proyectoweb/estilos/responsive.css">
<script src="/proyectoweb/js/responsive.js"></script>
<script src="/proyectoweb/js/vendedor.js"></script>
<script src="/proyectoweb/js/contacto.js"></script>
<script src="/proyectoweb/js/proveedor.js"></script>
<script src="/proyectoweb/js/solicitud.js"></script>

<?php 
 if(isset($_SESSION["NoCliente"])): ?>
    <script>

        document.addEventListener('DOMContentLoaded', () => {
            if (typeof sincronizarCarritoConServidor === 'function') {
                sincronizarCarritoConServidor();
                setInterval(() => {
                    sincronizarCarritoConServidor();
                }, 5000);
            }
        });
    </script>
<?php endif; ?>

<script>
    window.onpageshow = function(event) {
        if (event.persisted) {
            window.location.reload();
        }
    };
</script>
</html>