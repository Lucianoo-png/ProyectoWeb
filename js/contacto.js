

/**
 * Función para enviar el formulario de contacto
 * Valida los campos y simula el envío (reemplazar con backend real)
 */
function enviarContacto() {
    const nombre  = document.getElementById('ctNombre').value.trim();
    const email   = document.getElementById('ctEmail').value.trim();
    const motivo  = document.getElementById('ctMotivo').value;
    const asunto  = document.getElementById('ctAsunto').value.trim();
    const mensaje = document.getElementById('ctMensaje').value.trim();

    // Validación de campos obligatorios
    if (!nombre || !email || !motivo || !asunto || !mensaje) {
        alert('Por favor completa todos los campos obligatorios (*).');
        return;
    }

    // Validación de email
    const emailRe = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRe.test(email)) {
        alert('Ingresa un correo electrónico válido.');
        return;
    }

    // Simula envío — aquí conectarías tu backend
    document.getElementById('contacto-ok').style.display = 'flex';

    // Limpiar formulario
    document.getElementById('ctNombre').value  = '';
    document.getElementById('ctEmail').value   = '';
    document.getElementById('ctTel').value     = '';
    document.getElementById('ctMotivo').value  = '';
    document.getElementById('ctAsunto').value  = '';
    document.getElementById('ctMensaje').value = '';

    // Scroll suave al mensaje de éxito
    window.scrollTo({ 
        top: document.getElementById('contacto-ok').getBoundingClientRect().top + window.scrollY - 100, 
        behavior: 'smooth' 
    });
}

// Exportar para uso en módulos (opcional)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { enviarContacto };
}