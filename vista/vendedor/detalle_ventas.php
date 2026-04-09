<?php include('vista/vendedor/header_vendedor.php'); ?>

<!-- Layout -->
<div class="admin-layout">

    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <!-- Contenido -->
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

        <!-- Filtros -->
        <div class="admin-form-card mb-3">
            <div class="admin-form-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small">Folio de venta</label>
                        <input type="number" id="fFolio" class="form-control" placeholder="Ej: 5">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Desde:</label>
                        <input type="date" id="fDesde" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Hasta:</label>
                        <input type="date" id="fHasta" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label fw-semibold small">Cliente:</label>
                        <select id="fCliente" class="form-select">
                            <option value="">Todos</option>
                            <option>Ana Torres</option>
                            <option>Luis Ramírez</option>
                            <option>Roberto Méndez</option>
                            <option>Claudia Soto</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button class="btn-admin-primary w-100" onclick="filtrarVentas()">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>
                <p class="filter-hint">
                    <i class="fas fa-info-circle"></i>
                    Si no se ingresa fecha final se toma la fecha actual. Registros por página: 20.
                </p>
            </div>
        </div>

        <!-- Tabla de resultados -->
        <div class="admin-form-card">
            <div class="admin-form-body pb-0">
                <div class="table-toolbar">
                    <span class="table-toolbar-count">
                        <span id="totalRegistros">8</span> registros encontrados
                    </span>
                    <button class="btn-admin-secondary" onclick="alert('Exportando a PDF...')">
                        <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                    </button>
                </div>
            </div>
            <div class="admin-form-body pt-0">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Folio</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Cliente</th>
                                <th>Producto (SKU)</th>
                                <th>Unidades × Precio</th>
                                <th>Subtotal</th>
                                <th>Tipo de Pago</th>
                                <th>Ticket</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyDetalle">
                            <!-- Generado por vendedor.js → renderDetalleVentas() -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination-row">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
            </div>
        </div>

    </main>
</div>

<?php include('vista/vendedor/footer_vendedor.php'); ?>