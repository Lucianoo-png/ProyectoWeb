<?php

class PedidoControlador {
    private Pedido $pedido;

    public function __construct() {
        $this->pedido = new Pedido();
    }

    public function getPedido() {
        return $this->pedido;
    }

    public function procesarVentaFisica($datos, $rfc_vendedor, $log) {
        $productos = json_decode($datos['items_json'] ?? '[]', true);
        $tipo_pago = $datos['pago'] ?? 'efectivo';
       $no_cliente = $datos['cliente']==''?null:$datos['cliente'];
        $nombre_cliente_log = !empty($datos['nombre_cliente_nuevo']) ? $datos['nombre_cliente_nuevo'] : 'Mostrador';

        if (empty($productos)) {
            return ["error", "No se han añadido productos a la venta."];
        }

        $this->pedido->setRfc($rfc_vendedor);
        $this->pedido->setNoCliente($no_cliente);
        $this->pedido->setTipoPago($tipo_pago);
        $this->pedido->getNoCliente()!=null?$this->pedido->setNombre_cliente(null):$this->pedido->setNombre_cliente(mb_strtoupper(trim($nombre_cliente_log)));
        $total = 0;
        for($i = 0; $i < count($productos);$i++){
            $total+=$productos[$i]['precio'] * $productos[$i]['qty'];
        }
        $total+=$total*0.16;
        if($tipo_pago=='tarjeta'){
            $this->pedido->setTotal($total);
            $this->pedido->setPagado($total);
        }
        else{
            $this->pedido->setTotal($total);
            $this->pedido->setPagado($datos['cantidad']);
        }
        $no_referencia = $this->pedido->registrarVentaCompleta($productos, $tipo_pago);

        if ($no_referencia) {
            $detalle_log = "Venta física registrada. Folio: $no_referencia. Cliente: $nombre_cliente_log";
            $log->registrarLog($rfc_vendedor, $detalle_log, "C"); 

            return ["exito", "Venta #$no_referencia registrada correctamente."];
        }

        $log->registrarLog($rfc_vendedor, "Error al intentar registrar venta física.", "E");
        return ["error", "Error al procesar la venta. Verifique el stock disponible."];
    }

    public function procesarVentaWeb($datos) {
        if(trim($datos['numero'])=='' || trim($datos['titular'])=='' || trim($datos['fecha_vencimiento']=='')
        || trim($datos['cvv']=='')
            ){
            return ["error","Es necesario que ingrese los datos de su tarjeta para finalizar la compra."];
        }
        $no_cliente = $_SESSION["NoCliente"];
        $productos = json_decode($datos['items_json'] ?? '[]', true);
        $id_direccion = $datos['id_direccion'];

        if (empty($productos)) return ["error", "El carrito está vacío."];

        $this->pedido->setNoCliente($no_cliente);
        $this->pedido->setRfc(null);
        $this->pedido->setTipoPago('tarjeta');
        
        $subtotal = 0;
        foreach($productos as $p) { $subtotal += ($p['precio'] * $p['cantidad']); }
        $totalConIva = $subtotal * 1.16;
        
        $this->pedido->setTotal($totalConIva);
        $this->pedido->setPagado($totalConIva);
        $no_referencia = $this->pedido->registrarVentaWeb($productos, $id_direccion);

        if ($no_referencia) {
            $_SESSION['venta_finalizada'] = true;
   // 1. OBTENER INFORMACIÓN DE ENVÍO
    $cli = new ClienteControlador();
    $datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente', ["where" => "no_cliente=" . $_SESSION["NoCliente"]]);
    
    // Consultamos la dirección específica que se usó para la compra
    $datos_dir = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where" => "no_dirección=" . $id_direccion]);
    $dir = $datos_dir[0] ?? null;
    $direccionTexto = $dir ? "{$dir['calle']} #{$dir['num_ext']}, Col. {$dir['colonia']}, {$dir['ciudad']}, {$dir['estado']}. CP: {$dir['cp']}" : "Dirección no especificada";

    // 2. CONSTRUCCIÓN DE FILAS DE PRODUCTOS
    $filasProductos = '';
    foreach ($productos as $p) {
        $subtotalItem = ($p['precio'] * $p['cantidad']) * 1.16;
        $filasProductos .= '
            <tr>
                <td style="padding: 12px 10px; border-bottom: 1px solid #f0f0f0;">
                    <span style="font-size: 14px; color: #333; font-weight: 600; display: block;">' . $p['nombre'] . '</span>' . 
                    (isset($p['nombre_color']) ? '<span style="font-size: 12px; color: #888;">Color: ' . $p['nombre_color'] . '</span>' : '') . '
                </td>
                <td style="padding: 12px 10px; border-bottom: 1px solid #f0f0f0; text-align: center; color: #666; font-size: 14px;">
                    ' . $p['cantidad'] . '
                </td>
                <td style="padding: 12px 10px; border-bottom: 1px solid #f0f0f0; text-align: right; color: #333; font-weight: 600; font-size: 14px;">
                    $' . number_format($subtotalItem, 2) . '
                </td>
            </tr>';
    }

    // 3. ESTRUCTURA DEL HTML MEJORADA
    $body = '<!DOCTYPE html>
    <html lang="es">
    <head><meta charset="UTF-8"></head>
    <body style="margin:0; padding:0; background-color:#f8fafc; font-family:\'Segoe UI\',Helvetica,Arial,sans-serif;">
        <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f8fafc; padding:40px 10px;">
            <tr>
                <td align="center">
                    <table width="600" cellpadding="0" cellspacing="0" style="background-color:#ffffff; border-radius:16px; overflow:hidden; box-shadow:0 10px 25px rgba(0,0,0,0.05);">
                        <tr>
                            <td style="background: linear-gradient(135deg, #002347 0%, #004a8f 100%); padding:40px 30px; text-align:center;">
                                <h1 style="color:#ffffff; margin:0; font-size:32px; font-weight:800; letter-spacing:-1px;">Luchanos<span style="color:#00d1ff;">Corp</span></h1>
                                <div style="display:inline-block; margin-top:15px; padding:6px 16px; background-color:rgba(255,255,255,0.1); border-radius:20px; color:#ffffff; font-size:13px; font-weight:600;">
                                    Confirmación de Pedido #' . $no_referencia . '
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="padding:40px 30px;">
                                <h2 style="color:#1e293b; font-size:24px; margin-top:0; font-weight:700;">¡Hola, ' . $datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'] . '!</h2>
                                <p style="color:#64748b; font-size:16px; line-height:1.6; margin-bottom:30px;">
                                    Tu pedido ha sido confirmado con éxito. Estamos preparando todo para que tus productos lleguen a tus manos lo antes posible.
                                </p>

                                <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom:30px;">
                                    <tr>
                                        <td width="50%" valign="top" style="padding-right:10px;">
                                            <div style="background-color:#f1f5f9; padding:20px; border-radius:12px; height:100px;">
                                                <span style="color:#008C9E; font-weight:bold; font-size:11px; text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:8px;">Destino de Envío</span>
                                                <span style="color:#334155; font-size:13px; line-height:1.4; display:block;">' . $direccionTexto . '</span>
                                            </div>
                                        </td>
                                        <td width="50%" valign="top" style="padding-left:10px;">
                                            <div style="background-color:#f1f5f9; padding:20px; border-radius:12px; height:100px;">
                                                <span style="color:#008C9E; font-weight:bold; font-size:11px; text-transform:uppercase; letter-spacing:1px; display:block; margin-bottom:8px;">Método de Pago</span>
                                                <span style="color:#334155; font-size:13px; line-height:1.4; display:block;">Tarjeta de Crédito/Débito<br>Finalizada en: ****' . substr($datos['numero'], -4) . '</span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                                <h3 style="color:#1e293b; font-size:18px; margin-bottom:15px; font-weight:700; border-bottom: 2px solid #f1f5f9; padding-bottom:10px;">Resumen del Pedido</h3>
                                <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th style="text-align: left; font-size: 12px; color: #94a3b8; text-transform: uppercase; padding-bottom:10px;">Producto</th>
                                            <th style="text-align: center; font-size: 12px; color: #94a3b8; text-transform: uppercase; padding-bottom:10px;">Cant.</th>
                                            <th style="text-align: right; font-size: 12px; color: #94a3b8; text-transform: uppercase; padding-bottom:10px;">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ' . $filasProductos . '
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" style="padding: 25px 10px 10px; text-align: right; font-weight: 600; color: #64748b;">Total con IVA:</td>
                                            <td style="padding: 25px 0 10px; text-align: right; font-size: 24px; font-weight: 800; color: #002347;">
                                                $' . number_format($totalConIva, 2) . '
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <div style="margin-top:40px; padding:20px; border-radius:12px; border: 2px dashed #e2e8f0; text-align:center;">
                                    <p style="margin:0; color:#64748b; font-size:14px;">Si tienes dudas sobre tu paquete, escríbenos a <strong>soporte@luchanoscorp.com</strong></p>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#f1f5f9; color:#94a3b8; padding:30px; text-align:center; font-size:12px;">
                                <p style="margin:0 0 10px 0;">Este es un correo automático, por favor no respondas a esta dirección.</p>
                                <p style="margin:0;">&copy; ' . date("Y") . ' LuchanosCorp. Todos los derechos reservados.</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
    </html>';
   
     if (sent_email('L22020742@veracruz.tecnm.mx', "Luchanos Corp", $datos_cli[0]['correo'],$datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'], 'Gracias por tu compra', $body)) {
        return ["exito", "Tu compra ha sido registrada exitosamente con el siguiente número de referencia: ".$no_referencia];
     }
     else{
        return ["error", "Ocurrió un error al verificar tu correo electrónico. Intenta de nuevo."]; 
     }
           
        }
        return ["error", "No se pudo procesar el pago. Intente más tarde."];
    }

    public function asignarPedidos($log, $datos = array()){
        if($datos['rfc_repartidor']==''){
            return ["error","Debe seleccionar un repartidor"];
        }

        $total = $this->pedido->verificarPedidos($datos['rfc_repartidor']);

        if($total[0]['pedidos_activos'] >= 5){
            return ["error","El repartidor ya cuenta con 5 pedidos, asigne este pedido a otro repartidor para evitar saturación"];
        }

        if(!$this->pedido->asignarPedido($datos['rfc_repartidor'],$datos['observaciones']==''?null:$datos['observaciones'],intval($datos['no_pedido']))){
            return ["error","Ocurrió un error al asignar el pedido, intente más tarde"];
        }

         $log->registrarLog($_SESSION["RFC"], "Pedido #".$datos['no_pedido']." asignado correctamente", "C");
        return array("exito","Pedido asignado correctamente");
    }

    public function accionListarPedidos() {
        if (ob_get_length()) ob_clean();
        header('Content-Type: application/json');

        $no_cliente = $_SESSION["NoCliente"];
        $datosRaw = $this->pedido->obtenerHistorialPorCliente($no_cliente);

        $pedidos = [];
        foreach ($datosRaw as $f) {
            $ref = $f['no_referencia'];
            if (!isset($pedidos[$ref])) {
                $pedidos[$ref] = [
                    'referencia' => $ref,
                    'fecha' => $f['fechayhora'],
                    'total' => $f['total_pedido'],
                    'estado' => trim($f['estado_envio']), 
                    'items' => []
                ];
            }
            
            $pedidos[$ref]['items'][] = [
                'nombre' => $f['nombre'],
                'imagen' => $f['imagen'],
                'sku'    => Helpers::crearSKU($f['categoria'], $f['nombre']),
                'cant'   => $f['cantidad'],
                'precio' => $f['precio_venta'],
                'color'  => $f['color']
            ];
        }
        echo json_encode(array_values($pedidos));
        exit;
    }
            
}

?>