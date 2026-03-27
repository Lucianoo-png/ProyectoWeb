<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Proyectores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../../estilos/styles.css">
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
                <a href="../../rastrear_pedido.php" class="topbar-link-track">
                    <i class="fas fa-truck me-1"></i> Rastrear Pedido
                </a>
                    <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
            </div>
        </div>
    </div>

    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="../../../index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="../carrito.php" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="../../Cuenta/login.php" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>

    <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="./../linea_blanca.php">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="./../linea_marron.php">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="./../cocina.php">Cocina</a></li>
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
                                <a class="dropdown-item" href="lavadoras.php"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="secadoras.php"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="lavasecadoras.php"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="refrigeradores.php"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="congeladores.php"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="frigobar.php"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="hornos.php"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="estufas.php"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="microondas.php"><i class="fas fa-blender"></i> Microondas</a>
                                <a class="dropdown-item" href="lavavajillas.php"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="cuidado_hogar.php"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="cuidado_personal.php"><i class="fas fa-spa"></i> Cuidado Personal</a>
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
                        <a href="../../../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="./../linea_marron.php" class="text-decoration-none" style="color:var(--btn-color)">Línea Marrón</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Proyectores</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-film me-2" style="color:var(--btn-color)"></i>Proyectores
                </h2>
                <p class="text-muted small">Proyectores 4K, Full HD y portátiles para cine en casa, presentaciones y gaming.</p>
                <hr>
            </div>

            <!-- Accesos rápidos -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#4k" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-film fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Proyectores 4K</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#fullhd" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-video fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Proyectores Full HD</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#portatiles" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-mobile-alt fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Portátiles</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#accesorios" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-tools fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Accesorios</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Proyectores 4K ── -->
            <div id="4k" class="mb-2">
                <span class="section-title">Proyectores 4K</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=VW590ES" alt="Proyector 4K HDR de cine en casa 1800 lúmenes con TRILUMINOS Pro" onerror="this.src='https://placehold.co/300x250?text=VW590ES'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">VW590ES</span>
                            <p class="product-name">Proyector 4K HDR de cine en casa 1800 lúmenes con TRILUMINOS Pro</p>
                            <div class="product-price-row"><span class="product-price">$54,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=VW590ES" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=HT5550" alt="Proyector DLP 4K UHD 2200 lúmenes con HDR10 y modo gaming" onerror="this.src='https://placehold.co/300x250?text=HT5550'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">HT5550</span>
                            <p class="product-name">Proyector DLP 4K UHD 2200 lúmenes con HDR10 y modo gaming</p>
                            <div class="product-price-row"><span class="product-price">$38,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=HT5550" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=LSPX-T3S" alt="Proyector láser 4K corta distancia 120 pulgadas con Android TV" onerror="this.src='https://placehold.co/300x250?text=LSPX-T3S'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">LSPX-T3S</span>
                            <p class="product-name">Proyector láser 4K corta distancia 120" con Android TV integrado</p>
                            <div class="product-price-row"><span class="product-price">$79,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=LSPX-T3S" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=TK850" alt="Proyector 4K HDR 3000 lúmenes con HLG y cobertura P3" onerror="this.src='https://placehold.co/300x250?text=TK850'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">TK850</span>
                            <p class="product-name">Proyector 4K HDR 3000 lúmenes con HLG y cobertura P3</p>
                            <div class="product-price-row"><span class="product-price">$28,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=TK850" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Proyectores Full HD ── -->
            <div id="fullhd" class="mb-2">
                <span class="section-title">Proyectores Full HD</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=HT2050A" alt="Proyector Full HD DLP 2200 lúmenes con modo ambiente oscuro" onerror="this.src='https://placehold.co/300x250?text=HT2050A'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">HT2050A</span>
                            <p class="product-name">Proyector Full HD DLP 2200 lúmenes con modo ambiente oscuro</p>
                            <div class="product-price-row"><span class="product-price">$12,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=HT2050A" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=EH-TW740" alt="Proyector Full HD 3LCD 3300 lúmenes con HDMI y MHL" onerror="this.src='https://placehold.co/300x250?text=EH-TW740'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">EH-TW740</span>
                            <p class="product-name">Proyector Full HD 3LCD 3300 lúmenes con HDMI y MHL</p>
                            <div class="product-price-row"><span class="product-price">$9,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=EH-TW740" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=W2710" alt="Proyector Full HD 4000 lúmenes para sala iluminada con SmartEco" onerror="this.src='https://placehold.co/300x250?text=W2710'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">W2710</span>
                            <p class="product-name">Proyector Full HD 4000 lúmenes para sala iluminada con SmartEco</p>
                            <div class="product-price-row"><span class="product-price">$14,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=W2710" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=P6600" alt="Proyector Full HD 5500 lúmenes para negocios y educación" onerror="this.src='https://placehold.co/300x250?text=P6600'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">P6600</span>
                            <p class="product-name">Proyector Full HD 5500 lúmenes para negocios y educación</p>
                            <div class="product-price-row"><span class="product-price">$19,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=P6600" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Portátiles ── -->
            <div id="portatiles" class="mb-2">
                <span class="section-title">Portátiles</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=GP10" alt="Proyector portátil láser Full HD 1000 lúmenes con Android TV" onerror="this.src='https://placehold.co/300x250?text=GP10'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">GP10</span>
                            <p class="product-name">Proyector portátil láser Full HD 1000 lúmenes con Android TV</p>
                            <div class="product-price-row"><span class="product-price">$16,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=GP10" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=MP180" alt="Proyector mini portátil 480p 200 lúmenes con batería integrada" onerror="this.src='https://placehold.co/300x250?text=MP180'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">MP180</span>
                            <p class="product-name">Proyector mini portátil 480p 200 lúmenes con batería integrada</p>
                            <div class="product-price-row"><span class="product-price">$3,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=MP180" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Accesorios ── -->
            <div id="accesorios" class="mb-2">
                <span class="section-title">Accesorios</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=PRO-S100" alt="Pantalla de proyección 100 pulgadas tipo trípode portátil" onerror="this.src='https://placehold.co/300x250?text=PRO-S100'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">PRO-S100</span>
                            <p class="product-name">Pantalla de proyección 100" tipo trípode portátil</p>
                            <div class="product-price-row"><span class="product-price">$1,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=PRO-S100" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=PRO-M120" alt="Pantalla de proyección motorizada 120 pulgadas para techo o pared" onerror="this.src='https://placehold.co/300x250?text=PRO-M120'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">PRO-M120</span>
                            <p class="product-name">Pantalla de proyección motorizada 120" para techo o pared</p>
                            <div class="product-price-row"><span class="product-price">$4,299.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=PRO-M120" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="site-footer-minimal">
        © 2026 LuchanosCorp S.A. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>