<?php include('vista/vendedor/header_proveedor.php'); ?>

<div class="cuenta-layout">

    <?php include('vista/vendedor/menu_proveedor.php'); ?>
    <main>
        <div class="cuenta-panel active" id="panel-resumen">

            <div class="mb-4">
                <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-tachometer-alt me-2" style="color:var(--btn-color)"></i>Resumen
                </h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">
                    Vista general de tu actividad como proveedor en LuchanosCorp.
                </p>
            </div>

            <div class="row g-3 mb-4">
    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon" style="background:#fef3c7;color:#d97706">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <div>
                <div class="stat-card-val"><?php echo $total_pendientes; ?></div>
                <div class="stat-card-lbl">Solicitudes pendientes</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon" style="background:#dbeafe;color:#1d4ed8">
                <i class="fas fa-paper-plane"></i>
            </div>
            <div>
                <div class="stat-card-val"><?php echo $total_respuestas; ?></div>
                <div class="stat-card-lbl">Respuestas enviadas</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon" style="background:#dcfce7;color:#15803d">
                <i class="fas fa-check-double"></i>
            </div>
            <div>
                <div class="stat-card-val"><?php echo $total_confirmados; ?></div>
                <div class="stat-card-lbl">Suministros confirmados</div>
            </div>
        </div>
    </div>

    <div class="col-6 col-lg-3">
        <div class="stat-card">
            <div class="stat-card-icon" style="background:#f3e8ff;color:#7c3aed">
                <i class="fas fa-boxes"></i>
            </div>
            <div>
                <div class="stat-card-val"><?php echo number_format($total_unidades); ?></div>
                <div class="stat-card-lbl">Unidades suministradas</div>
            </div>
        </div>
    </div>
</div>

            <div class="cuenta-card">
    <div class="cuenta-card-header">
        <span><i class="fas fa-bell me-1"></i> Solicitudes Pendientes de Respuesta</span>
        <button class="btn-ver-detalle" onclick="switchPanel('panel-solicitudes', document.querySelectorAll('.cuenta-nav-link')[1])">
            Ver todas
        </button>
    </div>
    <div class="cuenta-card-body" style="padding:0">
        <table class="sol-table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($pendientes)): ?>
                    <tr>
                        <td colspan="4" class="text-center text-muted py-3">No tienes solicitudes pendientes por el momento.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach($pendientes as $p): ?>
                        <tr>
                            <td><strong><?php echo $p['folio_solicitud']; ?></strong></td>
                            <td><?php echo $p['fecha']; ?></td>
                            <td><?php echo $p['total_prod']; ?> producto(s)</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

        </div>
        <div class="cuenta-panel" id="panel-solicitudes">

            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">
                <div>
                    <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                        <i class="fas fa-inbox me-2" style="color:var(--btn-color)"></i>Solicitudes de Reabastecimiento
                    </h5>
                    <p style="font-size:.8rem;color:#6c757d;margin:0">
                        Indica las cantidades disponibles para cada producto solicitado por el administrador.
                    </p>
                </div>
            </div>
             <?php if(!empty($msj) && isset($_REQUEST["enviar_respuesta"])){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?>" style="margin: 15px 15px 0 15px;"><?php echo $msj[1]; ?></div>
                            <?php } ?>
            <div class="cuenta-card mb-3">
    <div class="cuenta-card-header">
        <span><i class="fas fa-list-ul me-1"></i> Todas las solicitudes</span>
    </div>
    <div class="cuenta-card-body" style="padding:0">
        <table class="sol-table">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Fecha recibida</th>
                    <th>Productos</th>
                    <th>Nota del admin.</th>
                    <th>Estado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($todas_solicitudes as $s): ?>
                <tr>
                    <td><strong><?= $s['folio_solicitud'] ?></strong></td>
                    <td><?= $s['fecha'] ?></td>
                    <td><?= $s['total_prod'] ?> productos</td>
                    <td style="max-width:180px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis">
                        <?= htmlspecialchars($s['observaciones'] ?: 'Sin observaciones') ?>
                    </td>
                    <td>
                        <?php 
                            $clase = match($s['estado']) {
                                'enviada'    => 'badge-pendiente',
                                'respondida' => 'badge-respondida',
                                'cancelada'  => 'badge-cancelada',
                                default      => 'badge-secondary'
                            };

                            // Asignación de Texto
                            $texto = match($s['estado']) {
                                'enviada'    => 'Pendiente',
                                'respondida' => 'Respondida',
                                'cancelada'  => 'Cancelada',
                                default      => 'Desconocido'
                            };
                        ?>
                        <span class="<?= $clase ?>"><?= $texto ?></span>
                    </td>
                    <td>
                        <?php if($s['estado'] == 'enviada'): ?>
                            <button class="btn-ver-detalle" onclick="abrirSolicitud('<?= $s['folio_solicitud'] ?>')">
                                <i class="fas fa-reply me-1"></i> Responder
                            </button>
                        <?php else: ?>
                            <button class="btn-ver-detalle" onclick="verDetalleRespondido('<?= $s['folio_solicitud'] ?>')">
                                <i class="fas fa-eye me-1"></i> Ver detalle
                            </button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="responder-panel" id="responder-wrapper">
    <form action="/proyectoweb/proveedor/inicio" method="POST">
        <input type="hidden" name="folio_respuesta" id="input-folio">
        
        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
            <div>
                <h6 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-reply me-1" style="color:var(--btn-color)"></i>
                    Respondiendo solicitud: <span id="folio-activo">—</span>
                </h6>
            </div>
            <button type="button" class="btn-prov-cancel" onclick="cerrarResponder()">
                <i class="fas fa-times me-1"></i> Cancelar
            </button>
        </div>

        <div class="p-3 mb-3 rounded" style="background:#eff6ff;border-left:3px solid #3b82f6;font-size:.83rem;color:#1e3a5f">
            <strong><i class="fas fa-sticky-note me-1"></i> Nota del administrador:</strong>
            <span id="nota-admin-txt">—</span>
        </div>

        <div class="d-flex justify-content-between px-2 mb-2 small fw-bold text-muted text-uppercase">
            <span>Producto</span>
            <span>Cantidad a surtir</span>
        </div>

        <div id="productos-solicitud">
            </div>

        <div class="mt-3">
            <label class="form-label fw-semibold small">¿Cómo responderás a esta solicitud?</label>
            <select name="nuevo_estado" class="form-select mb-3" required onchange="toggleInputsSuministro(this.value)">
                <option value="respondida">Confirmar Suministro (Registrar Compra)</option>
                <option value="cancelada">Rechazar Solicitud (No surtir)</option>
            </select>
        </div>

        <div class="d-flex gap-2 mt-3">
            <button type="submit" name="enviar_respuesta" class="btn-prov-primary">
                <i class="fas fa-paper-plane me-1"></i> Confirmar y Enviar
            </button>
        </div>
    </form>
</div>

<div class="modal-pedido-overlay" id="modalVerDetalle" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); z-index:9999; justify-content:center; align-items:center;">
    <div class="modal-pedido-box" style="background:#fff; width:98%; max-width:850px; border-radius:10px; overflow:hidden; box-shadow: 0 15px 35px rgba(0,0,0,0.3);">
        
        <div class="modal-pedido-header" style="background:var(--dark-blue); color:white; padding:18px; display:flex; justify-content:space-between; align-items:center;">
            <span style="font-weight:700; font-size:1.1rem;">
                <i class="fas fa-file-invoice me-2"></i> Resumen de Solicitud: 
                <span id="lblFolioDetalle" style="color:#00a8cc;"></span>
            </span>
            <button type="button" onclick="cerrarDetalle()" style="background:none; border:none; color:white; font-size:1.6rem; cursor:pointer; line-height:1;">&times;</button>
        </div>

        <div class="modal-pedido-body" style="padding:20px;">
            <div class="mb-3 p-3 rounded" style="background:#f8fafc; border:1px solid #e2e8f0; font-size:0.85rem;">
                <strong style="color:var(--dark-blue);"><i class="fas fa-sticky-note me-1"></i> Nota del administrador:</strong><br>
                <span id="txtNotaDetalle" class="text-muted"></span>
            </div>

            <div class="table-responsive" style="border:1px solid #eee; border-radius:8px; max-height: 400px; overflow-y: auto;">
                <table class="admin-table" style="margin-bottom:0; font-size:0.85rem; width: 100%;">
                    <thead style="background:#002347; color:white; position: sticky; top: 0;">
                        <tr>
                            <th style="padding:12px;">Producto</th>
                            <th class="text-center">Solicitado</th>
                            <th class="text-center">Suministrado</th>
                            <th class="text-end">P. Unitario</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody id="tbDetalleProductos">
                        </tbody>
                    <tfoot id="tfootTotalCompra" style="background:#f1f5f9; font-weight:700; border-top: 2px solid #dee2e6;">
                        <tr>
                            <td colspan="4" class="text-end text-uppercase" style="padding:15px;">Total de la Compra:</td>
                            <td class="text-end" id="txtTotalCompra" style="color:var(--btn-color); font-size:1.2rem; padding:15px;">$0.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

        </div><!-- /panel-solicitudes -->

        <div class="cuenta-panel" id="panel-historial">
    <div class="mb-4">
        <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
            <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Historial de Solicitudes
        </h5>
        <p style="font-size:.8rem;color:#6c757d;margin:0">Registro de todas las solicitudes.</p>
    </div>

    <div class="row g-3 mb-4 align-items-end hist-filtros">
        <div class="col-md-5">
            <label class="small fw-bold text-muted mb-1"><i class="fas fa-search me-1"></i>Buscar por folio:</label>
            <div class="input-group input-group-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted"></i></span>
                <input type="text" id="hist-busqueda" class="form-control border-start-0" placeholder="LC-REA-...">
            </div>
        </div>
        <div class="col-md-4">
            <label class="small fw-bold text-muted mb-1"><i class="fas fa-filter me-1"></i>Estado:</label>
            <select id="hist-filtro-estado" class="form-select form-select-sm">
                <option value="todos">Todos</option>
                <option value="enviada">Enviada</option>
                <option value="respondida">Respondida</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>
        <div class="col-md-3">
            <label class="small fw-bold text-muted mb-1"><i class="fas fa-list-ol me-1"></i>Mostrar:</label>
            <select id="hist-filtro-num" class="form-select form-select-sm">
                <option value="5">5 registros</option>
                <option value="10">10 registros</option>
                <option value="20">20 registros</option>
                <option value="999">Todos</option>
            </select>
        </div>
    </div>

    <div id="historial-lista-cards"></div>

    <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
        <div id="hist-info-registros" class="small text-muted fw-bold">
            Mostrando 0 de 0 registros
        </div>
        <div id="hist-paginacion" class="d-flex align-items-center gap-3">
            </div>
    </div>
</div>
        <div class="cuenta-panel" id="panel-perfil">

            <div class="mb-4">
                <h5 style="color:var(--dark-blue);font-weight:700;margin:0">
                    <i class="fas fa-user-edit me-2" style="color:var(--btn-color)"></i>Mi Perfil
                </h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">
                    Consulta y actualiza la información de tu empresa.
                </p>
            </div>

            <!-- Datos del contacto principal -->
            <div class="cuenta-card mb-3">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-id-card"></i> Contacto Principal</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditContacto()">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <!-- Vista -->
                    <div id="vistaContacto">
                        <?php if(isset($msj) && isset($_REQUEST['guardar'])){ ?>
                                    <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                                <?php } ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Nombre</div>
                                    <div class="perfil-valor"><?php echo $info[0]['nombre']; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Apellido(s)</div>
                                    <div class="perfil-valor"><?php echo $info[0]['apellidospama']; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Teléfono directo</div>
                                    <div class="perfil-valor"><?php echo $info[0]['telefono']; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Correo personal</div>
                                    <div class="perfil-valor"><?php echo $info[0]['correo']; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Formulario -->
                    <div id="formContacto" style="display:none">
                        <form action="/proyectoweb/proveedor/inicio" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $info[0]['nombre']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Apellido(s) <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="apellidos" value="<?php echo $info[0]['apellidospama']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono directo</label>
                                <input type="tel" class="form-control" name="telefono" value="<?php echo $info[0]['telefono']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Correo personal <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="correo" value="<?php echo $info[0]['correo']; ?>">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" name="guardar" class="btn-cuenta-save">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                            <button class="btn-cuenta-cancel" onclick="toggleEditContacto()">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Cambio de contraseña -->
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-lock"></i> Seguridad</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditPass()">
                        <i class="fas fa-key"></i> Cambiar contraseña
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <div id="vistaPass">
                        <p style="font-size:.85rem;color:#6b7280;margin:0">
                            <i class="fas fa-shield-alt me-1"></i>
                            Contraseña configurada. Cámbiala regularmente para mayor seguridad.
                        </p>
                    </div>
                    
                    <form action="/proyectoweb/proveedor/inicio" method="POST">
                        <?php if(isset($msj) && isset($_REQUEST['actualizar_contra'])){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                            <?php } ?>
                    <div id="formPass" style="display:none">

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="password">Contraseña <span class="text-danger">*</span></label>
                                <div class="pw-wrapper">
                                    <input type="password" id="password" name="password" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                    <span class="pw-toggle" onclick="togglePw('password','eye1')">
                                        <i class="fas fa-eye" id="eye1"></i>
                                    </span>
                                </div>
                                <div id="pw-indicadores" style="margin-top:.5rem"></div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="confirmPassword">Confirmar Contraseña <span class="text-danger">*</span></label>
                                <div class="pw-wrapper">
                                    <input type="password" id="confirmPassword" name="confirmPassword" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                    <span class="pw-toggle" onclick="togglePw('confirmPassword','eye2')">
                                        <i class="fas fa-eye" id="eye2"></i>
                                    </span>
                                </div>
                                <div id="pw-confirm-msg" style="font-size:.75rem;margin-top:.35rem;font-weight:600;min-height:1rem"></div>
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" name="actualizar_contra" class="btn-cuenta-save">
                                <i class="fas fa-save me-1"></i> Actualizar contraseña
                            </button>
                            <button class="btn-cuenta-cancel" onclick="toggleEditPass()">Cancelar</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>

        </div><!-- /panel-perfil -->

    </main>
</div><!-- /cuenta-layout -->
<script>const SOLICITUDES_REALES = <?= json_encode($solicitudes_js) ?>;</script>
<script>


let DATA_HISTORIAL = <?= json_encode($historial) ?>;
let pagActual = 1;

function renderizarHistorial() {
    const busqueda = document.getElementById('hist-busqueda').value.toUpperCase();
    const filtroEstado = document.getElementById('hist-filtro-estado').value;
    const numMostrar = parseInt(document.getElementById('hist-filtro-num').value);

    // 1. Filtrado
    let filtrados = DATA_HISTORIAL.filter(item => {
        const matchFolio = item.folio_solicitud.includes(busqueda);
        const matchEstado = filtroEstado === 'todos' || item.estado === filtroEstado;
        return matchFolio && matchEstado;
    });

    const totalRegistros = filtrados.length;
    const totalPaginas = Math.ceil(totalRegistros / numMostrar);
    if(pagActual > totalPaginas) pagActual = totalPaginas || 1;

    const inicio = (pagActual - 1) * numMostrar;
    const itemsParaMostrar = filtrados.slice(inicio, inicio + numMostrar);
    const infoReg = document.getElementById('hist-info-registros');
    infoReg.textContent = `Página ${pagActual} de ${totalPaginas || 1} (${totalRegistros} registros totales)`;

    const contenedor = document.getElementById('historial-lista-cards');
    if(totalRegistros === 0) {
        contenedor.innerHTML = `<div class="text-center p-5 text-muted">No se encontraron registros.</div>`;
    } else {
        contenedor.innerHTML = itemsParaMostrar.map(item => {
            const config = getEstiloEstado(item.estado);
            const unidades = parseInt(item.unidades_suministradas) || 0;
            return `
                <div class="hist-card-wrap">

                    <div class="hist-card-header" style="background:${config.color}">
                        <span class="hist-card-header-folio">
                            <i class="${config.icon} me-2"></i>${item.folio_solicitud}
                        </span>
                        <span class="hist-card-badge">${config.texto}</span>
                    </div>

                    <div class="hist-card-data">
                        <div class="row g-3">

                            <div class="col-6 col-md-3">
                                <div class="hist-dato">
                                    <div class="hist-dato-label">
                                        <i class="fas fa-calendar-plus me-1"></i>Solicitado el
                                    </div>
                                    <div class="hist-dato-val">${item.fecha_solicitud}</div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="hist-dato">
                                    <div class="hist-dato-label">
                                        <i class="fas fa-reply me-1"></i>Respondido el
                                    </div>
                                    <div class="hist-dato-val">
                                        ${item.fecha_respuesta
                                            ? item.fecha_respuesta
                                            : '<span class="hist-dato-val-muted">---</span>'}
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="hist-dato">
                                    <div class="hist-dato-label">
                                        <i class="fas fa-boxes me-1"></i>Productos
                                    </div>
                                    <div class="hist-dato-val">
                                        ${item.total_productos} <span class="hist-dato-val-unit">ítems</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-md-3">
                                <div class="hist-dato ${unidades > 0 ? 'hist-dato-ok' : ''}">
                                    <div class="hist-dato-label">
                                        <i class="fas fa-truck me-1"></i>Suministrado
                                    </div>
                                    <div class="hist-dato-val ${unidades === 0 ? 'hist-dato-val-muted' : ''}">
                                        ${unidades > 0
                                            ? unidades + ' <span class="hist-dato-val-unit">unidades</span>'
                                            : '---'}
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            `;
        }).join('');
    }

    renderizarPaginacionPro(totalPaginas);
}

function renderizarPaginacionPro(total) {
    const paginador = document.getElementById('hist-paginacion');
    if (total <= 1) {
        paginador.innerHTML = '';
        return;
    }

    let html = '';
    if (pagActual > 1) {
        html += `<button class="btn btn-sm btn-outline-primary shadow-sm" onclick="cambiarPag(${pagActual - 1})">
                    <i class="fas fa-chevron-left"></i> Anterior
                 </button>`;
    }

    if (pagActual < total) {
        html += `<button class="btn btn-sm btn-outline-primary shadow-sm" onclick="cambiarPag(${pagActual + 1})">
                    Siguiente <i class="fas fa-chevron-right"></i>
                 </button>`;
    }

    paginador.innerHTML = html;
}

function getEstiloEstado(estado) {
    const estilos = {
        'respondida': { color: '#065f46', icon: 'fas fa-check-double', texto: 'Respondida' },
        'cancelada':  { color: '#991b1b', icon: 'fas fa-times-circle', texto: 'Cancelada' },
        'enviada':    { color: '#64748b', icon: 'fas fa-paper-plane', texto: 'Enviada' }
    };
    return estilos[estado] || { color: '#6c757d', icon: 'fas fa-info-circle', texto: estado };
}

function renderizarPaginacion(total) {
    const paginador = document.getElementById('hist-paginacion');
    let html = '';
    for(let i=1; i<=total; i++) {
        html += `<button class="btn btn-sm ${i===pagActual ? 'btn-primary' : 'btn-outline-secondary'}" onclick="cambiarPag(${i})">${i}</button>`;
    }
    paginador.innerHTML = html;
}

function cambiarPag(p) {
    pagActual = p;
    renderizarHistorial();
}
document.getElementById('hist-busqueda').addEventListener('input', () => { pagActual=1; renderizarHistorial(); });
document.getElementById('hist-filtro-estado').addEventListener('change', () => { pagActual=1; renderizarHistorial(); });
document.getElementById('hist-filtro-num').addEventListener('change', () => { pagActual=1; renderizarHistorial(); });


document.addEventListener('DOMContentLoaded', renderizarHistorial);


document.addEventListener('DOMContentLoaded', () => {
    const panelGuardado = localStorage.getItem('activePanel');
    
    if (panelGuardado) {
        const selector = `[onclick*="${panelGuardado}"]`;
        const botonMenu = document.querySelector(selector);
        
        if (botonMenu) {
            document.querySelectorAll('.cuenta-panel').forEach(p => p.classList.remove('active'));
            document.querySelectorAll('.cuenta-nav-link').forEach(b => b.classList.remove('active'));
            
            botonMenu.click();
        }
    }
});
</script>

<?php include('vista/vendedor/footer_proveedor.php'); ?>