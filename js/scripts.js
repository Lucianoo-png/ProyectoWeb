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
                <a href="/proyectoweb/?" class="btn-seguir-vacio">
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
   DIRECCION.PHP + PAGO.PHP — absorbido desde pago.js
   ============================================================ */

/* ── Helpers de localStorage de direcciones ─────────────────── */
function getDirs() {
    try { return JSON.parse(localStorage.getItem('lc_direcciones') || '[]'); }
    catch (e) { return []; }
}

function saveDirs(arr) {
    localStorage.setItem('lc_direcciones', JSON.stringify(arr));
}

function getDirSeleccionada() {
    try { return JSON.parse(localStorage.getItem('lc_dir_seleccionada') || 'null'); }
    catch (e) { return null; }
}

function setDirSeleccionada(dir) {
    localStorage.setItem('lc_dir_seleccionada', JSON.stringify(dir));
}

/* ── Mostrar dirección en la tarjeta principal ───────────────── */
function mostrarDir(dir) {
    const nombreEl  = document.getElementById('dir-nombre-display');
    const detalleEl = document.getElementById('dir-detalle-display');
    if (!dir) {
        if (nombreEl)  nombreEl.textContent = '—';
        if (detalleEl) detalleEl.innerHTML  = 'No hay ninguna dirección guardada.';
        return;
    }
    if (nombreEl)  nombreEl.textContent = dir.nombre || '—';
    if (detalleEl) detalleEl.innerHTML  =
        `${dir.calle || ''}, Col. ${dir.colonia || ''}<br>` +
        `${dir.estado ? dir.estado.toUpperCase() + ' , ' : ''}${dir.colonia || ''}<br>` +
        `${dir.ciudad || ''}, ${dir.cp || ''}, ${dir.pais || 'México'}<br>` +
        `Teléfono: ${dir.tel || ''}`;
}

/* ── Enviar aquí → guardar seleccionada y redirigir a pago ───── */
function enviarAqui(dir) {
    const dirs    = getDirs();
    const destino = dir || getDirSeleccionada() || dirs[0];
    if (!destino) { showToast('No hay dirección seleccionada.'); return; }
    setDirSeleccionada(destino);
    cerrarTodasDirs();
    window.location.href = 'pago.php';
}

/* ── Borrar dirección ────────────────────────────────────────── */
function borrarDireccion(idx) {
    let dirs = getDirs();
    if (typeof idx === 'number') {
        dirs.splice(idx, 1);
    } else {
        const sel = getDirSeleccionada();
        if (sel) {
            dirs = dirs.filter(d =>
                !(d.nombre === sel.nombre && d.calle === sel.calle && d.cp === sel.cp)
            );
        }
    }
    saveDirs(dirs);
    localStorage.removeItem('lc_dir_seleccionada');
    if (dirs.length > 0) {
        setDirSeleccionada(dirs[0]);
        mostrarDir(dirs[0]);
    } else {
        mostrarDir(null);
    }
    showToast('Dirección eliminada.');
    cerrarTodasDirs();
    renderTodasDirs();
}

/* ── Abrir modal Editar ──────────────────────────────────────── */
function abrirEditar(idx) {
    const dirs = getDirs();
    let dir;
    if (typeof idx === 'number' && idx >= 0 && idx < dirs.length) {
        dir = dirs[idx];
        document.getElementById('edit-idx').value = idx;
    } else {
        dir = getDirSeleccionada() || dirs[0] || {};
        const realIdx = dirs.findIndex(d =>
            d.nombre === dir.nombre && d.calle === dir.calle && d.cp === dir.cp
        );
        document.getElementById('edit-idx').value = realIdx >= 0 ? realIdx : 0;
    }
    document.getElementById('edit-nombre').value  = dir.nombre  || '';
    document.getElementById('edit-tel').value     = dir.tel     || '';
    document.getElementById('edit-calle').value   = dir.calle   || '';
    document.getElementById('edit-colonia').value = dir.colonia || '';
    document.getElementById('edit-ciudad').value  = dir.ciudad  || '';
    document.getElementById('edit-cp').value      = dir.cp      || '';
    document.getElementById('edit-estado').value  = dir.estado  || '';
    document.getElementById('edit-pais').value    = dir.pais    || 'México';
    document.getElementById('modal-editar-titulo').innerHTML =
        '<i class="fas fa-edit me-2"></i>Editar dirección';
    document.getElementById('modal-editar').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function cerrarEditar() {
    document.getElementById('modal-editar')?.classList.remove('show');
    document.body.style.overflow = '';
}

/* ── Guardar edición ─────────────────────────────────────────── */
function guardarEdicion() {
    const dirs = getDirs();
    const idx  = parseInt(document.getElementById('edit-idx').value, 10);
    const dir  = {
        nombre:  document.getElementById('edit-nombre').value.trim(),
        tel:     document.getElementById('edit-tel').value.trim(),
        calle:   document.getElementById('edit-calle').value.trim(),
        colonia: document.getElementById('edit-colonia').value.trim(),
        ciudad:  document.getElementById('edit-ciudad').value.trim(),
        cp:      document.getElementById('edit-cp').value.trim(),
        estado:  document.getElementById('edit-estado').value.trim(),
        pais:    document.getElementById('edit-pais').value.trim() || 'México'
    };
    if (!dir.nombre) { alert('El nombre es obligatorio.'); return; }
    if (idx >= 0 && idx < dirs.length) {
        dirs[idx] = dir;
    } else {
        dirs.push(dir);
    }
    saveDirs(dirs);
    const sel       = getDirSeleccionada();
    const activaIdx = dirs.findIndex(d =>
        sel && d.nombre === sel.nombre && d.calle === sel.calle && d.cp === sel.cp
    );
    if (activaIdx === idx || !sel) {
        setDirSeleccionada(dir);
        mostrarDir(dir);
    }
    cerrarEditar();
    showToast('Dirección guardada correctamente.');
    renderTodasDirs();
}

/* ── Modal "Ver todas mis direcciones" ───────────────────────── */
function verTodasDirecciones(e) {
    if (e) e.preventDefault();
    renderTodasDirs();
    document.getElementById('modal-todas-dirs').classList.add('show');
    document.body.style.overflow = 'hidden';
}

function cerrarTodasDirs() {
    document.getElementById('modal-todas-dirs')?.classList.remove('show');
    document.body.style.overflow = '';
}

function renderTodasDirs() {
    const dirs  = getDirs();
    const lista = document.getElementById('todas-dirs-lista');
    if (!lista) return;
    const sel = getDirSeleccionada();
    if (!dirs.length) {
        lista.innerHTML = `
            <div style="text-align:center;padding:2rem;color:#aab4c4;grid-column:1/-1;">
                <i class="fas fa-map-marker-alt" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                No tienes direcciones guardadas aún.
            </div>`;
        return;
    }
    lista.innerHTML = dirs.map((dir, i) => {
        const esSeleccionada = sel &&
            dir.nombre === sel.nombre &&
            dir.calle  === sel.calle  &&
            dir.cp     === sel.cp;
        return `
        <div class="todas-dir-item${esSeleccionada ? ' selected-highlight' : ''}">
            <div class="todas-dir-nombre">${dir.nombre || '—'}</div>
            <div class="todas-dir-detalle">
                ${dir.calle || ''}<br>
                ${dir.estado ? dir.estado.toUpperCase() + ' , ' : ''}${dir.colonia || ''}<br>
                ${dir.ciudad || ''}, ${dir.cp || ''}, ${dir.pais || 'México'}<br>
                Teléfono: ${dir.tel || ''}
            </div>
            <div class="todas-dir-acciones">
                <button class="btn-enviar-aqui" onclick="seleccionarYEnviar(${i})">ENVIAR AQUÍ</button>
                <button class="btn-dir-sec" onclick="abrirEditar(${i})">Editar</button>
                <button class="btn-dir-sec" onclick="borrarDireccion(${i})">Borrar</button>
            </div>
        </div>`;
    }).join('');
}

/* ── Seleccionar del modal y redirigir ───────────────────────── */
function seleccionarYEnviar(idx) {
    const dirs = getDirs();
    if (idx < 0 || idx >= dirs.length) return;
    setDirSeleccionada(dirs[idx]);
    mostrarDir(dirs[idx]);
    cerrarTodasDirs();
    window.location.href = 'pago.php';
}

/* ── Toast de notificación ───────────────────────────────────── */
function showToast(msg) {
    const toast = document.getElementById('dir-toast');
    if (!toast) return;
    document.getElementById('dir-toast-msg').textContent = msg;
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);
}

/* ============================================================
   PAGO.PHP — absorbido desde pago.js
   ============================================================ */

/* ── Cargar dirección seleccionada ─────────────────────────── */
function cargarDirSeleccionada() {
    try {
        const raw = localStorage.getItem('lc_dir_seleccionada');
        const dir = raw ? JSON.parse(raw) : null;
        if (!dir) {
            const dirs = JSON.parse(localStorage.getItem('lc_direcciones') || '[]');
            if (dirs.length) cargarDir(dirs[0]);
            return;
        }
        cargarDir(dir);
    } catch (e) {}
}

function cargarDir(dir) {
    const nombreEl  = document.getElementById('pago-dir-nombre');
    const detalleEl = document.getElementById('pago-dir-detalle');
    if (nombreEl)  nombreEl.textContent = dir.nombre || '—';
    if (detalleEl) detalleEl.innerHTML  =
        `${dir.calle || ''}, Col. ${dir.colonia || ''}<br>` +
        `${dir.ciudad || ''}, ${dir.estado || ''} ${dir.cp || ''}, ${dir.pais || ''}<br>` +
        `Teléfono: ${dir.tel || ''}`;
}

/* ── Renderizar resumen del carrito en pago.php ─────────────── */
function renderResumenPago() {
    const cont   = document.getElementById('resumen-items');
    const totDiv = document.getElementById('resumen-totales');
    if (!cont) return;

    const carrito = obtenerCarrito();

    if (carrito.length === 0) {
        cont.innerHTML = '<div class="resumen-empty"><i class="fas fa-shopping-cart"></i>Tu carrito está vacío.</div>';
        return;
    }

    let subtotal = 0;
    cont.innerHTML = carrito.map(item => {
        subtotal += item.precio * item.cantidad;
        return `
        <div class="resumen-item">
            <img src="${item.imagen}" alt="${item.nombre}" class="resumen-img"
                 onerror="this.src='https://placehold.co/56x56?text=Prod'">
            <div class="resumen-item-info">
                <div class="resumen-item-name">${item.nombre}</div>
                <div class="resumen-item-qty">Cantidad: ${item.cantidad}</div>
            </div>
            <div class="resumen-item-precio">${formatPrecio(item.precio * item.cantidad)}</div>
        </div>`;
    }).join('');

    const iva   = subtotal * 0.16;
    const total = subtotal + iva;
    document.getElementById('res-subtotal').textContent = formatPrecio(subtotal);
    document.getElementById('res-iva').textContent      = formatPrecio(iva);
    document.getElementById('res-total').textContent    = formatPrecio(total);
    if (totDiv) totDiv.style.display = 'block';
}

/* ── Selector de método de pago ────────────────────────────── */
function setMetodo(metodo, btn) {
    document.querySelectorAll('.pago-metodo-btn').forEach(b => b.classList.remove('active'));
    document.querySelectorAll('.pago-panel').forEach(p => p.classList.remove('active'));
    btn.classList.add('active');
    document.getElementById('panel-' + metodo)?.classList.add('active');
}

/* ── Tarjeta visual: flip al CVV ───────────────────────────── */
function flipCard(toBack) {
    document.getElementById('cardInner')?.classList.toggle('flipped', toBack);
}

/* ── Formateo de inputs de tarjeta ─────────────────────────── */
function formatCardNumber(input) {
    let val = input.value.replace(/\D/g, '').slice(0, 16);
    val = val.replace(/(.{4})/g, '$1 ').trim();
    input.value = val;

    const display = document.getElementById('cardNumberDisplay');
    if (display) {
        const padded = val.replace(/\s/g, '').padEnd(16, '•');
        display.textContent = padded.replace(/(.{4})/g, '$1 ').trim();
    }

    const logoEl = document.getElementById('cardLogoFront');
    if (!logoEl) return;
    const digits = val.replace(/\s/g, '');
    if (digits.startsWith('4'))      logoEl.innerHTML = '<i class="fab fa-cc-visa"></i>';
    else if (/^5[1-5]/.test(digits)) logoEl.innerHTML = '<i class="fab fa-cc-mastercard"></i>';
    else if (/^3[47]/.test(digits))  logoEl.innerHTML = '<i class="fab fa-cc-amex"></i>';
    else                             logoEl.innerHTML = '<i class="far fa-credit-card"></i>';
}

function updateCardName(input) {
    const el = document.getElementById('cardNameDisplay');
    if (el) el.textContent = (input.value.toUpperCase() || 'NOMBRE APELLIDO').slice(0, 22);
}

function formatExp(input) {
    let val = input.value.replace(/\D/g, '').slice(0, 4);
    if (val.length >= 3) val = val.slice(0, 2) + '/' + val.slice(2);
    input.value = val;
    const el = document.getElementById('cardExpDisplay');
    if (el) el.textContent = val || 'MM/AA';
}

function updateCvv(input) {
    const val = input.value.replace(/\D/g, '').slice(0, 4);
    input.value = val;
    const el = document.getElementById('cardCvvDisplay');
    if (el) el.textContent = val ? val.replace(/./g, '•') : '•••';
}

/* ── Confirmar pedido ───────────────────────────────────────── */
function confirmarPedido() {
    const btn = document.getElementById('btnConfirmar');

    if (document.getElementById('panel-tarjeta')?.classList.contains('active')) {
        const num = document.getElementById('cardNumber').value.replace(/\s/g, '');
        const exp = document.getElementById('cardExp').value;
        const cvv = document.getElementById('cardCvv').value;
        const nom = document.getElementById('cardName').value.trim();
        if (num.length < 16) { alertPago('Ingresa un número de tarjeta válido (16 dígitos).'); return; }
        if (!/^\d{2}\/\d{2}$/.test(exp)) { alertPago('Ingresa una fecha de vencimiento válida (MM/AA).'); return; }
        if (cvv.length < 3)  { alertPago('Ingresa el CVV de tu tarjeta.'); return; }
        if (!nom)            { alertPago('Ingresa el nombre del titular.'); return; }
    }

    btn.classList.add('loading');
    btn.disabled = true;

    setTimeout(() => {
        btn.classList.remove('loading');
        btn.disabled = false;
        const ref = 'LC-' + Date.now().toString(36).toUpperCase().slice(-8);
        const refEl = document.getElementById('exito-ref-num');
        if (refEl) refEl.textContent = ref;
        localStorage.removeItem('lc_carrito');
        localStorage.removeItem('lc_dir_seleccionada');
        const modalExito = document.getElementById('modal-exito');
        if (modalExito) {
            modalExito.classList.add('show');
            document.body.style.overflow = 'hidden';
        }
    }, 2200);
}

/* ── Alerta inline ──────────────────────────────────────────── */
function alertPago(msg) {
    const existing = document.getElementById('pago-alert');
    if (existing) existing.remove();
    const el = document.createElement('div');
    el.id = 'pago-alert';
    el.style.cssText = 'background:#fff0f0;border:1.5px solid #f5c6cb;border-radius:8px;padding:.6rem 1rem;font-size:.82rem;color:#721c24;margin-top:.6rem;';
    el.innerHTML = `<i class="fas fa-exclamation-circle me-2"></i>${msg}`;
    document.getElementById('btnConfirmar')?.before(el);
    setTimeout(() => el.remove(), 4000);
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

    /* pago.php */
    if (document.getElementById('resumen-items')) {
        cargarDirSeleccionada();
        renderResumenPago();
    }

    /* direccion.php */
    if (document.getElementById('dir-nombre-display')) {
        let dirs = getDirs();
        if (dirs.length === 0) {
            dirs = [{
                nombre:  'Carlos Ivan Luciano Cruz',
                tel:     '2294832504',
                calle:   'Rafael Murillo Vidal 485 485, Tienda con fachada de Coca Cola',
                colonia: 'Vías Ferreas',
                ciudad:  'Veracruz',
                cp:      '91713',
                estado:  'VERACRUZ',
                pais:    'México'
            }];
            saveDirs(dirs);
        }
        let sel = getDirSeleccionada();
        if (!sel) { sel = dirs[0]; setDirSeleccionada(sel); }
        mostrarDir(sel);

        const modalTodas  = document.getElementById('modal-todas-dirs');
        const modalEditar = document.getElementById('modal-editar');
        if (modalTodas)  modalTodas.addEventListener('click',  e => { if (e.target === modalTodas)  cerrarTodasDirs(); });
        if (modalEditar) modalEditar.addEventListener('click', e => { if (e.target === modalEditar) cerrarEditar(); });
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
        cerrarTodasDirs();
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