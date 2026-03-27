<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp| Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>

    <!-- Top info bar -->
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
               <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
        </div>
    </div>
</div>

    <!-- Main navbar -->
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
                <a href="../Producto/carrito.php" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="login.php" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
        </div>
    </div>

    <!-- Login card -->
    <div class="login-wrapper">
        <div class="login-card">
            <h4>Inicio de Sesión</h4>
            <p class="subtitle">Inicia sesión con su correo y contraseña</p>

            <div class="mb-3">
                <label class="form-label" for="correo">Correo</label>
                <input type="email" id="correo" class="form-control" placeholder="ejemplo@correo.com">
            </div>

            <div class="mb-1">
                <label class="form-label" for="password">Contraseña</label>
                <div class="password-wrapper">
                    <input type="password" id="password" class="form-control pe-5" placeholder="••••••••">
                    <span class="toggle-pw" onclick="togglePassword()">
                        <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                </div>
            </div>

            <!-- <a href="#" class="forgot-link">¿Haz olvidado la contraseña?</a>-->
            <a href="../Cuenta/recuperar_cuenta.php" class="forgot-link" target="_blank" ...>¿Haz olvidado la contraseña?</a>
            <button class="btn-login mt-3">Enviar</button>

            <div class="login-divider"></div>

            <p class="register-text">
                ¿Aún no tiene una cuenta? <a href="Registro.php">Regístrese aquí</a>
            </p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer-minimal">
        © 2026 LuchanosCorp S.A. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>