<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Televisores</title>
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
                <a href="#" class="topbar-link-muted">Ayuda</a>
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
                    <li class="breadcrumb-item active text-muted">Televisores</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-tv me-2" style="color:var(--btn-color)"></i>Televisores
                </h2>
                <p class="text-muted small">Smart TV, OLED, QLED y LED. Las mejores pantallas de las marcas líderes del mercado.</p>
                <hr>
            </div>

            <!-- Accesos rápidos por tipo -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#oled" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-tv fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">OLED / QLED</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#led" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-desktop fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">LED / Smart TV</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#grandes" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-expand fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">65" o más</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#compactos" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-compress fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">32" a 43"</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── OLED / QLED ── -->
            <div id="oled" class="mb-2">
                <span class="section-title">OLED / QLED</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=OLED65C1PSA" alt="Televisor OLED 65 4K Smart TV con procesador α9 Gen4" onerror="this.src='https://placehold.co/300x250?text=OLED65C1PSA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">OLED65C1PSA</span>
                            <p class="product-name">Televisor OLED 65" 4K Smart TV con procesador α9 Gen4</p>
                            <div class="product-price-row"><span class="product-price">$42,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=OLED65C1PSA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=QN65Q80CAFXZA" alt="Televisor QLED 65 4K con Neo Quantum Processor y Dolby Atmos" onerror="this.src='https://placehold.co/300x250?text=QN65Q80CAFXZA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">QN65Q80CAFXZA</span>
                            <p class="product-name">Televisor QLED 65" 4K con Neo Quantum Processor y Dolby Atmos</p>
                            <div class="product-price-row"><span class="product-price">$36,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=QN65Q80CAFXZA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=OLED55A2PSA" alt="Televisor OLED 55 4K Smart TV con webOS 22 y control de voz" onerror="this.src='https://placehold.co/300x250?text=OLED55A2PSA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">OLED55A2PSA</span>
                            <p class="product-name">Televisor OLED 55" 4K Smart TV con webOS 22 y control de voz</p>
                            <div class="product-price-row"><span class="product-price">$31,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=OLED55A2PSA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=QN55QN85BAFXZA" alt="Televisor Neo QLED 55 4K Mini LED 120Hz Gaming TV" onerror="this.src='https://placehold.co/300x250?text=QN55QN85BAFXZA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">QN55QN85BAFXZA</span>
                            <p class="product-name">Televisor Neo QLED 55" 4K Mini LED 120Hz Gaming TV</p>
                            <div class="product-price-row"><span class="product-price">$28,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=QN55QN85BAFXZA" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── LED / Smart TV ── -->
            <div id="led" class="mb-2">
                <span class="section-title">LED / Smart TV</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=UN55TU8000" alt="Televisor Smart TV 55 4K UHD Crystal Display con Alexa" onerror="this.src='https://placehold.co/300x250?text=UN55TU8000'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">UN55TU8000</span>
                            <p class="product-name">Televisor Smart TV 55" 4K UHD Crystal Display con Alexa</p>
                            <div class="product-price-row"><span class="product-price">$13,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=UN55TU8000" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=43PFS6805" alt="Televisor Smart TV 43 Full HD con Saphi OS y HDR10+" onerror="this.src='https://placehold.co/300x250?text=43PFS6805'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">43PFS6805</span>
                            <p class="product-name">Televisor Smart TV 43" Full HD con Saphi OS y HDR10+</p>
                            <div class="product-price-row"><span class="product-price">$6,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=43PFS6805" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=50UP7750PSB" alt="Televisor Smart TV 50 4K UHD con ThinQ AI y Magic Remote" onerror="this.src='https://placehold.co/300x250?text=50UP7750PSB'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">50UP7750PSB</span>
                            <p class="product-name">Televisor Smart TV 50" 4K UHD con ThinQ AI y Magic Remote</p>
                            <div class="product-price-row"><span class="product-price">$10,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=50UP7750PSB" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=TCL55S454" alt="Televisor 55 4K UHD Roku TV con HDR y Dolby Vision" onerror="this.src='https://placehold.co/300x250?text=TCL55S454'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">TCL55S454</span>
                            <p class="product-name">Televisor 55" 4K UHD Roku TV con HDR y Dolby Vision</p>
                            <div class="product-price-row"><span class="product-price">$8,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=TCL55S454" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── 65" o más ── -->
            <div id="grandes" class="mb-2">
                <span class="section-title">65" o más</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=QN75QN900BFXZA" alt="Televisor Neo QLED 75 8K con procesador Neural Quantum 8K" onerror="this.src='https://placehold.co/300x250?text=QN75QN900BFXZA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">QN75QN900BFXZA</span>
                            <p class="product-name">Televisor Neo QLED 75" 8K con procesador Neural Quantum 8K</p>
                            <div class="product-price-row"><span class="product-price">$89,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=QN75QN900BFXZA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=OLED77C2PSA" alt="Televisor OLED 77 4K evo Gallery Edition con procesador α9 Gen5" onerror="this.src='https://placehold.co/300x250?text=OLED77C2PSA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">OLED77C2PSA</span>
                            <p class="product-name">Televisor OLED 77" 4K evo Gallery Edition con procesador α9 Gen5</p>
                            <div class="product-price-row"><span class="product-price">$74,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=OLED77C2PSA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=UN85TU8000" alt="Televisor Smart TV 85 4K UHD Crystal Display con Alexa integrada" onerror="this.src='https://placehold.co/300x250?text=UN85TU8000'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">UN85TU8000</span>
                            <p class="product-name">Televisor Smart TV 85" 4K UHD Crystal Display con Alexa integrada</p>
                            <div class="product-price-row"><span class="product-price">$39,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=UN85TU8000" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=65QNED90UPA" alt="Televisor QNED MiniLED 65 4K con Quantum Dot NanoCell y 120Hz" onerror="this.src='https://placehold.co/300x250?text=65QNED90UPA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">65QNED90UPA</span>
                            <p class="product-name">Televisor QNED MiniLED 65" 4K con Quantum Dot NanoCell y 120Hz</p>
                            <div class="product-price-row"><span class="product-price">$29,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=65QNED90UPA" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── 32" a 43" ── -->
            <div id="compactos" class="mb-2">
                <span class="section-title">32" a 43"</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=32LM630BPUA" alt="Televisor Smart TV 32 HD con webOS 4.5 y control mágico" onerror="this.src='https://placehold.co/300x250?text=32LM630BPUA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">32LM630BPUA</span>
                            <p class="product-name">Televisor Smart TV 32" HD con webOS 4.5 y control mágico</p>
                            <div class="product-price-row"><span class="product-price">$4,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=32LM630BPUA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=UN40T5300AFXZA" alt="Televisor Smart TV 40 Full HD con Tizen OS y PurColor" onerror="this.src='https://placehold.co/300x250?text=UN40T5300AFXZA'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">UN40T5300AFXZA</span>
                            <p class="product-name">Televisor Smart TV 40" Full HD con Tizen OS y PurColor</p>
                            <div class="product-price-row"><span class="product-price">$5,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=UN40T5300AFXZA" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=TCL32S354" alt="Televisor 32 HD Roku TV con soporte HDR y control por voz" onerror="this.src='https://placehold.co/300x250?text=TCL32S354'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">TCL32S354</span>
                            <p class="product-name">Televisor 32" HD Roku TV con soporte HDR y control por voz</p>
                            <div class="product-price-row"><span class="product-price">$3,299.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=TCL32S354" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=43UP7750PSB" alt="Televisor Smart TV 43 4K UHD con ThinQ AI y Filmmaker Mode" onerror="this.src='https://placehold.co/300x250?text=43UP7750PSB'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">43UP7750PSB</span>
                            <p class="product-name">Televisor Smart TV 43" 4K UHD con ThinQ AI y Filmmaker Mode</p>
                            <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=43UP7750PSB" class="btn-mas-info">Más información</a>
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