<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Detalle de Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>
<?php
$productos = [
    'WM3911D' => [
        'No_Producto' => 'WM3911D',
        'Nombre'      => 'Microondas de mesa con función AirFry y 4 modos en 1',
        'Descripcion' => 'Microondas de mesa de 1.1 pies cúbicos con función AirFry integrada y 4 modos de cocción: microondas, convección, grill y combinado. Pantalla digital con presets automáticos para los platillos más comunes.',
        'Precio_Venta' => 4599.00, 'Alto' => 34.3, 'Ancho' => 55.9,
        'Imagen'  => '../../multimedia/Imagenes/productos/microondas-wm3911d.jpg',
        'Manual'  => '../../multimedia/Manuales/microondas-wm3911d.pdf',
        'Categoria' => 'cocina',
    ],
    '8MWTW2024WJM' => [
        'No_Producto' => '8MWTW2024WJM',
        'Nombre'      => 'Lavadora 20kg Carga Superior Xpert System Blanca Agitador',
        'Descripcion' => 'Lavadora de carga superior de 20 kg con sistema Xpert que se adapta a tus cargas. Motor de alta eficiencia, 12 ciclos de lavado y tecnología de agua caliente integrada para una limpieza profunda.',
        'Precio_Venta' => 9999.00, 'Alto' => 105.0, 'Ancho' => 68.0,
        'Imagen'  => '../../multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg',
        'Manual'  => '../../multimedia/Manuales/lavadora-8mwtw2024wjm.pdf',
        'Categoria' => 'blanca',
    ],
    'WK0260B' => [
        'No_Producto' => 'WK0260B',
        'Nombre'      => 'Despachador de agua con fábrica de hielo',
        'Descripcion' => 'Despachador de agua tipo botellón con fábrica de hielo integrada. Produce hasta 12 kg de hielo al día, dispensador de agua fría, caliente y temperatura natural. Acabado negro mate moderno.',
        'Precio_Venta' => 7999.00, 'Alto' => 108.0, 'Ancho' => 35.0,
        'Imagen'  => '../../multimedia/Imagenes/productos/despachador-wk0260b.jpg',
        'Manual'  => '../../multimedia/Manuales/despachador-wk0260b.pdf',
        'Categoria' => 'blanca',
    ],
    'WRS315SNHM' => [
        'No_Producto' => 'WRS315SNHM',
        'Nombre'      => 'Refrigerador Side by Side 25 pies con despachador de agua y hielo',
        'Descripcion' => 'Refrigerador side by side de 25 pies cúbicos con despachador externo de agua y hielo en puerta. Tecnología In-Door-Ice para maximizar el espacio interior, iluminación LED y control de temperatura digital.',
        'Precio_Venta' => 22499.00, 'Alto' => 174.0, 'Ancho' => 83.8,
        'Imagen'  => '../../multimedia/Imagenes/productos/refrigerador-wrs315snhm.jpg',
        'Manual'  => '../../multimedia/Manuales/refrigerador-wrs315snhm.pdf',
        'Categoria' => 'blanca',
    ],
    'MGH765RDS' => [
        'No_Producto' => 'MGH765RDS',
        'Nombre'      => 'Estufa de gas 6 quemadores con horno convección acero inoxidable',
        'Descripcion' => 'Estufa de 30" color negro acero porcelanizado con seis quemadores y tres parrillas con encendido eléctrico, sistema de seguridad push & turn, horno con capacidad de 5.1 pies cúbicos y ventana panorámica semi ahumada.',
        'Precio_Venta' => 9799.00, 'Alto' => 92.0, 'Ancho' => 76.0,
        'Imagen'  => '../../multimedia/Imagenes/productos/estufa-mgh765rds.jpg',
        'Manual'  => '../../multimedia/Manuales/estufa-mgh765rds.pdf',
        'Categoria' => 'cocina',
    ],
    'WED5000DW' => [
        'No_Producto' => 'WED5000DW',
        'Nombre'      => 'Secadora eléctrica de carga frontal 7.0 pies cúbicos blanca',
        'Descripcion' => 'Secadora eléctrica de carga frontal con capacidad de 7.0 pies cúbicos. 12 ciclos de secado, sensor de humedad automático para evitar el sobre-secado y tambor iluminado para cargas fáciles.',
        'Precio_Venta' => 7899.00, 'Alto' => 109.2, 'Ancho' => 71.1,
        'Imagen'  => '../../multimedia/Imagenes/productos/secadora-wed5000dw.jpg',
        'Manual'  => '../../multimedia/Manuales/secadora-wed5000dw.pdf',
        'Categoria' => 'blanca',
    ],
    'WDF520PADM' => [
        'No_Producto' => 'WDF520PADM',
        'Nombre'      => 'Lavavajillas empotrable 24" con ciclo de alta temperatura acero inox',
        'Descripcion' => 'Lavavajillas empotrable de 24" con ciclo de alta temperatura para eliminar bacterias. Capacidad para 14 cubiertos, 5 ciclos de lavado, tecnología de agua caliente y acabado acero inoxidable resistente a huellas.',
        'Precio_Venta' => 7299.00, 'Alto' => 85.8, 'Ancho' => 60.3,
        'Imagen'  => '../../multimedia/Imagenes/productos/lavavajillas-wdf520padm.jpg',
        'Manual'  => '../../multimedia/Manuales/lavavajillas-wdf520padm.pdf',
        'Categoria' => 'cocina',
    ],
    'WQ09X' => [
        'No_Producto' => 'WQ09X',
        'Nombre'      => 'Frigobar 9 pies con congelador y acabado acero inoxidable',
        'Descripcion' => 'Frigobar de 9 pies cúbicos con sección congelador independiente. Iluminación LED interior, estantes ajustables de vidrio templado y sistema de enfriamiento silencioso. Ideal para recámaras o espacios pequeños.',
        'Precio_Venta' => 4499.00, 'Alto' => 134.0, 'Ancho' => 55.0,
        'Imagen'  => '../../multimedia/Imagenes/productos/frigobar-wq09x.jpg',
        'Manual'  => '../../multimedia/Manuales/frigobar-wq09x.pdf',
        'Categoria' => 'blanca',
    ],
];

$sku = isset($_GET['sku']) ? strtoupper(trim($_GET['sku'])) : 'WM3911D';
$p   = $productos[$sku] ?? $productos['WM3911D'];

$cat_labels = ['blanca' => 'Línea Blanca', 'marron' => 'Línea Marrón', 'cocina' => 'Cocina'];
$cat_label  = $cat_labels[$p['Categoria']] ?? ucfirst($p['Categoria']);
$cat_file   = ['blanca' => 'linea_blanca.php', 'marron' => 'linea_marron.php', 'cocina' => 'cocina.php'][$p['Categoria']] ?? 'index.php';

// Variable que leerá scripts.js para el carrito
$prod_js = json_encode([
    'sku'      => $p['No_Producto'],
    'nombre'   => $p['Nombre'],
    'precio'   => $p['Precio_Venta'],
    'imagen'   => $p['Imagen'],
    'categoria'=> $cat_label,
]);
?>

<!-- ─── Topbar ─────────────────────────────────────────────── -->
 <div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="../rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
            <a href="#" class="topbar-link-muted">Ayuda</a>
        </div>
    </div>
</div>

<!-- ─── Navbar ─────────────────────────────────────────────── -->
<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="carrito.php" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="../Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<!-- ─── Breadcrumb ─────────────────────────────────────────── -->
<div class="bg-white border-bottom py-2">
    <div class="container">
        <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
            <li class="breadcrumb-item">
                <a href="../../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
            </li>
            <li class="breadcrumb-item">
                <a href="<?= htmlspecialchars($cat_file) ?>" class="text-decoration-none" style="color:var(--btn-color)">
                    <?= htmlspecialchars($cat_label) ?>
                </a>
            </li>
            <li class="breadcrumb-item active text-muted"><?= htmlspecialchars($p['No_Producto']) ?></li>
        </ol></nav>
    </div>
</div>

<!-- ─── Contenido principal ────────────────────────────────── -->
<main class="py-4">
    <div class="container">
        <div class="row g-4">

            <!-- Imagen -->
            <div class="col-lg-5">
                <div class="detail-img-card">
                    <img src="<?= htmlspecialchars($p['Imagen']) ?>"
                         alt="<?= htmlspecialchars($p['Nombre']) ?>"
                         class="detail-main-img"
                         onerror="this.src='https://placehold.co/500x500?text=Producto'">
                </div>
            </div>

            <!-- Info -->
            <div class="col-lg-4">
                <p class="detail-marca"><?= htmlspecialchars($cat_label) ?></p>
                <h1 class="detail-title"><?= htmlspecialchars($p['Nombre']) ?></h1>
                <p class="detail-sku text-muted small">
                    Código de producto (SKU): <?= htmlspecialchars($p['No_Producto']) ?>
                </p>
                <hr class="my-3">
                <p class="fw-semibold mb-2" style="font-size:.9rem">Cantidad:</p>
                <div class="qty-control mb-2">
                    <button class="qty-btn" onclick="cambiarCantidad(-1)"><i class="fas fa-minus"></i></button>
                    <input type="number" id="cantidad" class="qty-input" value="1" min="1" max="99" readonly>
                    <button class="qty-btn" onclick="cambiarCantidad(1)"><i class="fas fa-plus"></i></button>
                </div>
                <p class="detail-disponible">
                    <i class="fas fa-check-circle me-1" style="color:#28a745"></i> Disponible
                </p>
                <hr class="my-3">
                <?php if (!empty($p['Manual'])): ?>
                <a href="<?= htmlspecialchars($p['Manual']) ?>" target="_blank"
                   class="d-inline-flex align-items-center gap-2 text-decoration-none"
                   style="font-size:.85rem; color:var(--btn-color)">
                    <i class="fas fa-file-pdf"></i> Descargar manual de usuario
                </a>
                <?php endif; ?>
            </div>

            <!-- Caja de compra -->
            <div class="col-lg-3">
                <div class="detail-buy-box">
                    <span class="detail-price">$<?= number_format($p['Precio_Venta'], 2) ?></span>
                    <p class="text-muted small mb-3 mt-1">IVA incluido</p>
                    <hr class="my-3">
                    <div class="detail-envio-box mb-3">
                        <i class="fas fa-truck me-2" style="color:var(--btn-color)"></i>
                    </div>
                    <!-- onclick llama a agregarAlCarrito() definido en scripts.js -->
                    <button onclick="agregarAlCarrito()" class="btn-agregar-carrito w-100">
                        <i class="fas fa-shopping-cart me-2"></i> Agregar al carrito
                    </button>
                    <hr class="my-3">
                    <div class="row text-center g-2 mt-1">
                        <div class="col-4"><div class="detail-garantia">
                            <i class="fas fa-undo-alt"></i><p>30 días para devoluciones</p>
                        </div></div>
                        <div class="col-4"><div class="detail-garantia">
                            <i class="fas fa-shield-alt"></i><p>Desde 90 días de garantía</p>
                        </div></div>
                        <div class="col-4"><div class="detail-garantia">
                            <i class="fas fa-lock"></i><p>Tu compra es segura</p>
                        </div></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Descripción y especificaciones -->
        <div class="row mt-5">
            <div class="col-12">
                <h5 class="fw-bold mb-1" style="color:var(--dark-blue)">Descripción y especificaciones</h5>
                <hr style="border-color:var(--btn-color); border-width:2px; opacity:1; width:240px; margin-top:4px">
            </div>
        </div>
        <div class="row g-4 mt-1 mb-5">
            <div class="col-lg-7">
                <h6 class="fw-bold mb-3" style="color:var(--dark-blue)">Descripción</h6>
                <p class="text-muted" style="font-size:.9rem; line-height:1.8">
                    <?= nl2br(htmlspecialchars($p['Descripcion'])) ?>
                </p>
                <p class="text-muted mt-3" style="font-size:.78rem; font-style:italic">
                    *Los abonos quincenales, el plazo del crédito y el pago inicial, pueden variar según el margen de crédito y el historial de pago de cada cliente.
                </p>
            </div>
            <div class="col-lg-5">
                <h6 class="fw-bold mb-3" style="color:var(--dark-blue)">Especificaciones</h6>
                <table class="table table-sm detail-specs-table">
                    <tbody>
                        <tr>
                            <td class="spec-key">No. Producto</td>
                            <td class="spec-val"><?= htmlspecialchars($p['No_Producto']) ?></td>
                        </tr>
                        <tr>
                            <td class="spec-key">Medidas (Alto x Ancho)</td>
                            <td class="spec-val"><?= number_format($p['Alto'],1) ?> x <?= number_format($p['Ancho'],1) ?> cm</td>
                        </tr>
                        <tr>
                            <td class="spec-key">Categoría</td>
                            <td class="spec-val"><?= htmlspecialchars($cat_label) ?></td>
                        </tr>
                        <?php if (!empty($p['Manual'])): ?>
                        <tr>
                            <td class="spec-key">Manual</td>
                            <td class="spec-val">
                                <a href="<?= htmlspecialchars($p['Manual']) ?>" target="_blank"
                                   style="color:var(--btn-color); text-decoration:none">
                                    <i class="fas fa-file-pdf me-1"></i> Ver manual
                                </a>
                            </td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- ─── Modal: producto agregado ───────────────────────────── -->
<div id="modal-agregado">
    <div class="modal-agregado-card">
        <div class="modal-agregado-header">
            <span><i class="fas fa-check-circle me-1"></i> Producto agregado al carrito</span>
            <button onclick="cerrarModal()" title="Cerrar">&times;</button>
        </div>
        <div class="modal-agregado-body">
            <img id="modal-img" src="" alt="" class="modal-agregado-img"
                 onerror="this.src='https://placehold.co/88x88?text=Producto'">
            <div class="modal-agregado-info">
                <div class="prod-name"  id="modal-nombre"></div>
                <div class="prod-sku"   id="modal-sku"></div>
                <div class="prod-price" id="modal-precio"></div>
            </div>
        </div>
        <div class="modal-agregado-footer">
            <a href="carrito.php" class="btn-ver-carro">
                <i class="fas fa-shopping-cart me-1"></i> Ver carrito
            </a>
            <button class="btn-seguir-comprando" onclick="cerrarModal()">
                <i class="fas fa-check"></i> Seguir comprando
            </button>
        </div>
    </div>
</div>

<footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

<!-- PRODUCTO debe estar ANTES de scripts.js para que agregarAlCarrito() lo lea -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>const PRODUCTO = <?= $prod_js ?>;</script>
<script src="../../js/scripts.js"></script>
</body>
</html>