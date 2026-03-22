<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Panel Repartidor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
    <link rel="stylesheet" href="../../estilos/vendedor.css">
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div class="container-fluid d-flex justify-content-between px-3">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div><span><i class="fas fa-motorcycle me-1"></i> Panel Repartidor</span></div>
    </div>
</div>

<!-- Navbar -->
<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
    </div>
</div>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Repartidor</p>
        <a href="inicio_repartidor.php" class="nav-link active">
            <i class="fas fa-truck"></i> Mis Entregas
        </a>
        <hr class="sidebar-divider">
        <a href="../../vista/Cuenta/login.php" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <!-- Contenido -->
    <main class="admin-content">

        <div class="mb-4">
            <h1 class="page-header-title mb-0">Panel de Repartidor</h1>
            <p class="page-header-sub">
                Bienvenido, <strong>Juan Hernández</strong>. Aquí puedes ver y actualizar tus entregas asignadas.
            </p>
        </div>

        <!-- Tarjeta de info del repartidor -->
        <div class="info-card-vend mb-4">
            <div class="info-avatar"><i class="fas fa-motorcycle"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value">LuchanosCorp — Sucursal Veracruz</span></p>
                <p><span class="label">Repartidor</span><br>
                   <span class="value">Juan Hernández Pérez</span></p>
                <p><span class="label">Entregas hoy</span><br>
                   <span class="value">1 asignada</span></p>
            </div>
        </div>

        <!-- ── PEDIDO ASIGNADO ACTUAL ──────────────────────────── -->
        <div class="mb-2"><span class="section-title">Entrega Asignada</span></div>

        <div class="entrega-card" id="entregaCard">
            <div class="entrega-card-header">
                <span>
                    <i class="fas fa-box me-1"></i> Pedido #LC-2026-0038
                </span>
                <span id="badgeEstado" class="badge-estado badge-ruta">Salió a ruta</span>
            </div>
            <div class="entrega-card-body">

                <!-- Datos del pedido -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="perfil-campo">
                            <div class="perfil-label">Cliente</div>
                            <div class="perfil-valor">Carlos Ivan Luciano Cruz</div>
                        </div>
                        <div class="perfil-campo">
                            <div class="perfil-label">Teléfono</div>
                            <div class="perfil-valor">
                                <a href="tel:2294832504" style="color:var(--btn-color);font-weight:600">
                                    <i class="fas fa-phone me-1"></i>229-483-2504
                                </a>
                            </div>
                        </div>
                        <div class="perfil-campo">
                            <div class="perfil-label">Dirección de entrega</div>
                            <div class="perfil-valor">
                                Rafael Murillo Vidal 485, Col. Vías Férreas<br>
                                Veracruz, Ver. 91713
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="perfil-campo">
                            <div class="perfil-label">Producto(s)</div>
                            <div class="perfil-valor">
                                Microondas AirFry 4 en 1<br>
                                <span style="font-size:.78rem;color:#888">SKU: WM3911D · Cant: 1</span>
                            </div>
                        </div>
                        <div class="perfil-campo">
                            <div class="perfil-label">Fecha de asignación</div>
                            <div class="perfil-valor">22 de marzo de 2026</div>
                        </div>
                        <div class="perfil-campo">
                            <div class="perfil-label">Total del pedido</div>
                            <div class="perfil-valor" style="color:var(--btn-color);font-weight:800">$4,599.00</div>
                        </div>
                    </div>
                </div>

                <!-- Tracking visual editable -->
                <div class="admin-form-card mb-4">
                    <div class="admin-form-header">
                        <i class="fas fa-map-marked-alt me-1"></i> Estado de la Entrega
                    </div>
                    <div class="admin-form-body">

                        <div class="rep-tracking" id="repTracking">
                            <div class="rep-step done" id="rStep0">
                                <div class="rep-step-circle"><i class="fas fa-check"></i></div>
                                <div class="rep-step-label">Pedido recibido</div>
                            </div>
                            <div class="rep-line done" id="rLine0"></div>
                            <div class="rep-step done" id="rStep1">
                                <div class="rep-step-circle"><i class="fas fa-check"></i></div>
                                <div class="rep-step-label">En preparación</div>
                            </div>
                            <div class="rep-line done" id="rLine1"></div>
                            <div class="rep-step current" id="rStep2">
                                <div class="rep-step-circle"><i class="fas fa-truck"></i></div>
                                <div class="rep-step-label">Salió a ruta</div>
                            </div>
                            <div class="rep-line" id="rLine2"></div>
                            <div class="rep-step" id="rStep3">
                                <div class="rep-step-circle"><i class="fas fa-home"></i></div>
                                <div class="rep-step-label">Entregado</div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 mt-3 flex-wrap">
                            <div>
                                <p style="font-size:.82rem;color:#555;margin:0">
                                    <strong>Estado actual:</strong>
                                    <span id="lblEstadoActual" style="color:var(--azul-marino);font-weight:700">
                                        Salió a ruta
                                    </span>
                                </p>
                                <p style="font-size:.75rem;color:#888;margin:0" id="lblSigEstado">
                                    Siguiente paso: <strong>Entregado</strong>
                                </p>
                            </div>
                            <button class="btn-avanzar-estado ms-auto" id="btnAvanzar"
                                    onclick="avanzarEstado()">
                                <i class="fas fa-check-circle me-1"></i> Marcar como Entregado
                            </button>
                        </div>

                    </div>
                </div>

                <!-- Confirmación de entrega (oculta hasta que se marca como entregado) -->
                <div id="confirmEntregaBox" style="display:none">
                    <div class="admin-form-card">
                        <div class="admin-form-header" style="background:#065f46">
                            <i class="fas fa-check-double me-1"></i> Confirmación de Entrega
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">
                                        Nombre de quien recibió
                                    </label>
                                    <input type="text" id="receptorNombre" class="form-control"
                                           placeholder="Ej: Carlos Ivan Luciano Cruz">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold small">Observaciones</label>
                                    <input type="text" id="receptorObs" class="form-control"
                                           placeholder="Ej: Entregado en puerta principal">
                                </div>
                            </div>
                            <div class="mt-3">
                                <button class="btn-admin-primary" onclick="confirmarEntrega()">
                                    <i class="fas fa-paper-plane me-1"></i> Confirmar entrega
                                </button>
                                <button class="btn-admin-secondary ms-2"
                                        onclick="document.getElementById('confirmEntregaBox').style.display='none'">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- /entregaCard -->

        <!-- Sin entregas asignadas (oculto por defecto) -->
        <div id="sinEntregas" style="display:none">
            <div class="admin-form-card">
                <div class="admin-form-body text-center py-5">
                    <i class="fas fa-box-open fa-3x mb-3"
                       style="color:#d0dae8;display:block"></i>
                    <p style="color:#6c757d;font-size:.9rem;margin:0">
                        No tienes entregas asignadas en este momento.
                    </p>
                </div>
            </div>
        </div>

    </main>
</div>

<footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script><script src="../../js/panel.js"></script>
</body>
</html>