<?php
// Detecta la sección activa desde la URL: ?url=vendedor/SECCION
$_url    = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$_partes = explode('/', $_url);
$_sec    = mb_strtolower(isset($_partes[1]) && $_partes[1] !== '' ? $_partes[1] : 'inicio');

function _vActivo(string $clave): string {
    global $_sec;
    return $_sec === $clave ? ' active' : '';
}
?>
<!-- Sidebar -->
<nav class="admin-sidebar">
    <p class="sidebar-title">Menú Vendedor</p>
    <a href="/proyectoweb/vendedor/inicio" class="nav-link<?= _vActivo('inicio') ?>">
        <i class="fas fa-tachometer-alt"></i> Inicio
    </a>
    <a href="/proyectoweb/vendedor/ventas" class="nav-link<?= _vActivo('ventas') ?>">
        <i class="fas fa-cash-register"></i> Venta
    </a>
    <a href="/proyectoweb/vendedor/detalle-ventas" class="nav-link<?= _vActivo('detalle-ventas') ?>">
        <i class="fas fa-receipt"></i> Detalle Ventas
    </a>
    <hr class="sidebar-divider">
    <p class="sidebar-title">Consultas</p>
    <a href="/proyectoweb/vendedor/inventario" class="nav-link<?= _vActivo('inventario') ?>">
        <i class="fas fa-boxes"></i> Inventario
    </a>
    <a href="/proyectoweb/vendedor/catalogo" class="nav-link<?= _vActivo('catalogo') ?>">
        <i class="fas fa-th-large"></i> Catálogo
    </a>
    <hr class="sidebar-divider">
    <p class="sidebar-title">Atención</p>
    <a href="/proyectoweb/vendedor/solicitudes" class="nav-link<?= _vActivo('solicitudes') ?>">
        <i class="fas fa-headset"></i> Solicitudes
        <span class="tab-badge">4</span>
    </a>
    <hr class="sidebar-divider">
    <a href="/proyectoweb/?" class="btn-cerrar" style="margin-top:.5rem">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</nav>