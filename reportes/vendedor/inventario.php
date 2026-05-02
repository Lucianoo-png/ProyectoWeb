<?php
require('../ProyectoWeb/pdf/fpdf.php');

$prodControlador = new ProductoControlador(); 

// 1. Traemos TODOS los productos primero (sin filtrar por SQL)
$todosLosProductos = $prodControlador->getProducto()->buscar('"Veracruz".producto', [
    "select" => "*",
    "order"  => "nombre ASC"
]);

$productosFiltrados = [];
$fTermino = isset($fTermino) ? trim($fTermino) : '';
$terminoBusqueda = mb_strtolower($fTermino, 'UTF-8');

// 2. Filtramos con PHP exactamente igual que tu JavaScript
foreach ($todosLosProductos as $p) {
    $nombre = $p['nombre'];
    $categoria = isset($p['categoria']) ? $p['categoria'] : 'Genérica';
    
    // Generamos el SKU con tu Helper para que coincida 100% con la vista
    $sku = Helpers::crearSKU($categoria, $nombre);
    
    // Unimos SKU y Descripción (igual que el const txtSearch de tu JS)
    $textoCombinado = mb_strtolower($sku . " " . $nombre, 'UTF-8');

    // Si no hay filtro, o si el término coincide en el SKU o en el Nombre
    if (empty($terminoBusqueda) || strpos($textoCombinado, $terminoBusqueda) !== false) {
        $p['sku_generado'] = $sku; // Lo guardamos para no volver a calcularlo en el PDF
        $productosFiltrados[] = $p;
    }
}

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
        // Cabecera Moderna (Estilo Luchanos Corp)
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
        $this->Cell(0, 5, mb_convert_encoding("REPORTE GLOBAL DE EXISTENCIAS", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
        
        // Tag de Filtros Pro
        $this->SetY(33);
        $this->SetFillColor(255, 255, 255);
        $this->RoundedRect(30, 32, 150, 8, 4, 'F');
        $this->SetFont('Arial', 'B', 7);
        $this->SetTextColor(0, 35, 102);
        $this->SetXY(30, 32);
        $this->Cell(150, 8, mb_convert_encoding("FILTRO DE BÚSQUEDA: " . strtoupper($this->filtrosText), 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        
        $this->Ln(20);

        // ENCABEZADOS DE LA TABLA (Van aquí para que se repitan si hay más de 1 página)
        $this->SetFillColor(0, 35, 102);
        $this->SetTextColor(255, 255, 255);
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(35, 9, mb_convert_encoding("SKU", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
        $this->Cell(95, 9, mb_convert_encoding("DESCRIPCIÓN DEL ARTÍCULO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'L', true);
        $this->Cell(18, 9, mb_convert_encoding("STOCK", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
        $this->Cell(18, 9, mb_convert_encoding("MÍNIMO", 'ISO-8859-1', 'UTF-8'), 0, 0, 'C', true);
        $this->Cell(24, 9, mb_convert_encoding("ESTADO", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C', true);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->SetTextColor(150, 150, 150);
        $this->Cell(0, 10, mb_convert_encoding("Luchanos Corp ERP - Reporte de Inventario - Generado el " . date('d/m/Y H:i'), 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->SetFont('Arial', 'B', 8);
        $this->Cell(0, 10, mb_convert_encoding("Pág. ", 'ISO-8859-1', 'UTF-8') . $this->PageNo() . ' de {nb}', 0, 0, 'R');
    }
}

if (ob_get_contents()) ob_end_clean();
ob_start();

$pdf = new PDF();
$pdf->AliasNbPages();

// Texto para el banner
$pdf->filtrosText = !empty($fTermino) ? $fTermino : "MOSTRANDO TODO EL CATÁLOGO";

$pdf->AddPage();
$pdf->SetMargins(10, 20, 10);

$pdf->SetFont('Arial', '', 8);
$fill = false;

if (empty($productosFiltrados)) {
            $pdf->SetFont('Arial', 'B', 14);
            $pdf->SetTextColor(100, 100, 100);
            $pdf->Cell(0, 50, mb_convert_encoding("No se encontraron productos con los filtros seleccionados.", 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');
            $pdf->Output('I', 'Reporte_Inventario_LuchanosCorp.pdf');
            exit;
        }
// CUERPO DE LA TABLA (Lista continua)
foreach ($productosFiltrados as $p) {
    $pdf->SetFillColor(248, 249, 252); // Fondo cebra
    $pdf->SetTextColor(40, 40, 40);
    
    // Preparar variables igual que en tu vista
    $nombre = $p['nombre'];
    $categoria = isset($p['categoria']) ? $p['categoria'] : 'GEN';
    $stock = (int)$p['stock'];
    $minimo = (int)$p['stockminimo'];
    
    $sku = $p['sku_generado'];
    
    // Lógica de Estados (Agotado, Bajo, Normal)
    if ($stock === 0) {
        $estado = "AGOTADO";
        $colorStock = [220, 53, 69]; // Rojo
    } else if ($stock < $minimo) {
        $estado = "BAJO STOCK";
        $colorStock = [217, 119, 6]; // Naranja
    } else {
        $estado = "DISPONIBLE";
        $colorStock = [6, 95, 70]; // Verde oscuro
    }

    // Impresión de Celdas
    $pdf->SetFont('Arial', '', 8);
    $pdf->SetTextColor(150, 50, 100); // Color del SKU tipo magenta oscuro como tu código
    $pdf->Cell(35, 8, mb_convert_encoding(strtoupper($sku), 'ISO-8859-1', 'UTF-8'), 'B', 0, 'C', $fill);
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor(40, 40, 40);
    // Cortamos el nombre si es muy largo para que no rompa la tabla
    $nombreCorto = strlen($nombre) > 48 ? substr($nombre, 0, 45) . "..." : $nombre;
    $pdf->Cell(95, 8, mb_convert_encoding(" " . strtoupper($nombreCorto), 'ISO-8859-1', 'UTF-8'), 'B', 0, 'L', $fill);
    
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->SetTextColor($colorStock[0], $colorStock[1], $colorStock[2]);
    $pdf->Cell(18, 8, $stock, 'B', 0, 'C', $fill);
    
    $pdf->SetTextColor(40, 40, 40);
    $pdf->SetFont('Arial', '', 8);
    $pdf->Cell(18, 8, $minimo, 'B', 0, 'C', $fill);
    
    $pdf->SetFont('Arial', 'B', 7);
    $pdf->SetTextColor($colorStock[0], $colorStock[1], $colorStock[2]);
    $pdf->Cell(24, 8, mb_convert_encoding($estado, 'ISO-8859-1', 'UTF-8'), 'B', 1, 'C', $fill);
    
    $fill = !$fill;
}

// Resumen final al terminar la tabla
$pdf->Ln(5);
$pdf->SetFont('Arial', 'I', 8);
$pdf->SetTextColor(100, 100, 100);
$pdf->Cell(0, 5, mb_convert_encoding("Total de registros mostrados: " . count($productosFiltrados), 'ISO-8859-1', 'UTF-8'), 0, 1, 'C');

$pdf->Output('I', 'Reporte_Inventario_LuchanosCorp.pdf');