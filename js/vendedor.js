/* ============================================================
   LuchanosCorp — Panel Vendedor  |  vendedor.js
   Funciones compartidas por todas las páginas del vendedor.
============================================================ */

/* ════════════════════════════════════════════════════
   UTILIDADES
════════════════════════════════════════════════════ */

/** Formatea número como moneda MXN: $1,234.56 */
function fmt(n) {
    return '$' + parseFloat(n).toLocaleString('es-MX', {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    });
}

/* ════════════════════════════════════════════════════
   PÁGINA: ventas.php
   Punto de venta — tabla de items + cálculo de pago
════════════════════════════════════════════════════ */

let ventaItems   = [];
let ventaCounter = 0;

/**
 * Maneja el submit del formulario de agregar producto.
 * Agrega el producto seleccionado a ventaItems y re-renderiza.
 */
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
        const sku    = sel.value;
        const nombre = sel.options[sel.selectedIndex].text.split(' (')[0];   // Nombre limpio

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

/** Reconstruye el tbody de ventas y muestra/oculta la sección de pago. */
function renderTablaVenta() {
    const tbody     = document.getElementById('tbodyVenta');
    const secPago   = document.getElementById('seccionPago');
    const trVacio   = document.getElementById('tr-vacio');
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

/**
 * Elimina una fila de la venta.
 * @param {number} id
 */
function eliminarFilaVenta(id) {
    ventaItems = ventaItems.filter(i => i.id !== id);
    renderTablaVenta();
}

/** Actualiza subtotal, IVA y total en la sección de pago. */
function actualizarTotalesVenta() {
    const sub = ventaItems.reduce((s, i) => s + i.precio * i.qty, 0);
    const iva = sub * 0.16;
    const el  = (id) => document.getElementById(id);

    if (el('lblSubtotal')) el('lblSubtotal').textContent = fmt(sub);
    if (el('lblIva'))      el('lblIva').textContent      = fmt(iva);
    if (el('lblTotal'))    el('lblTotal').textContent    = fmt(sub + iva);
}

/** Calcula el cambio según el monto ingresado. */
function calcularCambio() {
    const sub    = ventaItems.reduce((s, i) => s + i.precio * i.qty, 0);
    const total  = sub * 1.16;
    const rec    = parseFloat(document.getElementById('inputRecibido')?.value) || 0;
    const campo  = document.getElementById('inputCambio');
    if (!campo) return;
    const cambio = rec - total;
    campo.value  = cambio >= 0 ? fmt(cambio) : '⚠ Monto insuficiente';
    campo.style.color = cambio >= 0 ? '#065f46' : '#dc3545';
}

/** Registra la venta (simulado) y limpia el formulario. */
function registrarVenta() {
    if (ventaItems.length === 0) {
        alert('Agrega al menos un producto a la venta.');
        return;
    }
    const cliente = document.getElementById('clienteValor')?.value ||
                    document.getElementById('selectCliente')?.value ||
                    'En mostrador';
    const pago    = document.getElementById('selectPago')?.value    || 'Efectivo';
    const total   = (ventaItems.reduce((s, i) => s + i.precio * i.qty, 0) * 1.16)
                        .toLocaleString('es-MX', { minimumFractionDigits: 2 });

    alert(`✅ Venta registrada exitosamente.\n\nCliente: ${cliente}\nPago: ${pago}\nTotal: $${total}\n\nSe puede imprimir el ticket.`);

    ventaItems = [];
    renderTablaVenta();
    const inp = document.getElementById('inputRecibido');
    const cam = document.getElementById('inputCambio');
    if (inp) inp.value = '';
    if (cam) { cam.value = ''; cam.style.color = ''; }
}

/* ════════════════════════════════════════════════════
   PÁGINA: detalle_ventas.php
   Historial filtrable + botón de ticket
════════════════════════════════════════════════════ */

/** Datos de muestra para detalle de ventas */
const VENTAS_DEMO = [
    { folio: 1, fecha: '21/03/2026', hora: '10:23:51', cliente: 'Ana Torres',     sku: 'WRS315SNHM',   desc: 'Refrigerador Side by Side 25 pies',   qty: 1, precio: 22499, pago: 'Tarjeta'       },
    { folio: 1, fecha: '21/03/2026', hora: '10:23:51', cliente: 'Ana Torres',     sku: 'WM3911D',      desc: 'Microondas AirFry 4 en 1',             qty: 2, precio: 4599,  pago: 'Tarjeta'       },
    { folio: 2, fecha: '20/03/2026', hora: '14:05:30', cliente: 'Luis Ramírez',   sku: '8MWTW2024WJM', desc: 'Lavadora 20kg Carga Superior',         qty: 1, precio: 9999,  pago: 'Efectivo'      },
    { folio: 3, fecha: '20/03/2026', hora: '16:40:12', cliente: 'Roberto Méndez', sku: 'MGH765RDS',    desc: 'Estufa 6 quemadores convección',       qty: 1, precio: 9799,  pago: 'Crédito'       },
    { folio: 4, fecha: '19/03/2026', hora: '09:55:00', cliente: 'Claudia Soto',   sku: 'LG-WM3500CW',  desc: 'Lavadora LG 22kg TurboWash',           qty: 1, precio: 11499, pago: 'Transferencia' },
    { folio: 5, fecha: '18/03/2026', hora: '11:30:45', cliente: 'Ana Torres',     sku: 'WHP-AC1234',   desc: 'Aire Acondicionado 12,000 BTU',        qty: 2, precio: 8299,  pago: 'Efectivo'      },
    { folio: 6, fecha: '17/03/2026', hora: '13:15:22', cliente: 'Luis Ramírez',   sku: 'WK0260B',      desc: 'Despachador de agua c/hielo',          qty: 1, precio: 7999,  pago: 'Tarjeta'       },
    { folio: 7, fecha: '15/03/2026', hora: '10:00:00', cliente: 'Roberto Méndez', sku: 'SAM-RF28T',    desc: 'Refrigerador Samsung French Door 28p', qty: 1, precio: 28999, pago: 'Crédito'       },
];

/** Renderiza la tabla de detalle de ventas */
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

/** Filtra las ventas según los campos del formulario */
function filtrarVentas() {
    const folio = document.getElementById('fFolio')?.value.trim();
    const desde = document.getElementById('fDesde')?.value;
    const hasta = document.getElementById('fHasta')?.value;

    let resultado = VENTAS_DEMO;
    if (folio)  resultado = resultado.filter(v => String(v.folio) === folio);
    if (desde)  resultado = resultado.filter(v => v.fecha >= convertirFecha(desde));
    if (hasta)  resultado = resultado.filter(v => v.fecha <= convertirFecha(hasta));

    renderDetalleVentas(resultado);
}

function convertirFecha(iso) {
    if (!iso) return '';
    const [y, m, d] = iso.split('-');
    return `${d}/${m}/${y}`;
}

/**
 * Simula la generación de un ticket PDF.
 * @param {number} folio
 */
function generarTicket(folio) {
    alert(`🖨️ Generando ticket para el Folio #${folio}...\n\n(En producción descargará el PDF del ticket de venta.)`);
}

/* ════════════════════════════════════════════════════
   PÁGINA: inventario.php
   Tabla de stock con filtro
════════════════════════════════════════════════════ */

const INVENTARIO_DEMO = [
    { sku: 'WM3911D',      nombre: 'Microondas AirFry 4 en 1 (1CuFt)',             marca: 'Whirlpool', categoria: 'Cocina',        precio: 4599,  stock: 45 },
    { sku: '8MWTW2024WJM', nombre: 'Lavadora 20kg Carga Superior Agitador',        marca: 'Whirlpool', categoria: 'Lavado',        precio: 9999,  stock: 18 },
    { sku: 'WK0260B',      nombre: 'Despachador de agua con fábrica de hielo',     marca: 'Whirlpool', categoria: 'Refrigeración', precio: 7999,  stock: 7  },
    { sku: 'WRS315SNHM',   nombre: 'Refrigerador Side by Side 25 pies',            marca: 'Whirlpool', categoria: 'Refrigeración', precio: 22499, stock: 4  },
    { sku: 'MGH765RDS',    nombre: 'Estufa 6 quemadores con convección',           marca: 'Whirlpool', categoria: 'Cocina',        precio: 9799,  stock: 12 },
    { sku: 'LG-WM3500CW',  nombre: 'Lavadora LG 22kg TurboWash 360',              marca: 'LG',        categoria: 'Lavado',        precio: 11499, stock: 0  },
    { sku: 'SAM-RF28T',    nombre: 'Refrigerador Samsung French Door 28 pies',     marca: 'Samsung',   categoria: 'Refrigeración', precio: 28999, stock: 3  },
    { sku: 'WHP-AC1234',   nombre: 'Aire Acondicionado 12,000 BTU Inverter',       marca: 'Whirlpool', categoria: 'Climatización', precio: 8299,  stock: 9  },
    { sku: 'WED5000DW',    nombre: 'Secadora eléctrica de carga frontal 7.0 pies', marca: 'Whirlpool', categoria: 'Lavado',        precio: 7899,  stock: 11 },
    { sku: 'WFW5000HW',    nombre: 'Lavadora carga frontal 4.5 pies alta efic.',   marca: 'Whirlpool', categoria: 'Lavado',        precio: 12499, stock: 0  },
];

/** Renderiza la tabla de inventario */
function renderInventario(data) {
    const tbody = document.getElementById('tbodyInventario');
    if (!tbody) return;
    const rows = data || INVENTARIO_DEMO;

    tbody.innerHTML = rows.map((p, i) => {
        let badge, obs, color;
        if (p.stock === 0) {
            badge = '<span class="badge-out">Agotado</span>';
            obs   = 'No disponible para venta';
            color = '#dc3545';
        } else if (p.stock <= 5) {
            badge = '<span class="badge-warn">Bajo stock</span>';
            obs   = 'Próximo a agotarse — Reabastecer';
            color = '#d97706';
        } else {
            badge = '<span class="badge-activo">Disponible</span>';
            obs   = 'Disponible para venta';
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

/** Filtra el inventario por texto y categoría */
function filtrarInventario() {
    const q   = document.getElementById('invBuscar')?.value.toLowerCase() || '';
    const cat = document.getElementById('invCat')?.value || '';

    const resultado = INVENTARIO_DEMO.filter(p =>
        (!q   || p.nombre.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)) &&
        (!cat || p.categoria === cat)
    );
    renderInventario(resultado);
}

/* ════════════════════════════════════════════════════
   PÁGINA: catalogo.php
   Grid de tarjetas de productos
════════════════════════════════════════════════════ */

/** Construye el grid de catálogo a partir de INVENTARIO_DEMO */
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
        if      (p.stock === 0) stockEl = `<span class="cat-stock-out">✕ Agotado</span>`;
        else if (p.stock <= 5)  stockEl = `<span class="cat-stock-low">⚠ Últimas ${p.stock} unidades</span>`;
        else                    stockEl = `<span class="cat-stock-ok">✓ En stock</span>`;

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

/** Filtra el catálogo por texto, categoría y rango de precio */
function filtrarCatalogo() {
    const q      = document.getElementById('catBuscar')?.value.toLowerCase()  || '';
    const cat    = document.getElementById('catCategoria')?.value             || '';
    const precio = document.getElementById('catPrecio')?.value                || '';

    let resultado = INVENTARIO_DEMO.filter(p =>
        (!q   || p.nombre.toLowerCase().includes(q) || p.sku.toLowerCase().includes(q)) &&
        (!cat || p.categoria === cat)
    );

    if      (precio === '0-5000')   resultado = resultado.filter(p => p.precio < 5000);
    else if (precio === '5000-15000') resultado = resultado.filter(p => p.precio >= 5000 && p.precio <= 15000);
    else if (precio === '15000+')   resultado = resultado.filter(p => p.precio > 15000);

    renderCatalogo(resultado);
}

/* ════════════════════════════════════════════════════
   PÁGINA: solicitudes.php
   Modal para atender solicitudes + initAdminTabs
════════════════════════════════════════════════════ */

/** Inicializa el sistema de tabs basado en data-tab-group y data-target */
function initAdminTabs() {
    document.querySelectorAll('.admin-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const group = this.dataset.tabGroup || 'default';
            document.querySelectorAll(`.admin-tab-btn[data-tab-group="${group}"]`)
                    .forEach(b => b.classList.remove('active'));
            document.querySelectorAll(`.admin-tab-panel[data-tab-group="${group}"]`)
                    .forEach(p => p.classList.remove('active'));
            this.classList.add('active');
            const target = document.getElementById(this.dataset.target);
            if (target) target.classList.add('active');
        });
    });
}

/** Abre el modal de solicitud con los datos del botón pulsado */
function initSolicitudesModal() {
    const overlay    = document.getElementById('modalSolicitud');
    const btnCerrar  = document.getElementById('btnCerrarModal');
    const btnCancelar= document.getElementById('btnCancelarSol');
    const btnGuardar = document.getElementById('btnGuardarSol');
    if (!overlay) return;

    // Abrir modal
    document.querySelectorAll('.js-atender').forEach(btn => {
        btn.addEventListener('click', function () {
            const sol = JSON.parse(this.dataset.sol);
            document.getElementById('modal-ref').textContent       = sol.ref       || '—';
            document.getElementById('modal-cliente').textContent   = sol.cliente   || '—';
            document.getElementById('modal-tipo').textContent      = sol.tipo      || '—';
            document.getElementById('modal-fecha').textContent     = sol.fecha     || '—';
            document.getElementById('modal-asunto').textContent    = sol.asunto    || '—';
            document.getElementById('modal-desc').textContent      = sol.desc      || '—';
            document.getElementById('modal-evidencia').textContent = sol.evidencia || 'Sin adjunto';
            document.getElementById('modal-respuesta').value       = '';
            document.getElementById('modal-estado').value          = 'en_proceso';
            overlay.classList.add('show');
        });
    });

    // Cerrar modal
    const cerrar = () => overlay.classList.remove('show');
    if (btnCerrar)   btnCerrar.addEventListener('click', cerrar);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrar);
    overlay.addEventListener('click', e => { if (e.target === overlay) cerrar(); });

    // Guardar respuesta
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

/* ════════════════════════════════════════════════════
   INICIALIZACIÓN GLOBAL
════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    // ventas.php
    initVentas();

    // detalle_ventas.php
    renderDetalleVentas();

    // inventario.php
    renderInventario();

    // catalogo.php
    renderCatalogo();

    // solicitudes.php
    initAdminTabs();
    initSolicitudesModal();
});

/* ════════════════════════════════════════════════════
   PÁGINA: solicitudes.php — Nueva Solicitud
════════════════════════════════════════════════════ */

/**
 * Valida y simula el envío del formulario de nueva solicitud
 * en solicitudes.php (tab-nueva).
 */
function enviarNuevaSolicitud() {
    const cliente = document.getElementById('nCliente')?.value;
    const tipo    = document.getElementById('nTipo')?.value;
    const asunto  = document.getElementById('nAsunto')?.value.trim();
    const desc    = document.getElementById('nDesc')?.value.trim();

    if (!cliente || !tipo || !asunto || !desc) {
        alert('Por favor completa todos los campos obligatorios (Cliente, Tipo, Asunto y Descripción).');
        return;
    }

    alert('✅ Solicitud registrada exitosamente.\n\nSe ha generado un número de referencia y se notificará al cliente.');

    // Limpiar formulario
    document.getElementById('nCliente').value = '';
    document.getElementById('nTipo').value    = '';
    document.getElementById('nAsunto').value  = '';
    document.getElementById('nDesc').value    = '';
}

/* ════════════════════════════════════════════════════
   WIDGET DE BÚSQUEDA/SELECCIÓN DE CLIENTE (ventas.php)
   Permite:
     1. Buscar/seleccionar cliente existente por nombre
     2. Escribir un nombre libre (cliente nuevo / mostrador)
════════════════════════════════════════════════════ */

/** Lista de clientes registrados (en producción vendría de la BD vía PHP/AJAX) */
const CLIENTES_REGISTRADOS = [
    { id: 'C001', nombre: 'Ana Torres Vega' },
    { id: 'C002', nombre: 'Luis Ramírez' },
    { id: 'C003', nombre: 'Roberto Méndez' },
    { id: 'C004', nombre: 'Claudia Soto' },
    { id: 'C005', nombre: 'Juan Pérez' },
    { id: 'C006', nombre: 'María García' },
];

/** Estado interno del widget */
const clienteWidget = {
    valor: '',       // nombre final (registrado o libre)
    esNuevo: false,  // true cuando el nombre no existe en la lista
};

/**
 * Inicializa el widget de cliente.
 * Llama a esta función en DOMContentLoaded cuando la página sea ventas.php
 */
function initClienteWidget() {
    const input     = document.getElementById('clienteInput');
    const dropdown  = document.getElementById('clienteDropdown');
    const pill      = document.getElementById('clienteSeleccionado');
    const pillNombre= document.getElementById('clientePillNombre');
    const btnCambiar= document.getElementById('btnCambiarCliente');
    const hidden    = document.getElementById('clienteValor');

    if (!input) return;   // No estamos en ventas.php

    /** Renderiza el dropdown según el texto del input */
    function renderDropdown(q) {
        dropdown.innerHTML = '';
        const texto = q.trim().toLowerCase();

        // ── Clientes registrados que coincidan ──────────────────
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

        // ── Opción: usar el texto como nombre libre ─────────────
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

        // ── Sin texto: mostrar todos los registrados ────────────
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

            const gMostr = document.createElement('div');
            gMostr.className = 'cliente-option-group';
            gMostr.textContent = 'Opciones rápidas';
            dropdown.appendChild(gMostr);

            const mostrador = document.createElement('div');
            mostrador.className = 'cliente-option option-nuevo';
            mostrador.innerHTML = `<i class="fas fa-store"></i><span>— Cliente en mostrador —</span>`;
            mostrador.addEventListener('mousedown', e => {
                e.preventDefault();
                seleccionarCliente('— Cliente en mostrador —', false);
            });
            dropdown.appendChild(mostrador);
        }
    }

    /** Selecciona un cliente (registrado o nombre libre) */
    function seleccionarCliente(nombre, esNuevo) {
        clienteWidget.valor  = nombre;
        clienteWidget.esNuevo = esNuevo;
        hidden.value = nombre;

        // Actualizar pill
        let html = `<i class="fas fa-${esNuevo ? 'user-plus' : 'user'}"></i>
                    <span>${escHTML(nombre)}</span>`;
        if (esNuevo) {
            html += `<span class="badge-nuevo-cliente">Nuevo</span>`;
        }
        pillNombre.innerHTML = html;
        pill.classList.add('visible');

        // Ocultar input y dropdown
        input.style.display = 'none';
        dropdown.classList.remove('open');
        document.querySelector('.cliente-hint')?.classList.add('js-hidden');
    }

    /** Resalta coincidencias en el texto */
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

    // ── Eventos del input ──────────────────────────────────────
    input.addEventListener('focus', () => {
        renderDropdown(input.value);
        dropdown.classList.add('open');
    });

    input.addEventListener('input', () => {
        renderDropdown(input.value);
        dropdown.classList.add('open');
        // Resetear selección al escribir
        clienteWidget.valor = '';
        hidden.value = '';
    });

    input.addEventListener('blur', () => {
        // Pequeño delay para que mousedown en opciones se ejecute antes
        setTimeout(() => {
            dropdown.classList.remove('open');
            // Si el usuario escribió algo pero no seleccionó → usar texto libre
            if (input.value.trim().length >= 2 && !clienteWidget.valor) {
                seleccionarCliente(input.value.trim(), true);
            }
        }, 180);
    });

    // ── Botón "Cambiar" en la pill ─────────────────────────────
    btnCambiar.addEventListener('click', () => {
        clienteWidget.valor   = '';
        clienteWidget.esNuevo = false;
        hidden.value = '';
        pill.classList.remove('visible');
        input.style.display = '';
        document.querySelector('.cliente-hint')?.classList.remove('js-hidden');
        input.value = '';
        input.focus();
    });
}

// Agregar initClienteWidget al DOMContentLoaded existente
// (se llama condicionalmente: solo si existe el elemento)
document.addEventListener('DOMContentLoaded', () => {
    initClienteWidget();
});