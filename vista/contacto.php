<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Contacto</title>

    <!-- Bootstrap 5.3.2 CSS desde CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>

    <!-- CSS Global del sitio -->
    <link rel="stylesheet" href="../estilos/styles.css">

    <!-- CSS Específico de Contacto (archivo separado) -->
    <link rel="stylesheet" href="../estilos/contacto.css">
</head>
<body>

<?php
/* ─── Topbar ─────────────────────────────────────── */
?>
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
        </div>
    </div>
</div>

<?php /* ─── Navbar ─────────────────────────────────── */ ?>
<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="Producto/carrito.php" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<?php /* ─── Barra de categorías ─────────────────── */ ?>
<div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
    <div class="container">
        <ul class="nav nav-categories justify-content-center">
            <li class="nav-item"><a class="nav-link" href="Producto/linea_blanca.php">Línea Blanca</a></li>
            <li class="nav-item"><a class="nav-link" href="Producto/linea_marron.php">Línea Marrón</a></li>
            <li class="nav-item"><a class="nav-link" href="Producto/cocina.php">Cocina</a></li>
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
                            <a class="dropdown-item" href="Producto/OtrasCategorias/lavadoras.php"><i class="fas fa-tshirt"></i> Lavadoras</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/secadoras.php"><i class="fas fa-wind"></i> Secadoras</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/lavasecadoras.php"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                            <h6 class="mt-3">Refrigeración</h6>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/refrigeradores.php"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/congeladores.php"><i class="fas fa-cube"></i> Congeladores</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/frigobar.php"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                        </div>
                        <div class="col-6 category-col">
                            <h6>Cocina</h6>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/hornos.php"><i class="fas fa-fire"></i> Hornos</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/estufas.php"><i class="fas fa-burn"></i> Estufas</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/microondas.php"><i class="fas fa-blender"></i> Microondas</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/lavavajillas.php"><i class="fas fa-utensils"></i> Lavavajillas</a>
                            <h6 class="mt-3">Bienestar</h6>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/cuidado_hogar.php"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                            <a class="dropdown-item" href="Producto/OtrasCategorias/cuidado_personal.php"><i class="fas fa-spa"></i> Cuidado Personal</a>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>

<?php /* ─── Breadcrumb ──────────────────────────── */ ?>
<div class="bg-white border-bottom py-2">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="../index.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Contacto</li>
            </ol>
        </nav>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════
     HERO
════════════════════════════════════════════════════════ -->
<div class="contact-hero">
    <div class="container">
        <div class="d-flex align-items-center gap-3 mb-2">
            <i class="fas fa-headset fa-2x" style="opacity:.85"></i>
            <div>
                <h1 class="mb-0">Contáctanos</h1>
                <p>Estamos aquí para ayudarte. Escríbenos, llámanos o visítanos.</p>
            </div>
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════
     TARJETAS DE CONTACTO
════════════════════════════════════════════════════════ -->
<main class="py-2 pb-5">
    <div class="container">

        <div class="row g-3 mb-4">

            <!-- Teléfono -->
            <div class="col-6 col-md-3">
                <div class="contact-info-card text-center">
                    <div class="contact-info-icon mx-auto">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h6>Teléfono</h6>
                    <p>
                        <a href="tel:8001234567">800-123-4567</a><br>
                        <span style="font-size:.78rem;color:#9ca3af">Lunes – Sábado, 9 am – 7 pm</span>
                    </p>
                </div>
            </div>

            <!-- Correo -->
            <div class="col-6 col-md-3">
                <div class="contact-info-card text-center">
                    <div class="contact-info-icon mx-auto">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6>Correo electrónico</h6>
                    <p>
                        <a href="mailto:soporte@LuchanosCorp.com">soporte@LuchanosCorp.com</a><br>
                        <a href="mailto:ventas@LuchanosCorp.com">ventas@LuchanosCorp.com</a>
                    </p>
                </div>
            </div>

            <!-- WhatsApp -->
            <div class="col-6 col-md-3">
                <div class="contact-info-card text-center">
                    <div class="contact-info-icon mx-auto" style="background:rgba(37,211,102,.1);color:#25d366">
                        <i class="fab fa-whatsapp"></i>
                    </div>
                    <h6>WhatsApp</h6>
                    <p>
                        <a href="https://wa.me/522291234567" target="_blank">+52 229 123 4567</a><br>
                        <span style="font-size:.78rem;color:#9ca3af">Chat en línea disponible</span>
                    </p>
                </div>
            </div>

            <!-- Dirección -->
            <div class="col-6 col-md-3">
                <div class="contact-info-card text-center">
                    <div class="contact-info-icon mx-auto">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h6>Sucursal Principal</h6>
                    <p>Av. Ej. de Oriente 2260,<br>Veracruz, Ver., C.P. 91780<br>México</p>
                </div>
            </div>

        </div>
<!--
         ═══════════════════════════════════════════
             FORMULARIO + INFO EXTRA
        ════════════════════════════════════════════ -->
        <div class="row g-4">

         
        <!-- INFO EXTRA: Horarios + Redes + Mapa -->
        <!-- Agregamos 'mx-auto' para centrar toda la columna -->
        <div class="col-lg-5 d-flex flex-column gap-3 mx-auto">

            <!-- Horarios de atención (Tarjeta separada) -->
            <div class="contact-info-card text-center">
                <h6><i class="fas fa-clock me-2" style="color:var(--btn-color)"></i>Horarios de Atención</h6>
                <table class="horario-table w-100 mt-2">
                    <tr>
                        <td>Lunes – Viernes</td>
                        <td>9:00 am – 7:00 pm <span class="badge-abierto">Abierto</span></td>
                    </tr>
                    <tr>
                        <td>Sábado</td>
                        <td>10:00 am – 5:00 pm <span class="badge-abierto">Abierto</span></td>
                    </tr>
                    <tr>
                        <td>Domingo</td>
                        <td style="color:#dc2626;font-weight:600">Cerrado</td>
                    </tr>
                    <tr>
                        <td>Días festivos</td>
                        <td style="color:#d97706;font-weight:600">Horario especial</td>
                    </tr>
                </table>
                <p class="mt-2 mb-0" style="font-size:.78rem;color:#9ca3af">
                    <i class="fas fa-headset me-1"></i> Soporte vía correo disponible 24/7.
                </p>
            </div>

            <!-- Síguenos en Redes (Tarjeta separada) -->
            <div class="contact-info-card text-center">
                <h6><i class="fas fa-share-alt me-2" style="color:var(--btn-color)"></i>Síguenos en Redes</h6>
                <p style="font-size:.83rem;color:#6b7280;margin-bottom:.85rem">
                    Mantente al tanto de ofertas y novedades.
                </p>
                <div class="social-grid">
                    <a href="https://www.facebook.com/LuchanosCorp" target="_blank" class="social-btn facebook">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="https://www.instagram.com/LuchanosCorp" target="_blank" class="social-btn instagram">
                        <i class="fab fa-instagram"></i> Instagram
                    </a>
                    <a href="https://twitter.com/LuchanosCorp" target="_blank" class="social-btn twitter">
                        <i class="fab fa-twitter"></i> X / Twitter
                    </a>
                    <a href="https://www.youtube.com/@LuchanosCorp" target="_blank" class="social-btn youtube">
                        <i class="fab fa-youtube"></i> YouTube
                    </a>
                    <a href="https://wa.me/522291234567" target="_blank" class="social-btn whatsapp">
                        <i class="fab fa-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.tiktok.com/@LuchanosCorp" target="_blank" class="social-btn tiktok">
                        <i class="fab fa-tiktok"></i> TikTok
                    </a>
                </div>
            </div>

            <!-- Mapa -->

        </div>

                <!-- Mapa -->
                <div class="map-wrap">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.0!2d-96.134!3d19.163!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTnCsDA5JzQ2LjgiTiA5NsKwMDgnMDMuNiJX!5e0!3m2!1ses!2smx!4v1680000000000!5m2!1ses!2smx"
                        allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Ubicación LuchanosCorp">
                    </iframe>
                </div>

            </div>
        </div>

        <!-- ═══════════════════════════════════════════
             SUCURSALES
        ════════════════════════════════════════════ -->
        <div class="mt-5">
            <div class="mb-3"><span class="section-title">Nuestras Sucursales</span></div>
            <div class="row g-3">

                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="contact-info-icon" style="width:38px;height:38px;font-size:1rem;flex-shrink:0">
                                <i class="fas fa-store"></i>
                            </div>
                            <h6 class="mb-0">Sucursal Centro</h6>
                        </div>
                        <p class="mb-1">Av. Ej. de Oriente 2260, Centro Histórico<br>Veracruz, Ver. C.P. 91780</p>
                        <p class="mb-1"><i class="fas fa-phone-alt me-1" style="color:var(--btn-color)"></i>
                            <a href="tel:2291234567">229 123 4567</a></p>
                        <p class="mb-0"><i class="fas fa-clock me-1" style="color:var(--btn-color)"></i>
                            <span style="font-size:.82rem">Lun–Vie 9–7 pm · Sáb 10–5 pm</span></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="contact-info-icon" style="width:38px;height:38px;font-size:1rem;flex-shrink:0">
                                <i class="fas fa-store"></i>
                            </div>
                            <h6 class="mb-0">Sucursal Boca del Río</h6>
                        </div>
                        <p class="mb-1">Blvd. Manuel Ávila Camacho 3150<br>Boca del Río, Ver. C.P. 94290</p>
                        <p class="mb-1"><i class="fas fa-phone-alt me-1" style="color:var(--btn-color)"></i>
                            <a href="tel:2297654321">229 765 4321</a></p>
                        <p class="mb-0"><i class="fas fa-clock me-1" style="color:var(--btn-color)"></i>
                            <span style="font-size:.82rem">Lun–Vie 9–7 pm · Sáb 10–5 pm</span></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="contact-info-card">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <div class="contact-info-icon" style="width:38px;height:38px;font-size:1rem;flex-shrink:0">
                                <i class="fas fa-store"></i>
                            </div>
                            <h6 class="mb-0">Sucursal Xalapa</h6>
                        </div>
                        <p class="mb-1">Av. Lázaro Cárdenas 800, Col. Unidad<br>Xalapa, Ver. C.P. 91010</p>
                        <p class="mb-1"><i class="fas fa-phone-alt me-1" style="color:var(--btn-color)"></i>
                            <a href="tel:2289876543">228 987 6543</a></p>
                        <p class="mb-0"><i class="fas fa-clock me-1" style="color:var(--btn-color)"></i>
                            <span style="font-size:.82rem">Lun–Vie 9–7 pm · Sáb 10–5 pm</span></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
</main>

<!-- ═══════════════════════════════════════════════════════
     FOOTER
════════════════════════════════════════════════════════ -->
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
                    <li class="mb-2"><a href="Producto/OtrasCategorias/lavadoras.php">Lavadoras</a></li>
                    <li class="mb-2"><a href="Producto/OtrasCategorias/estufas.php">Estufas</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-uppercase fw-bold mb-4">Soporte</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="contacto.php">Contacto</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="text-center text-white-50 small">
            <p class="mb-0">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>

<!-- Bootstrap 5.3.2 JavaScript Bundle (incluye Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Scripts globales del sitio -->
<script src="../js/scripts.js"></script>
<script src="../js/contacto.js"></script>

</body>
</html>