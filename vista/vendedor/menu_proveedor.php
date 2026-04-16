<!-- ── SIDEBAR ─────────────────────────────────────── -->
    <aside class="cuenta-sidebar">
        <div class="cuenta-sidebar-header">
            <div class="cuenta-avatar"><?php 
            $arr = explode(" ",($info[0]['nombre']." ".$info[0]['apellidospama']));
            echo mb_substr($arr[0],0,1).mb_substr($arr[1],0,1); ?></div>
            <p class="cuenta-sidebar-name"><?php echo $info[0]['nombre']." ".$info[0]['apellidospama']; ?></p>
            <p class="cuenta-sidebar-email"><?php echo $info[0]['correo']; ?></p>
        </div>
        <nav class="cuenta-nav">
            <button class="cuenta-nav-link active" onclick="switchPanel('panel-resumen', this)">
                <i class="fas fa-tachometer-alt"></i> Resumen
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-solicitudes', this)">
                <i class="fas fa-inbox"></i> Solicitudes de Reabasto
                <span id="badge-pendientes"
                      style="background:#ef4444;color:#fff;font-size:.65rem;font-weight:700;
                             padding:.1rem .45rem;border-radius:2rem;margin-left:.35rem"><?php echo $total_pendientes; ?></span>
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-historial', this)">
                <i class="fas fa-history"></i> Historial
            </button>
            <hr class="cuenta-nav-divider">
            <button class="cuenta-nav-link" onclick="switchPanel('panel-perfil', this)">
                <i class="fas fa-user-edit"></i> Mi Perfil
            </button>
            <hr class="cuenta-nav-divider">
            <a href="/proyectoweb/proveedor/logout" class="cuenta-nav-link" style="color:#dc3545">
                <i class="fas fa-sign-out-alt" style="color:#dc3545"></i> Cerrar Sesión
            </a>
        </nav>
    </aside>