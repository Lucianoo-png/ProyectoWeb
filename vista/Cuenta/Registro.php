<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroPendejo | Crear Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
    <style>
        /* ── Tarjeta de registro ── */
        .register-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem 1rem;
        }

        .register-card {
            background: #fff;
            border-radius: .75rem;
            box-shadow: 0 4px 30px rgba(0, 35, 102, .12);
            width: 100%;
            max-width: 640px;
            overflow: hidden;
        }

        /* Encabezado de la tarjeta */
        .register-card-header {
            background-color: #d6e4f0;
            padding: .85rem 1.75rem;
            border-bottom: 1px solid #c3d8eb;
        }
        .register-card-header h5 {
            font-size: .9rem;
            font-weight: 600;
            color: #002366;
            margin: 0;
            letter-spacing: .03em;
        }

        /* Cuerpo */
        .register-card-body {
            padding: 1.75rem 2rem 2rem;
        }

        .section-label {
            font-size: .68rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #555;
            margin-bottom: 1rem;
            border-bottom: 1px solid #e8eef6;
            padding-bottom: .35rem;
        }

        .form-label {
            font-size: .8rem;
            font-weight: 600;
            color: #333;
            margin-bottom: .25rem;
        }

        .form-control {
            border-color: #c8d3e8;
            border-radius: .4rem;
            font-size: .88rem;
            padding: .5rem .75rem;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--btn-color);
            box-shadow: 0 0 0 3px rgba(0, 140, 168, .15);
        }

        textarea.form-control { resize: none; }

        .btn-register {
            background-color: var(--btn-color);
            border: none;
            color: #fff;
            font-weight: 600;
            letter-spacing: .05em;
            padding: .65rem 3rem;
            border-radius: .4rem;
            transition: background .2s, transform .1s;
            cursor: pointer;
        }
        .btn-register:hover {
            background-color: var(--btn-hover);
            transform: translateY(-1px);
        }
        .btn-register:active { transform: translateY(0); }

        .login-redirect {
            font-size: .82rem;
            color: #555;
            text-align: center;
            margin-top: 1rem;
        }
        .login-redirect a {
            color: var(--btn-color);
            font-weight: 600;
            text-decoration: none;
        }
        .login-redirect a:hover { text-decoration: underline; }

        /* Toggle contraseña */
        .pw-wrapper { position: relative; }
        .pw-toggle {
            position: absolute;
            right: .75rem;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #888;
            font-size: .82rem;
        }
        .pw-toggle:hover { color: var(--btn-color); }
    </style>
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
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">ELECTRO</span><span class="pendejo">Pendejo</span>
            </a>

            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>

            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="#" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="login.php" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
            </div>
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
                    ¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="site-footer-minimal">
        © 2026 ElectroPendejo S.A. Todos los derechos reservados.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePw(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon  = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>
</body>
</html>