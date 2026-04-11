<div class="topbar">
    <div class="container-fluid d-flex justify-content-between px-3">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
        </div>
        <div><span><i class="fas fa-user-shield me-1"></i> Panel Administrador</span></div>
    </div>
</div>

<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="/proyectoweb/admin/inicio" class="brand-logo me-3">
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
        <a href="/proyectoweb/admin/inicio"    class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
        <a href="/proyectoweb/admin/personal"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
        <a href="/proyectoweb/admin/productos" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <a href="/proyectoweb/admin/clientes"  class="nav-link"><i class="fas fa-user-friends"></i> Clientes</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Reportes</p>
        <a href="/proyectoweb/admin/ventas"  class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
        <a href="/proyectoweb/admin/compras" class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
        <a href="/proyectoweb/admin/pedidos" class="nav-link active"><i class="fas fa-truck"></i> Pedidos</a>
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
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/admin/inicio" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/admin/reportes-pedidos" class="text-decoration-none" style="color:var(--btn-color)">Reportes</a>
                </li>
                <li class="breadcrumb-item active text-muted">Pedidos</li>
            </ol>
        </nav>

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Reporte de Pedidos</h1>
            <p class="page-header-sub">Genera un reporte PDF filtrado del estado de los pedidos.</p>
        </div>

        <div class="report-form-card">
            <h5 class="text-center"><i class="fas fa-truck me-2" style="color:var(--btn-color)"></i>Generar Reporte de Pedidos</h5>
            <form action="/proyectoweb/admin/reportes-pedidos" method="POST">
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
                        <label class="form-label">Cliente:</label>
                        <select name="cliente" class="form-select">
                            <option value="">Todos</option>
                            <option>Ana Torres</option>
                            <option>Luis Ramírez</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado del Pedido:</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option>Pendiente</option>
                            <option>En camino</option>
                            <option>Entregado</option>
                            <option>Cancelado</option>
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
                        <label class="form-label">Método de Pago:</label>
                        <select name="metodo_pago" class="form-select">
                            <option value="">Todos</option>
                            <option>Efectivo</option>
                            <option>Tarjeta</option>
                            <option>Transferencia</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Monto mínimo:</label>
                        <input type="number" name="monto_min" class="form-control" placeholder="$0.00" min="0" step="0.01">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Monto máximo:</label>
                        <input type="number" name="monto_max" class="form-control" placeholder="$0.00" min="0" step="0.01">
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
<?php include('vista/admin/footer_admin.php'); ?>