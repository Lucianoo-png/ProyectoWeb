<?php include('vista/vendedor/header_vendedor.php'); ?>

<div class="admin-layout">
    <?php include('vista/vendedor/menu_vendedor.php'); ?>

    <main class="admin-content">
        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Venta de Electrodomésticos</h1>
            <p class="page-header-sub">Registra una nueva venta seleccionando los productos del catálogo.</p>
        </div>
        <div id="contenedor-alerta" style="display: flex; justify-content: center;margin-bottom:5px;">
            <?php if(!empty($msj)): ?>
                <div class="alerta alerta-<?php echo $msj[0]; ?>">
                    <?php echo $msj[1]; ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="admin-form-card mb-4">
            <div class="admin-form-header">
                <i class="fas fa-cash-register"></i> Punto de Venta
            </div>
             <form id="formAgregarProducto" novalidate>
            <div class="admin-form-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Producto:</label>
                            <select id="selectProducto" class="form-select" required>
                                <option value="" disabled selected>Selecciona un producto…</option>
                                <?php 
                                if(is_array($productos) && count($productos) > 0) {
                                    foreach($productos as $prod) {
                                        $categoriaTexto = isset($prod['categoria']) ? $prod['categoria'] : 'GEN';
                                        $sku = Helpers::crearSKU($categoriaTexto, $prod['nombre']);
                                ?>
                                        <option value="<?php echo $prod['no_producto']; ?>" 
                                                data-precio="<?php echo $prod['precio_venta']; ?>"
                                                data-sku="<?php echo $sku; ?>"
                                                data-stock="<?php echo $prod['stock']; ?>"
                                                data-nombre="<?php echo $prod['nombre']; ?>"
                                            >
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

        <form action="/proyectoweb/vendedor/ventas" method="POST" id="formFinalizarVenta">
            <input type="hidden" name="items_json" id="items_json">
            <input type="hidden" name="nombre_cliente_nuevo" id="nombre_cliente_nuevo">
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
                            <select name="pago" class="form-select" id="selectPago" onchange="ejecutarLogicaCobro()">
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
                                <label class="form-label fw-semibold">Cantidad recibida ($):</label>
                                <input type="number" name="cantidad" id="inputRecibido" class="form-control form-control-lg"
                                    min="0" step="0.01" placeholder="0.00"
                                    oninput="ejecutarLogicaCobro()">
                            </div>

                            <div class="mb-4">
                                <label class="form-label small text-muted">Cambio:</label>
                                <input type="text" id="inputCambio" class="form-control fw-bold bg-light"
                                    readonly placeholder="$0.00" style="font-size: 1.2rem;">
                            </div>

                            <div id="wrapper-acciones-venta">
                                <div id="msg-error-pago" class="alerta alerta-danger mb-3 js-hidden" style="font-size: 0.85rem;">
                                    <i class="fas fa-exclamation-triangle me-1"></i> 
                                    Monto insuficiente para registrar la venta.
                                </div>
                                
                                <button type="submit" name="registrar_venta" id="btn-registrar-venta" class="btn-admin-primary w-100 js-hidden">
                                    <i class="fas fa-check-circle me-1"></i> Registrar Venta
                                </button>
                            </div>
                        </div>
                </div>
            </div>
        </div><!-- /.row seccionPago -->
        </form>
    </main>
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

function ejecutarLogicaCobro() {
    const metodo = document.getElementById('selectPago').value;
    const inputRecibido = document.getElementById('inputRecibido');
    const inputCambio = document.getElementById('inputCambio');
    const totalVenta = obtenerTotalNumerico(); 
    let recibido = parseFloat(inputRecibido.value) || 0;

    if (metodo === 'tarjeta') {
        inputRecibido.readOnly = true;
        inputRecibido.value = totalVenta.toFixed(2);
        inputCambio.value = "$0.00";
        toggleBotones(true);
    } else {
        inputRecibido.readOnly = false;
        let cambio = recibido - totalVenta;
        
        if (recibido >= totalVenta && totalVenta > 0) {
            inputCambio.value = fmt(cambio);
            toggleBotones(true);
        } else {
            inputCambio.value = "$0.00";
            toggleBotones(false);
        }
    }
}

function toggleBotones(esValido) {
    const btnRegistrar = document.getElementById('btn-registrar-venta');
    const msgError = document.getElementById('msg-error-pago');
    const totalVenta = obtenerTotalNumerico();

    if (totalVenta <= 0) {
        btnRegistrar.classList.add('js-hidden');
        msgError.classList.add('js-hidden');
        return;
    }

    if (esValido) {
        btnRegistrar.classList.remove('js-hidden');
        msgError.classList.add('js-hidden');
    } else {
        btnRegistrar.classList.add('js-hidden');
        msgError.classList.remove('js-hidden');
    }
}


function obtenerTotalNumerico() {
    const totalTexto = document.getElementById('lblTotal').textContent;
    return parseFloat(totalTexto.replace(/[$,]/g, '')) || 0;
}

document.getElementById('formFinalizarVenta').addEventListener('submit', function(e) {
    document.getElementById('items_json').value = JSON.stringify(ventaItems);
    const idCliente = document.getElementById('clienteValor').value;
    const pillNombre = document.getElementById('clientePillNombre').textContent.trim();
    const inputTexto = document.getElementById('clienteInput').value.trim();
    
    let nombreFinal = "Mostrador";

    if (idCliente && pillNombre !== "") {
        nombreFinal = pillNombre;
    } else if (inputTexto !== "") {
        nombreFinal = inputTexto;
    }

    document.getElementById('nombre_cliente_nuevo').value = nombreFinal;
});

</script>