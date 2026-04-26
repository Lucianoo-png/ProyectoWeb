<div class="checkout-bg">

    <!-- ─── Topbar ──────────────────────────────────────────── -->
    <div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
       <?php if(isset($_SESSION["NoCliente"])){ ?>
            <div class="d-flex gap-3">
                <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                    <i class="fas fa-truck me-1"></i> Rastrear Pedido
                </a>
            </div>
            <?php } ?>
    </div>

    </div><!-- /.topbar -->

    <!-- ─── Navbar ──────────────────────────────────────────── -->
    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="/proyectoweb/?" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="/proyectoweb/carrito" class="nav-icon" title="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cart-count" style="display:none">0</span>
                </a>
                <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

      <div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
        <div class="container">
            <ul class="nav nav-categories justify-content-center">
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-blanca">Línea Blanca</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/linea-marron">Línea Marrón</a></li>
                <li class="nav-item"><a class="nav-link" href="/proyectoweb/cocina">Cocina</a></li>
                <li class="nav-item dropdown mega-dropdown">
                    <a class="nav-link dropdown-toggle active d-flex align-items-center gap-1"
                       href="#" id="megaDropdown" role="button"
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-th-large me-1 small"></i> Categorías Específicas
                    </a>
                    <div class="dropdown-menu mega-menu" aria-labelledby="megaDropdown">
                        <div class="row g-3">
                            <div class="col-6 category-col">
                                <h6>Lavado</h6>
                                <a class="dropdown-item" href="/proyectoweb/lavadoras"><i class="fas fa-tshirt"></i> Lavadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/secadoras"><i class="fas fa-wind"></i> Secadoras</a>
                                <a class="dropdown-item" href="/proyectoweb/lavasecadoras"><i class="fas fa-sync-alt"></i> Lavasecadoras</a>
                                <h6 class="mt-3">Refrigeración</h6>
                                <a class="dropdown-item" href="/proyectoweb/refrigeradores"><i class="fas fa-snowflake"></i> Refrigeradores</a>
                                <a class="dropdown-item" href="/proyectoweb/congeladores"><i class="fas fa-cube"></i> Congeladores</a>
                                <a class="dropdown-item" href="/proyectoweb/frigobar"><i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos</a>
                            </div>
                            <div class="col-6 category-col">
                                <h6>Cocina</h6>
                                <a class="dropdown-item" href="/proyectoweb/hornos"><i class="fas fa-fire"></i> Hornos</a>
                                <a class="dropdown-item" href="/proyectoweb/estufas"><i class="fas fa-burn"></i> Estufas</a>
                                <a class="dropdown-item" href="/proyectoweb/microondas">
                                    <svg style="width:1em;height:1em;vertical-align:-0.125em;flex-shrink:0"
         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 13H5V7h14v10zm-8-8H7v6h4v-6zm5 4.5c.83 0 1.5-.67 1.5-1.5S16.83 11 16 11s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm0-4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
    </svg> Microondas
                                </a>
                                <a class="dropdown-item" href="/proyectoweb/lavavajillas"><i class="fas fa-utensils"></i> Lavavajillas</a>
                                <h6 class="mt-3">Bienestar</h6>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-hogar"><i class="fas fa-home"></i> Cuidado del Hogar</a>
                                <a class="dropdown-item" href="/proyectoweb/cuidado-personal"><i class="fas fa-spa"></i> Cuidado Personal</a>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
    <!-- ─── Pasos del checkout ──────────────────────────────── -->
    <div class="checkout-steps">
        <div class="step active">
            <div class="step-circle"><i class="fas fa-shopping-cart"></i></div>
            <div class="step-label">Carro de Compras</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle"><i class="fas fa-info-circle"></i></div>
            <div class="step-label">Información de Envío</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle"><i class="fas fa-credit-card"></i></div>
            <div class="step-label">Pago</div>
        </div>
    </div>

    <!-- ─── Layout carrito ──────────────────────────────────── -->
    <div class="cart-layout">

        <!-- Productos -->
        <div class="cart-card">
            <div class="cart-card-header">
                <h5>Carro de Compras</h5>
                <span>Precio</span>
            </div>

            <!-- Items renderizados por scripts.js → renderCarrito() -->
            <div id="cart-items-container"></div>

            <!-- Subtotal inferior + cuenta regresiva -->
            <div class="cart-subtotal-row" id="cart-subtotal-row" style="display:none">
                <div id="cart-timer" style="font-size:.75rem; color:var(--btn-color); margin-bottom:6px"></div>
                Subtotal (<span id="subtotal-qty">0</span> producto<span id="subtotal-plural"></span>):
                <strong id="subtotal-valor">$0.00</strong>
            </div>
        </div>

        <!-- Resumen del pedido -->
        <div class="summary-card" id="summary-card" style="display:none">
            <h6>Resumen del pedido</h6>
            <div class="summary-row">
                <span>Productos</span>
                <span id="summary-productos">$0.00</span>
            </div>
            <div class="summary-row text-muted" style="font-size: 0.9rem; margin-top: 8px;">
                <span>IVA (16%)</span>
                <span id="summary-iva">$0.00</span>
            </div>
            <hr class="summary-divider">
            <div class="summary-total">
                <span>Total a pagar</span>
                <span id="summary-total-pagar">$0.00</span>
            </div>
            <button class="btn-realizar-pedido" onclick="realizarPedido()">
                Continuar con el envío <i class="fas fa-arrow-right ms-1"></i>
            </button>
        </div>
    </div>
</div>
    <?php include('vista/footer_gral.php'); ?>

 <script>
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const response = await fetch('/proyectoweb/carrito-obtener');
        const data = await response.json();

        if (data.success) {
            guardarCarrito(data.items);
            renderCarrito();
            if (data.items.length > 0) {
                iniciarTimerCarrito(data.segundos);
            }
        }
    } catch (e) {
        console.error("Error al cargar carrito:", e);
    }
});
</script>