<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ElectroPendejo | Admin — Reporte de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>
    <div class="topbar">
        <div class="container-fluid d-flex justify-content-between px-3">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> <a href="/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="12617d627d60667752777e777166607d62777c7677787d3c717d7f">[email&#160;protected]</a></span>
            </div>
            <div><span><i class="fas fa-user-shield me-1"></i> Panel Administrador</span></div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-fluid d-flex align-items-center gap-3 px-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">ELECTRO</span><span class="pendejo">Pendejo</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="Buscar usuarios, productos...">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <span class="nav-icon" style="font-size:.82rem; color:#555">
                    <i class="fas fa-user-circle me-1" style="color:var(--btn-color)"></i> Admin
                </span>
            </div>
        </div>
    </div>

    <div class="admin-layout">
        <nav class="admin-sidebar">
            <p class="sidebar-title">Menú Admin</p>
            <a href="vistaadmin.php"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="admin_usuarios.php"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
            <a href="admin_productos.php" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="admin_reportes_ventas.php"  class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="admin_reportes_compras.php" class="nav-link active"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="admin_reportes_pedidos.php" class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
            <a href="../Cuenta/login.php" class="btn-cerrar">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </nav>

        <main class="admin-content">

            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="vistaadmin.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="admin_reportes_ventas.php" class="text-decoration-none" style="color:var(--btn-color)">Reportes</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Compras</li>
                </ol>
            </nav>

            <div class="mb-4">
                <h1 class="page-header-title mb-0">Reporte de Compras</h1>
                <p class="page-header-sub">Genera un reporte PDF filtrado de las compras a proveedores.</p>
            </div>

            <div class="report-form-card">
                <h5><i class="fas fa-shopping-bag me-2" style="color:var(--btn-color)"></i>Generar Reporte de Compras</h5>
                <form action="admin_reportes_compras.php" method="GET" novalidate>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Desde:</label>
                            <input type="date" name="desde" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Hasta:</label>
                            <input type="date" name="hasta" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Vendedor:</label>
                            <select name="vendedor" class="form-select">
                                <option value="">Todos</option>
                                <option>Juan Pérez</option>
                                <option>María García</option>
                                <option>Carlos Mendoza</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Producto:</label>
                            <select name="producto" class="form-select">
                                <option value="">Todos</option>
                                <option>Línea Blanca</option>
                                <option>Línea Marrón</option>
                                <option>Cocina</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Categoría:</label>
                            <select name="categoria" class="form-select">
                                <option value="">Todas las categorías</option>
                                <option>Línea Blanca</option>
                                <option>Línea Marrón</option>
                                <option>Cocina</option>
                                <option>Refrigeración</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Proveedor:</label>
                            <select name="proveedor" class="form-select">
                                <option value="">Todos</option>
                                <option>Whirlpool MX</option>
                                <option>Samsung MX</option>
                                <option>LG Electronics</option>
                                <option>Mabe</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cantidad mínima:</label>
                            <input type="number" name="cant_min" class="form-control" placeholder="0" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cantidad máxima:</label>
                            <input type="number" name="cant_max" class="form-control" placeholder="0" min="0">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Precio mínimo:</label>
                            <input type="number" name="precio_min" class="form-control" placeholder="$0.00" min="0" step="0.01">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Precio máximo:</label>
                            <input type="number" name="precio_max" class="form-control" placeholder="$0.00" min="0" step="0.01">
                        </div>
                        <div class="col-12 text-end mt-2">
                            <button type="submit" class="btn-generar-pdf">
                                <i class="fas fa-file-pdf"></i> Generar PDF
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </main>
    </div>

    <footer class="site-footer-minimal">© 2026 ElectroPendejo S.A. Todos los derechos reservados.</footer>
    <script data-cfasync="false" src="/c