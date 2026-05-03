
(function() {
    // CONFIGURACIÓN
    const MAX_IDLE_TIME = 15 * 60; // 15 minutos en segundos
    const WARNING_TIME = 14 * 60;  // Alerta al minuto 14
    
    let idleSecondsCounter = 0;
    let isModalOpen = false;

    // 1. CREAR EL MODAL DE CERO (HTML Y CSS INYECTADO)
    const style = document.createElement('style');
    style.innerHTML = `
        #luchanos-session-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 35, 102, 0.85); /* Azul Marino con transparencia */
            z-index: 999999; display: none; align-items: center; justify-content: center;
            font-family: 'Arial', sans-serif;
        }
        .luchanos-modal {
            background: #fff; padding: 30px; border-radius: 12px; width: 90%; max-width: 400px;
            text-align: center; box-shadow: 0 10px 25px rgba(0,0,0,0.3);
            border-top: 6px solid #0055a0;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }
        .luchanos-modal h3 { color: #002366; margin-bottom: 15px; font-size: 1.4rem; }
        .luchanos-modal p { color: #555; margin-bottom: 25px; line-height: 1.5; }
        .luchanos-btn-group { display: flex; gap: 10px; justify-content: center; }
        .lbtn { padding: 12px 20px; border: none; border-radius: 6px; cursor: pointer; font-weight: bold; transition: 0.3s; }
        .lbtn-extend { background: #002366; color: white; }
        .lbtn-extend:hover { background: #0055a0; }
        .lbtn-logout { background: #e0e0e0; color: #333; }
        .lbtn-logout:hover { background: #d0d0d0; }
        #session-countdown { font-weight: bold; color: #d9534f; }
    `;
    document.head.appendChild(style);

    const overlay = document.createElement('div');
    overlay.id = 'luchanos-session-overlay';
    overlay.innerHTML = `
        <div class="luchanos-modal">
            <h3>¿Sigues ahí?</h3>
            <p>Tu sesión de LuchanosCorp está a punto de expirar por inactividad en <span id="session-countdown">60</span> segundos.</p>
            <div class="luchanos-btn-group">
                <button class="lbtn lbtn-extend" id="btn-extend-session">Mantenerme conectado</button>
                <button class="lbtn lbtn-logout" id="btn-logout-now">Cerrar sesión</button>
            </div>
        </div>
    `;
    document.body.appendChild(overlay);

    // 2. DETECCIÓN DE RUTA DE LOGOUT
    function getLogoutUrl() {
        const path = window.location.pathname;
        if (path.includes('/admin/')) return '/proyectoweb/admin/logout';
        if (path.includes('/vendedor/')) return '/proyectoweb/vendedor/logout';
        if (path.includes('/proveedor/')) return '/proyectoweb/proveedor/logout';
        if (path.includes('/repartidor/')) return '/proyectoweb/repartidor/logout';
        if (path.includes('/mi-perfil/')) return '/proyectoweb/mi-perfil/logout';
        return '/proyectoweb/logout'; // Default
    }

    function resetLocalTimer() {
        if (!isModalOpen) {
            idleSecondsCounter = 0;
        }
    }

    // Eventos que resetean la inactividad
    window.onload = resetLocalTimer;
    window.onmousemove = resetLocalTimer;
    window.onmousedown = resetLocalTimer;
    window.ontouchstart = resetLocalTimer;
    window.onclick = resetLocalTimer;
    window.onkeydown = resetLocalTimer;
    window.addEventListener('scroll', resetLocalTimer, true);

    // 3. RELOJ MAESTRO (Corre cada segundo)
    setInterval(function() {
        idleSecondsCounter++;
        
        // Si llegamos al minuto 14, mostramos alerta
        if (idleSecondsCounter === WARNING_TIME) {
            showWarning();
        }

        // Si llegamos a los 15 minutos, logout automático
        if (idleSecondsCounter >= MAX_IDLE_TIME) {
            window.location.href = getLogoutUrl();
        }

        // Actualizar contador visual si el modal está abierto
        if (isModalOpen) {
            const remaining = MAX_IDLE_TIME - idleSecondsCounter;
            document.getElementById('session-countdown').innerText = remaining > 0 ? remaining : 0;
        }
    }, 1000);

    function showWarning() {
        isModalOpen = true;
        overlay.style.display = 'flex';
    }

    // 4. ACCIONES DEL MODAL
    document.getElementById('btn-extend-session').onclick = function() {
        // Llamada silenciosa al servidor para refrescar la sesión PHP
        fetch('/proyectoweb/sesion_activa.php')
            .then(() => {
                isModalOpen = false;
                idleSecondsCounter = 0;
                overlay.style.display = 'none';
                console.log("Sesión extendida correctamente.");
            });
    };

    document.getElementById('btn-logout-now').onclick = function() {
        window.location.href = getLogoutUrl();
    };

})();