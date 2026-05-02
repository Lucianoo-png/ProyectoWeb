<?php include('vista/admin/header_admin.php'); ?>

<div class="admin-layout">
    <?php include('vista/admin/menu_admin.php'); ?>

    <main class="admin-content">


        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Clientes Registrados</h1>
            <p class="page-header-sub">Consulta los clientes registrados en línea o desde tienda física.</p>
        </div>

        <div class="row row-cols-2 row-cols-md-4 g-3 mb-4 justify-content-center">
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-num"><?php echo $total_clientes; ?></div>
                    <div class="stat-label">Total clientes</div>
                </div>
            </div>
        </div>

        <div class="report-form-card mb-4">
            <h5 class="text-center">
                <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Clientes
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
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Buscar cliente:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Nombre, correo o teléfono...">
                </div>
            </div>
        </div>

        <div class="report-form-card">
            <div class="admin-form-body pb-0 px-0">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="mb-0 text-center w-100">
                        <i class="fas fa-address-book me-2" style="color:var(--btn-color)"></i>Listado de Clientes
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
                                <option value="20">20</option>
                                <option value="all">Todos</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-pagination mt-3" id="paginationControls"></div>

            <div class="admin-table-wrap">
                <table class="admin-table" id="tablaClientes">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 1;
                            foreach($clientes as $clien){
                                ?>
                                <tr>
                                    <td style="color:#999; font-size:.8rem"><?php echo $i; ?></td>
                                    <td><strong><?php echo $clien['nombre']." ".$clien['apellidospama']; ?></strong></td>
                                    <td><?php echo $clien['correo']; ?></td>
                                    <td><?php echo $clien['telefono']; ?></td>
                                    <td><span class="badge-<?php if($clien['estatus']){echo "confirmada";}else{echo "pendiente";} ?>"><?php if($clien['estatus']){echo "Activo";}else{echo "Inactivo";}  ?></span></td>
                                </tr>
                                <?php
                                $i++;
                            }
                        ?>
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
    const filtroOrigen = document.getElementById('filtroOrigen');
    const filtroEstado = document.getElementById('filtroEstado');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.querySelector('#tablaClientes tbody');
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
        const fOrigen = filtroOrigen.value;
        const fEstado = filtroEstado.value;

        filteredRows = allRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const txtSearch = (cells[1].textContent + " " + cells[2].textContent + " " + cells[3].textContent).toLowerCase();
            
            // Textos exactos para selects
            const txtOrigen = cells[4].textContent.trim();
            const txtEstado = cells[6].textContent.trim();
            const rawFechaBD = cells[7].textContent.trim();

            if (term && !txtSearch.includes(term)) return false;
            if (fOrigen !== 'all' && txtOrigen !== fOrigen) return false;
            if (fEstado !== 'all' && txtEstado !== fEstado) return false;
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
    filtroOrigen.addEventListener('change', applyFilters);
    filtroEstado.addEventListener('change', applyFilters);


    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });
    
    renderTable();
});
</script>