<div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline">
                    <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
                </span>
            </div>
        </div>
    </div>

    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="/proyectoweb/?" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
           <div class="input-group search-bar flex-grow-1 mx-lg-4 position-relative">
    <!-- Le agregamos el id="buscadorEnVivo" y autocomplete="off" para que el navegador no estorbe -->
    <input type="text" id="buscadorEnVivo" class="form-control" placeholder="¿Qué estás buscando?" autocomplete="off">
    
    <!-- Contenedor flotante para los resultados (oculto por defecto) -->
    <div id="resultadosBuscador" class="dropdown-menu w-100 shadow-lg" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050; max-height: 300px; overflow-y: auto; border-radius: 0 0 8px 8px;">
        <!-- Aquí entrarán las sugerencias por JS -->
    </div>
</div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <?php if(isset($_SESSION["NoCliente"])){ ?><a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i><span class="cart-badge" id="cart-count" style="display:none">0</span></a> <?php } ?>
                <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>

<!-- BUSCADOR MÓVIL (visible solo en ≤768px via responsive.css) -->
<div class="search-bar-mobile">
    <div class="input-group">
        <input type="text"
               id="buscadorMovil"
               class="form-control"
               placeholder="¿Qué estás buscando?"
               autocomplete="off">
        <button class="btn-buscar-movil" type="button" aria-label="Buscar">
            <i class="fas fa-search"></i>
        </button>
        <div id="resultadosBuscadorMovil"
             class="dropdown-menu w-100 shadow-lg"
             style="display:none; position:absolute; top:100%; left:0; z-index:1050; max-height:60vh; overflow-y:auto; border-radius:0 0 8px 8px;">
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
                    <li class="breadcrumb-item">
                        <a href="/proyectoweb/linea-marron" class="text-decoration-none" style="color:var(--btn-color)">Línea Marrón</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Videojuegos</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-gamepad me-2" style="color:var(--btn-color)"></i>Videojuegos
                </h2>
                <p class="text-muted small">Consolas, controles, accesorios y periféricos gaming de las plataformas más populares.</p>
                <hr>
            </div>

            <!-- Accesos rápidos -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#consolas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-gamepad fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Consolas</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#controles" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-hand-paper fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Controles</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#sillas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-chair fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Sillas Gaming</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#accesorios" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-headset fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Accesorios Gaming</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Consolas ── -->
            <div id="consolas" class="mb-2">
                <span class="section-title">Consolas</span>
            </div>
            <?php 
$productoControl = new ProductoControlador();
$productosConsolas = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true' AND categoria='consolas'", 
    "order" => "nombre ASC"
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($productosConsolas) && count($productosConsolas) > 0):
        foreach($productosConsolas as $consola): 
            $nombre = $consola['nombre'];
            $precio = '$' . number_format($consola['precio_venta'], 2);
            $sku = Helpers::crearSKU($consola['categoria'], $nombre);
            $id = $consola['no_producto'];
            
            $imgConsola = "/proyectoweb/public/uploads/img/" . $consola['imagen'];
            $placeholder = "https://placehold.co/300x250?text=Consola";
    ?>
        <div class="col">
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="<?php echo $imgConsola; ?>" 
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
            <p class="text-muted">No se encontraron consolas disponibles.</p>
        </div>
    <?php endif; ?>
</div>

            <!-- ── Controles ── -->
            <div id="controles" class="mb-2">
                <span class="section-title">Controles</span>
            </div>
            <?php 
$productoControl = new ProductoControlador();
$productosControles = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true' AND categoria='controles'", 
    "order" => "nombre ASC"
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($productosControles) && count($productosControles) > 0):
        foreach($productosControles as $control): 
            $nombre = $control['nombre'];
            $precio = '$' . number_format($control['precio_venta'], 2);
            $sku = Helpers::crearSKU($control['categoria'], $nombre);
            $id = $control['no_producto'];
            
            $imgCtrl = "/proyectoweb/public/uploads/img/" . $control['imagen'];
            $placeholder = "https://placehold.co/300x250?text=Control";
    ?>
        <div class="col">
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="<?php echo $imgCtrl; ?>" 
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
            <p class="text-muted">No se encontraron controles disponibles.</p>
        </div>
    <?php endif; ?>
</div>

            <!-- ── Sillas Gaming ── -->
            <div id="sillas" class="mb-2">
                <span class="section-title">Sillas Gaming</span>
            </div>
            <?php 
$productoControl = new ProductoControlador();
$productosSillas = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true' AND categoria='sillagamer'", 
    "order" => "nombre ASC"
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($productosSillas) && count($productosSillas) > 0):
        foreach($productosSillas as $silla): 
            $nombre = $silla['nombre'];
            $precio = '$' . number_format($silla['precio_venta'], 2);
            $sku = Helpers::crearSKU($silla['categoria'], $nombre);
            $id = $silla['no_producto'];
            
            $imgSilla = "/proyectoweb/public/uploads/img/" . $silla['imagen'];
            $placeholder = "https://placehold.co/300x250?text=Silla-Gamer";
    ?>
        <div class="col">
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="<?php echo $imgSilla; ?>" 
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
            <p class="text-muted">No se encontraron sillas gamer disponibles.</p>
        </div>
    <?php endif; ?>
</div>

            <!-- ── Accesorios Gaming ── -->
            <div id="accesorios" class="mb-2">
                <span class="section-title">Accesorios Gaming</span>
            </div>
            <?php 
$productoControl = new ProductoControlador();
$accesoriosGaming = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true' AND categoria='accesoriosgaming'", 
    "order" => "nombre ASC"
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($accesoriosGaming) && count($accesoriosGaming) > 0):
        foreach($accesoriosGaming as $item): 
            $nombre = $item['nombre'];
            $precio = '$' . number_format($item['precio_venta'], 2);
            $sku = Helpers::crearSKU($item['categoria'], $nombre);
            $id = $item['no_producto'];
            
            $imgSrc = "/proyectoweb/public/uploads/img/" . $item['imagen'];
            $placeholder = "https://placehold.co/300x250?text=Accesorio-Gaming";
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
            <p class="text-muted">No se encontraron accesorios gaming disponibles.</p>
        </div>
    <?php endif; ?>
</div>
        </div>
    </main>
    <?php include('vista/footer_gral.php'); ?>