<div class="topbar">
    <div class="container-fluid d-flex justify-content-between px-3">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
        </div>
    </div>
</div>

<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="/proyectoweb/admin/inicio" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
    </div>
</div>

<div class="admin-layout">
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Admin</p>
        <a href="/proyectoweb/admin/inicio"    class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
        <a href="/proyectoweb/admin/personal"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
        <a href="/proyectoweb/admin/productos" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <a href="/proyectoweb/admin/clientes"  class="nav-link"><i class="fas fa-user-friends"></i> Clientes</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Reportes</p>
        <a href="/proyectoweb/admin/ventas"   class="nav-link active"><i class="fas fa-chart-bar"></i> Ventas</a>
        <a href="/proyectoweb/admin/compras"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
        <a href="/proyectoweb/admin/pedidos"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
        <a href="/proyectoweb/admin/asignar-pedidos" class="nav-link"><i class="fas fa-user-plus"></i> Asignar Pedidos</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Proveedores</p>
        <a href="/proyectoweb/admin/pedido-proveedor" class="nav-link"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Sistema</p>
        <a href="/proyectoweb/admin/logs" class="nav-link"><i class="fas fa-history"></i> Historial (Logs)</a>
        <hr class="sidebar-divider">
        <a href="/proyectoweb/?" class="btn-cerrar" style="margin-top:.5rem">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Reporte de Ventas</h1>
            <p class="page-header-sub">Genera un reporte PDF filtrado de las ventas registradas en tienda física.</p>
        </div>

        <div class="report-form-card">
            <h5 class="text-center"><i class="fas fa-chart-bar me-2" style="color:var(--btn-color)"></i>Generar Reporte de Ventas</h5>
            <form action="/proyectoweb/admin/reportes" target="_blank" method="POST">
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
                            <?php
                                foreach($vendedores as $vend){
                                    ?>
                                    <option value="<?php echo $vend['rfc']; ?>"><?php echo $vend['nombre']." ".$vend['apellidospama']; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Método de Pago:</label>
                        <select name="metodo_pago" class="form-select">
                            <option value="">Todos</option>
                            <option>Efectivo</option>
                            <option>Tarjeta</option>
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
                        <input type="hidden" name="exportar_pdf" value="1">
                        <button type="submit" class="btn-generar-pdf">
                            <i class="fas fa-file-pdf"></i> Generar PDF
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include('vista/admin/footer_admin.php'); ?>