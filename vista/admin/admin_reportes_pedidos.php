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
    <?php include('vista/admin/menu_admin.php'); ?>


    <main class="admin-content">
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Reporte de Pedidos</h1>
            <p class="page-header-sub">Genera un reporte PDF filtrado del estado de los pedidos realizados en línea.</p>
        </div>

        <div class="report-form-card">
            <h5 class="text-center"><i class="fas fa-truck me-2" style="color:var(--btn-color)"></i>Generar Reporte de Pedidos</h5>
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
                        <label class="form-label">Cliente:</label>
                        <select name="cliente" class="form-select">
                            <option value="">Todos</option>
                            <?php
                                foreach($clientes as $clien){
                                    ?>
                                    <option value="<?php echo $clien['no_cliente'] ?>"><?php echo $clien['nombre']." ".$clien['apellidospama'];?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Repartidor:</label>
                        <select name="repartidor" class="form-select">
                            <option value="">Todos</option>
                            <?php
                                foreach($repartidores as $prov){
                                    ?>
                                    <option value="<?php echo $prov['rfc']; ?>"><?php echo $prov['nombre']." ".$prov['apellidospama']; ?></option>
                                    <?php
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado del Pedido:</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option value="P">Preparación</option>
                            <option value="R">Salió a ruta</option>
                            <option value="E">Entregado</option>
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
                        <input type="hidden" name="exportar_pdf_pedidos" value="1">
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