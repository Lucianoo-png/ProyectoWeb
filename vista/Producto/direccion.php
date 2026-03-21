<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Dirección de Envío</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body class="checkout-bg">

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
                <a href="carrito.php" class="nav-icon" title="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cart-count" style="display:none">0</span>
                </a>
                <a href="../Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Pasos del checkout -->
    <div class="checkout-steps">
        <div class="step done">
            <div class="step-circle"><i class="fas fa-shopping-cart"></i></div>
            <div class="step-label">Carro de Compras</div>
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle"><i class="fas fa-info-circle"></i></div>
            <div class="step-label">Información de Envío</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle"><i class="fas fa-credit-card"></i></div>
            <div class="step-label">Pago</div>
        </div>
    </div>

    <!-- Contenido -->
    <div class="dir-layout">
        <div class="dir-card">
            <h5><i class="fas fa-map-marker-alt me-2" style="color:var(--btn-color)"></i>Dirección de envío</h5>
            <p class="dir-subtitle">Recibe tu pedido en cualquier dirección del país.</p>

            <div class="dir-instrucciones">
                ¿Se encuentra la dirección que quieres utilizar desplegada a continuación?<br>
                Si es así, haz click en el botón <strong>"ENVIAR AQUÍ"</strong>.
            </div>

            <!-- Tarjeta de dirección (datos hardcoded / demo) -->
            <div class="dir-address-card" id="dir-card-1">
                <div class="dir-address-name" id="dir-nombre-display">Carlos Ivan Luciano Cruz</div>
                <div class="dir-address-detail" id="dir-detalle-display">
                    XXXXXXXXXXXXXXXXXXXX
                    Veracruz, 91713, México<br>
                    Teléfono: 2294832504
                </div>
                <div class="dir-address-actions">
                    <button class="btn-enviar-aqui" onclick="enviarAqui()">ENVIAR AQUÍ</button>
                    <button class="btn-dir-sec" onclick="borrarDireccion()">Borrar</button>
                    <button class="btn-dir-sec" onclick="abrirEditar()">Editar</button>
                </div>
            </div>

            <a href="#" class="ver-todas-link">Ver todas mis direcciones</a>
        </div>
    </div>

    <!-- Modal Editar dirección -->
    <div id="modal-editar">
        <div class="modal-editar-card">
            <div class="modal-editar-header">
                <h6><i class="fas fa-edit me-2"></i>Editar dirección</h6>
                <button onclick="cerrarEditar()">&times;</button>
            </div>
            <div class="modal-editar-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Nombre completo</label>
                        <input type="text" id="edit-nombre" class="form-control form-control-sm"
                               value="Carlos Ivan Luciano Cruz">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Teléfono</label>
                        <input type="tel" id="edit-tel" class="form-control form-control-sm"
                               value="2294832504">
                    </div>
                    <div class="col-12">
                        <label class="form-label small fw-semibold">Calle y número</label>
                        <input type="text" id="edit-calle" class="form-control form-control-sm"
                               value="Rafael Murillo Vidal 485 485, Tienda con fachada de Coca Cola">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Colonia</label>
                        <input type="text" id="edit-colonia" class="form-control form-control-sm"
                               value="Vías Ferreas">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-semibold">Ciudad</label>
                        <input type="text" id="edit-ciudad" class="form-control form-control-sm"
                               value="Veracruz">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">C.P.</label>
                        <input type="text" id="edit-cp" class="form-control form-control-sm"
                               value="91713">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">Estado</label>
                        <input type="text" id="edit-estado" class="form-control form-control-sm"
                               value="VERACRUZ">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-semibold">País</label>
                        <input type="text" id="edit-pais" class="form-control form-control-sm"
                               value="México" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-editar-footer">
                <button class="btn-cancelar-dir" onclick="cerrarEditar()">Cancelar</button>
                <button class="btn-guardar-dir" onclick="guardarEdicion()">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </div>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

    <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>