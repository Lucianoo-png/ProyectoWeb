<?php
require('../ProyectoWeb/pdf/fpdf.php');

if (!isset($folio_ticket) || empty($folio_ticket)) {
    die("Error: No se proporcionó el folio del ticket.");
}

$pedidoControlador = new PedidoControlador();
$resultadoTicket = $pedidoControlador->getPedido()->obtenerDatosTicket($folio_ticket);

if (empty($resultadoTicket)) {
    die("Error: No se encontró la venta con el folio especificado.");
}

$venta = $resultadoTicket[0];
$nomCli = !empty($venta['nombre_cliente']) ? $venta['nombre_cliente'] : ($venta['cli_nombre'] . " " . $venta['cli_apellidos']);

if (ob_get_contents()) ob_end_clean();
ob_start();

// Lienzo de 80mm (Estándar POS)
$pdf = new FPDF('P', 'mm', array(80, 250));
$pdf->AddPage();
$pdf->SetMargins(5, 5, 5); // Márgenes de 5mm
$pdf->SetAutoPageBreak(true, 5);

// ==========================================
// CABECERA CORPORATIVA
// ==========================================
$pdf->SetFont('Arial', 'B', 16);
$pdf->SetTextColor(0, 35, 102); // Azul Marino Luchanos
$pdf->Cell(62, 6, mb_convert_encoding("LUCHANOS CORP", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

$pdf->SetFont('Arial', '', 7);
$pdf->SetTextColor(100, 100, 100); // Gris elegante
$pdf->Cell(70, 3, mb_convert_encoding("TU COMODIDAD ES NUESTRA MISIÓN", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
$pdf->Ln(3);

// ==========================================
// BLOQUE DEL FOLIO (Fondo Azul)
// ==========================================
$pdf->SetFillColor(0, 35, 102); // Fondo Azul Marino
$pdf->SetTextColor(255, 255, 255); // Texto Blanco
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 7, mb_convert_encoding("TICKET DE VENTA #" . str_pad($venta['no_referencia'], 5, "0", STR_PAD_LEFT), 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', true);
$pdf->Ln(3);

// ==========================================
// DATOS DE LA VENTA (Alineados)
// ==========================================
$pdf->SetTextColor(60, 60, 60); // Gris oscuro para lectura
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(13, 4, "Fecha:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(25, 4, date("d/m/Y", strtotime($venta['fechayhora'])), 0, 0, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(12, 4, "Hora:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 4, date("H:i:s", strtotime($venta['fechayhora'])), 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(13, 4, "Cliente:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);

// Truncar el nombre si es muy largo para que no rompa el diseño
$nomCliCorto = strlen($nomCli) > 26 ? substr($nomCli, 0, 24) . "..." : $nomCli;
$pdf->Cell(57, 4, mb_convert_encoding(strtoupper($nomCliCorto), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');

$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(13, 4, "Pago:", 0, 0, 'L');
$pdf->SetFont('Arial', '', 8);
$pdf->Cell(57, 4, mb_convert_encoding(strtoupper($venta['tipo_pago']), 'ISO-8859-1', 'UTF-8'), 0, 1, 'L');
$pdf->Ln(2);

// ==========================================
// ENCABEZADOS DE LA TABLA
// ==========================================
// Línea superior sólida
$pdf->SetDrawColor(0, 35, 102); 
$pdf->SetLineWidth(0.4);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(1);

$pdf->SetTextColor(0, 35, 102); // Títulos en azul
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(10, 5, mb_convert_encoding("CANT", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
$pdf->Cell(38, 5, mb_convert_encoding("PRODUCTO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
$pdf->Cell(22, 5, mb_convert_encoding("SUBTOTAL", 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');

// Línea inferior sólida
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->SetLineWidth(0.2); // Restaurar grosor de línea
$pdf->Ln(1);

// ==========================================
// LISTA DE PRODUCTOS
// ==========================================
$pdf->SetTextColor(40, 40, 40); // Texto negro suave
$pdf->SetFont('Arial', '', 7);

$detalles = $pedidoControlador->getPedido()->buscar('"Veracruz".detallepedido dp', [
    "select" => "dp.*, prod.nombre as prod_nom",
    "join"   => 'JOIN "Veracruz".producto_detalle_pedido pdp ON dp.no_referencia_detalle = pdp.no_referencia_detalle 
                 JOIN "Veracruz".producto prod ON pdp.no_producto = prod.no_producto',
    "where"  => "dp.no_referencia = " . intval($folio_ticket)
]);

foreach ($detalles as $d) {
    $subtotalTabla = $d['cantidad'] * $d['precio_venta'];
    
    // Recorte inteligente de productos
    $nombreProducto = mb_convert_encoding($d['prod_nom'], 'ISO-8859-1', 'UTF-8');
    
    if (strlen($nombreProducto) > 23) {
        $nombreProducto = substr($nombreProducto, 0, 21) . "...";
    }

    $pdf->Cell(10, 5, $d['cantidad'], 0, 0, 'C');
    $pdf->Cell(38, 5, $nombreProducto, 0, 0, 'L');
    $pdf->Cell(22, 5, "$" . number_format($subtotalTabla, 2), 0, 1, 'R');
}
$pdf->Ln(2);

// ==========================================
// TOTALES
// ==========================================
// Línea divisoria gris claro
$pdf->SetDrawColor(200, 200, 200);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(2);

$totalFinal = $venta['total'];
$subtotalIva = $totalFinal / 1.16;
$ivaCalculado = $totalFinal - $subtotalIva;

// Cálculos de pago y cambio
$montoPagado = $venta['pagado'];
$cambio = $montoPagado - $totalFinal;
$cambio = ($cambio < 0) ? 0 : $cambio; // Validar que no sea negativo

$pdf->SetFont('Arial', '', 8);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(45, 4, "SUBTOTAL NETO:", 0, 0, 'R');
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(25, 4, "$" . number_format($subtotalIva, 2), 0, 1, 'R');

$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(45, 4, "I.V.A. (16%):", 0, 0, 'R');
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(25, 4, "$" . number_format($ivaCalculado, 2), 0, 1, 'R');

$pdf->Ln(2);

// El gran TOTAL resaltado
$pdf->SetFont('Arial', 'B', 13);
$pdf->SetTextColor(0, 35, 102); // Azul Marino
$pdf->Cell(40, 7, "TOTAL:", 0, 0, 'R');
$pdf->Cell(30, 7, "$" . number_format($totalFinal, 2), 0, 1, 'R');
$pdf->Ln(1);

// AGREGADO: PAGO Y CAMBIO
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(45, 5, "SU PAGO:", 0, 0, 'R');
$pdf->SetTextColor(50, 50, 50);
$pdf->Cell(25, 5, "$" . number_format($montoPagado, 2), 0, 1, 'R');

$pdf->SetFont('Arial', 'B', 9);
$pdf->SetTextColor(0, 35, 102); // Azul Marino para el cambio
$pdf->Cell(45, 5, "CAMBIO:", 0, 0, 'R');
$pdf->Cell(25, 5, "$" . number_format($cambio, 2), 0, 1, 'R');

$pdf->Ln(2);

// ==========================================
// PIE DE TICKET Y SEGURIDAD
// ==========================================
// Línea de cierre azul gruesa
$pdf->SetDrawColor(0, 35, 102);
$pdf->SetLineWidth(0.6);
$pdf->Line(5, $pdf->GetY(), 75, $pdf->GetY());
$pdf->Ln(4);

$pdf->SetFont('Arial', 'I', 8);
$pdf->SetTextColor(0, 35, 102);
$pdf->Cell(70, 4, mb_convert_encoding("¡Gracias por su preferencia!", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

$pdf->Ln(4);
$pdf->SetFont('Arial', 'B', 6);
$pdf->SetTextColor(150, 150, 150);
$hash = strtoupper(sha1($venta['no_referencia'] . $venta['fechayhora']));
$pdf->Cell(70, 3, "CERTIFICADO DE OPERACION:", 0, 1, 'C');
$pdf->SetFont('Arial', '', 6);
$pdf->Cell(70, 3, substr($hash, 0, 8) . "-" . substr($hash, 8, 8) . "-" . substr($hash, 16, 8), 0, 1, 'C');

// Salida del archivo PDF
$nombreArchivo = 'Ticket_' . str_pad($venta['no_referencia'], 5, "0", STR_PAD_LEFT) . '.pdf';
$pdf->Output('I', $nombreArchivo);