<?php 

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');
if(!isset($_SESSION["RFC"])){
    header('location:/proyectoweb/?');
    exit;
}
switch($rutaPrincipal){
    case '':
        case 'inicio':
            $emp = new EmpleadoControlador();
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
        include('vista/admin/admin_clientes.php');
    break;

    case 'ventas':
        include('vista/admin/admin_reportes_ventas.php');
    break;

    case 'compras':
        include('vista/admin/admin_reportes_compras.php');
    break;

    case 'pedidos':
        include('vista/admin/admin_reportes_pedidos.php');
    break;

    case 'pedido-proveedor':
        include('vista/admin/admin_pedido_proveedor.php');
    break;
    
     case 'logs':
        include('vista/admin/admin_logs.php');
    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
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