<?php include('vista/vendedor/header_vendedor.php'); ?>

<div class="admin-layout">
    <?php include('vista/vendedor/menu_vendedor.php'); ?>

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
                                <?php 
                                if(is_array($productos) && count($productos) > 0) {
                                    foreach($productos as $prod) {
                                        // Generamos el SKU inteligente usando tu clase Helpers
                                        // Asegúrate de que la columna se llame 'categoria' o cámbiala por la correcta
                                        $categoriaTexto = isset($prod['categoria']) ? $prod['categoria'] : 'GEN';
                                        $sku = Helpers::crearSKU($categoriaTexto, $prod['nombre']);
                                ?>
                                        <option value="<?php echo $sku; ?>" 
                                                data-precio="<?php echo $prod['precio_venta']; ?>"
                                                data-stock="<?php echo $prod['stock']; ?>">
                                            <?php echo $prod['nombre']; ?> (<?php echo $sku; ?>) — $<?php echo number_format($prod['precio_venta'], 2); ?> — [Stock: <?php echo $prod['stock']; ?>]
                                        </option>
                                <?php 
                                    } 
                                } 
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Cantidad:</label>
                            <input type="number" id="inputCantidad" class="form-control" min="1" value="1">
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

        <div class="row g-4 js-hidden" id="seccionPago">

            <div class="col-md-6">
                <div class="admin-form-card h-100">
                    <div class="admin-form-header">
                        <i class="fas fa-user-circle"></i> Datos del Cliente
                    </div>
                    <div class="admin-form-body">
                        <div class="mb-3">
                            <label class="form-label">Cliente:</label>

                            <div class="cliente-widget">

                                <input type="text"
                                       id="clienteInput"
                                       class="cliente-input"
                                       placeholder="Buscar por nombre o escribir uno nuevo…"
                                       autocomplete="off">

                                <div id="clienteDropdown" class="cliente-dropdown"></div>

                                <div id="clienteSeleccionado" class="cliente-seleccionado">
                                    <span id="clientePillNombre"></span>
                                    <button type="button" id="btnCambiarCliente"
                                            class="btn-cliente-cambiar"
                                            title="Cambiar cliente">
                                        <i class="fas fa-times"></i> Cambiar
                                    </button>
                                </div>

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
                        <button type="button" class="btn-admin-secondary w-100 mb-3" onclick="calcularCambio()">
                            <i class="fas fa-calculator me-1"></i> Calcular Cambio
                        </button>
                        <div class="mb-4">
                            <label class="form-label">Cambio:</label>
                            <input type="text" id="inputCambio" class="form-control fw-bold"
                                   readonly placeholder="$0.00">
                        </div>
                        <button type="button" class="btn-admin-primary w-100" onclick="registrarVenta()">
                            <i class="fas fa-check-circle me-1"></i> Registrar Venta
                        </button>
                    </div>
                </div>
            </div>

        </div></main>
</div>

<?php include('vista/vendedor/footer_vendedor.php'); ?>

<script>
    const CLIENTES_REGISTRADOS = <?php echo json_encode($clientes_linea); ?>;
document.addEventListener('DOMContentLoaded', function() {
    const selectProducto = document.getElementById('selectProducto');
    const inputCantidad = document.getElementById('inputCantidad');
    selectProducto.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        
        if (selectedOption.value !== "") {
            const stockMaximo = parseInt(selectedOption.getAttribute('data-stock'));
            inputCantidad.max = stockMaximo;
            let cantidadActual = parseInt(inputCantidad.value) || 0;
            if (cantidadActual < 1) {
                inputCantidad.value = 1;
            }
            else if (cantidadActual > stockMaximo) {
                inputCantidad.value = stockMaximo;
                alert('La cantidad se ha ajustado al stock máximo disponible (' + stockMaximo + ').');
            }
        }
    });

    inputCantidad.addEventListener('input', function() {
        const selectedOption = selectProducto.options[selectProducto.selectedIndex];
        if (selectedOption.value === "") {
            this.value = 1;
            return;
        }

        const stockMaximo = parseInt(selectedOption.getAttribute('data-stock'));
        let cantidadEscrita = parseInt(this.value);

        if (cantidadEscrita > stockMaximo) {
            this.value = stockMaximo;
        } else if (cantidadEscrita < 1) {
        }
    });
    
    inputCantidad.addEventListener('blur', function() {
        if (this.value === '' || parseInt(this.value) < 1) {
            this.value = 1;
        }
    });
});
</script>