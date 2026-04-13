<?php

$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$rutaPrincipal = mb_strtolower(isset($urlParts[1])?$urlParts[1]:'');
$log = new BitacoraControlador();
if(!isset($_SESSION["NoCliente"]) && !isset($_SESSION["RFC"])){
    header('location:/proyectoweb/?');
    exit;
}
else{
    if($_SESSION["Tipo"]!='C'){
        $log->registrarLog($_SESSION['RFC'], "Intento de acceso prohibido a ruta de cliente.", "E");
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
    else if($_SESSION["Tipo"]=='A'){
        include('vista/admin/header_admin.php');
        include('vista/404.php');
        include('vista/admin/footer_admin.php');
        exit;
    }
}
switch($rutaPrincipal){
    case '':
        case 'inicio':
            $msj = array();//1A_22020742
            $cliente = new ClienteControlador();
            if(isset($_REQUEST["actualizar_datos"])){
                $msj = $cliente->actualizarDatos($_POST);
            }
            else if(isset($_REQUEST["actualizar_contra"])){
                 $msj = $cliente->actualizarContra($_POST);
            }
            else if(isset($_REQUEST["guardar_direccion"])){
                $msj = $cliente->guardarDireccion($_POST);
            }
            else if(isset($_REQUEST["eliminar_direccion"])){
                $msj = $cliente->eliminarDireccion($_POST);
            }
            $info = $cliente->getCliente()->buscar('"Veracruz".cliente',["where"=>"no_cliente=".$_SESSION["NoCliente"]]);
            $direcciones = $cliente->getCliente()->buscar('"Veracruz".clientedireccion',["where"=>"no_cliente=".$_SESSION["NoCliente"]]);
            include('vista/cuentausuario/inicio_usuario.php');

    break;

    case 'logout':
        session_destroy();
        if (ini_get("session.use_cookies")) {
                        $p = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $p["path"], $p["domain"], $p["secure"], $p["httponly"]
                        );
                    }
        header('location:/proyectoweb/?');
    break;
            //pendiente solicitud
    default:
    include('vista/cuentausuario/header_usuario.php');
    include('vista/404.php');
    include('vista/cuentausuario/footer_usuario.php');
}

?>