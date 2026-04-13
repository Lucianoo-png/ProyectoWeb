<?php

/*
$r = [
    'home'         => $pathBase . './index.php',
    'carrito'      => $pathBase . 'vista/Producto/carrito.php',
    'login'        => $pathBase . 'vista/Cuenta/login.php',
    'lb'           => $pathBase . 'vista/Producto/linea_blanca.php',
    'lm'           => $pathBase . 'vista/Producto/linea_marron.php',
    'cocina'       => $pathBase . 'vista/Producto/cocina.php',
    'lavadoras'    => $pathBase . 'vista/Producto/OtrasCategorias/lavadoras.php',
    'secadoras'    => $pathBase . 'vista/Producto/OtrasCategorias/secadoras.php',
    'lavasecadoras'=> $pathBase . 'vista/Producto/OtrasCategorias/lavasecadoras.php',
    'refrigeradores'=> $pathBase . 'vista/Producto/OtrasCategorias/refrigeradores.php',
    'congeladores' => $pathBase . 'vista/Producto/OtrasCategorias/congeladores.php',
    'frigobar'     => $pathBase . 'vista/Producto/OtrasCategorias/frigobar.php',
    'hornos'       => $pathBase . 'vista/Producto/OtrasCategorias/hornos.php',
    'estufas'      => $pathBase . 'vista/Producto/OtrasCategorias/estufas.php',
    'microondas'   => $pathBase . 'vista/Producto/OtrasCategorias/microondas.php',
    'lavavajillas' => $pathBase . 'vista/Producto/OtrasCategorias/lavavajillas.php',
    'cuidado_hogar'=> $pathBase . 'vista/Producto/OtrasCategorias/cuidado_hogar.php',
    'cuidado_personal'=> $pathBase . 'vista/Producto/OtrasCategorias/cuidado_personal.php',
    
];
*/
 
$url = isset($_GET["url"]) && $_GET["url"] != "" ? $_GET["url"] : "inicio";
$url = rtrim($url, '/');
$urlParts = explode('/', $url);
$log = new BitacoraControlador();
$rutaPrincipal =  mb_strtolower($urlParts[0]);

    switch($rutaPrincipal){
        case "inicio":
        case "?":
        case "":
            include('vista/inicio.php');
        break;

        case 'linea-blanca':
            include('vista/Producto/linea_blanca.php');
        break;

        case 'linea-marron':
            include('vista/Producto/linea_marron.php');
        break;

        case 'cocina':
            include('vista/Producto/cocina.php');
        break;

        case 'lavadoras':
            include('vista/Producto/OtrasCategorias/lavadoras.php');
        break;

        case 'secadoras':
            include('vista/Producto/OtrasCategorias/secadoras.php');
        break;

        case 'lavasecadoras':
            include('vista/Producto/OtrasCategorias/lavasecadoras.php');
        break;

        case 'hornos':
            include('vista/Producto/OtrasCategorias/hornos.php');
        break;

        case 'estufas':
            include('vista/Producto/OtrasCategorias/estufas.php');
        break;

        case 'microondas':
            include('vista/Producto/OtrasCategorias/microondas.php');
        break;

        case 'lavavajillas':
            include('vista/Producto/OtrasCategorias/lavavajillas.php');
        break;

        case 'refrigeradores':
            include('vista/Producto/OtrasCategorias/refrigeradores.php');
        break;

        case 'congeladores':
            include('vista/Producto/OtrasCategorias/congeladores.php');
        break;

        case 'frigobar':
            include('vista/Producto/OtrasCategorias/frigobar.php');
        break;

        case 'cuidado-hogar':
            include('vista/Producto/OtrasCategorias/cuidado_hogar.php');
        break;

        case 'cuidado-personal':
            include('vista/Producto/OtrasCategorias/cuidado_personal.php');
        break;

        case 'televisores':
            include('vista/Producto/OtrasCategorias/televisores.php');
        break;

        case 'audio':
            include('vista/Producto/OtrasCategorias/audio.php');
        break;

        case 'proyectores':
            include('vista/Producto/OtrasCategorias/proyectores.php');
        break;

        case 'videojuegos':
            include('vista/Producto/OtrasCategorias/videojuegos.php');
        break;

        case 'carrito':
            include('vista/Producto/carrito.php');
        break;

        case 'rastrear-pedido':
            include('vista/rastrear_pedido.php');
        break;

        case 'login':
            $msj = array();
            $emp = new EmpleadoControlador();
            $cli = new ClienteControlador();
            if(isset($_REQUEST["login"])){
                $msj = $emp->validarSesion([$_POST['correo'],$_POST['password']]);
                //Si se lleno el arreglo quiere decir que no coincide con ningún usuario asi que buscamos si es cliente
                if(count($msj)>0){
                    $msj = $cli->validarSesion([$_POST['correo'],$_POST['password']]);
                    if(count($msj)>0){
                        $log->registrarLog(null, "Intento de inicio de sesión fallido para el correo: ".$_POST["correo"], "E");
                    }
                }
            }
            include('vista/Cuenta/login.php');
        break;

        case 'contacto':
            include ('vista/contacto.php');
        break;

        case 'forgot-password':
            $msj = array();
            $emp = new EmpleadoControlador();
            if(isset($_REQUEST["recuperar_cuenta"])){
                $msj = $emp->recuperarCuenta([$_POST["correo_recuperacion"]]);
            }
            include('vista/Cuenta/recuperar_cuenta.php');
        break;

        case 'registro':
            $msj = [];
            if(isset($_REQUEST['registrar'])){
                $cliente = new ClienteControlador();
                $msj = $cliente->registrarCliente($_POST);
            }
            include('vista/Cuenta/Registro.php');
        break;

        case 'producto':
            $id_producto = isset($urlParts[1]) ? intval($urlParts[1]) : 0;
            if ($id_producto) {
                include('vista/Producto/detalle.php');
            } else {
                include('vista/header_gral.php');
                include('vista/404.php');
                include('vista/footer_gral.php');
            }
        break;

        case 'admin':
            include('control/nav_admin.php');
        break;

        case 'vendedor':
            include('control/nav_vendedor.php');
        break;

        case 'proveedor':
            include('control/nav_proveedor.php');
        break;

        case 'repartidor':
            include('control/nav_repartidor.php');
        break;

        case 'mi-perfil':
            include('control/nav_cliente.php');
        break;

        default:
            include('vista/header_gral.php');
            include('vista/404.php');
            include('vista/footer_gral.php');
        break;
    }
?>