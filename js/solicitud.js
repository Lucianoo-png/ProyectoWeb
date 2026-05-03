'use strict';

/* ── Contador base para folios locales ──────────────────────── */
let _solFolioBase = 300;

/* ═══════════════════════════════════════════════════════════════
   INICIALIZACIÓN
═══════════════════════════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    actualizarResumen();
    _initDropzone();
    if (typeof actualizarBadge === 'function') actualizarBadge();
});

/* ═══════════════════════════════════════════════════════════════
   RESUMEN LATERAL EN TIEMPO REAL
═══════════════════════════════════════════════════════════════ */

/**
 * Actualiza el panel lateral de resumen conforme el usuario llena el formulario.
 * Llamada desde los atributos oninput/onchange del HTML.
 */
function actualizarResumen() {
    _actualizarTipoResumen();
    _actualizarTextoResumen('solNoReferencia', 'resumenRef');
    _actualizarTextoResumen('solAsunto',       'resumenAsunto', 55);
}

function _actualizarTipoResumen() {
    const tipo    = document.getElementById('solTipo')?.value || '';
    const span    = document.getElementById('resumenTipo');
    if (!span) return;

    const mapa = {
        'Garantía':  '<span class="sol-tipo-badge garantia"><i class="fas fa-shield-alt"></i> Garantía</span>',
        'Devolución':'<span class="sol-tipo-badge devolucion"><i class="fas fa-undo-alt"></i> Devolución</span>',
    };
    span.innerHTML = mapa[tipo] || '<span class="sol-tipo-badge none">Sin seleccionar</span>';
}

function _actualizarTextoResumen(inputId, spanId, maxLen) {
    const valor = document.getElementById(inputId)?.value.trim() || '';
    const span  = document.getElementById(spanId);
    if (!span) return;

    let texto = valor;
    if (maxLen && texto.length > maxLen) texto = texto.substring(0, maxLen) + '…';

    span.textContent    = texto || '—';
    span.style.color    = texto ? '#222'   : '#8a9bb5';
    span.style.fontStyle = texto ? 'normal' : 'italic';
}

/* ═══════════════════════════════════════════════════════════════
   CONTADOR DE CARACTERES
═══════════════════════════════════════════════════════════════ */

/**
 * Actualiza el contador de caracteres de un textarea/input.
 * @param {HTMLElement} el      - El campo de texto
 * @param {string}      spanId  - ID del <span> donde se muestra el conteo
 * @param {number}      max     - Límite máximo de caracteres
 */
function contarCaracteres(el, spanId, max) {
    const span = document.getElementById(spanId);
    if (!span) return;
    const count = el.value.length;
    span.textContent = count;
    span.style.color = count >= max * 0.9 ? '#dc3545' : '';
}

/* ═══════════════════════════════════════════════════════════════
   MANEJO DE EVIDENCIA (DRAG & DROP + INPUT FILE)
═══════════════════════════════════════════════════════════════ */

/** Inicializa los eventos de drag & drop en el dropzone. */
function _initDropzone() {
    const dropzone = document.getElementById('solDropzone');
    if (!dropzone) return;

    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('dragover');
    });
    dropzone.addEventListener('dragleave', () => {
        dropzone.classList.remove('dragover');
    });
    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('dragover');
        const archivo = e.dataTransfer?.files?.[0];
        if (!archivo) return;
        const input = document.getElementById('solEvidencia');
        if (!input) return;
        const dt = new DataTransfer();
        dt.items.add(archivo);
        input.files = dt.files;
        manejarEvidencia(input);
    });
}

/**
 * Procesa el archivo seleccionado: valida tamaño,
 * muestra preview y actualiza el resumen lateral.
 * @param {HTMLInputElement} input
 */
function manejarEvidencia(input) {
    const archivo = input.files?.[0];
    if (!archivo) { quitarEvidencia(); return; }

    /* Determinar icono según tipo MIME (CON EL PARCHE PARA SVG) */
    const esPDF   = archivo.type === 'application/pdf';
    const iconEl  = document.getElementById('solFileIcon');
    if (iconEl) {
        const nuevaClase = esPDF 
            ? 'fas fa-file-pdf sol-file-pdf' 
            : 'fas fa-file-image sol-file-img';
        // Usamos setAttribute para que FontAwesome no explote
        iconEl.setAttribute('class', nuevaClase);
    }

    /* Mostrar nombre y peso */
    _setText('solFileName', archivo.name);
    _setText('solFileSize', '(' + (archivo.size / 1024).toFixed(0) + ' KB)');

    /* Mostrar preview y ocultar dropzone */
    document.getElementById('solFilePreview')?.classList.add('visible');
    document.getElementById('solDropzone').style.display = 'none';

    /* Actualizar resumen lateral */
    const rEv = document.getElementById('resumenEvidencia');
    if (rEv) {
        rEv.textContent    = archivo.name;
        rEv.style.color    = '#222';
        rEv.style.fontStyle = 'normal';
    }
}

/** Elimina el archivo seleccionado y restaura el dropzone. */
function quitarEvidencia() {
    const input = document.getElementById('solEvidencia');
    if (input) input.value = '';

    document.getElementById('solFilePreview')?.classList.remove('visible');
    const dz = document.getElementById('solDropzone');
    if (dz) dz.style.display = '';

    const rEv = document.getElementById('resumenEvidencia');
    if (rEv) {
        rEv.textContent    = 'Sin archivo';
        rEv.style.color    = '#8a9bb5';
        rEv.style.fontStyle = 'italic';
    }
}


/* ─── Helpers de validación ─────────────────────────────────── */

/**
 * Marca o desmarca un campo como inválido.
 * @param {string}  id       - ID del elemento
 * @param {boolean} invalido - true = marcar inválido
 */
function _marcarCampo(id, invalido) {
    const el = document.getElementById(id);
    if (!el) return;
    if (invalido) {
        el.classList.add('is-invalid');
        /* Auto-desmarcar al corregir */
        const limpiar = () => el.classList.remove('is-invalid');
        el.addEventListener('input',  limpiar, { once: true });
        el.addEventListener('change', limpiar, { once: true });
    } else {
        el.classList.remove('is-invalid');
    }
}

/* ═══════════════════════════════════════════════════════════════
   TOAST
═══════════════════════════════════════════════════════════════ */

/** Muestra el toast de confirmación y lo cierra automáticamente. */
function mostrarToast() {
    const toast = document.getElementById('solToast');
    if (!toast) return;
    toast.classList.add('visible');
    setTimeout(cerrarToast, 6000);
}

/** Oculta el toast. */
function cerrarToast() {
    document.getElementById('solToast')?.classList.remove('visible');
}

/* ═══════════════════════════════════════════════════════════════
   UTILIDADES
═══════════════════════════════════════════════════════════════ */

/**
 * Formatea una fecha como "DD/MM/YYYY HH:MM".
 * @param {Date} date
 * @returns {string}
 */
function _formatearFecha(date) {
    const pad = n => String(n).padStart(2, '0');
    return pad(date.getDate())    + '/' +
           pad(date.getMonth()+1) + '/' +
           date.getFullYear()     + ' ' +
           pad(date.getHours())   + ':' +
           pad(date.getMinutes());
}

/**
 * Asigna textContent a un elemento de forma segura.
 * @param {string} id
 * @param {string} texto
 */
function _setText(id, texto) {
    const el = document.getElementById(id);
    if (el) el.textContent = texto;
}