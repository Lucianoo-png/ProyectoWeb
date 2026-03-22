/* ============================================================
   LuchanosCorp — Scripts Globales
   ============================================================ */

/* ── Toggle contraseña — login.php ───────────────────────────── */
function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eyeIcon');
    if (!input || !icon) return;
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}

/* ── Toggle contraseña múltiple — Registro.php ───────────────── */
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (!input || !icon) return;
    input.type = input.type === 'password' ? 'text' : 'password';
    icon.classList.toggle('fa-eye');
    icon.classList.toggle('fa-eye-slash');
}

/* ── Selector de cantidad — detalle.php ──────────────────────── */
function cambiarCantidad(delta) {
    const input = document.getElementById('cantidad');
    if (!input) return;
    input.value = Math.min(99, Math.max(1, parseInt(input.value) + delta));
}

/* ============================================================
   CARRITO — localStorage con expiración de 15 minutos
   ============================================================ */
const CARRITO_TTL = 15 * 60 * 1000;

function obtenerCarrito() {
    try {
        const raw = localStorage.getItem('lc_carrito');
        if (!raw) return [];
        const data = JSON.parse(raw);
        if (Date.now() > data.expira) {
            localStorage.removeItem('lc_carrito');
            return [];
        }
        return data.items || [];
    } catch (e) { return []; }
}

function guardarCarrito(items) {
    localStorage.setItem('lc_carrito', JSON.stringify({
        items,
        expira: Date.now() + CARRITO_TTL
    }));
}

function formatPrecio(num) {
    return '$' + num.toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
}

function actualizarBadge() {
    const badge = document.getElementById('cart-count');
    if (!badge) return;
    const total = obtenerCarrito().reduce((s, i) => s + i.cantidad, 0);
    badge.textContent   = total > 99 ? '99+' : total;
    badge.style.display = total > 0 ? 'flex' : 'none';
}

/* ============================================================
   DETALLE.PHP — agregar al carrito + modal
   ============================================================ */
function agregarAlCarrito() {
    if (typeof PRODUCTO === 'undefined') {
        console.error('PRODUCTO no definido — verifica que la variable PHP se inyecta antes de scripts.js');
        return;
    }
    const qty     = parseInt(document.getElementById('cantidad')?.value) || 1;
    const carrito = obtenerCarrito();
    const idx     = carrito.findIndex(i => i.sku === PRODUCTO.sku);
    if (idx >= 0) {
        carrito[idx].cantidad += qty;
    } else {
        carrito.push({
            sku:       PRODUCTO.sku,
            nombre:    PRODUCTO.nombre,
            precio:    PRODUCTO.precio,
            imagen:    PRODUCTO.imagen,
            categoria: PRODUCTO.categoria,
            cantidad:  qty
        });
    }
    guardarCarrito(carrito);
    actualizarBadge();
    mostrarModal();
}

function mostrarModal() {
    const modal = document.getElementById('modal-agregado');
    if (!modal || typeof PRODUCTO === 'undefined') return;
    document.getElementById('modal-img').src            = PRODUCTO.imagen;
    document.getElementById('modal-nombre').textContent = PRODUCTO.nombre;
    document.getElementById('modal-sku').textContent    = 'SKU: ' + PRODUCTO.sku;
    document.getElementById('modal-precio').textContent = formatPrecio(PRODUCTO.precio);
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function cerrarModal() {
    const modal = document.getElementById('modal-agregado');
    if (!modal) return;
    modal.classList.remove('show');
    document.body.style.overflow = '';
}

/* ============================================================
   CARRITO.PHP — renderizado dinámico
   ============================================================ */
let _timerCarrito = null;

function iniciarTimerCarrito() {
    clearInterval(_timerCarrito);
    _timerCarrito = setInterval(() => {
        const timerEl = document.getElementById('cart-timer');
        if (!timerEl) { clearInterval(_timerCarrito); return; }
        try {
            const raw = localStorage.getItem('lc_carrito');
            if (!raw) { clearInterval(_timerCarrito); renderCarrito(); return; }
            const restante = JSON.parse(raw).expira - Date.now();
            if (restante <= 0) {
                clearInterval(_timerCarrito);
                localStorage.removeItem('lc_carrito');
                renderCarrito();
                return;
            }
            const min = String(Math.floor(restante / 60000)).padStart(2, '0');
            const seg = String(Math.floor((restante % 60000) / 1000)).padStart(2, '0');
            timerEl.textContent = `⏱ Tu carrito se reserva por ${min}:${seg} min`;
        } catch (e) { clearInterval(_timerCarrito); }
    }, 1000);
}

function renderCarrito() {
    const container   = document.getElementById('cart-items-container');
    const subtotalRow = document.getElementById('cart-subtotal-row');
    const summaryCard = document.getElementById('summary-card');
    if (!container) return;

    const carrito = obtenerCarrito();
    container.innerHTML = '';

    if (carrito.length === 0) {
        container.innerHTML = `
            <div class="cart-empty">
                <i class="fas fa-shopping-cart"></i>
                <p>Tu carrito está vacío</p>
                <a href="linea_blanca.php" class="btn-seguir-vacio">
                    <i class="fas fa-arrow-left me-1"></i> Seguir comprando
                </a>
            </div>`;
        if (subtotalRow) subtotalRow.style.display = 'none';
        if (summaryCard) summaryCard.style.display = 'none';
        actualizarBadge();
        return;
    }

    let totalItems = 0, totalPrecio = 0;

    carrito.forEach((item, idx) => {
        totalItems  += item.cantidad;
        totalPrecio += item.precio * item.cantidad;
        let opts = '';
        for (let q = 1; q <= 10; q++) {
            opts += `<option value="${q}"${q === item.cantidad ? ' selected' : ''}>${q}</option>`;
        }
        const div = document.createElement('div');
        div.className = 'cart-item';
        div.innerHTML = `
            <img src="${item.imagen}" alt="${item.nombre}" class="cart-item-img"
                 onerror="this.src='https://placehold.co/90x90?text=Producto'">
            <div class="cart-item-info">
                <div class="cart-item-name">${item.nombre}</div>
                <div class="cart-item-sku">SKU: ${item.sku}</div>
                <div class="cart-item-cat">Categoría: ${item.categoria} &nbsp;·&nbsp; Estado: <strong>Nuevo</strong></div>
                <div class="cart-item-actions">
                    <label style="font-size:.8rem;color:#555">Cantidad:
                        <select class="qty-select ms-1" onchange="cambiarCantidadCarrito(${idx}, this.value)">
                            ${opts}
                        </select>
                    </label>
                    <span class="separator">|</span>
                    <button class="btn-eliminar" onclick="eliminarItem(${idx})">Eliminar</button>
                </div>
            </div>
            <div class="cart-item-price">${formatPrecio(item.precio * item.cantidad)}</div>`;
        container.appendChild(div);
    });

    if (subtotalRow) {
        document.getElementById('subtotal-qty').textContent    = totalItems;
        document.getElementById('subtotal-plural').textContent = totalItems === 1 ? '' : 's';
        document.getElementById('subtotal-valor').textContent  = formatPrecio(totalPrecio);
        subtotalRow.style.display = 'block';
    }
    if (summaryCard) {
        document.getElementById('summary-productos').textContent = formatPrecio(totalPrecio);
        document.getElementById('summary-total').textContent     = formatPrecio(totalPrecio);
        summaryCard.style.display = 'block';
    }
    actualizarBadge();
}

function cambiarCantidadCarrito(idx, nueva) {
    const carrito = obtenerCarrito();
    carrito[idx].cantidad = parseInt(nueva);
    guardarCarrito(carrito);
    renderCarrito();
}

function eliminarItem(idx) {
    const carrito = obtenerCarrito();
    carrito.splice(idx, 1);
    guardarCarrito(carrito);
    renderCarrito();
}

function realizarPedido() {
    window.location.href = 'direccion.php';
}

/* ============================================================
   DIRECCION.PHP
   ============================================================ */
function enviarAqui() {
    const card = document.getElementById('dir-card-1');
    if (card) card.classList.add('selected');
    setTimeout(() => alert('Dirección confirmada. Próximamente: página de pago.'), 300);
}

function borrarDireccion() {
    if (confirm('¿Deseas borrar esta dirección?')) {
        const card = document.getElementById('dir-card-1');
        if (card) card.style.display = 'none';
    }
}

function abrirEditar() {
    const modal = document.getElementById('modal-editar');
    if (!modal) return;
    modal.classList.add('show');
    document.body.style.overflow = 'hidden';
}

function cerrarEditar() {
    const modal = document.getElementById('modal-editar');
    if (!modal) return;
    modal.classList.remove('show');
    document.body.style.overflow = '';
}

function guardarEdicion() {
    const v = id => document.getElementById(id)?.value.trim() || '';
    const nombreEl  = document.getElementById('dir-nombre-display');
    const detalleEl = document.getElementById('dir-detalle-display');
    if (nombreEl)  nombreEl.textContent = v('edit-nombre');
    if (detalleEl) detalleEl.innerHTML  =
        `${v('edit-calle')}<br>${v('edit-estado').toUpperCase()}, ${v('edit-colonia')}<br>` +
        `${v('edit-ciudad')}, ${v('edit-cp')}, ${v('edit-pais')}<br>Teléfono: ${v('edit-tel')}`;
    cerrarEditar();
}

/* ============================================================
   INIT GLOBAL — un único DOMContentLoaded
   ============================================================ */
document.addEventListener('DOMContentLoaded', function () {

    /* Dropdown mega-menú */
    const megaDrop = document.getElementById('megaDropdown');
    if (megaDrop) new bootstrap.Dropdown(megaDrop);

    /* Badge carrito en todas las páginas */
    actualizarBadge();

    /* carrito.php */
    if (document.getElementById('cart-items-container')) {
        renderCarrito();
        iniciarTimerCarrito();
    }

    /* Cerrar modales al clic en fondo o Escape */
    const modalAgregado = document.getElementById('modal-agregado');
    if (modalAgregado) modalAgregado.addEventListener('click', e => { if (e.target === modalAgregado) cerrarModal(); });

    const modalEditar = document.getElementById('modal-editar');
    if (modalEditar) modalEditar.addEventListener('click', e => { if (e.target === modalEditar) cerrarEditar(); });

    document.addEventListener('keydown', e => {
        if (e.key !== 'Escape') return;
        cerrarModal();
        cerrarEditar();
    });

    /* Rastrear pedido */
    initRastrearPedido();
});
/* ============================================================
   RASTREAR PEDIDO — vista/rastrear_pedido.php
   ============================================================ */
function initRastrearPedido() {
    const form      = document.getElementById('trackForm');
    const inputRef  = document.getElementById('noReferencia');
    const btn       = document.getElementById('btnRastrear');
    const resultBox = document.getElementById('trackResult');
    if (!form || !inputRef || !btn || !resultBox) return;

    /* Mayúsculas automáticas */
    inputRef.addEventListener('input', function () {
        const pos = this.selectionStart;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(pos, pos);
        this.classList.remove('is-invalid');
        resultBox.style.display = 'none';
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const ref = inputRef.value.trim();

        if (!ref) {
            inputRef.classList.add('is-invalid');
            inputRef.focus();
            mostrarResultadoRastreo('error',
                '<i class="fas fa-exclamation-circle me-2"></i>' +
                'Por favor ingresa el número de referencia de tu pedido.');
            return;
        }
        inputRef.classList.remove('is-invalid');

        /* Estado cargando */
        btn.classList.add('loading');
        btn.textContent = ' Buscando pedido...';
        resultBox.style.display = 'none';

        /*
         * ── Reemplazar el setTimeout por fetch real al backend:
         * fetch(`accion/rastrear_pedido_action.php?ref=${encodeURIComponent(ref)}`)
         *   .then(r => r.json())
         *   .then(data => {
         *       btn.classList.remove('loading');
         *       btn.innerHTML = '<i class="fas fa-truck"></i> Rastrear pedido';
         *       if (data.encontrado) {
         *           mostrarResultadoRastreo('success', `...`);
         *       } else {
         *           mostrarResultadoRastreo('error', `...`);
         *       }
         *   })
         *   .catch(() => mostrarResultadoRastreo('error', 'Error de conexión.'));
         */

        /* Simulación demo — eliminar cuando conectes el backend */
        setTimeout(function () {
            btn.classList.remove('loading');
            btn.innerHTML = '<i class="fas fa-truck"></i> Rastrear pedido';

            if (ref.startsWith('LC-') || ref.length >= 10) {
                mostrarResultadoRastreo('success',
                    '<strong><i class="fas fa-check-circle me-2"></i>¡Pedido encontrado!</strong><br>' +
                    'Referencia: <code>' + ref + '</code><br>' +
                    'Estado: <strong>En camino</strong> — Tu paquete llegará en 1–3 días hábiles.');
            } else {
                mostrarResultadoRastreo('error',
                    '<i class="fas fa-search me-2"></i>' +
                    'No encontramos ningún pedido con esa referencia. Verifica el número e inténtalo de nuevo.');
            }
        }, 1800);
    });
}

function mostrarResultadoRastreo(tipo, html) {
    const box = document.getElementById('trackResult');
    if (!box) return;
    box.className = 'track-result ' + tipo;
    box.innerHTML = html;
    box.style.display = 'block';
}
/* ══════════════════════════════════════════════════════════════
   MI CUENTA — mi_cuenta.php
   ══════════════════════════════════════════════════════════════ */
/* ── Mi Cuenta: navegación lateral ─────────────────────────── */
function switchPanel(id, btn) {
    document.querySelectorAll('.cuenta-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.cuenta-nav-link').forEach(b => b.classList.remove('active'));
    document.getElementById(id)?.classList.add('active');
    btn?.classList.add('active');
}

/* ── Datos personales: toggle edición ──────────────────────── */
function toggleEditDatos() {
    document.getElementById('vistaData').style.display = 'none';
    document.getElementById('formData').style.display  = 'block';
}
function cancelarEditDatos() {
    document.getElementById('vistaData').style.display = 'block';
    document.getElementById('formData').style.display  = 'none';
}
function guardarDatos() {
    const n  = document.getElementById('eNombre').value.trim();
    const t  = document.getElementById('eTel').value.trim();
    const e  = document.getElementById('eEmail').value.trim();
    const f  = document.getElementById('eFecha').value;

    if (!n || !t || !e) { alert('Por favor completa todos los campos obligatorios.'); return; }

    // Actualizar vista
    document.getElementById('vNombre').textContent = n;
    document.getElementById('vTel').textContent    = t;
    document.getElementById('vEmail').textContent  = e;
    if (f) {
        const [y, m, d] = f.split('-');
        const meses = ['enero','febrero','marzo','abril','mayo','junio',
                       'julio','agosto','septiembre','octubre','noviembre','diciembre'];
        document.getElementById('vFecha').textContent = `${parseInt(d)} de ${meses[parseInt(m)-1]} de ${y}`;
    }
    // Actualizar sidebar
    document.querySelector('.cuenta-sidebar-name').textContent  = n;
    document.querySelector('.cuenta-sidebar-email').textContent = e;
    const initials = n.split(' ').slice(0,2).map(w=>w[0]).join('').toUpperCase();
    document.querySelector('.cuenta-avatar').textContent = initials;

    cancelarEditDatos();
    alert('✅ Datos actualizados correctamente.');
}

/* ── Contraseña ─────────────────────────────────────────────── */
function cambiarPassword() {
    const a = document.getElementById('pwActual').value;
    const n = document.getElementById('pwNueva').value;
    const c = document.getElementById('pwConfirm').value;
    if (!a || !n || !c) { alert('Completa todos los campos.'); return; }
    if (n !== c) { alert('Las contraseñas nuevas no coinciden.'); return; }
    if (n.length < 8) { alert('La contraseña debe tener al menos 8 caracteres.'); return; }
    alert('✅ Contraseña actualizada.\n\n(En producción se guardará en la base de datos.)');
    document.getElementById('pwActual').value = '';
    document.getElementById('pwNueva').value  = '';
    document.getElementById('pwConfirm').value= '';
}

/* ── Direcciones ────────────────────────────────────────────── */
let _editandoDir = null;
const DIRS = [
    { id: 1, nombre: 'Carlos Ivan Luciano Cruz',
      calle: 'Rafael Murillo Vidal 485', colonia: 'Vías Férreas',
      ciudad: 'Veracruz', cp: '91713', estado: 'VERACRUZ',
      pais: 'México', tel: '229-483-2504' }
];

function renderDirecciones() {
    const cont = document.getElementById('listaDirecciones');
    cont.innerHTML = DIRS.map(d => `
        <div class="dir-item" id="dir-item-${d.id}">
            <div class="dir-item-name">${d.nombre}</div>
            <div class="dir-item-detail">
                ${d.calle}, Col. ${d.colonia}<br>
                ${d.ciudad}, ${d.estado} ${d.cp} · ${d.pais}<br>
                Teléfono: ${d.tel}
            </div>
            <div class="dir-item-actions">
                <button class="btn-dir-sec" onclick="editarDireccion(${d.id})">
                    <i class="fas fa-edit me-1"></i>Editar
                </button>
                <button class="btn-dir-sec" style="color:#dc3545;border-color:#f5c2c2"
                        onclick="eliminarDireccion(${d.id})">
                    <i class="fas fa-trash me-1"></i>Eliminar
                </button>
            </div>
        </div>`).join('');
}

function toggleFormDir() {
    _editandoDir = null;
    document.getElementById('formDirTitle').innerHTML = '<i class="fas fa-plus-circle me-2"></i>Nueva dirección';
    ['dNombre','dTel','dCalle','dColonia','dCiudad','dCP','dEstado'].forEach(id => {
        document.getElementById(id).value = '';
    });
    document.getElementById('dPais').value = 'México';
    const fw = document.getElementById('formDirWrapper');
    fw.style.display = fw.style.display === 'none' ? 'block' : 'none';
}

function editarDireccion(id) {
    const d = DIRS.find(x => x.id === id);
    if (!d) return;
    _editandoDir = id;
    document.getElementById('formDirTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Editar dirección';
    document.getElementById('dNombre').value  = d.nombre;
    document.getElementById('dTel').value     = d.tel;
    document.getElementById('dCalle').value   = d.calle;
    document.getElementById('dColonia').value = d.colonia;
    document.getElementById('dCiudad').value  = d.ciudad;
    document.getElementById('dCP').value      = d.cp;
    document.getElementById('dEstado').value  = d.estado;
    document.getElementById('dPais').value    = d.pais;
    document.getElementById('formDirWrapper').style.display = 'block';
    document.getElementById('formDirWrapper').scrollIntoView({ behavior: 'smooth' });
}

function eliminarDireccion(id) {
    if (!confirm('¿Deseas eliminar esta dirección?')) return;
    const idx = DIRS.findIndex(d => d.id === id);
    if (idx !== -1) DIRS.splice(idx, 1);
    renderDirecciones();
}

function guardarDireccion() {
    const vals = {
        nombre:  document.getElementById('dNombre').value.trim(),
        tel:     document.getElementById('dTel').value.trim(),
        calle:   document.getElementById('dCalle').value.trim(),
        colonia: document.getElementById('dColonia').value.trim(),
        ciudad:  document.getElementById('dCiudad').value.trim(),
        cp:      document.getElementById('dCP').value.trim(),
        estado:  document.getElementById('dEstado').value.trim().toUpperCase(),
        pais:    document.getElementById('dPais').value.trim(),
    };
    if (!vals.nombre || !vals.calle || !vals.ciudad || !vals.cp) {
        alert('Completa los campos obligatorios: nombre, calle, ciudad y C.P.');
        return;
    }
    if (_editandoDir) {
        const d = DIRS.find(x => x.id === _editandoDir);
        if (d) Object.assign(d, vals);
    } else {
        vals.id = Date.now();
        DIRS.push(vals);
    }
    renderDirecciones();
    cancelarDir();
    alert('✅ Dirección guardada correctamente.');
}

function cancelarDir() {
    document.getElementById('formDirWrapper').style.display = 'none';
    _editandoDir = null;
}

/* ── Tabs de pedidos ────────────────────────────────────────── */
function switchPedidoTab(id, btn) {
    document.querySelectorAll('.pedido-tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.pedido-tab-btn').forEach(b => b.classList.remove('active'));
    document.getElementById(id)?.classList.add('active');
    btn?.classList.add('active');
}