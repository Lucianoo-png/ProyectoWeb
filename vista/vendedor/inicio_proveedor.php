<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Portal Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
    <link rel="stylesheet" href="../../estilos/proveedor.css">
</head>
<body>

<!-- ═══ TOPBAR ═══════════════════════════════════════════ -->
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <span style="font-size:.8rem;color:rgba(255,255,255,.75)">
                <i class="fas fa-building me-1"></i> Portal Proveedores
            </span>
        </div>
    </div>
</div>

<!-- ═══ NAVBAR ════════════════════════════════════════════ -->
<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="flex-grow-1 mx-lg-4 d-flex align-items-center gap-2">
            <span style="font-size:.85rem;color:rgba(255,255,255,.65)">
                <i class="fas fa-truck-loading me-1"></i> Portal de Proveedores
            </span>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="login_proveedor.php" class="nav-icon" title="Cerrar Sesión"
               style="font-size:.8rem;display:flex;align-items:center;gap:.35rem">
                <i class="fas fa-sign-out-alt"></i>
                <span class="d-none d-md-inline">Salir</span>
            </a>
        </div>
    </div>
</div>

<!-- ═══ LAYOUT CUENTA ════════════════════════════════════ -->
<div class="cuenta-layout">

    <!-- ── SIDEBAR ─────────────────────────────────────── -->
    <aside class="cuenta-sidebar">
        <div class="cuenta-sidebar-header">
            <div class="cuenta-avatar">DP</div>
            <p class="cuenta-sidebar-name">Distribuidora Pérez S.A.</p>
            <p class="cuenta-sidebar-email">contacto@distribuidoraperez.mx</p>
        </div>
        <nav class="cuenta-nav">
            <button class="cuenta-nav-link active" onclick="switchPanel('panel-resumen', this)">
                <i class="fas fa-tachometer-alt"></i> Resumen
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-solicitudes', this)">
                <i class="fas fa-inbox"></i> Solicitudes de Reabasto
                <span id="badge-pendientes"
                      style="background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;
                             padding:.1rem .45rem;border-radius:2rem;margin-left:.35rem">2</span>
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-historial', this)">
                <i class="fas fa-history"></i> Historial
            </button>
            <hr class="cuenta-nav-divider">
            <button class="cuenta-nav-link" onclick="switchPanel('panel-perfil', this)">
                <i class="fas fa-user-edit"></i> Mi Perfil
            </button>
            <hr class="cuenta-nav-divider">
            <a href="login_proveedor.php" class="cuenta-nav-link" style="color:#dc3545">
                <i class="fas fa-sign-out-alt" style="color:#dc3545"></i> Cerrar Sesión
            </a>
        </nav>
    </aside>

    <!-- ══════════════════════════════════════════════════
         MAIN
    ═══════════════════════════════════════════════════ -->
    <main>

        <!-- ╔══════════════════════════════════════════╗
             ║  PANEL RESUMEN                          ║
             ╚══════════════════════════════════════════╝ -->
        <div class="cuenta-panel active" id="panel-resumen">

            <div class="mb-4">
                <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-tachometer-alt me-2" style="color:var(--btn-color)"></i>Resumen
                </h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">
                    Vista general de tu actividad como proveedor en LuchanosCorp.
                </p>
            </div>

            <!-- Estadísticas -->
            <div class="row g-3 mb-4">
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-card-icon" style="background:#fef3c7;color:#d97706">
                            <i class="fas fa-hourglass-half"></i>
                        </div>
                        <div>
                            <div class="stat-card-val">2</div>
                            <div class="stat-card-lbl">Solicitudes pendientes</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-card-icon" style="background:#dbeafe;color:#1d4ed8">
                            <i class="fas fa-paper-plane"></i>
                        </div>
                        <div>
                            <div class="stat-card-val">5</div>
                            <div class="stat-card-lbl">Respuestas enviadas</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-card-icon" style="background:#dcfce7;color:#15803d">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <div>
                            <div class="stat-card-val">4</div>
                            <div class="stat-card-lbl">Suministros confirmados</div>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="stat-card">
                        <div class="stat-card-icon" style="background:#f3e8ff;color:#7c3aed">
                            <i class="fas fa-boxes"></i>
                        </div>
                        <div>
                            <div class="stat-card-val">142</div>
                            <div class="stat-card-lbl">Unidades suministradas</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Solicitudes pendientes en el resumen -->
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-bell me-1"></i> Solicitudes Pendientes de Respuesta</span>
                    <button class="btn-ver-detalle" onclick="switchPanel('panel-solicitudes', document.querySelector('.cuenta-nav-link:nth-child(2)'))">
                        Ver todas
                    </button>
                </div>
                <div class="cuenta-card-body" style="padding:0">
                    <table class="sol-table">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Productos</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>LC-REA-2026-031</strong></td>
                                <td>28/03/2026</td>
                                <td>4 productos</td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td>
                                    <button class="btn-ver-detalle"
                                        onclick="abrirSolicitud('LC-REA-2026-031'); switchPanel('panel-solicitudes', document.querySelector('.cuenta-nav-link:nth-child(2)'))">
                                        Responder
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LC-REA-2026-028</strong></td>
                                <td>25/03/2026</td>
                                <td>2 productos</td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td>
                                    <button class="btn-ver-detalle"
                                        onclick="abrirSolicitud('LC-REA-2026-028'); switchPanel('panel-solicitudes', document.querySelector('.cuenta-nav-link:nth-child(2)'))">
                                        Responder
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div><!-- /panel-resumen -->


        <!-- ╔══════════════════════════════════════════╗
             ║  PANEL SOLICITUDES DE REABASTECIMIENTO  ║
             ╚══════════════════════════════════════════╝ -->
        <div class="cuenta-panel" id="panel-solicitudes">

            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
                <div>
                    <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                        <i class="fas fa-inbox me-2" style="color:var(--btn-color)"></i>Solicitudes de Reabastecimiento
                    </h5>
                    <p style="font-size:.8rem;color:#6c757d;margin:0">
                        Indica las cantidades disponibles para cada producto solicitado por el administrador.
                    </p>
                </div>
            </div>

            <!-- Lista de solicitudes -->
            <div class="cuenta-card mb-3">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-list-ul me-1"></i> Todas las solicitudes</span>
                </div>
                <div class="cuenta-card-body" style="padding:0">
                    <table class="sol-table">
                        <thead>
                            <tr>
                                <th>Folio</th>
                                <th>Fecha recibida</th>
                                <th>Productos</th>
                                <th>Nota del admin.</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>LC-REA-2026-031</strong></td>
                                <td>28/03/2026 10:45</td>
                                <td>4 productos</td>
                                <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    Reabasto urgente línea blanca
                                </td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td>
                                    <button class="btn-ver-detalle" onclick="abrirSolicitud('LC-REA-2026-031')">
                                        <i class="fas fa-reply me-1"></i> Responder
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LC-REA-2026-028</strong></td>
                                <td>25/03/2026 08:20</td>
                                <td>2 productos</td>
                                <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    Stock bajo en microondas
                                </td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td>
                                    <button class="btn-ver-detalle" onclick="abrirSolicitud('LC-REA-2026-028')">
                                        <i class="fas fa-reply me-1"></i> Responder
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LC-REA-2026-021</strong></td>
                                <td>15/03/2026 14:00</td>
                                <td>3 productos</td>
                                <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    Reabasto mensual programado
                                </td>
                                <td><span class="badge-confirmada">Confirmada</span></td>
                                <td>
                                    <button class="btn-ver-detalle" onclick="verHistorial('LC-REA-2026-021')">
                                        <i class="fas fa-eye me-1"></i> Ver detalle
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>LC-REA-2026-014</strong></td>
                                <td>05/03/2026 09:30</td>
                                <td>5 productos</td>
                                <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                                    —
                                </td>
                                <td><span class="badge-respondida">Respondida</span></td>
                                <td>
                                    <button class="btn-ver-detalle" onclick="verHistorial('LC-REA-2026-014')">
                                        <i class="fas fa-eye me-1"></i> Ver detalle
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ── Panel de respuesta expandible ──────── -->
            <div class="responder-panel" id="responder-wrapper">

                <div class="alerta-ok" id="alerta-enviada">
                    <i class="fas fa-check-circle"></i>
                    Respuesta enviada correctamente. El administrador revisará tu propuesta.
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <div>
                        <h6 style="color:var(--dark-blue);font-weight:700;margin:0">
                            <i class="fas fa-reply me-1" style="color:var(--btn-color)"></i>
                            Respondiendo solicitud: <span id="folio-activo">—</span>
                        </h6>
                        <p style="font-size:.78rem;color:#6c757d;margin:0">
                            Ingresa la cantidad que puedes suministrar. Debe ser <strong>igual o mayor</strong> a la solicitada.
                        </p>
                    </div>
                    <button class="btn-prov-cancel" onclick="cerrarResponder()">
                        <i class="fas fa-times me-1"></i> Cancelar
                    </button>
                </div>

                <!-- Nota del administrador -->
                <div class="p-3 mb-3 rounded" style="background:#eff6ff;border-left:3px solid #3b82f6;font-size:.83rem;color:#1e3a5f">
                    <strong><i class="fas fa-sticky-note me-1"></i> Nota del administrador:</strong>
                    <span id="nota-admin-txt">Reabasto urgente línea blanca. Se requieren los productos a la brevedad posible.</span>
                </div>

                <!-- Productos de la solicitud -->
                <div id="productos-solicitud">
                    <!-- Se renderizan con JS según solicitud activa -->
                </div>

                <!-- Observaciones del proveedor -->
                <div class="mt-3">
                    <label class="form-label fw-semibold small">Observaciones / Comentarios (opcional)</label>
                    <textarea id="obs-proveedor" class="form-control" rows="3" style="resize:vertical;font-size:.85rem"
                              placeholder="Fecha estimada de entrega, condiciones especiales de envío, etc."></textarea>
                </div>

                <div class="d-flex gap-2 mt-3">
                    <button class="btn-prov-primary" onclick="enviarRespuesta()">
                        <i class="fas fa-paper-plane me-1"></i> Enviar respuesta
                    </button>
                    <button class="btn-prov-cancel" onclick="cerrarResponder()">Cancelar</button>
                </div>

            </div><!-- /responder-wrapper -->

        </div><!-- /panel-solicitudes -->


        <!-- ╔══════════════════════════════════════════╗
             ║  PANEL HISTORIAL                        ║
             ╚══════════════════════════════════════════╝ -->
        <div class="cuenta-panel" id="panel-historial">

            <div class="mb-4">
                <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Historial de Solicitudes
                </h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">
                    Registro de todas las solicitudes respondidas y confirmadas.
                </p>
            </div>

            <!-- LC-REA-2026-021 – Confirmada -->
            <div class="hist-card">
                <div class="hist-card-head" style="background:#065f46">
                    <span><i class="fas fa-check-double me-1"></i> LC-REA-2026-021</span>
                    <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.7rem;
                                 padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                        Confirmada
                    </span>
                </div>
                <div class="hist-card-body">
                    <div class="row g-2 mb-2">
                        <div class="col-md-3">
                            <div class="perfil-label">Fecha solicitud</div>
                            <div class="perfil-valor" style="font-size:.84rem">15/03/2026 14:00</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Fecha respuesta</div>
                            <div class="perfil-valor" style="font-size:.84rem">16/03/2026 09:22</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Productos</div>
                            <div class="perfil-valor" style="font-size:.84rem">3 productos</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Unidades suministradas</div>
                            <div class="perfil-valor" style="font-size:.84rem">55 unidades</div>
                        </div>
                    </div>
                    <div class="p-2 rounded" style="background:#f0fdf4;border-left:3px solid #22c55e;font-size:.8rem">
                        <strong style="color:#15803d"><i class="fas fa-check me-1"></i> Confirmado por administrador:</strong><br>
                        Reabasto recibido en almacén el 18/03/2026. Inventario actualizado correctamente.
                    </div>
                    <!-- Detalle de productos -->
                    <div class="mt-2">
                        <table class="sol-table" style="margin:0">
                            <thead>
                                <tr>
                                    <th>SKU</th><th>Producto</th>
                                    <th>Cant. solicitada</th><th>Cant. suministrada</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WRS315SNHM</td>
                                    <td>Refrigerador Side by Side 25 pies</td>
                                    <td>10</td><td><strong>12</strong></td>
                                </tr>
                                <tr>
                                    <td>WED5000DW</td>
                                    <td>Secadora eléctrica 7.0 pies</td>
                                    <td>15</td><td><strong>20</strong></td>
                                </tr>
                                <tr>
                                    <td>WFW5620HW</td>
                                    <td>Lavadora carga frontal 4.5 pies</td>
                                    <td>20</td><td><strong>23</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- LC-REA-2026-014 – Respondida (en revisión) -->
            <div class="hist-card">
                <div class="hist-card-head" style="background:#1e40af">
                    <span><i class="fas fa-clock me-1"></i> LC-REA-2026-014</span>
                    <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.7rem;
                                 padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                        En revisión
                    </span>
                </div>
                <div class="hist-card-body">
                    <div class="row g-2 mb-2">
                        <div class="col-md-3">
                            <div class="perfil-label">Fecha solicitud</div>
                            <div class="perfil-valor" style="font-size:.84rem">05/03/2026 09:30</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Fecha respuesta</div>
                            <div class="perfil-valor" style="font-size:.84rem">05/03/2026 16:10</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Productos</div>
                            <div class="perfil-valor" style="font-size:.84rem">5 productos</div>
                        </div>
                        <div class="col-md-3">
                            <div class="perfil-label">Unidades ofertadas</div>
                            <div class="perfil-valor" style="font-size:.84rem">87 unidades</div>
                        </div>
                    </div>
                    <div class="p-2 rounded" style="background:#eff6ff;border-left:3px solid #3b82f6;font-size:.8rem;color:#888">
                        <i class="fas fa-hourglass-half me-1"></i>
                        Respuesta enviada. Esperando confirmación del administrador.
                    </div>
                </div>
            </div>

        </div><!-- /panel-historial -->


        <!-- ╔══════════════════════════════════════════╗
             ║  PANEL MI PERFIL                        ║
             ╚══════════════════════════════════════════╝ -->
        <div class="cuenta-panel" id="panel-perfil">

            <div class="mb-4">
                <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-user-edit me-2" style="color:var(--btn-color)"></i>Mi Perfil
                </h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">
                    Consulta y actualiza la información de tu empresa.
                </p>
            </div>

            <!-- Datos de la empresa -->
            <div class="cuenta-card mb-3">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-building"></i> Datos de la Empresa</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditEmpresa()">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <!-- Vista -->
                    <div id="vistaEmpresa">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Razón social</div>
                                    <div class="perfil-valor">Distribuidora Pérez S.A. de C.V.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">RFC</div>
                                    <div class="perfil-valor">DPE870214AB3</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Correo electrónico</div>
                                    <div class="perfil-valor">contacto@distribuidoraperez.mx</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Teléfono</div>
                                    <div class="perfil-valor">55 1234 5678</div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Dirección fiscal</div>
                                    <div class="perfil-valor">Av. Industrial 400, Col. Vallejo, CDMX, C.P. 07870</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Formulario de edición -->
                    <div id="formEmpresa" style="display:none">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Razón social</label>
                                <input type="text" class="form-control" value="Distribuidora Pérez S.A. de C.V.">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">RFC <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="DPE870214AB3" maxlength="13"
                                       placeholder="RFC de la empresa">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Correo electrónico <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="contacto@distribuidoraperez.mx">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono</label>
                                <input type="tel" class="form-control" value="55 1234 5678">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label fw-semibold small">Dirección fiscal</label>
                                <input type="text" class="form-control" value="Av. Industrial 400, Col. Vallejo, CDMX, C.P. 07870">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn-cuenta-save" onclick="guardarEmpresa()">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                            <button class="btn-cuenta-cancel" onclick="toggleEditEmpresa()">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Datos del contacto principal -->
            <div class="cuenta-card mb-3">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-id-card"></i> Contacto Principal</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditContacto()">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <!-- Vista -->
                    <div id="vistaContacto">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Nombre</div>
                                    <div class="perfil-valor">Roberto</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Apellido paterno</div>
                                    <div class="perfil-valor">Pérez</div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Apellido materno</div>
                                    <div class="perfil-valor">Guzmán</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Teléfono directo</div>
                                    <div class="perfil-valor">55 9876 5432</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Correo personal</div>
                                    <div class="perfil-valor">roberto.perez@distribuidoraperez.mx</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Formulario -->
                    <div id="formContacto" style="display:none">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="Roberto">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Apellido paterno <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" value="Pérez">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Apellido materno</label>
                                <input type="text" class="form-control" value="Guzmán">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono directo</label>
                                <input type="tel" class="form-control" value="55 9876 5432">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Correo personal <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" value="roberto.perez@distribuidoraperez.mx">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn-cuenta-save" onclick="guardarContacto()">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                            <button class="btn-cuenta-cancel" onclick="toggleEditContacto()">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cambio de contraseña -->
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-lock"></i> Seguridad</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditPass()">
                        <i class="fas fa-key"></i> Cambiar contraseña
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <div id="vistaPass">
                        <p style="font-size:.85rem;color:#6b7280;margin:0">
                            <i class="fas fa-shield-alt me-1"></i>
                            Contraseña configurada. Cámbiala regularmente para mayor seguridad.
                        </p>
                    </div>
                    <div id="formPass" style="display:none">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Contraseña actual <span class="text-danger">*</span></label>
                                <input type="password" id="passActual" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Nueva contraseña <span class="text-danger">*</span></label>
                                <input type="password" id="passNueva" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-semibold small">Confirmar contraseña <span class="text-danger">*</span></label>
                                <input type="password" id="passConfirm" class="form-control" placeholder="••••••••">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button class="btn-cuenta-save" onclick="cambiarPassword()">
                                <i class="fas fa-save me-1"></i> Actualizar contraseña
                            </button>
                            <button class="btn-cuenta-cancel" onclick="toggleEditPass()">Cancelar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div><!-- /panel-perfil -->

    </main>
</div><!-- /cuenta-layout -->

<footer class="site-footer-minimal">
    © 2026 LuchanosCorp S.A. Todos los derechos reservados. — Portal de Proveedores
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/scripts.js"></script>
<script src="../../js/proveedor.js"></script>
</body>
</html>