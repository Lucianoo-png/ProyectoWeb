<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
    </div>
</div>

<div class="main-nav">
    <div class="container d-flex align-items-center gap-3">
        <a href="/proyectoweb/?" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
       <div class="input-group search-bar flex-grow-1 mx-lg-4 position-relative">
    <!-- Le agregamos el id="buscadorEnVivo" y autocomplete="off" para que el navegador no estorbe -->
    <input type="text" id="buscadorEnVivo" class="form-control" placeholder="¿Qué estás buscando?" autocomplete="off">
    
    <!-- Contenedor flotante para los resultados (oculto por defecto) -->
    <div id="resultadosBuscador" class="dropdown-menu w-100 shadow-lg" style="display: none; position: absolute; top: 100%; left: 0; z-index: 1050; max-height: 300px; overflow-y: auto; border-radius: 0 0 8px 8px;">
        <!-- Aquí entrarán las sugerencias por JS -->
    </div>
</div>
        <div class="d-flex align-items-center gap-3 ms-2">
            <a href="/proyectoweb/carrito" class="nav-icon" title="Carrito">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cart-count" style="display:none">0</span>
            </a>
        </div>
    </div>
</div>

<!-- BUSCADOR MÓVIL (visible solo en ≤768px via responsive.css) -->
<div class="search-bar-mobile">
    <div class="input-group">
        <input type="text"
               id="buscadorMovil"
               class="form-control"
               placeholder="¿Qué estás buscando?"
               autocomplete="off">
        <button class="btn-buscar-movil" type="button" aria-label="Buscar">
            <i class="fas fa-search"></i>
        </button>
        <div id="resultadosBuscadorMovil"
             class="dropdown-menu w-100 shadow-lg"
             style="display:none; position:absolute; top:100%; left:0; z-index:1050; max-height:60vh; overflow-y:auto; border-radius:0 0 8px 8px;">
        </div>
    </div>
</div>