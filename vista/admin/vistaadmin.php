<?php include('vista/admin/header_admin.php'); ?>

    <div class="admin-layout">
        <?php include('vista/admin/menu_admin.php'); ?>

        <main class="admin-content">
            <div class="d-flex justify-content-between align-items-start mb-4">
                <div class="w-100 text-center">
                    <h1 class="page-header-title mb-0">Panel de Administración</h1>
                    <p class="page-header-sub">Bienvenido de vuelta. Aquí tienes un resumen del sistema.</p>
                </div>
                <span class="badge text-white px-3 py-2 rounded-pill ms-3" style="background:var(--btn-color); font-size:.78rem; white-space:nowrap">
                    <i class="fas fa-circle me-1" style="font-size:.5rem; vertical-align:middle"></i> Sistema activo
                </span>
            </div>

            <div class="admin-info-card">
                <div class="info-avatar"><i class="fas fa-user-shield"></i></div>
                <div class="info-rows">
                    <p><span class="label">Nombre</span><br><span class="value"><?php $nombre = $emp->getEmpleado()->buscar('"Veracruz".empleado',["select"=>"CONCAT(nombre,' ', apellidospama) as nombre","where"=>"rfc='".$_SESSION["RFC"]."'"])[0]['nombre']; echo $nombre; ?></span></p>
                    <p><span class="label">RFC</span><br><span class="value"><?php echo $_SESSION["RFC"]; ?></span></p>
                </div>
            </div>

            <div class="mb-2 text-center"><span class="section-title">Estadísticas Generales</span></div>
            <div class="row row-cols-2 row-cols-md-4 g-3">
                <div class="col">
                    <a href="/proyectoweb/admin/personal" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-users"></i></div>
                        <div class="stat-num">24</div>
                        <div class="stat-label">Personal</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/proyectoweb/admin/productos" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-box-open"></i></div>
                        <div class="stat-num">138</div>
                        <div class="stat-label">Productos</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/proyectoweb/admin/pedidos" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div class="stat-num">57</div>
                        <div class="stat-label">Pedidos</div>
                    </a>
                </div>
                <div class="col">
                    <a href="/proyectoweb/admin/ventas" class="stat-card">
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="stat-num">$412k</div>
                        <div class="stat-label">Ventas del mes</div>
                    </a>
                </div>
            </div>
        </main>
    </div>

    <?php include('vista/admin/footer_admin.php'); ?>