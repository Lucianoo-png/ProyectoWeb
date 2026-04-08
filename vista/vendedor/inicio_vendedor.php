<?php include('vista/vendedor/header_vendedor.php'); ?>

<!-- Layout -->
<div class="admin-layout">

<?php include('vista/vendedor/menu_vendedor.php'); ?>

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
            <a href="/proyectoweb/vendedor/ventas" class="stat-card">
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
            <a href="/proyectoweb/vendedor/inventario" class="stat-card">
                <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                <div class="stat-num">202</div>
                <div class="stat-label">Unidades vendidas</div>
            </a>
            <div class="stat-card stat-card--info">
                <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                <div class="stat-num">0</div>
                <div class="stat-label">Vendidas hoy</div>
            </div>
            <a href="/proyectoweb/vendedor/solicitudes" class="stat-card">
                <div class="stat-icon stat-icon--danger"><i class="fas fa-headset"></i></div>
                <div class="stat-num stat-num--danger">4</div>
                <div class="stat-label">Solicitudes pendientes</div>
            </a>
        </div>

    </main>
</div>


<?php include('vista/vendedor/footer_vendedor.php'); ?>