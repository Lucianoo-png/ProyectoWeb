/* ============================================================
   LuchanosCorp — nueva_solicitud.js
   Lógica exclusiva de la página nueva_solicitud.php
   Campos del ER: Tipo, NoReferencia, Asunto, Descripcion, Evidencia
                  FechayHora (generada automáticamente al enviar)
   ============================================================ */

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

    if (archivo.size > 5 * 1024 * 1024) {
        alert('El archivo supera los 5 MB permitidos. Por favor selecciona uno más pequeño.');
        input.value = '';
        return;
    }

    /* Determinar icono según tipo MIME */
    const esPDF   = archivo.type === 'application/pdf';
    const iconEl  = document.getElementById('solFileIcon');
    if (iconEl) {
        iconEl.className = esPDF
            ? 'fas fa-file-pdf sol-file-pdf'
            : 'fas fa-file-image sol-file-img';
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

/* ═══════════════════════════════════════════════════════════════
   VALIDACIÓN Y ENVÍO
═══════════════════════════════════════════════════════════════ */

/**
 * Valida el formulario, genera el folio y la fecha, muestra el
 * toast de confirmación y redirige a inicio_usuario.php.
 */
function enviarSolicitud() {
    const tipo        = document.getElementById('solTipo')?.value.trim()        || '';
    const noRef       = document.getElementById('solNoReferencia')?.value.trim() || '';
    const asunto      = document.getElementById('solAsunto')?.value.trim()       || '';
    const descripcion = document.getElementById('solDescripcion')?.value.trim()  || '';
    const evidencia   = document.getElementById('solEvidencia');

    /* Marcar campos inválidos */
    _marcarCampo('solTipo',         !tipo);
    _marcarCampo('solNoReferencia', !noRef);
    _marcarCampo('solAsunto',       !asunto);
    _marcarCampo('solDescripcion',  !descripcion);

    if (!tipo || !noRef || !asunto || !descripcion) {
        document.querySelector('.is-invalid')
            ?.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }

    /* Validar tamaño de evidencia si existe */
    const archivo = evidencia?.files?.[0];
    if (archivo && archivo.size > 5 * 1024 * 1024) {
        alert('El archivo de evidencia supera los 5 MB permitidos.');
        return;
    }

    /* Deshabilitar botón y mostrar spinner */
    const btn = document.getElementById('btnEnviar');
    if (btn) {
        btn.disabled   = true;
        btn.innerHTML  = '<i class="fas fa-spinner fa-spin"></i> Enviando…';
    }

    /* Simular envío al backend (en producción: fetch/AJAX) */
    setTimeout(() => {
        /* Generar fecha y folio */
        const ahora   = new Date();
        const fecha   = _formatearFecha(ahora);
        _solFolioBase++;
        const folio   = 'LC-SOL-' + String(_solFolioBase).padStart(6, '0');

        /* Actualizar fecha en resumen lateral */
        const rF = document.getElementById('resumenFecha');
        if (rF) {
            rF.textContent    = fecha;
            rF.style.color    = '#222';
            rF.style.fontStyle = 'normal';
        }

        /* Mostrar toast de éxito */
        _setText('solToastFolio', folio);
        mostrarToast();

        /* Redirigir después de 3 segundos */
        setTimeout(() => {
            window.location.href = 'inicio_usuario.php';
        }, 3000);

    }, 1200);
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