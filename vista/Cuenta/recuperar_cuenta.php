<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp| Recuperación de Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>

    <!-- Topbar -->
    <div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
            </div>
                <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
        </div>
    </div>

    <!-- Main Nav -->
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

    <!-- Contenido centrado igual que login -->
    <div class="login-wrapper">
        <div class="login-card">

            <h4 class="mb-1">Recuperación de cuenta</h4>
            <p class="subtitle text-center">Ingresa tus datos para restablecer tu contraseña</p>

            <?php if (!empty($_GET['enviado'])): ?>
            <div class="alert alert-success py-2 small" role="alert">
                <i class="fas fa-check-circle me-1"></i>
                Correo de recuperación enviado. Revisa tu bandeja de entrada.
            </div>
            <?php endif; ?>

            <?php if (!empty($_GET['error'])): ?>
            <div class="alert alert-danger py-2 small" role="alert">
                <i class="fas fa-exclamation-circle me-1"></i>
                No se encontró ninguna cuenta con esos datos.
            </div>
            <?php endif; ?>

            <form action="recuperar_contrasena.php" method="POST" novalidate class="needs-validation">

                <!-- ID -->
                <div class="mb-3">
                    <label for="id_usuario" class="form-label">
                        Ingresa tu ID: <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        id="id_usuario"
                        name="id_usuario"
                        class="form-control"
                        required
                    >
                    <div class="invalid-feedback">Por favor ingresa tu ID.</div>
                </div>

                <!-- Usuario -->
                <div class="mb-3">
                    <label for="usuario" class="form-label">
                        Ingresa tu usuario: <span class="text-danger">*</span>
                    </label>
                    <input
                        type="text"
                        id="usuario"
                        name="usuario"
                        class="form-control"
                        required
                    >
                    <div class="invalid-feedback">Por favor ingresa tu usuario.</div>
                </div>

                <!-- Correo de recuperación -->
                <div class="mb-3">
                    <label for="correo_recuperacion" class="form-label">
                        Ingresa un correo electrónico de recuperación: <span class="text-danger">*</span>
                    </label>
                    <input
                        type="email"
                        id="correo_recuperacion"
                        name="correo_recuperacion"
                        class="form-control"
                        required
                    >
                    <div class="invalid-feedback">Por favor ingresa un correo válido.</div>
                </div>

                <button type="submit" class="btn-login">Enviar correo</button>

            </form>

        </div>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
    <script>
        (() => {
            'use strict';
            const forms = document.querySelectorAll('.needs-validation');
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>

</body>
</html>