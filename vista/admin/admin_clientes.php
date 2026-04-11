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
                <li class="breadcrumb-item active text-muted">Clientes</li>
            </ol>
        </nav>

        <!-- Encabezado -->
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Clientes Registrados</h1>
            <p class="page-header-sub">Consulta los clientes registrados en línea o desde tienda física.</p>
        </div>

        <!-- Resumen rápido -->
        <div class="row row-cols-2 row-cols-md-4 g-3 mb-4">
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-num">342</div>
                    <div class="stat-label">Total clientes</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#1d4ed8"><i class="fas fa-globe"></i></div>
                    <div class="stat-num">218</div>
                    <div class="stat-label">En línea</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#92400e"><i class="fas fa-store"></i></div>
                    <div class="stat-num">124</div>
                    <div class="stat-label">Tienda física</div>
                </div>
            </div>
            <div class="col">
                <div class="stat-card" style="cursor:default">
                    <div class="stat-icon" style="color:#16a34a"><i class="fas fa-user-check"></i></div>
                    <div class="stat-num">309</div>
                    <div class="stat-label">Activos</div>
                </div>
            </div>
        </div>

        <!-- Filtros -->
        <div class="report-form-card mb-4">
            <h5 class="text-center">
                <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Clientes
            </h5>
            <form method="GET" action="/proyectoweb/">
                <input type="hidden" name="url" value="admin/clientes">
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
                        <label class="form-label">Origen:</label>
                        <select name="origen" class="form-select">
                            <option value="">Todos</option>
                            <option>En línea</option>
                            <option>Tienda física</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select name="estado" class="form-select">
                            <option value="">Todos</option>
                            <option>Activo</option>
                            <option>Inactivo</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Buscar cliente:</label>
                        <input type="text" name="q" class="form-control" placeholder="Nombre, correo o teléfono...">
                    </div>
                    <div class="col-12 d-flex justify-content-end gap-2 mt-2">
                        <a href="/proyectoweb/?url=admin/clientes" class="btn btn-outline-secondary">
                            <i class="fas fa-undo me-1"></i> Limpiar
                        </a>
                        <button type="submit" class="btn-generar-pdf">
                            <i class="fas fa-search me-1"></i> Filtrar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabla de clientes -->
        <div class="report-form-card">
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <h5 class="mb-0 text-center w-100">
                    <i class="fas fa-address-book me-2" style="color:var(--btn-color)"></i>Listado de Clientes
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
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th>Teléfono</th>
                            <th>Origen</th>
                            <th>Fecha de Registro</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="color:#999; font-size:.8rem">342</td>
                            <td><strong>Lucía Fernández Mora</strong></td>
                            <td>lucia.fernandez@gmail.com</td>
                            <td>229-145-8832</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem"><i class="fas fa-globe me-1"></i>En línea</span></td>
                            <td>10/04/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">341</td>
                            <td><strong>Roberto Salinas Cruz</strong></td>
                            <td>r.salinas@hotmail.com</td>
                            <td>229-302-7741</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem"><i class="fas fa-store me-1"></i>Tienda física</span></td>
                            <td>09/04/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">340</td>
                            <td><strong>Diana Ruiz Herrera</strong></td>
                            <td>diana.ruiz@yahoo.com</td>
                            <td>229-874-5510</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem"><i class="fas fa-globe me-1"></i>En línea</span></td>
                            <td>07/04/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">339</td>
                            <td><strong>Marco Antonio Vega</strong></td>
                            <td>m.vega.mx@gmail.com</td>
                            <td>229-561-0093</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem"><i class="fas fa-store me-1"></i>Tienda física</span></td>
                            <td>05/04/2026</td>
                            <td><span class="badge-pendiente">Inactivo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">338</td>
                            <td><strong>Sofía Castro Pérez</strong></td>
                            <td>sofia.castro@outlook.com</td>
                            <td>229-213-6670</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem"><i class="fas fa-globe me-1"></i>En línea</span></td>
                            <td>03/04/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">337</td>
                            <td><strong>Héctor Jiménez Lara</strong></td>
                            <td>hector.jl@gmail.com</td>
                            <td>229-988-4421</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem"><i class="fas fa-store me-1"></i>Tienda física</span></td>
                            <td>01/04/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">336</td>
                            <td><strong>Valeria Morales Torres</strong></td>
                            <td>valeria.morales@gmail.com</td>
                            <td>229-647-2298</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#eff6ff; color:#1d4ed8; font-size:.72rem"><i class="fas fa-globe me-1"></i>En línea</span></td>
                            <td>29/03/2026</td>
                            <td><span class="badge-confirmada">Activo</span></td>
                        </tr>
                        <tr>
                            <td style="color:#999; font-size:.8rem">335</td>
                            <td><strong>Eduardo Campos Reyes</strong></td>
                            <td>e.campos@live.com</td>
                            <td>229-430-8815</td>
                            <td><span class="badge rounded-pill px-2 py-1" style="background:#fff7ed; color:#c2410c; font-size:.72rem"><i class="fas fa-store me-1"></i>Tienda física</span></td>
                            <td>27/03/2026</td>
                            <td><span class="badge-pendiente">Inactivo</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap gap-2">
                <small class="text-muted">Mostrando 1–8 de 342 registros</small>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled"><a class="page-link" href="#">‹ Anterior</a></li>
                        <li class="page-item active"><a class="page-link" href="#" style="background:var(--btn-color); border-color:var(--btn-color)">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">…</a></li>
                        <li class="page-item"><a class="page-link" href="#">43</a></li>
                        <li class="page-item"><a class="page-link" href="#">Siguiente ›</a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </main>
</div>

<?php include('vista/admin/footer_admin.php'); ?>