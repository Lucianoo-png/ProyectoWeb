<div class="rep-toast" id="repToast">
    <i class="fas fa-check-circle"></i>
    <span id="repToastMsg">Acción completada</span>
</div>

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

<div class="admin-layout">

    <nav class="admin-sidebar">
        <p class="sidebar-title">Repartidor</p>
        <a class="nav-link <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" style="cursor:pointer;" onclick="switchTab('tab-entregas', this); return false;">
            <i class="fas fa-truck"></i> Mis Entregas
            <span class="tab-badge ms-auto" id="badgeSidebar">1</span>
        </a>
        <a class="nav-link" style="cursor:pointer;" onclick="switchTab('tab-historial', this); return false;">
            <i class="fas fa-history"></i> Historial
        </a>
        <a class="nav-link <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" style="cursor:pointer;" onclick="switchTab('tab-perfil', this); return false;">
            <i class="fas fa-user-cog"></i> Mi Perfil
        </a>
        <hr class="sidebar-divider">
        <a href="/proyectoweb/repartidor/logout" style="cursor:pointer;margin-top:0;" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Panel de Repartidor</h1>
            <p class="page-header-sub">
                Bienvenido de nuevo. Gestiona tus entregas asignadas.
            </p>
        </div>

        <div class="info-card-vend mb-4">
            <div class="info-avatar"><i class="fas fa-motorcycle"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value"><?php echo $info[0]['empresa']; ?></span></p>
                <p><span class="label">Repartidor</span><br>
                   <span class="value"><?php echo $info[0]['nombre']." ".$info[0]['apellidospama']; ?></span></p>
                <p><span class="label">Modalidad</span><br>
                   <span class="value">Externa</span></p>
            </div>
        </div>

        <div class="rep-nav-tabs">
            <button class="rep-nav-btn <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="btn-tab-entregas"
                    onclick="switchTab('tab-entregas', this)">
                <i class="fas fa-truck"></i> Mis Entregas
            </button>
            <button class="rep-nav-btn" id="btn-tab-historial"
                    onclick="switchTab('tab-historial', this)">
                <i class="fas fa-history"></i> Historial de Pedidos
            </button>
            <button class="rep-nav-btn <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="btn-tab-perfil"
                    onclick="switchTab('tab-perfil', this)">
                <i class="fas fa-user-cog"></i> Mi Perfil
            </button>
        </div>


        <div class="rep-nav-panel <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="tab-entregas">

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

            <div class="entrega-card" id="entregaCard">
                <div class="entrega-card-header">
                    <span><i class="fas fa-box me-1"></i> Pedido #LC-2026-0038</span>
                    <span id="badgeEstado" class="badge-estado badge-ruta">Salió a ruta</span>
                </div>
                <div class="entrega-card-body">

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

                            <div class="mt-4 p-3 rounded" style="background:#f8fafc;border:1px solid #e0e7f0;">
                                <p class="fw-bold mb-2" style="font-size:.83rem;color:#333;">
                                    <i class="fas fa-sliders-h me-1" style="color:var(--btn-color)"></i>
                                    Cambiar estado del envío
                                </p>
                                <div class="estado-select-wrap">
                                    <input type="hidden" id="selectorEstado" value="2">
                                    <div class="custom-estado-select" id="customEstadoSelect">
                                        <div class="custom-estado-selected" id="customEstadoSelected"
                                             onclick="toggleEstadoDropdown()">
                                            <span id="customEstadoIcon"><i class="fas fa-truck" style="color:#f59e0b; font-size:1rem"></i></span>
                                            <span id="customEstadoText">Salió a ruta</span>
                                            <i class="fas fa-chevron-down ms-auto custom-chevron" id="customChevron"></i>
                                        </div>
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
            </div><div id="sinEntregas" style="display:none">
                <div class="admin-form-card">
                    <div class="admin-form-body empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>No tienes entregas asignadas en este momento.</p>
                    </div>
                </div>
            </div>

        </div><div class="rep-nav-panel" id="tab-historial">

            <div class="mb-3"><span class="section-title">Historial de Entregas</span></div>

            <div class="report-form-card mb-4">
                <h5 class="text-center">
                    <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Pedidos
                </h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Desde:</label>
                        <input type="date" id="filtroDesde" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hasta:</label>
                        <input type="date" id="filtroHasta" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select id="filtroEstado" class="form-select">
                            <option value="all">Todos</option>
                            <option value="Entregado">Entregado</option>
                            <option value="Problema">Problema</option>
                            <option value="Salió a ruta">Salió a ruta</option>
                            <option value="En preparación">En preparación</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Búsqueda rápida:</label>
                        <input type="text" id="searchInput" class="form-control" placeholder="Folio o Cliente...">
                    </div>
                </div>
            </div>

            <div class="report-form-card">
                <div class="admin-form-body pb-0 px-0">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="mb-0 text-center w-100">
                            <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Listado de Historial
                        </h5>
                        <div class="w-100 d-flex justify-content-between align-items-center px-3">
                            <div class="table-page-info text-muted small">
                                Número de registros por página: <span id="info-rows-per-page">5</span> | Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                            </div>
                            <div class="d-flex gap-2">
                                <select id="rowsPerPageSelect" class="form-select form-select-sm w-auto">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="all">Todos</option>
                                </select>
                                <button class="btn-generar-pdf" style="font-size:.78rem; padding:.45rem 1rem">
                                    <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-pagination mt-3 px-3" id="paginationControls"></div>

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
                            </tbody>
                    </table>
                </div>
            </div>

        </div><div class="rep-nav-panel <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="tab-perfil">

            <div class="mb-3"><span class="section-title">Mi Información</span></div>

            <div class="row g-4">

                <div class="col-lg-7">
                    <form action="/proyectoweb/repartidor/inicio" method="POST">
                    <input type="hidden" name="guardar" value="1">
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-id-card me-1"></i> Datos Personales
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3">
                                <?php if(isset($msj) && isset($_REQUEST['guardar'])){ ?>
                                    <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <label class="form-label">Nombre(s) *</label>
                                    <input type="text" id="pNombre" name="nombre" value="<?php echo $info[0]['nombre']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos *</label>
                                    <input type="text" id="pApellidos" name="apellidos" value="<?php echo $info[0]['apellidospama']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono *</label>
                                    <input type="tel" id="pTelefono" class="form-control" name="telefono" value="<?php echo $info[0]['telefono']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico *</label>
                                    <input type="email" id="pCorreo" class="form-control" name="correo" value="<?php echo $info[0]['correo']; ?>">
                                </div>
                            </div>
                            <hr class="admin-form-divider mt-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" name="guardar" class="btn-admin-primary">
                                    <i class="fas fa-save me-1"></i> Guardar cambios
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="col-lg-5">

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

                    <form action="/proyectoweb/repartidor/inicio" method="POST">
                    <input type="hidden" name="actualizar_contra" value="1">
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-lock me-1"></i> Cambiar Contraseña
                        </div>
                        <div class="admin-form-body">
                            <?php if(isset($msj) && isset($_REQUEST['actualizar_contra'])){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                            <?php } ?>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="password">Contraseña <span class="text-danger">*</span></label>
                                    <div class="pw-wrapper">
                                        <input type="password" id="password" name="password" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                        <span class="pw-toggle" onclick="togglePw('password','eye1')">
                                            <i class="fas fa-eye" id="eye1"></i>
                                        </span>
                                    </div>
                                    <div id="pw-indicadores" style="margin-top:.5rem"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="confirmPassword">Confirmar Contraseña <span class="text-danger">*</span></label>
                                    <div class="pw-wrapper">
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                        <span class="pw-toggle" onclick="togglePw('confirmPassword','eye2')">
                                            <i class="fas fa-eye" id="eye2"></i>
                                        </span>
                                    </div>
                                    <div id="pw-confirm-msg" style="font-size:.75rem;margin-top:.35rem;font-weight:600;min-height:1rem"></div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="actualizar_contra" id="btnRegistrar" class="btn-cuenta-save w-100">
                                    <i class="fas fa-key me-1"></i> Actualizar contraseña
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>    
                </div>

            </div>

        </div></main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filtroDesde = document.getElementById('filtroDesde');
    const filtroHasta = document.getElementById('filtroHasta');
    const filtroEstado = document.getElementById('filtroEstado');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    
    const tbody = document.getElementById('historialTbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls = document.getElementById('paginationControls');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages = document.getElementById('info-total-pages');
    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredRows = [...allRows];
    function renderTable() {
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;
        
        infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        infoTotalPages.textContent = totalPages;

        allRows.forEach(row => row.style.display = 'none');
        
        if (totalRows > 0) {
            let start = 0;
            let end = totalRows;

            if (rowsPerPage !== 'all') {
                start = (currentPage - 1) * rowsPerPage;
                end = start + rowsPerPage;
            }

            for (let i = start; i < end && i < totalRows; i++) {
                filteredRows[i].style.display = ''; 
            }
        }
        renderPagination(totalPages);
    }
    function renderPagination(totalPages) {
        if (!paginationControls) return;
        paginationControls.innerHTML = '';

        if (totalPages <= 1) return; 

        const spanInfo = document.createElement('span');
        spanInfo.className = 'page-info';
        spanInfo.textContent = 'Página:';
        paginationControls.appendChild(spanInfo);
        
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left me-1"></i>';
            btnPrev.onclick = () => { currentPage--; renderTable(); };
            paginationControls.appendChild(btnPrev);
        }

        const btnCurrent = document.createElement('button');
        btnCurrent.className = 'pg-btn active';
        btnCurrent.textContent = currentPage;
        paginationControls.appendChild(btnCurrent);
        
        if (currentPage < totalPages) {
            const btnNext = document.createElement('button');
            btnNext.className = 'pg-btn';
            btnNext.innerHTML = '<i class="fas fa-chevron-right ms-1"></i>';
            btnNext.onclick = () => { currentPage++; renderTable(); };
            paginationControls.appendChild(btnNext);
        }
    }
    function applyFilters() {
        const term = searchInput.value.toLowerCase().trim();
        const fDesde = filtroDesde.value; 
        const fHasta = filtroHasta.value;
        const fEstado = filtroEstado.value;

        filteredRows = allRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const txtSearch = (cells[1].textContent + " " + cells[2].textContent).toLowerCase();
            const txtEstado = cells[7].textContent.trim();
            const rawFecha = cells[4].textContent.trim();

            if (term && !txtSearch.includes(term)) return false;
            if (fEstado !== 'all' && txtEstado !== fEstado) return false;
            if (fDesde && rawFecha < fDesde) return false;
            if (fHasta && rawFecha > fHasta) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }
    if(searchInput) searchInput.addEventListener('input', applyFilters);
    if(filtroDesde) filtroDesde.addEventListener('change', applyFilters);
    if(filtroHasta) filtroHasta.addEventListener('change', applyFilters);
    if(filtroEstado) filtroEstado.addEventListener('change', applyFilters);

    if(rowsPerPageSelect) {
        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
    }
    renderTable();
});
</script>

<?php include('vista/vendedor/footer_repartidor.php'); ?>