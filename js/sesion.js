(function() {
    // CONFIGURACIÓN
    const MAX_IDLE_TIME = 15 * 60;
    const WARNING_TIME = 14 * 60;
    let lastActivityTime = Date.now(); 
    let isModalOpen = false;
    const style = document.createElement('style');
    style.innerHTML = `
        #luchanos-session-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 35, 102, 0.85);
            z-index: 999999; display: none; align-items: center; justify-content: center;
            font-family: 'Segoe UI', system-ui, sans-serif;
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

    function getLogoutUrl() {
        const path = window.location.pathname;
        if (path.includes('/admin/')) return '/proyectoweb/admin/logout';
        if (path.includes('/vendedor/')) return '/proyectoweb/vendedor/logout';
        if (path.includes('/proveedor/')) return '/proyectoweb/proveedor/logout';
        if (path.includes('/repartidor/')) return '/proyectoweb/repartidor/logout';
        if (path.includes('/mi-perfil/')) return '/proyectoweb/mi-perfil/logout';
        return '/proyectoweb/logout';
    }

    function updateLastActivity() {
        if (!isModalOpen) {
            lastActivityTime = Date.now();
        }
    }

    window.addEventListener('load', updateLastActivity);
    window.addEventListener('mousemove', updateLastActivity);
    window.addEventListener('mousedown', updateLastActivity);
    window.addEventListener('touchstart', updateLastActivity);
    window.addEventListener('click', updateLastActivity);
    window.addEventListener('keydown', updateLastActivity);
    window.addEventListener('scroll', updateLastActivity, true);
    
    window.addEventListener('focus', updateLastActivity);

    setInterval(function() {
        const currentTime = Date.now();
        const idleSeconds = Math.floor((currentTime - lastActivityTime) / 1000);
        
        if (idleSeconds >= MAX_IDLE_TIME) {
            window.location.href = getLogoutUrl();
            return;
        }

        if (idleSeconds >= WARNING_TIME && !isModalOpen) {
            isModalOpen = true;
            overlay.style.display = 'flex';
        }

        if (isModalOpen) {
            const remaining = MAX_IDLE_TIME - idleSeconds;
            document.getElementById('session-countdown').innerText = remaining > 0 ? remaining : 0;
        }
    }, 1000);

    document.getElementById('btn-extend-session').onclick = function() {
        fetch('/proyectoweb/sesion_activa.php')
            .then(() => {
                isModalOpen = false;
                lastActivityTime = Date.now();
                overlay.style.display = 'none';
                console.log("Sesión extendida correctamente.");
            });
    };

    document.getElementById('btn-logout-now').onclick = function() {
        window.location.href = getLogoutUrl();
    };

})();