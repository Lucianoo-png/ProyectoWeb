<?php include('vista/admin/header_admin.php'); ?>

<div class="admin-layout">
    <?php include('vista/admin/menu_admin.php'); ?>

    <main class="admin-content">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/admin/inicio" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Asignar Pedidos</li>
            </ol>
        </nav>

        <!-- Encabezado -->
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Asignar Pedidos a Repartidores</h1>
            <p class="page-header-sub">Gestiona y asigna los pedidos pendientes a los repartidores disponibles.</p>
        </div>

        <!-- Tarjetas de resumen -->
        <div class="report-form-card mb-3" style="background:transparent; box-shadow:none; border:none; padding-top:0; padding-bottom:0;">
            <div class="d-flex gap-2 flex-wrap">
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-box-open" style="color:var(--btn-color)"></i></div>
                    <div>
                        <div class="mini-num"><?php echo count($pedidos_pendientes ?? []); ?></div>
                        <div class="mini-label">Pedidos sin asignar</div>
                    </div>
                </div>
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-motorcycle" style="color:#16a34a"></i></div>
                    <div>
                        <div class="mini-num"><?php echo count($repartidores ?? []); ?></div>
                        <div class="mini-label">Repartidores activos</div>
                    </div>
                </div>
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-truck" style="color:#f59e0b"></i></div>
                    <div>
                        <div class="mini-num"><?php echo count($pedidos_en_ruta ?? []); ?></div>
                        <div class="mini-label">En ruta hoy</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerta de resultado -->
        <?php if(isset($msj)): ?>
        <div class="alerta alerta-<?php echo $msj[0]; ?> mb-4 animate__animated animate__fadeInDown">
            <i class="fas <?php echo $msj[0] === 'exito' ? 'fa-check-circle' : 'fa-times-circle'; ?> me-2"></i>
            <?php echo $msj[1]; ?>
        </div>
        <?php endif; ?>

        <!-- Filtros -->
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
                        <option value="sin_asignar">Sin asignar</option>
                        <option value="asignado">Asignado</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Buscar:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Folio o cliente...">
                </div>
            </div>
        </div>

        <!-- Tabla de pedidos pendientes -->
        <div class="report-form-card mb-4">
            <div class="admin-form-body pb-0 px-0">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="mb-0 text-center w-100">
                        <i class="fas fa-clipboard-list me-2" style="color:var(--btn-color)"></i>Pedidos en Preparación
                    </h5>
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="table-page-info text-muted small">
                            Registros por página: <span id="info-rows-per-page">10</span> | Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                        </div>
                        <select id="rowsPerPageSelect" class="form-select form-select-sm w-auto">
                            <option value="10" selected>10</option>
                            <option value="20">20</option>
                            <option value="all">Todos</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="admin-pagination mt-3" id="paginationControls"></div>

            <div class="admin-table-wrap">
                <table class="admin-table" id="tablaPedidos">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Folio</th>
                            <th class="th-left">Cliente</th>
                            <th class="th-left">Dirección de Entrega</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Repartidor</th>
                            <th>Acción</th>
                            <!-- Columnas ocultas para filtros -->
                            <th style="display:none">RawFecha</th>
                            <th style="display:none">RawAsignado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        $pedidos_todos = array_merge($pedidos_pendientes ?? [], $pedidos_en_ruta ?? []);
                        foreach($pedidos_todos as $ped):
                            $asignado = !empty($ped['rfc_repartidor']);
                        ?>
                        <tr>
                            <td style="color:#999; font-size:.8rem"><?php echo $i; ?></td>
                            <td><strong style="color:var(--btn-color)">#LC-<?php echo str_pad($ped['no_pedido'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                            <td class="th-left">
                                <strong><?php echo $ped['nombre_cliente'] ?? '—'; ?></strong><br>
                                <span style="font-size:.75rem; color:#888"><?php echo $ped['correo_cliente'] ?? ''; ?></span>
                            </td>
                            <td class="th-left" style="font-size:.8rem; max-width:200px">
                                <?php echo $ped['calle_numero'] ?? '—'; ?><br>
                                <span style="color:#888">Col. <?php echo $ped['colonia'] ?? ''; ?>, <?php echo $ped['ciudad'] ?? ''; ?></span>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($ped['fecha_pedido'])); ?></td>
                            <td><strong>$<?php echo number_format($ped['total'], 2); ?></strong></td>
                            <td>
                                <?php if($asignado): ?>
                                    <span class="badge-confirmada">Asignado</span>
                                <?php else: ?>
                                    <span class="badge-pendiente">Sin asignar</span>
                                <?php endif; ?>
                            </td>
                            <td style="font-size:.8rem">
                                <?php echo $asignado ? ($ped['nombre_repartidor'] ?? '—') : '<span style="color:#aaa">—</span>'; ?>
                            </td>
                            <td>
                                <button class="btn-admin-primary" style="font-size:.75rem; padding:.35rem .8rem; white-space:nowrap"
                                        onclick="abrirModalAsignar(
                                            <?php echo $ped['no_pedido']; ?>,
                                            '#LC-<?php echo str_pad($ped['no_pedido'], 4, '0', STR_PAD_LEFT); ?>',
                                            '<?php echo addslashes($ped['nombre_cliente'] ?? '—'); ?>',
                                            <?php echo $asignado ? "'".$ped['rfc_repartidor']."'" : 'null'; ?>
                                        )">
                                    <i class="fas fa-<?php echo $asignado ? 'exchange-alt' : 'user-plus'; ?> me-1"></i>
                                    <?php echo $asignado ? 'Reasignar' : 'Asignar'; ?>
                                </button>
                            </td>
                            <td style="display:none"><?php echo date('Y-m-d', strtotime($ped['fecha_pedido'])); ?></td>
                            <td style="display:none"><?php echo $asignado ? 'asignado' : 'sin_asignar'; ?></td>
                        </tr>
                        <?php $i++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Tabla de repartidores disponibles -->
        <div class="report-form-card">
            <h5 class="text-center mb-3">
                <i class="fas fa-motorcycle me-2" style="color:var(--btn-color)"></i>Repartidores Disponibles
            </h5>
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Empresa</th>
                            <th>Teléfono</th>
                            <th>Pedidos activos</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $j = 1;
                        foreach($repartidores ?? [] as $rep):
                        ?>
                        <tr>
                            <td style="color:#999; font-size:.8rem"><?php echo $j; ?></td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div style="width:32px; height:32px; border-radius:50%; background:var(--btn-color); display:flex; align-items:center; justify-content:center; color:#fff; font-size:.75rem; font-weight:700; flex-shrink:0">
                                        <?php echo strtoupper(substr($rep['nombre'], 0, 1) . substr($rep['apellidospama'], 0, 1)); ?>
                                    </div>
                                    <strong><?php echo $rep['nombre'].' '.$rep['apellidospama']; ?></strong>
                                </div>
                            </td>
                            <td><?php echo $rep['empresa'] ?? '—'; ?></td>
                            <td><?php echo $rep['telefono'] ?? '—'; ?></td>
                            <td class="text-center">
                                <span class="badge-confirmada"><?php echo $rep['pedidos_activos'] ?? 0; ?></span>
                            </td>
                            <td>
                                <?php if(($rep['pedidos_activos'] ?? 0) < 3): ?>
                                    <span style="color:#16a34a; font-weight:600; font-size:.8rem"><i class="fas fa-circle me-1" style="font-size:.5rem"></i>Disponible</span>
                                <?php else: ?>
                                    <span style="color:#d97706; font-weight:600; font-size:.8rem"><i class="fas fa-circle me-1" style="font-size:.5rem"></i>Ocupado</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php $j++; endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<!-- ══════════════════════════════════════════════
     Modal: Asignar / Reasignar repartidor
══════════════════════════════════════════════ -->
<div class="modal-estado-overlay" id="modalAsignarOverlay" style="display:none; align-items:center; justify-content:center">
    <div class="modal-estado-box" style="max-width:480px; width:95%">
        <div class="modal-estado-header">
            <span><i class="fas fa-user-plus me-2"></i>Asignar Repartidor</span>
            <button class="btn-modal-x" onclick="cerrarModalAsignar()"><i class="fas fa-times"></i></button>
        </div>
        <div class="modal-estado-body">

            <div class="mb-3" style="background:#f0f4fb; border-radius:10px; padding:.9rem 1rem; border:1px solid #dce6f7">
                <div style="font-size:.75rem; color:#888; margin-bottom:.2rem">Pedido</div>
                <div style="font-weight:700; color:var(--btn-color); font-size:1rem" id="modalFolioPed">—</div>
                <div style="font-size:.82rem; color:#555; margin-top:.2rem" id="modalClientePed">—</div>
            </div>

            <form action="/proyectoweb/admin/asignar-pedido" method="POST">
                <input type="hidden" name="no_pedido" id="inputNoPedido">

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Seleccionar repartidor</label>
                    <select class="form-select" name="rfc_repartidor" id="selectRepartidor" required>
                        <option value="">— Elige un repartidor —</option>
                        <?php foreach($repartidores ?? [] as $rep): ?>
                            <option value="<?php echo $rep['rfc']; ?>"
                                    data-activos="<?php echo $rep['pedidos_activos'] ?? 0; ?>">
                                <?php echo $rep['nombre'].' '.$rep['apellidospama']; ?>
                                (<?php echo $rep['empresa'] ?? 'Sin empresa'; ?> ·
                                <?php echo $rep['pedidos_activos'] ?? 0; ?> activo<?php echo ($rep['pedidos_activos'] ?? 0) != 1 ? 's' : ''; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <div id="repWarning" style="display:none; font-size:.76rem; color:#d97706; margin-top:.35rem">
                        <i class="fas fa-exclamation-triangle me-1"></i>
                        Este repartidor tiene 3 o más pedidos activos. Considera otro.
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold small">Observaciones para el repartidor (opcional)</label>
                    <textarea class="form-control no-resize" name="observaciones" rows="2"
                              placeholder="Ej: Llamar antes de llegar, edificio sin elevador…"></textarea>
                </div>

                <div class="d-flex gap-2 justify-content-end">
                    <button type="button" class="btn-admin-secondary" onclick="cerrarModalAsignar()">Cancelar</button>
                    <button type="submit" name="asignar" class="btn-admin-primary">
                        <i class="fas fa-paper-plane me-1"></i> Confirmar asignación
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include('vista/admin/footer_admin.php'); ?>

<script>
/* ─── Modal ─────────────────────────────────────────────────── */
function abrirModalAsignar(noPedido, folio, cliente, rfcActual) {
    document.getElementById('inputNoPedido').value  = noPedido;
    document.getElementById('modalFolioPed').textContent  = folio;
    document.getElementById('modalClientePed').textContent = cliente;

    const sel = document.getElementById('selectRepartidor');
    sel.value = rfcActual || '';

    document.getElementById('repWarning').style.display = 'none';
    document.getElementById('modalAsignarOverlay').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function cerrarModalAsignar() {
    document.getElementById('modalAsignarOverlay').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('modalAsignarOverlay').addEventListener('click', function(e) {
    if (e.target === this) cerrarModalAsignar();
});

document.getElementById('selectRepartidor').addEventListener('change', function() {
    const activos = parseInt(this.options[this.selectedIndex]?.dataset.activos || 0);
    document.getElementById('repWarning').style.display = activos >= 3 ? 'block' : 'none';
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') cerrarModalAsignar();
});

/* ─── Tabla con filtros y paginación ────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    const searchInput      = document.getElementById('searchInput');
    const filtroDesde      = document.getElementById('filtroDesde');
    const filtroHasta      = document.getElementById('filtroHasta');
    const filtroEstado     = document.getElementById('filtroEstado');
    const rowsPerPageSelect= document.getElementById('rowsPerPageSelect');
    const tbody            = document.querySelector('#tablaPedidos tbody');
    const allRows          = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls = document.getElementById('paginationControls');
    const infoRpp  = document.getElementById('info-rows-per-page');
    const infoCurr = document.getElementById('info-current-page');
    const infoTot  = document.getElementById('info-total-pages');

    let currentPage  = 1;
    let rowsPerPage  = 10;
    let filteredRows = [...allRows];

    function renderTable() {
        const total      = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(total / rowsPerPage));
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;

        infoRpp.textContent  = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        infoCurr.textContent = totalPages === 0 ? 0 : currentPage;
        infoTot.textContent  = totalPages;

        allRows.forEach(r => r.style.display = 'none');
        if (total > 0) {
            const start = rowsPerPage === 'all' ? 0 : (currentPage - 1) * rowsPerPage;
            const end   = rowsPerPage === 'all' ? total : start + rowsPerPage;
            for (let i = start; i < end && i < total; i++) filteredRows[i].style.display = '';
        }
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        paginationControls.innerHTML = '';
        if (totalPages <= 1) return;
        paginationControls.innerHTML = '<span class="page-info">Página:</span>';
        if (currentPage > 1) {
            const b = document.createElement('button');
            b.className = 'pg-btn';
            b.innerHTML = '<i class="fas fa-chevron-left"></i>';
            b.onclick = () => { currentPage--; renderTable(); };
            paginationControls.appendChild(b);
        }
        const cur = document.createElement('button');
        cur.className = 'pg-btn active';
        cur.textContent = currentPage;
        paginationControls.appendChild(cur);
        if (currentPage < totalPages) {
            const b = document.createElement('button');
            b.className = 'pg-btn';
            b.innerHTML = '<i class="fas fa-chevron-right"></i>';
            b.onclick = () => { currentPage++; renderTable(); };
            paginationControls.appendChild(b);
        }
    }

    function applyFilters() {
        const term    = searchInput.value.toLowerCase().trim();
        const fDesde  = filtroDesde.value;
        const fHasta  = filtroHasta.value;
        const fEstado = filtroEstado.value;

        filteredRows = allRows.filter(row => {
            const cells      = row.querySelectorAll('td');
            const txtSearch  = (cells[1].textContent + ' ' + cells[2].textContent).toLowerCase();
            const rawFecha   = cells[9].textContent.trim();
            const rawAsig    = cells[10].textContent.trim();

            if (term    && !txtSearch.includes(term))    return false;
            if (fEstado !== 'all' && rawAsig !== fEstado) return false;
            if (fDesde  && rawFecha < fDesde)            return false;
            if (fHasta  && rawFecha > fHasta)            return false;
            return true;
        });
        currentPage = 1;
        renderTable();
    }

    searchInput.addEventListener('input', applyFilters);
    filtroDesde.addEventListener('change', applyFilters);
    filtroHasta.addEventListener('change', applyFilters);
    filtroEstado.addEventListener('change', applyFilters);
    rowsPerPageSelect.addEventListener('change', function () {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    renderTable();
});
</script>