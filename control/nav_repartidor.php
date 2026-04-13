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
    if($_SESSION["Tipo"]!="R"){
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Intento de acceso prohibido a ruta de repartidor.", "E");
    }
    if($_SESSION["Tipo"]=='A'){
        include('vista/admin/header_admin.php');
        include('vista/404.php');
        include('vista/admin/footer_admin.php');
        exit;
    }
    else if($_SESSION["Tipo"]=='E'){
        include('vista/vendedor/header_vendedor.php');
        include('vista/404.php');
        include('vista/vendedor/footer_vendedor.php');
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
            if (isset($_REQUEST['guardar'])) {
                $msj = $emp->actualizarPerfilPersonal($_POST);
            }
            else if(isset($_REQUEST["actualizar_contra"])){
                 $msj = $emp->actualizarContra($_POST);
            }
            $info = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"rfc='".$_SESSION["RFC"]."'"]);
            include('vista/vendedor/repartidor.php');

    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Cierre de sesión exitoso (repartidor)", "C");
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
    include('vista/vendedor/header_repartidor.php');
    include('vista/404.php');
    include('vista/vendedor/footer_repartidor.php');
}

?>