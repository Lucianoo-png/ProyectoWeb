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
        $emp = new EmpleadoControlador();
        $soli = new SolicitudReabastecimientoControlador();
        $msj = array();
        $compra = new CompraControlador();
        $log = new BitacoraControlador();
        if(isset($_REQUEST["enviar_respuesta"])){
            $msj = $compra->procesarRespuestaProveedor($_POST, $_SESSION['RFC'], $log, $soli);
        }
        else if (isset($_REQUEST['guardar'])) {
                $msj = $emp->actualizarPerfilPersonal($_POST);
        }
        else if(isset($_REQUEST["actualizar_contra"])){
                 $msj = $emp->actualizarContra($_POST);
            }
        $rfc_proveedor = $_SESSION['RFC'];

        $info = $emp->getEmpleado()->buscar('"Veracruz".empleado', ["where" => "rfc='$rfc_proveedor'"]);

        $total_pendientes = count($soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento', [
            "where" => "rfc_proveedor = '$rfc_proveedor' AND estado = 'enviada'"
        ]));

        $total_respuestas = count($soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento', [
            "where" => "rfc_proveedor = '$rfc_proveedor' AND estado IN ('respondida','cancelada')"
        ]));

        $total_confirmados = count($soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento', [
            "where" => "rfc_proveedor = '$rfc_proveedor' AND estado = 'respondida'"
        ]));

        $unidades_query = $soli->getSoli()->buscar('"Veracruz".compra c', [
            "select" => "SUM(d.cantidad) as total",
            "join" => 'JOIN "Veracruz".detallecompra d ON c.foliocompra = d.foliocompra',
            "where" => "c.rfc_proveedor = '$rfc_proveedor'"
        ]);

        $pendientes = $soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento s', [
            "select" => "s.folio_solicitud, TO_CHAR(s.fecha_envio, 'DD/MM/YYYY') as fecha, COUNT(d.no_producto) as total_prod",
            "join" => 'LEFT JOIN "Veracruz".detalle_solicitud d ON s.folio_solicitud = d.folio_solicitud',
            "where" => "s.rfc_proveedor = '$rfc_proveedor' AND s.estado = 'enviada'",
            "group" => "s.folio_solicitud, s.fecha_envio"
        ]);
        $total_unidades = $unidades_query[0]['total'] ?? 0;

        $todas_solicitudes = $soli->getSoli()->buscar('"Veracruz".solicitud_reabastecimiento s', [
            "select" => "s.folio_solicitud, TO_CHAR(s.fecha_envio, 'DD/MM/YYYY HH24:MI') as fecha, s.estado, s.observaciones, COUNT(d.no_producto) as total_prod",
            "join" => 'LEFT JOIN "Veracruz".detalle_solicitud d ON s.folio_solicitud = d.folio_solicitud',
            "where" => "s.rfc_proveedor = '$rfc_proveedor'",
            "group" => "s.folio_solicitud, s.fecha_envio, s.estado, s.observaciones",
            "order" => "s.fecha_envio DESC"
        ]);

        $detalles_db = $soli->getSoli()->buscar('"Veracruz".detalle_solicitud d', [
            "select" => "d.folio_solicitud, d.cantidad_pedida, p.nombre, p.no_producto, p.precio_compra",
            "join" => 'JOIN "Veracruz".producto p ON d.no_producto = p.no_producto 
                    JOIN "Veracruz".solicitud_reabastecimiento s ON d.folio_solicitud = s.folio_solicitud',
            "where" => "s.rfc_proveedor = '$rfc_proveedor'"
        ]);

        $solicitudes_js = [];
        foreach($todas_solicitudes as $s) {
            $folio = $s['folio_solicitud'];
            $solicitudes_js[$folio] = [
                "folio" => $folio,
                "estado" => $s['estado'],
                "nota" => $s['observaciones'] ?$s['observaciones']: 'Sin observaciones.',
                "productos" => []
            ];
        }
        foreach($detalles_db as $det) {
            $folio = $det['folio_solicitud'];
            $cantSuministrada = $det['cantidad_pedida']; 

            if ($solicitudes_js[$folio]['estado'] == 'respondida') {
                $res = $soli->getSoli()->buscar('"Veracruz".detallecompra dc', [
                    "select" => "dc.cantidad",
                    "join" => 'JOIN "Veracruz".producto_detalle_compra pdc ON dc.folio_compra_detalle = pdc.folio_compra_detalle 
                            JOIN "Veracruz".compra c ON dc.foliocompra = c.foliocompra',
                    "where" => "pdc.no_producto = " . $det['no_producto'] . " AND c.rfc_proveedor = '".$_SESSION["RFC"]."'",
                    "order" => "c.foliocompra DESC",
                    "limit" => 1
                ]);
                
                $cantSuministrada = (!empty($res)) ? $res[0]['cantidad'] : 0;
            }
            $solicitudes_js[$det['folio_solicitud']]['productos'][] = [
                "id" => $det['no_producto'],
                "nombre" => $det['nombre'],
                "cantSolicitada" => $det['cantidad_pedida'],
                "cantSuministrada" => $cantSuministrada,
                "precio" => $det['precio_compra']
            ];

            $historial= $soli->getSoli()->obtenerHistorialDetallado($_SESSION["RFC"]);
        }

        include('vista/vendedor/inicio_proveedor.php');
    break;

    case 'logout':
        $emp = new EmpleadoControlador();
        $emp->getEmpleado()->actualizarUltimaVez(false);
        $log = new BitacoraControlador();
        $log->registrarLog($_SESSION['RFC'], "Cierre de sesión exitoso (Proveedor)", "C");
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