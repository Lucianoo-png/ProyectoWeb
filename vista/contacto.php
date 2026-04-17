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
        <?php if(isset($_SESSION["NoCliente"])){ ?>
        <div class="d-flex gap-3">
            <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
        </div>
        <?php } ?>
    </div>
</div>

<?php /* ─── Navbar ─────────────────────────────────── */ ?>
<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="/proyectoweb/?" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
           <?php if(isset($_SESSION["NoCliente"])){ ?><a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a> <?php } ?>
            <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<?php /* ─── Barra de categorías ─────────────────── */ ?>
<div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
    <div class="container">
        <ul class="nav nav-categories justify-content-center">
            <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-blanca">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-marron">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/cocina">Cocina</a></li>
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
                                <a class="dropdown-item" href="/proyectoweb/lavadoras"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/secadoras"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/lavasecadoras"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="/proyectoweb/refrigeradores"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="/proyectoweb/congeladores"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="/proyectoweb/frigobar"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="/proyectoweb/hornos"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="/proyectoweb/estufas"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="/proyectoweb/microondas"><i class="fas fa-blender"></i> Microondas</a>
                                <a class="dropdown-item" href="/proyectoweb/lavavajillas"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-hogar"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-personal"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                    </div>
                </div>
            </li>
        </ul>
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

        <div class="row g-3 mb-4 justify-content-center">

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
                    <h6>Sucursal</h6>
                    <p>Av. Ej. de Oriente 2260,<br>Veracruz, Ver., C.P. 91780<br>México</p>
                </div>
            </div>

        </div>
<!--
         ═══════════════════════════════════════════
             FORMULARIO + INFO EXTRA
        ════════════════════════════════════════════ -->
        <div class="row g-4 justify-content-center">

            <!-- Horarios de atención -->
            <div class="col-lg-5">
            <div class="contact-info-card text-center h-100">
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

            </div><!-- /.col horarios -->

            <!-- Síguenos en Redes -->
            <div class="col-lg-5">
            <div class="contact-info-card text-center h-100">
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
            </div><!-- /.col redes -->

        </div><!-- /.row -->
    </div><!-- /.container -->
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
                    <li class="mb-2"><a href="/proyectoweb/lavadoras">Lavadoras</a></li>
                    <li class="mb-2"><a href="/proyectoweb/estufas">Estufas</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h6 class="text-uppercase fw-bold mb-4">Soporte</h6>
                <ul class="list-unstyled small">
                    <li class="mb-2"><a href="/proyectoweb/contacto">Contacto</a></li>
                </ul>
            </div>
        </div>
        <hr class="my-4 border-secondary">
        <div class="text-center text-white-50 small">
            <p class="mb-0">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</p>
        </div>
    </div>
</footer>
</html>