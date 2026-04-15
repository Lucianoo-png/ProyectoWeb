/* ════════════════════════════════════════════════════════
   inicio_proveedor.js
   Lógica del portal de inicio del proveedor
════════════════════════════════════════════════════════ */

/* ══════════════════════════════════════════════════════
   DATOS DE SOLICITUDES (mock — reemplazar con PHP/BD)
══════════════════════════════════════════════════════ */
const SOLICITUDES = {
    'LC-REA-2026-031': {
        folio: 'LC-REA-2026-031',
        fecha: '28/03/2026 10:45',
        nota:  'Reabasto urgente línea blanca. Se requieren los productos a la brevedad posible.',
        productos: [
            { sku: 'WRS315SNHM', nombre: 'Refrigerador Side by Side 25 pies', cantSolicitada: 10 },
            { sku: 'WRT518SZFM', nombre: 'Refrigerador Top Mount 18 pies',     cantSolicitada: 8  },
            { sku: 'WED5000DW',  nombre: 'Secadora eléctrica 7.0 pies',         cantSolicitada: 15 },
            { sku: 'WFW5620HW',  nombre: 'Lavadora carga frontal 4.5 pies',     cantSolicitada: 20 },
        ]
    },
    'LC-REA-2026-028': {
        folio: 'LC-REA-2026-028',
        fecha: '25/03/2026 08:20',
        nota:  'Stock bajo detectado en microondas. Solicitud prioritaria.',
        productos: [
            { sku: 'WM3911D',    nombre: 'Microondas de mesa AirFry 1CuFt',  cantSolicitada: 25 },
            { sku: 'WMH31017HZ', nombre: 'Microondas sobre rango 1.7 pies',  cantSolicitada: 12 },
        ]
    }
};

/* ══════════════════════════════════════════════════════
   NAVEGACIÓN ENTRE PANELES
══════════════════════════════════════════════════════ */
function switchPanel(id, btn) {
    document.querySelectorAll('.cuenta-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.cuenta-nav-link').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    if (btn) btn.classList.add('active');
}

/* ══════════════════════════════════════════════════════
   ABRIR SOLICITUD PARA RESPONDER
══════════════════════════════════════════════════════ */
function abrirSolicitud(folio) {
    const sol = SOLICITUDES[folio];
    if (!sol) return;

    document.getElementById('folio-activo').textContent    = folio;
    document.getElementById('nota-admin-txt').textContent  = sol.nota;
    document.getElementById('alerta-enviada').classList.remove('show');
    document.getElementById('obs-proveedor').value         = '';

    // Renderizar fila de productos
    const cont = document.getElementById('productos-solicitud');
    cont.innerHTML = sol.productos.map(p => `
        <div class="prod-row" id="row-${p.sku}">
            <div class="prod-row-info">
                <div class="prod-row-sku">${p.sku}</div>
                <div class="prod-row-name">${p.nombre}</div>
            </div>
            <span class="prod-row-qty">
                <i class="fas fa-arrow-down me-1"></i> Solicitado: <strong>${p.cantSolicitada}</strong>
            </span>
            <div class="qty-input-wrap">
                <label>Cantidad a suministrar:</label>
                <div>
                    <input type="number" id="qty-${p.sku}"
                           min="${p.cantSolicitada}" value="${p.cantSolicitada}"
                           oninput="validarCantidad('${p.sku}', ${p.cantSolicitada})">
                    <div class="qty-warning" id="warn-${p.sku}">
                        <i class="fas fa-exclamation-circle me-1"></i>
                        La cantidad no puede ser menor a ${p.cantSolicitada}.
                    </div>
                </div>
            </div>
        </div>
    `).join('');

    const wrapper = document.getElementById('responder-wrapper');
    wrapper.classList.add('show');
    wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function cerrarResponder() {
    document.getElementById('responder-wrapper').classList.remove('show');
}

/* ══════════════════════════════════════════════════════
   VALIDAR CANTIDAD (debe ser ≥ solicitada — regla de negocio)
══════════════════════════════════════════════════════ */
function validarCantidad(sku, minimo) {
    const input = document.getElementById('qty-' + sku);
    const warn  = document.getElementById('warn-' + sku);
    if (parseInt(input.value) < minimo) {
        input.style.borderColor = '#dc2626';
        warn.style.display = 'block';
    } else {
        input.style.borderColor = '#22c55e';
        warn.style.display = 'none';
    }
}

/* ══════════════════════════════════════════════════════
   ENVIAR RESPUESTA A SOLICITUD
══════════════════════════════════════════════════════ */
function enviarRespuesta() {
    const folio = document.getElementById('folio-activo').textContent;
    const sol   = SOLICITUDES[folio];
    if (!sol) return;

    // Validar que todas las cantidades sean >= solicitadas
    let valido = true;
    sol.productos.forEach(p => {
        const val = parseInt(document.getElementById('qty-' + p.sku).value);
        if (isNaN(val) || val < p.cantSolicitada) {
            validarCantidad(p.sku, p.cantSolicitada);
            valido = false;
        }
    });

    if (!valido) {
        alert('Corrige las cantidades marcadas en rojo antes de enviar.');
        return;
    }

    // Simular envío — reemplazar con fetch/POST al backend
    document.getElementById('alerta-enviada').classList.add('show');
    document.getElementById('alerta-enviada').scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    // Actualizar badge de pendientes
    const badge  = document.getElementById('badge-pendientes');
    const actual = parseInt(badge.textContent);
    if (actual > 1) badge.textContent = actual - 1;
    else badge.style.display = 'none';
}

/* ══════════════════════════════════════════════════════
   PERFIL — toggles vista / formulario
══════════════════════════════════════════════════════ */
function toggleEditEmpresa() {
    const v = document.getElementById('vistaEmpresa');
    const f = document.getElementById('formEmpresa');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function guardarEmpresa() {
    alert('Datos de empresa actualizados correctamente.');
    toggleEditEmpresa();
}

function toggleEditContacto() {
    const v = document.getElementById('vistaContacto');
    const f = document.getElementById('formContacto');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function guardarContacto() {
    alert('Datos de contacto actualizados correctamente.');
    toggleEditContacto();
}

function toggleEditPass() {
    const v = document.getElementById('vistaPass');
    const f = document.getElementById('formPass');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function cambiarPassword() {
    const actual  = document.getElementById('passActual').value;
    const nueva   = document.getElementById('passNueva').value;
    const confirm = document.getElementById('passConfirm').value;
    if (!actual || !nueva || !confirm) {
        alert('Completa todos los campos de contraseña.');
        return;
    }
    if (nueva !== confirm) {
        alert('La nueva contraseña y su confirmación no coinciden.');
        return;
    }
    if (nueva.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }
    alert('Contraseña actualizada correctamente.');
    toggleEditPass();
}

/* ══════════════════════════════════════════════════════
   REDIRIGIR AL HISTORIAL
══════════════════════════════════════════════════════ */
function verHistorial(folio) {
    switchPanel(
        'panel-historial',
        document.querySelectorAll('.cuenta-nav-link')[2]
    );
}