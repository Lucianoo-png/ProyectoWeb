<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="estilos/styles.css">
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
            <a href="index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="#" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="vista/Cuenta/login.php" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>

    <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="vista/Producto/linea_blanca.php">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="vista/Producto/linea_marron.php">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="vista/Producto/cocina.php">Cocina</a></li>
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
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/lavadoras.php"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/secadoras.php"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/lavasecadoras.php"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/refrigeradores.php"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/congeladores.php"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/frigobar.php"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/hornos.php"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/estufas.php"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/microondas.php"><i class="fas fa-blender"></i> Microondas</a>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/lavavajillas.php"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="vista/Producto/OtrasCategorias/cuidado_hogar.php"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="vvista/Producto/OtrasCategorias/cuidado_personal.php"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <main class="py-4">
        <div class="container">

            <div id="heroCarousel" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
                </div>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="multimedia/Imagenes/carrusel/slide1.jpg" class="d-block w-100" alt="Slide 1"
                             onerror="this.style.background='linear-gradient(135deg,#002366 0%,#4b7dd9 100%)';this.removeAttribute('src')">
                        <div class="carousel-caption">
                            <h5>Hasta 40% en Línea Blanca</h5>
                            <p>Lavadoras, refrigeradores y más. Hasta 18 meses sin intereses.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="multimedia/Imagenes/carrusel/slide2.jpg" class="d-block w-100" alt="Slide 2"
                             onerror="this.style.background='linear-gradient(135deg,#008CA8 0%,#002366 100%)';this.removeAttribute('src')">
                        <div class="carousel-caption">
                            <h5>Equipa tu Cocina</h5>
                            <p>Hornos, estufas y microondas de las mejores marcas.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="multimedia/Imagenes/carrusel/slide3.jpg" class="d-block w-100" alt="Slide 3"
                             onerror="this.style.background='linear-gradient(135deg,#343a40 0%,#4b7dd9 100%)';this.removeAttribute('src')">
                        <div class="carousel-caption">
                            <h5>Ofertas Especiales del Mes</h5>
                            <p>Descuentos exclusivos en las marcas que más confías.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                </button>
            </div>

            <div class="mb-2"><span class="section-title">Productos Destacados</span></div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/microondas-wm3911d.jpg" alt="Microondas" onerror="this.src='https://placehold.co/300x250?text=Microondas'"></div>
                    <div class="product-body">
                        <span class="product-sku">WM3911D</span>
                        <p class="product-name">Microondas de mesa con función AirFry y 4 modos en 1 (1CuFt)</p>
                        <span class="product-price-old">$5,999.00</span>
                        <div class="product-price-row"><span class="product-price">$4,599.00</span></div>
                    </div>
                    <a href="vista/Producto/detalle.php?sku=WM3911D" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg" alt="Lavadora" onerror="this.src='https://placehold.co/300x250?text=Lavadora'"></div>
                    <div class="product-body">
                        <span class="product-sku">8MWTW2024WJM</span>
                        <p class="product-name">Lavadora 20kg Carga Superior Xpert System Blanca Agitador</p>
                        <span class="product-price-old">$14,699.00</span>
                        <div class="product-price-row"><span class="product-price">$9,999.00</span></div>
                    </div>
                    <a href="vista/Producto/detalle.php?sku=8MWTW2024WJM" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/despachador-wk0260b.jpg" alt="Despachador" onerror="this.src='https://placehold.co/300x250?text=Despachador'"></div>
                    <div class="product-body">
                        <span class="product-sku">WK0260B</span>
                        <p class="product-name">Despachador de agua con fábrica de hielo</p>
                        <span class="product-price-old">$8,599.00</span>
                        <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                    </div>
                    <a href="vista/Producto/detalle.php?sku=WK0260B" class="btn-mas-info">Más información</a>
                </div></div>
                <div class="col"><div class="product-card">
                    <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/refrigerador-wrs315snhm.jpg" alt="Refrigerador" onerror="this.src='https://placehold.co/300x250?text=Refrigerador'"></div>
                    <div class="product-body">
                        <span class="product-sku">WRS315SNHM</span>
                        <p class="product-name">Refrigerador Side by Side 25 pies con despachador de agua y hielo</p>
                        <span class="product-price-old">$28,999.00</span>
                        <div class="product-price-row"><span class="product-price">$22,499.00</span></div>
                    </div>
                    <a href="vista/Producto/detalle.php?sku=WRS315SNHM" class="btn-mas-info">Más información</a>
                </div></div>
            </div>

        </div>
    </main>

    <footer class="site-footer text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h6 class="text-uppercase fw-bold mb-4">LuchanosCorp</h6>
                    <p class="text-white-50 small">Líderes en tecnología para el hogar con el respaldo de las mejores marcas mundiales.</p>
                </div>
                <div class="col-md-2">
                    <h6 class="text-uppercase fw-bold mb-4">Productos</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">Lavadoras</a></li>
                        <li class="mb-2"><a href="#">Estufas</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h6 class="text-uppercase fw-bold mb-4">Soporte</h6>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="#">Garantías</a></li>
                        <li class="mb-2"><a href="#">Contacto</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4 border-secondary">
            <div class="text-center text-white-50 small">
                <p>© 2026 LuchanosCorp S.A. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>
</html>