<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Mi Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
<body>

<!-- Topbar -->
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

<!-- Navbar -->
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
            <a href="../Producto/carrito.php" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="../../vista/Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<!-- Layout cuenta -->
<div class="cuenta-layout">

    <!-- Sidebar -->
    <aside class="cuenta-sidebar">
        <div class="cuenta-sidebar-header">
            <div class="cuenta-avatar">CL</div>
            <p class="cuenta-sidebar-name">Carlos Ivan Luciano</p>
            <p class="cuenta-sidebar-email">carlosluciano260@gmail.com</p>
        </div>
        <nav class="cuenta-nav">
            <button class="cuenta-nav-link active" onclick="switchPanel('panel-datos', this)">
                <i class="fas fa-user-edit"></i> Mis Datos
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-direcciones', this)">
                <i class="fas fa-map-marker-alt"></i> Mis Direcciones
            </button>
            <hr class="cuenta-nav-divider">
            <button class="cuenta-nav-link" onclick="switchPanel('panel-pedidos', this)">
                <i class="fas fa-box-open"></i> Mis Pedidos
            </button>
            <hr class="cuenta-nav-divider">
            <a href="../../vista/Cuenta/login.php" class="cuenta-nav-link" style="color:#dc3545">
                <i class="fas fa-sign-out-alt" style="color:#dc3545"></i> Cerrar Sesión
            </a>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main>

        <!-- ══ PANEL: MIS DATOS ══════════════════════════════════ -->
        <div class="cuenta-panel active" id="panel-datos">

            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-id-card"></i> Información Personal</span>
                    <button class="btn-cuenta-edit" id="btnEditarDatos" onclick="toggleEditDatos()">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </div>
                <div class="cuenta-card-body">

                    <!-- Vista datos -->
                    <div id="vistaData">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Nombre completo</div>
                                    <div class="perfil-valor" id="vNombre">Carlos Ivan Luciano Cruz</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Teléfono</div>
                                    <div class="perfil-valor" id="vTel">229-483-2504</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Correo electrónico</div>
                                    <div class="perfil-valor" id="vEmail">carlosluciano260@gmail.com</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Fecha de nacimiento</div>
                                    <div class="perfil-valor" id="vFecha">13 de agosto de 2004</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de edición -->
                    <div id="formData" style="display:none">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre completo</label>
                                <input type="text" id="eNombre" class="form-control"
                                       value="Carlos Ivan Luciano Cruz">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono</label>
                                <input type="tel" id="eTel" class="form-control"
                                       value="229-483-2504">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Correo electrónico</label>
                                <input type="email" id="eEmail" class="form-control"
                                       value="carlosluciano260@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Fecha de nacimiento</label>
                                <input type="date" id="eFecha" class="form-control" value="2004-08-13">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn-cuenta-save" onclick="guardarDatos()">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                            <button class="btn-cuenta-cancel" onclick="cancelarEditDatos()">
                                Cancelar
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Cambio de contraseña -->
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-lock"></i> Cambiar Contraseña</span>
                </div>
                <div class="cuenta-card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Contraseña actual</label>
                            <div class="password-wrapper">
                                <input type="password" id="pwActual" class="form-control"
                                       placeholder="••••••••">
                                <i class="fas fa-eye toggle-pw" onclick="togglePw('pwActual','iconPwA')" id="iconPwA"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Nueva contraseña</label>
                            <div class="password-wrapper">
                                <input type="password" id="pwNueva" class="form-control"
                                       placeholder="Mínimo 8 caracteres">
                                <i class="fas fa-eye toggle-pw" onclick="togglePw('pwNueva','iconPwN')" id="iconPwN"></i>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold small">Confirmar contraseña</label>
                            <div class="password-wrapper">
                                <input type="password" id="pwConfirm" class="form-control"
                                       placeholder="Repetir contraseña">
                                <i class="fas fa-eye toggle-pw" onclick="togglePw('pwConfirm','iconPwC')" id="iconPwC"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <button class="btn-cuenta-save" onclick="cambiarPassword()">
                            <i class="fas fa-key me-1"></i> Actualizar contraseña
                        </button>
                    </div>
                </div>
            </div>

        </div><!-- /panel-datos -->


        <!-- ══ PANEL: MIS DIRECCIONES ════════════════════════════ -->
        <div class="cuenta-panel" id="panel-direcciones">

            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-map-marker-alt"></i> Mis Direcciones</span>
                    <button class="btn-dir-add" onclick="toggleFormDir()">
                        <i class="fas fa-plus"></i> Nueva dirección
                    </button>
                </div>
                <div class="cuenta-card-body">

                    <!-- Lista de direcciones -->
                    <div id="listaDirecciones">
                        <div class="dir-item">
                            <div class="dir-item-name">Carlos Ivan Luciano Cruz</div>
                            <div class="dir-item-detail">
                               XXXXXXXXX XXX Col. Vías Férreas<br>
                                Veracruz, Ver. 91713 · México<br>
                                Teléfono: 229-483-2504
                            </div>
                            <div class="dir-item-actions">
                                <button class="btn-dir-sec" onclick="editarDireccion(1)">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                                <button class="btn-dir-sec" style="color:#dc3545;border-color:#f5c2c2"
                                        onclick="eliminarDireccion(1)">
                                    <i class="fas fa-trash me-1"></i>Eliminar
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario nueva / editar dirección -->
                    <div id="formDirWrapper" style="display:none">
                        <hr>
                        <h6 class="fw-700 mb-3" id="formDirTitle"
                            style="color:var(--azul-marino);font-weight:700">
                            <i class="fas fa-plus-circle me-2"></i>Nueva dirección
                        </h6>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre completo</label>
                                <input type="text" id="dNombre" class="form-control"
                                       placeholder="Nombre del destinatario">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono</label>
                                <input type="tel" id="dTel" class="form-control"
                                       placeholder="229-000-0000">
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Calle y número</label>
                                <input type="text" id="dCalle" class="form-control"
                                       placeholder="Ej: Av. Independencia 120, Interior 3">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Colonia</label>
                                <input type="text" id="dColonia" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Ciudad</label>
                                <input type="text" id="dCiudad" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">C.P.</label>
                                <input type="text" id="dCP" class="form-control" maxlength="5">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Estado</label>
                                <input type="text" id="dEstado" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">País</label>
                                <input type="text" id="dPais" class="form-control" value="México" readonly>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn-cuenta-save" onclick="guardarDireccion()">
                                <i class="fas fa-save me-1"></i> Guardar dirección
                            </button>
                            <button class="btn-cuenta-cancel" onclick="cancelarDir()">Cancelar</button>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- /panel-direcciones -->


        <!-- ══ PANEL: MIS PEDIDOS ════════════════════════════════ -->
        <div class="cuenta-panel" id="panel-pedidos">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 style="color:var(--azul-marino);font-weight:700;margin:0">Mis Pedidos</h5>
                    <p style="font-size:.8rem;color:#6c757d;margin:0">
                        Consulta y da seguimiento a tus compras.
                    </p>
                </div>
            </div>

            <!-- Tabs En Proceso / En Envío -->
            <div class="pedido-tabs">
                <button class="pedido-tab-btn active"
                        onclick="switchPedidoTab('tab-proceso', this)">
                    <i class="fas fa-cog"></i> En Proceso
                    <span class="tab-badge ms-1">1</span>
                </button>
                <button class="pedido-tab-btn"
                        onclick="switchPedidoTab('tab-envio', this)">
                    <i class="fas fa-truck"></i> En Envío
                    <span class="tab-badge ms-1">1</span>
                </button>
            </div>

            <!-- TAB: EN PROCESO -->
            <div class="pedido-tab-panel active" id="tab-proceso">

                <!-- Pedido 1 -->
                <div class="pedido-card">
                    <div class="pedido-card-header">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0041</strong></div>
                            <div class="pedido-fecha">Realizado el 20 de marzo de 2026</div>
                        </div>
                        <div class="pedido-total">Total: $9,999.00</div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="../../multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg"
                                     onerror="this.src='https://placehold.co/56x56/e8f4fb/002366?text=Prod'"
                                     alt="Lavadora">
                            </div>
                            <div>
                                <div class="pedido-item-name">Lavadora 20kg Carga Superior Xpert System</div>
                                <div class="pedido-item-sku">SKU: 8MWTW2024WJM · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$9,999.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title">
                            <i class="fas fa-map-marker-alt me-1"></i> Estado del pedido
                        </div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">20 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step current">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">Hoy</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /tab-proceso -->

            <!-- TAB: EN ENVÍO -->
            <div class="pedido-tab-panel" id="tab-envio">

                <!-- Pedido 2 -->
                <div class="pedido-card">
                    <div class="pedido-card-header">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0038</strong></div>
                            <div class="pedido-fecha">Realizado el 17 de marzo de 2026</div>
                        </div>
                        <div class="pedido-total">Total: $4,599.00</div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="https://placehold.co/56x56/e8f4fb/002366?text=WM" alt="Microondas">
                            </div>
                            <div>
                                <div class="pedido-item-name">Microondas AirFry 4 en 1 (1CuFt)</div>
                                <div class="pedido-item-sku">SKU: WM3911D · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$4,599.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title">
                            <i class="fas fa-map-marker-alt me-1"></i> Estado del pedido
                        </div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">17 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-check"></i>
                                </div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">18 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step current">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">Hoy</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle">
                                    <i class="fas fa-home"></i>
                                </div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /tab-envio -->

        </div><!-- /panel-pedidos -->

    </main>
</div>

<footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/scripts.js"></script></body>
</html>