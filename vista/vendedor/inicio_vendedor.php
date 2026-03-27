<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Panel Vendedor</title>
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
      <!--  <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="Buscar productos, clientes…">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <span class="d-none d-md-inline nav-user">
            <i class="fas fa-user-circle me-1"></i> Miguel Gutiérrez Cruz
        </span>-->
    </div>
</div>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Vendedor</p>
        <a href="inicio_vendedor.php" class="nav-link active">
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

        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
            <div>
                <h1 class="page-header-title mb-0">Panel de Vendedor</h1>
                <p class="page-header-sub">Bienvenido de vuelta. Aquí tienes un resumen de tu actividad.</p>
            </div>
        </div>

        <!-- Tarjeta de empleado -->
        <div class="info-card-vend">
            <div class="info-avatar"><i class="fas fa-user-tie"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value">LuchanosCorp — Sucursal Veracruz</span></p>
                <p><span class="label">Empleado</span><br>
                   <span class="value">Miguel Gutiérrez Cruz</span></p>
                <p><span class="label">Usuario</span><br>
                   <span class="value">MIGGUICRU — Vendedor</span></p>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="mb-2"><span class="section-title">Estadísticas Generales</span></div>
        <div class="stat-cards mb-4">
            <a href="ventas.php" class="stat-card">
                <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                <div class="stat-num">35</div>
                <div class="stat-label">Ventas realizadas</div>
            </a>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                <div class="stat-num">$99,880</div>
                <div class="stat-label">Ganancias acumuladas</div>
            </div>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-dollar-sign"></i></div>
                <div class="stat-num">$0</div>
                <div class="stat-label">Ventas del día</div>
            </div>
            <a href="inventario.php" class="stat-card">
                <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                <div class="stat-num">202</div>
                <div class="stat-label">Unidades vendidas</div>
            </a>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-num">0</div>
                <div class="stat-label">Vendidas hoy</div>
            </div>
            <a href="solicitudes.php" class="stat-card">
                <div class="stat-icon stat-icon--danger"><i class="fas fa-headset"></i></div>
                <div class="stat-num stat-num--danger">4</div>
                <div class="stat-label">Solicitudes pendientes</div>
            </a>
        </div>

    </main>
</div>


<footer class="site-footer-minimal">© <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
</body>
</html>