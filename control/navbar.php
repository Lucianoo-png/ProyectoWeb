<?php
/**
 * includes/navbar.php — Barra de navegación global
 *
 * Variables que DEBE definir cada página ANTES del include:
 *   $pathBase  (string) — ruta relativa desde el archivo hasta la raíz del proyecto
 *                         Ejemplos:
 *                           index.php                            → ''
 *                           vista/Cuenta/*.php                   → '../../'
 *                           vista/Producto/*.php                 → '../../'
 *                           vista/Producto/OtrasCategorias/*.php → '../../../'
 *
 * Variables opcionales:
 *   $categoriaActiva (string) — resalta la categoría activa: 'blanca' | 'marron' | 'cocina' | ''
 *   $mostrarCategorias (bool) — muestra la barra de categorías (default: true)
 *
 * Uso mínimo:
 *   <?php $pathBase = '../../'; include $pathBase . 'includes/navbar.php'; ?>
 */

$pathBase          = $pathBase          ?? '';
$categoriaActiva   = $categoriaActiva   ?? '';
$mostrarCategorias = $mostrarCategorias ?? true;

// Rutas absolutas desde la raíz (usando $pathBase como prefijo)
$r = [
    'home'         => $pathBase . './index.php',
    'carrito'      => $pathBase . 'vista/Producto/carrito.php',
    'login'        => $pathBase . 'vista/Cuenta/login.php',
    'lb'           => $pathBase . 'vista/Producto/linea_blanca.php',
    'lm'           => $pathBase . 'vista/Producto/linea_marron.php',
    'cocina'       => $pathBase . 'vista/Producto/cocina.php',
    'lavadoras'    => $pathBase . 'vista/Producto/OtrasCategorias/lavadoras.php',
    'secadoras'    => $pathBase . 'vista/Producto/OtrasCategorias/secadoras.php',
    'lavasecadoras'=> $pathBase . 'vista/Producto/OtrasCategorias/lavasecadoras.php',
    'refrigeradores'=> $pathBase . 'vista/Producto/OtrasCategorias/refrigeradores.php',
    'congeladores' => $pathBase . 'vista/Producto/OtrasCategorias/congeladores.php',
    'frigobar'     => $pathBase . 'vista/Producto/OtrasCategorias/frigobar.php',
    'hornos'       => $pathBase . 'vista/Producto/OtrasCategorias/hornos.php',
    'estufas'      => $pathBase . 'vista/Producto/OtrasCategorias/estufas.php',
    'microondas'   => $pathBase . 'vista/Producto/OtrasCategorias/microondas.php',
    'lavavajillas' => $pathBase . 'vista/Producto/OtrasCategorias/lavavajillas.php',
    'cuidado_hogar'=> $pathBase . 'vista/Producto/OtrasCategorias/cuidado_hogar.php',
    'cuidado_personal'=> $pathBase . 'vista/Producto/OtrasCategorias/cuidado_personal.php',
    
];
?>

<!-- ═══════════════════════════════════════════════════════
     TOPBAR
════════════════════════════════════════════════════════ -->
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="./vista/rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
            <!--<a href="<?= $r['ayuda'] ?>" class="topbar-link-muted">Ayuda</a>-->
        </div>
    </div>
</div>

<!-- ═══════════════════════════════════════════════════════
     NAVBAR PRINCIPAL
════════════════════════════════════════════════════════ -->
<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="<?= $r['home'] ?>" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="<?= $r['carrito'] ?>" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
            <a href="<?= $r['login'] ?>" class="nav-icon" title="Mi Cuenta">
                <i class="fas fa-user"></i>
            </a>
        </div>
    </div>
</div>

<?php if ($mostrarCategorias): ?>
<!-- ═══════════════════════════════════════════════════════
     BARRA DE CATEGORÍAS
════════════════════════════════════════════════════════ -->
<div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
    <div class="container">
        <ul class="nav nav-categories justify-content-center">

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'blanca' ? 'active' : '' ?>"
                   href="<?= $r['lb'] ?>">Línea Blanca</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'marron' ? 'active' : '' ?>"
                   href="<?= $r['lm'] ?>">Línea Marrón</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'cocina' ? 'active' : '' ?>"
                   href="<?= $r['cocina'] ?>">Cocina</a>
            </li>

            <li class="nav-item dropdown mega-dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-1"
                   href="#" id="megaDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-th-large me-1 small"></i> Categorías Específicas
                </a>
                <div class="dropdown-menu mega-menu" aria-labelledby="megaDropdown">
                    <div class="row g-3">
                        <div class="col-6 category-col">
                            <h6>Lavado</h6>
                            <a class="dropdown-item" href="<?= $r['lavadoras'] ?>">
                                <i class="fas fa-tshirt"></i> Lavadoras
                            </a>
                            <a class="dropdown-item" href="<?= $r['secadoras'] ?>">
                                <i class="fas fa-wind"></i> Secadoras
                            </a>
                            <a class="dropdown-item" href="<?= $r['lavasecadoras'] ?>">
                                <i class="fas fa-sync-alt"></i> Lavasecadoras
                            </a>
                            <h6 class="mt-3">Refrigeración</h6>
                            <a class="dropdown-item" href="<?= $r['refrigeradores'] ?>">
                                <i class="fas fa-snowflake"></i> Refrigeradores
                            </a>
                            <a class="dropdown-item" href="<?= $r['congeladores'] ?>">
                                <i class="fas fa-cube"></i> Congeladores
                            </a>
                            <a class="dropdown-item" href="<?= $r['frigobar'] ?>">
                                <i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos
                            </a>
                        </div>
                        <div class="col-6 category-col">
                            <h6>Cocina</h6>
                            <a class="dropdown-item" href="<?= $r['hornos'] ?>">
                                <i class="fas fa-fire"></i> Hornos
                            </a>
                            <a class="dropdown-item" href="<?= $r['estufas'] ?>">
                                <i class="fas fa-burn"></i> Estufas
                            </a>
                            <a class="dropdown-item" href="<?= $r['microondas'] ?>">
                                <i class="fas fa-blender"></i> Microondas
                            </a>
                            <a class="dropdown-item" href="<?= $r['lavavajillas'] ?>">
                                <i class="fas fa-utensils"></i> Lavavajillas
                            </a>
                            <h6 class="mt-3">Bienestar</h6>
                            <a class="dropdown-item" href="<?= $r['cuidado_hogar'] ?>">
                                <i class="fas fa-home"></i> Cuidado del Hogar
                            </a>
                            <a class="dropdown-item" href="<?= $r['cuidado_personal'] ?>">
                                <i class="fas fa-spa"></i> Cuidado Personal
                            </a>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
<?php endif; ?>