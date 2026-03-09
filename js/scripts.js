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