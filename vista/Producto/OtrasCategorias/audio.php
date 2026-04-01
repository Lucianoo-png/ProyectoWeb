<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Audio</title>
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
                    <li class="breadcrumb-item active text-muted">Audio</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-volume-up me-2" style="color:var(--btn-color)"></i>Audio
                </h2>
                <p class="text-muted small">Soundbars, bocinas inalámbricas, audífonos y sistemas de sonido para el hogar.</p>
                <hr>
            </div>

            <!-- Accesos rápidos -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#soundbars" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-ruler-horizontal fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Soundbars</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#bocinas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-volume-up fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Bocinas</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#audifonos" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-headphones fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Audífonos</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#sistemas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-music fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Sistemas de Sonido</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Soundbars ── -->
            <div id="soundbars" class="mb-2">
                <span class="section-title">Soundbars</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=HW-Q60T" alt="Soundbar 5.1ch 360W con Dolby Digital y DTS Virtual X" onerror="this.src='https://placehold.co/300x250?text=HW-Q60T'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">HW-Q60T</span>
                            <p class="product-name">Soundbar 5.1ch 360W con Dolby Digital y DTS Virtual:X</p>
                            <div class="product-price-row"><span class="product-price">$6,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=HW-Q60T" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=HW-Q990B" alt="Soundbar 11.1.4ch 656W con Dolby Atmos y subwoofer inalámbrico" onerror="this.src='https://placehold.co/300x250?text=HW-Q990B'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">HW-Q990B</span>
                            <p class="product-name">Soundbar 11.1.4ch 656W con Dolby Atmos y subwoofer inalámbrico</p>
                            <div class="product-price-row"><span class="product-price">$19,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=HW-Q990B" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SC-HTB900" alt="Soundbar 3.1ch 500W con Dolby Atmos y subwoofer integrado" onerror="this.src='https://placehold.co/300x250?text=SC-HTB900'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SC-HTB900</span>
                            <p class="product-name">Soundbar 3.1ch 500W con Dolby Atmos y subwoofer integrado</p>
                            <div class="product-price-row"><span class="product-price">$9,299.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=SC-HTB900" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=YAS-109" alt="Soundbar 2.0ch 120W con Bluetooth y DTS Virtual X" onerror="this.src='https://placehold.co/300x250?text=YAS-109'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">YAS-109</span>
                            <p class="product-name">Soundbar 2.0ch 120W con Bluetooth y DTS Virtual:X</p>
                            <div class="product-price-row"><span class="product-price">$3,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=YAS-109" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Bocinas ── -->
            <div id="bocinas" class="mb-2">
                <span class="section-title">Bocinas</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XBOOM360" alt="Bocina inalámbrica 360 120W omnidireccional resistente al agua" onerror="this.src='https://placehold.co/300x250?text=XBOOM360'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XBOOM360</span>
                            <p class="product-name">Bocina inalámbrica 360° 120W omnidireccional resistente al agua</p>
                            <div class="product-price-row"><span class="product-price">$3,199.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=XBOOM360" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SRS-XB43" alt="Bocina portátil Bluetooth IP67 con luces LED y Extra Bass" onerror="this.src='https://placehold.co/300x250?text=SRS-XB43'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SRS-XB43</span>
                            <p class="product-name">Bocina portátil Bluetooth IP67 con luces LED y Extra Bass</p>
                            <div class="product-price-row"><span class="product-price">$2,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=SRS-XB43" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=HOMEPOD2" alt="Bocina inteligente con Siri y sonido espacial computacional" onerror="this.src='https://placehold.co/300x250?text=HOMEPOD2'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">HOMEPOD2</span>
                            <p class="product-name">Bocina inteligente con Siri y sonido espacial computacional</p>
                            <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=HOMEPOD2" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=CHARGE5" alt="Bocina portátil resistente al agua y polvo 40W PartyBoost" onerror="this.src='https://placehold.co/300x250?text=CHARGE5'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">CHARGE5</span>
                            <p class="product-name">Bocina portátil resistente al agua y polvo 40W PartyBoost</p>
                            <div class="product-price-row"><span class="product-price">$3,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=CHARGE5" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Audífonos ── -->
            <div id="audifonos" class="mb-2">
                <span class="section-title">Audífonos</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=WH1000XM5" alt="Audífonos inalámbricos con cancelación de ruido Industry-Leading" onerror="this.src='https://placehold.co/300x250?text=WH1000XM5'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">WH1000XM5</span>
                            <p class="product-name">Audífonos inalámbricos con cancelación de ruido Industry-Leading</p>
                            <div class="product-price-row"><span class="product-price">$7,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=WH1000XM5" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=BOSE700" alt="Audífonos inalámbricos con cancelación de ruido adaptativa 11 niveles" onerror="this.src='https://placehold.co/300x250?text=BOSE700'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">BOSE700</span>
                            <p class="product-name">Audífonos inalámbricos con cancelación de ruido adaptativa 11 niveles</p>
                            <div class="product-price-row"><span class="product-price">$8,999.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=BOSE700" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=AIRPODSPRO2" alt="Audífonos True Wireless con cancelación de ruido adaptativa H2" onerror="this.src='https://placehold.co/300x250?text=AIRPODSPRO2'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">AIRPODSPRO2</span>
                            <p class="product-name">Audífonos True Wireless con cancelación de ruido adaptativa H2</p>
                            <div class="product-price-row"><span class="product-price">$6,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=AIRPODSPRO2" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=QUIETCOMFORT45" alt="Audífonos inalámbricos con cancelación de ruido QuietComfort 45h" onerror="this.src='https://placehold.co/300x250?text=QUIETCOMFORT45'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">QUIETCOMFORT45</span>
                            <p class="product-name">Audífonos inalámbricos con cancelación de ruido QuietComfort 45h</p>
                            <div class="product-price-row"><span class="product-price">$7,199.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=QUIETCOMFORT45" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Sistemas de Sonido ── -->
            <div id="sistemas" class="mb-2">
                <span class="section-title">Sistemas de Sonido</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SC-D7MK2" alt="Minicomponente 1200W con CD MP3 USB Bluetooth y karaoke" onerror="this.src='https://placehold.co/300x250?text=SC-D7MK2'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SC-D7MK2</span>
                            <p class="product-name">Minicomponente 1200W con CD, MP3, USB, Bluetooth y karaoke</p>
                            <div class="product-price-row"><span class="product-price">$5,499.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=SC-D7MK2" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=MHC-V83D" alt="Sistema de audio portátil 2000W con luces LED y MEGA BASS" onerror="this.src='https://placehold.co/300x250?text=MHC-V83D'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">MHC-V83D</span>
                            <p class="product-name">Sistema de audio portátil 2000W con luces LED y MEGA BASS</p>
                            <div class="product-price-row"><span class="product-price">$9,799.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=MHC-V83D" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=RCD-N10" alt="Receptor de red estéreo compacto con HEOS y Bluetooth integrados" onerror="this.src='https://placehold.co/300x250?text=RCD-N10'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">RCD-N10</span>
                            <p class="product-name">Receptor de red estéreo compacto con HEOS y Bluetooth integrados</p>
                            <div class="product-price-row"><span class="product-price">$6,299.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=RCD-N10" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XB72" alt="Bocina de torre inalámbrica 300W con luces LED y batería 25h" onerror="this.src='https://placehold.co/300x250?text=XB72'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XB72</span>
                            <p class="product-name">Bocina de torre inalámbrica 300W con luces LED y batería 25h</p>
                            <div class="product-price-row"><span class="product-price">$7,899.00</span></div>
                        </div>
                        <a href="./../detalle.php?sku=XB72" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="site-footer-minimal">
        © 2026 LuchanosCorp S.A. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../../js/scripts.js"></script>
    <link rel="stylesheet" href="../../../estilos/responsive.css">
    <script src="../../../js/responsive.js"></script>
</body>
</html>