<?php

$productoControl = new ProductoControlador();

$resProd = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "no_producto = $id_producto AND estatus = 'true'"
]);

$p = $resProd[0];

$resColores = $productoControl->getProducto()->buscar('"Veracruz".productocolor', [
    "where" => "no_producto = $id_producto"
]);

$coloresHex = [
    'Negro'            => '#1a1a1a',
    'Blanco'           => '#f5f5f5',
    'Gris'             => '#9e9e9e',
    'Plata'            => '#C0C0C0',
    'Acero Inoxidable' => '#8D9093',
    'Grafito'          => '#3d3d3d',
    'Titanio'          => '#7a7a85',
    'Champagne'        => '#C9A96E',
    'Cobre'            => '#b87333',
    'Dorado'           => '#CFB53B',
    'Crema'            => '#F5F0E1',
    'Rojo'             => '#c62828',
    'Azul Marino'      => '#1a3a5c',
    'Verde Pizarra'    => '#4a6741',
];

$stockActual = intval($p['stock']);
$tieneStock  = ($stockActual > 0);
$maxStock    = $stockActual;

$cat_labels = [
    'blanca' => 'Línea Blanca', 
    'marron' => 'Línea Marrón', 
    'cocina' => 'Cocina',
    '65+'    => 'Televisores 65"+',
    '32a43'  => 'Televisores 32" a 43"',
    'soundbars' => 'Barras de Sonido',
    'bocinas' => 'Bocinas',
    'audifonos' => 'Audífonos',
    'sistemassonido' => 'Sistemas de Sonido',
    '4k' => 'Proyectores 4K',
    'HD' => 'Proyectores HD',
    'portatiles' => 'Proyectores Portátiles',
    'accesorios' => 'Accesorios Proyección',
    'consolas' => 'Consolas de Videojuegos',
    'controles' => 'Controles',
    'sillagamer' => 'Sillas Gamer',
    'accesoriosgaming' => 'Accesorios Gaming'
];
$cat_label = $cat_labels[$p['categoria']] ?? ucfirst($p['categoria']);

$sku_visual = Helpers::crearSKU($p['categoria'], $p['nombre']);

$prod_js = json_encode([
    'id'        => $p['no_producto'],
    'nombre'    => $p['nombre'],
    'precio'    => $p['precio_venta'],
    'imagen'    => $p['imagen'],
    'categoria' => $cat_label,
    'stock'     => $stockActual
]);
?>

<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <?php if(isset($_SESSION["NoCliente"])){ ?>
            <div class="d-flex gap-3">
                <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                    <i class="fas fa-truck me-1"></i> Rastrear Pedido
                </a>
            </div>
        <?php } ?>
    </div>
</div>

<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="/proyectoweb/?" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="/proyectoweb/carrito" class="nav-icon position-relative" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="/proyectoweb/login" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<div class="bg-white border-bottom py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="/proyectoweb/?" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a></li>
                <li class="breadcrumb-item"><span class="text-muted"><?= $cat_label ?></span></li>
                <li class="breadcrumb-item active text-muted" aria-current="page"><?= $sku_visual ?></li>
            </ol>
        </nav>
    </div>
</div>

<main class="py-4">
    <div class="container">
        <div class="row g-4">

            <div class="col-lg-5">
                <div class="detail-img-card shadow-sm border rounded bg-white p-3 text-center">
                    <img src="/proyectoweb/public/uploads/img/<?= htmlspecialchars($p['imagen']) ?>"
                         alt="<?= htmlspecialchars($p['nombre']) ?>"
                         class="img-fluid detail-main-img"
                         onerror="this.src='https://placehold.co/500x500?text=Sin+Imagen'">
                </div>
            </div>

            <div class="col-lg-4">
                <h1 class="detail-title mb-2" style="font-size: 1.75rem; font-weight: 700; color: var(--dark-blue);">
                    <?= htmlspecialchars($p['nombre']) ?>
                </h1>
                <p class="text-muted small mb-3">
                    Código de producto (SKU): <span class="fw-bold"><?= $sku_visual ?></span>
                </p>
                
                <hr class="my-4">

                <div class="mb-4">
                    <p class="fw-semibold mb-2" style="font-size:.9rem">Color disponible:</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <?php if($resColores && count($resColores) > 0): ?>
                            <?php foreach($resColores as $idx => $c): 
                                $nColor = $c['color'];
                                $hColor = $coloresHex[$nColor] ?? '#ddd';
                            ?>
                                <div class="color-item">
                                    <input type="radio" name="color_seleccionado" id="color_<?= $idx ?>" 
                                           value="<?= $nColor ?>" class="btn-check" 
                                           <?= $idx === 0 ? 'checked' : '' ?> 
                                           <?= !$tieneStock ? 'disabled' : '' ?>>
                                    <label class="color-ball shadow-sm" for="color_<?= $idx ?>" 
                                           style="background-color: <?= $hColor ?>;" 
                                           title="<?= $nColor ?>"></label>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span class="text-muted small italic">Color único de serie</span>
                        <?php endif; ?>
                    </div>
                </div>

                <p class="fw-semibold mb-2" style="font-size:.9rem">Cantidad:</p>
                <div class="qty-control mb-3">
                    <button class="qty-btn" onclick="cambiarCantidadProd(-1)" <?= !$tieneStock ? 'disabled' : '' ?>>
                        <i class="fas fa-minus"></i>
                    </button>
                    <input type="number" id="cantidad" class="qty-input" autocomplete="off"
                           value="<?= $tieneStock ? '1' : '0' ?>" 
                           min="<?= $tieneStock ? '1' : '0' ?>" 
                           max="<?= $stockActual ?>" readonly>
                    <button class="qty-btn" onclick="cambiarCantidadProd(1)" <?= !$tieneStock ? 'disabled' : '' ?>>
                        <i class="fas fa-plus"></i>
                    </button>
                </div>

                <div class="stock-status-box mb-4">
                    <?php if($tieneStock): ?>
                        <div class="text-success fw-bold">
                            <i class="fas fa-check-circle me-1"></i> Disponible
                            <span class="text-muted fw-normal ms-1" style="font-size: 0.85rem;">
                                (<?= $stockActual ?> unidades en existencia)
                            </span>
                        </div>
                    <?php else: ?>
                        <div class="text-danger fw-bold">
                            <i class="fas fa-times-circle me-1"></i> Producto Agotado
                        </div>
                    <?php endif; ?>
                </div>

                <hr class="my-4">

                <?php if (!empty($p['manual'])): ?>
                <a href="/proyectoweb/public/uploads/manuales/<?= htmlspecialchars($p['manual']) ?>" 
                   target="_blank" class="manual-link d-inline-flex align-items-center">
                    <i class="fas fa-file-pdf me-2 shadow-sm"></i> 
                    <span>Descargar manual de usuario (.pdf)</span>
                </a>
                <?php endif; ?>
            </div>

            <div class="col-lg-3">
                <div class="detail-buy-box sticky-top shadow-sm border rounded bg-white p-4" style="top: 20px;">
                    <div class="price-container">
                        <span class="detail-price" style="font-size: 2.2rem; font-weight: 800; color: #cc0000;">
                            $<?= number_format($p['precio_venta'], 2) ?>
                        </span>
                        <p class="text-muted small mb-0">Precio con IVA incluido</p>
                    </div>

                    <hr class="my-4">

                    <div class="delivery-info mb-4">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <i class="fas fa-truck text-primary"></i>
                            <span class="small fw-semibold">Envío gratis a todo el país</span>
                        </div>
                    </div>

                    <button id="btn-add-main" onclick="agregarAlCarrito()" 
                            class="btn-agregar-carrito w-100 py-3 shadow-sm fw-bold" 
                            <?= !$tieneStock ? 'disabled' : '' ?>>
                        <i class="fas fa-shopping-cart me-2"></i> 
                        <?= $tieneStock ? 'AGREGAR AL CARRITO' : 'SIN EXISTENCIAS' ?>
                    </button>

                </div>
            </div>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-12">
                <div class="section-divider">
                    <h5 class="fw-bold text-dark mb-0">Descripción y especificaciones</h5>
                    <div class="title-underline mt-2"></div>
                </div>
            </div>
        </div>

        <div class="row g-5 mt-2 mb-5">
            <div class="col-lg-7">
                <h6 class="fw-bold mb-3" style="color:var(--dark-blue)">Detalles del producto</h6>
                <p class="text-muted" style="font-size:.95rem; line-height:1.8; text-align: justify;">
                    <?= nl2br(htmlspecialchars($p['descripción'])) ?>
                </p>
                <div class="alert alert-secondary border-0 mt-4 py-2 px-3" style="font-size: 0.75rem; border-left: 4px solid #666 !important;">
                    * Los abonos quincenales, plazos de crédito y montos de pago inicial son meramente informativos y pueden variar dependiendo del historial crediticio del cliente y su margen de crédito disponible.
                </div>
            </div>

            <div class="col-lg-5">
                <h6 class="fw-bold mb-3" style="color:var(--dark-blue)">Ficha Técnica</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped specs-table-final">
                        <tbody>
                            <tr>
                                <th class="bg-light w-40">N° de Producto</th>
                                <td><?= $p['no_producto'] ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Dimensiones</th>
                                <td><?= number_format($p['alto'], 1) ?> cm (Alto) x <?= number_format($p['ancho'], 1) ?> cm (Ancho)</td>
                            </tr>
                            <tr>
                                <th class="bg-light">Categoría</th>
                                <td><?= htmlspecialchars($cat_label) ?></td>
                            </tr>
                            <tr>
                                <th class="bg-light">Estado de equipo</th>
                                <td>Nuevo de fábrica</td>
                            </tr>
                            <?php if (!empty($p['manual'])): ?>
                            <tr>
                                <th class="bg-light text-danger">Manual Digital</th>
                                <td>
                                    <a href="/proyectoweb/public/uploads/manuales/<?= htmlspecialchars($p['manual']) ?>" 
                                       target="_blank" class="text-decoration-none fw-bold">
                                        <i class="fas fa-external-link-alt me-1"></i> Abrir PDF
                                    </a>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

<div id="modal-agregado">
    <div class="modal-agregado-card animate__animated animate__zoomIn">
        <div class="modal-agregado-header">
            <span><i class="fas fa-check-circle me-1"></i> ¡Producto agregado con éxito!</span>
            <button onclick="cerrarModal()" class="close-btn">&times;</button>
        </div>
        <div class="modal-agregado-body">
            <img id="modal-img" src="" alt="Producto" class="modal-agregado-img shadow-sm"
                 onerror="this.src='https://placehold.co/100x100?text=Producto'">
            <div class="modal-agregado-info">
                <div class="prod-name fw-bold" id="modal-nombre"></div>
                <div class="prod-sku text-muted small mb-1" id="modal-sku"></div>
                <div class="prod-color-select small mb-1" id="modal-color"></div>
                <div class="prod-price h5 fw-bold text-danger" id="modal-precio"></div>
            </div>
        </div>
        <div class="modal-agregado-footer gap-2">
            <a href="/proyectoweb/carrito" class="btn-ver-carro w-50 py-2">
                <i class="fas fa-shopping-cart me-1"></i> IR AL CARRITO
            </a>
            <button class="btn-seguir-comprando w-50 py-2" onclick="cerrarModal()">
                SEGUIR COMPRANDO
            </button>
        </div>
    </div>
</div>

<style>
:root { --btn-color: #0088cc; --dark-blue: #003366; }

.color-ball { 
    width: 32px; height: 32px; border-radius: 50%; display: block; 
    cursor: pointer; border: 3px solid #f0f0f0; transition: all 0.25s ease;
}
.btn-check:checked + .color-ball { 
    border-color: var(--btn-color); transform: scale(1.15); 
    box-shadow: 0 4px 8px rgba(0,0,0,0.15); 
}
.btn-check:disabled + .color-ball { opacity: 0.4; cursor: not-allowed; filter: grayscale(1); }

.qty-control { display: flex; align-items: center; border: 1px solid #ced4da; width: fit-content; border-radius: 6px; }
.qty-btn { background: #f8f9fa; border: none; padding: 6px 14px; color: #495057; font-size: 0.9rem; }
.qty-btn:hover:not(:disabled) { background: #e9ecef; }
.qty-btn:disabled { color: #dee2e6; cursor: not-allowed; }
.qty-input { width: 55px; border: none; text-align: center; font-weight: 700; background: transparent; }

.btn-agregar-carrito { 
    background: var(--btn-color); color: white; border: none; border-radius: 6px; 
    transition: all 0.3s; 
}
.btn-agregar-carrito:hover:not(:disabled) { background: var(--dark-blue); transform: translateY(-2px); }
.btn-agregar-carrito:disabled { background: #a5a5a5; cursor: not-allowed; }

.manual-link { color: var(--btn-color); font-weight: 600; text-decoration: none; transition: 0.2s; }
.manual-link:hover { color: var(--dark-blue); text-decoration: underline; }
.title-underline { width: 80px; height: 4px; background: var(--btn-color); border-radius: 2px; }
.w-40 { width: 40%; }
</style>

<script>


const PRODUCTO_BASE = <?= $prod_js ?>;

function cambiarCantidadProd(v) {
    const input = document.getElementById('cantidad');
    const stockMax = parseInt(PRODUCTO_BASE.stock);
    let valorActual = parseInt(input.value);

    if (valorActual > stockMax) {
        input.value = stockMax;
        return; 
    }

    let nuevoValor = valorActual + v;
    if (nuevoValor >= 1 && nuevoValor <= stockMax) {
        input.value = nuevoValor;
    }
}

function agregarAlCarrito() {
    const colorInput = document.querySelector('input[name="color_seleccionado"]:checked');
    const colorFinal = colorInput ? colorInput.value : 'N/A';
    const cantidadFinal = parseInt(document.getElementById('cantidad').value);
    document.getElementById('modal-img').src = "/proyectoweb/public/uploads/img/" + PRODUCTO_BASE.imagen;
    document.getElementById('modal-nombre').innerText = PRODUCTO_BASE.nombre;
    document.getElementById('modal-sku').innerText = "SKU: <?= $sku_visual ?>";
    document.getElementById('modal-color').innerHTML = "Color seleccionado: <b class='text-dark'>" + colorFinal + "</b>";
    document.getElementById('modal-precio').innerText = "$" + Number(PRODUCTO_BASE.precio).toLocaleString('es-MX', {minimumFractionDigits: 2});
    
    document.getElementById('modal-agregado').style.display = 'flex';
}

function cerrarModal() {
    document.getElementById('modal-agregado').style.display = 'none';
}

</script>

<?php include('vista/footer_gral.php'); ?>