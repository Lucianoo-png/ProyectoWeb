<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Nueva Solicitud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
    <link rel="stylesheet" href="../../estilos/solicitud.css">
</head>
<body>

<!-- ══════════ TOPBAR ══════════ -->
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
        </div>
    </div>
</div>

<!-- ══════════ NAV ══════════ -->
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

<!-- ══════════ LAYOUT CUENTA ══════════ -->
<div class="cuenta-layout">

    <!-- ── Sidebar ── -->
    <aside class="cuenta-sidebar">
        <div class="cuenta-sidebar-header">
            <div class="cuenta-avatar">CL</div>
            <p class="cuenta-sidebar-name">Carlos Ivan Luciano</p>
            <p class="cuenta-sidebar-email">carlosluciano260@gmail.com</p>
        </div>
        <nav class="cuenta-nav">
            <a href="inicio_usuario.php" class="cuenta-nav-link">
                <i class="fas fa-user-edit"></i> Mis Datos
            </a>
            <a href="inicio_usuario.php" class="cuenta-nav-link">
                <i class="fas fa-map-marker-alt"></i> Mis Direcciones
            </a>
            <hr class="cuenta-nav-divider">
            <a href="inicio_usuario.php" class="cuenta-nav-link">
                <i class="fas fa-box-open"></i> Mis Pedidos
            </a>
            <a href="inicio_usuario.php" class="cuenta-nav-link active">
                <i class="fas fa-headset"></i> Mis Solicitudes
            </a>
            <hr class="cuenta-nav-divider">
            <a href="login.php" class="cuenta-nav-link" style="color:#dc3545">
                <i class="fas fa-sign-out-alt" style="color:#dc3545"></i> Cerrar Sesión
            </a>
        </nav>
    </aside>

    <!-- ══════════ CONTENIDO ══════════ -->
    <main style="padding: 2rem 1.5rem;">

        <!-- Breadcrumb -->
        <nav class="sol-breadcrumb" aria-label="Breadcrumb">
            <a href="inicio_usuario.php">Mi Cuenta</a>
            <i class="fas fa-chevron-right"></i>
            <a href="inicio_usuario.php">Mis Solicitudes</a>
            <i class="fas fa-chevron-right"></i>
            <span>Nueva solicitud</span>
        </nav>

        <div class="row g-4">

            <!-- ══ Columna principal: formulario ══ -->
            <div class="col-lg-8">

                <h1 class="sol-page-title">
                    <i class="fas fa-plus-circle me-2" style="color:var(--btn-color)"></i>
                    Nueva Solicitud
                </h1>
                <p class="sol-page-sub">
                    Completa los campos para registrar tu solicitud de garantía o devolución.
                </p>

                <div class="cuenta-card">
                    <div class="cuenta-card-body">

                        <p class="sol-required-note">
                            Los campos marcados con <span>*</span> son obligatorios.
                        </p>

                        <!-- ── Sección 1: Datos generales (CreaSolicitud) ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-file-alt me-1"></i> Datos de la solicitud
                        </p>

                        <div class="row g-3">

                            <!-- Tipo — DetalleSolicitud.Tipo -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="solTipo">
                                    Tipo de solicitud <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="solTipo"
                                        onchange="actualizarResumen()">
                                    <option value="">— Seleccionar tipo —</option>
                                    <option value="Garantía">Garantía</option>
                                    <option value="Devolución">Devolución</option>
                                </select>
                                <div class="invalid-feedback">Selecciona el tipo de solicitud.</div>
                            </div>

                            <!-- No. Referencia — CreaSolicitud.NoReferencia -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="solNoReferencia">
                                    No. de referencia de compra <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="solNoReferencia"
                                       placeholder="Ej: LC-2026-0041"
                                       oninput="actualizarResumen()">
                                <div class="form-text">Número de orden asociado al producto.</div>
                                <div class="invalid-feedback">Ingresa el número de referencia.</div>
                            </div>

                        </div><!-- /row datos generales -->

                        <!-- ── Sección 2: Detalle (DetalleSolicitud) ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-clipboard-list me-1"></i> Detalle del problema
                        </p>

                        <div class="row g-3">

                            <!-- Asunto — DetalleSolicitud.Asunto -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small" for="solAsunto">
                                    Asunto <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="solAsunto"
                                       maxlength="120"
                                       placeholder="Resumen breve del problema…"
                                       oninput="actualizarResumen(); contarCaracteres(this,'solAsuntoCount',120)">
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="invalid-feedback">El asunto es obligatorio.</div>
                                    <small class="text-muted ms-auto" style="font-size:.7rem">
                                        <span id="solAsuntoCount">0</span>/120
                                    </small>
                                </div>
                            </div>

                            <!-- Descripción — DetalleSolicitud.Descripcion -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small" for="solDescripcion">
                                    Descripción <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="solDescripcion"
                                          rows="5" style="resize:vertical" maxlength="1000"
                                          placeholder="Describe el problema con detalle: cuándo ocurrió, qué síntomas presenta, si ya intentaste alguna solución, etc."
                                          oninput="contarCaracteres(this,'solDescCount',1000)"></textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="invalid-feedback">La descripción es obligatoria.</div>
                                    <small class="text-muted ms-auto" style="font-size:.7rem">
                                        <span id="solDescCount">0</span>/1000
                                    </small>
                                </div>
                            </div>

                        </div><!-- /row detalle -->

                        <!-- ── Sección 3: Evidencia — DetalleSolicitud.Evidencia ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-paperclip me-1"></i> Evidencia
                        </p>

                        <!-- Zona de arrastre -->
                        <div class="sol-dropzone" id="solDropzone">
                            <input type="file" id="solEvidencia"
                                   accept="image/*,.pdf"
                                   onchange="manejarEvidencia(this)">
                            <i class="fas fa-cloud-upload-alt sol-dropzone-icon"></i>
                            <div class="sol-dropzone-label">
                                <strong>Haz clic</strong> o arrastra tu archivo aquí
                            </div>
                            <p class="sol-dropzone-hint">
                                Imagen (JPG, PNG) o PDF · Máx. 5 MB ·
                                Requerida si la falla es física o visible
                            </p>
                        </div>

                        <!-- Preview del archivo seleccionado -->
                        <div class="sol-file-preview" id="solFilePreview">
                            <i id="solFileIcon" class="fas fa-file-image sol-file-img"></i>
                            <span id="solFileName"></span>
                            <span id="solFileSize" class="text-muted" style="font-size:.75rem"></span>
                            <button class="sol-file-remove" type="button" onclick="quitarEvidencia()">
                                <i class="fas fa-times-circle"></i> Quitar
                            </button>
                        </div>

                        <!-- Acciones -->
                        <div class="sol-actions">
                            <button class="btn-sol-enviar" id="btnEnviar" type="button"
                                    onclick="enviarSolicitud()">
                                <i class="fas fa-paper-plane"></i> Enviar solicitud
                            </button>
                            <a href="inicio_usuario.php" class="btn-sol-cancelar">
                                Cancelar
                            </a>
                        </div>

                    </div><!-- /cuenta-card-body -->
                </div><!-- /cuenta-card -->

            </div><!-- /col formulario -->

            <!-- ══ Columna lateral: resumen ══ -->
            <div class="col-lg-4">

              

                <!-- Tarjeta de ayuda -->
                <div class="cuenta-card mt-3">
                    <div class="cuenta-card-body sol-help-card">
                        <p class="sol-help-title">
                            <i class="fas fa-shield-alt"></i> ¿Cuándo usar cada tipo?
                        </p>
                        <p class="mb-2">
                            <strong>Garantía:</strong> cuando el producto presenta fallas de
                            funcionamiento dentro del período de garantía del fabricante.
                        </p>
                        <p class="mb-0">
                            <strong>Devolución:</strong> cuando deseas regresar el producto
                            por daño involuntario, error en el pedido o insatisfacción.
                        </p>
                    </div>
                </div>

            </div><!-- /col resumen -->

        </div><!-- /row -->

    </main>

</div><!-- /cuenta-layout -->

<!-- ══════════ TOAST DE CONFIRMACIÓN ══════════ -->
<div class="sol-toast" id="solToast" role="alert" aria-live="polite">
    <i class="fas fa-check-circle sol-toast-icon"></i>
    <div>
        <p class="sol-toast-title">¡Solicitud enviada!</p>
        <p class="sol-toast-msg">
            Tu folio es: <strong id="solToastFolio"></strong><br>
            Serás redirigido en un momento…
        </p>
    </div>
    <button class="sol-toast-close" type="button" onclick="cerrarToast()" aria-label="Cerrar">
        <i class="fas fa-times"></i>
    </button>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../scripts/scripts.js"></script>
<script src="../../scripts/solicitud.js"></script>
<link rel="stylesheet" href="../../estilos/responsive.css">
<script src="../../js/responsive.js"></script>
</body>
</html>