<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp| Panel Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body>
    <div class="topbar">
        <div class="container-fluid d-flex justify-content-between px-3">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
            </div>
            <div><span class="me-2"><i class="fas fa-user-shield me-1"></i> Panel Administrador</span></div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-fluid d-flex align-items-center gap-3 px-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
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
            <a href="vistaadmin.php"      class="nav-link active"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="admin_usuarios.php"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
            <a href="admin_productos.php" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="admin_reportes_ventas.php"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="admin_reportes_compras.php"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="admin_reportes_pedidos.php"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
            <a href="../Cuenta/login.php" class="btn-cerrar">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </nav>

        <main class="admin-content">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div>
                    <h1 class="page-header-title mb-0">Panel de Administración</h1>
                    <p class="page-header-sub">Bienvenido de vuelta. Aquí tienes un resumen del sistema.</p>
                </div>
                <span class="badge text-white px-3 py-2 rounded-pill" style="background:var(--btn-color); font-size:.78rem">
                    <i class="fas fa-circle me-1" style="font-size:.5rem; vertical-align:middle"></i> Sistema activo
                </span>
            </div>

            <div class="admin-info-card">
                <div class="info-avatar"><i class="fas fa-user-shield"></i></div>
                <div class="info-rows">
                    <p><span class="label">Nombre</span><br><span class="value">Administrador del Sistema</span></p>
                    <p><span class="label">Usuario</span><br><span class="value">ADMIN01 — Administrador</span></p>
                    <p><span class="label">Turno de atención</span><br><span class="value">Matutino</span></p>
                </div>
            </div>

            <div class="mb-2"><span class="section-title">Estadísticas Generales</span></div>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <div class="col">
                    <a href="admin_usuarios.php" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-num">24</div>
                        <div class="stat-label">Personal</div>
                    </a>
                </div>
                <div class="col">
                    <a href="admin_productos.php" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                        <div class="stat-num">138</div>
                        <div class="stat-label">Productos</div>
                    </a>
                </div>
                <div class="col">
                    <a href="admin_reportes_pedidos.php" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div class="stat-num">57</div>
                        <div class="stat-label">Pedidos</div>
                    </a>
                </div>
                <div class="col">
                    <a href="admin_reportes_ventas.php" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="stat-num">$412k</div>
                        <div class="stat-label">Ventas del mes</div>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>