<?php include('vista/vendedor/header_vendedor.php'); ?>
<!-- Layout -->
<div class="admin-layout">
    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <!-- Contenido -->
    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="/proyectoweb/vendedor/inicio" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Ventas</li>
            </ol>
        </nav>

        <div class="mb-4 text-center">
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

                            <!-- Widget búsqueda/selección/nombre libre -->
                            <div class="cliente-widget">

                                <!-- Input de búsqueda -->
                                <input type="text"
                                       id="clienteInput"
                                       class="cliente-input"
                                       placeholder="Buscar por nombre o escribir uno nuevo…"
                                       autocomplete="off">

                                <!-- Dropdown de sugerencias (generado por vendedor.js) -->
                                <div id="clienteDropdown" class="cliente-dropdown"></div>

                                <!-- Pill: cliente seleccionado (visible tras elegir) -->
                                <div id="clienteSeleccionado" class="cliente-seleccionado">
                                    <span id="clientePillNombre"></span>
                                    <button type="button" id="btnCambiarCliente"
                                            class="btn-cliente-cambiar"
                                            title="Cambiar cliente">
                                        <i class="fas fa-times"></i> Cambiar
                                    </button>
                                </div>

                                <!-- Campo hidden que guarda el valor final -->
                                <input type="hidden" id="clienteValor" name="cliente">

                                <p class="cliente-hint">
                                    <i class="fas fa-info-circle"></i>
                                    Selecciona un cliente registrado o escribe un nombre para continuar.
                                </p>
                            </div>
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

<?php include('vista/vendedor/footer_vendedor.php'); ?>