<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Admin — Nuevo Pedido a Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/vendedor.css">
    <link rel="stylesheet" href="../../estilos/proveedor.css">
</head>
<body>

<!-- ░░ TOPBAR ░░ -->
<div class="topbar">
    <div class="container-fluid d-flex justify-content-between px-3">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
        </div>
        <div><span><i class="fas fa-user-shield me-1"></i> Panel Administrador</span></div>
    </div>
</div>

<!-- ░░ NAV ░░ -->
<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="../../index.php" class="brand-logo me-3">
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

<!-- ░░ LAYOUT ░░ -->
    <!-- ── SIDEBAR ── -->
     <div class="admin-layout">
        <nav class="admin-sidebar">
            <p class="sidebar-title">Menú Admin</p>
            <a href="vistaadmin.php"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="admin_usuarios.php"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
            <a href="admin_productos.php" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="admin_reportes_ventas.php"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="admin_reportes_compras.php"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="admin_reportes_pedidos.php"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Proveedores</p>
            <a href="admin_pedido_proveedor.php" class="nav-link active"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
                        <a href="../Cuenta/login.php" class="btn-cerrar">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </nav>

    <!-- ── CONTENIDO ── -->
    <main class="admin-content">

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="vistaadmin.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Pedir a Proveedor</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
            <div>
                <h1 class="page-header-title mb-0">Nuevo Pedido a Proveedor</h1>
                <p class="page-header-sub">Selecciona proveedor, productos y cantidades para generar la solicitud de reabastecimiento.</p>
            </div>
            <span class="folio-badge" id="folioPreview">LC-REA-2026-032</span>
        </div>

        <!-- Tabs -->
        <div class="admin-tabs">
            <button class="admin-tab-btn active" onclick="cambiarTab('nuevo', this)">
                <i class="fas fa-plus-circle"></i> Nuevo Pedido
            </button>
            <button class="admin-tab-btn" onclick="cambiarTab('historial', this)">
                <i class="fas fa-history"></i> Historial de Solicitudes
            </button>
        </div>

        <!-- ── TAB: Nuevo Pedido ── -->
        <div class="admin-tab-panel active" id="tab-nuevo">
            <div class="row g-3">

                <!-- Columna izquierda -->
                <div class="col-lg-8">

                    <!-- Datos del pedido -->
                    <div class="admin-form-card mb-3">
                        <div class="admin-form-header">
                            <i class="fas fa-clipboard-list"></i> Datos del Pedido
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Proveedor <span class="text-danger">*</span></label>
                                    <select class="form-select" id="selectProveedor" onchange="actualizarProveedor(this.value)">
                                        <option value="">— Seleccionar proveedor —</option>
                                        <option value="whirlpool">Whirlpool MX</option>
                                        <option value="samsung">Samsung MX</option>
                                        <option value="lg">LG Electronics</option>
                                        <option value="mabe">Mabe</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Contacto del proveedor</label>
                                    <input type="text" class="form-control" id="contactoProveedor"
                                           placeholder="—" readonly style="background:#f8fafc; color:#555;">
                                </div>
                         <!--       <div class="col-md-6">
                                    <label class="form-label">Fecha requerida de entrega <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="fechaEntrega">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Nota para el proveedor</label>
                                    <textarea class="form-control" id="notaProveedor" rows="2"
                                              placeholder="Ej: Reabasto urgente línea blanca, prioridad refrigeradores..."></textarea>
                                </div>-->
                            </div>
                        </div>
                    </div>

                    <!-- Productos -->
                    <div class="admin-form-card mb-3">
                        <div class="admin-form-header">
                            <i class="fas fa-box-open"></i> Productos a Solicitar
                        </div>
                        <div class="admin-form-body">

                            <div class="producto-picker mb-3">
                                <div class="picker-header">
                                    <i class="fas fa-search"></i> Seleccionar del catálogo
                                </div>
                                <div class="picker-body">
                                    <div class="mb-2">
                                        <input type="text" class="form-control form-control-sm"
                                               placeholder="Filtrar productos..."
                                               oninput="filtrarProductos(this.value)">
                                    </div>
                                    <div id="listaCatalogo">

                                        <div class="picker-item" onclick="toggleProducto('P001',this)">
                                            <input type="checkbox" id="chk-P001">
                                            <div class="picker-item-img"><i class="fas fa-snowflake"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="picker-item-name">Refrigerador 14 pies Frost</div>
                                                <div class="picker-item-sku">SKU: WH-REF-014</div>
                                            </div>
                                            <div class="picker-item-stock">Stock: <strong>3</strong></div>
                                            <div class="picker-item-precio">$7,490</div>
                                        </div>

                                        <div class="picker-item" onclick="toggleProducto('P002',this)">
                                            <input type="checkbox" id="chk-P002">
                                            <div class="picker-item-img"><i class="fas fa-wind"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="picker-item-name">Lavadora 17 kg Automática</div>
                                                <div class="picker-item-sku">SKU: WH-LAV-017</div>
                                            </div>
                                            <div class="picker-item-stock">Stock: <strong>8</strong></div>
                                            <div class="picker-item-precio">$5,290</div>
                                        </div>

                                        <div class="picker-item" onclick="toggleProducto('P003',this)">
                                            <input type="checkbox" id="chk-P003">
                                            <div class="picker-item-img"><i class="fas fa-fire-alt"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="picker-item-name">Estufa 6 Quemadores Acero</div>
                                                <div class="picker-item-sku">SKU: MB-EST-006</div>
                                            </div>
                                            <div class="picker-item-stock">Stock: <strong>12</strong></div>
                                            <div class="picker-item-precio">$3,850</div>
                                        </div>

                                        <div class="picker-item" onclick="toggleProducto('P004',this)">
                                            <input type="checkbox" id="chk-P004">
                                            <div class="picker-item-img"><i class="fas fa-tv"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="picker-item-name">Televisor 55" QLED 4K</div>
                                                <div class="picker-item-sku">SKU: SG-TV-055</div>
                                            </div>
                                            <div class="picker-item-stock">Stock: <strong>5</strong></div>
                                            <div class="picker-item-precio">$9,999</div>
                                        </div>

                                        <div class="picker-item" onclick="toggleProducto('P005',this)">
                                            <input type="checkbox" id="chk-P005">
                                            <div class="picker-item-img"><i class="fas fa-blender"></i></div>
                                            <div class="flex-grow-1">
                                                <div class="picker-item-name">Microondas 30L Inverter</div>
                                                <div class="picker-item-sku">SKU: LG-MW-030</div>
                                            </div>
                                            <div class="picker-item-stock">Stock: <strong>2</strong></div>
                                            <div class="picker-item-precio">$2,199</div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div id="tablaSeleccionadosWrap" style="display:none;">
                                <div class="form-section-label">
                                    <i class="fas fa-check-circle"></i> Productos seleccionados
                                </div>
                                <div class="admin-table-wrap">
                                    <table class="admin-table">
                                        <thead>
                                            <tr>
                                                <th>Producto</th>
                                                <th>SKU</th>
                                                <th style="text-align:center">Cant.</th>
                                                <th style="text-align:right">P. Unit.</th>
                                                <th style="text-align:right">Subtotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tablaSeleccionados"></tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div><!-- /col-lg-8 -->

                <!-- Columna derecha -->
                <div class="col-lg-4">
                    <div class="resumen-card mb-3">
                        <div class="resumen-card-label">Resumen del Pedido</div>
                        <div class="resumen-row">
                            <span>Folio</span>
                            <span style="font-family:monospace; color:var(--btn-color); font-weight:700;">LC-REA-2026-032</span>
                        </div>
                        <div class="resumen-row">
                            <span>Proveedor</span>
                            <span id="resProveedor" style="font-weight:600;">—</span>
                        </div>
                        <div class="resumen-row">
                            <span>Productos</span>
                            <span id="resCantProductos" style="font-weight:600;">0</span>
                        </div>
                        <div class="resumen-row">
                            <span>Unidades totales</span>
                            <span id="resUnidades" style="font-weight:600;">0</span>
                        </div>
                        <div class="resumen-row" style="border-bottom:none; padding-top:.75rem; margin-top:.25rem;">
                            <span style="font-weight:700; font-size:.95rem;">Total estimado</span>
                            <span class="resumen-total" id="resTotal">$0.00</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <button class="btn-enviar-pedido" onclick="abrirConfirmacion()">
                            <i class="fas fa-paper-plane"></i> Enviar Solicitud al Proveedor
                        </button>
                    </div>

                    <div class="info-steps-card">
                        <h5><i class="fas fa-info-circle me-2" style="color:#d97706;"></i>¿Cómo funciona?</h5>
                        <ol>
                            <li>Selecciona proveedor y fecha.</li>
                            <li>Elige los productos y ajusta cantidades.</li>
                            <li>Envía la solicitud — el proveedor la verá en su portal.</li>
                            <li>El proveedor responde con disponibilidad.</li>
                        </ol>
                    </div>
                </div>

            </div>
        </div><!-- /tab-nuevo -->

        <!-- ── TAB: Historial ── -->
        <div class="admin-tab-panel" id="tab-historial">
            <div class="report-form-card">
                <h5 class="page-header-title mb-3">
                    <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Solicitudes enviadas a proveedores
                </h5>
                <div class="admin-search-bar mb-3">
                    <input type="text" class="form-control" placeholder="Buscar folio o proveedor..." style="max-width:240px">
                    <select class="form-select" style="max-width:160px">
                        <option value="">Todos los estados</option>
                        <option>Pendiente</option>
                        <option>Confirmada</option>
                        <option>Enviada</option>
                        <option>Cancelada</option>
                    </select>
                    <button class="btn-buscar"><i class="fas fa-search me-1"></i>Filtrar</button>
                </div>
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Folio</th><th>Fecha</th><th>Proveedor</th><th>Productos</th>
                                <th>Nota</th><th>Total Est.</th><th>Estado</th><th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="folio-badge">LC-REA-2026-031</span></td>
                                <td>28/03/2026 10:45</td><td>Whirlpool MX</td><td>4 productos</td>
                                <td class="td-name" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    Reabasto urgente línea blanca</td>
                                <td>$38,920</td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td><button class="btn-tbl-edit" onclick="verDetalle('LC-REA-2026-031')"><i class="fas fa-eye"></i> Ver</button></td>
                            </tr>
                            <tr>
                                <td><span class="folio-badge">LC-REA-2026-028</span></td>
                                <td>25/03/2026 08:20</td><td>Samsung MX</td><td>2 productos</td>
                                <td class="td-name" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    Stock bajo en microondas</td>
                                <td>$14,398</td>
                                <td><span class="badge-pendiente">Pendiente</span></td>
                                <td><button class="btn-tbl-edit" onclick="verDetalle('LC-REA-2026-028')"><i class="fas fa-eye"></i> Ver</button></td>
                            </tr>
                            <tr>
                                <td><span class="folio-badge">LC-REA-2026-021</span></td>
                                <td>15/03/2026 14:00</td><td>LG Electronics</td><td>3 productos</td>
                                <td class="td-name" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">
                                    Reabasto mensual programado</td>
                                <td>$22,050</td>
                                <td><span class="badge-confirmada">Confirmada</span></td>
                                <td><button class="btn-tbl-edit" onclick="verDetalle('LC-REA-2026-021')"><i class="fas fa-eye"></i> Ver</button></td>
                            </tr>
                            <tr>
                                <td><span class="folio-badge">LC-REA-2026-014</span></td>
                                <td>05/03/2026 09:30</td><td>Mabe</td><td>5 productos</td>
                                <td>—</td><td>$55,390</td>
                                <td><span class="badge-enviada">Enviada</span></td>
                                <td><button class="btn-tbl-edit" onclick="verDetalle('LC-REA-2026-014')"><i class="fas fa-eye"></i> Ver</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /tab-historial -->

    </main>
</div><!-- /admin-layout -->


<!-- Modal confirmación -->
<div class="modal-pedido-overlay" id="modalPedidoOverlay">
    <div class="modal-pedido-box">
        <div class="modal-pedido-header">
            <i class="fas fa-paper-plane"></i> Confirmar Solicitud de Reabasto
        </div>
        <div class="modal-pedido-body" id="modalPedidoBody"></div>
    </div>
</div>



<footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
</body>
</html>