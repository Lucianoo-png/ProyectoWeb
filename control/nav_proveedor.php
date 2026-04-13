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
    if($_SESSION["Tipo"]!="P"){
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Intento de acceso prohibido a ruta de proveedor.", "E");
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
    else if($_SESSION["Tipo"]=='R'){
        include('vista/vendedor/header_repartidor.php');
        include('vista/404.php');
        include('vista/vendedor/footer_repartidor.php');
        exit;
    }
}


switch($rutaPrincipal){
    case '':
        case 'inicio':
            include('vista/vendedor/inicio_proveedor.php');

    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Cierre de sesión exitoso (proveedor)", "C");
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
    include('vista/vendedor/header_proveedor.php');
    include('vista/404.php');
    include('vista/vendedor/footer_proveedor.php');
}

?>