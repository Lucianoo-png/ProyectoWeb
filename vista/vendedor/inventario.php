<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/vendedor.css">
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="../rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
            <!-- <a href="#" class="topbar-link-muted">Ayuda</a>-->
          </div>
        </div>
    </div>

<!-- Navbar -->
<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="Buscar productos…">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Vendedor</p>
        <a href="inicio_vendedor.php" class="nav-link">
            <i class="fas fa-tachometer-alt"></i> Inicio
        </a>
        <a href="ventas.php" class="nav-link">
            <i class="fas fa-cash-register"></i> Venta
        </a>
        <a href="detalle_ventas.php" class="nav-link">
            <i class="fas fa-receipt"></i> Detalle Ventas
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Consultas</p>
        <a href="inventario.php" class="nav-link active">
            <i class="fas fa-boxes"></i> Inventario
        </a>
        <a href="catalogo.php" class="nav-link">
            <i class="fas fa-th-large"></i> Catálogo
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Atención</p>
        <a href="solicitudes.php" class="nav-link">
            <i class="fas fa-headset"></i> Solicitudes
            <span class="tab-badge">4</span>
        </a>
        <a href="../../vista/Cuenta/login.php" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <!-- Contenido -->
    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="inicio_vendedor.php" class="breadcrumb-link">Inicio</a>
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

<footer class="site-footer-minimal">© <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
<link rel="stylesheet" href="../../estilos/responsive.css">
<script src="../../js/responsive.js"></script>
</body>
</html>