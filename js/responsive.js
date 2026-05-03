'use strict';

(function () {

    const BREAKPOINT = 991;

    let btnHamb = null;
    let menuLat = null;
    let ov      = null;
    let listo   = false;

    /* ════════════════════════════════════════════════
       DETECCIÓN DE PÁGINA
    ════════════════════════════════════════════════ */
    function _tipo() {
        if (document.querySelector('.admin-sidebar'))  return 'admin';
        if (document.querySelector('.cuenta-sidebar')) return 'cuenta';
        return 'publico';
    }

    /* ════════════════════════════════════════════════
       OCULTAR BARRA DE CATEGORÍAS EN MÓVIL
      (etiqueta el div envoltorio con .lc-cats-bar)
    ════════════════════════════════════════════════ */
    function _ocultarBarraCats() {
        const ul = document.querySelector('.nav-categories');
        if (!ul) return;

        // Subir hasta encontrar un div con sticky-top o z-index:1020
        let el = ul.parentElement;
        while (el && el !== document.body) {
            const isSticky  = el.classList.contains('sticky-top');
            const hasZindex = (el.getAttribute('style') || '').includes('z-index:1020') ||
                              (el.getAttribute('style') || '').includes('z-index: 1020');
            if (isSticky || hasZindex) {
                el.classList.add('lc-cats-bar');
                return;
            }
            el = el.parentElement;
        }
        // Fallback: ocultar solo el ul
        ul.classList.add('lc-cats-bar');
    }

    /* ════════════════════════════════════════════════
       INYECTAR HAMBURGUESA
    ════════════════════════════════════════════════ */
    function _inyectarHamb() {
        if (document.querySelector('.btn-hamburguesa')) return;
        const nav = document.querySelector('.main-nav .container-fluid, .main-nav .container');
        if (!nav) return;

        const btn = document.createElement('button');
        btn.className = 'btn-hamburguesa';
        btn.type      = 'button';
        btn.setAttribute('aria-label',    'Abrir menú');
        btn.setAttribute('aria-expanded', 'false');
        btn.innerHTML = '<span></span><span></span><span></span>';
        nav.insertBefore(btn, nav.firstChild);
        btnHamb = btn;
    }

    /* ════════════════════════════════════════════════
       INYECTAR ICONOS MÓVILES (usuario / carrito)
    ════════════════════════════════════════════════ */
    /* ════════════════════════════════════════════════
       DETECTAR ENLACE DE PERFIL / CUENTA
       Busca en todo el DOM el href que apunte a la pagina de cuenta.
    ════════════════════════════════════════════════ */
    function _findPerfilHref() {
        const PATRONES = ['mi_cuenta', 'mi-cuenta', 'micuenta', 'perfil', 'profile', 'usuario', 'user'];
        const EXCLUIR  = ['login', 'logout', 'register', 'registro', 'carrito', 'cart', 'recuperar'];

        function esValido(href) {
            if (!href || href === '#' || href === 'javascript:void(0)') return false;
            const h = href.toLowerCase();
            if (EXCLUIR.some(function(e){ return h.includes(e); })) return false;
            return PATRONES.some(function(p){ return h.includes(p); });
        }

        /* 1. Dropdowns del nav desktop */
        const dropdownLinks = document.querySelectorAll(
            '.main-nav .dropdown-menu a, .nav-user-dropdown a, .user-menu a'
        );
        for (let i = 0; i < dropdownLinks.length; i++) {
            if (esValido(dropdownLinks[i].getAttribute('href'))) return dropdownLinks[i].href;
        }

        /* 2. Cualquier <a> en la pagina que coincida con los patrones */
        for (let pi = 0; pi < PATRONES.length; pi++) {
            const p   = PATRONES[pi];
            const all = document.querySelectorAll('a[href*="' + p + '"]');
            for (let i = 0; i < all.length; i++) {
                if (esValido(all[i].getAttribute('href'))) return all[i].href;
            }
        }

        /* 3. Atributo data puesto manualmente en el nav */
        const dataEl = document.querySelector('[data-cuenta-href], [data-perfil-href]');
        if (dataEl) return dataEl.dataset.cuentaHref || dataEl.dataset.perfilHref || null;

        return null;
    }

    function _inyectarIconos() {
        if (document.querySelector('.nav-icons-mobile')) return;
        const nav = document.querySelector('.main-nav .container-fluid, .main-nav .container');
        if (!nav) return;

        const tipo       = _tipo();
        const hayCarrito = !!document.getElementById('cart-count');
        const loginHref  = document.querySelector('a[href*="login"]')?.href || '#';

        /* Detectar enlace al perfil/cuenta para usuarios autenticados.
           Busca en todos los posibles contenedores del nav desktop. */
        const cuentaHref = _findPerfilHref() || loginHref;

        const div        = document.createElement('div');
        div.className    = 'nav-icons-mobile';

        if (tipo === 'publico') {
            div.innerHTML = `
                <a href="${cuentaHref}" class="nav-icon-btn" aria-label="Mi cuenta">
                    <i class="fas fa-user"></i>
                </a>`;
            if (hayCarrito) {
                const carritoHref = document.querySelector('a[href*="carrito"]')?.href || 'carrito.php';
                div.innerHTML += `
                <a href="${carritoHref}" class="nav-icon-btn" aria-label="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="nav-badge-icon" id="cart-count-movil" style="display:none">0</span>
                </a>`;
            }
        } else {
            /* Detectar logout: puede ser <a href> o <button> dentro de un <form> */
            const LOGOUT_PATS = ['logout', 'cerrar_sesion', 'cerrar-sesion', 'signout', 'sign-out', 'salir'];
            const EXCLUIR_LOG = ['login', 'register', 'registro', 'carrito', 'recuperar'];

            function esLogout(href) {
                if (!href) return false;
                const h = href.toLowerCase();
                if (EXCLUIR_LOG.some(function(e){ return h.includes(e); })) return false;
                return LOGOUT_PATS.some(function(p){ return h.includes(p); });
            }

            /* 1. Buscar <a> con href de logout */
            let logoutAnchor = null;
            for (let pi = 0; pi < LOGOUT_PATS.length; pi++) {
                const found = document.querySelector('a[href*="' + LOGOUT_PATS[pi] + '"]');
                if (found && esLogout(found.getAttribute('href'))) { logoutAnchor = found; break; }
            }

            /* 2. Buscar <button class="btn-cerrar"> o boton submit en form de logout */
            const logoutBtn = document.querySelector(
                '.btn-cerrar, button[onclick*="logout"], button[onclick*="cerrar"], '
                + 'form[action*="logout"] button[type="submit"], form[action*="cerrar"] button[type="submit"]'
            );

            if (logoutAnchor) {
                /* Caso A: hay un <a> -> enlace directo */
                div.innerHTML = `
                <a href="${logoutAnchor.href}" class="nav-icon-btn" aria-label="Cerrar sesiÃ³n">
                    <i class="fas fa-sign-out-alt"></i>
                </a>`;
            } else if (logoutBtn) {
                /* Caso B: hay un <button> (form submit) -> clonar click */
                const btnMov = document.createElement('button');
                btnMov.type      = 'button';
                btnMov.className = 'nav-icon-btn';
                btnMov.setAttribute('aria-label', 'Cerrar sesiÃ³n');
                btnMov.innerHTML = '<i class="fas fa-sign-out-alt"></i>';
                btnMov.addEventListener('click', function() { logoutBtn.click(); });
                div.appendChild(btnMov);
            } else {
                /* Caso C: fallback hacia login */
                const fallback = document.querySelector('a[href*="login"]')?.href || 'login.php';
                div.innerHTML = `
                <a href="${fallback}" class="nav-icon-btn" aria-label="Cerrar sesiÃ³n">
                    <i class="fas fa-sign-out-alt"></i>
                </a>`;
            }
        }
        nav.appendChild(div);
    }

    /* ════════════════════════════════════════════════
       INYECTAR BUSCADOR MÓVIL
    ════════════════════════════════════════════════ */
    function _inyectarBuscador() {
        if (document.querySelector('.search-bar-mobile')) return;
        const searchDesk = document.querySelector('.main-nav .search-bar, .main-nav .input-group');
        if (!searchDesk) return;

        const ph = searchDesk.querySelector('input')?.placeholder || '¿Qué buscas hoy?';
        const barra = document.createElement('div');
        barra.className = 'search-bar-mobile';
        barra.innerHTML = `
            <div class="input-group">
                <input type="text" class="form-control" placeholder="${_esc(ph)}" aria-label="Buscar">
                <button class="btn-buscar-movil" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>`;
        const mainNav = document.querySelector('.main-nav');
        if (mainNav?.parentNode) mainNav.parentNode.insertBefore(barra, mainNav.nextSibling);
    }

    /* ════════════════════════════════════════════════
       CONSTRUIR PANEL LATERAL
    ════════════════════════════════════════════════ */
    function _construirMenu() {
        if (document.querySelector('.menu-lateral')) return;

        ov            = document.createElement('div');
        ov.className  = 'menu-overlay';
        document.body.appendChild(ov);

        const panel     = document.createElement('nav');
        panel.className = 'menu-lateral';
        panel.id        = 'menuLateral';
        panel.setAttribute('role',       'dialog');
        panel.setAttribute('aria-modal', 'true');
        panel.setAttribute('aria-label', 'Navegación principal');

        const tipo = _tipo();
        let html   = _htmlCabecera();
        html      += '<div class="menu-lateral-body">';

        if (tipo === 'admin')   html += _htmlAdmin();
        else if (tipo === 'cuenta') html += _htmlCuenta();
        else                    html += _htmlPublico();

        html += '</div>';
        html += `<div class="menu-lateral-footer">© ${new Date().getFullYear()} LuchanosCorp S.A.</div>`;

        panel.innerHTML = html;
        document.body.appendChild(panel);
        menuLat = panel;
    }

    /* ── Cabecera del panel ─────────────────────── */
    function _htmlCabecera() {
        return `
        <div class="menu-lateral-header">
            <a href="/proyectoweb/" class="menu-lateral-brand">
                <span class="electro">Luchanos</span><span class="corp">Corp</span>
            </a>
            <button class="btn-cerrar-menu" aria-label="Cerrar menú">
                <i class="fas fa-times"></i>
            </button>
        </div>`;
    }

    /* ════════════════════════════════════════════════
       HTML — TIENDA PÚBLICA
       Lee .nav-categories y el mega-menu
    ════════════════════════════════════════════════ */
    function _htmlPublico() {
        let html = '';
        const loginHref   = document.querySelector('a[href*="login"]')?.href || '#';
        const perfilHref  = _findPerfilHref();
        const estaLogueado = !!perfilHref;

        /* Detectar nombre e iniciales del usuario logueado desde el nav desktop */
        const userNameEl = document.querySelector(
            '.nav-user-name, .user-name, .navbar-user-name, ' +
            '.dropdown-toggle .user-name, [data-user-name], ' +
            '.main-nav .d-flex .fw-bold, .main-nav .username'
        );
        const nombreUsuario = userNameEl ? userNameEl.textContent.trim() : '';
        const iniciales = nombreUsuario
            ? nombreUsuario.split(' ').slice(0, 2).map(function(w){ return w[0] || ''; }).join('').toUpperCase()
            : '';

        /* Fila de sesión: logueado -> ir al perfil; anónimo -> ir al login */
        if (estaLogueado) {
            html += `
        <a href="${perfilHref}" class="menu-user-row clickable">
            <div class="menu-user-avatar" style="background:#008CA8">
                ${iniciales ? `<span style="font-size:.8rem;font-weight:800">${iniciales}</span>` : '<i class="fas fa-user"></i>'}
            </div>
            <div>
                <div class="menu-user-name">${nombreUsuario || 'Mi cuenta'}</div>
                <div class="menu-user-role">Ver mi perfil</div>
            </div>
        </a>`;
        } else {
            html += `
        <a href="${loginHref}" class="menu-user-row clickable">
            <div class="menu-user-avatar"><i class="fas fa-user"></i></div>
            <div>
                <div class="menu-user-name">Iniciar sesión</div>
                <div class="menu-user-role">Crea tu cuenta o accede</div>
            </div>
        </a>`;
        }

        /* Categorías principales (sin el mega-dropdown) */
        const catItems = document.querySelectorAll('.nav-categories .nav-item:not(.dropdown)');
        if (catItems.length) {
            html += '<span class="menu-group-label">Categorías</span>';
            catItems.forEach(li => {
                const a = li.querySelector('a');
                if (!a) return;
                const activo = a.classList.contains('active') ? 'active' : '';
                html += `
                <a href="${a.href || '#'}" class="menu-item ${activo}">
                    <i class="fas fa-chevron-right"></i>
                    ${_esc(a.textContent.trim())}
                </a>`;
            });
        }

        /* Categorías Específicas: ítem expansible + sub-ítems del mega-menu */
        const megaMenu = document.querySelector('.mega-menu, .dropdown-menu.mega-menu');
        if (megaMenu) {
            const megaLinkActivo = document.querySelector('.nav-categories .mega-dropdown .nav-link.active') ? 'active' : '';

            html += `
            <button class="menu-item menu-item-expand ${megaLinkActivo}"
                    data-expand-target="submenu-categorias"
                    aria-expanded="false"
                    aria-controls="submenu-categorias">
                <i class="fas fa-th-large"></i>
                Categorías Específicas
                <i class="fas fa-chevron-right menu-expand-arrow"></i>
            </button>
            <div class="menu-submenu" id="submenu-categorias" role="region">`;

            /* Recorrer cada category-col del mega-menu */
            megaMenu.querySelectorAll('.category-col').forEach(col => {
                col.childNodes.forEach(node => {
                    if (node.nodeType !== Node.ELEMENT_NODE) return;

                    if (node.tagName === 'H6') {
                        html += `<span class="menu-subgroup-label">${_esc(node.textContent.trim())}</span>`;

                    } else if (node.tagName === 'A') {
                        const icon  = node.querySelector('i');
                        const texto = _textoLimpio(node);
                        html += `
                        <a href="${node.getAttribute('href') || '#'}" class="menu-item menu-subitem">
                            ${icon ? `<i class="${_esc(icon.className)}"></i>` : ''}
                            ${_esc(texto)}
                        </a>`;
                    }
                });
            });

            html += '</div>'; /* /submenu-categorias */
        }

        /* Ayuda */
        html += `
        <hr class="menu-divider">
        <span class="menu-group-label">Ayuda</span>
        <a href="/proyectoweb/contacto" class="menu-item"><i class="fas fa-headset"></i> Contacto</a>`;

        return html;
    }

    /* ════════════════════════════════════════════════
       HTML — ADMIN / VENDEDOR / REPARTIDOR
    ════════════════════════════════════════════════ */
    function _htmlAdmin() {
        let html   = '';
        const sidebar = document.querySelector('.admin-sidebar');
        if (!sidebar) return html;

        /* Info del usuario */
        const nameEl = document.querySelector('.info-rows .value, .info-card-vend .value');
        if (nameEl) {
            const nombre = nameEl.textContent.trim();
            html += `
            <div class="menu-user-row">
                <div class="menu-user-avatar"><i class="fas fa-user-shield"></i></div>
                <div><div class="menu-user-name">${_esc(nombre)}</div></div>
            </div>`;
        }

        sidebar.childNodes.forEach(node => {
            if (node.nodeType !== Node.ELEMENT_NODE) return;
            const tag = node.tagName;

            if (tag === 'P' && node.classList.contains('sidebar-title')) {
                html += `<span class="menu-group-label">${_esc(node.textContent.trim())}</span>`;
            } else if (tag === 'HR') {
                html += '<hr class="menu-divider">';
            } else if (tag === 'A' && node.classList.contains('btn-cerrar')) {
                html += `<a href="${node.href}" class="menu-item-cerrar">
                    <i class="fas fa-sign-out-alt"></i>${_esc(_textoLimpio(node))}
                </a>`;
            } else if (tag === 'A') {
                const activo   = node.classList.contains('active') ? 'active' : '';
                const icon     = node.querySelector('i');
                const badge    = node.querySelector('.tab-badge');
                const onclick  = node.getAttribute('onclick') || '';
                const texto    = _textoLimpio(node);
                const tabMatch = onclick.match(/switchTab\(['"]([^'"]+)['"]/);
                const tabId    = tabMatch ? tabMatch[1] : null;

                if (tabId) {
                    html += `
                    <button class="menu-item ${activo}" data-switchtab="${_esc(tabId)}">
                        ${icon ? `<i class="${_esc(icon.className)}"></i>` : ''}
                        ${_esc(texto)}
                        ${badge ? `<span class="menu-badge">${_esc(badge.textContent.trim())}</span>` : ''}
                    </button>`;
                } else {
                    html += `
                    <a href="${node.href || '#'}" class="menu-item ${activo}">
                        ${icon ? `<i class="${_esc(icon.className)}"></i>` : ''}
                        ${_esc(texto)}
                        ${badge ? `<span class="menu-badge">${_esc(badge.textContent.trim())}</span>` : ''}
                    </a>`;
                }
            }
        });
        return html;
    }

    /* ════════════════════════════════════════════════
       HTML — PROVEEDOR (.cuenta-sidebar)
    ════════════════════════════════════════════════ */
    function _htmlCuenta() {
        let html = '';
        const sidebar = document.querySelector('.cuenta-sidebar');
        if (!sidebar) return html;

        const avatarEl = sidebar.querySelector('.cuenta-avatar');
        const nameEl   = sidebar.querySelector('.cuenta-sidebar-name');
        const emailEl  = sidebar.querySelector('.cuenta-sidebar-email');

        html += `
        <div class="menu-user-row">
            <div class="menu-user-avatar" style="font-size:.85rem">
                ${_esc(avatarEl?.textContent.trim() || '')}
            </div>
            <div>
                <div class="menu-user-name">${_esc(nameEl?.textContent.trim() || '')}</div>
                ${emailEl ? `<div class="menu-user-role">${_esc(emailEl.textContent.trim())}</div>` : ''}
            </div>
        </div>
        <span class="menu-group-label">Navegación</span>`;

        const nav = sidebar.querySelector('.cuenta-nav');
        if (!nav) return html;

        nav.childNodes.forEach(node => {
            if (node.nodeType !== Node.ELEMENT_NODE) return;
            const tag     = node.tagName;
            const onclick = node.getAttribute('onclick') || '';

            if (tag === 'HR' || node.classList.contains('cuenta-nav-divider')) {
                html += '<hr class="menu-divider">'; return;
            }

            const activo     = node.classList.contains('active') ? 'active' : '';
            const icon       = node.querySelector('i');
            const badge      = node.querySelector('[id*="badge"], span[style*="background:#ef"]');
            const texto      = _textoLimpio(node);
            const panelMatch = onclick.match(/switchPanel\(['"]([^'"]+)['"]/);
            const panelId    = panelMatch ? panelMatch[1] : null;

            if (panelId) {
                html += `
                <button class="menu-item ${activo}" data-switchpanel="${_esc(panelId)}">
                    ${icon ? `<i class="${_esc(icon.className)}"></i>` : ''}
                    ${_esc(texto)}
                    ${badge ? `<span class="menu-badge">${_esc(badge.textContent.trim())}</span>` : ''}
                </button>`;
            } else if (tag === 'A') {
                const esLogout = (node.style.color || '').includes('dc3545');
                html += `
                <a href="${node.href || '#'}" class="${esLogout ? 'menu-item-cerrar' : 'menu-item ' + activo}">
                    ${icon ? `<i class="${_esc(icon.className)}"></i>` : ''}
                    ${_esc(texto)}
                </a>`;
            }
        });
        return html;
    }

    /* ════════════════════════════════════════════════
       ABRIR / CERRAR
    ════════════════════════════════════════════════ */
    function _abrir() {
        if (!menuLat) return;
        menuLat.classList.add('abierto');
        ov.classList.add('visible');
        requestAnimationFrame(() => ov.classList.add('activo'));
        if (btnHamb) { btnHamb.classList.add('abierto'); btnHamb.setAttribute('aria-expanded','true'); }
        document.body.style.overflow = 'hidden';
    }
    function _cerrar() {
        if (!menuLat) return;
        menuLat.classList.remove('abierto');
        ov.classList.remove('activo');
        setTimeout(() => ov.classList.remove('visible'), 340);
        if (btnHamb) { btnHamb.classList.remove('abierto'); btnHamb.setAttribute('aria-expanded','false'); btnHamb.focus?.(); }
        document.body.style.overflow = '';
    }

    /* ════════════════════════════════════════════════
       EVENTOS
    ════════════════════════════════════════════════ */
    function _bindEventos() {
        document.addEventListener('click', function (e) {

            /* Hamburguesa */
            if (e.target.closest('.btn-hamburguesa')) {
                menuLat?.classList.contains('abierto') ? _cerrar() : _abrir();
                return;
            }

            /* Botón X del panel */
            if (e.target.closest('.btn-cerrar-menu')) { _cerrar(); return; }

            /* Click en overlay */
            if (e.target === ov) { _cerrar(); return; }

            /* ── Toggle de submenú (Categorías Específicas) ── */
            const itemExpand = e.target.closest('.menu-item-expand');
            if (itemExpand) {
                const targetId = itemExpand.dataset.expandTarget;
                const submenu  = targetId ? document.getElementById(targetId) : null;
                if (submenu) {
                    const isOpen = submenu.classList.contains('open');
                    submenu.classList.toggle('open', !isOpen);
                    itemExpand.classList.toggle('open', !isOpen);
                    itemExpand.setAttribute('aria-expanded', String(!isOpen));
                }
                return;
            }

            /* ── Ítem con switchPanel (proveedor) ── */
            const itemPanel = e.target.closest('[data-switchpanel]');
            if (itemPanel) {
                const panelId = itemPanel.dataset.switchpanel;
                _cerrar();
                setTimeout(() => {
                    if (typeof switchPanel === 'function') {
                        const btnOrig = document.querySelector(`.cuenta-nav-link[onclick*="${panelId}"]`);
                        switchPanel(panelId, btnOrig || null);
                    }
                    menuLat?.querySelectorAll('.menu-item').forEach(m => m.classList.remove('active'));
                    itemPanel.classList.add('active');
                    document.getElementById(panelId)?.scrollIntoView({ behavior:'smooth', block:'start' });
                }, 360);
                return;
            }

            /* ── Ítem con switchTab (repartidor/vendedor) ── */
            const itemTab = e.target.closest('[data-switchtab]');
            if (itemTab) {
                const tabId = itemTab.dataset.switchtab;
                _cerrar();
                setTimeout(() => {
                    if (typeof switchTab === 'function') {
                        switchTab(tabId, document.getElementById('btn-' + tabId) || null);
                    }
                    menuLat?.querySelectorAll('.menu-item').forEach(m => m.classList.remove('active'));
                    itemTab.classList.add('active');
                    document.getElementById(tabId)?.scrollIntoView({ behavior:'smooth', block:'start' });
                }, 360);
                return;
            }
        });

        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && menuLat?.classList.contains('abierto')) _cerrar();
        });

        window.addEventListener('resize', _debounce(() => {
            if (window.innerWidth > BREAKPOINT) _cerrar();
        }, 120));
    }

    /* ════════════════════════════════════════════════
       SINCRONIZAR BADGE CARRITO
    ════════════════════════════════════════════════ */
    function _syncBadge() {
        const orig  = document.getElementById('cart-count');
        const movil = document.getElementById('cart-count-movil');
        if (!orig || !movil) return;
        const sync = () => { movil.textContent = orig.textContent; movil.style.display = orig.style.display; };
        new MutationObserver(sync).observe(orig, { childList:true, characterData:true, subtree:true, attributes:true, attributeFilter:['style'] });
        sync();
    }

    /* ════════════════════════════════════════════════
       UTILIDADES
    ════════════════════════════════════════════════ */
    function _esc(s) {
        return (s||'').replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }
    function _textoLimpio(el) {
        const c = el.cloneNode(true);
        c.querySelectorAll('i,.tab-badge,span[style*="background"]').forEach(n=>n.remove());
        return c.textContent.trim();
    }
    function _debounce(fn, ms) {
        let t; return function(...a){ clearTimeout(t); t = setTimeout(()=>fn.apply(this,a), ms); };
    }

    /* ════════════════════════════════════════════════
       CONVERTIR TABLAS A TARJETAS PARA MÓVIL
       ─────────────────────────────────────────────
       Las tablas anchas (5-6 columnas) siempre
       desbordan el viewport en móvil. La solución
       definitiva es convertir cada fila en una tarjeta
       con la etiqueta de columna como texto superior.
       No depende de overflow ni de specificity CSS.
    ════════════════════════════════════════════════ */
    function _fixTablasMobile() {
        if (window.innerWidth > BREAKPOINT) return;

        const selectores = [
            '.cuenta-card-body .sol-table',
            '.hist-card-body  .sol-table'
        ];

        selectores.forEach(sel => {
            document.querySelectorAll(sel).forEach(table => {
                /* Evitar doble procesamiento */
                if (table.dataset.lcMobile) return;
                table.dataset.lcMobile = '1';

                /* Leer cabeceras */
                const headers = Array.from(
                    table.querySelectorAll('thead th')
                ).map(th => th.textContent.trim());

                if (!headers.length) return;

                /* Añadir data-label a cada celda */
                table.querySelectorAll('tbody tr').forEach(tr => {
                    Array.from(tr.querySelectorAll('td')).forEach((td, i) => {
                        td.setAttribute('data-label', headers[i] || '');
                    });
                });

                /* Aplicar clase de tarjetas */
                table.classList.add('lc-table-card');

                /* Asegurarse de que el contenedor no tenga overflow:hidden heredado */
                const parent = table.closest('.cuenta-card, .hist-card');
                if (parent) {
                    parent.style.overflow = 'visible';
                }
            });
        });
    }

    /* ════════════════════════════════════════════════
       ARREGLAR FOOTER EN MÓVIL (respaldo JS)
       body es flex-column min-height:100dvh,
       cuenta-layout tiene flex:1 → footer al fondo.
       Si aún no llega, calculamos min-height exacto.
    ════════════════════════════════════════════════ */
    function _fixFooterMobile() {
        if (window.innerWidth > BREAKPOINT) return;

        const layout = document.querySelector('.cuenta-layout, .admin-layout');
        const footer = document.querySelector('.site-footer-minimal');
        if (!layout || !footer) return;

        const recalc = () => {
            const navEl  = document.querySelector('.main-nav');
            const navH   = navEl  ? navEl.getBoundingClientRect().height  : 56;
            const footH  = footer.getBoundingClientRect().height           || 44;
            const vh     = window.innerHeight;
            const minH   = vh - navH - footH - 8;   /* 8px de margen de seguridad */

            layout.style.minHeight = Math.max(minH, 0) + 'px';
        };

        recalc();
        window.addEventListener('resize', _debounce(recalc, 150));
    }

    /* ════════════════════════════════════════════════
       PARCHAR switchPanel PARA RE-APLICAR FIXES
       cuando el usuario navega entre paneles
    ════════════════════════════════════════════════ */
    function _patchSwitchPanel() {
        if (typeof window.switchPanel !== 'function') return;
        const orig = window.switchPanel;
        window.switchPanel = function(panelId, btnEl) {
            orig.call(this, panelId, btnEl);
            /* Re-aplicar después de que el panel sea visible */
            requestAnimationFrame(() => {
                _fixTablasMobile();
            });
        };
    }

    /* ════════════════════════════════════════════════
       INIT
    ════════════════════════════════════════════════ */
    function init() {
        if (listo) return;
        listo = true;

        _ocultarBarraCats();    // Oculta la barra de categorías en móvil
        _inyectarHamb();
        _inyectarIconos();
        _inyectarBuscador();
        _construirMenu();
        _bindEventos();
        _syncBadge();
        _fixTablasMobile();     // Arregla overflow en cuenta-card
        _fixFooterMobile();     // Pega el footer al fondo del viewport
        _patchSwitchPanel();    // Re-aplica fixes al cambiar de panel

        btnHamb = document.querySelector('.btn-hamburguesa');
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();