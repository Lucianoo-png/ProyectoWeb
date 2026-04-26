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
                <li class="breadcrumb-item active text-muted">Historial del Sistema</li>
            </ol>
        </nav>

        <!-- Encabezado -->
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Historial del Sistema (Logs)</h1>
            <p class="page-header-sub">Consulta y filtra la actividad registrada por usuarios y módulos del sistema.</p>
        </div>

        <!-- Resumen rápido -->
        <div class="report-form-card mb-3" style="background:transparent; box-shadow:none; border:none; padding-top:0; padding-bottom:0;">
            <div class="d-flex gap-2">
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-list-alt" style="color:var(--btn-color)"></i></div>
                    <div><div class="mini-num"><?php echo $total_logs; ?></div><div class="mini-label">Total evento(s)</div></div>
                </div>
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-check-circle" style="color:#16a34a"></i></div>
                    <div><div class="mini-num"><?php echo $total_logs_exito; ?></div><div class="mini-label">Exitoso(s)</div></div>
                </div>
                <div class="stat-card-mini" style="cursor:default">
                    <div class="mini-icon"><i class="fas fa-times-circle" style="color:#dc2626"></i></div>
                    <div><div class="mini-num"><?php echo $total_logs_error; ?></div><div class="mini-label">Error(es)</div></div>
                </div>
            </div>
        </div>

        <div class="report-form-card mb-4">
            <h5 class="text-center">
                <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Registros
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
                    <label class="form-label">Usuario:</label>
                    <select id="filtroUsuario" class="form-select">
                        <option value="all">Todos</option>
                        <?php foreach($usuarios as $usu): ?>
                            <option value="<?php echo $usu['rfc']; ?>"><?php echo $usu['nombre']." ".$usu['apellidospama']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado:</label>
                    <select id="filtroEstado" class="form-select">
                        <option value="all">Todos</option>
                        <option value="C">Exitoso</option>
                        <option value="E">Error</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Buscar palabra clave:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Ej: producto eliminado, login fallido...">
                </div>
            </div>
        </div>

        <!-- Tabla de logs -->
        <div class="report-form-card">
            <div class="admin-form-body pb-0 px-0">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="mb-0 text-center w-100">
                        <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Eventos Registrados
                    </h5>
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="table-page-info text-muted small">
                            Número de registros por página: <span id="info-rows-per-page">5</span> | Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                        </div>
                        <div class="d-flex gap-2">
                            <select id="rowsPerPageSelect" class="form-select form-select-sm w-auto">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="all">Todos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="admin-pagination mt-3" id="paginationControls"></div>
            <div class="admin-table-wrap">
                <table class="admin-table" id="tablaLogs">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha y Hora</th>
                            <th>Usuario</th>
                            <th>Acción</th>
                            <th>Estado</th>
                            <th style="display:none;">RawDate</th>
                            <th style="display:none;">RawEstado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($logs as $log): ?>
                        <tr>
                            <td style="color:#999; font-size:.8rem"><?php echo $log['no_bitacora']; ?></td>
                            <td><?php echo date('d/m/Y H:i:s', strtotime($log['fechayhora'])); ?></td>
                            <td><strong><?php if($log['rfc']!=null){ echo $log['rfc']; }else{echo "--";} ?></strong></td>
                            <td><?php echo $log['descripcion']; ?></td>
                            <td><span class="badge-<?php echo ($log['estado']=='C') ? 'confirmada' : 'pendiente'; ?>"><?php echo ($log['estado']=='C') ? 'Exitoso' : 'Error'; ?></span></td>
                            
                            <td style="display:none;"><?php echo date('Y-m-d', strtotime($log['fechayhora'])); ?></td>
                            <td style="display:none;"><?php echo $log['estado']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>
</div>

<?php include('vista/admin/footer_admin.php'); ?>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filtroDesde = document.getElementById('filtroDesde');
    const filtroHasta = document.getElementById('filtroHasta');
    const filtroUsuario = document.getElementById('filtroUsuario');
    const filtroEstado = document.getElementById('filtroEstado');
    
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.querySelector('#tablaLogs tbody');
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
        infoCurrentPage.textContent = currentPage;
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
        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return; 
        }

        paginationControls.innerHTML = '<span class="page-info">Página:</span>';
        
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left me-1"></i>';
            btnPrev.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage--;
                renderTable();
            });
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
            btnNext.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage++;
                renderTable();
            });
            paginationControls.appendChild(btnNext);
        }
    }

    function applyFilters() {
        const term = searchInput.value.toLowerCase();
        const fDesde = filtroDesde.value; 
        const fHasta = filtroHasta.value;
        const fUser = filtroUsuario.value;
        const fEstado = filtroEstado.value;

        filteredRows = allRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const txtFecha = cells[1].textContent.toLowerCase();
            const txtUsuario = cells[2].textContent;
            const txtAccion = cells[3].textContent.toLowerCase();
            const rawFechaBD = cells[5].textContent;
            const rawEstadoBD = cells[6].textContent;
            const textToSearch = txtFecha + " " + txtUsuario.toLowerCase() + " " + txtAccion;
            if (term && !textToSearch.includes(term)) return false;
            if (fUser !== 'all' && txtUsuario !== fUser) return false;
            if (fEstado !== 'all' && rawEstadoBD !== fEstado) return false;
            if (fDesde && rawFechaBD < fDesde) return false;
            if (fHasta && rawFechaBD > fHasta) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }

    searchInput.addEventListener('input', applyFilters);
    filtroDesde.addEventListener('change', applyFilters);
    filtroHasta.addEventListener('change', applyFilters);
    filtroUsuario.addEventListener('change', applyFilters);
    filtroEstado.addEventListener('change', applyFilters);
    
    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });
    renderTable();
});
</script>