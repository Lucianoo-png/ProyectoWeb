<?php
require('../ProyectoWeb/pdf/fpdf.php');

$pedido = new PedidoControlador();
$ventasFiltradas = $pedido->getPedido()->obtenerVentasAdminFiltradas($fDesde, $fHasta, $fVendedor, $fPago, $fCantMin, $fCantMax, $fPrecioMin, $fPrecioMax);

class PDF extends FPDF {
    public $filtrosText = "";

    function RoundedRect($x, $y, $w, $h, $r, $style = '') {
        $k = $this->k;
        $hp = $this->h;
        if($style=='F') $op='f';
        elseif($style=='FD' || $style=='DF') $op='B';
        else $op='S';
        $MyArc = 4/3 * (sqrt(2) - 1);
        $this->_out(sprintf('%.2F %.2F m',($x+$r)*$k,($hp-$y)*$k));
        $xc = $x+$w-$r ; $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l', $xc*$k,($hp-$y)*$k));
        $this->_Arc($xc + $r*$MyArc, $yc - $r, $xc + $r, $yc - $r*$MyArc, $xc + $r, $yc);
        $xc = $x+$w-$r ; $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',($x+$w)*$k,($hp-$yc)*$k));
        $this->_Arc($xc + $r, $yc + $r*$MyArc, $xc + $r*$MyArc, $yc + $r, $xc, $yc + $r);
        $xc = $x+$r ; $yc = $y+$h-$r;
        $this->_out(sprintf('%.2F %.2F l',$xc*$k,($hp-($y+$h))*$k));
        $this->_Arc($xc - $r*$MyArc, $yc + $r, $xc - $r, $yc + $r*$MyArc, $xc - $r, $yc);
        $xc = $x+$r ; $yc = $y+$r;
        $this->_out(sprintf('%.2F %.2F l',($x)*$k,($hp-$yc)*$k));
        $this->_Arc($xc - $r, $yc - $r*$MyArc, $xc - $r*$MyArc, $yc - $r, $xc, $yc - $r);
        $this->_out($op);
    }

    function _Arc($x1, $y1, $x2, $y2, $x3, $y3) {
        $h = $this->h;
        $this->_out(sprintf('%.2F %.2F %.2F %.2F %.2F %.2F c ', $x1*$this->k, ($h-$y1)*$this->k, $x2*$this->k, ($h-$y2)*$this->k, $x3*$this->k, ($h-$y3)*$this->k));
    }

    function Header() {
        // Cabecera Moderna
        $this->SetFillColor(0, 35, 102); 
        $this->Rect(0, 0, 210, 50, 'F');
        
        // Elemento decorativo (Línea de acento)
        $this->SetFillColor(0, 55, 160);
        $this->Rect(0, 48, 210, 2, 'F');

        $this->SetY(12);
        $this->SetFont('Arial', 'B', 22);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 10, mb_convert_encoding("LUCHANOS CORP", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(200, 200, 200);
        $this->Cell(0, 5, mb_convert_encoding("TU COMODIDAD ES NUESTRA MISIÓN", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
        // Tag de Filtros Pro
        $this->SetY(33);
        $this->SetFillColor(255, 255, 255);
        $this->RoundedRect(10, 32, 190, 8, 4, 'F');
        $this->SetFont('Arial', 'B', 7);
        $this->SetTextColor(0, 35, 102);
        $this->SetXY(10, 32);
        $this->Cell(190, 8, mb_convert_encoding("FILTROS ACTIVOS: " . strtoupper($this->filtrosText), 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        
        $this->Ln(25);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 10, mb_convert_encoding("Luchanos Corp ERP - Uso Exclusivo Administración - Generado el " . date('d/m/Y H:i'), 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 10, mb_convert_encoding("Pág. ", 'ISO-8859-1', 'UTF-8') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

if (ob_get_contents()) ob_end_clean();
ob_start();

$pdf = new PDF();
$pdf->AliasNbPages();

// Construcción limpia de la cadena de filtros
$txtDesde = $fDesde ? date('d/m/Y', strtotime($fDesde)) : 'Inicio';
$txtHasta = $fHasta ? date('d/m/Y', strtotime($fHasta)) : 'Hoy';

$strFiltros = "";
$strFiltros .= "Fechas: " . $txtDesde . " a " . $txtHasta . " | ";
$strFiltros .= "Vendedor: " . ($fVendedor ?: 'Todos') . " | ";
$strFiltros .= "Pago: " . ($fPago ?: 'Todos') . " | ";
if($fCantMin || $fCantMax) $strFiltros .= "Cant: " . ($fCantMin ?: '0') . "-" . ($fCantMax ?: 'Max') . " | ";
if($fPrecioMin || $fPrecioMax) $strFiltros .= "Monto: $" . ($fPrecioMin ?: '0') . "-$" . ($fPrecioMax ?: 'Max');

$pdf->filtrosText = trim($strFiltros, " | ");

// Validación por si no hay datos
if (empty($ventasFiltradas)) {
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(0, 50, mb_convert_encoding("No se encontraron ventas con los filtros seleccionados.", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Output('I', 'Reporte_Ventas_Admin.pdf');
    exit;
}

foreach ($ventasFiltradas as $v) {
    $pdf->AddPage();
    $pdf->SetMargins(15, 20, 15);
    
    // TARJETA DE INFORMACIÓN 
    $pdf->SetFillColor(250, 251, 253);
    $pdf->RoundedRect(15, 55, 180, 28, 2, 'F');
    $pdf->SetFillColor(0, 35, 102);
    $pdf->Rect(15, 55, 2, 28, 'F');
    
    $pdf->SetY(58);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(90, 6, mb_convert_encoding("  CLIENTE RECEPTOR", 'ISO-8859-1', 'UTF-8'), 0, 0);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->Cell(90, 6, mb_convert_encoding("PEDIDO REFERENCIA #" . str_pad($v['no_referencia'], 5, "0", STR_PAD_LEFT) . "  ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(40, 40, 40);
    if(empty($v['nombre_cliente'])){$datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente',["where"=>"no_cliente=".$v['no_cliente']]);}
    $nomCli = !empty($v['nombre_cliente']) ? $v['nombre_cliente'] : $datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'];
    $pdf->Cell(90, 7, mb_convert_encoding("  " . strtoupper($nomCli), 'ISO-8859-1', 'UTF-8'), 0, 0);
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(90, 7, mb_convert_encoding("Fecha de Registro: " . date("d/m/Y H:i", strtotime($v['fechayhora'])) . "  ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(90, 6, mb_convert_encoding("  Método de Pago: " . strtoupper($v['tipo_pago']), 'ISO-8859-1', 'UTF-8'), 0, 0);
    
    // INFO DEL VENDEDOR
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(0, 100, 0); 
    
    $nombreVend = !empty($v['vend_nombre']) ? $v['vend_nombre'] . " " . $v['vend_apellidos'] : "Desconocido";
    $txtVendedor = "Atendido por: " . strtoupper($nombreVend) . " (RFC: " . $v['rfc'] . ")  ";
    
    $pdf->Cell(90, 6, mb_convert_encoding($txtVendedor, 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->Ln(15);

    // TABLA PROFESIONAL
    $pdf->SetFillColor(0, 35, 102);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(100, 9, mb_convert_encoding(" DESCRIPCIÓN DEL ARTÍCULO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);
    $pdf->Cell(20, 9, mb_convert_encoding("CANT.", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
    $pdf->Cell(30, 9, mb_convert_encoding("P. UNITARIO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
    $pdf->Cell(30, 9, mb_convert_encoding("SUBTOTAL", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(50, 50, 50);
    
    // Consulta de detalles del pedido iterado
    $detalles = $pedido->getPedido()->buscar('"Veracruz".detallepedido dp', [
        "select" => "dp.*, prod.nombre as prod_nom",
        "join"   => 'JOIN "Veracruz".producto_detalle_pedido pdp ON dp.no_referencia_detalle = pdp.no_referencia_detalle 
                     JOIN "Veracruz".producto prod ON pdp.no_producto = prod.no_producto',
        "where"  => "dp.no_referencia = " . $v['no_referencia']
    ]);

    $fill = false;
    foreach ($detalles as $d) {
        $pdf->SetFillColor(248, 249, 252);
        $subtotalTabla = $d['cantidad'] * $d['precio_venta'];

        $pdf->Cell(100, 8, mb_convert_encoding(" " . $d['prod_nom'], 'ISO-8859-1', 'UTF-8'), 'B', 0, 'L', $fill);
        $pdf->Cell(20, 8, $d['cantidad'], 'B', 0, 'C', $fill);
        $pdf->Cell(30, 8, "$" . number_format($d['precio_venta'], 2), 'B', 0, 'R', $fill);
        $pdf->Cell(30, 8, "$" . number_format($subtotalTabla, 2), 'B', 1, 'R', $fill);
        $fill = !$fill;
    }

    // BLOQUE DE TOTALES
    $pdf->Ln(7);
    $totalFinal = $v['total'];
    $subtotalIva = $totalFinal / 1.16;
    $ivaCalculado = $totalFinal - $subtotalIva;

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(130, 6, "", 0, 0);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(30, 6, "SUBTOTAL NETO:", 0, 0, 'R');
    $pdf->SetTextColor(50, 50, 50);
    $pdf->Cell(20, 6, "$" . number_format($subtotalIva, 2), 0, 1, 'R');
    
    $pdf->Cell(130, 6, "", 0, 0);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(30, 6, "I.V.A. (16%):", 0, 0, 'R');
    $pdf->SetTextColor(50, 50, 50);
    $pdf->Cell(20, 6, "$" . number_format($ivaCalculado, 2), 0, 1, 'R');
    
    // Línea de cierre
    $pdf->Cell(130, 2, "", 0, 0);
    $pdf->Cell(50, 2, "", 'T', 1);

    $pdf->Cell(130, 8, "", 0, 0);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(30, 8, "TOTAL:", 0, 0, 'L');
    $pdf->Cell(20, 8, "$" . number_format($totalFinal, 2), 0, 1, 'R');
    
    // Pie de página de la tarjeta
    $pdf->SetY(-40);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->Cell(0, 5, mb_convert_encoding("AUDITORÍA DE TRANSACCIÓN", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetTextColor(150, 150, 150);
    $hash = strtoupper(sha1($v['no_referencia'] . $v['fechayhora'] . $v['rfc']));
    $pdf->Cell(0, 4, substr($hash, 0, 8) . "-" . substr($hash, 8, 8) . "-" . substr($hash, 16, 8), 0, 1, 'C');
}

$pdf->Output('I', 'Reporte_Ventas_Admin_Luchanos_Corp.pdf');