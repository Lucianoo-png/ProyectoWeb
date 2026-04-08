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
                <li class="breadcrumb-item active text-muted">Catálogo</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h1 class="page-header-title mb-0">Catálogo de Productos</h1>
            <p class="page-header-sub">Consulta la oferta completa de electrodomésticos disponibles.</p>
        </div>

        <!-- Filtros -->
        <div class="admin-form-card mb-4">
            <div class="admin-form-body">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Buscar por:</label>
                        <input type="text" id="catBuscar" class="form-control"
                               placeholder="Nombre o SKU…">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Categoría:</label>
                        <select id="catCategoria" class="form-select">
                            <option value="">Todas las categorías</option>
                            <option value="Lavado">Lavado</option>
                            <option value="Refrigeración">Refrigeración</option>
                            <option value="Cocina">Cocina</option>
                            <option value="Climatización">Climatización</option>
                            <option value="Audio y Video">Audio y Video</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-semibold small">Rango de precio:</label>
                        <select id="catPrecio" class="form-select">
                            <option value="">Todos los precios</option>
                            <option value="0-5000">Menos de $5,000</option>
                            <option value="5000-15000">$5,000 – $15,000</option>
                            <option value="15000+">Más de $15,000</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <button class="btn-admin-primary w-100" onclick="filtrarCatalogo()">
                            <i class="fas fa-search me-1"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid de catálogo -->
        <div id="catalogoGrid" class="catalogo-grid">
            <!-- Generado por vendedor.js → renderCatalogo() -->
        </div>

        <div class="pagination-row pagination-row--transparent mt-3">
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
        </div>

    </main>
</div>
<?php include('vista/vendedor/footer_vendedor.php'); ?>