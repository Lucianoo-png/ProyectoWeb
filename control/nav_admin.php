<?php 

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');
$log = new BitacoraControlador();
if(!isset($_SESSION["RFC"])){
    header('location:/proyectoweb/?');
    exit;
}
else{
    if($_SESSION["Tipo"]!="A"){
        $log->registrarLog($_SESSION['RFC'], "Intento de acceso prohibido a ruta de administrador.", "E");
    }
    if($_SESSION["Tipo"]=='E'){
        include('vista/vendedor/header_vendedor.php');
        include('vista/404.php');
        include('vista/vendedor/footer_vendedor.php');
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
            $prod = new ProductoControlador();

            $total_empleados = count($emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"estatus='true'"]));
            $total_productos = count($prod->getProducto()->buscar('"Veracruz".producto',["where"=>"estatus='true'"]));
            include('vista/admin/vistaadmin.php');
    break;

    case 'personal':
        $msj = array();
        $emp = new EmpleadoControlador();
        if(isset($_REQUEST["guardar"])){
            $msj = $emp->agregarPersonal($_POST);
        }
        else if(isset($_REQUEST["actualizar"])){
            $msj = $emp->editarPersonal($_POST);
        }
        else if(isset($_REQUEST["eliminar"])){
            $msj = $emp->eliminarPersonal($_POST);
        }
        else if(isset($_REQUEST["activar"])){
            $msj = $emp->activarPersonal($_POST);
        }
        include('vista/admin/admin_usuarios.php');
    break;

    case 'productos':
        $msj = array();
        $prodControl = new ProductoControlador();
        if(isset($_POST["guardar"])){
            $msj = $prodControl->agregarProducto($_POST, $_FILES);
        } else if(isset($_POST["actualizar"])){
            $msj = $prodControl->editarProducto($_POST, $_FILES);
        } else if(isset($_POST["eliminar"])){
            $msj = $prodControl->eliminarProducto($_POST);
        } else if(isset($_POST["activar"])){
            $msj = $prodControl->activarProducto($_POST);
        }
        include('vista/admin/admin_productos.php');
    break;

    case 'clientes':
        $cli = new ClienteControlador();
        $clientes = $cli->getCliente()->buscar('"Veracruz".cliente',["order" => "no_cliente ASC"]);
        $total_clientes = count($cli->getCliente()->buscar('"Veracruz".cliente'));
        include('vista/admin/admin_clientes.php');
    break;

    case 'reportes':
        if (isset($_POST['exportar_pdf'])) {
            $cli = new ClienteControlador();
            $fDesde = $_POST['desde'] ?? '';
            $fHasta = $_POST['hasta'] ?? '';
            $fVendedor = $_POST['vendedor'] ?? '';
            $fPago = $_POST['metodo_pago'] ?? '';
            $fCantMin = $_POST['cant_min'] ?? '';
            $fCantMax = $_POST['cant_max'] ?? '';
            $fPrecioMin = $_POST['precio_min'] ?? '';
            $fPrecioMax = $_POST['precio_max'] ?? '';
            include('reportes/admin/ventas.php');
        }
        else if (isset($_POST['exportar_pdf_compras'])) {
            $emp = new EmpleadoControlador();
            $fDesde     = $_POST['desde'] ?? '';
            $fHasta     = $_POST['hasta'] ?? '';
            $fProveedor = $_POST['proveedor'] ?? '';
            $fCantMin   = $_POST['cant_min'] ?? '';
            $fCantMax   = $_POST['cant_max'] ?? '';
            $fPrecioMin = $_POST['precio_min'] ?? '';
            $fPrecioMax = $_POST['precio_max'] ?? '';

            include('reportes/admin/compras.php');
        }
        else if (isset($_POST['exportar_pdf_pedidos'])) {
            $fDesde      = $_POST['desde'] ?? '';
            $fHasta      = $_POST['hasta'] ?? '';
            $fCliente    = $_POST['cliente'] ?? '';
            $fRepartidor = $_POST['repartidor'] ?? '';
            $fEstado     = $_POST['estado'] ?? '';
            $fMontoMin   = $_POST['monto_min'] ?? '';
            $fMontoMax   = $_POST['monto_max'] ?? '';

            include('reportes/admin/pedidos.php');
        }
        else {
            include('vista/admin/header_admin.php');
            include('vista/404.php');
            include('vista/admin/footer_admin.php');
        }
    break;

    case 'ventas':
        $emp = new EmpleadoControlador();
        $vendedores = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"tipousuario='E'"]);
        include('vista/admin/admin_reportes_ventas.php');
    break;

    case 'compras':
         $emp = new EmpleadoControlador();
        $proveedores = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"tipousuario='P'"]);
        include('vista/admin/admin_reportes_compras.php');
    break;

    case 'pedidos':
        $cli = new ClienteControlador();
        $clientes = $cli->getCliente()->buscar('"Veracruz".cliente');
        $emp = new EmpleadoControlador();
        $repartidores= $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"tipousuario='R'"]);
        include('vista/admin/admin_reportes_pedidos.php');
    break;

    case 'pedido-proveedor':
        $msj = array();
        $emp = new EmpleadoControlador();
        $prod = new ProductoControlador();
        $soli = new SolicitudReabastecimientoControlador();
        $log = new BitacoraControlador();
        if(isset($_REQUEST["guardar_pedido"])){
            $msj = $soli->registrarSolicitud($_POST, $_SESSION["RFC"], $log);
        }

        $proveedores = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"tipousuario='P' AND estatus='true'"]);
        $productos = $prod->getProducto()->buscar('"Veracruz".producto',["where"=>"estado<>'S'"]);
        $solicitudes = $soli->obtenerHistorialCompletoVista();

        $resultado = $soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento', [
            "order" => "folio_solicitud DESC", 
            "limit" => 1
        ]);
        $ultimoFolio = (!empty($resultado)) ? $resultado[0]['folio_solicitud'] : null;

        $nuevoFolio = Helpers::generarFolioReabastecimiento($ultimoFolio);
        include('vista/admin/admin_pedido_proveedor.php');
    break;

    case 'asignar-pedidos':
        $emp = new EmpleadoControlador();

        
    
    break;
    
     case 'logs':
        $usu = new EmpleadoControlador();
        $total_logs = count($log->getBitacora()->buscar('"Veracruz".bitacora'));
        $total_logs_exito = count($log->getBitacora()->buscar('"Veracruz".bitacora',["where"=>"estado='C'"]));
        $total_logs_error = count($log->getBitacora()->buscar('"Veracruz".bitacora',["where"=>"estado='E'"]));
        $logs = $log->getBitacora()->buscar('"Veracruz".bitacora',["order"=>"fechayhora DESC"]);
        $usuarios = $usu->getEmpleado()->buscar('"Veracruz".empleado');
        include('vista/admin/admin_logs.php');
    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Cierre de sesión exitoso (Administrador)", "C");
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
    include('vista/admin/header_admin.php');
    include('vista/404.php');
    include('vista/admin/footer_admin.php');
}

?>