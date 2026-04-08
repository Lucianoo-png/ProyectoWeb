<?php

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');

switch($rutaPrincipal){
    case '':
        case 'inicio':
            include('vista/cuentausuario/inicio_usuario.php');

    break;
            //pendiente solicitud
    default:
    include('vista/cuentausuario/header_usuario.php');
    include('vista/404.php');
    include('vista/cuentausuario/footer_usuario.php');
}

?>