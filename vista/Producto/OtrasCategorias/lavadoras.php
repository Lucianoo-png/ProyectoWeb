<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroPendejo | Lavadoras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>

    <div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@electropendejo.com</span>
            </div>
            <div><a href="#" class="me-3">Rastrear Pedido</a><a href="#">Ayuda</a></div>
        </div>
    </div>

    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">ELECTRO</span><span class="pendejo">Pendejo</span>
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
                <li class="nav-item"><a class="nav-link" href="linea_marron.php">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="cocina.php">Cocina</a></li>
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
                        <a href="../../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Lavadoras</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-tshirt me-2" style="color:var(--btn-color)"></i>Lavadoras
                </h2>
                <p class="text-muted small">Toda la gama de lavadoras de carga superior y frontal de las mejores marcas.</p>
                <hr>
            </div>
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#todas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-tshirt fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Todos los modelos</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Todos los modelos ── -->
            <div id="todas" class="mb-2">
                <span class="section-title">Todos los modelos</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="../../multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg" alt="Lavadora 20kg Carga Superior Xpert System Blanca Agitador" onerror="this.src='https://placehold.co/300x250?text=8MWTW2024WJM'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">8MWTW2024WJM</span>
                            <p class="product-name">Lavadora 20kg Carga Superior Xpert System Blanca Agitador</p>
                            <span class="product-price-old">$14,699.00</span>
                            <div class="product-price-row"><span class="product-price">$9,999.00</span></div>
                        </div>
                        <a href="detalle.php?sku=8MWTW2024WJM" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=WFW5000HW" alt="Lavadora de carga frontal 4.5 pies cúbicos alta eficiencia" onerror="this.src='https://placehold.co/300x250?text=WFW5000HW'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">WFW5000HW</span>
                            <p class="product-name">Lavadora de carga frontal 4.5 pies cúbicos alta eficiencia</p>
                            <span class="product-price-old">$16,999.00</span>
                            <div class="product-price-row"><span class="product-price">$12,499.00</span></div>
                            <p class="product-msi"><i class="fas fa-credit-card"></i> hasta 18 meses sin intereses</p>
                        </div>
                        <a href="detalle.php?sku=WFW5000HW" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=WTW4955HW" alt="Lavadora de carga superior 4.7 pies cúbicos con dispensador automático" onerror="this.src='https://placehold.co/300x250?text=WTW4955HW'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">WTW4955HW</span>
                            <p class="product-name">Lavadora de carga superior 4.7 pies cúbicos con dispensador automático</p>
                            <span class="product-price-old">$11,499.00</span>
                            <div class="product-price-row"><span class="product-price">$8,699.00</span></div>
                        </div>
                        <a href="detalle.php?sku=WTW4955HW" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=MVW6230HW" alt="Lavadora carga superior 5.0 pies cúbicos con sensor de carga" onerror="this.src='https://placehold.co/300x250?text=MVW6230HW'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">MVW6230HW</span>
                            <p class="product-name">Lavadora carga superior 5.0 pies cúbicos con sensor de carga</p>
                            <span class="product-price-old">$13,999.00</span>
                            <div class="product-price-row"><span class="product-price">$10,499.00</span></div>
                        </div>
                        <a href="detalle.php?sku=MVW6230HW" class="btn-mas-info">Más información</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="site-footer-minimal">
        © 2026 ElectroPendejo S.A. Todos los derechos reservados.
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>