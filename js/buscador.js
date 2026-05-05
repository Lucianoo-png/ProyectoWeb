document.addEventListener('DOMContentLoaded', function() {
    const inputDesktop  = document.getElementById('buscadorEnVivo');
    const dropDesktop   = document.getElementById('resultadosBuscador');
    const inputMovil    = document.getElementById('buscadorMovil');
    const dropMovil     = document.getElementById('resultadosBuscadorMovil');

    /* ── Función central de búsqueda ──────────────────────────────
       Recibe el query, llama al API y rellena el dropdown indicado.
    ─────────────────────────────────────────────────────────────── */
    function buscar(query, contenedor) {
        contenedor.innerHTML = '';

        if (query.length < 1) {
            contenedor.style.display = 'none';
            return;
        }

        fetch(`/proyectoweb/api_buscar_productos?q=${encodeURIComponent(query)}`)
            .then(r => r.json())
            .then(data => {
                contenedor.innerHTML = '';

                if (data.length > 0) {
                    data.forEach(prod => {
                        const item = document.createElement('a');
                        item.className = 'dropdown-item';
                        item.href = `/proyectoweb/producto/${prod.no_producto}`;
                        item.innerHTML = `
                            <span class="producto-sugerencia-nombre">${prod.nombre}</span>
                            <span class="producto-sugerencia-precio">$${parseFloat(prod.precio_venta).toFixed(2)}</span>
                        `;
                        contenedor.appendChild(item);
                    });
                } else {
                    contenedor.innerHTML = '<div class="p-3 text-muted text-center small">No se encontraron productos disponibles.</div>';
                }

                contenedor.style.display = 'block';
            })
            .catch(err => console.error('Error en la búsqueda:', err));
    }

    /* ── Conectar un input a su dropdown ──────────────────────── */
    function conectar(input, contenedor) {
        if (!input || !contenedor) return;

        let timeoutId;

        input.addEventListener('input', function () {
            clearTimeout(timeoutId);
            const query = this.value.trim();
            if (query.length < 1) {
                contenedor.style.display = 'none';
                contenedor.innerHTML = '';
                return;
            }
            timeoutId = setTimeout(() => buscar(query, contenedor), 300);
        });

        input.addEventListener('focus', function () {
            if (this.value.trim().length >= 1 && contenedor.innerHTML !== '') {
                contenedor.style.display = 'block';
            }
        });

        document.addEventListener('click', function (e) {
            if (!input.contains(e.target) && !contenedor.contains(e.target)) {
                contenedor.style.display = 'none';
            }
        });
    }

    /* ── Inicializar desktop y móvil ──────────────────────────── */
    conectar(inputDesktop, dropDesktop);
    conectar(inputMovil,   dropMovil);
});