<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
    </div>
</div>

    <!-- Main navbar -->
    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="/proyectoweb/?" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>

          <div class="input-group search-bar flex-grow-1 mx-lg-4 position-relative">
    <!-- Le agregamos el id="buscadorEnVivo" y autocomplete="off" para que el navegador no estorbe -->
    <input type="text" id="buscadorEnVivo" class="form-control" placeholder="¿Qué estás buscando?" autocomplete="off">
    
    <!-- Contenedor flotante para los resultados (oculto por defecto) -->
    <div id="resultadosBuscador" class="dropdown-menu w-100 shadow-lg" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050; max-height: 300px; overflow-y: auto; border-radius: 0 0 8px 8px;">
        <!-- Aquí entrarán las sugerencias por JS -->
    </div>
</div>

            <div class="d-flex align-items-center gap-3 ms-2">
                 <?php if(isset($_SESSION["NoCliente"])){ ?><a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a> <?php } ?>
                <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

<!-- BUSCADOR MÓVIL (visible solo en ≤768px via responsive.css) -->
<div class="search-bar-mobile">
    <div class="input-group">
        <input type="text"
               id="buscadorMovil"
               class="form-control"
               placeholder="¿Qué estás buscando?"
               autocomplete="off">
        <button class="btn-buscar-movil" type="button" aria-label="Buscar">
            <i class="fas fa-search"></i>
        </button>
        <div id="resultadosBuscadorMovil"
             class="dropdown-menu w-100 shadow-lg"
             style="display:none; position:absolute; top:100%; left:0; z-index:1050; max-height:60vh; overflow-y:auto; border-radius:0 0 8px 8px;">
        </div>
    </div>
</div>

    <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-blanca">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-marron">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/cocina">Cocina</a></li>
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
                                <a class="dropdown-item" href="/proyectoweb/microondas">
                                    <svg style="width:1em;height:1em;vertical-align:-0.125em;flex-shrink:0"
         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 13H5V7h14v10zm-8-8H7v6h4v-6zm5 4.5c.83 0 1.5-.67 1.5-1.5S16.83 11 16 11s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm0-4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
    </svg> Microondas
                                </a>
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

    <!-- Login card -->
    <div class="login-wrapper">
        <form action="/proyectoweb/login" method="POST">
        <div class="login-card">
            <h4>Inicio de Sesión</h4>
            <p class="subtitle">Inicia sesión con su correo y contraseña</p>

            <?php if(count($msj)>0){?><div class="alerta alerta-<?php echo $msj[0]; ?>"><?php echo $msj[1]; ?></div><?php } //error, exito, info ?>

            <div class="mb-3">
                <label class="form-label" for="correo">Correo</label>
                <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com">
            </div>

            <div class="mb-1">
                <label class="form-label" for="password">Contraseña</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" class="form-control pe-5" placeholder="••••••••">
                    <span class="toggle-pw" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <!-- <a href="#" class="forgot-link">¿Haz olvidado la contraseña?</a>-->
            <a href="/proyectoweb/forgot-password" class="forgot-link">¿Haz olvidado la contraseña?</a>
            <button type="submit" name="login" class="btn-login mt-3">Enviar</button>

            <div class="login-divider"></div>

            <p class="register-text">
                ¿Aún no tiene una cuenta? <a href="/proyectoweb/registro">Regístrese aquí</a>
            </p>
        </div>
        </form>
    </div>
    <?php include('vista/footer_gral.php'); ?>