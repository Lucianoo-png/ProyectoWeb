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
$rutaPrincipal =  mb_strtolower($urlParts[0]);
if($rutaPrincipal!='admin' && $rutaPrincipal!='vendedor' && $rutaPrincipal!='repartidor' && $rutaPrincipal!='proveedor' && $rutaPrincipal!='mi-perfil'){

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
            include('vista/Cuenta/login.php');
        break;

        case 'forgot-password':
            include('vista/Cuenta/recuperar_cuenta.php');
        break;

        case 'registro':
            include('vista/Cuenta/Registro.php');
        break;

        case 'producto':
            $sku = isset($urlParts[1]) ? $urlParts[1] : null;
            if ($sku) {
                include('vista/Producto/detalle.php');
            } else {
                include('vista/header_gral.php');
                include('vista/404.php');
                include('vista/footer_gral.php');
            }
        break;

        default:
            include('vista/header_gral.php');
            include('vista/404.php');
            include('vista/footer_gral.php');
        break;
    }

}
else{
    if($rutaPrincipal=='admin'){
        include('control/nav_admin.php');
    }
    else if($rutaPrincipal=='vendedor'){
        include('control/nav_vendedor.php');
    }
    else if($rutaPrincipal=='proveedor'){
        include('control/nav_proveedor.php');
    }
    else if($rutaPrincipal=='repartidor'){
        include('control/nav_repartidor.php');
    }
    else{
        include('control/nav_cliente.php');
    }
}

?>