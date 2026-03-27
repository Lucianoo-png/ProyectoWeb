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
            <a href="Vista/Pedidos/rastrear.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
                <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
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

<!-- ══ CUERPO PRINCIPAL ══════════════════════════════════════════ -->
<main class="pb-5" id="formSection">
    <div class="container">
        <div class="row g-4">

            <!-- ── COLUMNA FORMULARIO ── -->
            <div class="col-lg-8">
                <div class="form-card">
                    <div class="form-header">
                        <h2>Formulario de Contacto</h2>
                        <p>Completa los campos y te responderemos en un máximo de 24 horas hábiles.</p>
                    </div>

                    <!-- FORMULARIO -->
                    <div class="form-body" id="panelFormulario">
                        <form id="ayudaForm" novalidate>

                            <!-- Nombre + Email -->
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="nombre">Nombre completo *</label>
                                    <input type="text" class="form-control" id="nombre"
                                           placeholder="Ej. María González" maxlength="80">
                                    <span class="err-msg" id="err-nombre">Por favor ingresa tu nombre.</span>
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="email">Correo electrónico *</label>
                                    <input type="email" class="form-control" id="email"
                                           placeholder="correo@ejemplo.com" maxlength="120">
                                    <span class="err-msg" id="err-email">Ingresa un correo válido.</span>
                                </div>
                            </div>

                            <!-- Teléfono + Pedido -->
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label class="form-label" for="telefono">Teléfono (opcional)</label>
                                    <input type="tel" class="form-control" id="telefono"
                                           placeholder="10 dígitos" maxlength="10"
                                           oninput="this.value=this.value.replace(/\D/g,'')">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label" for="numeroPedido">N.° de pedido (opcional)</label>
                                    <input type="text" class="form-control" id="numeroPedido"
                                           placeholder="Ej. PED-20260001" maxlength="30">
                                </div>
                            </div>

                            <!-- Asunto con chips -->
                            <div class="mb-3">
                                <label class="form-label">Asunto *</label>
                                <div class="asunto-chips" id="chipContainer">
                                    <span class="chip" data-valor="Queja de producto">Queja de producto</span>
                                    <span class="chip" data-valor="Problema con envío">Problema con envío</span>
                                    <span class="chip" data-valor="Garantía / Devolución">Garantía / Devolución</span>
                                    <span class="chip" data-valor="Error en cobro">Error en cobro</span>
                                    <span class="chip" data-valor="Información general">Información general</span>
                                    <span class="chip" data-valor="Otro">Otro</span>
                                </div>
                                <input type="text" class="form-control mt-2" id="asunto"
                                       placeholder="O escribe tu propio asunto…" maxlength="120">
                                <span class="err-msg" id="err-asunto">Selecciona o escribe el asunto.</span>
                            </div>

                            <!-- Prioridad -->
                            <div class="mb-3">
                                <label class="form-label" for="prioridad">Prioridad</label>
                                <select class="form-select" id="prioridad">
                                    <option value="baja">Baja — consulta general</option>
                                    <option value="media" selected>Media — necesito solución pronto</option>
                                    <option value="alta">Alta — afecta mi pedido activo</option>
                                    <option value="urgente">Urgente — problema grave</option>
                                </select>
                            </div>

                            <!-- Queja / Descripción -->
                            <div class="mb-3">
                                <label class="form-label" for="queja">Descripción del problema *</label>
                                <textarea class="form-control" id="queja"
                                          placeholder="Describe con detalle tu situación: ¿qué ocurrió?, ¿cuándo?, ¿qué producto o pedido está involucrado?"
                                          maxlength="1000"></textarea>
                                <div class="char-count" id="charCount">0 / 1000 caracteres</div>
                                <span class="err-msg" id="err-queja">Por favor describe tu problema (mín. 20 caracteres).</span>
                            </div>

                            <!-- Adjunto -->
                            <div class="mb-4">
                                <label class="form-label">Adjuntar archivo (opcional)</label>
                                <div class="file-drop" id="fileDrop"
                                     onclick="document.getElementById('adjunto').click()">
                                    <i class="fas fa-cloud-upload-alt d-block mb-1"></i>
                                    <p id="fileLabel">Haz clic o arrastra una imagen / PDF aquí<br>
                                        <small>Máx. 5 MB — JPG, PNG, PDF</small>
                                    </p>
                                    <input type="file" id="adjunto" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                            </div>

                            <!-- Aviso de privacidad -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="privacidad">
                                <label class="form-check-label small" for="privacidad"
                                       style="color:#6b7a9a;">
                                    Acepto el
                                    <a href="#" style="color:var(--azul-corp); font-weight:600;">Aviso de Privacidad</a>
                                    y el tratamiento de mis datos personales.
                                </label>
                                <span class="err-msg" id="err-privacidad">Debes aceptar el aviso de privacidad.</span>
                            </div>

                            <button type="submit" class="btn-enviar">
                                <i class="fas fa-paper-plane"></i>Enviar solicitud
                            </button>
                        </form>
                    </div>

                    <!-- PANEL CONFIRMACIÓN -->
                    <div id="panelConfirmacion">
                        <div class="check-circle"><i class="fas fa-check"></i></div>
                        <h3>¡Solicitud enviada!</h3>
                        <p>Hemos recibido tu mensaje correctamente.<br>
                           Te contactaremos en las próximas 24 horas hábiles.</p>
                        <div class="folio" id="folioNum"></div>
                        <br>
                        <a href="index.php" class="btn-volver">
                            <i class="fas fa-arrow-left me-2"></i>Volver al inicio
                        </a>
                    </div>
                </div>
            </div>

            <!-- ── COLUMNA SIDEBAR ── -->
            <div class="col-lg-4">

                <div class="info-card">
                    <h6>Información de contacto</h6>
                    <div class="info-item">
                        <div class="ic-wrap azul"><i class="fas fa-phone-alt"></i></div>
                        <div>
                            <p>800-LUCHANOS</p>
                            <small>Llamadas sin costo desde México</small>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="ic-wrap cyan"><i class="fas fa-envelope"></i></div>
                        <div>
                            <p>soporte@luchanoscorp.mx</p>
                            <small>Respuesta en 24 h hábiles</small>
                        </div>
                    </div>
                    <div class="info-item">
                        <div class="ic-wrap verde"><i class="fab fa-whatsapp"></i></div>
                        <div>
                            <p>+52 229 000 0000</p>
                            <small>Chat en vivo — WhatsApp Business</small>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h6>Horario de atención</h6>
                    <div class="horario-grid">
                        <span class="dia">Lunes – Viernes</span>
                        <span class="hora">9:00 – 19:00</span>
                        <span class="dia">Sábado</span>
                        <span class="hora">10:00 – 15:00</span>
                        <span class="dia">Domingo</span>
                        <span class="hora">Cerrado</span>
                    </div>
                </div>

                <div class="info-card"
                     style="background:linear-gradient(135deg,var(--azul-corp),var(--azul-medio)); color:white;">
                    <h6 style="color:rgba(255,255,255,.6);">Tiempo de respuesta</h6>
                    <p style="font-size:.85rem; font-weight:300; color:rgba(255,255,255,.85); margin-bottom:12px;">
                        El 95% de nuestros tickets se resuelven en menos de 24 horas hábiles.
                    </p>
                    <div style="display:flex; align-items:center; gap:10px;">
                        <div style="flex:1; height:6px; background:rgba(255,255,255,.2); border-radius:3px; overflow:hidden;">
                            <div style="width:95%; height:100%; background:var(--acento); border-radius:3px;"></div>
                        </div>
                        <span style="font-size:.82rem; font-weight:700; color:var(--acento);">95%</span>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

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