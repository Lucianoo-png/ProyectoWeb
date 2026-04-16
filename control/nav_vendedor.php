<?php

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');
if(!isset($_SESSION["RFC"])){
    header('location:/proyectoweb/?');
    exit;
}
else{
    if($_SESSION["Tipo"]!="E"){
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Intento de acceso prohibido a ruta de vendedor.", "E");
    }
    if($_SESSION["Tipo"]=='A'){
        include('vista/admin/header_admin.php');
        include('vista/404.php');
        include('vista/admin/footer_admin.php');
        exit;
    }
    else if($_SESSION["Tipo"]=='R'){
        include('vista/vendedor/header_repartidor.php');
        include('vista/404.php');
        include('vista/vendedor/footer_repartidor.php');
        exit;
    }
    else if($_SESSION["Tipo"]=='P'){
        include('vista/vendedor/header_proveedor.php');
        include('vista/404.php');
        include('vista/vendedor/footer_proveedor.php');
        exit;
    }
}

switch($rutaPrincipal){
    case '':
        case 'inicio':
            $emp = new EmpleadoControlador();
            $info = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"rfc='".$_SESSION["RFC"]."'"]);
            include('vista/vendedor/inicio_vendedor.php');

    break;

    case 'ventas':
        $producto = new ProductoControlador();
        $cliente = new ClienteControlador();
        $pedidoControl = new PedidoControlador();
        $log = new BitacoraControlador();
        $msj = array();
        if (isset($_REQUEST["registrar_venta"])) {
            $msj = $pedidoControl->procesarVentaFisica($_POST, $_SESSION['RFC'], $log);
        }

        $productos = $producto->getProducto()->buscar('"Veracruz".producto', [
            "where" => "stock > 0 AND estatus = 'true'",
            "order" => "no_producto ASC"
        ]);

        $clientes_linea = $cliente->getCliente()->buscar('"Veracruz".cliente', [
            "where" => "estatus = 'true' AND origen = 'L'"
        ]);

        include('vista/vendedor/ventas.php');
    break;

    case 'detalle-ventas':
        include('vista/vendedor/detalle_ventas.php');
    break;

    case 'inventario':
        $producto = new ProductoControlador();
        $productos = $producto->getProducto()->buscar('"Veracruz".producto',["where"=>"estatus='true'","order"=>"no_producto ASC"]);
        $total_productos = count($producto->getProducto()->buscar('"Veracruz".producto',["where"=>"estatus='true'","order"=>"no_producto ASC"]));
        $total_productos_normal = count($producto->getProducto()->buscar('"Veracruz".producto',["where"=>"stock>=stockminimo AND estatus='true'","order"=>"no_producto ASC"]));
        $total_productos_bajo = count($producto->getProducto()->buscar('"Veracruz".producto',["where"=>"stock<stockminimo AND stock>0 AND estatus='true'","order"=>"no_producto ASC"]));
        $total_productos_agotado = count($producto->getProducto()->buscar('"Veracruz".producto',["where"=>"stock=0 AND estatus='true'","order"=>"no_producto ASC"]));
        include('vista/vendedor/inventario.php');
    break;

    case 'solicitudes':
        include('vista/vendedor/solicitudes.php');
    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Cierre de sesión exitoso (Vendedor)", "C");
        session_destroy();
        if (ini_get("session.use_cookies")) {
                        $p = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $p["path"], $p["domain"], $p["secure"], $p["httponly"]
                        );
                    }
        header('location:/proyectoweb/?');
    break;

    default:
    include('vista/vendedor/header_vendedor.php');
    include('vista/404.php');
    include('vista/vendedor/footer_vendedor.php');
  
}

?>