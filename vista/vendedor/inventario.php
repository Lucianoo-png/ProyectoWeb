<?php include('vista/vendedor/header_vendedor.php'); ?>

<div class="admin-layout">

    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/vendedor/inicio" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Inventario</li>
            </ol>
        </nav>

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Inventario de Electrodomésticos</h1>
            <p class="page-header-sub">Consulta el estado actual del stock por producto.</p>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--primary">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="mini-stat-num"><?php echo $total_productos; ?></div>
                    <div class="mini-stat-label">Productos totales</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="mini-stat-num"><?php echo $total_productos_normal; ?></div>
                    <div class="mini-stat-label">Con stock normal</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--warn">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="mini-stat-num"><?php echo $total_productos_bajo; ?></div>
                    <div class="mini-stat-label">Bajo stock</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--danger">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="mini-stat-num"><?php echo $total_productos_agotado; ?></div>
                    <div class="mini-stat-label">Agotados</div>
                </div>
            </div>
        </div>

        <div class="admin-form-card mb-3">
            <div class="admin-form-body">
                <div class="row g-3 align-items-end justify-content-center">
                    <div class="col-md-8">
                        <label class="form-label fw-semibold small">Título o SKU:</label>
                        <input type="text" id="invBuscar" class="form-control"
                               placeholder="Ej: lavadora, WM3911D…">
                    </div>
                </div>
            </div>
        </div>

        <div class="admin-form-card">
            
            <div class="admin-form-body pb-0 px-0">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2 px-4">
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
                            <button class="btn-generar-pdf" style="font-size:.78rem; padding:.45rem 1rem">
                                <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-pagination mt-0" id="paginationControls"></div>

            <div class="admin-form-body pt-2 px-0">
                <div class="admin-table-wrap">
                    <table class="admin-table" id="tablaInventario">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>SKU</th>
                                <th class="th-left">Descripción</th>
                                <th>Stock</th>
                                <th>Stock Mínimo</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyInventarioDB">
                            <?php 
                            if(is_array($productos) && count($productos) > 0) {
                                $i = 1;
                                foreach($productos as $prod) {
                                    $nombre = $prod['nombre'];
                                    $categoria = isset($prod['categoria']) ? $prod['categoria'] : 'Genérica';
                                    $stock = (int)$prod['stock'];
                                    $sku = Helpers::crearSKU($categoria, $nombre);
                                    if ($stock === 0) {
                                        $badge = '<span class="badge-out">Agotado</span>';
                                        $obs = 'No disponible para venta';
                                        $color = '#dc3545';
                                    } else if ($stock < $prod['stockminimo']) {
                                        $badge = '<span class="badge-warn">Bajo stock</span>';
                                        $obs = 'Próximo a agotarse — Reabastecer';
                                        $color = '#d97706';
                                    } else {
                                        $badge = '<span class="badge-activo">Disponible</span>';
                                        $obs = 'Disponible para venta';
                                        $color = '#065f46';
                                    }
                            ?>
                            <tr>
                                <td style="color:#999; font-size:.8rem"><?php echo $i; ?></td>
                                <td><code style="font-size:.8rem; color:#d63384"><?php echo $sku; ?></code></td>
                                <td style="text-align:left">
                                    <div class="inv-title" style="font-weight:700; color:var(--azul-marino)"><?php echo $nombre; ?></div>
                                </td>
                                <td style="font-weight:800;color:<?php echo $color; ?>"><?php echo $stock; ?></td>
                                <td style="font-weight:800;"><?php echo $prod['stockminimo']; ?></td>
                                <td><?php echo $badge; ?></td>
                                <td style="font-size:.78rem;color:#666"><?php echo $obs; ?></td>
                            </tr>
                            <?php 
                                    $i++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>

<?php include('vista/vendedor/footer_vendedor.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const invBuscar = document.getElementById('invBuscar');
    
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.querySelector('#tablaInventario tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls = document.getElementById('paginationControls');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages  = document.getElementById('info-total-pages');
    
    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredRows = [...allRows];

    function renderTable() {
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;
        
        if(infoRowsPerPage) infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        if(infoCurrentPage) infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        if(infoTotalPages) infoTotalPages.textContent = totalPages;
        
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

        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return; 
        }

        let pgHtml = '<span class="page-info">Página:</span>';
        
        if (currentPage > 1) {
            pgHtml += `<button class="pg-btn" data-page="${currentPage - 1}"><i class="fas fa-chevron-left me-1"></i></button>`;
        }

        pgHtml += `<button class="pg-btn active">${currentPage}</button>`;
        
        if (currentPage < totalPages) {
            pgHtml += `<button class="pg-btn" data-page="${currentPage + 1}"><i class="fas fa-chevron-right ms-1"></i></button>`;
        }
        
        paginationControls.innerHTML = pgHtml;
        
        paginationControls.querySelectorAll('.pg-btn:not(.active)').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                currentPage = parseInt(this.getAttribute('data-page'));
                renderTable();
            });
        });
    }

    function applyFilters() {
        const term = invBuscar.value.toLowerCase().trim();

        filteredRows = allRows.filter(row => {
            const cells = row.querySelectorAll('td');
            // Celdas: 0:#, 1:SKU, 2:Descripción, 3:Stock, 4:Min, 5:Estado, 6:Obs
            const txtSearch = (cells[1].textContent + " " + cells[2].textContent).toLowerCase();

            if (term && !txtSearch.includes(term)) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }

    if(invBuscar) invBuscar.addEventListener('input', applyFilters);

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