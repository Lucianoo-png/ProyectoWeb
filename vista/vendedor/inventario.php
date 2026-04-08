<?php include('vista/vendedor/header_vendedor.php'); ?>

<!-- Layout -->
<div class="admin-layout">

    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <!-- Contenido -->
    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/vendedor/inicio" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Inventario</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h1 class="page-header-title mb-0">Inventario de Electrodomésticos</h1>
            <p class="page-header-sub">Consulta el estado actual del stock por producto.</p>
        </div>

        <!-- Resumen de stock -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--primary">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <div class="mini-stat-num">10</div>
                    <div class="mini-stat-label">Productos totales</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="mini-stat-num">6</div>
                    <div class="mini-stat-label">Con stock normal</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--warn">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="mini-stat-num">2</div>
                    <div class="mini-stat-label">Bajo stock</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="mini-stat-card">
                    <div class="mini-stat-icon mini-stat-icon--danger">
                        <i class="fas fa-times-circle"></i>
                    </div>
                    <div class="mini-stat-num">2</div>
                    <div class="mini-stat-label">Agotados</div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="admin-form-card mb-3">
            <div class="admin-form-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-5">
                        <label class="form-label fw-semibold small">Título o SKU:</label>
                        <input type="text" id="invBuscar" class="form-control"
                               placeholder="Ej: lavadora, WM3911D…">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold small">Categoría:</label>
                        <select id="invCat" class="form-select">
                            <option value="">Todas las categorías</option>
                            <option value="Lavado">Lavado</option>
                            <option value="Refrigeración">Refrigeración</option>
                            <option value="Cocina">Cocina</option>
                            <option value="Climatización">Climatización</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn-admin-primary w-100" onclick="filtrarInventario()">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>
                <p class="filter-hint">Número de registros por página: 10</p>
            </div>
        </div>

        <!-- Tabla de inventario -->
        <div class="admin-form-card">
            <div class="admin-form-body">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>SKU</th>
                                <th class="th-left">Descripción</th>
                                <th>Categoría</th>
                                <th>Stock</th>
                                <th>Estado</th>
                                <th>Observaciones</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyInventario">
                            <!-- Generado por vendedor.js → renderInventario() -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="pagination-row">
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
            </div>
        </div>

    </main>
</div>
<?php include('vista/vendedor/footer_vendedor.php');  ?>