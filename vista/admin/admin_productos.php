<div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon danger"><i class="fas fa-exclamation"></i></div>
            <h5>Eliminar Producto</h5>
            <p id="confirmMsg">¿Estás seguro de que deseas eliminar este producto?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYes">
                    <i class="fas fa-trash me-1"></i> Sí, eliminar
                </button>
                <button class="btn-confirm-no" onclick="closeConfirm()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </div>
    </div>

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
            <a href="/proyectoweb/admin/inicio"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="/proyectoweb/admin/personal"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
            <a href="/proyectoweb/admin/productos" class="nav-link active"><i class="fas fa-box"></i> Productos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="/proyectoweb/admin/ventas"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="/proyectoweb/admin/compras"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="/proyectoweb/admin/pedidos"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
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
                    <li class="breadcrumb-item active text-muted">Productos</li>
                </ol>
            </nav>

            <div class="mb-4 text-center">
                <h1 class="page-header-title mb-0">Gestión de Productos</h1>
                <p class="page-header-sub">Registra, consulta y controla el inventario de productos.</p>
            </div>

            <!-- Tabs -->
            <div class="admin-tabs">
                <button class="admin-tab-btn active"
                        data-tab-group="productos" data-target="tab-registro-prod">
                    <i class="fas fa-plus-circle me-1"></i> Registro
                </button>
                <button class="admin-tab-btn"
                        data-tab-group="productos" data-target="tab-consulta-prod">
                    <i class="fas fa-search me-1"></i> Consulta / Inventario
                </button>
            </div>

            <!-- ── PANEL REGISTRO ── -->
            <div class="admin-tab-panel active" id="tab-registro-prod" data-tab-group="productos">
                <div class="admin-form-card">
                    <div class="admin-form-header">
                        <i class="fas fa-box-open"></i> Formulario de Registro de Producto
                    </div>
                    <div class="admin-form-body">
                    <form action="admin_productos.php" method="POST" enctype="multipart/form-data"
                          novalidate class="needs-validation">

                        <div class="form-section-label"><i class="fas fa-tag"></i> Datos del Producto</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="clave" class="form-label">Clave Producto (SKU) <span class="text-danger">*</span></label>
                                <input type="text" id="clave" name="clave" class="form-control" placeholder="Ej. WM3911D" required>
                                <div class="invalid-feedback">Ingresa la clave.</div>
                            </div>
                            <div class="col-md-8">
                                <label for="nombre_producto" class="form-label">Nombre del Producto <span class="text-danger">*</span></label>
                                <input type="text" id="nombre_producto" name="nombre_producto" class="form-control" placeholder="Nombre completo" required>
                                <div class="invalid-feedback">Ingresa el nombre.</div>
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                                <textarea id="descripcion" name="descripcion" class="form-control" placeholder="Descripción detallada del producto..." required></textarea>
                                <div class="invalid-feedback">Ingresa una descripción.</div>
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-ruler-combined"></i> Dimensiones Físicas y Estado</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="alto" class="form-label">Alto (cm) <span class="text-danger">*</span></label>
                                <input type="number" id="alto" name="alto" class="form-control" placeholder="0.0" step="0.1" min="0" required>
                                <div class="invalid-feedback">Ingresa el alto.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="ancho" class="form-label">Ancho (cm) <span class="text-danger">*</span></label>
                                <input type="number" id="ancho" name="ancho" class="form-control" placeholder="0.0" step="0.1" min="0" required>
                                <div class="invalid-feedback">Ingresa el ancho.</div>
                            </div>
                            <div class="col-md-3">
                                <label for="color" class="form-label">Color</label>
                                <input type="text" id="color" name="color" class="form-control" placeholder="Ej. Blanco, Negro">
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-photo-video"></i> Clasificación y Multimedia</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                                <select id="categoria" name="categoria" class="form-select" required>
                                    <option value="" disabled selected>Selecciona una categoría</option>
                                    <option value="blanca">Línea Blanca</option>
                                    <option value="marron">Línea Marrón</option>
                                    <option value="cocina">Cocina</option>
                                    <option value="lavado">Lavado</option>
                                    <option value="refrigeracion">Refrigeración</option>
                                    <option value="bienestar">Bienestar</option>
                                </select>
                                <div class="invalid-feedback">Selecciona una categoría.</div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Manual Técnico (PDF)</label>
                                <div class="upload-box" onclick="document.getElementById('manual').click()">
                                    <i class="fas fa-file-pdf"></i>
                                    <span id="manual-label">Haz clic para subir un manual</span>
                                    <span class="upload-hint">PDF — máx. 10 MB</span>
                                </div>
                                <input type="file" id="manual" name="manual" accept=".pdf" style="display:none"
                                       onchange="document.getElementById('manual-label').textContent = this.files[0]?.name || 'Haz clic para subir un manual'">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Imagen del Producto <span class="text-danger">*</span></label>
                                <div class="upload-box" onclick="document.getElementById('imagen').click()">
                                    <i class="fas fa-image"></i>
                                    <span id="imagen-label">Haz clic para subir una imagen</span>
                                    <span class="upload-hint">JPG, PNG, WEBP — máx. 5 MB</span>
                                </div>
                                <input type="file" id="imagen" name="imagen" accept="image/*" style="display:none"
                                       onchange="previewImagen(this)">
                                <img id="img-preview" class="img-preview" src="" alt="">
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-dollar-sign"></i> Precios e Inventario</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="precio_compra" class="form-label">Precio de Compra ($)</label>
                                <input type="number" id="precio_compra" name="precio_compra" class="form-control" placeholder="0.00" step="0.01" min="0">
                            </div>
                            <div class="col-md-4">
                                <label for="precio_venta" class="form-label">Precio de Venta ($) <span class="text-danger">*</span></label>
                                <input type="number" id="precio_venta" name="precio_venta" class="form-control" placeholder="0.00" step="0.01" min="0" required>
                                <div class="invalid-feedback">Ingresa el precio de venta.</div>
                            </div>
                            <div class="col-md-4">
                                <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                                <input type="number" id="stock_minimo" name="stock_minimo" class="form-control" placeholder="0" min="0">
                            </div>
                        </div>

                        <hr class="admin-form-divider">
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="/proyectoweb/admin/productos" class="btn-admin-secondary"><i class="fas fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn-admin-primary"><i class="fas fa-save"></i> Guardar Producto</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /tab registro -->

            <!-- ── PANEL CONSULTA / INVENTARIO ── -->
            <div class="admin-tab-panel" id="tab-consulta-prod" data-tab-group="productos">
                <div class="admin-form-card" style="max-width:100%">

                    <div class="admin-form-body pb-0">
                        <div class="admin-search-bar">
                            <input type="text" class="form-control" placeholder="SKU o nombre del producto..." style="max-width:280px">
                            <select class="form-select" style="max-width:200px">
                                <option value="">Todas las categorías</option>
                                <option value="blanca">Línea Blanca</option>
                                <option value="marron">Línea Marrón</option>
                                <option value="cocina">Cocina</option>
                                <option value="lavado">Lavado</option>
                                <option value="refrigeracion">Refrigeración</option>
                                <option value="bienestar">Bienestar</option>
                            </select>
                            <select class="form-select" style="max-width:160px">
                                <option value="">Todos los estados</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                            <button class="btn-buscar"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                        <div class="table-page-info">Número de productos por página: 5 &nbsp;|&nbsp; Página: 1 de 8</div>
                    </div>

                    <div class="admin-form-body pt-0">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>SKU</th>
                                    <th>Nombre del Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>P. Compra</th>
                                    <th>P. Venta</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $productos = [
                                    ['WM3911D',   'Microondas con AirFry 4 en 1 (1CuFt)',               'Cocina',        73, 3200, 4599, true],
                                    ['8MWTW2024WJM','Lavadora 20kg Carga Superior Xpert System',       'Línea Blanca',  45, 6500, 9999, true],
                                    ['WK0260B',   'Despachador de agua con fábrica de hielo',           'Línea Blanca',  12, 5100, 7999, true],
                                    ['WRS315SNHM','Refrigerador Side by Side 25 pies',                 'Refrigeración', 8,  14500,22499,true],
                                    ['MGH765RDS', 'Estufa 6 quemadores con horno convección',          'Cocina',        20, 6200, 9799, false],
                                ];
                                foreach ($productos as $i => $p): ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><code style="font-size:.75rem; color:var(--azul-marino)"><?= $p[0] ?></code></td>
                                    <td class="td-name" style="text-align:left; max-width:260px">
                                        <?= htmlspecialchars($p[1]) ?>
                                    </td>
                                    <td><?= $p[2] ?></td>
                                    <td><?= $p[3] ?></td>
                                    <td>$<?= number_format($p[4],2) ?></td>
                                    <td>$<?= number_format($p[5],2) ?></td>
                                    <td>
                                        <?php if ($p[6]): ?>
                                            <span class="badge-activo">Activo</span>
                                        <?php else: ?>
                                            <span class="badge-inactivo">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn-tbl-edit" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-tbl-delete"
                                                onclick="confirmDelete('producto','<?= htmlspecialchars($p[1]) ?>','<?= $p[0] ?>')"
                                                title="Eliminar">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="admin-pagination mt-3">
                        <span class="page-info">Página:</span>
                        <?php for ($pg = 1; $pg <= 8; $pg++): ?>
                        <button class="pg-btn <?= $pg === 1 ? 'active' : '' ?>"><?= $pg ?></button>
                        <?php endfor; ?>
                    </div>
                    </div>
                </div>
            </div><!--/tab consulta -->

        </main>
    </div>

  <?php include('vista/admin/footer_admin.php'); ?>