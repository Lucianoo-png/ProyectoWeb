<?php

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');

switch($rutaPrincipal){
    case '':
        case 'inicio':
            include('vista/vendedor/repartidor.php');

    break;
    default:
    include('vista/vendedor/header_repartidor.php');
    include('vista/404.php');
    include('vista/vendedor/footer_repartidor.php');
}

?>