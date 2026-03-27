/* ══════════════════════════════════════════════════
   ayuda.js — Scripts exclusivos de ayuda.php
   LuchanosCorp | Soporte y Ayuda
   ══════════════════════════════════════════════════ */

/* ── CHIPS DE ASUNTO ────────────────────────────────────────── */
document.querySelectorAll('.chip').forEach(chip => {
    chip.addEventListener('click', () => {
        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        chip.classList.add('active');
        document.getElementById('asunto').value = chip.dataset.valor;
        clearError('asunto');
    });
});

/* ── CONTADOR DE CARACTERES ─────────────────────────────────── */
const queja     = document.getElementById('queja');
const charCount = document.getElementById('charCount');

queja.addEventListener('input', () => {
    const len = queja.value.length;
    charCount.textContent = `${len} / 1000 caracteres`;
    charCount.classList.toggle('warn', len > 900);
});

/* ── DRAG & DROP / SELECCIÓN DE ARCHIVO ─────────────────────── */
const fileDrop = document.getElementById('fileDrop');
const adjunto  = document.getElementById('adjunto');
const fileLabel = document.getElementById('fileLabel');

adjunto.addEventListener('change', () => showFile(adjunto.files[0]));

fileDrop.addEventListener('dragover', e => {
    e.preventDefault();
    fileDrop.style.borderColor = 'var(--azul-claro)';
});
fileDrop.addEventListener('dragleave', () => {
    fileDrop.style.borderColor = '';
});
fileDrop.addEventListener('drop', e => {
    e.preventDefault();
    fileDrop.style.borderColor = '';
    const f = e.dataTransfer.files[0];
    if (f) {
        adjunto.files = e.dataTransfer.files;
        showFile(f);
    }
});

function showFile(f) {
    if (!f) return;
    fileLabel.innerHTML = `<strong>${f.name}</strong><br><small>${(f.size / 1024).toFixed(1)} KB</small>`;
    fileDrop.style.borderColor = 'var(--exito)';
}

/* ── VALIDACIÓN ──────────────────────────────────────────────── */
function setError(id, show) {
    const el  = document.getElementById(id);
    const err = document.getElementById('err-' + id);
    if (show) {
        el?.classList.add('is-invalid-custom');
        err?.classList.add('show');
    } else {
        el?.classList.remove('is-invalid-custom');
        err?.classList.remove('show');
    }
}

function clearError(id) {
    setError(id, false);
}

['nombre', 'email', 'asunto', 'queja'].forEach(id => {
    document.getElementById(id)?.addEventListener('input', () => clearError(id));
});

/* ── ENVÍO DEL FORMULARIO ────────────────────────────────────── */
document.getElementById('ayudaForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let ok = true;

    const nombre     = document.getElementById('nombre').value.trim();
    const email      = document.getElementById('email').value.trim();
    const asunto     = document.getElementById('asunto').value.trim();
    const quejaVal   = queja.value.trim();
    const privacidad = document.getElementById('privacidad').checked;

    if (!nombre)                              { setError('nombre', true);  ok = false; }
    if (!email || !/\S+@\S+\.\S+/.test(email)) { setError('email', true);  ok = false; }
    if (!asunto)                              { setError('asunto', true);  ok = false; }
    if (quejaVal.length < 20)                 { setError('queja', true);   ok = false; }

    if (!privacidad) {
        document.getElementById('err-privacidad').classList.add('show');
        ok = false;
    } else {
        document.getElementById('err-privacidad').classList.remove('show');
    }

    if (!ok) return;

    /* Simula envío → muestra panel de confirmación */
    const folio = 'LC-' + Date.now().toString().slice(-8);
    document.getElementById('folioNum').textContent = 'Folio: ' + folio;
    document.getElementById('panelFormulario').style.display = 'none';

    const conf = document.getElementById('panelConfirmacion');
    conf.style.display = 'block';
    conf.scrollIntoView({ behavior: 'smooth', block: 'center' });
});