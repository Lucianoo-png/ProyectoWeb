<?php include('vista/admin/header_admin.php'); ?>

<div class="admin-layout">
    <?php include('vista/admin/menu_admin.php'); ?>

    <main class="admin-content">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/admin/inicio" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Historial del Sistema</li>
            </ol>
        </nav>

        <!-- Encabezado -->
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Historial del Sistema (Logs)</h1>
            <p class="page-header-sub">Consulta y filtra la actividad registrada por usuarios y módulos del sistema.</p>
        </div>

        <!-- Resumen rápido -->
        <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
                    <div class="stat-num">1,284</div>
                    <div class="stat-label">Total eventos</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#16a34a"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-num">1,201</div>
                    <div class="stat-label">Exitosos</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#dc2626"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-num">37</div>
                    <div class="stat-label">Errores</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#d97706"><i class="fas fa-exclamation-triangle"></i></div>
                    <div class="stat-num">46</div>
                    <div class="stat-label">Advertencias</div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="report-form-card mb-4">
            <h5 class="text-center">
                <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Registros
            </h5>
            <form method="GET" action="/proyectoweb/">
                <input type="hidden" name="url" value="admin/logs">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Desde:</label>
                        <input type="date" name="desde" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hasta:</label>
                        <input type="date" name="hasta" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Usuario:</label>
                        <select name="usuario" class="form-select">
                            <option value="">Todos</option>
                            <option>ADMIN01</option>
                            <option>Juan Pérez</option>
                            <option>María García</option>
                            <option>Carlos Mendoza</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Módulo:</label>
                        <select name="modulo" class="form-select">
                            <option value="">Todos</option>
                            <option>Productos</option>
                            <option>Ventas</option>
                            <option>Compras</option>
                            <option>Pedidos</option>
                            <option>Personal</option>
                            <option>Proveedores</option>
                            <option>Sesión</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Tipo de evento:</label>
                        <select name="tipo" class="form-select">
                            <option value="">Todos</option>
                            <option>Creación</option>
                            <option>Edición</option>
                            <option>Eliminación</option>
                            <option>Consulta</option>
                            <option>Inicio sesión</option>
                            <option>Cierre sesión</option>
                            <option>Error</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option>Exitoso</option>
                            <option>Error</option>
                            <option>Advertencia</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Buscar palabra clave:</label>
                        <input type="text" name="q" class="form-control" placeholder="Ej: producto eliminado, login fallido...">
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <a href="/proyectoweb/?url=admin/logs" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i> Limpiar
                        </a>
                        <button type="submit" class="btn-generar-pdf">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de logs -->
        <div class="report-form-card">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="mb-0 text-center w-100">
                    <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Eventos Registrados
                </h5>
                <div class="w-100 d-flex justify-content-end">
                    <button class="btn-generar-pdf" style="font-size:.78rem; padding:.45rem 1rem">
                        <i class="fas fa-file-pdf me-1"></i> Exportar PDF
                    </button>
                </div>
            </div>

            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Fecha y Hora</th>
                            <th>Usuario</th>
                            <th>Módulo</th>
                            <th>Acción</th>
                            <th>Detalle</th>
                            <th>IP</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1284</td>
                            <td>08/04/2026 11:42:05</td>
                            <td><strong>ADMIN01</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem">Productos</span></td>
                            <td>Edición</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Modificó precio de Refrigerador 14 pies Frost</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.10</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1283</td>
                            <td>08/04/2026 10:15:33</td>
                            <td><strong>Juan Pérez</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#f0fdf4; color:#15803d; font-size:.72rem">Ventas</span></td>
                            <td>Creación</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Registró venta #VT-2026-4921</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.14</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1282</td>
                            <td>08/04/2026 09:58:11</td>
                            <td><strong>María García</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem">Sesión</span></td>
                            <td>Inicio sesión</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Inicio de sesión correcto</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.22</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1281</td>
                            <td>08/04/2026 09:31:47</td>
                            <td><strong>Carlos Mendoza</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fef9c3; color:#92400e; font-size:.72rem">Pedidos</span></td>
                            <td>Edición</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Cambió estado de pedido #PD-2026-571 a "Entregado"</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.18</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1280</td>
                            <td>07/04/2026 18:02:09</td>
                            <td><strong>ADMIN01</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem">Productos</span></td>
                            <td>Eliminación</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Eliminó producto SKU: MB-EST-002 (descontinuado)</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.10</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1279</td>
                            <td>07/04/2026 17:45:00</td>
                            <td><strong>Juan Pérez</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem">Sesión</span></td>
                            <td>Inicio sesión</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Contraseña incorrecta — intento fallido</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.14</td>
                            <td><span class="badge-pendiente">Error</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1278</td>
                            <td>07/04/2026 14:20:38</td>
                            <td><strong>ADMIN01</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#f5f3ff; color:#6d28d9; font-size:.72rem">Personal</span></td>
                            <td>Creación</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Registró nuevo usuario: María Torres (Vendedor)</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.10</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">1277</td>
                            <td>07/04/2026 11:05:14</td>
                            <td><strong>María García</strong></td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fef9c3; color:#92400e; font-size:.72rem">Compras</span></td>
                            <td>Consulta</td>
                            <td style="max-width:200px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap">Generó reporte PDF de compras (marzo 2026)</td>
                            <td style="font-family:monospace; font-size:.78rem">192.168.1.22</td>
                            <td><span class="badge-confirmada">Exitoso</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <small class="text-muted">Mostrando 1–8 de 1,284 registros</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">‹ Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background:var(--btn-color); border-color:var(--btn-color)">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">…</a></li>
                        <li class="page-item"><a class="page-link" href="#">161</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente ›</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </main>
</div>

<?php include('vista/admin/footer_admin.php'); ?>