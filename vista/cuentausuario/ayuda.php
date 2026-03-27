<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Ayuda y Soporte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;600;700&family=DM+Serif+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../estilos/styles.css">
    <link rel="stylesheet" href="../../estilos/ayuda.css">
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
            <a href="#" class="topbar-link-muted">Ayuda</a>
        </div>
    </div>
</div>

<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="../Producto/carrito.php" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="login.php" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>
<!-- ══ HERO ══════════════════════════════════════════════════════ -->
<section class="ayuda-hero">
    <div class="container position-relative">
        <span class="badge-tag"><i class="fas fa-headset me-1"></i> Centro de Ayuda</span>
        <h1>¿En qué podemos<br>ayudarte hoy?</h1>
        <p>Nuestro equipo de soporte está listo para resolver tus dudas y atender tus quejas a la brevedad.</p>
        <i class="fas fa-comments icon-hero"></i>
    </div>
</section>

<!-- ══ TARJETAS RÁPIDAS ══════════════════════════════════════════ -->
<div class="container quick-cards">
    <div class="row g-3">
        <div class="col-6 col-md-3">
            <a href="queja.php" class="quick-card">
                <div class="ic" style="background:#e8eeff; color:#002366;"><i class="fas fa-file-alt"></i></div>
                <h6>Enviar queja</h6>
                <small>Formulario de soporte</small>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="../rastrear_pedido.php" class="quick-card">
                <div class="ic" style="background:#e0faff; color:#0097b2;"><i class="fas fa-shipping-fast"></i></div>
                <h6>Rastrear pedido</h6>
                <small>Estado de tu entrega</small>
            </a>
        </div>
        <div class="col-6 col-md-3">
            <a href="Vista/Devoluciones/devolucion.php" class="quick-card">
                <div class="ic" style="background:#e0f5f1; color:#00897b;"><i class="fas fa-undo-alt"></i></div>
                <h6>Devoluciones</h6>
                <small>Cambios y reembolsos</small>
            </a>
        </div>
    </div>
</div>



<!-- ══ FOOTER ════════════════════════════════════════════════════ -->
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
                    <li class="mb-2"><a href="ayuda.php">Ayuda</a></li>
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
<script src="js/ayuda.js"></script>
</body>
</html>