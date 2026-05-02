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
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Admin</p>
        <a href="/proyectoweb/admin/inicio"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
        <a href="/proyectoweb/admin/personal"  class="nav-link"><i class="fas fa-users"></i> Personal</a>
        <a href="/proyectoweb/admin/productos" class="nav-link"><i class="fas fa-box"></i> Productos</a>
        <a href="/proyectoweb/admin/clientes"  class="nav-link"><i class="fas fa-user-friends"></i> Clientes</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Reportes</p>
        <a href="/proyectoweb/admin/ventas"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
        <a href="/proyectoweb/admin/compras"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
        <a href="/proyectoweb/admin/pedidos"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
        <a href="/proyectoweb/admin/asignar-pedidos" class="nav-link"><i class="fas fa-user-plus"></i> Asignar Pedidos</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Proveedores</p>
        <a href="/proyectoweb/admin/pedido-proveedor" class="nav-link active"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Sistema</p>
        <a href="/proyectoweb/admin/logs" class="nav-link"><i class="fas fa-history"></i> Historial (Logs)</a>
        <hr class="sidebar-divider">
        <a href="/proyectoweb/admin/logout" class="btn-cerrar" style="margin-top:.5rem">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <main class="admin-content">

        <div class="position-relative mb-4 text-center">
            <h1 class="page-header-title mb-0">Nuevo Pedido a Proveedor</h1>
            <p class="page-header-sub">Selecciona proveedor, productos y cantidades para generar la solicitud de reabastecimiento.</p>
            <span class="folio-badge position-absolute top-0 end-0"><?php echo $nuevoFolio; ?></span>
        </div>

        <div class="admin-tabs">
            <button class="admin-tab-btn active" onclick="provReabasto_cambiarTab('nuevo', this)">
                <i class="fas fa-plus-circle"></i> Nuevo Pedido
            </button>
            <button class="admin-tab-btn" onclick="provReabasto_cambiarTab('historial', this)">
                <i class="fas fa-history"></i> Historial de Solicitudes
            </button>
        </div>

        <div class="admin-tab-panel active" id="tab-nuevo">
            <form action="/proyectoweb/admin/pedido-proveedor" method="POST" id="formReabasto" onsubmit="provReabasto_prepararEnvio(event)">
                <input type="hidden" name="folio" value="<?php echo $nuevoFolio; ?>">
                <input type="hidden" name="rfc_proveedor" id="inputRfcProv">
                <input type="hidden" name="nota" id="inputNota">
                <input type="hidden" name="productos_json" id="inputProductosJson">

                <div class="row g-3">
                    <div class="col-lg-8">
                        
                        <div class="admin-form-card mb-3">
                            <div class="admin-form-header">
                                <i class="fas fa-clipboard-list"></i> Datos del Pedido
                            </div>
                            
                            <?php if(!empty($msj)){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?>" style="margin: 15px 15px 15px 15px;"><?php echo $msj[1]; ?></div>
                            <?php } ?>

                            <div class="admin-form-body">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Proveedor <span class="text-danger">*</span></label>
                                        <select class="form-select" id="selectProveedor" onchange="provReabasto_seleccionarProv(this)">
                                            <option value="">— Seleccionar proveedor —</option>
                                            <?php foreach($proveedores as $prov): ?>
                                                <option value="<?= $prov['rfc'] ?>" data-nombre="<?= htmlspecialchars($prov['nombre'].' '.$prov['apellidospama']) ?>">
                                                    <?= htmlspecialchars($prov['nombre'].' '.$prov['apellidospama']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Nota / Observaciones</label>
                                        <input type="text" class="form-control" id="notaPedido" placeholder="Ej. Reabasto de urgencia">
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                                   oninput="provReabasto_filtrarCatalogo(this.value)">
                                        </div>
                                        <div id="listaCatalogo">
                                            <?php foreach($productos as $p): 
                                                $sku = Helpers::crearSKU($p['categoria'], $p['nombre']);
                                            ?>
                                                <div class="picker-item" onclick="provReabasto_toggleProducto('<?= $p['no_producto'] ?>', this, event)">
                                                    <input type="checkbox" id="chk-<?= $p['no_producto'] ?>">
                                                    <div class="flex-grow-1 ms-2">
                                                        <div class="picker-item-name" id="nom-<?= $p['no_producto'] ?>"><?= htmlspecialchars($p['nombre']) ?></div>
                                                        <div class="picker-item-sku" id="sku-<?= $p['no_producto'] ?>">SKU: <?= $sku ?></div>
                                                    </div>
                                                    <div class="picker-item-stock">Stock: <strong><?= $p['stock'] ?></strong></div>
                                                    <div class="picker-item-precio" data-precio="<?= $p['precio_compra'] ?>">$<?= number_format($p['precio_compra'], 2) ?></div>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="tablaSeleccionadosWrap" style="display:none;">
                                    <div class="form-section-label" style="text-transform: uppercase; font-weight: bold; border-bottom: 2px solid #002347; margin-bottom: 10px; padding-bottom: 5px; color: #002347;">
                                        <i class="fas fa-check-circle"></i> PRODUCTOS SELECCIONADOS
                                    </div>
                                    <div class="admin-table-wrap">
                                        <table class="admin-table" style="font-size: 0.9rem;">
                                            <thead>
                                                <tr style="background-color: #002347; color: white;">
                                                    <th style="text-transform: uppercase;">PRODUCTO</th>
                                                    <th style="text-transform: uppercase;">SKU</th>
                                                    <th style="text-align:center; text-transform: uppercase;">CANT.</th>
                                                    <th style="text-align:right; text-transform: uppercase;">P. COMPRA</th>
                                                    <th style="text-align:right; text-transform: uppercase;">SUBTOTAL</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="tablaSeleccionados"></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                    <div class="col-lg-4">
                        <div class="resumen-card mb-3" style="background-color: #002347; color: white; border-radius: 8px; padding: 20px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                            <div class="resumen-card-label" style="text-transform: uppercase; font-size: 0.8rem; font-weight: bold; letter-spacing: 1px; color: #a8b2bd; margin-bottom: 1.5rem;">RESUMEN DEL PEDIDO</div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span style="font-size: 0.9rem;">Folio</span>
                                <span style="font-family: monospace; font-weight: 700; color: #008C9E;"><?php echo $nuevoFolio; ?></span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span style="font-size: 0.9rem;">Proveedor</span>
                                <span id="resProveedor" style="font-weight: 600; text-align: right; max-width: 60%; font-size: 0.9rem;">—</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-3">
                                <span style="font-size: 0.9rem;">Productos</span>
                                <span id="resCantProductos" style="font-weight: 600; font-size: 0.9rem;">0</span>
                            </div>
                            
                            <div class="d-flex justify-content-between mb-4">
                                <span style="font-size: 0.9rem;">Unidades totales</span>
                                <span id="resUnidades" style="font-weight: 600; font-size: 0.9rem;">0</span>
                            </div>
                            
                            <hr style="border-color: rgba(255,255,255,0.1); margin-bottom: 1rem;">
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <span style="font-weight: 700; font-size: 1rem;">Total estimado</span>
                                <span class="resumen-total" id="resTotal" style="color: #00a8cc; font-size: 1.4rem; font-weight: 900;">$0.00</span>
                            </div>
                        </div>

                        <div class="mb-3">
                            <button type="submit" name="guardar_pedido" class="btn-enviar-pedido" style="width: 100%; background-color: #008C9E; color: white; border: none; padding: 14px; border-radius: 6px; font-weight: bold; transition: all 0.2s;">
                                <i class="fas fa-paper-plane me-2"></i> Enviar Solicitud al Proveedor
                            </button>
                        </div>

                        <div class="info-steps-card" style="background-color: #fffbeb; border: 1px solid #fde68a; border-radius: 8px; padding: 15px;">
                            <h5 style="color: #d97706; font-size: 1rem; margin-bottom: 12px; font-weight: bold;"><i class="fas fa-info-circle me-2"></i>¿Cómo funciona?</h5>
                            <ol style="margin-bottom: 0; padding-left: 18px; color: #92400e; font-size: 0.9rem; line-height: 1.6;">
                                <li>Selecciona proveedor.</li>
                                <li>Elige los productos y ajusta cantidades.</li>
                                <li>Envía la solicitud.</li>
                                <li>Se registrará en tu historial.</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="admin-tab-panel" id="tab-historial">
            <div class="report-form-card">
                <h5 class="page-header-title mb-4">
                    <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Solicitudes enviadas a proveedores
                </h5>
                
                <div class="d-flex gap-2 mb-3 align-items-center">
                    <input type="text" id="filtroTexto" class="form-control flex-grow-1" placeholder="Folio, proveedor, nota..." oninput="provReabasto_renderHistorial()">
                    <select id="filtroPaginacion" class="form-select" style="width: 80px;" onchange="provReabasto_cambiarPageSize()">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="999999">Todos</option>
                    </select>
                </div>

                <div class="table-page-info">
                            Número de registros por página: <span id="info-rows-per-page">5</span> &nbsp;|&nbsp; 
                            Página: <span id="info-current-page">1</span> de <span id="info-total-pages">3</span>
                        </div>

                <div class="admin-table-wrap mb-3">
                    <table class="admin-table">
                        <thead>
                            <tr style="background-color: #002347; color: white;">
                                <th style="text-transform: uppercase;">FOLIO</th>
                                <th style="text-transform: uppercase;">FECHA</th>
                                <th style="text-transform: uppercase;">PROVEEDOR</th>
                                <th style="text-transform: uppercase;">NOTA</th>
                                <th style="text-transform: uppercase;">TOTAL EST.</th>
                                <th style="text-transform: uppercase;">ESTADO</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tbHistorialJS">
                            <?php if(empty($solicitudes)): ?>
                                <tr id="no-results-row"><td colspan="8" class="text-center text-muted py-4">No se encontraron solicitudes.</td></tr>
                            <?php else: ?>
                                <?php foreach($solicitudes as $d): 
                                    $colorBadge = $d['estado'] === 'enviada' ? 'badge-enviada' : ($d['estado'] === 'respondida' ? 'badge-confirmada' : 'badge-cancelada');
                                    $txtEstado = ucfirst($d['estado']);
                                ?>
                                <tr>
                                    <td><span class="folio-badge"><?= $d['folio_solicitud'] ?></span></td>
                                    <td><?= $d['fecha_formato'] ?></td>
                                    <td><?= htmlspecialchars($d['proveedor_nombre']) ?></td>
                                    <td class="td-name" style="max-width:180px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;"><?= htmlspecialchars($d['observaciones'] ?: 'Sin observaciones') ?></td>
                                    <td style="font-weight:600;">$<?= number_format($d['total_estimado'], 2) ?></td>
                                    <td><span class="<?= $colorBadge ?>"><?= $txtEstado ?></span></td>
                                    <td style="text-align:center;">
                                        <button type="button" class="btn-tbl-edit" style="background:none; border:none; color:var(--btn-color); font-weight:bold;" onclick="provReabasto_verDetalle('<?= $d['folio_solicitud'] ?>')">
                                            <i class="fas fa-eye"></i> Ver
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </main>
</div>

<div class="modal-pedido-overlay" id="modalDetalleSoli" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div class="modal-pedido-box" style="background:#fff; width:90%; max-width:650px; border-radius:8px; overflow:hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);">
        <div class="modal-pedido-header" style="background:var(--dark-blue); color:white; padding:15px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-weight:bold; font-size:1.1rem;"><i class="fas fa-list-ul me-2"></i> Detalle de Solicitud <span id="lblModalFolio" style="color:#00a8cc;"></span></span>
            <button type="button" onclick="provReabasto_cerrarModal()" style="background:none; border:none; color:white; font-size:1.5rem; cursor:pointer; line-height:1;">&times;</button>
        </div>
        <div class="modal-pedido-body p-4">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr style="background-color: #002347; color: white;">
                            <th style="text-transform: uppercase;">PRODUCTO</th>
                            <th style="text-align:center; text-transform: uppercase;">CANT.</th>
                            <th style="text-align:right; text-transform: uppercase;">P. COMPRA</th>
                            <th style="text-align:right; text-transform: uppercase;">SUBTOTAL</th>
                        </tr>
                    </thead>
                    <tbody id="tbDetalleSoli"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php include('vista/admin/footer_admin.php'); ?>
<script>
document.addEventListener("DOMContentLoaded", () => {
    let tabActiva = localStorage.getItem('admin_reabasto_tab');
    if(tabActiva) {
        let btn = document.querySelector(`button[onclick*="provReabasto_cambiarTab('${tabActiva}'"]`);
        if(btn) provReabasto_cambiarTab(tabActiva, btn);
    }
});

function provReabasto_cambiarTab(id, btn) {
    document.querySelectorAll('.admin-tab-panel').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.admin-tab-btn').forEach(el => el.classList.remove('active'));
    document.getElementById('tab-' + id).classList.add('active');
    btn.classList.add('active');
    localStorage.setItem('admin_reabasto_tab', id);
}

function provReabasto_seleccionarProv(select) {
    if (!select) return;
    let opcion = select.options[select.selectedIndex];
    if (!opcion) return;

    let nombre = opcion.getAttribute('data-nombre');
    let elementoTexto = document.getElementById('resProveedor');
    
    if (elementoTexto) {
        elementoTexto.innerText = (nombre && select.value !== "") ? nombre : "—";
    }
}

let provReabasto_arraySeleccionados = [];

function provReabasto_filtrarCatalogo(texto) {
    texto = texto.toLowerCase();
    document.querySelectorAll('.picker-item').forEach(item => {
        let textContent = item.innerText.toLowerCase();
        item.style.display = textContent.includes(texto) ? 'flex' : 'none';
    });
}

function provReabasto_toggleProducto(id, elemento, event) {
    let checkbox = document.getElementById('chk-' + id);
    
    if (event && event.target.tagName !== 'INPUT') {
        checkbox.checked = !checkbox.checked;
    }
    
    if(checkbox.checked) {
        let existe = provReabasto_arraySeleccionados.find(p => p.id === id);
        if(!existe) {
            elemento.classList.add('selected');
            let nombre = document.getElementById('nom-' + id).innerText;
            let sku = document.getElementById('sku-' + id).innerText.replace('SKU: ', '').trim();
            let precio = parseFloat(elemento.querySelector('.picker-item-precio').getAttribute('data-precio') || 0);
            
            provReabasto_arraySeleccionados.push({ id: id, nombre: nombre, sku: sku, precio: precio, cantidad: 1 });
        }
    } else {
        elemento.classList.remove('selected');
        provReabasto_arraySeleccionados = provReabasto_arraySeleccionados.filter(p => p.id !== id);
    }
    provReabasto_renderTabla();
}

function provReabasto_actualizarCant(id, val) {
    let prod = provReabasto_arraySeleccionados.find(p => p.id === id);
    if(prod) {
        let nuevaCant = parseInt(val);
        if(isNaN(nuevaCant) || nuevaCant < 1) nuevaCant = 1;
        prod.cantidad = nuevaCant;
        provReabasto_renderTabla();
    }
}

function provReabasto_quitarProd(id) {
    let checkbox = document.getElementById('chk-' + id);
    if(checkbox) {
        checkbox.checked = false;
        let item = checkbox.closest('.picker-item');
        if(item) item.classList.remove('selected');
    }
    provReabasto_arraySeleccionados = provReabasto_arraySeleccionados.filter(p => p.id !== id);
    provReabasto_renderTabla();
}

function provReabasto_renderTabla() {
    let tbody = document.getElementById('tablaSeleccionados');
    let wrap = document.getElementById('tablaSeleccionadosWrap');
    
    if(provReabasto_arraySeleccionados.length === 0) {
        wrap.style.display = 'none';
        provReabasto_actualizarResumen();
        return;
    }
    
    wrap.style.display = 'block';
    let html = '';
    provReabasto_arraySeleccionados.forEach(p => {
        let subtotal = p.cantidad * p.precio;
        html += `
        <tr data-id="${p.id}">
            <td style="max-width:200px; white-space:normal; font-size:.85rem; font-weight:600;">${p.nombre}</td>
            <td style="font-size:.8rem; color:#666;">${p.sku}</td>
            <td style="text-align:center;">
                <input type="number" class="form-control form-control-sm text-center mx-auto" 
                       style="width:70px; border-radius:4px;" value="${p.cantidad}" min="1" 
                       onchange="provReabasto_actualizarCant('${p.id}', this.value)">
            </td>
            <td style="text-align:right;">$${p.precio.toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
            <td style="text-align:right; font-weight:bold; color:var(--dark-blue);">$${subtotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
            <td style="text-align:center;">
                <button type="button" class="btn btn-sm text-danger" style="background:none; border:none;" onclick="provReabasto_quitarProd('${p.id}')"><i class="fas fa-trash-alt"></i></button>
            </td>
        </tr>`;
    });
    tbody.innerHTML = html;
    provReabasto_actualizarResumen();
}

function provReabasto_actualizarResumen() {
    let cantTipos = provReabasto_arraySeleccionados.length;
    let unidades = provReabasto_arraySeleccionados.reduce((acc, p) => acc + parseInt(p.cantidad || 0), 0);
    let total = provReabasto_arraySeleccionados.reduce((acc, p) => acc + (parseInt(p.cantidad || 0) * parseFloat(p.precio || 0)), 0);
    
    let elCant = document.getElementById('resCantProductos');
    let elUni = document.getElementById('resUnidades');
    let elTot = document.getElementById('resTotal');

    if(elCant) elCant.innerText = cantTipos;
    if(elUni) elUni.innerText = unidades;
    if(elTot) elTot.innerText = "$" + total.toLocaleString('es-MX', {minimumFractionDigits: 2});
}

function provReabasto_prepararEnvio(e) {
    let proveedor = document.getElementById('selectProveedor').value;

    let arrayParaBack = provReabasto_arraySeleccionados.map(p => {
        return { id_producto: p.id, cantidad: p.cantidad };
    });

    document.getElementById('inputRfcProv').value = proveedor;
    document.getElementById('inputNota').value = document.getElementById('notaPedido').value;
    document.getElementById('inputProductosJson').value = JSON.stringify(arrayParaBack);
}

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('filtroTexto');
    const rowsPerPageSelect = document.getElementById('filtroPaginacion');
    const tbody = document.getElementById('tbHistorialJS');
    
    if (!tbody) return;
    const allRows = Array.from(tbody.querySelectorAll('tr')).filter(row => row.id !== 'no-results-row');
    const paginationControls = document.getElementById('botonesPaginacion');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages = document.getElementById('info-total-pages');

    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredRows = [...allRows];

    function renderTable() {
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === 'all' || rowsPerPage === 999999 ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
        
        if (infoRowsPerPage) infoRowsPerPage.textContent = rowsPerPage === 'all' || rowsPerPage === 999999 ? 'Todos' : rowsPerPage;
        if (infoCurrentPage) infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        if (infoTotalPages) infoTotalPages.textContent = totalPages;
        
        allRows.forEach(row => row.style.display = 'none');
        
        let noResultsRow = document.getElementById('no-results-row');
        
        if (totalRows > 0) {
            if(noResultsRow) noResultsRow.style.display = 'none';
            let start = 0;
            let end = totalRows;

            if (rowsPerPage !== 'all' && rowsPerPage !== 999999) {
                start = (currentPage - 1) * rowsPerPage;
                end = start + rowsPerPage;
            }

            for (let i = start; i < end && i < totalRows; i++) {
                filteredRows[i].style.display = ''; 
            }
        } else {
            if(!noResultsRow) {
                noResultsRow = document.createElement('tr');
                noResultsRow.id = 'no-results-row';
                noResultsRow.innerHTML = '<td colspan="8" class="text-center text-muted py-4">No se encontraron solicitudes.</td>';
                tbody.appendChild(noResultsRow);
            }
            noResultsRow.style.display = '';
        }

        renderPagination(totalPages);
    }

    function renderPagination(totalPages) {
        if (!paginationControls) return;
        
        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return; 
        }

        paginationControls.innerHTML = '<span class="page-info me-2" style="font-weight:500;">Página:</span>';
        
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left"></i>';
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
            btnNext.innerHTML = '<i class="fas fa-chevron-right"></i>';
            btnNext.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage++;
                renderTable();
            });
            paginationControls.appendChild(btnNext);
        }
    }

    function filterData() {
        const term = searchInput ? searchInput.value.toLowerCase() : '';
        const estadoFilter = document.getElementById('filtroEstado') ? document.getElementById('filtroEstado').value.toLowerCase() : '';
        
        filteredRows = allRows.filter(row => {
            const text = row.textContent.toLowerCase();
            let estadoMatch = true;
            if(estadoFilter !== "") {
               const badge = row.querySelector('span[class^="badge-"]');
               if(badge) {
                   estadoMatch = badge.textContent.toLowerCase().includes(estadoFilter);
               }
            }
            return text.includes(term) && estadoMatch;
        });

        currentPage = 1;
        renderTable();
    }

    if(searchInput) searchInput.addEventListener('input', filterData);
    
    const estadoSelect = document.getElementById('filtroEstado');
    if(estadoSelect) estadoSelect.addEventListener('change', filterData);
    
    if(rowsPerPageSelect) {
        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = this.value === 'all' || this.value === '999999' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
    }
    
    renderTable();
});

function provReabasto_verDetalle(folio) {
    document.getElementById('lblModalFolio').innerText = folio;
    document.getElementById('tbDetalleSoli').innerHTML = '<tr><td colspan="4" class="text-center py-4"><i class="fas fa-spinner fa-spin me-2"></i>Cargando...</td></tr>';
    document.getElementById('modalDetalleSoli').style.display = 'flex';

    fetch(`/proyectoweb/admin/pedido-proveedor?obtener_detalle=1&folio=${folio}`)
    .then(res => res.json())
    .then(data => {
        let html = '';
        let granTotal = 0;
        data.forEach(p => {
            granTotal += parseFloat(p.subtotal);
            html += `<tr>
                <td style="font-size:.85rem; font-weight:600;">${p.nombre}</td>
                <td style="text-align:center">${p.cantidad_pedida}</td>
                <td style="text-align:right">$${Number(p.precio_compra).toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
                <td style="text-align:right; font-weight:bold; color:var(--dark-blue);">$${Number(p.subtotal).toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
            </tr>`;
        });
        
        html += `
            <tr style="background:#f8fafc;">
                <td colspan="3" style="text-align:right; font-weight:bold; text-transform: uppercase;">Total de la solicitud:</td>
                <td style="text-align:right; font-weight:900; font-size:1.1rem; color:#cc0000;">$${granTotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
            </tr>
        `;
        document.getElementById('tbDetalleSoli').innerHTML = html;
    })
    .catch(err => {
        document.getElementById('tbDetalleSoli').innerHTML = '<tr><td colspan="4" class="text-center text-danger py-4">Error al cargar detalles.</td></tr>';
    });
}

function provReabasto_cerrarModal() { 
    document.getElementById('modalDetalleSoli').style.display = 'none'; 
}
</script>