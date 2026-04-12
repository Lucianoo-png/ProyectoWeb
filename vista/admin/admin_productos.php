<?php
$postAction = '';
if (isset($_POST['guardar'])) {
    $postAction = 'tab-registro-prod';
} elseif (isset($_POST['actualizar']) || isset($_POST['eliminar']) || isset($_POST['activar'])) {
    $postAction = 'tab-consulta-prod';
}
?>

<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-box">
        <div class="confirm-icon danger"><i class="fas fa-exclamation-triangle"></i></div>
        <h5>Eliminar Producto</h5>
        <p id="confirmMsg">¿Estás seguro de que deseas eliminar este producto?</p>
        
        <form action="/proyectoweb/admin/productos" method="POST" style="margin: 0;">
            <input type="hidden" id="delete_no_producto" name="no_producto">
            
            <div class="confirm-actions mt-3">
                <button type="submit" name="eliminar" class="btn-confirm-yes" id="confirmYes">
                    <i class="fas fa-trash me-1"></i> Sí, eliminar
                </button>
                <button type="button" class="btn-confirm-no" onclick="cerrarModalEliminar()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="confirm-overlay" id="activateOverlay">
    <div class="confirm-box">
        <div class="confirm-icon" style="color: #28a745; background-color: #e8f5e9;"><i class="fas fa-check-circle"></i></div>
        <h5>Activar Producto</h5>
        <p id="activateMsg">¿Estás seguro de que deseas reactivar este producto?</p>
        
        <form action="/proyectoweb/admin/productos" method="POST" style="margin: 0;">
            <input type="hidden" id="activate_no_producto" name="no_producto">
            
            <div class="confirm-actions mt-3">
                <button type="submit" name="activar" class="btn-confirm-yes" id="activateYes" style="background-color: #28a745;">
                    <i class="fas fa-check me-1"></i> Sí, activar
                </button>
                <button type="button" class="btn-confirm-no" onclick="cerrarModalActivar()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="confirm-overlay" id="editModal" style="display: none; z-index: 1050;">
    <div class="admin-form-card" style="max-width: 800px; width: 90%; margin: 2rem auto; position: relative; max-height: 90vh; overflow-y: auto;">
        
        <div class="admin-form-header d-flex justify-content-between align-items-center" style="padding: 15px 20px;">
            <div>
                <i class="fas fa-box-open me-2"></i> Edición de Producto
            </div>
            <button type="button" onclick="cerrarModalEdicion()" style="background: none; border: none; font-size: 1.5rem; color: #fff; cursor: pointer; padding: 0; line-height: 1;">
                &times;
            </button>
        </div>
        <div class="admin-form-body">
            <form action="/proyectoweb/admin/productos" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="edit_no_producto" name="no_producto">

                <div class="form-section-label"><i class="fas fa-tag"></i> Datos del Producto</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-8">
                        <label for="edit_nombre" class="form-label">Nombre del Producto <span class="text-danger">*</span></label>
                        <input type="text" id="edit_nombre" name="nombre" class="form-control" placeholder="Ej. Refrigerador Samsung 22ft" >
                    </div>
                    <div class="col-md-4">
                        <label for="edit_categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                        <select id="edit_categoria" name="categoria" class="form-select" >
                            <option value="" disabled>Selecciona una</option>
                            <option value="lavadoras">Lavadoras</option>
                            <option value="secadoras">Secadoras</option>
                            <option value="refrigeradores">Refrigeradores</option>
                            <option value="congeladores">Congeladores</option>
                            <option value="televisores">Televisores</option>
                            <option value="audio">Audio</option>
                            <option value="proyectores">Proyectores</option>
                            <option value="videojuegos">Videojuegos</option>
                            <option value="estufas">Estufas</option>
                            <option value="hornos">Hornos</option>
                            <option value="microondas">Microondas</option>
                            <option value="lavavajillas">Lavavajillas</option>
                            <option value="lavasecadoras">Lavasecadoras</option>
                            <option value="frigobar">Cava de vinos</option>
                            <option value="cuidado-hogar">Cuidado del hogar</option>
                            <option value="cuidado-personal">Cuidado personal</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="edit_descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                        <textarea id="edit_descripcion" name="descripcion" class="form-control" rows="3" ></textarea>
                    </div>
                </div>

                <div class="form-section-label"><i class="fas fa-dollar-sign"></i> Precios y Stock</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label for="edit_precio_compra" class="form-label">P. Compra <span class="text-danger">*</span></label>
                        <input type="number" id="edit_precio_compra" name="precio_compra" class="form-control" step="0.01" min="1" >
                    </div>
                    <div class="col-md-3">
                        <label for="edit_precio_venta" class="form-label">P. Venta <span class="text-danger">*</span></label>
                        <input type="number" id="edit_precio_venta" name="precio_venta" class="form-control" step="0.01" min="1" >
                    </div>
                    <div class="col-md-3">
                        <label for="edit_stock" class="form-label">Stock Actual</label>
                        <input type="number" id="edit_stock" name="stock" class="form-control" min="0">
                    </div>
                    <div class="col-md-3">
                        <label for="edit_stock_minimo" class="form-label">Stock Mínimo</label>
                        <input type="number" id="edit_stock_minimo" name="stock_minimo" class="form-control" min="1">
                    </div>
                </div>

                <div class="form-section-label"><i class="fas fa-ruler-combined"></i> Detalles Físicos</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label for="edit_alto" class="form-label">Alto (cm)</label>
                        <input type="number" id="edit_alto" name="alto" class="form-control" step="0.1" min="0">
                    </div>
                    <div class="col-md-4">
                        <label for="edit_ancho" class="form-label">Ancho (cm)</label>
                        <input type="number" id="edit_ancho" name="ancho" class="form-control" step="0.1" min="0">
                    </div>
                </div>

                <div class="form-section-label"><i class="fas fa-palette"></i> Colores Disponibles</div>
                <div class="row g-3 mb-4">
                    <div class="col-12">
                        <label class="form-label">Selecciona uno o varios colores <span class="text-danger">*</span></label>
                        <div class="color-selector-wrap">
                            <?php
                            $coloresDisponiblesEdit = [
                                'Negro'              => '#1a1a1a',
                                'Blanco'             => '#f5f5f5',
                                'Gris'               => '#9e9e9e',
                                'Plata'              => '#C0C0C0',
                                'Acero Inoxidable'   => '#8D9093',
                                'Grafito'            => '#3d3d3d',
                                'Titanio'            => '#7a7a85',
                                'Champagne'          => '#C9A96E',
                                'Cobre'              => '#b87333',
                                'Dorado'             => '#CFB53B',
                                'Crema'              => '#F5F0E1',
                                'Rojo'               => '#c62828',
                                'Azul Marino'        => '#1a3a5c',
                                'Verde Pizarra'      => '#4a6741',
                            ];
                            foreach ($coloresDisponiblesEdit as $nombre => $hex): ?>
                            <label class="color-chip-label" title="<?= $nombre ?>">
                                <input type="checkbox" name="colores[]" value="<?= $nombre ?>" class="color-chip-input edit-color-check">
                                <span class="color-chip" style="background:<?= $hex ?>;" data-nombre="<?= $nombre ?>">
                                    <i class="fas fa-check color-chip-check"></i>
                                </span>
                                <small><?= $nombre ?></small>
                            </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <div class="form-section-label"><i class="fas fa-images"></i> Multimedia (Deja vacío si no cambian)</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nueva Imagen del Producto</label>
                        <input type="file" id="edit_imagen_input" name="imagen" class="form-control" accept="image/*" onchange="previewEditImage(event)">
                        <div class="mt-2 text-center">
                            <small class="text-muted d-block mb-2" id="edit_imagen_actual_nombre"></small>
                            <img id="edit_img_preview" src="" alt="Vista previa" style="max-height: 150px; display: none; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Nuevo Manual (PDF)</label>
                        <input type="file" name="manual" class="form-control" accept=".pdf">
                        <div class="mt-2">
                            <small class="text-muted d-block" id="edit_manual_actual_nombre"></small>
                        </div>
                    </div>
                </div>

                <hr class="admin-form-divider">
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="submit" name="actualizar" class="btn-admin-primary"><i class="fas fa-save"></i> Actualizar Producto</button>
                </div>
            </form>
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
            <input type="text" class="form-control" placeholder="Buscar productos...">
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
        <a href="/proyectoweb/admin/inicio" class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
        <a href="/proyectoweb/admin/personal" class="nav-link"><i class="fas fa-users"></i> Personal</a>
        <a href="/proyectoweb/admin/productos" class="nav-link active"><i class="fas fa-box"></i> Productos</a>
        <a href="/proyectoweb/admin/clientes" class="nav-link"><i class="fas fa-user-friends"></i> Clientes</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Reportes</p>
        <a href="/proyectoweb/admin/ventas" class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
        <a href="/proyectoweb/admin/compras" class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
        <a href="/proyectoweb/admin/pedidos" class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
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
                <li class="breadcrumb-item"><a href="/proyectoweb/admin/inicio" style="color:var(--btn-color)">Inicio</a></li>
                <li class="breadcrumb-item active text-muted">Productos</li>
            </ol>
        </nav>

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Gestión de Productos</h1>
            <p class="page-header-sub">Registra y controla el inventario del sistema.</p>
        </div>

        <div class="admin-tabs" style="border-bottom: none;">
            <button class="admin-tab-btn" data-tab-group="productos" data-target="tab-registro-prod">
                <i class="fas fa-plus-circle me-1"></i> Registro
            </button>
            <button class="admin-tab-btn" data-tab-group="productos" data-target="tab-consulta-prod">
                <i class="fas fa-search me-1"></i> Consulta / Inventario
            </button>
        </div>

        <div class="admin-tab-panel" id="tab-registro-prod" data-tab-group="productos">
            <div class="admin-form-card">
                <div class="admin-form-header"><i class="fas fa-box-open"></i> Registro de Producto</div>
                <div class="admin-form-body">
                    <form action="/proyectoweb/admin/productos" method="POST" enctype="multipart/form-data">
                        <?php if(!empty($msj) && isset($_POST['guardar'])){ ?>
                            <div class="alerta alerta-<?php echo $msj[0]; ?>"><?php echo $msj[1]; ?></div>
                        <?php } ?>
                        
                        <div class="form-section-label"><i class="fas fa-tag"></i> Datos del Producto</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-8">
                                <label for="nombre" class="form-label">Nombre del Producto <span class="text-danger">*</span></label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Refrigerador Samsung 22ft" >
                            </div>
                            <div class="col-md-4">
                                <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                                <select id="categoria" name="categoria" class="form-select" >
                                    <option value="" disabled selected>Selecciona una</option>
                                    <option value="lavadoras">Lavadoras</option>
                                    <option value="secadoras">Secadoras</option>
                                    <option value="refrigeradores">Refrigeradores</option>
                                    <option value="congeladores">Congeladores</option>
                                    <option value="televisores">Televisores</option>
                                    <option value="audio">Audio</option>
                                    <option value="proyectores">Proyectores</option>
                                    <option value="videojuegos">Videojuegos</option>
                                    <option value="estufas">Estufas</option>
                                    <option value="hornos">Hornos</option>
                                    <option value="microondas">Microondas</option>
                                    <option value="lavavajillas">Lavavajillas</option>
                                    <option value="lavasecadoras">Lavasecadoras</option>
                                    <option value="frigobar">Cava de vinos</option>
                                    <option value="cuidado-hogar">Cuidado del hogar</option>
                                    <option value="cuidado-personal">Cuidado personal</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                                <textarea id="descripcion" name="descripcion" class="form-control" rows="3" ></textarea>
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-dollar-sign"></i> Precios y Stock</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label for="precio_compra" class="form-label">P. Compra <span class="text-danger">*</span></label>
                                <input type="number" id="precio_compra" min="1" name="precio_compra" class="form-control" step="0.01" >
                            </div>
                            <div class="col-md-3">
                                <label for="precio_venta" class="form-label">P. Venta <span class="text-danger">*</span></label>
                                <input type="number" id="precio_venta" min="1" name="precio_venta" class="form-control" step="0.01" >
                            </div>
                            <div class="col-md-3">
                                <label for="stock" class="form-label">Stock Inicial</label>
                                <input type="number" id="stock" name="stock" min="1" class="form-control" value="1">
                            </div>
                            <div class="col-md-3">
                                <label for="stock_minimo" class="form-label">Stock Mínimo</label>
                                <input type="number" id="stock_minimo" min="1" name="stock_minimo" class="form-control" value="1">
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-ruler-combined"></i> Detalles Físicos</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-4">
                                <label for="alto" class="form-label">Alto (cm)</label>
                                <input type="number" id="alto" min="0" name="alto" class="form-control" step="0.1">
                            </div>
                            <div class="col-md-4">
                                <label for="ancho" class="form-label">Ancho (cm)</label>
                                <input type="number" id="ancho" min="0" name="ancho" class="form-control" step="0.1">
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-palette"></i> Colores Disponibles</div>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label">Selecciona uno o varios colores <span class="text-danger">*</span></label>
                                <div class="color-selector-wrap">
                                    <?php
                                    $coloresDisponibles = [
                                        'Negro'              => '#1a1a1a',
                                        'Blanco'             => '#f5f5f5',
                                        'Gris'               => '#9e9e9e',
                                        'Plata'              => '#C0C0C0',
                                        'Acero Inoxidable'   => '#8D9093',
                                        'Grafito'            => '#3d3d3d',
                                        'Titanio'            => '#7a7a85',
                                        'Champagne'          => '#C9A96E',
                                        'Cobre'              => '#b87333',
                                        'Dorado'             => '#CFB53B',
                                        'Crema'              => '#F5F0E1',
                                        'Rojo'               => '#c62828',
                                        'Azul Marino'        => '#1a3a5c',
                                        'Verde Pizarra'      => '#4a6741',
                                    ];
                                    foreach ($coloresDisponibles as $nombre => $hex): ?>
                                    <label class="color-chip-label" title="<?= $nombre ?>">
                                        <input type="checkbox" name="colores[]" value="<?= $nombre ?>" class="color-chip-input">
                                        <span class="color-chip" style="background:<?= $hex ?>;" data-nombre="<?= $nombre ?>">
                                            <i class="fas fa-check color-chip-check"></i>
                                        </span>
                                        <small><?= $nombre ?></small>
                                    </label>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-images"></i> Multimedia</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label">Imagen del Producto <span class="text-danger">*</span></label>
                                <input type="file" id="reg_imagen" name="imagen" class="form-control" accept="image/*" onchange="previewRegImage(event)">
                                <div class="mt-2 text-center">
                                    <img id="reg_img_preview" src="" alt="Vista previa" style="max-height: 150px; display: none; border-radius: 8px; border: 1px solid #ddd; padding: 4px;">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Manual (PDF)</label>
                                <input type="file" name="manual" class="form-control" accept=".pdf">
                            </div>
                        </div>

                        <hr class="admin-form-divider">
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <button type="submit" name="guardar" class="btn-admin-primary"><i class="fas fa-save"></i> Guardar Producto</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="admin-tab-panel" id="tab-consulta-prod" data-tab-group="productos">
            <div class="admin-form-card" style="max-width:100%">
                <div class="admin-form-body pb-0">
                    <div class="admin-search-bar d-flex gap-2">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar por nombre, categoría..." style="max-width: 85%;">
                        <select id="rowsPerPageSelect" class="form-select w-auto">
                            <option value="5" selected>5</option>
                            <option value="10">10</option>
                            <option value="15">15</option>
                            <option value="all">Todos</option>
                        </select>
                    </div>
                    <div class="table-page-info">
                        Número de registros por página: <span id="info-rows-per-page">5</span> &nbsp;|&nbsp; 
                        Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                    </div>
                </div>

                <?php if(!empty($msj) && (isset($_POST['actualizar']) || isset($_POST['eliminar']) || isset($_POST['activar']))){ ?>
                    <div class="alerta alerta-<?php echo $msj[0]; ?>" style="margin: 0 20px 15px 20px;"><?php echo $msj[1]; ?></div>
                <?php } ?>

                <div class="admin-form-body pt-0">
                    <div class="admin-table-wrap">
                        <table class="admin-table" id="tablaProductos">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nombre del Producto</th>
                                    <th>Categoría</th>
                                    <th>Stock</th>
                                    <th>P. Venta</th>
                                    <th>Estatus</th>
                                    <th>Editar</th>
                                    <th>Activar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $prod = new Producto();
                                // Subconsulta para traer los colores concatenados y poder inyectarlos en JS
                                $lista = $prod->buscar('"Veracruz".producto p', [
                                    "select" => "p.*, (SELECT string_agg(color, ',') FROM \"Veracruz\".productocolor WHERE no_producto = p.no_producto) as colores",
                                    "order" => "p.no_producto ASC"
                                ]);
                                $i = 0;
                                foreach ($lista as $p): 
                                ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td class="td-name"><?= htmlspecialchars($p['nombre']) ?></td>
                                    <td><?= $p['categoria'] ?></td>
                                    <td><?= $p['stock'] ?></td>
                                    <td>$<?= number_format($p['precio_venta'], 2) ?></td>
                                    <td>
                                        <span class="badge-<?= $p['estatus'] ? 'activo' : 'inactivo' ?>">
                                            <?= $p['estatus'] ? 'Activo' : 'Baja' ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if($p['estatus']): ?>
                                        <button class="btn-tbl-edit" title="Editar"
                                                onclick="abrirModalEdicion('<?= $p['no_producto'] ?>', '<?= addslashes(htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8')) ?>', '<?= addslashes(htmlspecialchars($p['descripción'] ?? $p['descripcion'] ?? '', ENT_QUOTES, 'UTF-8')) ?>', '<?= $p['precio_compra'] ?>', '<?= $p['precio_venta'] ?>', '<?= $p['stock'] ?>', '<?= $p['stockminimo'] ?>', '<?= $p['alto'] ?>', '<?= $p['ancho'] ?>', '<?= $p['categoria'] ?>',  '<?= addslashes($p['colores'] ?? '') ?>', '<?= $p['imagen'] ?? '' ?>', '<?= $p['manual'] ?? '' ?>')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                         <?php else: ?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if(!$p['estatus']): ?>
                                            <button type="button" class="btn-tbl-delete" title="Dar de alta"
                                                    onclick="abrirModalActivar('<?= $p['no_producto'] ?>', '<?= addslashes(htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8')) ?>')"
                                                    style="background-color:#16a34a; color:#fff;">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($p['estatus']): ?>
                                            <button type="button" class="btn-tbl-delete" title="Dar de baja" 
                                                    onclick="abrirModalEliminar('<?= $p['no_producto'] ?>', '<?= addslashes(htmlspecialchars($p['nombre'], ENT_QUOTES, 'UTF-8')) ?>')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="admin-pagination mt-3" id="paginationControls"></div>
                </div>
            </div>
        </div>
    </main>
</div>

<?php include('vista/admin/footer_admin.php'); ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.admin-tab-btn');
    const tabPanels = document.querySelectorAll('.admin-tab-panel');
    const phpForcedTab = '<?= $postAction ?>';
    let activeTabId = phpForcedTab;
    
    if (!activeTabId) {
        activeTabId = localStorage.getItem('lastActiveTabProd') || 'tab-registro-prod'; 
    } else {
        localStorage.setItem('lastActiveTabProd', activeTabId);
    }

    function activateTab(targetId) {
        tabBtns.forEach(btn => {
            if(btn.getAttribute('data-target') === targetId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        tabPanels.forEach(panel => {
            if(panel.id === targetId) {
                panel.classList.add('active');
            } else {
                panel.classList.remove('active');
            }
        });
    }

    activateTab(activeTabId);

    tabBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            localStorage.setItem('lastActiveTabProd', targetId);
            activateTab(targetId);
        });
    });

    const searchInput = document.getElementById('searchInput');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.querySelector('#tablaProductos tbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls = document.getElementById('paginationControls');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages = document.getElementById('info-total-pages');

    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredRows = [...allRows];

    function renderTable() {
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
        
        infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        infoTotalPages.textContent = totalPages;

        allRows.forEach(row => row.style.display = 'none');
        
        if (totalRows > 0) {
            let start = 0;
            let end = totalRows;

            if (rowsPerPage !== 'all') {
                start = (currentPage - 1) * rowsPerPage;
                end = start + rowsPerPage;
            }

            for (let i = start; i < end && i < totalRows; i++) {
                filteredRows[i].style.display = '';
            }
        }
        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return; 
        }

        paginationControls.innerHTML = '<span class="page-info">Página:</span>';
        
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left me-1"></i>';
            btnPrev.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage--;
                renderTable();
            });
            paginationControls.appendChild(btnPrev);
        }

        const btnCurrent = document.createElement('button');
        btnCurrent.className = 'pg-btn active';
        btnCurrent.textContent = currentPage;
        paginationControls.appendChild(btnCurrent);
        
        if (currentPage < totalPages) {
            const btnNext = document.createElement('button');
            btnNext.className = 'pg-btn';
            btnNext.innerHTML = '<i class="fas fa-chevron-right ms-1"></i>';
            btnNext.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage++;
                renderTable();
            });
            paginationControls.appendChild(btnNext);
        }
    }

    function filterData() {
        const term = searchInput.value.toLowerCase();
        filteredRows = allRows.filter(row => {
            const text = row.textContent.toLowerCase();
            return text.includes(term);
        });
        currentPage = 1;
        renderTable();
    }

    searchInput.addEventListener('input', filterData);
    
    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });
    
    renderTable();
});

function abrirModalEdicion(id, nombre, descripcion, p_compra, p_venta, stock, stock_minimo, alto, ancho, categoria, coloresStr, imagen, manual) {
    document.getElementById('edit_no_producto').value = id;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_descripcion').value = descripcion;
    document.getElementById('edit_precio_compra').value = p_compra;
    document.getElementById('edit_precio_venta').value = p_venta;
    document.getElementById('edit_stock').value = stock;
    document.getElementById('edit_stock_minimo').value = stock_minimo;
    document.getElementById('edit_alto').value = alto;
    document.getElementById('edit_ancho').value = ancho;
    document.getElementById('edit_categoria').value = categoria;

    const checks = document.querySelectorAll('.edit-color-check');
    checks.forEach(cb => cb.checked = false);
    if (coloresStr) {
        const activos = coloresStr.split(',').map(c => c.trim());
        checks.forEach(cb => {
            if (activos.includes(cb.value)) cb.checked = true;
        });
    }

    const imgPreview = document.getElementById('edit_img_preview');
    const imgName = document.getElementById('edit_imagen_actual_nombre');
    const manualName = document.getElementById('edit_manual_actual_nombre');
    document.getElementById('edit_imagen_input').value = '';

    if (imagen) {
        imgPreview.src = '/proyectoweb/public/uploads/img/' + imagen;
        imgPreview.style.display = 'inline-block';
        imgName.innerHTML = `<i class="fas fa-image text-primary"></i> Actual: <strong>${imagen}</strong>`;
    } else {
        imgPreview.style.display = 'none';
        imgPreview.src = '';
        imgName.innerHTML = 'Sin imagen registrada';
    }

    if (manual) {
        manualName.innerHTML = `<i class="fas fa-file-pdf text-danger"></i> Actual: <a href="/proyectoweb/public/uploads/pdf/${manual}" target="_blank"><strong>${manual}</strong></a>`;
    } else {
        manualName.innerHTML = 'Sin manual registrado';
    }

    document.getElementById('editModal').style.display = 'flex';
}

function cerrarModalEdicion() {
    document.getElementById('editModal').style.display = 'none';
}

function abrirModalEliminar(id, nombre) {
    const mensaje = document.getElementById('confirmMsg');
    mensaje.innerHTML = `¿Estás seguro de que deseas eliminar el producto <strong>${nombre}</strong>?`;
    document.getElementById('delete_no_producto').value = id;
    document.getElementById('confirmOverlay').style.display = 'flex';
}

function cerrarModalEliminar() {
    document.getElementById('confirmOverlay').style.display = 'none';
}

function abrirModalActivar(id, nombre) {
    const mensaje = document.getElementById('activateMsg');
    mensaje.innerHTML = `¿Estás seguro de que deseas reactivar el producto <strong>${nombre}</strong>?`;
    document.getElementById('activate_no_producto').value = id;
    document.getElementById('activateOverlay').style.display = 'flex';
}

function cerrarModalActivar() {
    document.getElementById('activateOverlay').style.display = 'none';
}

function previewRegImage(event) {
    const preview = document.getElementById('reg_img_preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    } else {
        preview.style.display = 'none';
        preview.src = '';
    }
}

function previewEditImage(event) {
    const preview = document.getElementById('edit_img_preview');
    const file = event.target.files[0];
    if (file) {
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
}
</script>