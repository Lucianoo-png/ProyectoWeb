<?php

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
            if(isset($_SESSION["NoCliente"])){
                include('vista/Producto/carrito.php');
            }
            else{
                include('vista/header_gral.php');
                include('vista/404.php');
                include('vista/footer_gral.php');
            }
        break;

        case 'carrito-obtener':
            $controlador = new CarritoControlador();
            $controlador->accionObtenerCarrito();
        break;

        case 'rastrear-pedido':
            include('vista/rastrear_pedido.php');
        break;

        case 'envio':
            if(isset($_SESSION["NoCliente"])){
                $cli = new ClienteControlador();
                $direcciones = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                $datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                $carrito_db = $cli->getCliente()->buscar('"Veracruz".carrito_reserva', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                if (empty($carrito_db)){
                    include('vista/header_gral.php');
                    include('vista/404.php');
                    include('vista/footer_gral.php');
                }
                else{
                    include('vista/Producto/direccion.php');
                }
            }
            else{
                include('vista/header_gral.php');
                include('vista/404.php');
                include('vista/footer_gral.php');
            }
            
        break;

        case 'pago':
            if(isset($_SESSION["NoCliente"])){
                $cli = new ClienteControlador();
                $direcciones = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                $datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                $carrito_db = $cli->getCliente()->buscar('"Veracruz".carrito_reserva', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
                if (empty($carrito_db)){
                    include('vista/header_gral.php');
                    include('vista/404.php');
                    include('vista/footer_gral.php');
                }
                else{
                    $nombreReal = (count($datos_cli) > 0) ? $datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'] : 'Cliente';
                    if (isset($_REQUEST['pagar'])) {
                        $ped = new PedidoControlador();
                        $msj = $ped->procesarVentaWeb($_POST);
                        if($msj[0] === 'exito'){
                            $_SESSION['ultimo_pedido'] = $msj[1]; // Guardamos el folio/mensaje
                            header("Location: /proyectoweb/gracias"); // Redirigimos
                            exit;
                        }
                    }
                    include('vista/Producto/pago.php');
                }
            }
            else{
                include('vista/header_gral.php');
                include('vista/404.php');
                include('vista/footer_gral.php');
            }
        break;

        // NUEVO CASE
        case 'gracias':
            if(isset($_SESSION['ultimo_pedido']) && $_SESSION["ultimo_pedido"]!=''){
                $mensaje_exito = $_SESSION['ultimo_pedido'];
                // Opcional: borrarlo para que no se vea si refresca después
                include('vista/Producto/gracias.php');
                unset($_SESSION['ultimo_pedido']); 
            } else {
                header("Location: /proyectoweb/?");
            }
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
            if (isset($_SERVER['HTTP_REFERER']) && str_contains(mb_strtolower($_SERVER['HTTP_REFERER']),"producto")) {
                $_SESSION['url_retorno'] = $_SERVER['HTTP_REFERER'];
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

        case 'carrito-reservar':
            $controlador = new CarritoControlador();
            $controlador->accionReservar();
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