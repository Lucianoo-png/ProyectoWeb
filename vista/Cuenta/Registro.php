 <div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
        </div>
    </div>
</div>

    <!-- Main navbar -->
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
                <a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="/proyectoweb/login" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
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

    <!-- Formulario de registro -->
    <div class="register-wrapper">
        <div class="register-card">

            <!-- Header de la tarjeta -->
            <div class="register-card-header">
                <h5><i class="fas fa-user-plus me-2"></i>Formulario de registro nuevo usuario</h5>
            </div>

            <!-- Body -->
            <div class="register-card-body">
                <p class="section-label">Datos Personales</p>

                <div class="row g-3">

                    <!-- Nombre -->
                    <div class="col-md-6">
                        <label class="form-label" for="nombre">Nombre</label>
                        <input type="text" id="nombre" class="form-control" placeholder="Tu nombre">
                    </div>

                    <!-- Apellidos -->
                    <div class="col-md-6">
                        <label class="form-label" for="apellidos">Apellidos</label>
                        <input type="text" id="apellidos" class="form-control" placeholder="Tus apellidos">
                    </div>

                    <!-- Correo -->
                    <div class="col-md-6">
                        <label class="form-label" for="correo">Correo</label>
                        <input type="email" id="correo" class="form-control" placeholder="ejemplo@correo.com">
                    </div>

                    <!-- Teléfono -->
                    <div class="col-md-6">
                        <label class="form-label" for="telefono">Teléfono</label>
                        <input type="tel" id="telefono" class="form-control" placeholder="10 dígitos">
                    </div>

                    <!-- Contraseña -->
                    <div class="col-md-6">
                        <label class="form-label" for="password">Contraseña</label>
                        <div class="pw-wrapper">
                            <input type="password" id="password" class="form-control pe-5" placeholder="••••••••">
                            <span class="pw-toggle" onclick="togglePw('password','eye1')">
                                <i class="fas fa-eye" id="eye1"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-md-6">
                        <label class="form-label" for="confirmPassword">Confirmar Contraseña</label>
                        <div class="pw-wrapper">
                            <input type="password" id="confirmPassword" class="form-control pe-5" placeholder="••••••••">
                            <span class="pw-toggle" onclick="togglePw('confirmPassword','eye2')">
                                <i class="fas fa-eye" id="eye2"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Dirección (ancho completo) -->
                    <div class="col-12">
                        <label class="form-label" for="direccion">Dirección</label>
                        <textarea id="direccion" class="form-control" rows="3"
                                  placeholder="Calle, número, colonia, ciudad..."></textarea>
                    </div>

                </div>

                <!-- Botón -->
                <div class="text-center mt-4">
                    <button class="btn-register">Enviar</button>
                </div>

                <!-- Redirigir a login -->
                <p class="login-redirect">
                    ¿Ya tienes cuenta? <a href="/proyectoweb/login">Inicia sesión aquí</a>
                </p>
            </div>
        </div>
    </div>
    <?php include('vista/footer_gral.php'); ?>