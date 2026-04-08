<div class="topbar">
        <div class="container d-flex justify-content-between">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline">
                    <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
                </span>
            </div>
            <div class="d-flex gap-3">
                <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                    <i class="fas fa-truck me-1"></i> Rastrear Pedido
                </a>
            </div>
        </div>
    </div>

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
                <a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a>
                <a href="/proyectoweb/login" class="nav-icon" title="Mi Cuenta"><i class="fas fa-user"></i></a>
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
                                <a class="dropdown-item" href="/proyectoweb/microondas"><i class="fas fa-blender"></i> Microondas</a>
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

    <div class="bg-white border-bottom py-2">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="/proyectoweb/?" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="/proyectoweb/linea-marron" class="text-decoration-none" style="color:var(--btn-color)">Línea Marrón</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Videojuegos</li>
                </ol>
            </nav>
        </div>
    </div>

    <main class="py-4">
        <div class="container">
            <div class="mb-4">
                <h2 class="mb-1" style="color:var(--dark-blue); font-weight:700">
                    <i class="fas fa-gamepad me-2" style="color:var(--btn-color)"></i>Videojuegos
                </h2>
                <p class="text-muted small">Consolas, controles, accesorios y periféricos gaming de las plataformas más populares.</p>
                <hr>
            </div>

            <!-- Accesos rápidos -->
            <div class="row g-3 mb-5">
                <div class="col-6 col-md-3">
                    <a href="#consolas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-gamepad fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Consolas</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#controles" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-hand-paper fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Controles</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#sillas" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-chair fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Sillas Gaming</p>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-md-3">
                    <a href="#accesorios" class="text-decoration-none">
                        <div class="text-center p-3 border rounded bg-white shadow-sm h-100">
                            <i class="fas fa-headset fa-2x mb-2" style="color:var(--btn-color)"></i>
                            <p class="mb-0 small fw-semibold">Accesorios Gaming</p>
                        </div>
                    </a>
                </div>
            </div>

            <!-- ── Consolas ── -->
            <div id="consolas" class="mb-2">
                <span class="section-title">Consolas</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=PS5" alt="Consola PlayStation 5 con lector de discos y control DualSense" onerror="this.src='https://placehold.co/300x250?text=PS5'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">PS5</span>
                            <p class="product-name">Consola PlayStation 5 con lector de discos y control DualSense</p>
                            <div class="product-price-row"><span class="product-price">$13,999.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/PS5" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XBOXSERIES-X" alt="Consola Xbox Series X 1TB con mando inalámbrico negro" onerror="this.src='https://placehold.co/300x250?text=XBOXSERIES-X'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XBOXSERIES-X</span>
                            <p class="product-name">Consola Xbox Series X 1TB con mando inalámbrico negro</p>
                            <div class="product-price-row"><span class="product-price">$12,499.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/XBOXSERIES-X" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XBOXSERIES-S" alt="Consola Xbox Series S 512GB todo digital blanca" onerror="this.src='https://placehold.co/300x250?text=XBOXSERIES-S'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XBOXSERIES-S</span>
                            <p class="product-name">Consola Xbox Series S 512GB todo digital blanca</p>
                            <div class="product-price-row"><span class="product-price">$7,999.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/XBOXSERIES-S" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SWITCH-OLED" alt="Consola Nintendo Switch OLED 64GB con pantalla de 7 pulgadas" onerror="this.src='https://placehold.co/300x250?text=SWITCH-OLED'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SWITCH-OLED</span>
                            <p class="product-name">Consola Nintendo Switch OLED 64GB con pantalla de 7"</p>
                            <div class="product-price-row"><span class="product-price">$9,499.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/SWITCH-OLED" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Controles ── -->
            <div id="controles" class="mb-2">
                <span class="section-title">Controles</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=DUALSENSE" alt="Control DualSense para PS5 con retroalimentación háptica blanco" onerror="this.src='https://placehold.co/300x250?text=DUALSENSE'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">DUALSENSE</span>
                            <p class="product-name">Control DualSense para PS5 con retroalimentación háptica blanco</p>
                            <div class="product-price-row"><span class="product-price">$1,599.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/DUALSENSE" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XBOX-CTRL" alt="Control inalámbrico Xbox Series para Windows y consolas negro" onerror="this.src='https://placehold.co/300x250?text=XBOX-CTRL'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XBOX-CTRL</span>
                            <p class="product-name">Control inalámbrico Xbox Series para Windows y consolas negro</p>
                            <div class="product-price-row"><span class="product-price">$1,299.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/XBOX-CTRL" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=JOYCON-NEON" alt="Joy-Con Nintendo Switch par neón azul y neón rojo" onerror="this.src='https://placehold.co/300x250?text=JOYCON-NEON'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">JOYCON-NEON</span>
                            <p class="product-name">Joy-Con Nintendo Switch par neón azul y neón rojo</p>
                            <div class="product-price-row"><span class="product-price">$1,199.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/JOYCON-NEON" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=DUALSENSE-EDGE" alt="Control DualSense Edge para PS5 pro con gatillos ajustables" onerror="this.src='https://placehold.co/300x250?text=DUALSENSE-EDGE'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">DUALSENSE-EDGE</span>
                            <p class="product-name">Control DualSense Edge para PS5 pro con gatillos ajustables</p>
                            <div class="product-price-row"><span class="product-price">$3,999.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/DUALSENSE-EDGE" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Sillas Gaming ── -->
            <div id="sillas" class="mb-2">
                <span class="section-title">Sillas Gaming</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SG-PRO200" alt="Silla gaming ergonómica con reposacabezas y lumbar ajustables negra" onerror="this.src='https://placehold.co/300x250?text=SG-PRO200'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SG-PRO200</span>
                            <p class="product-name">Silla gaming ergonómica con reposacabezas y lumbar ajustables negra</p>
                            <div class="product-price-row"><span class="product-price">$3,499.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/SG-PRO200" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SG-RGB400" alt="Silla gaming con tiras LED RGB reclinación 180 grados roja y negra" onerror="this.src='https://placehold.co/300x250?text=SG-RGB400'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SG-RGB400</span>
                            <p class="product-name">Silla gaming con tiras LED RGB reclinación 180° roja y negra</p>
                            <div class="product-price-row"><span class="product-price">$5,199.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/SG-RGB400" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>

            <!-- ── Accesorios Gaming ── -->
            <div id="accesorios" class="mb-2">
                <span class="section-title">Accesorios Gaming</span>
            </div>
            <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">

                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=PULSE3D" alt="Audífonos inalámbricos PULSE 3D para PS5 con audio 3D blanco" onerror="this.src='https://placehold.co/300x250?text=PULSE3D'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">PULSE3D</span>
                            <p class="product-name">Audífonos inalámbricos PULSE 3D para PS5 con audio 3D blanco</p>
                            <div class="product-price-row"><span class="product-price">$1,999.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/PULSE3D" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=XBOX-HS" alt="Headset inalámbrico Xbox con Dolby Atmos y 15h de batería negro" onerror="this.src='https://placehold.co/300x250?text=XBOX-HS'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">XBOX-HS</span>
                            <p class="product-name">Headset inalámbrico Xbox con Dolby Atmos y 15h de batería negro</p>
                            <div class="product-price-row"><span class="product-price">$2,499.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/XBOX-HS" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SSD-PS5-1TB" alt="SSD NVMe 1TB de expansión para PlayStation 5 con disipador" onerror="this.src='https://placehold.co/300x250?text=SSD-PS5-1TB'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SSD-PS5-1TB</span>
                            <p class="product-name">SSD NVMe 1TB de expansión para PlayStation 5 con disipador</p>
                            <div class="product-price-row"><span class="product-price">$2,199.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/SSD-PS5-1TB" class="btn-mas-info">Más información</a>
                    </div>
                </div>
                <div class="col">
                    <div class="product-card">
                        <div class="product-img-wrap">
                            <img src="https://placehold.co/300x250?text=SEAGATE-2TB" alt="Disco duro externo 2TB Storage Expansion Card para Xbox Series" onerror="this.src='https://placehold.co/300x250?text=SEAGATE-2TB'">
                        </div>
                        <div class="product-body">
                            <span class="product-sku">SEAGATE-2TB</span>
                            <p class="product-name">Disco duro externo 2TB Storage Expansion Card para Xbox Series</p>
                            <div class="product-price-row"><span class="product-price">$3,299.00</span></div>
                        </div>
                        <a href="/proyectoweb/producto/SEAGATE-2TB" class="btn-mas-info">Más información</a>
                    </div>
                </div>

            </div>
        </div>
    </main>
    <?php include('vista/footer_gral.php'); ?>