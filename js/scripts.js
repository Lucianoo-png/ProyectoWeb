/* ============================================================
   Scripts Globales
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
    const maxPermitido = parseInt(input.getAttribute('max')) || 99;
    const valorActual = parseInt(input.value) || 1;
    input.value = Math.min(maxPermitido, Math.max(1, valorActual + delta));
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

async function agregarAlCarrito() {
    if (typeof PRODUCTO === 'undefined') return;
    await sincronizarCarritoConServidor();
    const qtyInput = parseInt(document.getElementById('cantidad')?.value) || 1;
    const colorRadio = document.querySelector('input[name="color_seleccionado"]:checked');
    let colorId = 0;
    let colorNombre = '';
    if (colorRadio) {
        colorId = colorRadio.value;
        colorNombre = colorRadio.getAttribute('data-nombre');
    }
    const carrito = obtenerCarrito();
    const itemExistente = carrito.find(i => (i.sku == PRODUCTO.id || i.id == PRODUCTO.id) && i.no_color == colorId);
    const qtyActual = itemExistente ? parseInt(itemExistente.cantidad) : 0;
    const qtyNueva = qtyActual + qtyInput;
    const response = await fetch(`/proyectoweb/carrito-reservar?sku=${PRODUCTO.id}&cantidad=${qtyNueva}&color_id=${colorId}`);
    const data = await response.json();

    if (data.success) {
        guardarCarrito(data.items);
        actualizarBadge();
        mostrarAlerta('exito', '¡Producto agregado correctamente a tu carrito!');
    } else {
        // 1. Mostramos el mensaje de error que manda el servidor
        mostrarAlerta('error', data.message || "No hay stock suficiente.");

        // 2. ACTUALIZACIÓN VISUAL EN TIEMPO REAL
        // Buscamos el contenedor del estatus de stock
        const stockStatusBox = document.querySelector('.stock-status-box');
        const btnCarrito = document.querySelector('button[onclick="agregarAlCarrito()"]');
        const qtyControl = document.querySelector('.qty-control');

        if (stockStatusBox) {
            // Cambiamos el mensaje a "Agotado" y el color a rojo
            stockStatusBox.innerHTML = `
                <div class="text-danger fw-bold">
                    <i class="fas fa-times-circle me-1"></i> Producto Agotado
                    <span class="text-muted fw-normal ms-1" style="font-size: 0.85rem;">
                        (0 unidad(es) en existencia)
                    </span>
                </div>`;
        }

        // 3. BLOQUEO DE CONTROLES
        // Desactivamos el botón de compra para que no siga intentando
        if (btnCarrito) {
            btnCarrito.disabled = true;
            btnCarrito.innerHTML = '<i class="fas fa-ban"></i> Agotado';
            btnCarrito.classList.replace('btn-primary', 'btn-secondary');
        }

        // Desactivamos selectores de cantidad si existen
        if (qtyControl) {
            qtyControl.style.opacity = "0.5";
            qtyControl.style.pointerEvents = "none";
            const inputQty = document.getElementById('cantidad');
            if (inputQty) inputQty.value = 0;
        }
    }
}


async function sincronizarCarritoConServidor() {
    try {
        const response = await fetch('/proyectoweb/carrito-obtener');
        const data = await response.json();

        // 1. Extraer datos con valores por defecto
        const items = data.items || [];
        const fueVenta = data.venta_reciente || false;

        // 2. Actualizar UI
        guardarCarrito(items);
        actualizarBadge();

        // 3. LA LÓGICA DE ORO
        const enCheckout = window.location.pathname.includes('/envio') || 
                           window.location.pathname.includes('/pago');

        // Si está vacío Y estamos en checkout Y NO es porque acabamos de vender...
        if (items.length === 0 && enCheckout && fueVenta === false) {
            mostrarAlerta('error', 'Tu carrito se ha vaciado por inactividad.');
            setTimeout(() => { 
                window.location.href = '/proyectoweb/carrito'; 
            }, 2000);
        }
        
    } catch (error) {
        console.error("Error sincronizando el carrito:", error);
    }
}

function mostrarAlerta(tipo, mensaje) {
    let contenedor = document.getElementById('contenedor-alertas');
    if (!contenedor) {
        contenedor = document.createElement('div');
        contenedor.id = 'contenedor-alertas';
        contenedor.style.cssText = `
            position: fixed !important; 
            top: 80px !important; /* Ajusta este valor si tu navbar es más alto */
            left: 50% !important; 
            transform: translateX(-50%) !important; /* Lo centra perfectamente */
            z-index: 999999 !important; 
            display: flex !important; 
            flex-direction: column !important; 
            align-items: center !important; /* Centra las tarjetas hijas */
            gap: 12px !important; 
            pointer-events: none !important;
            width: 100% !important; 
            margin: 0 !important;
        `;
        document.body.appendChild(contenedor);
    }
    const alerta = document.createElement('div');
    alerta.className = `alerta alerta-${tipo} shadow animate__animated animate__fadeInDown`;
    alerta.style.cssText = `
        position: relative !important; 
        pointer-events: auto !important; 
        margin: 0 !important;
        padding: 15px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        border-radius: 8px !important;
        width: 350px !important; 
        max-width: 90vw !important; /* Por si lo ven en celulares pequeños */
        box-sizing: border-box !important;
        left: auto !important;
        right: auto !important;
    `;
    const icono = tipo === 'exito' ? 'fa-check-circle' : 'fa-times-circle';
    alerta.innerHTML = `
        <div style="display: flex; align-items: center; gap: 12px; flex-grow: 1;">
            <i class="fas ${icono}" style="font-size: 1.3rem;"></i>
            <div style="font-weight: 600; font-size: 0.95rem; line-height: 1.3;">${mensaje}</div>
        </div>
        <button type="button" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; opacity: 0.6; padding: 0; line-height: 1;" onclick="this.parentElement.remove()">&times;</button>
    `;
    contenedor.appendChild(alerta);
}

let _timerInterval = null;

function iniciarTimerCarrito(segundosServidor = 900) {
    const timerEl = document.getElementById('cart-timer');
    if (!timerEl) return;
    clearInterval(_timerInterval);

    let tiempoRestante = segundosServidor;

    _timerInterval = setInterval(() => {
        if (tiempoRestante <= 0) {
            clearInterval(_timerInterval);
            localStorage.removeItem('lc_carrito');
            location.reload(); 
            return;
        }

        const min = String(Math.floor(tiempoRestante / 60)).padStart(2, '0');
        const seg = String(Math.floor(tiempoRestante % 60)).padStart(2, '0');
        timerEl.textContent = `⏱ Tu carrito se reserva por ${min}:${seg} min`;
        
        tiempoRestante--;
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
        const div = document.createElement('div');
        div.className = 'cart-item';
        let stockReal = parseInt(item.stock_disponible) || 0;
        let maxPermitido = Math.min(stockReal, 10); 
        for (let q = 1; q <= maxPermitido; q++) {
            opts += `<option value="${q}"${q === item.cantidad ? ' selected' : ''}>${q}</option>`;
        }
        div.innerHTML = `
            <img src="${"/proyectoweb/public/uploads/img/"+item.imagen}" alt="${item.nombre}" class="cart-item-img"
                 onerror="this.src='https://placehold.co/90x90?text=Producto'">
            <div class="cart-item-info">
                <div class="cart-item-name">${item.nombre}</div>
                <div class="cart-item-sku">No. de Producto: ${item.sku}</div>
                ${item.nombre_color ? `<div class="cart-item-sku" style="margin-bottom: 5px;">Color: <strong>${item.nombre_color}</strong></div>` : ''}
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
        const iva = totalPrecio * 0.16;
        const totalAPagar = totalPrecio + iva;
        document.getElementById('summary-productos').textContent = formatPrecio(totalPrecio);
        document.getElementById('summary-iva').textContent = formatPrecio(iva);
        document.getElementById('summary-total-pagar').textContent = formatPrecio(totalAPagar);
        summaryCard.style.display = 'block';
    }
    actualizarBadge();
}

async function realizarPedido() {
    const btn = document.querySelector('.btn-realizar-pedido');
    const textoOriginal = btn.innerHTML;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Validando...';
    btn.disabled = true;
    await sincronizarCarritoConServidor();
    const carrito = obtenerCarrito();
    if (carrito.length === 0) {
        mostrarAlerta('error', 'Tu reserva ha expirado o el carrito está vacío. Agrega productos para continuar.');
        btn.innerHTML = textoOriginal;
        btn.disabled = false;
        return;
    }
    window.location.href = '/proyectoweb/envio'; 
}

async function cambiarCantidadCarrito(idx, nuevaCantidad) {
    const carrito = obtenerCarrito();
    const item = carrito[idx];
    const colorId = item.no_color || 0;
    const response = await fetch(`/proyectoweb/carrito-reservar?sku=${item.sku}&cantidad=${nuevaCantidad}&color_id=${colorId}`);
    const data = await response.json();
    if (data.success) {
        guardarCarrito(data.items); 
        renderCarrito();
        if(data.segundos) iniciarTimerCarrito(data.segundos);
    } else {
        alert(data.message);
        location.reload(); 
    }
}

async function eliminarItem(idx) {
    const carrito = obtenerCarrito();
    const item = carrito[idx];
    const colorId = item.no_color || 0;
    const response = await fetch(`/proyectoweb/carrito-reservar?sku=${item.sku}&cantidad=0&color_id=${colorId}`);
    const data = await response.json();
    if (data.success) {
        guardarCarrito(data.items);
        renderCarrito();
    }
}
let MIS_DIRECCIONES = [];
let NOMBRE_CLIENTE = "";

async function cargarDirecciones() {
    const displayNombre = document.getElementById('dir-nombre-display');
    const displayDetalle = document.getElementById('dir-detalle-display');
    if (!displayNombre || !displayDetalle) return;

    try {
        const response = await fetch('/proyectoweb/envio?ajax=1');
        const data = await response.json();

        if (data.success) {
            MIS_DIRECCIONES = data.direcciones;
            NOMBRE_CLIENTE = data.nombre_cliente;

            if (MIS_DIRECCIONES.length > 0) {
                const dir = MIS_DIRECCIONES[0];
                displayNombre.textContent = NOMBRE_CLIENTE;
                displayDetalle.innerHTML = `
                    ${dir.calle_numero}, Col. ${dir.colonia}<br>
                    ${dir.ciudad}, ${dir.cp}, ${dir.estado}, ${dir.pais}
                `;
            }
        }
    } catch (error) {
        console.error("Error al cargar direcciones:", error);
    }
}

function actualizarTarjetaPrincipal() {
    const displayNombre = document.getElementById('dir-nombre-display');
    const displayDetalle = document.getElementById('dir-detalle-display');
    const cardPrincipal = document.getElementById('dir-card-1');
    if (!MIS_DIRECCIONES || MIS_DIRECCIONES.length === 0) {
        if (displayNombre) displayNombre.textContent = "No tienes direcciones registradas";
        if (displayDetalle) displayDetalle.innerHTML = '<p class="text-muted small">Haz clic en el botón para agregar una dirección.</p>';
        return;
    }

    const dir = MIS_DIRECCIONES[0];
    if (displayNombre) displayNombre.textContent = NOMBRE_CLIENTE;
    
    if (displayDetalle) {
        displayDetalle.innerHTML = `
            ${dir.calle_numero}<br>
            ${dir.colonia}, ${dir.cp}<br>
            ${dir.ciudad}, ${dir.estado}, ${dir.pais}
        `;
    }
    if (btnEnviarPrincipal) {
        btnEnviarPrincipal.onclick = () => seleccionarYEnviar(0);
    }
    if (cardPrincipal) cardPrincipal.style.display = 'block';
}

function verTodasDirecciones(event) {
    event.preventDefault();
    const lista = document.getElementById('todas-dirs-lista');
    lista.innerHTML = '';

    if (MIS_DIRECCIONES.length === 0) {
        lista.innerHTML = '<p class="p-3 text-center">No hay direcciones guardadas.</p>';
    } else {
        MIS_DIRECCIONES.forEach((dir, index) => {
            lista.innerHTML += `
                <div class="dir-address-card mb-3">
                    <div class="dir-address-name">${NOMBRE_CLIENTE}</div>
                    <div class="dir-address-detail">
                        ${dir.calle_numero}, Col. ${dir.colonia}<br>
                        ${dir.ciudad}, ${dir.cp}, ${dir.estado}, ${dir.pais}
                    </div>
                    <div class="dir-address-actions">
                        <button class="btn-enviar-aqui" onclick="seleccionarDireccion(${index})">ENVIAR AQUÍ</button>
                        <button class="btn-dir-sec" onclick="abrirEditar(${index})">Editar</button>
                    </div>
                </div>
            `;
        });
    }
    document.getElementById('modal-todas-dirs').style.display = 'flex';
}

document.addEventListener('DOMContentLoaded', cargarDirecciones);
function iniciarTimerCarrito(segundosServidor = 900) {
    const timerEl = document.getElementById('cart-timer');
    if (!timerEl) return;

    clearInterval(_timerInterval);
    let tiempoRestante = segundosServidor;

    _timerInterval = setInterval(() => {
        if (tiempoRestante <= 0) {
            clearInterval(_timerInterval);
            localStorage.removeItem('lc_carrito');
            location.reload(); 
            return;
        }

        const min = String(Math.floor(tiempoRestante / 60)).padStart(2, '0');
        const seg = String(Math.floor(tiempoRestante % 60)).padStart(2, '0');
        timerEl.textContent = `⏱ Tu carrito se reserva por ${min}:${seg} min`;
        
        tiempoRestante--;
    }, 1000);
}
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
    window.location.href = '/proyectoweb/pago';
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
    const dirs = MIS_DIRECCIONES; 
    const lista = document.getElementById('todas-dirs-lista');
    if (!lista) return;

    if (!dirs || !dirs.length) {
        lista.innerHTML = `
            <div style="text-align:center;padding:2rem;color:#aab4c4;grid-column:1/-1;">
                <i class="fas fa-map-marker-alt" style="font-size:2rem;display:block;margin-bottom:.5rem;"></i>
                No tienes direcciones guardadas aún.
            </div>`;
        return;
    }

    lista.innerHTML = dirs.map((dir, i) => {
        return `
        <div class="todas-dir-item">
            <div class="todas-dir-nombre">${NOMBRE_CLIENTE}</div>
            <div class="todas-dir-detalle">
                ${dir.calle_numero || ''}<br>
                ${dir.colonia || ''}<br>
                ${dir.ciudad || ''}, ${dir.cp || ''}, ${dir.estado || ''}, ${dir.pais || 'México'}
            </div>
            <div class="todas-dir-actions" style="margin-top:10px;">
                <button class="btn-enviar-aqui" onclick="seleccionarYEnviar(${i})">ENVIAR AQUÍ</button>
            </div>
        </div>`;
    }).join('');
}

async function seleccionarYEnviar(idx) {
    const response = await fetch('/proyectoweb/carrito-obtener');
    const data = await response.json();

    if (!data.success || data.items.length === 0) {
        mostrarAlerta('error', 'El carrito ha expirado. No puedes proceder al pago.');
        setTimeout(() => { window.location.href = '/proyectoweb/carrito'; }, 2000);
        return;
    }
    const dir = MIS_DIRECCIONES[idx]; 
    localStorage.setItem('direccion_envio_seleccionada', JSON.stringify(dir));

    window.location.href = '/proyectoweb/pago';
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
            <img src="${"/proyectoweb/public/uploads/img/"+item.imagen}" alt="${item.nombre}" class="resumen-img"
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

    const resumenCont = document.getElementById('resumen-items');
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

/* ── Comprueba si una fecha MM/AA ya venció ─────────────── */
function tarjetaVencida(valor) {
    if (!valor || valor.length < 5) return false; // incompleta, no validar aún
    const [mmStr, aaStr] = valor.split('/');
    const mes  = parseInt(mmStr, 10);
    const anio = 2000 + parseInt(aaStr, 10);
    if (isNaN(mes) || isNaN(anio)) return false;
    const hoy   = new Date();
    const mesHoy  = hoy.getMonth() + 1; // 1-12
    const anioHoy = hoy.getFullYear();
    // La tarjeta es válida hasta el último día del mes de vencimiento
    if (anio < anioHoy) return true;
    if (anio === anioHoy && mes < mesHoy) return true;
    return false;
}

function formatExp(input) {
    // 1. Quitar todo lo que no sea número
    let val = input.value.replace(/\D/g, '');
    
    // 2. Validar que el mes (primeros dos dígitos) no sea > 12
    if (val.length >= 2) {
        let mes = parseInt(val.substring(0, 2));
        if (mes > 12) val = '12' + val.substring(2);
        if (mes === 0) val = '01' + val.substring(2);
        
        // 3. Insertar el slash
        input.value = val.substring(0, 2) + '/' + val.substring(2, 4);
    } else {
        input.value = val;
    }

    // 4. Actualizar la tarjeta visual
    const el = document.getElementById('cardExpDisplay');
    if (el) el.textContent = input.value || 'MM/AA';

    // 5. Validar si la tarjeta está vencida y mostrar feedback visual
    let errEl = document.getElementById('exp-error-msg');
    if (!errEl) {
        errEl = document.createElement('div');
        errEl.id = 'exp-error-msg';
        errEl.style.cssText = 'color:#dc3545;font-size:.76rem;margin-top:.3rem;display:none;';
        errEl.innerHTML = '<i class="fas fa-exclamation-circle me-1"></i>Esta tarjeta ya está vencida.';
        input.parentNode.appendChild(errEl);
    }
    const btnPagar = document.getElementById('btnConfirmar');
    if (tarjetaVencida(input.value)) {
        input.style.borderColor = '#dc3545';
        input.style.boxShadow   = '0 0 0 3px rgba(220,53,69,.15)';
        if (el) el.style.color  = '#ff6b6b';
        errEl.style.display = 'block';
        if (btnPagar) btnPagar.disabled = true;
    } else {
        input.style.borderColor = '';
        input.style.boxShadow   = '';
        if (el) el.style.color  = '';
        errEl.style.display = 'none';
        if (btnPagar) btnPagar.disabled = false;
    }
}

function updateCvv(input) {
    const val = input.value.replace(/\D/g, '').slice(0, 4);
    input.value = val;
    const el = document.getElementById('cardCvvDisplay');
    if (el) el.textContent = val ? val.replace(/./g, '•') : '•••';
}

async function confirmarPedido() {
    const btn = document.getElementById('btnConfirmar');
    btn.disabled = true;
    await sincronizarCarritoConServidor(); 
    const response = await fetch('/proyectoweb/carrito-obtener');
    const data = await response.json();

    if (!data.success || data.items.length === 0) {
        mostrarAlerta('error', 'Lo sentimos, tu tiempo de reserva terminó mientras procesabas el pago.');
        setTimeout(() => { window.location.href = '/proyectoweb/carrito'; }, 2500);
        return;
    }
    const carrito = obtenerCarrito();
    if (carrito.length === 0) {
        mostrarAlerta('error', '¡Oh no! Tu tiempo de reserva ha terminado. Debes volver a agregar los productos.');
        setTimeout(() => window.location.href = '/proyectoweb/carrito', 2000);
        return;
    }
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
        renderResumenPago();

        // Bloquear submit si la tarjeta está vencida
        const pagoForm = document.querySelector('.pago-col-main form, form[action*="pago"]');
        if (pagoForm) {
            pagoForm.addEventListener('submit', function(e) {
                const expInput = document.getElementById('cardExp');
                if (expInput && tarjetaVencida(expInput.value)) {
                    e.preventDefault();
                    expInput.focus();
                    mostrarAlerta('error', 'La tarjeta ingresada está vencida. Por favor usa una tarjeta válida.');
                    expInput.style.borderColor = '#dc3545';
                    expInput.style.boxShadow   = '0 0 0 3px rgba(220,53,69,.15)';
                }
            });
        }
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

});
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
}

/* ── Contraseña ─────────────────────────────────────────────── */
function cambiarPassword() {
    const a = document.getElementById('pwActual').value;
    const n = document.getElementById('pwNueva').value;
    const c = document.getElementById('pwConfirm').value;
    if (!a || !n || !c) { alert('Completa todos los campos.'); return; }
    if (n !== c) { alert('Las contraseñas nuevas no coinciden.'); return; }
    if (n.length < 8) { alert('La contraseña debe tener al menos 8 caracteres.'); return; }
    document.getElementById('pwActual').value = '';
    document.getElementById('pwNueva').value  = '';
    document.getElementById('pwConfirm').value= '';
}

/* ── Direcciones ────────────────────────────────────────────── */
let _editandoDir = null;

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
    document.getElementById('updateDirId').value = '';
    ['dCalle', 'dColonia', 'dCP', 'dEstado'].forEach(id => {
        document.getElementById(id).value = '';
    });
    const selectCiudad = document.getElementById('dCiudad');
    selectCiudad.innerHTML = '<option value="" selected disabled>Primero selecciona un estado</option>';
    selectCiudad.disabled = true;
    document.getElementById('dPais').value = 'México';
    const fw = document.getElementById('formDirWrapper');
    fw.style.display = fw.style.display === 'none' ? 'block' : 'none';
}

function editarDireccion(id) {
    const d = DIRS.find(x => x.no_dirección == id);
    if (!d) return;

    _editandoDir = id;
    document.getElementById('formDirTitle').innerHTML = '<i class="fas fa-edit me-2"></i>Editar dirección';
    document.getElementById('dCalle').value   = d.calle_numero; 
    document.getElementById('dColonia').value = d.colonia;
    document.getElementById('dCP').value      = d.cp;
    document.getElementById('dPais').value    = d.pais;
    const selectEstado = document.getElementById('dEstado');
    const selectCiudad = document.getElementById('dCiudad');
    selectEstado.value = d.estado;
    selectEstado.dispatchEvent(new Event('change'));
    selectCiudad.value = d.ciudad;
    let inputHiddenId = document.getElementById('updateDirId');
    if (!inputHiddenId) {
        inputHiddenId = document.createElement('input');
        inputHiddenId.type = 'hidden';
        inputHiddenId.id = 'updateDirId';
        inputHiddenId.name = 'no_direccion';
        document.querySelector('#formDirWrapper form').appendChild(inputHiddenId);
    }
    inputHiddenId.value = id;
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

/* ── Validación de contraseña en tiempo real — Registro.php ──── */
/* Se activa solo si existe #pw-indicadores (página de registro)   */
/* ── Validación de contraseña — Registro.php ─────────────────── */
(function(){
    var REGLAS = [
        { id:'rl', label:'Mínimo 8 caracteres',               fn: function(v){ return v.length >= 8; } },
        { id:'ru', label:'Al menos una mayúscula',             fn: function(v){ return /[A-Z]/.test(v); } },
        { id:'rn', label:'Al menos un número',                 fn: function(v){ return /[0-9]/.test(v); } },
        { id:'rs', label:'Al menos un carácter especial (!@#$...)', fn: function(v){ return /[!@#$%^&*()\-_=+\[\]{};':"\\|,.<>/?`~]/.test(v); } }
    ];
    var COLS = ['#ef4444','#f97316','#eab308','#16a34a'];
    var LABS = ['Muy débil','Débil','Aceptable','Fuerte'];

    /* ─── Build UI inside #pw-indicadores ─── */
    var wrap = document.getElementById('pw-indicadores');
    if(!wrap) return;

    var html = '<div style="display:flex;gap:4px;margin-bottom:.28rem">';
    for(var b=0;b<4;b++) html += '<div id="pwb'+b+'" style="height:5px;flex:1;border-radius:3px;background:#e5e7eb;transition:background .22s"></div>';
    html += '</div>';
    html += '<p id="pwlabel" style="font-size:.72rem;color:#9ca3af;margin:.1rem 0 .35rem">Ingresa una contraseña</p>';
    REGLAS.forEach(function(r){
        html += '<p id="'+r.id+'" style="font-size:.76rem;color:#9ca3af;margin:.1rem 0;display:flex;align-items:center;gap:.45rem;transition:color .2s">'
              + '<i id="'+r.id+'i" class="fas fa-circle" style="font-size:.42rem;flex-shrink:0;transition:all .18s"></i>'
              + r.label+'</p>';
    });
    wrap.innerHTML = html;

    /* ─── Update strength bars + rules ─── */
    function checkPw(val){
        var ok = 0;
        REGLAS.forEach(function(r){
            var pass = r.fn(val);
            if(pass) ok++;
            var row = document.getElementById(r.id);
            var ico = document.getElementById(r.id+'i');
            if(!row||!ico) return;
            if(pass){
                row.style.color = '#16a34a';
                ico.className   = 'fas fa-check-circle';
                ico.style.fontSize = '.78rem';
            } else {
                row.style.color = '#9ca3af';
                ico.className   = 'fas fa-circle';
                ico.style.fontSize = '.42rem';
            }
        });
        for(var b=0;b<4;b++){
            var bar = document.getElementById('pwb'+b);
            if(bar) bar.style.background = b < ok ? COLS[ok-1] : '#e5e7eb';
        }
        var lbl = document.getElementById('pwlabel');
        if(lbl){
            lbl.textContent = val ? (LABS[ok-1]||'Muy débil') : 'Ingresa una contraseña';
            lbl.style.color = val ? (COLS[ok-1]||'#ef4444')   : '#9ca3af';
        }
        return ok === REGLAS.length;
    }

    /* ─── Función central: habilita botón solo si TODO está bien ─── */
    function actualizarBoton(){
        var pw1 = document.getElementById('password');
        var pw2 = document.getElementById('confirmPassword');
        var btn = document.getElementById('btnRegistrar');
        if(!btn) return;
        var pwFuerte = pw1 ? checkPw(pw1.value) : false;
        var coinciden = pw1 && pw2 ? pw1.value === pw2.value && pw2.value !== '' : false;
        btn.disabled = !(pwFuerte && coinciden);
    }

    /* ─── Update confirm match ─── */
    function checkConfirm(){
        var pw1 = document.getElementById('password');
        var pw2 = document.getElementById('confirmPassword');
        var msg = document.getElementById('pw-confirm-msg');
        if(!pw1||!pw2||!msg) return;
        var v2 = pw2.value;
        if(!v2){
            msg.innerHTML='';
            pw2.style.borderColor='';
            actualizarBoton();
            return;
        }
        var match = pw1.value === v2;
        msg.innerHTML = match
            ? '<span style="color:#16a34a;font-weight:600">&#10003; Las contraseñas coinciden</span>'
            : '<span style="color:#ef4444;font-weight:600">&#10007; Las contraseñas no coinciden</span>';
        pw2.style.borderColor = match ? '#16a34a' : '#ef4444';
        actualizarBoton();
    }

    /* ─── Attach listeners ─── */
    var pw1 = document.getElementById('password');
    var pw2 = document.getElementById('confirmPassword');
    var EVTS = ['input','keyup','keydown','change'];

    if(pw1){
        EVTS.forEach(function(e){
            pw1.addEventListener(e, function(){
                checkPw(this.value);
                actualizarBoton();
                if(pw2 && pw2.value) checkConfirm();
            });
        });
    }
    if(pw2){
        EVTS.forEach(function(e){
            pw2.addEventListener(e, function(){ checkConfirm(); });
        });
    }

    /* ─── Block submit if invalid ─── */
    var form = pw1 && (pw1.closest ? pw1.closest('form') : null);
    if(!form) form = document.querySelector('form');
    if(form){
        form.addEventListener('submit', function(e){
            if(!checkPw(pw1.value)){ e.preventDefault(); pw1.focus(); return; }
            if(pw2 && pw1.value !== pw2.value){ e.preventDefault(); pw2.focus(); }
        });
    }
})();


/* ── Bootstrap needs-validation — recuperar_cuenta.php ──────── */
/* Activa solo si hay formularios .needs-validation en la página  */
(function () {
    'use strict';
    var forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
})();