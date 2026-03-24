<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Detalle de Ventas</title>
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
            <a href="#" class="topbar-link-muted">Ayuda</a>
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
        <a href="detalle_ventas.php" class="nav-link active">
            <i class="fas fa-receipt"></i> Detalle Ventas
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Consultas</p>
        <a href="inventario.php" class="nav-link">
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
                <li class="breadcrumb-item active text-muted">Detalle de Ventas</li>
            </ol>
        </nav>

        <div class="mb-4">
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

<footer class="site-footer-minimal">© <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
</body>
</html>