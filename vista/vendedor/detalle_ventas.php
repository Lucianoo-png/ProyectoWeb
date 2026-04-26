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
                    <label class="form-label fw-semibold small">Buscar cliente</label>
                    <input type="text" id="searchInput" class="form-control" placeholder="Nombre de cliente">
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
                            <button class="btn-generar-pdf" id="btnExportarPDF" style="font-size:.78rem; padding:.45rem 1rem">
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
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Cliente</th>
                                <th>Total</th>
                                <th>Tipo de Pago</th>
                                <th>Ticket</th>
                                <th style="display:none;">RawDate</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($ventas)): ?>
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        No se encontraron ventas registradas.
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach($ventas as $v): 
                                    // Formateamos fecha y hora
                                    $fecha = date("d/m/Y", strtotime($v['fechayhora']));
                                    $hora = date("H:i:s", strtotime($v['fechayhora']));
                                    if(empty($v['nombre_cliente'])){$datos_cli = $cli->getCliente()->buscar('"Veracruz".cliente',["where"=>"no_cliente=".$v['no_cliente']]);}
                                    // Lógica para el nombre del cliente
                                    $cliente = !empty($v['nombre_cliente']) ? $v['nombre_cliente'] : $datos_cli[0]['nombre']." ".$datos_cli[0]['apellidospama'];
                                    
                                    // Clase para el badge de pago
                                    $badgeClass = ($v['tipo_pago'] == 'tarjeta') ? 'bg-info' : 'bg-success';
                                ?>
                                    <tr class="fila-venta" data-folio="<?php echo $v['no_referencia']; ?>" 
    data-cliente="<?php echo mb_strtolower($cliente); ?>" 
    data-fecha="<?php echo date("Y-m-d", strtotime($v['fechayhora'])); ?>">
                                        <td><strong>#<?php echo str_pad($v['no_referencia'], 5, "0", STR_PAD_LEFT); ?></strong></td>
                                        <td><?php echo $fecha; ?></td>
                                        <td><?php echo $hora; ?></td>
                                        <td><?php echo $cliente; ?></td>
                                        <td><strong>$<?php echo number_format($v['total'], 2); ?></strong></td>
                                        <td>
                                            <span class="badge <?php echo $badgeClass; ?> text-white">
                                                <?php echo ucfirst($v['tipo_pago']); ?>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-danger" title="Generar PDF" 
                                                        onclick="window.open('', '_blank')">
                                                    <i class="fas fa-file-pdf"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>
</div>
<form id="formExportarPDF" action="/proyectoweb/vendedor/reportes" method="POST" target="_blank" style="display:none;">
    <input type="hidden" name="folio" id="pdf_folio">
    <input type="hidden" name="desde" id="pdf_desde">
    <input type="hidden" name="hasta" id="pdf_hasta">
    <input type="hidden" name="cliente" id="pdf_cliente">
    <input type="hidden" name="exportar_pdf" value="1">
</form>

<?php include('vista/vendedor/footer_vendedor.php'); ?>
<script>
let rowsPerPage = 5; 

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filtroFolio = document.getElementById('filtroFolio');
    const filtroDesde = document.getElementById('filtroDesde');
    const filtroHasta = document.getElementById('filtroHasta');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const paginationControls = document.getElementById('paginationControls');
    
    // 1. Declaramos las variables principales aquí arriba
    const todasLasFilas = Array.from(document.querySelectorAll('.fila-venta'));
    let filasFiltradas = [...todasLasFilas]; 
    let currentPage = 1;

    function renderTable() {
        const totalRows = filasFiltradas.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage > totalPages) currentPage = totalPages;
        if (currentPage < 1) currentPage = 1;

        const spanRows = document.getElementById('info-rows-per-page');
        const spanCurrent = document.getElementById('info-current-page');
        const spanTotal = document.getElementById('info-total-pages');

        if (spanRows) spanRows.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        if (spanCurrent) spanCurrent.textContent = totalRows === 0 ? 0 : currentPage;
        if (spanTotal) spanTotal.textContent = totalPages;

        todasLasFilas.forEach(row => row.style.display = 'none');

        let start = 0;
        let end = totalRows;
        if (rowsPerPage !== 'all') {
            start = (currentPage - 1) * rowsPerPage;
            end = start + rowsPerPage;
        }

        filasFiltradas.slice(start, end).forEach(row => {
            row.style.display = 'table-row';
        });

        renderPagination(totalPages);
    }

    function applyFilters() {
        const term = searchInput ? searchInput.value.toLowerCase().trim() : '';
        const fFolio = filtroFolio ? filtroFolio.value.trim() : '';
        const fDesde = filtroDesde ? filtroDesde.value : ''; 
        const fHasta = filtroHasta ? filtroHasta.value : '';

        filasFiltradas = todasLasFilas.filter(row => {
            const cliente = row.dataset.cliente;
            const folio = row.dataset.folio;
            const fecha = row.dataset.fecha;

            if (fFolio && !folio.includes(fFolio)) return false;
            if (term && !cliente.includes(term)) return false;
            if (fDesde && fecha < fDesde) return false;
            if (fHasta && fecha > fHasta) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }

    function renderPagination(totalPages) {
        if (!paginationControls) return;
        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return;
        }

        let html = `<button class="pg-btn ${currentPage === 1 ? 'disabled' : ''}" id="prevPage">Anterior</button>`;
        html += `<span class="mx-2">Página ${currentPage} de ${totalPages}</span>`;
        html += `<button class="pg-btn ${currentPage === totalPages ? 'disabled' : ''}" id="nextPage">Siguiente</button>`;
        
        paginationControls.innerHTML = html;

        document.getElementById('prevPage')?.addEventListener('click', () => {
            if (currentPage > 1) { currentPage--; renderTable(); }
        });
        document.getElementById('nextPage')?.addEventListener('click', () => {
            if (currentPage < totalPages) { currentPage++; renderTable(); }
        });
    }

    // --- LÓGICA DEL BOTÓN EXPORTAR (Dentro del Scope) ---
    const btnExportar = document.getElementById('btnExportarPDF');
    if (btnExportar) {
        btnExportar.addEventListener('click', function() {
            // Ahora filasFiltradas sí es accesible y está actualizada
            if (filasFiltradas.length === 0) {
                alert('No hay datos disponibles para generar el documento con los filtros actuales.');
                return;
            }

            // Llenamos el formulario oculto
            document.getElementById('pdf_folio').value = filtroFolio.value;
            document.getElementById('pdf_desde').value = filtroDesde.value;
            document.getElementById('pdf_hasta').value = filtroHasta.value;
            document.getElementById('pdf_cliente').value = searchInput.value;

            document.getElementById('formExportarPDF').submit();
        });
    }

    // Eventos de Filtros
    searchInput?.addEventListener('input', applyFilters);
    filtroFolio?.addEventListener('input', applyFilters);
    filtroDesde?.addEventListener('change', applyFilters);
    filtroHasta?.addEventListener('change', applyFilters);
    
    rowsPerPageSelect?.addEventListener('change', function() {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });

    // Carga inicial
    renderTable();
});
</script>