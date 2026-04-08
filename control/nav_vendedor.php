<?php

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');

switch($rutaPrincipal){
    case '':
        case 'inicio':
            include('vista/vendedor/inicio_vendedor.php');

    break;

    case 'ventas':
        include('vista/vendedor/ventas.php');
    break;

    case 'detalle-ventas':
        include('vista/vendedor/detalle_ventas.php');
    break;

    case 'inventario':
        include('vista/vendedor/inventario.php');
    break;

    case 'catalogo':
        include('vista/vendedor/catalogo.php');
    break;

    case 'solicitudes':
        include('vista/vendedor/solicitudes.php');
    break;

    default:
    include('vista/vendedor/header_vendedor.php');
    include('vista/404.php');
    include('vista/vendedor/footer_vendedor.php');
  
}

?>