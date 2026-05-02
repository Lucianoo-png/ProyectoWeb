document.addEventListener('DOMContentLoaded', function() {
    const inputBuscador = document.getElementById('buscadorEnVivo');
    const contenedorResultados = document.getElementById('resultadosBuscador');
    if (!inputBuscador || !contenedorResultados) {
        return; 
    }
    let timeoutId;

    inputBuscador.addEventListener('input', function() {
        const query = this.value.trim();

        // Limpiamos el temporizador anterior
        clearTimeout(timeoutId);

        // Si borró el texto o tiene menos de 1 caracteres, ocultamos
        if (query.length < 1) {
            contenedorResultados.style.display = 'none';
            contenedorResultados.innerHTML = '';
            return;
        }

        // Esperamos 300ms después de que el usuario deja de escribir para hacer la petición
        timeoutId = setTimeout(() => {
            // Hacemos la petición a tu endpoint PHP
            fetch(`/proyectoweb/api_buscar_productos?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    contenedorResultados.innerHTML = ''; // Limpiamos resultados anteriores

                    if (data.length > 0) {
                        data.forEach(prod => {
                            // Creamos la opción para cada producto
                            const item = document.createElement('a');
                            item.className = 'dropdown-item';
                            // URL dinámica a la que mandará al hacer clic
                            item.href = `/proyectoweb/producto/${prod.no_producto}`;
                            
                            item.innerHTML = `
                                <span class="producto-sugerencia-nombre">${prod.nombre}</span>
                                <span class="producto-sugerencia-precio">$${parseFloat(prod.precio_venta).toFixed(2)}</span>
                            `;
                            
                            contenedorResultados.appendChild(item);
                        });
                        contenedorResultados.style.display = 'block'; // Mostramos la caja
                    } else {
                        // Si no hay resultados (o no hay con stock)
                        contenedorResultados.innerHTML = '<div class="p-3 text-muted text-center small">No se encontraron productos disponibles.</div>';
                        contenedorResultados.style.display = 'block';
                    }
                })
                .catch(error => console.error('Error en la búsqueda:', error));
        }, 300); // 300 milisegundos de espera
    });

    // Ocultar la caja si el usuario da clic afuera del buscador
    document.addEventListener('click', function(e) {
        if (!inputBuscador.contains(e.target) && !contenedorResultados.contains(e.target)) {
            contenedorResultados.style.display = 'none';
        }
    });

    // Volver a mostrar si le da clic al input y ya hay texto
    inputBuscador.addEventListener('focus', function() {
        if (this.value.trim().length >= 1 && contenedorResultados.innerHTML !== '') {
            contenedorResultados.style.display = 'block';
        }
    });
});