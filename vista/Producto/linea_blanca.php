<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Línea Blanca</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>
    <div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
            </div>
            <div><a href="#" class="me-3">Rastrear Pedido</a><a href="#">Ayuda</a></div>
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
                <li class="nav-item"><a class="nav-link active" href="linea_blanca.php">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="linea_marron.php">Línea Marrón</a></li>
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
                    <li class="breadcrumb-item"><a href="../../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a></li>
                    <li class="breadcrumb-item active text-muted">Línea Blanca</li>
                </ol>
            </nav>
        </div>
    </div>
    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-tshirt me-2" style="color:var(--btn-color)"></i>Línea Blanca
                </h2>
                <p class="text-muted small">Lavadoras, secadoras, refrigeradores, congeladores y más.</p>
                <hr>
            </div>
            <!-- Subcategorías -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="lavadoras.php" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-tshirt fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Lavadoras</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="secadoras.php" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-wind fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Secadoras</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="refrigeradores.php" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-snowflake fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Refrigeradores</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="congeladores.php" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-cube fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Congeladores</p>
                        </div>
                    </a>
                </div>
            </div>
            <!-- Lavadoras -->
            <div class="mb-2"><span class="section-title">Lavadoras</span></div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="../../multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg" alt="Lavadora" onerror="this.src='https://placehold.co/300x250?text=Lavadora'"></div>
                    <div class="product-body">
                        <span class="product-sku">8MWTW2024WJM</span>
                        <p class="product-name">Lavadora 20kg Carga Superior Xpert System Blanca Agitador</p>
                        <span class="product-price-old">$14,699.00</span>
                        <div class="product-price-row"><span class="product-price">$9,999.00</span></div>
                    </div>
                    <a href="detalle.php?sku=8MWTW2024WJM" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=WFW5000HW" alt="Lavadora Frontal"></div>
                    <div class="product-body">
                        <span class="product-sku">WFW5000HW</span>
                        <p class="product-name">Lavadora de carga frontal 4.5 pies cúbicos alta eficiencia</p>
                        <span class="product-price-old">$16,999.00</span>
                        <div class="product-price-row"><span class="product-price">$12,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WFW5000HW" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=WET4024HW" alt="Lavasecadora"></div>
                    <div class="product-body">
                        <span class="product-sku">WET4024HW</span>
                        <p class="product-name">Lavasecadora de carga frontal 24" 2.3 pies cúbicos blanca</p>
                        <span class="product-price-old">$22,499.00</span>
                        <div class="product-price-row"><span class="product-price">$18,999.00</span></div>                   
                    </div>
                    <a href="detalle.php?sku=WET4024HW" class="btn-mas-info">Más información</a>
                </div></div>
            </div>
            <!-- Secadoras -->
            <div class="mb-2"><span class="section-title">Secadoras</span></div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="../../multimedia/Imagenes/productos/secadora-wed5000dw.jpg" alt="Secadora" onerror="this.src='https://placehold.co/300x250?text=Secadora'"></div>
                    <div class="product-body">
                        <span class="product-sku">WED5000DW</span>
                        <p class="product-name">Secadora eléctrica de carga frontal 7.0 pies cúbicos blanca</p>
                        <span class="product-price-old">$10,299.00</span>
                        <div class="product-price-row"><span class="product-price">$7,899.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WED5000DW" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="https://placehold.co/300x250?text=WGD5000DW" alt="Secadora Gas"></div>
                    <div class="product-body">
                        <span class="product-sku">WGD5000DW</span>
                        <p class="product-name">Secadora a gas de carga frontal 7.0 pies cúbicos blanca</p>
                        <span class="product-price-old">$11,499.00</span>
                        <div class="product-price-row"><span class="product-price">$8,799.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WGD5000DW" class="btn-mas-info">Más información</a>
                </div></div>
            </div>
            <!-- Refrigeradores -->
            <div class="mb-2"><span class="section-title">Refrigeradores</span></div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="../../multimedia/Imagenes/productos/refrigerador-wrs315snhm.jpg" alt="Refrigerador" onerror="this.src='https://placehold.co/300x250?text=Refrigerador'"></div>
                    <div class="product-body">
                        <span class="product-sku">WRS315SNHM</span>
                        <p class="product-name">Refrigerador Side by Side 25 pies con despachador de agua y hielo</p>
                        <span class="product-price-old">$28,999.00</span>
                        <div class="product-price-row"><span class="product-price">$22,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WRS315SNHM" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="../../multimedia/Imagenes/productos/despachador-wk0260b.jpg" alt="Despachador" onerror="this.src='https://placehold.co/300x250?text=Despachador'"></div>
                    <div class="product-body">
                        <span class="product-sku">WK0260B</span>
                        <p class="product-name">Despachador de agua con fábrica de hielo</p>
                        <span class="product-price-old">$8,599.00</span>
                        <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WK0260B" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="../../multimedia/Imagenes/productos/frigobar-wq09x.jpg" alt="Frigobar" onerror="this.src='https://placehold.co/300x250?text=Frigobar'"></div>
                    <div class="product-body">
                        <span class="product-sku">WQ09X</span>
                        <p class="product-name">Frigobar 9 pies con congelador y acabado acero inoxidable</p>
                        <span class="product-price-old">$5,999.00</span>
                        <div class="product-price-row"><span class="product-price">$4,499.00</span></div>
                    </div>
                    <a href="detalle.php?sku=WQ09X" class="btn-mas-info">Más información</a>
                </div></div>
            </div>
        </div>
    </main>
    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>