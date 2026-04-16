
function switchPanel(id, btn) {
    document.querySelectorAll('.cuenta-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.cuenta-nav-link').forEach(b => b.classList.remove('active'));
    document.getElementById(id).classList.add('active');
    if (btn) btn.classList.add('active');
    localStorage.setItem('activePanel', id);
}


function abrirSolicitud(folio) {
    const sol = SOLICITUDES_REALES[folio];
    if (!sol) return;

    document.getElementById('folio-activo').textContent = folio;
    document.getElementById('input-folio').value = folio;
    document.getElementById('nota-admin-txt').textContent = sol.nota;
    
    const cont = document.getElementById('productos-solicitud');
    cont.innerHTML = sol.productos.map(p => `
        <div class="prod-row d-flex align-items-center justify-content-between p-2 border-bottom">
            <div class="prod-row-info">
                <div class="prod-row-name" style="font-weight:600; font-size:0.9rem;">${p.nombre}</div>
                <div class="prod-row-sku text-muted" style="font-size:0.75rem;">
                    No. Producto: ${p.id} | Solicitado: <strong>${p.cantSolicitada}</strong> | 
                    Precio Unit: <strong class="text-success">$${parseFloat(p.precio).toLocaleString('es-MX', {minimumFractionDigits: 2})}</strong>
                </div>
            </div>
            <div style="width: 120px;" class="text-end">
                <input type="number" 
                       name="cantidades[${p.id}]" 
                       class="form-control form-control-sm input-suministro text-center" 
                       min="0" 
                       value="${p.cantSolicitada}"
                       data-precio="${p.precio}"
                       max="${p.cantSolicitada}"
                       oninput="recalcularTotalesProveedor()">
                <div class="small fw-bold mt-1 text-primary subtotal-fila">
                    $${(p.cantSolicitada * p.precio).toLocaleString('es-MX', {minimumFractionDigits: 2})}
                </div>
            </div>
        </div>
    `).join('');

    let resumenFinanciero = document.getElementById('resumen-financiero-prov');
    if (!resumenFinanciero) {
        resumenFinanciero = document.createElement('div');
        resumenFinanciero.id = 'resumen-financiero-prov';
        resumenFinanciero.className = 'p-3 my-3 border-top border-bottom bg-light d-flex justify-content-between align-items-center';
        cont.after(resumenFinanciero);
    }
    
    recalcularTotalesProveedor();

    const wrapper = document.getElementById('responder-wrapper');
    wrapper.classList.add('show');
    wrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function recalcularTotalesProveedor() {
    let granTotal = 0;
    const filas = document.querySelectorAll('.prod-row');
    
    filas.forEach(fila => {
        const input = fila.querySelector('.input-suministro');
        const displaySubtotal = fila.querySelector('.subtotal-fila');
        const precio = parseFloat(input.getAttribute('data-precio'));
        const cantidad = parseInt(input.value) || 0;
        
        const subtotal = precio * cantidad;
        granTotal += subtotal;
        
        displaySubtotal.textContent = `$${subtotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}`;
    });

    const resumen = document.getElementById('resumen-financiero-prov');
    if (resumen) {
        resumen.innerHTML = `
            <span class="fw-bold text-muted small text-uppercase">Total estimado del suministro:</span>
            <span class="fs-5 fw-bold text-primary">$${granTotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}</span>
        `;
    }
}

function verDetalleRespondido(folio) {
    const sol = SOLICITUDES_REALES[folio];
    if (!sol) {
        console.error("No se encontró la solicitud con folio: " + folio);
        return;
    }

    const dom = {
        folio: document.getElementById('lblFolioDetalle'),
        nota: document.getElementById('txtNotaDetalle'),
        tbody: document.getElementById('tbDetalleProductos'),
        tfoot: document.getElementById('tfootTotalCompra'),
        total: document.getElementById('txtTotalCompra'),
        modal: document.getElementById('modalVerDetalle')
    };

    if (dom.folio) dom.folio.textContent = folio;
    if (dom.nota) dom.nota.textContent = sol.nota || 'Sin observaciones.';
    
    let granTotal = 0;
    if (dom.tbody) {
        if (sol.estado === 'cancelada') {
            if (dom.tfoot) dom.tfoot.style.display = 'none';
            
            dom.tbody.innerHTML = sol.productos.map(p => `
                <tr style="background-color: #fff5f5;">
                    <td style="padding:12px;">
                        <div style="font-weight:600; color: #c53030;">${p.nombre}</div>
                        <div class="text-muted" style="font-size:0.75rem;">No. Producto: ${p.id}</div>
                    </td>
                    <td class="text-center" style="color: #c53030; font-weight: 600;">${p.cantSolicitada}</td>
                    <td colspan="3" class="text-center" style="color: #c53030; font-weight: 800; text-transform: uppercase; font-size: 0.75rem;">
                        <i class="fas fa-times-circle me-1"></i> Solicitud Rechazada / Sin Suministro
                    </td>
                </tr>
            `).join('');
        } else {
            if (dom.tfoot) dom.tfoot.style.display = 'table-footer-group';
            
            dom.tbody.innerHTML = sol.productos.map(p => {
                const sumin = parseInt(p.cantSuministrada) || 0;
                const prec = parseFloat(p.precio) || 0;
                const subtotal = sumin * prec;
                granTotal += subtotal;
                
                return `
                    <tr>
                        <td style="padding:12px;">
                            <div style="font-weight:600; color: var(--dark-blue);">${p.nombre}</div>
                            <div class="text-muted" style="font-size:0.75rem;">No. Producto: ${p.id}</div>
                        </td>
                        <td class="text-center" style="color: #64748b;">${p.cantSolicitada}</td>
                        <td class="text-center fw-bold text-primary" style="font-size: 1rem;">${sumin}</td>
                        <td class="text-end" style="color: #10b981;">$${prec.toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
                        <td class="text-end fw-bold" style="color: #1e293b;">$${subtotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}</td>
                    </tr>
                `;
            }).join('');
            
            if (dom.total) {
                dom.total.textContent = `$${granTotal.toLocaleString('es-MX', {minimumFractionDigits: 2})}`;
            }
        }
    }
    if (dom.modal) {
        dom.modal.style.display = 'flex';
    }
}



function cerrarDetalle() {
    const modal = document.getElementById('modalVerDetalle');
    if (modal) modal.style.display = 'none';
}

function toggleInputsSuministro(estado) {
    const inputs = document.querySelectorAll('.input-suministro');
    inputs.forEach(i => {
        i.disabled = (estado === 'cancelada');
        if(estado === 'cancelada') i.required = false;
        else i.required = true;
    });
}

function cerrarResponder() {
    document.getElementById('responder-wrapper').classList.remove('show');
}

function validarCantidad(sku, minimo) {
    const input = document.getElementById('qty-' + sku);
    const warn  = document.getElementById('warn-' + sku);
    if (parseInt(input.value) < minimo) {
        input.style.borderColor = '#dc2626';
        warn.style.display = 'block';
    } else {
        input.style.borderColor = '#22c55e';
        warn.style.display = 'none';
    }
}

function enviarRespuesta() {
    const folio = document.getElementById('folio-activo').textContent;
    const sol   = SOLICITUDES[folio];
    if (!sol) return;

    // Validar que todas las cantidades sean >= solicitadas
    let valido = true;
    sol.productos.forEach(p => {
        const val = parseInt(document.getElementById('qty-' + p.sku).value);
        if (isNaN(val) || val < p.cantSolicitada) {
            validarCantidad(p.sku, p.cantSolicitada);
            valido = false;
        }
    });

    if (!valido) {
        alert('Corrige las cantidades marcadas en rojo antes de enviar.');
        return;
    }

    // Simular envío — reemplazar con fetch/POST al backend
    document.getElementById('alerta-enviada').classList.add('show');
    document.getElementById('alerta-enviada').scrollIntoView({ behavior: 'smooth', block: 'nearest' });

    // Actualizar badge de pendientes
    const badge  = document.getElementById('badge-pendientes');
    const actual = parseInt(badge.textContent);
    if (actual > 1) badge.textContent = actual - 1;
    else badge.style.display = 'none';
}

/* ══════════════════════════════════════════════════════
   PERFIL — toggles vista / formulario
══════════════════════════════════════════════════════ */
function toggleEditEmpresa() {
    const v = document.getElementById('vistaEmpresa');
    const f = document.getElementById('formEmpresa');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function guardarEmpresa() {
    alert('Datos de empresa actualizados correctamente.');
    toggleEditEmpresa();
}

function toggleEditContacto() {
    const v = document.getElementById('vistaContacto');
    const f = document.getElementById('formContacto');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function guardarContacto() {
    alert('Datos de contacto actualizados correctamente.');
    toggleEditContacto();
}

function toggleEditPass() {
    const v = document.getElementById('vistaPass');
    const f = document.getElementById('formPass');
    v.style.display = v.style.display === 'none' ? '' : 'none';
    f.style.display = f.style.display === 'none' ? '' : 'none';
}
function cambiarPassword() {
    const actual  = document.getElementById('passActual').value;
    const nueva   = document.getElementById('passNueva').value;
    const confirm = document.getElementById('passConfirm').value;
    if (!actual || !nueva || !confirm) {
        alert('Completa todos los campos de contraseña.');
        return;
    }
    if (nueva !== confirm) {
        alert('La nueva contraseña y su confirmación no coinciden.');
        return;
    }
    if (nueva.length < 8) {
        alert('La contraseña debe tener al menos 8 caracteres.');
        return;
    }
    alert('Contraseña actualizada correctamente.');
    toggleEditPass();
}

/* ══════════════════════════════════════════════════════
   REDIRIGIR AL HISTORIAL
══════════════════════════════════════════════════════ */
function verHistorial(folio) {
    switchPanel(
        'panel-historial',
        document.querySelectorAll('.cuenta-nav-link')[2]
    );
}