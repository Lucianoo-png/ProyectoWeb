<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroPendejo | Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <!-- ✅ Ruta desde: PROYECTOWEB/ -->
    <link rel="stylesheet" href="estilos/styles.css">
</head>
<body>

    <!-- Top info bar -->
    <div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> contacto@gmail.com</span>
            </div>
            <div>
                <a href="#" class="me-3">Rastrear Pedido</a>
                <a href="#">Ayuda</a>
            </div>
        </div>
    </div>

    <!-- Main navbar -->
    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="index.php" class="brand-logo me-3">
                <span class="electro">ELECTRO</span><span class="pendejo">Pendejo</span>
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

    <!-- Navbar Categorías -->
    <div class="bg-white border-bottom shadow-sm sticky-top">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">

                <li class="nav-item">
                    <a class="nav-link" href="#">Línea Blanca</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Línea Marrón</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Cocina</a>
                </li>

                <!-- DROPDOWN -->
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
                                <a class="dropdown-item" href="#"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-blender"></i> Microondas</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="#"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </div>

    <!-- Contenido principal -->
    <main class="py-5">
        <div class="container">
            <div class="text-center py-5 border bg-white shadow-sm">
                <h2 class="fw-light">Contenido Principal</h2>
                <p class="text-muted">Aquí va un carrusel.</p>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="site-footer text-white pt-5 pb-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h6 class="text-uppercase fw-bold mb-4">ElectroPendejo</h6>
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
                <p>© 2026 ElectroPendejo S.A. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>