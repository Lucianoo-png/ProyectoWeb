<?php include('vista/vendedor/header_vendedor.php'); ?>

<div class="admin-layout">

    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/vendedor/inicio/" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Detalle de Ventas</li>
            </ol>
        </nav>

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Detalle de Ventas</h1>
            <p class="page-header-sub">Consulta el historial de ventas realizadas. Filtra por folio o rango de fechas.</p>
        </div>

        <div class="report-form-card mb-4">
            <h5 class="text-center">
                <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Ventas
            </h5>
            <div class="row g-3 align-items-end">
                <div class="col-md-2">
                    <label class="form-label fw-semibold small">Folio de venta</label>
                    <input type="number" id="filtroFolio" min="1" class="form-control" placeholder="Ej: 5">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Desde:</label>
                    <input type="date" id="filtroDesde" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold small">Hasta:</label>
                    <input type="date" id="filtroHasta" class="form-control">
                </div>
                <div class="col-md-4">
                    <label class="form-label fw-semibold small">Buscar cliente o producto:</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Nombre de cliente, SKU o producto...">
                </div>
            </div>
            <p class="filter-hint mt-3 mb-0">
                <i class="fas fa-info-circle"></i>
                Si no se ingresa fecha final se toma la fecha actual. Los resultados se actualizan automáticamente.
            </p>
        </div>

        <div class="report-form-card">
            <div class="admin-form-body pb-0 px-0">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                    <h5 class="mb-0 text-center w-100">
                        <i class="fas fa-receipt me-2" style="color:var(--btn-color)"></i>Historial de Registros
                    </h5>
                    
                    <div class="w-100 d-flex justify-content-between align-items-center">
                        <div class="table-page-info text-muted small">
                            Número de registros por página: <span id="info-rows-per-page">20</span> | Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                        </div>
                        <div class="d-flex gap-2">
                            <select id="rowsPerPageSelect" class="form-select form-select-sm w-auto">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="all">Todos</option>
                            </select>
                            <button class="btn-generar-pdf" style="font-size:.78rem; padding:.45rem 1rem" onclick="alert('Exportando a PDF...')">
                                <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="admin-pagination mt-3" id="paginationControls"></div>

            <div class="admin-form-body pt-0 px-0">
                <div class="admin-table-wrap">
                    <table class="admin-table" id="tablaDetalleVentas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Cliente</th>
                                <th>Producto (SKU)</th>
                                <th>Unidades × Precio</th>
                                <th>Subtotal</th>
                                <th>Tipo de Pago</th>
                                <th>Ticket</th>
                                <th style="display:none;">RawDate</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDetalle">
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
    const searchInput = document.getElementById('searchInput');
    const filtroFolio = document.getElementById('filtroFolio');
    const filtroDesde = document.getElementById('filtroDesde');
    const filtroHasta = document.getElementById('filtroHasta');
    
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.getElementById('tbodyDetalle');
    const paginationControls = document.getElementById('paginationControls');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages  = document.getElementById('info-total-pages');

    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredData = typeof VENTAS_DEMO !== 'undefined' ? [...VENTAS_DEMO] : []; 
    
    function fmtPrecio(n) {
        return '$' + parseFloat(n).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    }

    function parseDateToISO(dateStr) {
        if (!dateStr) return '';
        const parts = dateStr.split('/');
        if (parts.length === 3) return `${parts[2]}-${parts[1]}-${parts[0]}`;
        return dateStr;
    }

    function renderTable() {
        const totalRows = filteredData.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;
        
        if(infoRowsPerPage) infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        if(infoCurrentPage) infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        if(infoTotalPages) infoTotalPages.textContent = totalPages;

        if(!tbody) return;
        tbody.innerHTML = '';

        if (totalRows === 0) {
            tbody.innerHTML = `<tr><td colspan="10" class="text-center text-muted py-4">No se encontraron ventas que coincidan con los filtros.</td></tr>`;
            renderPagination(totalPages);
            return;
        }

        let start = 0;
        let end = totalRows;

        if (rowsPerPage !== 'all') {
            start = (currentPage - 1) * rowsPerPage;
            end = start + rowsPerPage;
        }

        let htmlRows = '';
        for (let i = start; i < end && i < totalRows; i++) {
            const v = filteredData[i];
            const rawDate = parseDateToISO(v.fecha);
            
            htmlRows += `
            <tr>
                <td style="color:#999; font-size:.8rem">${i + 1}</td>
                <td style="font-weight:700">${v.folio}</td>
                <td>${v.fecha}</td>
                <td>${v.hora}</td>
                <td class="td-name">${v.cliente}</td>
                <td>
                    <code style="font-size:.75rem; color:#d63384">${v.sku}</code><br>
                    <span style="font-size:.75rem;color:#666">${v.desc}</span>
                </td>
                <td style="text-align:center">${v.qty} × ${fmtPrecio(v.precio)}</td>
                <td style="font-weight:700;color:var(--azul-marino)">${fmtPrecio(v.qty * v.precio)}</td>
                <td>${v.pago}</td>
                <td>
                    <button class="btn-ticket" onclick="generarTicket(${v.folio})">
                        <i class="fas fa-print me-1"></i>Ticket
                    </button>
                </td>
                <td style="display:none;">${rawDate}</td>
            </tr>`;
        }
        
        tbody.innerHTML = htmlRows;
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
        if (typeof VENTAS_DEMO === 'undefined') return;

        const term = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const fFolio = filtroFolio ? filtroFolio.value.trim() : '';
        const fDesde = filtroDesde ? filtroDesde.value : ''; 
        const fHasta = filtroHasta ? filtroHasta.value : '';

        filteredData = VENTAS_DEMO.filter(v => {
            const txtSearch = (v.cliente + " " + v.sku + " " + v.desc).toLowerCase();
            const rawFechaBD = parseDateToISO(v.fecha);

            if (fFolio && String(v.folio) !== fFolio) return false;
            if (term && !txtSearch.includes(term)) return false;
            if (fDesde && rawFechaBD < fDesde) return false;
            if (fHasta && rawFechaBD > fHasta) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }

    if(searchInput) searchInput.addEventListener('input', applyFilters);
    if(filtroFolio) filtroFolio.addEventListener('input', applyFilters);
    if(filtroDesde) filtroDesde.addEventListener('change', applyFilters);
    if(filtroHasta) filtroHasta.addEventListener('change', applyFilters);

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