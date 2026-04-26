<?php
require('../ProyectoWeb/pdf/fpdf.php');

$compraControlador = new CompraControlador(); 
$comprasFiltradas = $compraControlador->getCompra()->obtenerComprasAdminFiltradas($fDesde, $fHasta, $fProveedor, $fCantMin, $fCantMax, $fPrecioMin, $fPrecioMax);

class PDF extends FPDF {
    public $filtrosText = "";

    function RoundedRect($x, $y, $w, $h, $r, $style = '') {
        $k = $this->k; $hp = $this->h;
        if($style=='F') $op='f'; elseif($style=='FD' || $style=='DF') $op='B'; else $op='S';
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
        $this->SetFillColor(0, 35, 102); 
        $this->Rect(0, 0, 210, 50, 'F');
        $this->SetFillColor(0, 55, 160);
        $this->Rect(0, 48, 210, 2, 'F');

        $this->SetY(12);
        $this->SetFont('Arial', 'B', 22);
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 10, mb_convert_encoding("LUCHANOS CORP", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
        $this->SetFont('Arial', '', 10);
        $this->SetTextColor(200, 200, 200);
        $this->Cell(0, 5, mb_convert_encoding("REPORTE GERENCIAL DE COMPRAS", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
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

$txtDesde = $fDesde ? date('d/m/Y', strtotime($fDesde)) : 'Inicio';
$txtHasta = $fHasta ? date('d/m/Y', strtotime($fHasta)) : 'Hoy';

$strFiltros = "";
$strFiltros .= "Fechas: " . $txtDesde . " a " . $txtHasta . " | ";
$strFiltros .= "Proveedor: " . ($fProveedor ?: 'Todos') . " | ";
if($fCantMin || $fCantMax) $strFiltros .= "Cant: " . ($fCantMin ?: '0') . "-" . ($fCantMax ?: 'Max') . " | ";
if($fPrecioMin || $fPrecioMax) $strFiltros .= "Monto: $" . ($fPrecioMin ?: '0') . "-$" . ($fPrecioMax ?: 'Max');

$pdf->filtrosText = trim($strFiltros, " | ");

if (empty($comprasFiltradas)) {
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(0, 50, mb_convert_encoding("No se encontraron compras con los filtros seleccionados.", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->Output('I', 'Reporte_Compras_Admin.pdf');
    exit;
}

foreach ($comprasFiltradas as $c) {
    $pdf->AddPage();
    $pdf->SetMargins(15, 20, 15);
    
    $pdf->SetFillColor(250, 251, 253);
    $pdf->RoundedRect(15, 55, 180, 28, 2, 'F');
    $pdf->SetFillColor(0, 35, 102);
    $pdf->Rect(15, 55, 2, 28, 'F');
    
    $pdf->SetY(58);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(100, 100, 100);
    $pdf->Cell(90, 6, mb_convert_encoding("  PROVEEDOR", 'ISO-8859-1', 'UTF-8'), 0, 0);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->Cell(90, 6, mb_convert_encoding("ORDEN DE COMPRA #" . str_pad($c['foliocompra'], 5, "0", STR_PAD_LEFT) . "  ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetTextColor(40, 40, 40);
    $datos_prov = $emp->getEmpleado()->buscar('"Veracruz".empleado',["where"=>"rfc='".$c['rfc_proveedor']."'"]);
    $pdf->Cell(90, 7, mb_convert_encoding( " ".$datos_prov[0]['nombre']." ".$datos_prov[0]['apellidospama']." (". mb_strtoupper($c['rfc_proveedor']).")", 'ISO-8859-1', 'UTF-8'), 0, 0);
    
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(90, 7, mb_convert_encoding("Fecha de Orden: " . date("d/m/Y H:i", strtotime($c['fechayhora'])) . "  ", 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(90, 6, "", 0, 0); // Espacio en blanco para cuadrar altura
    
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->SetTextColor(0, 100, 0); 
    
    $nombreEmp = !empty($c['emp_nombre']) ? $c['emp_nombre'] . " " . $c['emp_apellidos'] : "Desconocido";
    $txtEmpleado = "Registrado por: " . mb_strtoupper($nombreEmp) . " (RFC: " . $c['rfc_empleado'] . ")  ";
    
    $pdf->Cell(90, 6, mb_convert_encoding($txtEmpleado, 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');
    
    $pdf->Ln(15);

    $pdf->SetFillColor(0, 35, 102);
    $pdf->SetTextColor(255, 255, 255);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(100, 9, mb_convert_encoding(" DESCRIPCIÓN DEL ARTÍCULO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);
    $pdf->Cell(20, 9, mb_convert_encoding("CANT.", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
    $pdf->Cell(30, 9, mb_convert_encoding("P. UNITARIO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
    $pdf->Cell(30, 9, mb_convert_encoding("SUBTOTAL", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', true);

    $pdf->SetFont('Arial', '', 9);
    $pdf->SetTextColor(50, 50, 50);
    
    $detalles = $compraControlador->getCompra()->buscar('"Veracruz".detallecompra dc', [
        "select" => "dc.*, prod.nombre as prod_nom",
        "join"   => 'JOIN "Veracruz".producto_detalle_compra pdc ON dc.folio_compra_detalle = pdc.folio_compra_detalle 
                     JOIN "Veracruz".producto prod ON pdc.no_producto = prod.no_producto',
        "where"  => "dc.foliocompra = " . $c['foliocompra']
    ]);

    $fill = false;
    foreach ($detalles as $d) {
        $pdf->SetFillColor(248, 249, 252);
        $subtotalTabla = $d['cantidad'] * $d['precio_compra'];

        $pdf->Cell(100, 8, mb_convert_encoding(" " . $d['prod_nom'], 'ISO-8859-1', 'UTF-8'), 'B', 0, 'L', $fill);
        $pdf->Cell(20, 8, $d['cantidad'], 'B', 0, 'C', $fill);
        $pdf->Cell(30, 8, "$" . number_format($d['precio_compra'], 2), 'B', 0, 'R', $fill);
        $pdf->Cell(30, 8, "$" . number_format($subtotalTabla, 2), 'B', 1, 'R', $fill);
        $fill = !$fill;
    }

    $pdf->Ln(7);
    $totalFinal = $c['total_compra']; 
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
    
    $pdf->Cell(130, 2, "", 0, 0);
    $pdf->Cell(50, 2, "", 'T', 1);

    $pdf->Cell(130, 8, "", 0, 0);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->SetFont('Arial', 'B', 13);
    $pdf->Cell(30, 8, "TOTAL:", 0, 0, 'L');
    $pdf->Cell(20, 8, "$" . number_format($totalFinal, 2), 0, 1, 'R');
    
    $pdf->SetY(-40);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(0, 35, 102);
    $pdf->Cell(0, 5, mb_convert_encoding("AUDITORÍA DE TRANSACCIÓN", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
    $pdf->SetFont('Arial', '', 7);
    $pdf->SetTextColor(150, 150, 150);
    $hash = strtoupper(sha1($c['foliocompra'] . $c['fechayhora'] . $c['rfc_empleado'] . $c['rfc_proveedor']));
    $pdf->Cell(0, 4, "" . substr($hash, 0, 8) . "-" . substr($hash, 8, 8) . "-" . substr($hash, 16, 8), 0, 1, 'C');
}

$pdf->Output('I', 'Reporte_Compras_Admin_Luchanos_Corp.pdf');