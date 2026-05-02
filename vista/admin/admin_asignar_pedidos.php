<?php include('vista/admin/header_admin.php'); ?>

<div class="admin-layout">
    <?php include('vista/admin/menu_admin.php'); ?>

    <main class="admin-content">

        <!-- Encabezado -->
        <div class="mb-3 text-center">
            <h1 class="page-header-title mb-0">Asignar Pedidos a Repartidores</h1>
            <p class="page-header-sub">Gestiona y asigna los pedidos pendientes a los repartidores disponibles.</p>
        </div>

        <!-- ── Botones de alternancia (estilo imagen) ── -->
        <div class="d-flex justify-content-center gap-3 mb-4">
            <button id="btnVerPedidos" class="btn-toggle-view btn-toggle-outline" onclick="switchView('pedidos')">
                <i class="fas fa-user-plus me-2"></i> Asignar Pedido
            </button>
            <button id="btnVerRepartidores" class="btn-toggle-view btn-toggle-filled" onclick="switchView('repartidores')">
                <i class="fas fa-search me-2"></i> Consulta / Repartidores
            </button>
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
                        <!-- Solo repartidores con tipousuario = 'R' -->
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

        <!-- ══════════════════════════════════════════════
             SECCIÓN A: Asignar Pedidos (tabla de pedidos)
        ══════════════════════════════════════════════ -->
        <div id="seccionPedidos">

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

            <!-- Tabla de pedidos -->
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

                            <!-- ── Fila de EJEMPLO (eliminar cuando haya datos reales) ── -->
                            <tr style="background:#fffef0">
                                <td style="color:#999; font-size:.8rem">★</td>
                                <td><strong style="color:var(--btn-color)">#LC-0042</strong></td>
                                <td class="th-left">
                                    <strong>Aranza García de los Angeles</strong><br>
                                    <span style="font-size:.75rem; color:#888">tosora120@gmail.com</span>
                                </td>
                                <td class="th-left" style="font-size:.8rem; max-width:200px">
                                    Hacienda Mendocinas #134<br>
                                    <span style="color:#888">Col. Torrentes, Veracruz</span>
                                </td>
                                <td>02/05/2026</td>
                                <td><strong>$4,299.00</strong></td>
                                <td><span class="badge-pendiente">Sin asignar</span></td>
                                <td><span style="color:#aaa">—</span></td>
                                <td>
                                    <button class="btn-admin-primary" style="font-size:.75rem; padding:.35rem .8rem; white-space:nowrap"
                                            onclick="abrirModalAsignar(42, '#LC-0042', 'Aranza García de los Angeles', null)">
                                        <i class="fas fa-user-plus me-1"></i> Asignar
                                    </button>
                                </td>
                                <td style="display:none">2026-05-02</td>
                                <td style="display:none">sin_asignar</td>
                            </tr>
                            <!-- ── Fin fila de ejemplo ── -->
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- ── Panel inline de asignación ── -->
            <div id="formAsignarWrapper" style="display:none">
                <div class="report-form-card mt-4" style="border-top: 3px solid var(--btn-color)">

                    <!-- Encabezado del panel -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0" style="color:var(--azul-marino); font-weight:700">
                            <i class="fas fa-user-plus me-2" style="color:var(--btn-color)"></i>
                            <span id="panelTituloAsignar">Asignar Repartidor</span>
                        </h5>
                        <button class="btn-modal-x" onclick="cerrarFormAsignar()" title="Cerrar">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>

                    <!-- Tarjeta de resumen del pedido -->
                    <div class="mb-4 p-3" style="background:#f0f4fb; border-radius:.65rem; border:1px solid #dce6f7">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <div style="width:46px; height:46px; border-radius:50%; background:var(--btn-color); display:flex; align-items:center; justify-content:center; color:#fff">
                                    <i class="fas fa-box"></i>
                                </div>
                            </div>
                            <div class="col">
                                <div style="font-size:.72rem; color:#888; text-transform:uppercase; letter-spacing:.07em; margin-bottom:.1rem">Pedido seleccionado</div>
                                <div style="font-weight:700; color:var(--btn-color); font-size:1.05rem" id="modalFolioPed">—</div>
                                <div style="font-size:.82rem; color:#555; margin-top:.1rem" id="modalClientePed">—</div>
                            </div>
                        </div>
                    </div>

                    <form action="/proyectoweb/admin/asignar-pedido" method="POST">
                        <input type="hidden" name="no_pedido" id="inputNoPedido">

                        <div class="row g-3">

                            <!-- Selector de repartidor -->
                            <div class="col-md-7">
                                <label class="form-label fw-semibold small">
                                    Repartidor <span class="text-danger">*</span>
                                    <span style="font-size:.72rem; color:#888; font-weight:400 ">(tipousuario = R)</span>
                                </label>
                                <select class="form-select" name="rfc_repartidor" id="selectRepartidor" required
                                        onchange="verificarCargaRepartidor(this)">
                                    <option value="">— Selecciona un repartidor —</option>
                                    <!-- Opción de EJEMPLO (eliminar cuando haya repartidores reales) -->
                                    <option value="LOGO850101ABC" data-activos="1">Carlos López Gómez — Express Veracruz (1 activo)</option>
                                    <option value="PERM900312XYZ" data-activos="3">Pedro Ramírez Mena — Envíos Rápidos (3 activos)</option>
                                    <!-- Fin opciones de ejemplo -->
                                    <?php foreach($repartidores ?? [] as $rep): ?>
                                        <?php $act = $rep['pedidos_activos'] ?? 0; ?>
                                        <option value="<?php echo $rep['rfc']; ?>"
                                                data-activos="<?php echo $act; ?>">
                                            <?php echo $rep['nombre'].' '.$rep['apellidospama']; ?>
                                            — <?php echo $rep['empresa'] ?? 'Sin empresa'; ?>
                                            (<?php echo $act; ?> activo<?php echo $act != 1 ? 's' : ''; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                                <!-- Aviso de carga alta -->
                                <div id="repWarning" style="display:none; font-size:.76rem; color:#d97706; margin-top:.4rem; padding:.4rem .7rem; background:#fffbeb; border-radius:.4rem; border:1px solid #fde68a">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Este repartidor ya tiene <strong>3 o más</strong> pedidos activos. Considera elegir otro.
                                </div>

                                <!-- Tarjeta de info del repartidor seleccionado -->
                                <div id="repInfoCard" style="display:none; margin-top:.6rem; padding:.6rem .85rem; background:#f0fdf4; border:1px solid #bbf7d0; border-radius:.5rem; font-size:.8rem">
                                    <i class="fas fa-motorcycle me-1" style="color:#16a34a"></i>
                                    <span id="repInfoTexto" style="color:#166534"></span>
                                </div>
                            </div>

                            <!-- Observaciones -->
                            <div class="col-md-5">
                                <label class="form-label fw-semibold small">Observaciones <span style="color:#aaa; font-weight:400">(opcional)</span></label>
                                <textarea class="form-control" name="observaciones" rows="4"
                                          style="resize:vertical; font-size:.87rem"
                                          placeholder="Ej: Llamar antes de llegar, edificio sin elevador, entregar en portería…"></textarea>
                            </div>

                        </div><!-- /row -->

                        <!-- Acciones -->
                        <div class="d-flex gap-2 justify-content-end mt-3 pt-3" style="border-top:1px solid #eaeff5">
                            <button type="button" class="btn-admin-secondary" onclick="cerrarFormAsignar()">
                                <i class="fas fa-times me-1"></i> Cancelar
                            </button>
                            <button type="submit" name="asignar" class="btn-admin-primary">
                                <i class="fas fa-paper-plane me-1"></i> Confirmar asignación
                            </button>
                        </div>

                    </form>
                </div>
            </div><!-- /formAsignarWrapper -->

        </div><!-- /seccionPedidos -->


        <!-- ══════════════════════════════════════════════
             SECCIÓN B: Consulta de Repartidores (tipousuario = 'R')
        ══════════════════════════════════════════════ -->
        <div id="seccionRepartidores" style="display:none">

            <!-- Búsqueda rápida -->
            <div class="report-form-card mb-4">
                <h5 class="text-center">
                    <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Repartidores
                </h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Estado:</label>
                        <select id="filtroRepEstado" class="form-select">
                            <option value="all">Todos</option>
                            <option value="disponible">Disponible (&lt; 3 activos)</option>
                            <option value="ocupado">Ocupado (≥ 3 activos)</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Buscar repartidor:</label>
                        <input type="text" id="searchRep" class="form-control" placeholder="Nombre, RFC o empresa...">
                    </div>
                </div>
            </div>

            <!-- Tabla de repartidores (solo tipousuario = 'R') -->
            <div class="report-form-card">
                <h5 class="text-center mb-3">
                    <i class="fas fa-motorcycle me-2" style="color:var(--btn-color)"></i>Repartidores Disponibles
                    <span class="ms-2" style="font-size:.75rem; color:#888; font-weight:400">(tipousuario = R)</span>
                </h5>
                <div class="admin-table-wrap">
                    <table class="admin-table" id="tablaRepartidores">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>RFC</th>
                                <th>Empresa</th>
                                <th>Teléfono</th>
                                <th>Pedidos activos</th>
                                <th>Estado</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 1;
                            foreach($repartidores ?? [] as $rep):
                                $activos = $rep['pedidos_activos'] ?? 0;
                                $disponible = $activos < 3;
                            ?>
                            <tr
                                data-nombre="<?php echo strtolower($rep['nombre'].' '.$rep['apellidospama']); ?>"
                                data-rfc="<?php echo strtolower($rep['rfc']); ?>"
                                data-empresa="<?php echo strtolower($rep['empresa'] ?? ''); ?>"
                                data-estado="<?php echo $disponible ? 'disponible' : 'ocupado'; ?>"
                            >
                                <td style="color:#999; font-size:.8rem"><?php echo $j; ?></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div style="width:34px; height:34px; border-radius:50%; background:var(--btn-color); display:flex; align-items:center; justify-content:center; color:#fff; font-size:.75rem; font-weight:700; flex-shrink:0">
                                            <?php echo strtoupper(substr($rep['nombre'], 0, 1) . substr($rep['apellidospama'], 0, 1)); ?>
                                        </div>
                                        <div>
                                            <strong><?php echo $rep['nombre'].' '.$rep['apellidospama']; ?></strong>
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:.8rem; color:#666"><?php echo $rep['rfc']; ?></td>
                                <td><?php echo $rep['empresa'] ?? '—'; ?></td>
                                <td><?php echo $rep['telefono'] ?? '—'; ?></td>
                                <td class="text-center">
                                    <span class="badge-<?php echo $disponible ? 'confirmada' : 'pendiente'; ?>">
                                        <?php echo $activos; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if($disponible): ?>
                                        <span style="color:#16a34a; font-weight:600; font-size:.8rem">
                                            <i class="fas fa-circle me-1" style="font-size:.5rem"></i>Disponible
                                        </span>
                                    <?php else: ?>
                                        <span style="color:#d97706; font-weight:600; font-size:.8rem">
                                            <i class="fas fa-circle me-1" style="font-size:.5rem"></i>Ocupado
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <!-- Botón para asignar directamente desde vista de repartidores -->
                                    <button class="btn-admin-secondary" style="font-size:.75rem; padding:.3rem .75rem; white-space:nowrap"
                                            onclick="switchView('pedidos'); setTimeout(()=>{ document.getElementById('filtroEstado').value='sin_asignar'; document.getElementById('filtroEstado').dispatchEvent(new Event('change')); }, 200)">
                                        <i class="fas fa-arrow-left me-1"></i> Ver pedidos
                                    </button>
                                </td>
                            </tr>
                            <?php $j++; endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php if(empty($repartidores)): ?>
                <div class="text-center py-4 text-muted">
                    <i class="fas fa-motorcycle fa-2x mb-2" style="opacity:.3"></i>
                    <p class="mb-0 small">No hay repartidores registrados con tipousuario = R</p>
                </div>
                <?php endif; ?>
            </div>

        </div><!-- /seccionRepartidores -->

    </main>
</div>

<!-- ══════════════════════════════════════════════
     Panel inline: Asignar / Reasignar repartidor
══════════════════════════════════════════════ -->

<?php include('vista/admin/footer_admin.php'); ?>


<script>
/* ─── Alternancia de secciones ─────────────────────────── */
function switchView(vista) {
    const secPed  = document.getElementById('seccionPedidos');
    const secRep  = document.getElementById('seccionRepartidores');
    const btnPed  = document.getElementById('btnVerPedidos');
    const btnRep  = document.getElementById('btnVerRepartidores');

    if (vista === 'pedidos') {
        secPed.style.display  = '';
        secRep.style.display  = 'none';
        // Botón Asignar → relleno, Consulta → outline
        btnPed.className = 'btn-toggle-view btn-toggle-filled';
        btnRep.className = 'btn-toggle-view btn-toggle-outline';
    } else {
        secPed.style.display  = 'none';
        secRep.style.display  = '';
        btnPed.className = 'btn-toggle-view btn-toggle-outline';
        btnRep.className = 'btn-toggle-view btn-toggle-filled';
    }
}

/* ─── Panel inline de asignación ────────────────────── */
function abrirModalAsignar(noPedido, folio, cliente, rfcActual) {
    document.getElementById('inputNoPedido').value          = noPedido;
    document.getElementById('modalFolioPed').textContent    = folio;
    document.getElementById('modalClientePed').textContent  = cliente;
    document.getElementById('panelTituloAsignar').textContent =
        rfcActual ? 'Reasignar Repartidor' : 'Asignar Repartidor';

    const sel = document.getElementById('selectRepartidor');
    sel.value = rfcActual || '';
    verificarCargaRepartidor(sel);

    const wrapper = document.getElementById('formAsignarWrapper');
    wrapper.style.display = '';
    wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function cerrarFormAsignar() {
    const wrapper = document.getElementById('formAsignarWrapper');
    wrapper.style.display = 'none';
    document.getElementById('selectRepartidor').value = '';
    document.getElementById('repWarning').style.display   = 'none';
    document.getElementById('repInfoCard').style.display  = 'none';
}

function verificarCargaRepartidor(sel) {
    const opt     = sel.options[sel.selectedIndex];
    const activos = parseInt(opt?.dataset.activos || 0);
    const nombre  = opt?.textContent?.split('—')[0]?.trim() || '';

    document.getElementById('repWarning').style.display  = activos >= 3 ? 'block' : 'none';

    const infoCard  = document.getElementById('repInfoCard');
    const infoTexto = document.getElementById('repInfoTexto');
    if (sel.value && nombre) {
        infoTexto.textContent = nombre + ' · ' + activos + ' pedido' + (activos !== 1 ? 's' : '') + ' activo' + (activos !== 1 ? 's' : '');
        infoCard.style.background = activos >= 3 ? '#fffbeb' : '#f0fdf4';
        infoCard.style.borderColor = activos >= 3 ? '#fde68a' : '#bbf7d0';
        infoCard.querySelector('i').style.color = activos >= 3 ? '#d97706' : '#16a34a';
        infoTexto.style.color = activos >= 3 ? '#92400e' : '#166534';
        infoCard.style.display = 'block';
    } else {
        infoCard.style.display = 'none';
    }
}

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') cerrarFormAsignar();
});

/* ─── Filtro de tabla de repartidores ───────────────────── */
document.getElementById('searchRep').addEventListener('input', filtrarRepartidores);
document.getElementById('filtroRepEstado').addEventListener('change', filtrarRepartidores);

function filtrarRepartidores() {
    const term   = document.getElementById('searchRep').value.toLowerCase().trim();
    const estado = document.getElementById('filtroRepEstado').value;
    document.querySelectorAll('#tablaRepartidores tbody tr').forEach(row => {
        const nombre  = row.dataset.nombre  || '';
        const rfc     = row.dataset.rfc     || '';
        const empresa = row.dataset.empresa || '';
        const est     = row.dataset.estado  || '';
        const matchTerm   = !term   || (nombre+rfc+empresa).includes(term);
        const matchEstado = estado === 'all' || est === estado;
        row.style.display = (matchTerm && matchEstado) ? '' : 'none';
    });
}

/* ─── Tabla de pedidos: filtros y paginación ────────────── */
document.addEventListener('DOMContentLoaded', function () {
    const searchInput       = document.getElementById('searchInput');
    const filtroDesde       = document.getElementById('filtroDesde');
    const filtroHasta       = document.getElementById('filtroHasta');
    const filtroEstado      = document.getElementById('filtroEstado');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody             = document.querySelector('#tablaPedidos tbody');
    const allRows           = Array.from(tbody.querySelectorAll('tr'));
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
            const cells     = row.querySelectorAll('td');
            const txtSearch = (cells[1].textContent + ' ' + cells[2].textContent).toLowerCase();
            const rawFecha  = cells[9].textContent.trim();
            const rawAsig   = cells[10].textContent.trim();

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

    // Estado inicial de botones: Asignar activo por defecto
    switchView('pedidos');
});
</script>