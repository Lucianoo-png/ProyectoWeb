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

<?php
$pathBase          = '';           
$mostrarCategorias = true;
$categoriaActiva   = '';
include 'includes/../control/navbar.php';
?>

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
                    <div class="product-price-row"><span class="product-price">$4,599.00</span></div>
                </div>
                <a href="vista/Producto/detalle.php?sku=WM3911D" class="btn-mas-info">Más información</a>
            </div></div>
            <div class="col"><div class="product-card">
                <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg" alt="Lavadora" onerror="this.src='https://placehold.co/300x250?text=Lavadora'"></div>
                <div class="product-body">
                    <span class="product-sku">8MWTW2024WJM</span>
                    <p class="product-name">Lavadora 20kg Carga Superior Xpert System Blanca Agitador</p>
                    <div class="product-price-row"><span class="product-price">$9,999.00</span></div>
                </div>
                <a href="vista/Producto/detalle.php?sku=8MWTW2024WJM" class="btn-mas-info">Más información</a>
            </div></div>
            <div class="col"><div class="product-card">
                <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/despachador-wk0260b.jpg" alt="Despachador" onerror="this.src='https://placehold.co/300x250?text=Despachador'"></div>
                <div class="product-body">
                    <span class="product-sku">WK0260B</span>
                    <p class="product-name">Despachador de agua con fábrica de hielo</p>
                    <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                </div>
                <a href="vista/Producto/detalle.php?sku=WK0260B" class="btn-mas-info">Más información</a>
            </div></div>
            <div class="col"><div class="product-card">
                <div class="product-img-wrap"><img src="multimedia/Imagenes/productos/refrigerador-wrs315snhm.jpg" alt="Refrigerador" onerror="this.src='https://placehold.co/300x250?text=Refrigerador'"></div>
                <div class="product-body">
                    <span class="product-sku">WRS315SNHM</span>
                    <p class="product-name">Refrigerador Side by Side 25 pies con despachador de agua y hielo</p>
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
                    <li class="mb-2"><a href="Vista/Producto/OtrasCategorias/lavadoras.php">Lavadoras</a></li>
                    <li class="mb-2"><a href="Vista/Producto/OtrasCategorias/estufas.php">Estufas</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-uppercase fw-bold mb-4">Soporte</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="vista/contacto.php">Contacto</a></li>
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