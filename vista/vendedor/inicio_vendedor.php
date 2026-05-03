<?php include('vista/vendedor/header_vendedor.php'); ?>

<!-- Layout -->
<div class="admin-layout">

<?php include('vista/vendedor/menu_vendedor.php'); ?>

    <!-- Contenido -->
    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Panel de Vendedor</h1>
            <p class="page-header-sub">Bienvenido de vuelta. Aquí tienes un resumen de tu actividad.</p>
        </div>

        <!-- Tarjeta de empleado -->
        <div class="info-card-vend">
            <div class="info-avatar"><i class="fas fa-user-tie"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value">LuchanosCorp</span></p>
                <p><span class="label">Empleado</span><br>
                   <span class="value"><?php echo $info[0]['nombre']." ".$info[0]['apellidospama']; ?></span></p>
                <p><span class="label">Usuario</span><br>
                   <span class="value"><?php echo $info[0]['correo']; ?> — Vendedor</span></p>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="mb-2"><span class="section-title">Estadísticas Generales</span></div>
        <div class="stat-cards mb-4">
            <a href="/proyectoweb/vendedor/ventas" class="stat-card">
                <div class="stat-icon"><i class="fas fa-handshake"></i></div>
                <div class="stat-num"><?php echo $totalVentas; ?></div>
                <div class="stat-label">Ventas realizadas</div>
            </a>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-coins"></i></div>
                <div class="stat-num">$<?php echo number_format($gananciasTotal, 2); ?></div>
                <div class="stat-label">Ganancias acumuladas</div>
            </div>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-cash-register"></i></div>
                <div class="stat-num">$<?php echo number_format($gananciasHoy, 2); ?></div>
                <div class="stat-label">Ventas del día</div>
            </div>
            <a href="/proyectoweb/vendedor/inventario" class="stat-card">
                <div class="stat-icon"><i class="fas fa-cubes"></i></div>
                <div class="stat-num"><?php echo $totalUnidades; ?></div>
                <div class="stat-label">Unidades vendidas</div>
            </a>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-tag"></i></div>
                <div class="stat-num"><?php echo $unidadesHoy; ?></div>
                <div class="stat-label">Vendidas hoy</div>
            </div>
        </div>

    </main>
</div>


<?php include('vista/vendedor/footer_vendedor.php'); ?>