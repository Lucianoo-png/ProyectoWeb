<div class="rep-toast" id="repToast">
    <i class="fas fa-check-circle"></i>
    <span id="repToastMsg">Acción completada</span>
</div>

<!-- Modal: cambiar estado de pedido del historial -->
<div class="modal-estado-overlay" id="modalEstadoOverlay">
    <div class="modal-estado-box">
        <div class="modal-estado-header">
            <span><i class="fas fa-exchange-alt me-2"></i>Actualizar estado del pedido</span>
            <button class="btn-modal-x" onclick="cerrarModalEstado()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-estado-body">
            <p style="font-size:.84rem;color:#555;margin-bottom:1rem">
                Pedido: <strong id="modalFolio">—</strong>
            </p>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Nuevo estado</label>
                <select class="estado-select w-100" id="modalSelectEstado">
                    <option value="0">Pedido recibido</option>
                    <option value="1">En preparación</option>
                    <option value="2">Salió a ruta</option>
                    <option value="3">Entregado</option>
                    <option value="4">Problema en entrega</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold small">Observaciones (opcional)</label>
                <textarea class="form-control no-resize" id="modalObs" rows="2"
                          placeholder="Ej: Cliente no estaba, se dejó con vecino…"></textarea>
            </div>
            <div class="d-flex gap-2 justify-content-end">
                <button class="btn-admin-secondary" onclick="cerrarModalEstado()">Cancelar</button>
                <button class="btn-admin-primary" onclick="guardarEstadoModal()">
                    <i class="fas fa-save me-1"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</div>

<?php include('vista/vendedor/header_repartidor.php'); ?>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Repartidor</p>
        <a class="nav-link active" style="cursor:pointer;" onclick="switchTab('tab-entregas', this); return false;">
            <i class="fas fa-truck"></i> Mis Entregas
            <span class="tab-badge ms-auto" id="badgeSidebar">1</span>
        </a>
        <a class="nav-link" style="cursor:pointer;" onclick="switchTab('tab-historial', this); return false;">
            <i class="fas fa-history"></i> Historial
        </a>
        <a class="nav-link" style="cursor:pointer;" onclick="switchTab('tab-perfil', this); return false;">
            <i class="fas fa-user-cog"></i> Mi Perfil
        </a>
        <hr class="sidebar-divider">
        <a href="/proyectoweb/?" style="cursor:pointer;" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <!-- Contenido -->
    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Panel de Repartidor</h1>
            <p class="page-header-sub">
                Bienvenido de nuevo, <strong>Juan Hernández</strong>. Gestiona tus entregas asignadas.
            </p>
        </div>

        <!-- TARJETA INFO -->
        <div class="info-card-vend mb-4">
            <div class="info-avatar"><i class="fas fa-motorcycle"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value">LuchanosCorp — Sucursal Veracruz</span></p>
                <p><span class="label">Repartidor</span><br>
                   <span class="value">Juan Hernández Pérez</span></p>
                <p><span class="label">Entregas hoy</span><br>
                   <span class="value">1 asignada · 3 completadas este mes</span></p>
            </div>
        </div>

        <!-- TABS NAV -->
        <div class="rep-nav-tabs">
            <button class="rep-nav-btn active" id="btn-tab-entregas"
                    onclick="switchTab('tab-entregas', this)">
                <i class="fas fa-truck"></i> Mis Entregas
            </button>
            <button class="rep-nav-btn" id="btn-tab-historial"
                    onclick="switchTab('tab-historial', this)">
                <i class="fas fa-history"></i> Historial de Pedidos
            </button>
            <button class="rep-nav-btn" id="btn-tab-perfil"
                    onclick="switchTab('tab-perfil', this)">
                <i class="fas fa-user-cog"></i> Mi Perfil
            </button>
        </div>


        <!-- TAB 1 — MIS ENTREGAS -->
        <div class="rep-nav-panel active" id="tab-entregas">

            <!-- Notificación de pedido asignado -->
            <div class="notif-asignacion" id="notifAdminBox">
                <div class="notif-icon"><i class="fas fa-bell"></i></div>
                <div class="notif-body">
                    <p class="notif-title"><i class="fas fa-user-shield me-1"></i> Asignación del administrador</p>
                    <p class="notif-msg">Se te asignó el pedido <strong>#LC-2026-0038</strong></p>
                    <p class="notif-sub">Asignado por <strong>Administrador</strong> · Hoy, 08:42 a.m. · Destino: Col. Vías Férreas, Veracruz</p>
                </div>
                <button class="notif-close-btn" onclick="cerrarNotif()">
                    <i class="fas fa-times"></i> Cerrar
                </button>
            </div>

            <div class="mb-2"><span class="section-title">Entrega Asignada</span></div>

            <!-- Entrega Card -->
            <div class="entrega-card" id="entregaCard">
                <div class="entrega-card-header">
                    <span><i class="fas fa-box me-1"></i> Pedido #LC-2026-0038</span>
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

                    <!-- Tracking visual -->
                    <div class="admin-form-card mb-4">
                        <div class="admin-form-header">
                            <i class="fas fa-map-marked-alt me-1"></i> Estado de la Entrega
                        </div>
                        <div class="admin-form-body">

                            <div class="rep-tracking" id="repTracking">
                                <div class="rep-step" id="rStep0">
                                    <div class="rep-step-circle"><i class="fas fa-inbox"></i></div>
                                    <div class="rep-step-label">Pedido recibido</div>
                                </div>
                                <div class="rep-line" id="rLine0"></div>
                                <div class="rep-step" id="rStep1">
                                    <div class="rep-step-circle"><i class="fas fa-box-open"></i></div>
                                    <div class="rep-step-label">En preparación</div>
                                </div>
                                <div class="rep-line" id="rLine1"></div>
                                <div class="rep-step" id="rStep2">
                                    <div class="rep-step-circle"><i class="fas fa-truck"></i></div>
                                    <div class="rep-step-label">Salió a ruta</div>
                                </div>
                                <div class="rep-line" id="rLine2"></div>
                                <div class="rep-step" id="rStep3">
                                    <div class="rep-step-circle"><i class="fas fa-home"></i></div>
                                    <div class="rep-step-label">Entregado</div>
                                </div>
                                <div class="rep-line" id="rLine3"></div>
                                <div class="rep-step" id="rStep4">
                                    <div class="rep-step-circle"><i class="fas fa-exclamation-triangle"></i></div>
                                    <div class="rep-step-label">Problema</div>
                                </div>
                            </div>

                            <!-- Selector de estado manual -->
                            <div class="mt-4 p-3 rounded" style="background:#f8fafc;border:1px solid #e0e7f0;">
                                <p class="fw-bold mb-2" style="font-size:.83rem;color:#333;">
                                    <i class="fas fa-sliders-h me-1" style="color:var(--btn-color)"></i>
                                    Cambiar estado del envío
                                </p>
                                <div class="estado-select-wrap">
                                    <!-- Custom dropdown con iconos FA -->
                                    <input type="hidden" id="selectorEstado" value="2">
                                    <div class="custom-estado-select" id="customEstadoSelect">
                                        <div class="custom-estado-selected" id="customEstadoSelected"
                                             onclick="toggleEstadoDropdown()">
                                            <span id="customEstadoIcon"><i class="fas fa-truck" style="color:#f59e0b; font-size:1rem"></i></span>
                                            <span id="customEstadoText">Salió a ruta</span>
                                            <i class="fas fa-chevron-down ms-auto custom-chevron" id="customChevron"></i>
                                        </div>
                                        <!-- El <ul> se inyecta en <body> vía JS para escapar overflow:hidden del card -->
                                    </div>
                                    <button class="btn-avanzar-estado" id="btnGuardarEstado"
                                            onclick="guardarEstado()">
                                        <i class="fas fa-save me-1"></i> Guardar estado
                                    </button>
                                </div>
                                <p style="font-size:.75rem;color:#888;margin:.6rem 0 0">
                                    Estado actual:
                                    <strong id="lblEstadoActual" style="color:var(--azul-marino)">Salió a ruta</strong>
                                    &nbsp;→&nbsp;
                                    <span id="lblSigEstado" style="color:#555">Selecciona el nuevo estado y guarda</span>
                                </p>
                            </div>

                        </div>
                    </div>

                    <!-- Confirmación de entrega -->
                    <div id="confirmEntregaBox" style="display:none">
                        <div class="admin-form-card">
                            <div class="admin-form-header" style="background:#065f46">
                                <i class="fas fa-check-double me-1"></i> Confirmación de Entrega
                            </div>
                            <div class="admin-form-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold small">Nombre de quien recibió</label>
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

            <!-- Sin entregas -->
            <div id="sinEntregas" style="display:none">
                <div class="admin-form-card">
                    <div class="admin-form-body empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>No tienes entregas asignadas en este momento.</p>
                    </div>
                </div>
            </div>

        </div><!-- /tab-entregas -->


        <!-- TAB 2 — HISTORIAL DE PEDIDOS -->
        <div class="rep-nav-panel" id="tab-historial">

            <div class="mb-3"><span class="section-title">Historial de Entregas</span></div>

            <!-- Filtros -->
            <div class="filter-bar mb-3">
                <label>Buscar folio</label>
                <input type="text" id="filtroFolio" placeholder="LC-2026-…"
                       oninput="filtrarHistorial()" style="max-width:160px">
                <label>Estado</label>
                <select id="filtroEstado" onchange="filtrarHistorial()">
                    <option value="">Todos</option>
                    <option value="Entregado">Entregado</option>
                    <option value="Problema">Problema</option>
                    <option value="Salió a ruta">Salió a ruta</option>
                    <option value="En preparación">En preparación</option>
                </select>
                <label>Mes</label>
                <select id="filtroMes" onchange="filtrarHistorial()">
                    <option value="">Todos</option>
                    <option value="enero">Enero</option>
                    <option value="febrero">Febrero</option>
                    <option value="marzo" selected>Marzo</option>
                </select>
                <button class="btn-buscar" onclick="limpiarFiltros()">
                    <i class="fas fa-undo"></i> Limpiar
                </button>
            </div>

            <!-- Tabla historial -->
            <div class="admin-table-wrap">
                <table class="admin-table" id="tablaHistorial">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Folio</th>
                            <th class="th-left">Cliente</th>
                            <th class="th-left">Producto</th>
                            <th>Fecha asignación</th>
                            <th>Fecha entrega</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="historialTbody">
                        <!-- JS renderiza las filas -->
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="pagination-row" id="histPaginacion"></div>

        </div><!-- /tab-historial -->


        <!-- TAB 3 — MI PERFIL -->
        <div class="rep-nav-panel" id="tab-perfil">

            <div class="mb-3"><span class="section-title">Mi Información</span></div>

            <div class="row g-4">

                <!-- Datos personales -->
                <div class="col-lg-7">
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-id-card me-1"></i> Datos Personales
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nombre(s)</label>
                                    <input type="text" id="pNombre" class="form-control" value="Juan">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos</label>
                                    <input type="text" id="pApellidos" class="form-control" value="Hernández Pérez">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono</label>
                                    <input type="tel" id="pTelefono" class="form-control" value="229-741-0000">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico</label>
                                    <input type="email" id="pCorreo" class="form-control" value="juan.hernandez@luchanoscorp.mx">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Dirección</label>
                                    <input type="text" id="pDireccion" class="form-control"
                                           value="Calle Reforma 123, Col. Centro, Veracruz, Ver.">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Turno</label>
                                    <select class="form-select" id="pTurno">
                                        <option selected>Matutino</option>
                                        <option>Vespertino</option>
                                        <option>Mixto</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Zona de reparto</label>
                                    <input type="text" id="pZona" class="form-control" value="Veracruz Norte">
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Vehículo</label>
                                    <select class="form-select" id="pVehiculo">
                                        <option selected>Motocicleta</option>
                                        <option>Bicicleta</option>
                                        <option>Camioneta</option>
                                        <option>A pie</option>
                                    </select>
                                </div>
                            </div>
                            <hr class="admin-form-divider mt-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn-admin-primary" onclick="guardarPerfil()">
                                    <i class="fas fa-save me-1"></i> Guardar cambios
                                </button>
                                <button class="btn-admin-secondary" onclick="resetPerfil()">
                                    <i class="fas fa-undo me-1"></i> Restaurar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cambiar contraseña + resumen -->
                <div class="col-lg-5">

                    <!-- Resumen -->
                    <div class="perfil-edit-card mb-4">
                        <div class="admin-form-header">
                            <i class="fas fa-chart-bar me-1"></i> Resumen del mes
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3 text-center">
                                <div class="col-4">
                                    <div class="stat-num" id="resEntregadas">3</div>
                                    <div class="stat-label">Entregadas</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-num" style="color:#d97706" id="resRuta">1</div>
                                    <div class="stat-label">En ruta</div>
                                </div>
                                <div class="col-4">
                                    <div class="stat-num" style="color:#dc3545" id="resProblemas">1</div>
                                    <div class="stat-label">Con problema</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cambiar contraseña -->
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-lock me-1"></i> Cambiar Contraseña
                        </div>
                        <div class="admin-form-body">
                            <div class="mb-3">
                                <label class="form-label">Contraseña actual</label>
                                <input type="password" id="pwActual" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nueva contraseña</label>
                                <input type="password" id="pwNueva" class="form-control" placeholder="••••••••">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Confirmar nueva contraseña</label>
                                <input type="password" id="pwConfirmar" class="form-control" placeholder="••••••••">
                                <div id="pwFeedback" class="text-danger" style="font-size:.78rem;margin-top:.25rem"></div>
                            </div>
                            <button class="btn-admin-primary" onclick="cambiarContrasena()">
                                <i class="fas fa-key me-1"></i> Actualizar contraseña
                            </button>
                        </div>
                    </div>

                </div>

            </div>

        </div><!-- /tab-perfil -->

    </main>
</div>

<?php include('vista/vendedor/footer_repartidor.php'); ?>