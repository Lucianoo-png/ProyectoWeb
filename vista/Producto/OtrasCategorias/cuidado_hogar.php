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
                <a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="/proyectoweb/login" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>

      <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-blanca">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-marron">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/cocina">Cocina</a></li>
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle active d-flex align-items-center gap-1"
                       href="#" id="megaDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-th-large me-1 small"></i> Categorías Específicas
                    </a>
                    <div class="dropdown-menu mega-menu" aria-labelledby="megaDropdown">
                        <div class="row g-3">
                            <div class="col-6 category-col">
                                <h6>Lavado</h6>
                                <a class="dropdown-item" href="/proyectoweb/lavadoras"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/secadoras"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/lavasecadoras"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="/proyectoweb/refrigeradores"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="/proyectoweb/congeladores"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="/proyectoweb/frigobar"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="/proyectoweb/hornos"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="/proyectoweb/estufas"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="/proyectoweb/microondas">
                                    <svg style="width:1em;height:1em;vertical-align:-0.125em;flex-shrink:0"
         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 13H5V7h14v10zm-8-8H7v6h4v-6zm5 4.5c.83 0 1.5-.67 1.5-1.5S16.83 11 16 11s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm0-4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
    </svg> Microondas
                                </a>
                                <a class="dropdown-item" href="/proyectoweb/lavavajillas"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-hogar"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-personal"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <div class="bg-white border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="/proyectoweb/?" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Cuidado del Hogar</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-home me-2" style="color:var(--btn-color)"></i>Cuidado del Hogar
                </h2>
                <p class="text-muted small">Aspiradoras, purificadores de aire, deshumidificadores y más para tu hogar.</p>
                <hr>
            </div>
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#todas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-home fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Todos los modelos</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Todos los modelos ── -->
            <div id="todas" class="mb-2">
                <span class="section-title">Todos los modelos</span>
            </div>
            <?php 
$productoControl = new ProductoControlador();
$productosCuidadoHogar = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "estatus='true' AND categoria='cuidado-hogar'", 
    "order" => "nombre ASC"
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($productosCuidadoHogar) && count($productosCuidadoHogar) > 0):
        foreach($productosCuidadoHogar as $item): 
            $nombre = $item['nombre'];
            $precio = '$' . number_format($item['precio_venta'], 2);
            $sku = Helpers::crearSKU($item['categoria'], $nombre);
            $id = $item['no_producto'];
            
            $imgSrc = "/proyectoweb/public/uploads/img/" . $item['imagen'];
            $placeholder = "https://placehold.co/300x250?text=Cuidado-Hogar";
    ?>
        <div class="col">
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="<?php echo $imgSrc; ?>" 
                         alt="<?php echo $nombre; ?>" 
                         onerror="this.src='<?php echo $placeholder; ?>'">
                </div>
                <div class="product-body">
                    <span class="product-sku"><?php echo $sku; ?></span>
                    <p class="product-name"><?php echo $nombre; ?></p>
                    <div class="product-price-row">
                        <span class="product-price"><?php echo $precio; ?></span>
                    </div>
                </div>
                <a href="/proyectoweb/producto/<?php echo $id; ?>" class="btn-mas-info">
                    Más información
                </a>
            </div>
        </div>
    <?php 
        endforeach; 
    else:
    ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted">No se encontraron productos de cuidado del hogar disponibles.</p>
        </div>
    <?php endif; ?>
</div>
        </div>
    </main>
    <?php include('vista/footer_gral.php'); ?>