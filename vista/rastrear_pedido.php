
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
</div>

    <!-- ─── Navbar ──────────────────────────────────────────── -->
    <div class="main-nav">
        <div class="container-fluid d-flex align-items-center gap-3 px-3">
            <a href="/proyectoweb/?" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                 <?php if(isset($_SESSION["NoCliente"])){ ?><a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a> <?php } ?>
                <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- ─── Layout split 50/50 ──────────────────────────────── -->
    <div class="track-layout">

        <!-- ── Panel izquierdo: formulario ── -->
        <div class="track-left">

            <div class="track-eyebrow">
                <i class="fas fa-shipping-fast"></i> Seguimiento en tiempo real
            </div>

            <h1 class="track-title">Rastrea aquí<br>tu pedido</h1>
            <p class="track-subtitle">
                Ingresa tu número de referencia para conocer el estado actual de tu entrega.
            </p>

            <form id="trackForm" novalidate>

                <label class="track-field-label">
                    Número de Referencia
                    <span class="help-icon" title="Lo encuentras en el correo de confirmación de tu compra">?</span>
                </label>
                <div class="track-input-wrap">
                    <input
                        type="text"
                        id="noReferencia"
                        class="track-input"
                        placeholder="Ej. LC-2000009622868450"
                        maxlength="30"
                        autocomplete="off"
                        required>
                    <i class="fas fa-barcode track-input-icon"></i>
                </div>
                <p class="track-hint">
                    Puedes encontrarlo en el correo de confirmación de tu compra
                    o en tu perfil de pedidos.
                </p>

                <button type="submit" class="btn-rastrear" id="btnRastrear">
                    <i class="fas fa-truck"></i>
                    Rastrear pedido
                </button>

                <!-- Mensaje de error si el campo está vacío -->
                <div class="track-result" id="trackResult"></div>

            </form>

            <hr class="track-divider">

            <p class="track-copyright">
                © <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.
            </p>

        </div>

        <!-- ── Panel derecho: ilustración ── -->
        <div class="track-right">

            <div class="track-illustration">
                <svg viewBox="0 0 480 360" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">

                    <ellipse cx="240" cy="340" rx="160" ry="14" fill="rgba(0,35,102,.1)"/>

                    <!-- Cuerpo camión -->
                    <rect x="30" y="160" width="290" height="150" rx="14" fill="#002366"/>
                    <rect x="30" y="220" width="290" height="6"   fill="#008CA8" opacity=".6"/>
                    <text x="175" y="200" text-anchor="middle" font-size="17" font-weight="800"
                          fill="white" font-family="Arial, sans-serif" opacity=".9">LuchanosCorp</text>

                    <!-- Cabina -->
                    <rect x="310" y="185" width="130" height="125" rx="12" fill="#003080"/>
                    <rect x="318" y="193" width="114" height="72"  rx="8"  fill="#5bbfda"/>
                    <rect x="318" y="193" width="114" height="72"  rx="8"  fill="url(#winGlass)"/>
                    <rect x="373" y="193" width="4"   height="72"  fill="#003080" opacity=".5"/>
                    <rect x="324" y="199" width="44"  height="28"  rx="5"  fill="white" opacity=".12"/>

                    <!-- Puerta de carga -->
                    <rect x="40" y="175" width="135" height="130" rx="6" fill="#001a52"/>
                    <line x1="40"  y1="240" x2="175" y2="240" stroke="white" stroke-width="1.5" opacity=".15"/>
                    <line x1="107" y1="175" x2="107" y2="305" stroke="white" stroke-width="1.5" opacity=".15"/>
                    <rect x="99"  y="233" width="16" height="5" rx="2.5" fill="#008CA8"/>

                    <!-- Ruedas -->
                    <circle cx="110" cy="310" r="34" fill="#1a1a2e"/>
                    <circle cx="110" cy="310" r="24" fill="#2d2d44"/>
                    <circle cx="110" cy="310" r="13" fill="#008CA8" opacity=".8"/>
                    <circle cx="110" cy="310" r="6"  fill="white"  opacity=".6"/>

                    <circle cx="360" cy="310" r="34" fill="#1a1a2e"/>
                    <circle cx="360" cy="310" r="24" fill="#2d2d44"/>
                    <circle cx="360" cy="310" r="13" fill="#008CA8" opacity=".8"/>
                    <circle cx="360" cy="310" r="6"  fill="white"  opacity=".6"/>

                    <!-- Chasis y faro -->
                    <rect x="30"  y="295" width="410" height="20" rx="5" fill="#001a52"/>
                    <rect x="426" y="285" width="18"  height="30" rx="5" fill="#003080"/>
                    <circle cx="432" cy="250" r="9" fill="#f0c040"/>
                    <circle cx="432" cy="250" r="6" fill="#ffdf70"/>

                    <!-- Cajas de paquetes -->
                    <rect x="185" y="200" width="48" height="42" rx="4" fill="#f4a23a" opacity=".9"/>
                    <rect x="239" y="210" width="36" height="32" rx="4" fill="#e8834a" opacity=".85"/>
                    <line x1="209" y1="200" x2="209" y2="242" stroke="white" stroke-width="1.2" opacity=".4"/>
                    <line x1="185" y1="221" x2="233" y2="221" stroke="white" stroke-width="1.2" opacity=".4"/>
                    <line x1="257" y1="210" x2="257" y2="242" stroke="white" stroke-width="1.2" opacity=".4"/>

                    <!-- Líneas de movimiento -->
                    <g opacity=".35">
                        <line x1="0" y1="220" x2="20" y2="220" stroke="#008CA8" stroke-width="3"   stroke-linecap="round"/>
                        <line x1="0" y1="240" x2="14" y2="240" stroke="#008CA8" stroke-width="2"   stroke-linecap="round"/>
                        <line x1="0" y1="260" x2="18" y2="260" stroke="#008CA8" stroke-width="2.5" stroke-linecap="round"/>
                    </g>

                    <!-- Pin GPS con pulso -->
                    <g transform="translate(390,80)">
                        <circle cx="24" cy="24" r="32" fill="none" stroke="#008CA8" stroke-width="2">
                            <animate attributeName="r"       values="24;48" dur="2s" repeatCount="indefinite"/>
                            <animate attributeName="opacity" values=".6;0"  dur="2s" repeatCount="indefinite"/>
                        </circle>
                        <circle cx="24" cy="24" r="24" fill="#008CA8"/>
                        <path d="M24 10 C16 10 10 16 10 24 C10 34 24 48 24 48 C24 48 38 34 38 24 C38 16 32 10 24 10Z"
                              fill="white" opacity=".9"/>
                        <circle cx="24" cy="24" r="6" fill="#008CA8"/>
                    </g>

                    <!-- Nubes -->
                    <g opacity=".5">
                        <ellipse cx="90"  cy="80"  rx="40" ry="22" fill="white"/>
                        <ellipse cx="115" cy="65"  rx="30" ry="20" fill="white"/>
                        <ellipse cx="60"  cy="72"  rx="25" ry="18" fill="white"/>
                        <ellipse cx="340" cy="130" rx="34" ry="18" fill="white"/>
                        <ellipse cx="360" cy="116" rx="25" ry="17" fill="white"/>
                        <ellipse cx="316" cy="123" rx="22" ry="15" fill="white"/>
                    </g>

                    <!-- Puntos decorativos -->
                    <circle cx="180" cy="50"  r="3" fill="#008CA8" opacity=".6"/>
                    <circle cx="200" cy="35"  r="2" fill="#002366" opacity=".4"/>
                    <circle cx="155" cy="30"  r="2" fill="#008CA8" opacity=".5"/>
                    <circle cx="450" cy="160" r="3" fill="#002366" opacity=".3"/>
                    <circle cx="470" cy="145" r="2" fill="#008CA8" opacity=".4"/>

                    <defs>
                        <linearGradient id="winGlass" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%"   stop-color="white" stop-opacity=".15"/>
                            <stop offset="100%" stop-color="white" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                </svg>
            </div>

            <div class="track-right-caption">
                <h3>Live <span>tracking</span></h3>
                <p>Sigue tu entrega en tiempo real, paso a paso.</p>
            </div>

        </div>
    </div>

    <footer class="site-footer-minimal">
        © <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.
    </footer>