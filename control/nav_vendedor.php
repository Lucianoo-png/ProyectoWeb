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
            $pedido = new PedidoControlador();
            // 1. Obtener Ventas Totales y Ganancias Acumuladas
                $statsTotales = $pedido->getPedido()->buscar('"Veracruz".pedido', [
                    "select" => "COUNT(no_referencia) as total_ventas, SUM(total) as ganancias_totales",
                    "where"  => "rfc = ?",
                    "params" => [$_SESSION["RFC"]]
                ]);

                // 2. Obtener Ventas del Día (Hoy)
                $hoy = date('Y-m-d');
                $statsHoy = $pedido->getPedido()->buscar('"Veracruz".pedido', [
                    "select" => "SUM(total) as ganancias_hoy",
                    "where"  => "rfc = ? AND DATE(fechayhora) = ?",
                    "params" => [$_SESSION["RFC"], $hoy]
                ]);

                // 3. Obtener Unidades Vendidas (Totales y de Hoy)
                // Aquí necesitamos JOIN con detallepedido
                $unidades = $pedido->getPedido()->buscar('"Veracruz".pedido p', [
                    "select" => "SUM(dp.cantidad) as total_unidades, 
                                SUM(CASE WHEN DATE(p.fechayhora) = '$hoy' THEN dp.cantidad ELSE 0 END) as unidades_hoy",
                    "join"   => 'JOIN "Veracruz".detallepedido dp ON p.no_referencia = dp.no_referencia',
                    "where"  => "p.rfc = ?",
                    "params" => [$_SESSION["RFC"]]
                ]);

                // Extraemos los valores para las variables
                $totalVentas    = $statsTotales[0]['total_ventas'] ?? 0;
                $gananciasTotal = $statsTotales[0]['ganancias_totales'] ?? 0;
                $gananciasHoy   = $statsHoy[0]['ganancias_hoy'] ?? 0;
                $totalUnidades  = $unidades[0]['total_unidades'] ?? 0;
                $unidadesHoy    = $unidades[0]['unidades_hoy'] ?? 0;
            include('vista/vendedor/inicio_vendedor.php');

    break;

    case 'reportes':
        if (isset($_POST['exportar_pdf'])) {
            $cli = new ClienteControlador();
            $fFolio   = $_POST['folio'];
            $fDesde   = $_POST['desde'];
            $fHasta   = $_POST['hasta'];
            $fCliente = $_POST['cliente'];
            
            include('reportes/vendedor/ventas.php');
        }
        else if (isset($_POST['exportar_pdf_inventario'])) {
            $fTermino = $_POST['termino'];
            
            include('reportes/vendedor/inventario.php');
        
        }
        else{
            include('vista/vendedor/header_vendedor.php');
            include('vista/404.php');
            include('vista/vendedor/footer_vendedor.php');
        }
    break;

    case 'tickets':
        if (isset($_POST['exportar_ticket'])) {
            $folio_ticket = $_POST['folio_ticket'];
            include('reportes/vendedor/ticket.php');
        } else {
            include('vista/vendedor/header_vendedor.php');
            include('vista/404.php');
            include('vista/vendedor/footer_vendedor.php');
        }
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
        $pedido = new PedidoControlador();
        $cli = new ClienteControlador();
       $ventas = $pedido->getPedido()->buscar('"Veracruz".pedido p', [
    "select" => "p.no_referencia, p.fechayhora, p.tipo_pago, p.total, p.nombre_cliente, p.no_cliente, 
                 SUM(dp.cantidad) as total_articulos",
    "join"   => 'JOIN "Veracruz".detallepedido dp ON p.no_referencia = dp.no_referencia',
    "where"  => "p.rfc = ? GROUP BY p.no_referencia, p.fechayhora, p.tipo_pago, p.total, p.nombre_cliente, p.no_cliente",
    "order"  => "p.fechayhora DESC",
    "params" => [$_SESSION["RFC"]]
]);
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