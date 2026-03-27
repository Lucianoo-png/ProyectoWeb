<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp| Línea Marrón</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>
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
               <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
        </div>
    </div>
</div>
    
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
                <a href="carrito.php" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="../Cuenta/login.php" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>
    <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="linea_blanca.php">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link active" href="linea_marron.php">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="cocina.php">Cocina</a></li>
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center gap-1"
                       href="#" id="megaDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-th-large me-1 small"></i> Categorías Específicas
                    </a>
                    <div class="dropdown-menu mega-menu" aria-labelledby="megaDropdown">
                        <div class="row g-3">
                            <div class="col-6 category-col">
                                <h6>Lavado</h6>
                                <a class="dropdown-item" href="OtrasCategorias/lavadoras.php"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="OtrasCategorias/secadoras.php"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="OtrasCategorias/lavasecadoras.php"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="OtrasCategorias/refrigeradores.php"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="OtrasCategorias/congeladores.php"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="OtrasCategorias/frigobar.php"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="OtrasCategorias/hornos.php"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="OtrasCategorias/estufas.php"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="OtrasCategorias/microondas.php"><i class="fas fa-blender"></i> Microondas</a>
                                <a class="dropdown-item" href="OtrasCategorias/lavavajillas.php"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="OtrasCategorias/cuidado_hogar.php"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="OtrasCategorias/cuidado_personal.php"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <div class="bg-white border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb"><ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item"><a href="../../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a></li>
                <li class="breadcrumb-item active text-muted">Línea Marrón</li>
            </ol></nav>
        </div>
    </div>
    <main class="py-4"><div class="container">
        <div class="mb-4">
            <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                <i class="fas fa-tv me-2" style="color:var(--btn-color)"></i>Línea Marrón
            </h2>
            <p class="text-muted small">Televisores, audio, video y electrónica de entretenimiento.</p><hr>
        </div>
        <div class="row g-3 mb-5">
            <div class="col-6 col-md-3"><a href="OtrasCategorias/televisores.php" class="text-decoration-none">
                <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                    <i class="fas fa-tv fa-2x mb-2" style="color:var(--btn-color)"></i><p class="mb-0 small fw-semibold">Televisores</p>
                </div></a></div>
            <div class="col-6 col-md-3"><a href="OtrasCategorias/audio.php" class="text-decoration-none">
                <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                    <i class="fas fa-volume-up fa-2x mb-2" style="color:var(--btn-color)"></i><p class="mb-0 small fw-semibold">Audio</p>
                </div></a></div>
            <div class="col-6 col-md-3"><a href="OtrasCategorias/proyectores.php" class="text-decoration-none">
                <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                    <i class="fas fa-film fa-2x mb-2" style="color:var(--btn-color)"></i><p class="mb-0 small fw-semibold">Proyectores</p>
                </div></a></div>
            <div class="col-6 col-md-3"><a href="OtrasCategorias/videojuegos.php" class="text-decoration-none">
                <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                    <i class="fas fa-gamepad fa-2x mb-2" style="color:var(--btn-color)"></i><p class="mb-0 small fw-semibold">Videojuegos</p>
                </div></a></div>
        </div>
        <div id="televisores" class="mb-2"><span class="section-title">Televisores</span></div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=UN55TU8000" alt="UN55TU8000" onerror="this.src='https://placehold.co/300x250?text=UN55TU8000'"></div>
                    <div class="product-body">
                        <span class="product-sku">UN55TU8000</span>
                        <p class="product-name">Televisor Smart TV 55" 4K UHD Crystal Display con Alexa</p>
                        <div class="product-price-row"><span class="product-price">$13,999.00</span></div>
                    </div>
                    <a href="detalle.php?sku=UN55TU8000" class="btn-mas-info">Más información</a>
                </div></div>                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=OLED65C1PSA" alt="OLED65C1PSA" onerror="this.src='https://placehold.co/300x250?text=OLED65C1PSA'"></div>
                    <div class="product-body">
                        <span class="product-sku">OLED65C1PSA</span>
                        <p class="product-name">Televisor OLED 65" 4K Smart TV con procesador α9 Gen4</p>
                        <div class="product-price-row"><span class="product-price">$42,999.00</span></div>
                    </div>
                    <a href="detalle.php?sku=OLED65C1PSA" class="btn-mas-info">Más información</a>
                </div></div>                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=43PFS6805" alt="43PFS6805" onerror="this.src='https://placehold.co/300x250?text=43PFS6805'"></div>
                    <div class="product-body">
                        <span class="product-sku">43PFS6805</span>
                        <p class="product-name">Televisor Smart TV 43" Full HD con Saphi OS y HDR10+</p>
                        <div class="product-price-row"><span class="product-price">$6,999.00</span></div>
                    </div>
                    <a href="detalle.php?sku=43PFS6805" class="btn-mas-info">Más información</a>
                </div></div>                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=32LM630BPUA" alt="32LM630BPUA" onerror="this.src='https://placehold.co/300x250?text=32LM630BPUA'"></div>
                    <div class="product-body">
                        <span class="product-sku">32LM630BPUA</span>
                        <p class="product-name">Televisor Smart TV 32" HD con webOS 4.5 y control mágico</p>
                        <div class="product-price-row"><span class="product-price">$4,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=32LM630BPUA" class="btn-mas-info">Más información</a>
                </div></div>        </div>
        <div id="audio" class="mb-2"><span class="section-title">Audio</span></div>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=HW-Q60T" alt="HW-Q60T" onerror="this.src='https://placehold.co/300x250?text=HW-Q60T'"></div>
                    <div class="product-body">
                        <span class="product-sku">HW-Q60T</span>
                        <p class="product-name">Soundbar 5.1ch 360W con Dolby Digital y DTS Virtual:X</p>
                        <div class="product-price-row"><span class="product-price">$6,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=HW-Q60T" class="btn-mas-info">Más información</a>
                </div></div>                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=XBOOM360" alt="XBOOM360" onerror="this.src='https://placehold.co/300x250?text=XBOOM360'"></div>
                    <div class="product-body">
                        <span class="product-sku">XBOOM360</span>
                        <p class="product-name">Bocina inalámbrica 360° 120W omnidireccional resistente al agua</p>
                        <div class="product-price-row"><span class="product-price">$3,199.00</span></div>
                    </div>
                    <a href="detalle.php?sku=XBOOM360" class="btn-mas-info">Más información</a>
                </div></div>                
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=WH1000XM5" alt="WH1000XM5" onerror="this.src='https://placehold.co/300x250?text=WH1000XM5'"></div>
                    <div class="product-body">
                        <span class="product-sku">WH1000XM5</span>
                        <p class="product-name">Audífonos inalámbricos con cancelación de ruido Industry-Leading</p>
                        <div class="product-price-row"><span class="product-price">$7,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WH1000XM5" class="btn-mas-info">Más información</a>
                </div></div>        </div>
    </div></main>
    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>