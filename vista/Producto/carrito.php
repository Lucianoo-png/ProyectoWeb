<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Carrito de Compras</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body class="checkout-bg">

    <!-- ─── Topbar ──────────────────────────────────────────── -->
    <div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="../rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
            <a href="#" class="topbar-link-muted">Ayuda</a>
          </div>
        </div>
    </div>

    <!-- ─── Navbar ──────────────────────────────────────────── -->
    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="carrito.php" class="nav-icon" title="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cart-count" style="display:none">0</span>
                </a>
                <a href="../Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
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
            <hr class="summary-divider">
            <div class="summary-total">
                <span>Subtotal</span>
                <span id="summary-total">$0.00</span>
            </div>
            <button class="btn-realizar-pedido" onclick="realizarPedido()">
                Realizar pedido
            </button>
        </div>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
</body>
</html>