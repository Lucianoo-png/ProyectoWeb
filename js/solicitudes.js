/* ============================================================
   LuchanosCorp — Vendedor: Solicitudes de Clientes
   Archivo: js/solicitudes.js
   ============================================================ */

/* ── Abrir modal con datos de la solicitud ───────────────── */
function abrirSolicitud(data) {
    const overlay = document.getElementById('modalSolicitud');
    if (!overlay) return;

    document.getElementById('modal-ref').textContent       = data.ref      || '';
    document.getElementById('modal-cliente').textContent   = data.cliente  || '';
    document.getElementById('modal-tipo').textContent      = data.tipo     || '';
    document.getElementById('modal-fecha').textContent     = data.fecha    || '';
    document.getElementById('modal-asunto').textContent    = data.asunto   || '';
    document.getElementById('modal-desc').textContent      = data.desc     || '';
    document.getElementById('modal-evidencia').textContent = data.evidencia || 'Sin evidencia adjunta';

    const respEl = document.getElementById('modal-respuesta');
    if (respEl) respEl.value = '';

    const estEl = document.getElementById('modal-estado');
    if (estEl) estEl.value = 'en_proceso';

    overlay.classList.add('show');
    document.body.style.overflow = 'hidden';
}

/* ── Cerrar modal ────────────────────────────────────────── */
function cerrarModalSolicitud() {
    const overlay = document.getElementById('modalSolicitud');
    if (!overlay) return;
    overlay.classList.remove('show');
    document.body.style.overflow = '';
}

/* ── Guardar respuesta / cambiar estado ──────────────────── */
function guardarRespuesta() {
    const respuesta = document.getElementById('modal-respuesta')?.value.trim();
    const estado    = document.getElementById('modal-estado')?.value;

    if (!respuesta) {
        mostrarAlertaSol('Escribe una respuesta antes de guardar.', 'warning');
        return;
    }

    /*
     * Fetch al backend — descomentar cuando esté listo:
     *
     * const ref = document.getElementById('modal-ref')?.textContent;
     * fetch('../../control/atender_solicitud.php', {
     *     method: 'POST',
     *     headers: { 'Content-Type': 'application/json' },
     *     body: JSON.stringify({ ref, respuesta, estado }),
     * })
     * .then(r => r.json())
     * .then(data => {
     *     cerrarModalSolicitud();
     *     mostrarAlertaSol('Solicitud actualizada correctamente.', 'success');
     * })
     * .catch(() => mostrarAlertaSol('Error al guardar. Intenta de nuevo.', 'error'));
     */

    // Simulación demo
    cerrarModalSolicitud();
    mostrarAlertaSol('✓ Solicitud atendida y estado actualizado correctamente.', 'success');
}

/* ── Alerta inline ───────────────────────────────────────── */
function mostrarAlertaSol(msg, tipo) {
    const colores = { success: '#e6f9f2', warning: '#fff8e1', error: '#fff0f0' };
    const bordes  = { success: '#34c98b', warning: '#ffc107', error: '#f44' };
    let box = document.getElementById('alertaSol');
    if (!box) {
        box = document.createElement('div');
        box.id = 'alertaSol';
        box.style.cssText = 'border-radius:.5rem;padding:.85rem 1.25rem;font-size:.87rem;margin-bottom:1rem;';
        const main = document.querySelector('.admin-content');
        if (main) main.prepend(box);
    }
    box.style.background = colores[tipo] || colores.warning;
    box.style.border     = '1.5px solid ' + (bordes[tipo] || bordes.warning);
    box.style.display    = 'block';
    box.innerHTML        = msg;
    setTimeout(() => { if (box) box.style.display = 'none'; }, 5000);
}

/* ── Init ────────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    // Delegación de eventos para botones "Atender" (data-sol attribute)
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.js-atender');
        if (btn) {
            try {
                const data = JSON.parse(btn.dataset.sol);
                abrirSolicitud(data);
            } catch (err) { console.error('Error parsing solicitud data', err); }
        }
    });

    // Botones del modal por ID (sin onclick inline)
    const btnCerrar   = document.getElementById('btnCerrarModal');
    const btnCancelar = document.getElementById('btnCancelarSol');
    const btnGuardar  = document.getElementById('btnGuardarSol');
    if (btnCerrar)   btnCerrar.addEventListener('click',   cerrarModalSolicitud);
    if (btnCancelar) btnCancelar.addEventListener('click', cerrarModalSolicitud);
    if (btnGuardar)  btnGuardar.addEventListener('click',  guardarRespuesta);

    // Cerrar modal al hacer clic en el overlay
    const overlay = document.getElementById('modalSolicitud');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) cerrarModalSolicitud();
        });
    }

    // Cerrar con Escape
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') cerrarModalSolicitud();
    });
});