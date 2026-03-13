/* ============================================================
   ElectroPendejo — Scripts Globales
   Ruta para referenciar según nivel:
     - index.php          →  js/scripts.js
     - vista/Cuenta/      →  ../../js/scripts.js
     - vista/Producto/    →  ../../js/scripts.js
   ============================================================ */

/* ── Toggle mostrar / ocultar contraseña (login.php) ─────────── */
function togglePassword() {
    const input = document.getElementById('password');
    const icon  = document.getElementById('eyeIcon');
    if (!input || !icon) return;
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

/* ── Toggle múltiple (Registro.php) ─────────────────────────── */
function togglePw(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon  = document.getElementById(iconId);
    if (!input || !icon) return;
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}

/* ── Selector de cantidad en detalle de producto (detalle.php) ── */
function cambiarCantidad(delta) {
    const input = document.getElementById('cantidad');
    if (!input) return;
    let val = parseInt(input.value) + delta;
    if (val < 1)  val = 1;
    if (val > 99) val = 99;
    input.value = val;
}

/* ── Selector de cantidad en carrito (carrito.php) ───────────── */
function cambiarQty(delta) {
    const input = document.getElementById('qty');
    if (!input) return;
    let val = parseInt(input.value) + delta;
    if (val < 1)  val = 1;
    if (val > 99) val = 99;
    input.value = val;
}

/* ── Init global ─────────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {

    // Fix dropdown en contenedor sticky-top
    const megaDropdownEl = document.getElementById('megaDropdown');
    if (megaDropdownEl) {
        new bootstrap.Dropdown(megaDropdownEl);
    }

});
/* ── Admin: preview imagen subida (admin_productos.php) ──────── */
function previewImagen(input) {
    const label   = document.getElementById('imagen-label');
    const preview = document.getElementById('img-preview');
    if (!input.files || !input.files[0]) return;
    label.textContent = input.files[0].name;
    const reader = new FileReader();
    reader.onload = e => {
        preview.src = e.target.result;
        preview.style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

/* ── Admin: toggle label estado activo/inactivo ──────────────── */
function initToggleEstado() {
    const toggle = document.getElementById('estado');
    const label  = document.getElementById('estadoLabel');
    if (!toggle || !label) return;
    toggle.addEventListener('change', function () {
        label.textContent = this.checked ? 'Activo' : 'Inactivo';
    });
}

/* ── Admin: validación formulario con confirmación contraseña ── */
function initAdminFormValidation() {
    const form = document.querySelector('.needs-validation');
    if (!form) return;
    form.addEventListener('submit', e => {
        const pw  = document.getElementById('contrasena');
        const cpw = document.getElementById('confirmar');
        const fb  = document.getElementById('confirmar-feedback');
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
    if (confirmar) {
        confirmar.addEventListener('input', () => confirmar.setCustomValidity(''));
    }
}

/* ── Admin: init general ─────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    initToggleEstado();
    initAdminFormValidation();
});

/* ── Admin: tabs Registro / Consulta ─────────────────────────── */
function initAdminTabs() {
    document.querySelectorAll('.admin-tab-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const group = this.closest('[data-tab-group]')?.dataset.tabGroup
                        || this.dataset.tabGroup
                        || 'default';
            // Desactivar todos del mismo grupo
            document.querySelectorAll(`.admin-tab-btn[data-tab-group="${group}"]`).forEach(b => b.classList.remove('active'));
            document.querySelectorAll(`.admin-tab-panel[data-tab-group="${group}"]`).forEach(p => p.classList.remove('active'));
            // Activar el seleccionado
            this.classList.add('active');
            const target = document.getElementById(this.dataset.target);
            if (target) target.classList.add('active');
        });
    });
}

/* ── Admin: modal de confirmación de eliminación ─────────────── */
function confirmDelete(type, name, id) {
    const overlay = document.getElementById('confirmOverlay');
    const msgEl   = document.getElementById('confirmMsg');
    const yesBtn  = document.getElementById('confirmYes');
    if (!overlay || !msgEl || !yesBtn) return;

    const labels = { producto: 'el producto', usuario: 'el usuario', personal: 'al personal' };
    const label  = labels[type] || 'el registro';
    msgEl.textContent = `¿Estás seguro de que deseas eliminar ${label} "${name}"? Esta acción no se puede deshacer.`;

    overlay.classList.add('show');

    // Limpiar listener previo clonando el botón
    const newBtn = yesBtn.cloneNode(true);
    yesBtn.parentNode.replaceChild(newBtn, newBtn);

    newBtn.addEventListener('click', function () {
        overlay.classList.remove('show');
        // Aquí iría el envío real al servidor, p.ej.:
        // window.location.href = `eliminar_${type}.php?id=${id}`;
        console.log(`Eliminar ${type} id=${id}`);
    });
}

function closeConfirm() {
    const overlay = document.getElementById('confirmOverlay');
    if (overlay) overlay.classList.remove('show');
}

/* ── Admin: tabs de Reportes ─────────────────────────────────── */
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

/* ── Admin: init actualizado ─────────────────────────────────── */
document.addEventListener('DOMContentLoaded', function () {
    // Funciones ya existentes
    initToggleEstado();
    initAdminFormValidation();
    // Nuevas
    initAdminTabs();
    initReportTabs();
    // Cerrar modal al hacer clic en el overlay
    const overlay = document.getElementById('confirmOverlay');
    if (overlay) {
        overlay.addEventListener('click', function (e) {
            if (e.target === overlay) closeConfirm();
        });
    }
});