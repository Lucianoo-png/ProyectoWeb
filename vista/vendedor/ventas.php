<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/vendedor.css">
</head>
<body>

<!-- Topbar -->
<div class="topbar">
    <div class="container-fluid d-flex justify-content-between px-3">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div><span><i class="fas fa-user-tie me-1"></i> Panel Vendedor</span></div>
    </div>
</div>

<!-- Navbar -->
<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="Buscar productos…">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Vendedor</p>
        <a href="inicio_vendedor.php" class="nav-link">
            <i class="fas fa-tachometer-alt"></i> Inicio
        </a>
        <a href="ventas.php" class="nav-link active">
            <i class="fas fa-cash-register"></i> Venta
        </a>
        <a href="detalle_ventas.php" class="nav-link">
            <i class="fas fa-receipt"></i> Detalle Ventas
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Consultas</p>
        <a href="inventario.php" class="nav-link">
            <i class="fas fa-boxes"></i> Inventario
        </a>
        <a href="catalogo.php" class="nav-link">
            <i class="fas fa-th-large"></i> Catálogo
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Atención</p>
        <a href="solicitudes.php" class="nav-link">
            <i class="fas fa-headset"></i> Solicitudes
            <span class="tab-badge">4</span>
        </a>
        <a href="../../vista/Cuenta/login.php" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <!-- Contenido -->
    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="inicio_vendedor.php" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Ventas</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h1 class="page-header-title mb-0">Venta de Electrodomésticos</h1>
            <p class="page-header-sub">Registra una nueva venta seleccionando los productos del catálogo.</p>
        </div>

        <!-- Selector de producto -->
        <div class="admin-form-card mb-4">
            <div class="admin-form-header">
                <i class="fas fa-cash-register"></i> Punto de Venta
            </div>
            <div class="admin-form-body">
                <form id="formAgregarProducto" novalidate>
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Producto:</label>
                            <select id="selectProducto" class="form-select" required>
                                <option value="" disabled selected>Selecciona un producto…</option>
                                <option value="WM3911D"      data-precio="4599" >Microondas AirFry 4 en 1 (WM3911D) — $4,599.00</option>
                                <option value="8MWTW2024WJM" data-precio="9999" >Lavadora 20kg Xpert System (8MWTW2024WJM) — $9,999.00</option>
                                <option value="WK0260B"      data-precio="7999" >Despachador de agua con hielo (WK0260B) — $7,999.00</option>
                                <option value="WRS315SNHM"   data-precio="22499">Refrigerador Side by Side 25 pies (WRS315SNHM) — $22,499.00</option>
                                <option value="MGH765RDS"    data-precio="9799" >Estufa 6 quemadores convección (MGH765RDS) — $9,799.00</option>
                                <option value="LG-WM3500CW"  data-precio="11499">Lavadora LG 22kg TurboWash (LG-WM3500CW) — $11,499.00</option>
                                <option value="SAM-RF28T"    data-precio="28999">Refrigerador Samsung French Door 28 pies (SAM-RF28T) — $28,999.00</option>
                                <option value="WHP-AC1234"   data-precio="8299" >Aire Acondicionado 12,000 BTU (WHP-AC1234) — $8,299.00</option>
                                <option value="WED5000DW"    data-precio="7899" >Secadora eléctrica 7.0 pies (WED5000DW) — $7,899.00</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Cantidad:</label>
                            <input type="number" id="inputCantidad" class="form-control"
                                   min="1" max="99" value="1">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" class="btn-admin-primary w-100">
                                <i class="fas fa-plus me-1"></i> Añadir Producto
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de items -->
        <div class="admin-form-card mb-4">
            <div class="admin-form-body">
                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>SKU</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Subtotal</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="tbodyVenta">
                            <tr id="tr-vacio">
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-shopping-cart me-2"></i>
                                    Aún no se han agregado productos a la venta.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sección de pago (oculta hasta agregar productos) -->
        <div class="row g-4 js-hidden" id="seccionPago">

            <!-- Panel izquierdo: cliente + resumen -->
            <div class="col-md-6">
                <div class="admin-form-card h-100">
                    <div class="admin-form-header">
                        <i class="fas fa-user-circle"></i> Datos del Cliente
                    </div>
                    <div class="admin-form-body">
                        <div class="mb-3">
                            <label class="form-label">Cliente:</label>
                            <select class="form-select" id="selectCliente">
                                <option value="">— Seleccionar cliente —</option>
                                <option>Ana Torres Vega</option>
                                <option>Luis Ramírez</option>
                                <option>Roberto Méndez</option>
                                <option>Claudia Soto</option>
                                <option>— Cliente en mostrador —</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tipo de Pago:</label>
                            <select class="form-select" id="selectPago">
                                <option value="efectivo">Efectivo</option>
                                <option value="tarjeta">Tarjeta</option>
                                <option value="transferencia">Transferencia</option>
                                <option value="credito">Crédito (18 MSI)</option>
                            </select>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-semibold">Subtotal:</span>
                            <span id="lblSubtotal">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-semibold">IVA (16%):</span>
                            <span id="lblIva">$0.00</span>
                        </div>
                        <div class="d-flex justify-content-between total-pago-row mt-2">
                            <strong>Total a pagar:</strong>
                            <strong id="lblTotal" class="total-pago-valor">$0.00</strong>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel derecho: cobro + cambio -->
            <div class="col-md-6">
                <div class="admin-form-card h-100">
                    <div class="admin-form-header">
                        <i class="fas fa-money-bill-wave"></i> Cobro
                    </div>
                    <div class="admin-form-body">
                        <div class="mb-3">
                            <label class="form-label">Cantidad recibida ($):</label>
                            <input type="number" id="inputRecibido" class="form-control"
                                   min="0" step="0.01" placeholder="0.00"
                                   oninput="calcularCambio()">
                        </div>
                        <button class="btn-admin-secondary w-100 mb-3" onclick="calcularCambio()">
                            <i class="fas fa-calculator me-1"></i> Calcular Cambio
                        </button>
                        <div class="mb-4">
                            <label class="form-label">Cambio:</label>
                            <input type="text" id="inputCambio" class="form-control fw-bold"
                                   readonly placeholder="$0.00">
                        </div>
                        <button class="btn-admin-primary w-100" onclick="registrarVenta()">
                            <i class="fas fa-check-circle me-1"></i> Registrar Venta
                        </button>
                    </div>
                </div>
            </div>

        </div><!-- /seccionPago -->

    </main>
</div>

<footer class="site-footer-minimal">© <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
</body>
</html>