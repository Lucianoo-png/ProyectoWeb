/* ════════════════════════════════════════════════════════════
   LuchanosCorp — Scripts Panel Admin + Vendedor + Repartidor
   Ruta: js/vendedor.js
   ════════════════════════════════════════════════════════════ */

/* ════════════════════════════════════════════════════════════
   UTILIDADES GLOBALES
   ════════════════════════════════════════════════════════════ */

/** Formatea número como moneda MXN: $1,234.56 */
function fmt(n) {
    return '$' + parseFloat(n).toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

/* ════════════════════════════════════════════════════════════
   ADMIN — Funciones Generales
   ════════════════════════════════════════════════════════════ */

function previewImagen(input) {
    const label = document.getElementById('imagen-label');
    const preview = document.getElementById('img-preview');
    if (!input.files || !input.files[0]) return;
    if (label) label.textContent = input.files[0].name;
    const reader = new FileReader();
    reader.onload = e => {
        if (preview) { 
            preview.src = e.target.result; 
            preview.style.display = 'block'; 
        }
    };
    reader.readAsDataURL(input.files[0]);
}

/* Toggle de estado activo/inactivo */
function initToggleEstado() {
    const toggle = document.getElementById('estado');
    const label = document.getElementById('estadoLabel');
    if (!toggle || !label) return;
    toggle.addEventListener('change', function () {
        label.textContent = this.checked ? 'Activo' : 'Inactivo';
    });
}

/* Validación de formulario */
function initAdminFormValidation() {
    const form = document.querySelector('.needs-validation');
    if (!form) return;
    form.addEventListener('submit', e => {
        const pw = document.getElementById('contrasena');
        const cpw = document.getElementById('confirmar');
        const fb = document.getElementById('confirmar-feedback');
        if (pw && cpw) {
            if (pw.value !== cpw.value) {
                cpw.setCustomValidity('No coinciden');
                if (fb) fb.textContent = 'Las contraseñas no coinciden.';
            } else {
                cpw.setCustomValidity('');
            }
        }
        if (!form.checkValidity()) { e.preventDefault(); e.stopPropagation(); }
        form.classList.add('was-validated');
    }, false);
    const confirmar = document.getElementById('confirmar');
    if (confirmar) confirmar.addEventListener('input', () => confirmar.setCustomValidity(''));
}

/* Tabs del panel admin */
function initAdminTabs() {
    document.querySelectorAll('.admin-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const group = this.closest('[data-tab-group]')?.dataset.tabGroup || 'default';
            document.querySelectorAll(`.admin-tab-btn[data-tab-group="${group}"]`).forEach(b => b.classList.remove('active'));
            document.querySelectorAll(`.admin-tab-panel[data-tab-group="${group}"]`).forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const target = document.getElementById(this.dataset.target);
            if (target) target.classList.add('active');
        });
    });
}

/* Modal de confirmación de eliminación */
function confirmDelete(type, name, id) {
    const overlay = document.getElementById('confirmOverlay');
    const msgEl = document.getElementById('confirmMsg');
    const yesBtn = document.getElementById('confirmYes');
    if (!overlay || !msgEl || !yesBtn) return;
    const labels = { producto: 'el producto', usuario: 'el usuario', personal: 'al personal' };
    msgEl.textContent = `¿Estás seguro de eliminar ${labels[type] || 'el registro'} "${name}"?`;
    overlay.classList.add('show');
    const newBtn = yesBtn.cloneNode(true);
    yesBtn.parentNode.replaceChild(newBtn, yesBtn);
    newBtn.addEventListener('click', function () {
        overlay.classList.remove('show');
    });
}

function closeConfirm() {
    const overlay = document.getElementById('confirmOverlay');
    if (overlay) overlay.classList.remove('show');
}

/* Tabs de reportes */
function initReportTabs() {
    document.querySelectorAll('.report-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            document.querySelectorAll('.report-tab-btn').forEach(b => b.classList.remove('active'));
            document.querySelectorAll('.report-tab-panel').forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const target = document.getElementById(this.dataset.target);
            if (target) target.classList.add('active');
        });
    });
}

/* ════════════════════════════════════════════════════════════
   VENDEDOR — Punto de Venta (ventas.php)
   ════════════════════════════════════════════════════════════ */

let ventaItems = [];
let ventaCounter = 0;

function initVentas() {
    const form = document.getElementById('formAgregarProducto');
    if (!form) return;
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const sel = document.getElementById('selectProducto');
        const qty = parseInt(document.getElementById('inputCantidad').value) || 1;
        if (!sel.value) {
            sel.classList.add('is-invalid');
            return;
        }
        sel.classList.remove('is-invalid');
        const precio = parseFloat(sel.options[sel.selectedIndex].dataset.precio);
        const sku = sel.value;
        const nombre = sel.options[sel.selectedIndex].text.split(' (')[0];
        const exist = ventaItems.find(i => i.sku === sku);
        if (exist) {
            exist.qty += qty;
        } else {
            ventaCounter++;
            ventaItems.push({ id: ventaCounter, sku, nombre, precio, qty });
        }
        renderTablaVenta();
        sel.selectedIndex = 0;
        document.getElementById('inputCantidad').value = 1;
    });
}

function renderTablaVenta() {
    const tbody = document.getElementById('tbodyVenta');
    const secPago = document.getElementById('seccionPago');
    if (!tbody) return;
    if (ventaItems.length === 0) {
        tbody.innerHTML = `
            <tr id="tr-vacio">
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="fas fa-shopping-cart me-2"></i>Aún no se han agregado productos a la venta.
                </td>
            </tr>`;
        if (secPago) secPago.classList.add('js-hidden');
        return;
    }
    tbody.innerHTML = ventaItems.map((item, idx) => `
        <tr>
            <td>${idx + 1}</td>
            <td style="font-family:monospace;font-weight:700">${item.sku}</td>
            <td>${item.nombre}</td>
            <td>${item.qty}</td>
            <td>${fmt(item.precio)}</td>
            <td style="font-weight:700;color:var(--azul-marino)">${fmt(item.precio * item.qty)}</td>
            <td>
                <button class="btn-tbl-danger" onclick="eliminarFilaVenta(${item.id})">
                    <i class="fas fa-trash"></i>
                </button>
            </td>
        </tr>`).join('');
    if (secPago) secPago.classList.remove('js-hidden');
    actualizarTotalesVenta();
}

function eliminarFilaVenta(id) {
    ventaItems = ventaItems.filter(i => i.id !== id);
    renderTablaVenta();
}

function actualizarTotalesVenta() {
    const sub = ventaItems.reduce((s, i) => s + i.precio * i.qty, 0);
    const iva = sub * 0.16;
    const el = (id) => document.getElementById(id);
    if (el('lblSubtotal')) el('lblSubtotal').textContent = fmt(sub);
    if (el('lblIva')) el('lblIva').textContent = fmt(iva);
    if (el('lblTotal')) el('lblTotal').textContent = fmt(sub + iva);
}

function calcularCambio() {
    const sub = ventaItems.reduce((s, i) => s + i.precio * i.qty, 0);
    const total = sub * 1.16;
    const rec = parseFloat(document.getElementById('inputRecibido')?.value) || 0;
    const campo = document.getElementById('inputCambio');
    if (!campo) return;
    const cambio = rec - total;
    campo.value = cambio >= 0 ? fmt(cambio) : '⚠ Monto insuficiente';
    campo.style.color = cambio >= 0 ? '#065f46' : '#dc3545';
}

function registrarVenta() {
    if (ventaItems.length === 0) {
        alert('Agrega al menos un producto a la venta.');
        return;
    }
    const cliente = document.getElementById('clienteValor')?.value ||
        document.getElementById('selectCliente')?.value ||
        'En mostrador';
    const pago = document.getElementById('selectPago')?.value || 'Efectivo';
    const total = (ventaItems.reduce((s, i) => s + i.precio * i.qty, 0) * 1.16)
        .toLocaleString('es-MX', { minimumFractionDigits: 2 });
    alert(`✅ Venta registrada exitosamente.\n\nCliente: ${cliente}\nPago: ${pago}\nTotal: $${total}\n\nSe puede imprimir el ticket.`);
    ventaItems = [];
    renderTablaVenta();
    const inp = document.getElementById('inputRecibido');
    const cam = document.getElementById('inputCambio');
    if (inp) inp.value = '';
    if (cam) { cam.value = ''; cam.style.color = ''; }
}

/* Widget de búsqueda de cliente */
const CLIENTES_REGISTRADOS = [
    { id: 'C001', nombre: 'Ana Torres Vega' },
    { id: 'C002', nombre: 'Luis Ramírez' },
    { id: 'C003', nombre: 'Roberto Méndez' },
    { id: 'C004', nombre: 'Claudia Soto' },
    { id: 'C005', nombre: 'Juan Pérez' },
    { id: 'C006', nombre: 'María García' },
];

function initClienteWidget() {
    const input = document.getElementById('clienteInput');
    const dropdown = document.getElementById('clienteDropdown');
    const pill = document.getElementById('clienteSeleccionado');
    const pillNombre = document.getElementById('clientePillNombre');
    const btnCambiar = document.getElementById('btnCambiarCliente');
    const hidden = document.getElementById('clienteValor');
    if (!input) return;

    function renderDropdown(q) {
        dropdown.innerHTML = '';
        const texto = q.trim().toLowerCase();
        const coincidentes = CLIENTES_REGISTRADOS.filter(c =>
            c.nombre.toLowerCase().includes(texto) ||
            c.id.toLowerCase().includes(texto)
        );
        if (coincidentes.length > 0) {
            const g = document.createElement('div');
            g.className = 'cliente-option-group';
            g.textContent = 'Clientes registrados';
            dropdown.appendChild(g);
            coincidentes.forEach(c => {
                const opt = document.createElement('div');
                opt.className = 'cliente-option';
                opt.innerHTML = `<i class="fas fa-user"></i>
                    <span>${resaltar(c.nombre, texto)}</span>
                    <span style="margin-left:auto;font-size:.72rem;color:#aaa">${c.id}</span>`;
                opt.addEventListener('mousedown', e => {
                    e.preventDefault();
                    seleccionarCliente(c.nombre, false);
                });
                dropdown.appendChild(opt);
            });
        }
        if (texto.length >= 2) {
            const g2 = document.createElement('div');
            g2.className = 'cliente-option-group';
            g2.textContent = 'O continuar con:';
            dropdown.appendChild(g2);
            const libre = document.createElement('div');
            libre.className = 'cliente-option option-nuevo';
            libre.innerHTML = `<i class="fas fa-user-plus"></i>
                <span>Usar "<strong>${escHTML(q.trim())}</strong>" como nombre</span>`;
            libre.addEventListener('mousedown', e => {
                e.preventDefault();
                seleccionarCliente(q.trim(), true);
            });
            dropdown.appendChild(libre);
        }
        if (texto === '') {
            const g0 = document.createElement('div');
            g0.className = 'cliente-option-group';
            g0.textContent = 'Clientes registrados';
            dropdown.appendChild(g0);
            CLIENTES_REGISTRADOS.forEach(c => {
                const opt = document.createElement('div');
                opt.className = 'cliente-option';
                opt.innerHTML = `<i class="fas fa-user"></i>
                    <span>${c.nombre}</span>
                    <span style="margin-left:auto;font-size:.72rem;color:#aaa">${c.id}</span>`;
                opt.addEventListener('mousedown', e => {
                    e.preventDefault();
                    seleccionarCliente(c.nombre, false);
                });
                dropdown.appendChild(opt);
            });
        }
    }

    function seleccionarCliente(nombre, esNuevo) {
        hidden.value = nombre;
        let html = `<i class="fas fa-${esNuevo ? 'user-plus' : 'user'}"></i>
                    <span>${escHTML(nombre)}</span>`;
        if (esNuevo) html += `<span class="badge-nuevo-cliente">Nuevo</span>`;
        pillNombre.innerHTML = html;
        pill.classList.add('visible');
        input.style.display = 'none';
        dropdown.classList.remove('open');
    }

    function resaltar(texto, q) {
        if (!q) return escHTML(texto);
        const re = new RegExp(`(${escRE(q)})`, 'gi');
        return escHTML(texto).replace(re, '<strong>$1</strong>');
    }

    function escHTML(s) {
        return s.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function escRE(s) {
        return s.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    input.addEventListener('focus', () => {
        renderDropdown(input.value);
        dropdown.classList.add('open');
    });
    input.addEventListener('input', () => {
        renderDropdown(input.value);
        dropdown.classList.add('open');
    });
    input.addEventListener('blur', () => {
        setTimeout(() => {
            dropdown.classList.remove('open');
        }, 180);
    });
    btnCambiar.addEventListener('click', () => {
        hidden.value = '';
        pill.classList.remove('visible');
        input.style.display = '';
        input.value = '';
        input.focus();
    });
}

/* ════════════════════════════════════════════════════════════
   VENDEDOR — Detalle de Ventas (detalle_ventas.php)
   ════════════════════════════════════════════════════════════ */

const VENTAS_DEMO = [
    { folio: 1, fecha: '21/03/2026', hora: '10:23:51', cliente: 'Ana Torres', sku: 'WRS315SNHM', desc: 'Refrigerador Side by Side 25 pies', qty: 1, precio: 22499, pago: 'Tarjeta' },
    { folio: 1, fecha: '21/03/2026', hora: '10:23:51', cliente: 'Ana Torres', sku: 'WM3911D', desc: 'Microondas AirFry 4 en 1', qty: 2, precio: 4599, pago: 'Tarjeta' },
    { folio: 2, fecha: '20/03/2026', hora: '14:05:30', cliente: 'Luis Ramírez', sku: '8MWTW2024WJM', desc: 'Lavadora 20kg Carga Superior', qty: 1, precio: 9999, pago: 'Efectivo' },
    { folio: 3, fecha: '20/03/2026', hora: '16:40:12', cliente: 'Roberto Méndez', sku: 'MGH765RDS', desc: 'Estufa 6 quemadores convección', qty: 1, precio: 9799, pago: 'Crédito' },
    { folio: 4, fecha: '19/03/2026', hora: '09:55:00', cliente: 'Claudia Soto', sku: 'LG-WM3500CW', desc: 'Lavadora LG 22kg TurboWash', qty: 1, precio: 11499, pago: 'Transferencia' },
];

function renderDetalleVentas(data) {
    const tbody = document.getElementById('tbodyDetalle');
    if (!tbody) return;
    const rows = data || VENTAS_DEMO;
    if (rows.length === 0) {
        tbody.innerHTML = `<tr><td colspan="10" class="text-center text-muted py-4">No se encontraron ventas.</td></tr>`;
        return;
    }
    tbody.innerHTML = rows.map((v, i) => `
        <tr>
            <td>${i + 1}</td>
            <td style="font-weight:700">${v.folio}</td>
            <td>${v.fecha}</td>
            <td>${v.hora}</td>
            <td class="td-name">${v.cliente}</td>
            <td>
                <code style="font-size:.75rem">${v.sku}</code><br>
                <span style="font-size:.75rem;color:#666">${v.desc}</span>
            </td>
            <td style="text-align:center">${v.qty} × ${fmt(v.precio)}</td>
            <td style="font-weight:700;color:var(--azul-marino)">${fmt(v.qty * v.precio)}</td>
            <td>${v.pago}</td>
            <td>
                <button class="btn-ticket" onclick="generarTicket(${v.folio})">
                    <i class="fas fa-print me-1"></i>Ticket
                </button>
            </td>
        </tr>`).join('');
}

function filtrarVentas() {
    const folio = document.getElementById('fFolio')?.value.trim() || '';
    const desde = document.getElementById('fDesde')?.value || '';
    const hasta = document.getElementById('fHasta')?.value || '';
    const cliente = document.getElementById('fCliente')?.value.trim().toLowerCase() || '';
    let resultado = VENTAS_DEMO;
    if (folio) resultado = resultado.filter(v => String(v.folio) === folio);
    if (desde) resultado = resultado.filter(v => convertirFecha(v.fecha) >= desde);
    if (hasta) resultado = resultado.filter(v => convertirFecha(v.fecha) <= hasta);
    if (cliente) resultado = resultado.filter(v => v.cliente.toLowerCase().includes(cliente));
    const el = document.getElementById('totalRegistros');
    if (el) el.textContent = resultado.length;
    renderDetalleVentas(resultado);
}

function convertirFecha(str) {
    if (!str) return '';
    if (str.includes('-')) {
        const [y, m, d] = str.split('-');
        return `${d}/${m}/${y}`;
    }
    const [d, m, y] = str.split('/');
    return `${y}-${m}-${d}`;
}

function generarTicket(folio) {
    alert(`🖨️ Generando ticket para el Folio #${folio}...\n\n(En producción descargará el PDF del ticket de venta.)`);
}

/* ════════════════════════════════════════════════════════════
   VENDEDOR — Inventario (inventario.php)
   ════════════════════════════════════════════════════════════ */

const INVENTARIO_DEMO = [
    { sku: 'WM3911D', nombre: 'Microondas AirFry 4 en 1 (1CuFt)', marca: 'Whirlpool', categoria: 'Cocina', precio: 4599, stock: 45 },
    { sku: '8MWTW2024WJM', nombre: 'Lavadora 20kg Carga Superior Agitador', marca: 'Whirlpool', categoria: 'Lavado', precio: 9999, stock: 18 },
    { sku: 'WK0260B', nombre: 'Despachador de agua con fábrica de hielo', marca: 'Whirlpool', categoria: 'Refrigeración', precio: 7999, stock: 7 },
    { sku: 'WRS315SNHM', nombre: 'Refrigerador Side by Side 25 pies', marca: 'Whirlpool', categoria: 'Refrigeración', precio: 22499, stock: 4 },
    { sku: 'MGH765RDS', nombre: 'Estufa 6 quemadores con convección', marca: 'Whirlpool', categoria: 'Cocina', precio: 9799, stock: 12 },
    { sku: 'LG-WM3500CW', nombre: 'Lavadora LG 22kg TurboWash 360', marca: 'LG', categoria: 'Lavado', precio: 11499, stock: 0 },
    { sku: 'SAM-RF28T', nombre: 'Refrigerador Samsung French Door 28 pies', marca: 'Samsung', categoria: 'Refrigeración', precio: 28999, stock: 3 },
];

function renderInventario(data) {
    const tbody = document.getElementById('tbodyInventario');
    if (!tbody) return;
    const rows = data || INVENTARIO_DEMO;
    tbody.innerHTML = rows.map((p, i) => {
        let badge, obs, color;
        if (p.stock === 0) {
            badge = '<span class="badge-out">Agotado</span>';
            obs = 'No disponible para venta';
            color = '#dc3545';
        } else if (p.stock <= 5) {
            badge = '<span class="badge-warn">Bajo stock</span>';
            obs = 'Próximo a agotarse — Reabastecer';
            color = '#d97706';
        } else {
            badge = '<span class="badge-activo">Disponible</span>';
            obs = 'Disponible para venta';
            color = '#065f46';
        }
        return `
            <tr>
                <td>${i + 1}</td>
                <td><code style="font-size:.8rem">${p.sku}</code></td>
                <td style="text-align:left">
                    <div class="inv-title">${p.nombre}</div>
                    <div class="inv-sub">${p.marca} · ${p.categoria}</div>
                </td>
                <td>${p.categoria}</td>
                <td style="font-weight:800;color:${color}">${p.stock}</td>
                <td>${badge}</td>
                <td style="font-size:.78rem;color:#666">${obs}</td>
            </tr>`;
    }).join('');
}

function filtrarInventario() {
    const q = document.getElementById('invBuscar')?.value.toLowerCase() || '';
    const cat = document.getElementById('invCat')?.value || '';
    const resultado = INVENTARIO_DEMO.filter(p =>
        (!q || p.nombre.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)) &&
        (!cat || p.categoria === cat)
    );
    renderInventario(resultado);
}

/* ════════════════════════════════════════════════════════════
   VENDEDOR — Catálogo (catalogo.php)
   ════════════════════════════════════════════════════════════ */

function renderCatalogo(data) {
    const grid = document.getElementById('catalogoGrid');
    if (!grid) return;
    const rows = data || INVENTARIO_DEMO;
    if (rows.length === 0) {
        grid.innerHTML = `<p class="text-muted text-center py-4">No se encontraron productos.</p>`;
        return;
    }
    grid.innerHTML = rows.map(p => {
        let stockEl;
        if (p.stock === 0) stockEl = `<span class="cat-stock-out">✕ Agotado</span>`;
        else if (p.stock <= 5) stockEl = `<span class="cat-stock-low">⚠ Últimas ${p.stock} unidades</span>`;
        else stockEl = `<span class="cat-stock-ok">✓ En stock</span>`;
        return `
            <div class="cat-card">
                <div class="cat-img">
                    <img src="../../multimedia/Imagenes/productos/${p.sku.toLowerCase()}.jpg"
                         onerror="this.src='https://placehold.co/220x150/e8f4fb/002366?text=${encodeURIComponent(p.sku)}'"
                         alt="${p.nombre}">
                </div>
                <div class="cat-body">
                    <div class="cat-sku">${p.sku}</div>
                    <div class="cat-name">${p.nombre}</div>
                    <div class="cat-brand">${p.marca}</div>
                    <div class="cat-cat">${p.categoria}</div>
                    <div class="cat-price">${fmt(p.precio)}</div>
                    ${stockEl}
                </div>
            </div>`;
    }).join('');
}

function filtrarCatalogo() {
    const q = document.getElementById('catBuscar')?.value.toLowerCase() || '';
    const cat = document.getElementById('catCategoria')?.value || '';
    const precio = document.getElementById('catPrecio')?.value || '';
    let resultado = INVENTARIO_DEMO.filter(p =>
        (!q || p.nombre.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)) &&
        (!cat || p.categoria === cat)
    );
    if (precio === '0-5000') resultado = resultado.filter(p => p.precio < 5000);
    else if (precio === '5000-15000') resultado = resultado.filter(p => p.precio >= 5000 && p.precio <= 15000);
    else if (precio === '15000+') resultado = resultado.filter(p => p.precio > 15000);
    renderCatalogo(resultado);
}

/* ════════════════════════════════════════════════════════════
   VENDEDOR — Solicitudes (solicitudes.php)
   ════════════════════════════════════════════════════════════ */

function initSolicitudesModal() {
    const overlay = document.getElementById('modalSolicitud');
    const btnCerrar = document.getElementById('btnCerrarModal');
    const btnCancelar = document.getElementById('btnCancelarSol');
    const btnGuardar = document.getElementById('btnGuardarSol');
    if (!overlay) return;

    document.querySelectorAll('.js-atender').forEach(btn => {
        btn.addEventListener('click', function () {
            const sol = JSON.parse(this.dataset.sol);
            document.getElementById('modal-ref').textContent = sol.ref || '—';
            document.getElementById('modal-cliente').textContent = sol.cliente || '—';
            document.getElementById('modal-tipo').textContent = sol.tipo || '—';
            document.getElementById('modal-fecha').textContent = sol.fecha || '—';
            document.getElementById('modal-asunto').textContent = sol.asunto || '—';
            document.getElementById('modal-desc').textContent = sol.desc || '—';
            document.getElementById('modal-evidencia').textContent = sol.evidencia || 'Sin adjunto';
            document.getElementById('modal-respuesta').value = '';
            document.getElementById('modal-estado').value = 'en_proceso';
            overlay.classList.add('show');
        });
    });

    const cerrar = () => overlay.classList.remove('show');
    if (btnCerrar) btnCerrar.addEventListener('click', cerrar);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrar);
    overlay.addEventListener('click', e => { if (e.target === overlay) cerrar(); });

    if (btnGuardar) {
        btnGuardar.addEventListener('click', function () {
            const respuesta = document.getElementById('modal-respuesta').value.trim();
            if (!respuesta) {
                alert('Por favor escribe una respuesta o resolución.');
                return;
            }
            const estado = document.getElementById('modal-estado').value;
            alert(`✅ Solicitud actualizada.\nEstado: ${estado}\n\n(En producción se guardará en la base de datos.)`);
            cerrar();
        });
    }
}

function filtrarSolicitudes() {
    const activePanel = document.querySelector('.admin-tab-panel.active');
    if (!activePanel) return;
    const q = (activePanel.querySelector('.sol-filter-input')?.value || '').toLowerCase().trim();
    const tipo = (activePanel.querySelector('.sol-filter-select')?.value || '').toLowerCase().trim();
    const filas = activePanel.querySelectorAll('tbody tr');
    let visibles = 0;
    filas.forEach(tr => {
        const texto = tr.textContent.toLowerCase();
        const tipoCell = tr.cells[4]?.textContent.toLowerCase() || '';
        const matchQ = !q || texto.includes(q);
        const matchTipo = !tipo || tipoCell.includes(tipo);
        const mostrar = matchQ && matchTipo;
        tr.style.display = mostrar ? '' : 'none';
        if (mostrar) visibles++;
    });
    const counter = activePanel.querySelector('.table-toolbar-count span');
    if (counter) counter.textContent = visibles;
}

function enviarNuevaSolicitud() {
    const cliente = document.getElementById('nCliente')?.value;
    const tipo = document.getElementById('nTipo')?.value;
    const asunto = document.getElementById('nAsunto')?.value.trim();
    const desc = document.getElementById('nDesc')?.value.trim();
    if (!cliente || !tipo || !asunto || !desc) {
        alert('Por favor completa todos los campos obligatorios (Cliente, Tipo, Asunto y Descripción).');
        return;
    }
    alert('✅ Solicitud registrada exitosamente.\n\nSe ha generado un número de referencia y se notificará al cliente.');
    document.getElementById('nCliente').value = '';
    document.getElementById('nTipo').value = '';
    document.getElementById('nAsunto').value = '';
    document.getElementById('nDesc').value = '';
}

/* ════════════════════════════════════════════════════════════
   REPARTIDOR — Funciones del Panel de Entregas
   ════════════════════════════════════════════════════════════ */

const ESTADOS_REPARTIDOR = [
    { label: 'Pedido recibido',  icon: 'fa-inbox',              badge: 'badge-recibido'   },
    { label: 'En preparación',   icon: 'fa-box-open',           badge: 'badge-preparando' },
    { label: 'Salió a ruta',     icon: 'fa-truck',              badge: 'badge-ruta'       },
    { label: 'Entregado',        icon: 'fa-home',               badge: 'badge-entregado'  },
    { label: 'Problema',         icon: 'fa-exclamation-triangle',badge: 'badge-problema'  }
];

let estadoRepartidorActual = 2; // Salió a ruta
let histFiltrado = [];
let histPagina = 1;
const HIST_POR_PAG = 5;

// Datos demo para historial
const HISTORIAL_REPARTIDOR = [
    { folio:'LC-2026-0038', cliente:'Carlos Ivan Luciano Cruz', producto:'Microondas AirFry 4 en 1', asignado:'22/03/2026', entrega:'—', total:'$4,599.00', estado:'Salió a ruta', mes:'marzo' },
    { folio:'LC-2026-0035', cliente:'María Fernández López', producto:'Refrigerador NoFrost 18 pi', asignado:'18/03/2026', entrega:'19/03/2026', total:'$9,299.00', estado:'Entregado', mes:'marzo' },
    { folio:'LC-2026-0031', cliente:'Roberto Sánchez Gómez', producto:'Lavadora Automática 17 kg', asignado:'12/03/2026', entrega:'13/03/2026', total:'$7,499.00', estado:'Entregado', mes:'marzo' },
    { folio:'LC-2026-0027', cliente:'Ana Paula Torres Ríos', producto:'Smart TV 55" 4K UHD', asignado:'05/03/2026', entrega:'06/03/2026', total:'$11,999.00', estado:'Entregado', mes:'marzo' },
    { folio:'LC-2026-0024', cliente:'Pedro Martínez Vega', producto:'Aire Acondicionado 18000 BTU', asignado:'28/02/2026', entrega:'—', total:'$8,799.00', estado:'Problema', mes:'febrero' },
    { folio:'LC-2026-0020', cliente:'Sofía Ramírez Castro', producto:'Lavavajillas 12 servicios', asignado:'20/02/2026', entrega:'21/02/2026', total:'$5,299.00', estado:'Entregado', mes:'febrero' },
    { folio:'LC-2026-0014', cliente:'Jorge Luis Herrera Paz', producto:'Horno de Convección 60 cm', asignado:'10/01/2026', entrega:'11/01/2026', total:'$6,149.00', estado:'Entregado', mes:'enero' },
    { folio:'LC-2026-0008', cliente:'Laura González Méndez', producto:'Freidora de Aire XL 6.5L', asignado:'04/01/2026', entrega:'05/01/2026', total:'$2,899.00', estado:'Entregado', mes:'enero' }
];

/* Toast del repartidor */
function mostrarToastRepartidor(msg, color) {
    const t = document.getElementById('repToast');
    if(!t) return;
    document.getElementById('repToastMsg').textContent = msg;
    t.style.background = color || '#065f46';
    t.style.display = 'flex';          /* forzar flex antes de animar */
    requestAnimationFrame(() => {
        t.classList.add('show');
    });
    clearTimeout(t._timer);
    t._timer = setTimeout(() => {
        t.classList.remove('show');
        setTimeout(() => { t.style.display = 'none'; }, 270);
    }, 3200);
}

/* Tabs del repartidor */
function switchTab(tabId, btnEl) {
    document.querySelectorAll('.rep-nav-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.rep-nav-btn, .admin-sidebar .nav-link').forEach(b => b.classList.remove('active'));

    const panel = document.getElementById(tabId);
    if (panel) panel.classList.add('active');

    const navBtnId = 'btn-' + tabId;
    const navBtn = document.getElementById(navBtnId);
    if (navBtn) navBtn.classList.add('active');

    if (btnEl) btnEl.classList.add('active');
    else {
        document.querySelectorAll('.admin-sidebar .nav-link').forEach(b => {
            if (b.getAttribute('onclick') && b.getAttribute('onclick').includes(tabId))
                b.classList.add('active');
        });
    }
}

/* Notificación */
function cerrarNotif() {
    const n = document.getElementById('notifAdminBox');
    if(!n) return;
    n.style.opacity = '0';
    n.style.transform = 'translateY(-10px)';
    n.style.transition = 'all .3s ease';
    setTimeout(() => n.style.display = 'none', 300);
}

/* Tracking visual */
function renderTrackingRepartidor() {
    const totalSteps = ESTADOS_REPARTIDOR.length;
    for (let i = 0; i < totalSteps; i++) {
        const step = document.getElementById('rStep' + i);
        const line = document.getElementById('rLine' + i);
        if (!step) continue;

        const e = ESTADOS_REPARTIDOR[i];
        step.className = 'rep-step';
        if (estadoRepartidorActual === 4 && i === 4) step.classList.add('problema');
        else if (i < estadoRepartidorActual) step.classList.add('done');
        else if (i === estadoRepartidorActual) step.classList.add('current');

        const circle = step.querySelector('.rep-step-circle');
        if (i < estadoRepartidorActual && estadoRepartidorActual !== 4) {
            circle.innerHTML = '<i class="fas fa-check"></i>';
        } else {
            circle.innerHTML = `<i class="fas ${e.icon}"></i>`;
        }

        if (line) {
            line.className = 'rep-line';
            if (i < estadoRepartidorActual && estadoRepartidorActual !== 4) line.classList.add('done');
        }
    }

    const badge = document.getElementById('badgeEstado');
    if (badge) {
        badge.textContent = ESTADOS_REPARTIDOR[estadoRepartidorActual].label;
        badge.className = `badge-estado ${ESTADOS_REPARTIDOR[estadoRepartidorActual].badge}`;
    }

    const lbl = document.getElementById('lblEstadoActual');
    if (lbl) lbl.textContent = ESTADOS_REPARTIDOR[estadoRepartidorActual].label;

    const sel = document.getElementById('selectorEstado');
    if (sel) sel.value = estadoRepartidorActual;
}

function previsualizarEstado() {
    const sel = document.getElementById('selectorEstado');
    const lbl = document.getElementById('lblSigEstado');
    if (!sel || !lbl) return;
    const nuevo = parseInt(sel.value);
    if (nuevo === estadoRepartidorActual) {
        lbl.textContent = 'Sin cambios';
    } else {
        lbl.innerHTML = `Cambiar a: <strong>${ESTADOS_REPARTIDOR[nuevo].label}</strong>`;
    }
}

function guardarEstado() {
    const sel = document.getElementById('selectorEstado');
    if(!sel) return;
    const nuevo = parseInt(sel.value);
    if (nuevo === estadoRepartidorActual) {
        mostrarToastRepartidor('Ya está en ese estado.', '#6c757d');
        return;
    }

    if (nuevo === 3) {
        const confirmBox = document.getElementById('confirmEntregaBox');
        if(confirmBox) {
            confirmBox.style.display = 'block';
            confirmBox.scrollIntoView({ behavior: 'smooth' });
        }
        return;
    }

    estadoRepartidorActual = nuevo;
    renderTrackingRepartidor();
    mostrarToastRepartidor(`✅ Estado actualizado a: "${ESTADOS_REPARTIDOR[estadoRepartidorActual].label}"`);
    
    const lblSig = document.getElementById('lblSigEstado');
    if(lblSig) lblSig.textContent = 'Selecciona el nuevo estado y guarda';

    if (estadoRepartidorActual === 3) {
        const badgeSidebar = document.getElementById('badgeSidebar');
        if(badgeSidebar) badgeSidebar.style.display = 'none';
    }
}

function confirmarEntrega() {
    const receptor = document.getElementById('receptorNombre')?.value.trim();
    if (!receptor) {
        mostrarToastRepartidor('Escribe el nombre de quien recibió.', '#dc3545');
        return;
    }
    estadoRepartidorActual = 3;
    renderTrackingRepartidor();
    const confirmBox = document.getElementById('confirmEntregaBox');
    if(confirmBox) confirmBox.style.display = 'none';
    
    const badgeSidebar = document.getElementById('badgeSidebar');
    if(badgeSidebar) badgeSidebar.style.display = 'none';
    
    mostrarToastRepartidor(`✅ Entrega confirmada. Recibió: ${receptor}`);
}

/* Historial */
function badgeEstadoHtml(estado) {
    const map = {
        'Entregado': 'badge-entregado',
        'Salió a ruta': 'badge-ruta',
        'En preparación': 'badge-preparando',
        'Problema': 'badge-problema',
        'Pedido recibido': 'badge-recibido'
    };
    const cls = map[estado] || 'badge-recibido';
    return `<span class="badge-estado ${cls}">${estado}</span>`;
}

function renderHistorialRepartidor() {
    const tbody = document.getElementById('historialTbody');
    const pag = document.getElementById('histPaginacion');
    if (!tbody) return;

    const inicio = (histPagina - 1) * HIST_POR_PAG;
    const items = histFiltrado.slice(inicio, inicio + HIST_POR_PAG);
    const total = histFiltrado.length;
    const paginas = Math.ceil(total / HIST_POR_PAG);

    if (items.length === 0) {
        tbody.innerHTML = `<tr><td colspan="9" class="text-center text-muted py-4">
            <i class="fas fa-search me-2"></i>No se encontraron pedidos con esos filtros.
        </td></tr>`;
        if(pag) pag.innerHTML = '';
        return;
    }

    tbody.innerHTML = items.map((p, idx) => `
        <tr>
            <td>${inicio + idx + 1}</td>
            <td class="hist-folio">${p.folio}</td>
            <td class="td-name" style="text-align:left">${p.cliente}</td>
            <td style="text-align:left;font-size:.8rem">${p.producto}</td>
            <td class="td-fecha">${p.asignado}</td>
            <td class="td-fecha">${p.entrega}</td>
            <td style="font-weight:700;color:var(--btn-color)">${p.total}</td>
            <td>${badgeEstadoHtml(p.estado)}</td>
            <td>
                <button class="btn-tbl-edit" title="Cambiar estado"
                        onclick="abrirModalEstado('${p.folio}', ${obtenerIndexEstadoRep(p.estado)})">
                    <i class="fas fa-exchange-alt"></i>
                </button>
            </td>
        </tr>`).join('');

    if(!pag) return;
    let pgHtml = '';
    for (let i = 1; i <= paginas; i++) {
        pgHtml += `<button class="page-btn ${i === histPagina ? 'active' : ''}"
                           onclick="cambiarPagHistRep(${i})">${i}</button>`;
    }
    pag.innerHTML = pgHtml;
}

function obtenerIndexEstadoRep(label) {
    return ESTADOS_REPARTIDOR.findIndex(e => e.label === label) ?? 0;
}

function filtrarHistorial() {
    const folio = document.getElementById('filtroFolio')?.value.toLowerCase() || '';
    const estado = document.getElementById('filtroEstado')?.value || '';
    const mes = document.getElementById('filtroMes')?.value || '';

    histFiltrado = HISTORIAL_REPARTIDOR.filter(p => {
        const okFolio = !folio || p.folio.toLowerCase().includes(folio);
        const okEstado = !estado || p.estado === estado;
        const okMes = !mes || p.mes === mes;
        return okFolio && okEstado && okMes;
    });
    histPagina = 1;
    renderHistorialRepartidor();
}

function limpiarFiltros() {
    if(document.getElementById('filtroFolio')) document.getElementById('filtroFolio').value = '';
    if(document.getElementById('filtroEstado')) document.getElementById('filtroEstado').value = '';
    if(document.getElementById('filtroMes')) document.getElementById('filtroMes').value = 'marzo';
    
    histFiltrado = [...HISTORIAL_REPARTIDOR];
    histPagina = 1;
    renderHistorialRepartidor();
}

function cambiarPagHistRep(n) {
    histPagina = n;
    renderHistorialRepartidor();
}

/* Modal de estado */
let folioEnEdicion = null;
let idxEnEdicion = -1;

function abrirModalEstado(folio, idx) {
    folioEnEdicion = folio;
    idxEnEdicion = HISTORIAL_REPARTIDOR.findIndex(p => p.folio === folio);
    if(document.getElementById('modalFolio')) document.getElementById('modalFolio').textContent = folio;
    if(document.getElementById('modalSelectEstado')) document.getElementById('modalSelectEstado').value = idx;
    if(document.getElementById('modalObs')) document.getElementById('modalObs').value = '';
    const overlay = document.getElementById('modalEstadoOverlay');
    if(overlay) overlay.classList.add('show');
}

function cerrarModalEstado() {
    const overlay = document.getElementById('modalEstadoOverlay');
    if(overlay) overlay.classList.remove('show');
}

function guardarEstadoModal() {
    const modalSelect = document.getElementById('modalSelectEstado');
    if(!modalSelect || idxEnEdicion < 0) return;
    
    const nuevo = parseInt(modalSelect.value);
    HISTORIAL_REPARTIDOR[idxEnEdicion].estado = ESTADOS_REPARTIDOR[nuevo].label;
    
    if (nuevo === 3 && HISTORIAL_REPARTIDOR[idxEnEdicion].entrega === '—') {
        const hoy = new Date();
        HISTORIAL_REPARTIDOR[idxEnEdicion].entrega = hoy.toLocaleDateString('es-MX', { day:'2-digit', month:'2-digit', year:'numeric' });
    }
    histFiltrado = [...HISTORIAL_REPARTIDOR];
    renderHistorialRepartidor();
    cerrarModalEstado();
    mostrarToastRepartidor(`Estado de ${folioEnEdicion} actualizado a "${ESTADOS_REPARTIDOR[nuevo].label}"`);
}

/* Perfil repartidor */
const PERFIL_REP_INICIAL = {
    nombre: 'Juan', apellidos: 'Hernández Pérez',
    telefono: '229-741-0000', correo: 'juan.hernandez@luchanoscorp.mx',
    direccion: 'Calle Reforma 123, Col. Centro, Veracruz, Ver.',
    turno: 'Matutino', zona: 'Veracruz Norte', vehiculo: 'Motocicleta'
};

function guardarPerfil() {
    const nombre = document.getElementById('pNombre')?.value.trim();
    const apellidos = document.getElementById('pApellidos')?.value.trim();
    if (!nombre || !apellidos) {
        mostrarToastRepartidor('Nombre y apellidos son obligatorios.', '#dc3545');
        return;
    }
    mostrarToastRepartidor(`✅ Perfil guardado: ${nombre} ${apellidos}`);
}

function resetPerfil() {
    const campos = {
        'pNombre': PERFIL_REP_INICIAL.nombre,
        'pApellidos': PERFIL_REP_INICIAL.apellidos,
        'pTelefono': PERFIL_REP_INICIAL.telefono,
        'pCorreo': PERFIL_REP_INICIAL.correo,
        'pDireccion': PERFIL_REP_INICIAL.direccion,
        'pTurno': PERFIL_REP_INICIAL.turno,
        'pZona': PERFIL_REP_INICIAL.zona,
        'pVehiculo': PERFIL_REP_INICIAL.vehiculo
    };
    for(const [id, valor] of Object.entries(campos)) {
        const el = document.getElementById(id);
        if(el) el.value = valor;
    }
    mostrarToastRepartidor('Datos restaurados.', '#6c757d');
}

function cambiarContrasena() {
    const actual = document.getElementById('pwActual')?.value;
    const nueva = document.getElementById('pwNueva')?.value;
    const confirmar = document.getElementById('pwConfirmar')?.value;
    const fb = document.getElementById('pwFeedback');

    if(fb) fb.textContent = '';
    if (!actual || !nueva || !confirmar) {
        if(fb) fb.textContent = 'Completa todos los campos de contraseña.';
        return;
    }
    if (nueva.length < 8) {
        if(fb) fb.textContent = 'La nueva contraseña debe tener al menos 8 caracteres.';
        return;
    }
    if (nueva !== confirmar) {
        if(fb) fb.textContent = 'Las contraseñas no coinciden.';
        return;
    }
    
    if(document.getElementById('pwActual')) document.getElementById('pwActual').value = '';
    if(document.getElementById('pwNueva')) document.getElementById('pwNueva').value = '';
    if(document.getElementById('pwConfirmar')) document.getElementById('pwConfirmar').value = '';
    
    mostrarToastRepartidor('✅ Contraseña actualizada correctamente.');
}

/* ════════════════════════════════════════════════════════════
   RASTREO DE PEDIDOS (Cliente)
   ════════════════════════════════════════════════════════════ */

function initRastrearPedido() {
    const form = document.getElementById('trackForm');
    if (!form) return;
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const ref = document.getElementById('noReferencia').value.trim();
        const result = document.getElementById('trackResult');
        if (!ref) {
            if(result) result.innerHTML = '<div class="track-error-msg">' +
                '<i class="fas fa-exclamation-triangle"></i> Por favor ingresa tu número de referencia.</div>';
            return;
        }
        if(result) result.innerHTML = '';
        const destino = 'Cuenta/inicio_usuario.php?panel=pedidos&ref=' + encodeURIComponent(ref);
        window.location.href = destino;
    });
}

function initRastreoDesdeURL() {
    const params = new URLSearchParams(window.location.search);
    const panel = params.get('panel');
    const ref = params.get('ref');
    if (panel !== 'pedidos') return;

    document.querySelectorAll('.cuenta-nav-link').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.cuenta-panel').forEach(p => p.classList.remove('active'));

    const btnPedidos = document.querySelector('[onclick="switchPanel(\'panel-pedidos\',this)"]');
    const panelPedidos = document.getElementById('panel-pedidos');
    if (btnPedidos) btnPedidos.classList.add('active');
    if (panelPedidos) panelPedidos.classList.add('active');

    if (!ref) return;

    const refUpper = ref.toUpperCase();
    const pedidoProceso = 'LC-2026-0041';
    const pedidoEnvio = 'LC-2026-0038';
    const enProceso = refUpper.includes(pedidoProceso);
    const enEnvio = refUpper.includes(pedidoEnvio);
    const histCard = document.getElementById('hist-' + refUpper.replace('#', ''));

    if (enProceso) {
        activarTabPedido('btn-tab-proceso', 'tab-proceso');
        mostrarAlertaRastreo(ref, 'proceso');
    } else if (enEnvio) {
        activarTabPedido('btn-tab-envio', 'tab-envio');
        mostrarAlertaRastreo(ref, 'envio');
    } else if (histCard) {
        activarTabPedido('btn-tab-historial', 'tab-historial');
        mostrarAlertaRastreo(ref, 'historial');
        setTimeout(() => {
            histCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            histCard.classList.add('pedido-card--highlight');
            setTimeout(() => histCard.classList.remove('pedido-card--highlight'), 2500);
        }, 350);
    } else {
        activarTabPedido('btn-tab-proceso', 'tab-proceso');
        mostrarAlertaRastreo(ref, 'notfound');
    }
}

function activarTabPedido(btnId, tabId) {
    document.querySelectorAll('.pedido-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.pedido-tab-panel').forEach(p => p.classList.remove('active'));
    const btn = document.getElementById(btnId);
    const tab = document.getElementById(tabId);
    if (btn) btn.classList.add('active');
    if (tab) tab.classList.add('active');
}

function mostrarAlertaRastreo(ref, estado) {
    const alertEl = document.getElementById('refAlert');
    const txtEl = document.getElementById('refAlertText');
    if (!alertEl || !txtEl) return;

    const msgs = {
        proceso: `Pedido <strong>${ref}</strong> encontrado — actualmente <strong>En Proceso</strong>.`,
        envio: `Pedido <strong>${ref}</strong> encontrado — actualmente <strong>En Envío</strong>.`,
        historial: `Pedido <strong>${ref}</strong> encontrado en el historial — ya fue <strong>Entregado</strong>.`,
        notfound: `No encontramos el pedido <strong>${ref}</strong> en tu cuenta. Verifica el número.`
    };

    txtEl.innerHTML = msgs[estado] || msgs.notfound;
    alertEl.classList.add('ref-alert--visible');
    if (estado === 'notfound') alertEl.classList.add('ref-alert--warn');

    const activeTab = document.querySelector('.pedido-tab-panel.active');
    if (activeTab) activeTab.prepend(alertEl);
}

/* ════════════════════════════════════════════════════════════
   INICIALIZACIÓN GLOBAL
   ════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    /* Admin */
    initToggleEstado();
    initAdminFormValidation();
    initAdminTabs();
    initReportTabs();
    const confirmOverlay = document.getElementById('confirmOverlay');
    if (confirmOverlay) {
        confirmOverlay.addEventListener('click', e => {
            if (e.target === confirmOverlay) closeConfirm();
        });
    }

    /* Vendedor */
    initVentas();
    initClienteWidget();
    renderDetalleVentas();
    renderInventario();
    renderCatalogo();
    initSolicitudesModal();

    /* Repartidor */
    histFiltrado = [...HISTORIAL_REPARTIDOR];
    renderTrackingRepartidor();
    renderHistorialRepartidor();

    /* Rastreo */
    initRastrearPedido();
    initRastreoDesdeURL();
});

/* ══════════════════════════════════════════════════════════════
   LuchanosCorp — Admin: Pedido a Proveedor
   Ruta: js/admin_pedido_proveedor.js
   ══════════════════════════════════════════════════════════════ */

'use strict';

/* ── Datos locales (sustituir por fetch al servidor) ─────────── */
const CATALOGO = {
    P001: { nombre: 'Refrigerador 14 pies Frost',  sku: 'WH-REF-014', precio: 7490  },
    P002: { nombre: 'Lavadora 17 kg Automática',   sku: 'WH-LAV-017', precio: 5290  },
    P003: { nombre: 'Estufa 6 Quemadores Acero',   sku: 'MB-EST-006', precio: 3850  },
    P004: { nombre: 'Televisor 55" QLED 4K',       sku: 'SG-TV-055',  precio: 9999  },
    P005: { nombre: 'Microondas 30L Inverter',     sku: 'LG-MW-030',  precio: 2199  },
};

const PROVEEDORES = {
    whirlpool: { nombre: 'Whirlpool MX',   contacto: 'ventas@whirlpool.com.mx' },
    samsung:   { nombre: 'Samsung MX',     contacto: 'proveedores@samsung.mx'  },
    lg:        { nombre: 'LG Electronics', contacto: 'reabasto@lg.com.mx'      },
    mabe:      { nombre: 'Mabe',           contacto: 'compras@mabe.com.mx'     },
};

/* Estado en memoria */
const seleccionados = {}; // { id: qty }

/* ── Helpers ─────────────────────────────────────────────────── */
function fmtMXN(n) {
    return n.toLocaleString('es-MX', { style: 'currency', currency: 'MXN' });
}

function el(id) { return document.getElementById(id); }

/* ── Tabs ────────────────────────────────────────────────────── */
function cambiarTab(tab, btn) {
    document.querySelectorAll('.admin-tab-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.admin-tab-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    el('tab-' + tab).classList.add('active');
}

/* ── Proveedor ───────────────────────────────────────────────── */
function actualizarProveedor(val) {
    const p = PROVEEDORES[val];
    el('contactoProveedor').value = p ? p.contacto : '';
    el('resProveedor').textContent = p ? p.nombre : '—';
}

/* ── Toggle producto ─────────────────────────────────────────── */
function toggleProducto(id, fila) {
    const chk = el('chk-' + id);
    chk.checked = !chk.checked;
    if (chk.checked) {
        seleccionados[id] = seleccionados[id] || 1;
        fila.style.background = '#e6f6f8';
    } else {
        delete seleccionados[id];
        fila.style.background = '';
    }
    renderTabla();
    actualizarResumen();
}

/* ── Render tabla de seleccionados ───────────────────────────── */
function renderTabla() {
    const ids  = Object.keys(seleccionados);
    const wrap = el('tablaSeleccionadosWrap');
    const tbody = el('tablaSeleccionados');
    wrap.style.display = ids.length ? '' : 'none';
    tbody.innerHTML = '';

    ids.forEach(id => {
        const p   = CATALOGO[id];
        const qty = seleccionados[id];
        const sub = fmtMXN(qty * p.precio);
        const fila = document.createElement('tr');
        fila.className = 'producto-fila';
        fila.innerHTML = `
            <td>${p.nombre}</td>
            <td style="font-family:monospace;font-size:.8rem;color:#8a9bb5">${p.sku}</td>
            <td style="text-align:center">
                <input class="qty-input" type="number" min="1" value="${qty}"
                       onchange="cambiarQty('${id}', this.value)">
            </td>
            <td style="text-align:right;font-weight:600">${fmtMXN(p.precio)}</td>
            <td style="text-align:right;font-weight:700;color:var(--btn-color)">${sub}</td>
            <td>
                <button class="btn-quitar" onclick="quitarProducto('${id}')">
                    <i class="fas fa-times"></i>
                </button>
            </td>`;
        tbody.appendChild(fila);
    });
}

function cambiarQty(id, val) {
    seleccionados[id] = Math.max(1, parseInt(val) || 1);
    renderTabla();
    actualizarResumen();
}

function quitarProducto(id) {
    delete seleccionados[id];
    const chk = el('chk-' + id);
    if (chk) chk.checked = false;
    document.querySelectorAll('.picker-item').forEach(f => {
        if (f.querySelector('#chk-' + id)) f.style.background = '';
    });
    renderTabla();
    actualizarResumen();
}

/* ── Resumen ─────────────────────────────────────────────────── */
function actualizarResumen() {
    const ids = Object.keys(seleccionados);
    let total = 0, unidades = 0;
    ids.forEach(id => {
        total    += seleccionados[id] * CATALOGO[id].precio;
        unidades += seleccionados[id];
    });
    el('resCantProductos').textContent = ids.length;
    el('resUnidades').textContent      = unidades;
    el('resTotal').textContent         = fmtMXN(total);
}

/* ── Filtro picker ───────────────────────────────────────────── */
function filtrarProductos(q) {
    document.querySelectorAll('.picker-item').forEach(item => {
        item.style.display = item.textContent.toLowerCase().includes(q.toLowerCase()) ? '' : 'none';
    });
}

/* ── Confirmación modal ──────────────────────────────────────── */
/* ── Confirmación modal ──────────────────────────────────────── */
function abrirConfirmacion() {
    const provEl  = el('selectProveedor');
    const ids     = Object.keys(seleccionados);

    if (!provEl.value)  { alert('Selecciona un proveedor primero.'); return; }
    if (!ids.length)     { alert('Agrega al menos un producto.'); return; }

    const provNombre = PROVEEDORES[provEl.value].nombre;
    let total = 0;
    ids.forEach(id => { total += seleccionados[id] * CATALOGO[id].precio; });

    const filas = ids.map(id => {
        const p = CATALOGO[id];
        return `<tr>
            <td style="font-size:.83rem;padding:.35rem .5rem">${p.nombre}</td>
            <td style="font-size:.83rem;padding:.35rem .5rem;text-align:center">${seleccionados[id]}</td>
            <td style="font-size:.83rem;padding:.35rem .5rem;text-align:right;color:var(--btn-color);font-weight:700">
                ${fmtMXN(seleccionados[id] * p.precio)}
            </td>
        </tr>`;
    }).join('');

    // Contenido del modal sin fecha ni nota (acorde al HTML actual)
    el('modalPedidoBody').innerHTML = `
        <div class="modal-label">Folio</div>
        <div class="modal-value mono">LC-REA-2026-032</div>
        
        <div class="modal-label">Proveedor</div>
        <div class="modal-value">${provNombre}</div>
        
        <div class="modal-label mt-2">Productos solicitados</div>
        <table class="modal-detalle-table">
            <thead><tr>
                <th>Producto</th><th>Cant.</th><th>Subtotal</th>
            </tr></thead>
            <tbody>${filas}</tbody>
        </table>
        
        <div class="modal-total-row">
            <span>Total estimado</span>
            <span>${fmtMXN(total)}</span>
        </div>
        
        <div class="modal-actions">
            <button class="btn-modal-cancel" onclick="cerrarModal()">
                <i class="fas fa-times"></i> Cancelar
            </button>
            <button class="btn-modal-confirm" onclick="confirmarEnvio()">
                <i class="fas fa-paper-plane"></i> Confirmar y Enviar
            </button>
        </div>`;

    el('modalPedidoOverlay').classList.add('show');
}

function cerrarModal() {
    el('modalPedidoOverlay').classList.remove('show');
}

function confirmarEnvio() {
    cerrarModal();
    mostrarToast('toastEnviado');
    /* Aquí iría el POST real: fetch('/api/pedidos', { method:'POST', body: JSON.stringify({...}) }) */
}

/* ── Toast ───────────────────────────────────────────────────── */
function mostrarToast(id, ms = 3500) {
    const t = el(id);
    if (!t) return;
    t.classList.add('show');
    setTimeout(() => t.classList.remove('show'), ms);
}

/* ── Detalle historial ───────────────────────────────────────── */
function verDetalle(folio) {
    /* Sustituir por apertura de modal con datos reales */
    alert('Detalle de: ' + folio);
}

/* ── Inicialización ──────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    /* Fecha mínima = hoy */
    const hoy = new Date().toISOString().split('T')[0];
    const fechaInput = el('fechaEntrega');
    if (fechaInput) fechaInput.min = hoy;

    /* Cerrar modal al hacer clic en el overlay */
    const overlay = el('modalPedidoOverlay');
    if (overlay) overlay.addEventListener('click', e => {
        if (e.target === overlay) cerrarModal();
    });
});

/* ── Custom estado dropdown (repartidor) ─────────────────── */
/* ── Portal dropdown: se inyecta en <body> para escapar overflow:hidden ── */
const ESTADO_OPTIONS = [
    { val:0, icon:'fa-inbox',              label:'Pedido recibido',    color:'#6b7280' },
    { val:1, icon:'fa-box-open',           label:'En preparación',     color:'#3b82f6' },
    { val:2, icon:'fa-truck',              label:'Salió a ruta',       color:'#f59e0b' },
    { val:3, icon:'fa-home',              label:'Entregado',           color:'#16a34a' },
    { val:4, icon:'fa-exclamation-triangle', label:'Problema en entrega', color:'#dc2626' },
];

let _portalList = null;
let _estadoSelVal = 2; // valor inicial (Salió a ruta)

function _crearPortalList() {
    if (_portalList) return;
    _portalList = document.createElement('ul');
    _portalList.id = 'customEstadoList';
    _portalList.className = 'custom-estado-list';
    _portalList.style.cssText = 'position:fixed; z-index:99999; display:none; min-width:230px;';

    ESTADO_OPTIONS.forEach(opt => {
        const li = document.createElement('li');
        if (opt.val === _estadoSelVal) li.classList.add('selected');
        li.innerHTML = `<i class="fas ${opt.icon}" style="color:${opt.color};font-size:1rem;width:20px;text-align:center;flex-shrink:0"></i> ${opt.label}`;
        li.addEventListener('click', function(e) {
            e.stopPropagation();
            _selectEstadoPortal(opt.val, opt.icon, opt.label, opt.color, li);
        });
        _portalList.appendChild(li);
    });

    document.body.appendChild(_portalList);
}

function _posicionarPortal() {
    const trigger = document.getElementById('customEstadoSelected');
    if (!trigger || !_portalList) return;
    const rect = trigger.getBoundingClientRect();
    _portalList.style.top  = (rect.bottom + 4) + 'px';
    _portalList.style.left = rect.left + 'px';
    _portalList.style.width = rect.width + 'px';
}

function toggleEstadoDropdown() {
    _crearPortalList();
    const chevron = document.getElementById('customChevron');
    const isOpen  = _portalList.style.display === 'block';

    if (isOpen) {
        _portalList.style.display = 'none';
        if (chevron) chevron.classList.remove('open');
    } else {
        _posicionarPortal();
        _portalList.style.display = 'block';
        if (chevron) chevron.classList.add('open');
    }
}

function _selectEstadoPortal(val, icon, label, color, liEl) {
    _estadoSelVal = val;
    const hidden = document.getElementById('selectorEstado');
    if (hidden) hidden.value = val;

    const iconEl = document.getElementById('customEstadoIcon');
    if (iconEl) iconEl.innerHTML = `<i class="fas ${icon}" style="color:${color};font-size:1rem"></i>`;

    const textEl = document.getElementById('customEstadoText');
    if (textEl) textEl.textContent = label;

    // Mark selected
    _portalList.querySelectorAll('li').forEach(l => l.classList.remove('selected'));
    liEl.classList.add('selected');

    // Close
    _portalList.style.display = 'none';
    const chevron = document.getElementById('customChevron');
    if (chevron) chevron.classList.remove('open');

    previsualizarEstado();
}

// Close portal clicking outside
document.addEventListener('click', function(e) {
    if (!_portalList) return;
    const trigger = document.getElementById('customEstadoSelect');
    if (trigger && !trigger.contains(e.target) && !_portalList.contains(e.target)) {
        _portalList.style.display = 'none';
        const chevron = document.getElementById('customChevron');
        if (chevron) chevron.classList.remove('open');
    }
});

// Reposition on scroll/resize
window.addEventListener('scroll', function() {
    if (_portalList && _portalList.style.display === 'block') _posicionarPortal();
}, true);
window.addEventListener('resize', function() {
    if (_portalList && _portalList.style.display === 'block') _posicionarPortal();
});