<?php
// Lee la URL actual: ?url=admin/personal, ?url=admin/logs, etc.
$_url    = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$_partes = explode('/', $_url);
// Si solo viene "admin" sin subruta, la sección es "inicio"
$_sec = mb_strtolower(isset($_partes[1]) && $_partes[1] !== '' ? $_partes[1] : 'inicio');

function _activo(string $clave): string {
    global $_sec;
    return $_sec === $clave ? ' active' : '';
}
?>
<nav class="admin-sidebar">
    <p class="sidebar-title">Menú Admin</p>
    <a href="/proyectoweb/admin/inicio"          class="nav-link<?= _activo('inicio') ?>"><i class="fas fa-tachometer-alt"></i> Inicio</a>
    <a href="/proyectoweb/admin/personal"         class="nav-link<?= _activo('personal') ?>"><i class="fas fa-users"></i> Personal</a>
    <a href="/proyectoweb/admin/productos"        class="nav-link<?= _activo('productos') ?>"><i class="fas fa-box"></i> Productos</a>
    <hr class="sidebar-divider">
    <p class="sidebar-title">Reportes</p>
    <a href="/proyectoweb/admin/ventas"           class="nav-link<?= _activo('ventas') ?>"><i class="fas fa-chart-bar"></i> Ventas</a>
    <a href="/proyectoweb/admin/compras"          class="nav-link<?= _activo('compras') ?>"><i class="fas fa-shopping-bag"></i> Compras</a>
    <a href="/proyectoweb/admin/pedidos"          class="nav-link<?= _activo('pedidos') ?>"><i class="fas fa-truck"></i> Pedidos</a>
    <hr class="sidebar-divider">
    <p class="sidebar-title">Proveedores</p>
    <a href="/proyectoweb/admin/pedido-proveedor" class="nav-link<?= _activo('pedido-proveedor') ?>"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
    <hr class="sidebar-divider">
    <p class="sidebar-title">Sistema</p>
    <a href="/proyectoweb/admin/logs"             class="nav-link<?= _activo('logs') ?>"><i class="fas fa-history"></i> Historial (Logs)</a>
    <hr class="sidebar-divider">
    <a href="/proyectoweb/?" class="btn-cerrar" style="margin-top:.5rem">
        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
    </a>
</nav>