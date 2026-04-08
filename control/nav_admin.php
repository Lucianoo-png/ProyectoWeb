<?php 

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');
switch($rutaPrincipal){
    case '':
        case 'inicio':
            include('vista/admin/vistaadmin.php');
    break;

    case 'personal':
        include('vista/admin/admin_usuarios.php');
    break;

    case 'productos':
        include('vista/admin/admin_productos.php');
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
        include('vista/admin/admin_logout.php');
    break;

    default:
    include('vista/admin/header_admin.php');
    include('vista/404.php');
    include('vista/admin/footer_admin.php');
}

?>