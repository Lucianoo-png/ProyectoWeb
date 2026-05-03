<?php include('vista/admin/header_admin.php'); ?>

<div class="admin-layout">
    <?php include('vista/admin/menu_admin.php'); ?>

    <main class="admin-content">

        <!-- Encabezado -->
        <div class="mb-3 text-center">
            <h1 class="page-header-title mb-0">Asignar Pedidos a Repartidores</h1>
            <p class="page-header-sub">Gestiona y asigna los pedidos pendientes a los repartidores disponibles.</p>
        </div>

        <!-- Tarjetas de resumen -->
        <div class="report-form-card mb-3" style="background:transparent; box-shadow:none; border:none; padding-top:0; padding-bottom:0;">
            <div class="d-flex gap-2 flex-wrap">
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-box-open" style="color:var(--btn-color)"></i></div>
                    <div>
                        <div class="mini-num"><?php echo $total_pedidos_sin_asignar; ?></div>
                        <div class="mini-label">Pedidos sin asignar</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Alerta de resultado -->
        <?php if(isset($msj) && count($msj) > 0): ?>
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
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
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
                                <th class="th-left">Cliente</th>
                                <th class="th-left">Dirección de Entrega</th>
                                <th>Fecha</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Repartidor</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            
                            foreach($pedidos as $ped):
                                $direccion = $cli->getCliente()->buscar('"Veracruz".clientedireccion',["where"=>"no_dirección=".$ped["no_direccion"]]);
                                $total = $pedido->getPedido()->buscar('"Veracruz".pedido',["select"=>"total","where"=>"no_referencia=".$ped['no_referencia']]);
                                $asignado = $ped['rfc_repartidor']!=null;
                                $nombre='--';
                                $nombreRepartidor="--";
                                $nombre = $cli->getCliente()->buscar('"Veracruz".cliente',["select"=>"CONCAT(nombre,' ',apellidospama) as nombre","where"=>"no_cliente=".$direccion[0]['no_cliente']])[0]['nombre'];
                                if($asignado){$nombreRepartidor = $emp->getEmpleado()->buscar('"Veracruz".empleado',["select"=>"CONCAT(nombre,' ',apellidospama) as nombre","where"=>"rfc='".$ped['rfc_repartidor']."'"])[0]['nombre'];}
                            ?>
                            <tr>
                                <td><strong style="color:var(--btn-color)">#<?php echo str_pad($ped['no_orden'], 4, '0', STR_PAD_LEFT); ?></strong></td>
                                <td class="th-left">
                                    <strong><?php echo $nombre; ?></strong>
                                </td>
                                <td class="th-left" style="font-size:.8rem; max-width:200px">
                                    <?php echo $direccion[0]['calle_numero'] ?? '—'; ?><br>
                                    <span style="color:#888">Col. <?php echo $direccion[0]['colonia'] ?? ''; ?>, <?php echo $direccion[0]['cp'] ?? ''; ?> <?php echo $direccion[0]['ciudad'] ?? ''; ?> <?php echo $direccion[0]['estado'] ?? ''; ?></span>
                                </td>
                                <td><?php echo date('d/m/Y', strtotime($ped['fechayhora'])); ?></td>
                                <td><strong>$<?php echo number_format($total[0]['total'], 2); ?></strong></td>
                                <td>
                                    <?php if($asignado): ?>
                                        <span class="badge-confirmada">Asignado</span>
                                    <?php else: ?>
                                        <span class="badge-pendiente">Pendiente</span>
                                    <?php endif; ?>
                                </td>
                                <td style="font-size:.8rem">
                                    <?php echo $nombreRepartidor; ?>
                                </td>
                                <td>
                                    <?php if(!$asignado){ ?>
                                    <button class="btn-admin-primary" style="font-size:.75rem; padding:.35rem .8rem; white-space:nowrap"
                                            onclick="abrirModalAsignar(
                                                <?php echo $ped['no_orden']; ?>,
                                                '<?php echo str_pad($ped['no_orden'], 4, '0', STR_PAD_LEFT); ?>',
                                                '<?php echo addslashes($nombre ?? '—'); ?>'
                                            )">
                                        <i class="fas fa-<?php echo $asignado ? 'exchange-alt' : 'user-plus'; ?> me-1"></i>
                                        <?php echo $asignado ? 'Reasignar' : 'Asignar'; ?>
                                    </button>
                                    <?php }else{echo "--";} ?>
                                </td>
                                <td style="display:none"><?php echo date('Y-m-d', strtotime($ped['fechayhora'])); ?></td>
                                <td style="display:none"><?php echo $asignado ? 'asignado' : 'sin_asignar'; ?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
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

                    <form action="/proyectoweb/admin/asignar-pedidos" method="POST">
                        <input type="hidden" name="no_pedido" id="inputNoPedido">

                        <div class="row g-3">

                            <!-- Selector de repartidor -->
                            <div class="col-md-7">
                                <label class="form-label fw-semibold small">
                                    Repartidor <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" name="rfc_repartidor" id="selectRepartidor"
                                      >
                                    <!-- Fin opciones de ejemplo -->
                                    <?php foreach($repartidores ?? [] as $rep): ?>
                                        <option value="<?php echo $rep['rfc']; ?>">
                                            <?php echo $rep['nombre'].' '.$rep['apellidospama']; ?>
                                            — <?php echo $rep['empresa'] ?? 'Sin empresa'; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

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

    </main>
</div>

<!-- ══════════════════════════════════════════════
     Panel inline: Asignar / Reasignar repartidor
══════════════════════════════════════════════ -->

<?php include('vista/admin/footer_admin.php'); ?>


<script>

/* ─── Panel inline de asignación ────────────────────── */
function abrirModalAsignar(noPedido, folio, cliente, rfcActual) {
    document.getElementById('inputNoPedido').value          = noPedido;
    document.getElementById('modalFolioPed').textContent    = folio;
    document.getElementById('modalClientePed').textContent  = cliente;
    document.getElementById('panelTituloAsignar').textContent =
        rfcActual ? 'Reasignar Repartidor' : 'Asignar Repartidor';

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

/* ─── Tabla de pedidos: filtros y paginación ────────────── */
document.addEventListener('DOMContentLoaded', function () {
    const searchInput       = document.getElementById('searchInput');
    const filtroDesde       = document.getElementById('filtroDesde');
    const filtroHasta       = document.getElementById('filtroHasta');
    const filtroEstado      = document.getElementById('filtroEstado');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody             = document.querySelector('#tablaPedidos tbody');
    const allRows           = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls= document.getElementById('paginationControls');
    const infoRpp           = document.getElementById('info-rows-per-page');
    const infoCurr          = document.getElementById('info-current-page');
    const infoTot           = document.getElementById('info-total-pages');

    let currentPage  = 1;
    // INICIO CORRECCIÓN: Leemos el valor directo del HTML al cargar, no lo forzamos a 5 ciegamente
    let rowsPerPage  = rowsPerPageSelect.value === 'all' ? 'all' : parseInt(rowsPerPageSelect.value); 
    let filteredRows = [...allRows];

    function renderTable() {
        const total      = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(total / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;

        infoRpp.textContent  = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        infoCurr.textContent = totalPages === 0 ? 0 : currentPage;
        infoTot.textContent  = totalPages;

        // Primero ocultamos todos los renglones (los originales)
        allRows.forEach(r => r.style.display = 'none');
        
        // Luego mostramos solo los que pasaron el filtro Y están en la página actual
        if (total > 0) {
            const start = rowsPerPage === 'all' ? 0 : (currentPage - 1) * rowsPerPage;
            const end   = rowsPerPage === 'all' ? total : start + rowsPerPage;
            
            for (let i = start; i < end && i < total; i++) {
                filteredRows[i].style.display = '';
            }
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
            // Asegúrate de que estos índices coinciden con tu HTML
            const txtSearch = (cells[0].textContent + ' ' + cells[1].textContent).toLowerCase();
            const rawFecha  = cells[8] ? cells[8].textContent.trim() : '';
            const rawAsig   = cells[9] ? cells[9].textContent.trim() : '';

            if (term    && !txtSearch.includes(term))     return false;
            if (fEstado !== 'all' && rawAsig !== fEstado) return false;
            if (fDesde  && rawFecha < fDesde)             return false;
            if (fHasta  && rawFecha > fHasta)             return false;
            return true;
        });
        
        currentPage = 1; // Resetea a la primera página al filtrar
        renderTable();
    }

    // Listeners protegidos para los filtros de pedidos
    if (searchInput) searchInput.addEventListener('input', applyFilters);
    if (filtroDesde) filtroDesde.addEventListener('change', applyFilters);
    if (filtroHasta) filtroHasta.addEventListener('change', applyFilters);
    if (filtroEstado) filtroEstado.addEventListener('change', applyFilters);
    
    if (rowsPerPageSelect) {
        rowsPerPageSelect.addEventListener('change', function () {
            rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
    }

    renderTable(); // Inicializar
});
</script>