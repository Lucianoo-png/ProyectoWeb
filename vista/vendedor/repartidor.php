<?php include('vista/vendedor/header_repartidor.php'); ?>

<div class="admin-layout">

    <nav class="admin-sidebar">
        <p class="sidebar-title">Repartidor</p>
        <a class="nav-link <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" style="cursor:pointer;" onclick="switchTab('tab-entregas', this); return false;">
            <i class="fas fa-truck"></i> Mis Entregas
        </a>
        <a class="nav-link" style="cursor:pointer;" onclick="switchTab('tab-historial', this); return false;">
            <i class="fas fa-history"></i> Historial
        </a>
        <a class="nav-link <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" style="cursor:pointer;" onclick="switchTab('tab-perfil', this); return false;">
            <i class="fas fa-user-cog"></i> Mi Perfil
        </a>
        <hr class="sidebar-divider">
        <a href="/proyectoweb/repartidor/logout" style="cursor:pointer;margin-top:0;" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Panel de Repartidor</h1>
            <p class="page-header-sub">
                Bienvenido de nuevo. Gestiona tus entregas asignadas.
            </p>
        </div>

        <div class="info-card-vend mb-4">
            <div class="info-avatar"><i class="fas fa-motorcycle"></i></div>
            <div class="info-rows">
                <p><span class="label">Empresa</span><br>
                   <span class="value"><?php echo $info[0]['empresa']; ?></span></p>
                <p><span class="label">Repartidor</span><br>
                   <span class="value"><?php echo $info[0]['nombre']." ".$info[0]['apellidospama']; ?></span></p>
                <p><span class="label">Modalidad</span><br>
                   <span class="value">Externa</span></p>
            </div>
        </div>

        <div class="rep-nav-tabs">
            <button class="rep-nav-btn <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="btn-tab-entregas"
                    onclick="switchTab('tab-entregas', this)">
                <i class="fas fa-truck"></i> Mis Entregas
            </button>
            <button class="rep-nav-btn" id="btn-tab-historial"
                    onclick="switchTab('tab-historial', this)">
                <i class="fas fa-history"></i> Historial de Pedidos
            </button>
            <button class="rep-nav-btn <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="btn-tab-perfil"
                    onclick="switchTab('tab-perfil', this)">
                <i class="fas fa-user-cog"></i> Mi Perfil
            </button>
        </div>


        <div class="rep-nav-panel <?php echo (!isset($_REQUEST['guardar']) && !isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="tab-entregas">

            <div class="mb-2"><span class="section-title">Entrega Asignada</span></div>
                  <?php if(isset($msj) && isset($_REQUEST['actualizar_estado'])){ ?>
                                    <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                                <?php } ?>
            <?php 
// 1. Iniciamos el ciclo para recorrer los pedidos asignados a este repartidor
foreach($pedidos as $ped): 

    $id = $ped['no_orden']; 
    
    // 2. Buscamos dirección y cliente (Igual que antes)
    $direccion = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where"=>"no_dirección=".$ped["no_direccion"]])[0];
    $clienteInfo = $cli->getCliente()->buscar('"Veracruz".cliente', ["where"=>"no_cliente=".$direccion['no_cliente']])[0];
    $nombreCliente = $clienteInfo['nombre'] . ' ' . $clienteInfo['apellidospama'];
    $telefono = $clienteInfo['telefono'] ?? 'Sin registrar';

    // 3. Total del pedido
    $total = $pedido->getPedido()->buscar('"Veracruz".pedido', ["select"=>"total", "where"=>"no_referencia=".$ped['no_referencia']])[0]['total'];

    // 4. Buscamos los productos con el JOIN correcto que acabamos de armar
    $productos = $pedido->getPedido()->buscar('"Veracruz".detallepedido dp', [
        "select" => "prod.nombre, prod.no_producto AS sku, dp.cantidad",
        "join"   => 'JOIN "Veracruz".producto_detalle_pedido pdp ON dp.no_referencia_detalle = pdp.no_referencia_detalle 
                     JOIN "Veracruz".producto prod ON pdp.no_producto = prod.no_producto',
        "where"  => "dp.no_referencia = " . $ped['no_referencia']
    ]);

    // 5. Configuración visual según el estado ('P' = Preparación, 'R' = En ruta, 'E' = Entregado)
    $estadoActual = $ped['estado'];
    
    // Textos y badges corregidos con tu CSS exacto
    $txtEstado = 'En preparación';
    $claseBadge = 'badge-preparacion'; 
    if($estadoActual == 'R') { $txtEstado = 'Salió a ruta'; $claseBadge = 'badge-ruta'; }
    if($estadoActual == 'E') { $txtEstado = 'Entregado'; $claseBadge = 'badge-entregado'; }

    // Lógica para pintar los pasos (.done o .current) según tu CSS
    $step_recibido = 'done';
    $line_1 = 'done';
    
    $step_preparacion = '';
    $line_2 = '';
    
    $step_ruta = '';
    $line_3 = '';
    
    $step_entregado = '';

    if ($estadoActual == 'P') {
        $step_preparacion = 'current'; // Está preparándose
    } elseif ($estadoActual == 'R') {
        $step_preparacion = 'done';
        $line_2 = 'done';
        $step_ruta = 'current'; // Está en ruta
    } elseif ($estadoActual == 'E') {
        $step_preparacion = 'done';
        $line_2 = 'done';
        $step_ruta = 'done';
        $line_3 = 'done';
        $step_entregado = 'done'; // Ya se entregó
    }
?>

<div class="entrega-card" id="entregaCard_<?php echo $id; ?>">
    <div class="entrega-card-header">
        <span><i class="fas fa-box me-1"></i> Pedido #<?php echo str_pad($id, 4, '0', STR_PAD_LEFT).(" | Notas: " . ($ped['observaciones'] ?? "Sin observaciones")); ?></span>
        <span class="badge-estado <?php echo $claseBadge; ?>"><?php echo $txtEstado; ?></span>
    </div>
    
    <div class="entrega-card-body">
        <div class="row g-3 mb-4">
            
            <!-- Columna Izquierda: Cliente -->
            <div class="col-md-6">
                <div class="perfil-campo">
                    <div class="perfil-label">Cliente</div>
                    <div class="perfil-valor"><?php echo htmlspecialchars($nombreCliente); ?></div>
                </div>
                <div class="perfil-campo">
                    <div class="perfil-label">Teléfono</div>
                    <div class="perfil-valor">
                        <?php if($telefono !== 'Sin registrar'): ?>
                            <a href="tel:<?php echo $telefono; ?>" style="color:var(--btn-color);font-weight:600">
                                <i class="fas fa-phone me-1"></i><?php echo $telefono; ?>
                            </a>
                        <?php else: ?>
                            <span style="color:#888">No registrado</span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="perfil-campo">
                    <div class="perfil-label">Dirección de entrega</div>
                    <div class="perfil-valor">
                        <?php echo htmlspecialchars($direccion['calle_numero']); ?><br>
                        Col. <?php echo htmlspecialchars($direccion['colonia'] ?? ''); ?>, <?php echo $direccion['cp'] ?? ''; ?><br>
                        <?php echo htmlspecialchars($direccion['ciudad'] ?? '') . ', ' . htmlspecialchars($direccion['estado'] ?? ''); ?>
                    </div>
                </div>
            </div>
            
            <!-- Columna Derecha: Detalles del Pedido -->
            <div class="col-md-6">
                <div class="perfil-campo">
                    <div class="perfil-label">Producto(s)</div>
                    <div class="perfil-valor">
                        <!-- Aquí iteramos los productos que sacamos con el JOIN -->
                        <?php foreach($productos as $prod): ?>
                            <div class="mb-1">
                                <strong><?php echo htmlspecialchars($prod['nombre']); ?></strong><br>
                                <span style="font-size:.78rem;color:#888">No. Producto: <?php echo $prod['sku']; ?> · Cant: <?php echo $prod['cantidad']; ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="perfil-campo">
                    <div class="perfil-label">Fecha de asignación</div>
                    <div class="perfil-valor">
                        <?php 
                        $fechaMostrar = $ped['fechayhora_asignacion'] ?? $ped['fechayhora'];
                        $meses = ['Jan'=>'Ene', 'Feb'=>'Feb', 'Mar'=>'Mar', 'Apr'=>'Abr', 'May'=>'May', 'Jun'=>'Jun', 'Jul'=>'Jul', 'Aug'=>'Ago', 'Sep'=>'Sep', 'Oct'=>'Oct', 'Nov'=>'Nov', 'Dec'=>'Dic'];
$time = strtotime($fechaMostrar);
echo date('d \d\e ', $time) . $meses[date('M', $time)] . date(' \d\e Y - h:i A', $time);
                        ?>
                    </div>
                </div>
                <div class="perfil-campo">
                    <div class="perfil-label">Total del pedido</div>
                    <div class="perfil-valor" style="color:var(--btn-color);font-weight:800">
                        $<?php echo number_format($total, 2); ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==========================================
             SECCIÓN DE ESTADO Y FORMULARIO
        =========================================== -->
        <div class="admin-form-card mb-4">
            <div class="admin-form-header">
                <i class="fas fa-map-marked-alt me-1"></i> Estado de la Entrega
            </div>
            <div class="admin-form-body">

                <!-- Tracking visual -->
                <div class="rep-tracking" id="repTracking_<?php echo $id; ?>">
                    <div class="rep-step <?php echo $step_recibido; ?>">
                        <div class="rep-step-circle"><i class="fas fa-inbox"></i></div>
                        <div class="rep-step-label">Pedido recibido</div>
                    </div>
                    <div class="rep-line <?php echo $line_1; ?>"></div>
                    
                    <div class="rep-step <?php echo $step_preparacion; ?>">
                        <div class="rep-step-circle"><i class="fas fa-box-open"></i></div>
                        <div class="rep-step-label">En preparación</div>
                    </div>
                    <div class="rep-line <?php echo $line_2; ?>"></div>
                    
                    <div class="rep-step <?php echo $step_ruta; ?>">
                        <div class="rep-step-circle"><i class="fas fa-truck"></i></div>
                        <div class="rep-step-label">Salió a ruta</div>
                    </div>
                    <div class="rep-line <?php echo $line_3; ?>"></div>
                    
                    <div class="rep-step <?php echo $step_entregado; ?>">
                        <div class="rep-step-circle"><i class="fas fa-home"></i></div>
                        <div class="rep-step-label">Entregado</div>
                    </div>
                </div>

                <!-- Formulario PHP para cambiar el estado -->
                <div class="mt-4 p-3 rounded" style="background:#f8fafc;border:1px solid #e0e7f0;">
                    <p class="fw-bold mb-2" style="font-size:.83rem;color:#333;">
                        <i class="fas fa-sliders-h me-1" style="color:var(--btn-color)"></i> Actualizar estado del envío
                    </p>
                    
                    <!-- Formulario real apuntando a tu controlador -->
                    <form action="/proyectoweb/repartidor/inicio" method="POST">
                        <input type="hidden" name="no_orden" value="<?php echo $id; ?>">
                        <input type="hidden" name="no_referencia" value="<?php echo $ped['no_referencia']; ?>">
                        <input type="hidden" name="estado_actual" value="<?php echo $estadoActual; ?>">
                        
                        <div class="d-flex align-items-center gap-3">
                            <select name="nuevo_estado" class="form-select" style="max-width: 250px;" required>
                                <?php if($estadoActual == 'P'): ?>
                                    <option value="R">Salió a ruta</option>
                                <?php endif; ?>
                                
                                <option value="E">Entregado</option>
                            </select>
                            
                            <button type="submit" name="actualizar_estado" class="btn-avanzar-estado">
                                <i class="fas fa-save me-1"></i> Guardar estado
                            </button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
        <!-- Fin Sección Formulario -->

    </div>
</div>
<?php endforeach; ?>
            <div id="sinEntregas" style="display:none">
                <div class="admin-form-card">
                    <div class="admin-form-body empty-state">
                        <i class="fas fa-box-open"></i>
                        <p>No tienes entregas asignadas en este momento.</p>
                    </div>
                </div>
            </div>

        </div><div class="rep-nav-panel" id="tab-historial">

            <div class="mb-3"><span class="section-title">Historial de Entregas</span></div>

            <div class="report-form-card mb-4">
                <h5 class="text-center">
                    <i class="fas fa-filter me-2" style="color:var(--btn-color)"></i>Filtrar Pedidos
                </h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Desde:</label>
                        <input type="date" id="filtroDesde" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Hasta:</label>
                        <input type="date" id="filtroHasta" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select id="filtroEstado" class="form-select">
                            <option value="all">Todos</option>
                            <option value="Entregado">Entregado</option>
                            <option value="Salió a ruta">Salió a ruta</option>
                            <option value="En preparación">En preparación</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Búsqueda rápida:</label>
                        <input type="text" id="searchInput" class="form-control" placeholder="Folio o Cliente...">
                    </div>
                </div>
            </div>

            <div class="report-form-card">
                <div class="admin-form-body pb-0 px-0">
                    <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                        <h5 class="mb-0 text-center w-100">
                            <i class="fas fa-history me-2" style="color:var(--btn-color)"></i>Listado de Historial
                        </h5>
                        <div class="w-100 d-flex justify-content-between align-items-center px-3">
                            <div class="table-page-info text-muted small">
                                Número de registros por página: <span id="info-rows-per-page">5</span> | Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
                            </div>
                            <div class="d-flex gap-2">
                                <select id="rowsPerPageSelect" class="form-select form-select-sm w-auto">
                                    <option value="5" selected>5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="all">Todos</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="admin-pagination mt-3 px-3" id="paginationControls"></div>

                <div class="admin-table-wrap">
                    <table class="admin-table" id="tablaHistorial">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Folio</th>
                                <th class="th-left">Cliente</th>
                                <th>Fecha asignación</th>
                                <th>Total</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody id="historialTbody">
    <?php 
    $i = 1;
    // Asumimos que $historial trae todos los pedidos del repartidor
    foreach($historial as $ped): 
        $id = $ped['no_orden']; 
        
        // Buscar cliente
        $direccion = $cli->getCliente()->buscar('"Veracruz".clientedireccion', ["where"=>"no_dirección=".$ped["no_direccion"]])[0];
        $clienteInfo = $cli->getCliente()->buscar('"Veracruz".cliente', ["where"=>"no_cliente=".$direccion['no_cliente']])[0];
        $nombreCliente = $clienteInfo['nombre'] . ' ' . $clienteInfo['apellidospama'];

        // Buscar total
        $total = $pedido->getPedido()->buscar('"Veracruz".pedido', ["select"=>"total", "where"=>"no_referencia=".$ped['no_referencia']])[0]['total'];

        // Definir estado
        $estadoActual = $ped['estado'];
        $txtEstado = 'En preparación';
        $claseBadge = 'badge-preparacion'; 
        if($estadoActual == 'R') { $txtEstado = 'Salió a ruta'; $claseBadge = 'badge-ruta'; }
        if($estadoActual == 'E') { $txtEstado = 'Entregado'; $claseBadge = 'badge-entregado'; }

        // Fecha cruda para el filtro JS (YYYY-MM-DD)
        $fechaCruda = date('Y-m-d', strtotime($ped['fechayhora_asignacion'] ?? $ped['fechayhora']));
        // Fecha formateada para mostrar al usuario (DD/MM/YYYY)
        $fechaMostrar = date('d/m/Y', strtotime($ped['fechayhora_asignacion'] ?? $ped['fechayhora']));
    ?>
    <tr>
        <td><?php echo $i++; ?></td>
        <td><strong><?php echo str_pad($id, 4, '0', STR_PAD_LEFT); ?></strong></td>
        <td class="th-left"><?php echo htmlspecialchars($nombreCliente); ?></td>
        <td><?php echo $fechaMostrar; ?></td>
        <td><strong>$<?php echo number_format($total, 2); ?></strong></td>
        <td><span class="badge-estado <?php echo $claseBadge; ?>"><?php echo $txtEstado; ?></span></td>
        
        <td style="display:none;"><?php echo $fechaCruda; ?></td>
    </tr>
    <?php endforeach; ?>
</tbody>
                    </table>
                </div>
            </div>

        </div><div class="rep-nav-panel <?php echo (isset($_REQUEST['guardar']) || isset($_REQUEST['actualizar_contra']) ? 'active' : ''); ?>" id="tab-perfil">

            <div class="mb-3"><span class="section-title">Mi Información</span></div>

            <div class="row g-4">

                <div class="col-lg-7">
                    <form action="/proyectoweb/repartidor/inicio" method="POST">
                    <input type="hidden" name="guardar" value="1">
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-id-card me-1"></i> Datos Personales
                        </div>
                        <div class="admin-form-body">
                            <div class="row g-3">
                                <?php if(isset($msj) && isset($_REQUEST['guardar'])){ ?>
                                    <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                                <?php } ?>
                                <div class="col-md-6">
                                    <label class="form-label">Nombre(s) *</label>
                                    <input type="text" id="pNombre" name="nombre" value="<?php echo $info[0]['nombre']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Apellidos *</label>
                                    <input type="text" id="pApellidos" name="apellidos" value="<?php echo $info[0]['apellidospama']; ?>" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Teléfono *</label>
                                    <input type="tel" id="pTelefono" class="form-control" name="telefono" value="<?php echo $info[0]['telefono']; ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Correo electrónico *</label>
                                    <input type="email" id="pCorreo" class="form-control" name="correo" value="<?php echo $info[0]['correo']; ?>">
                                </div>
                            </div>
                            <hr class="admin-form-divider mt-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <button type="submit" name="guardar" class="btn-admin-primary">
                                    <i class="fas fa-save me-1"></i> Guardar cambios
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="col-lg-5">

                    <form action="/proyectoweb/repartidor/inicio" method="POST">
                    <input type="hidden" name="actualizar_contra" value="1">
                    <div class="perfil-edit-card">
                        <div class="admin-form-header">
                            <i class="fas fa-lock me-1"></i> Cambiar Contraseña
                        </div>
                        <div class="admin-form-body">
                            <?php if(isset($msj) && isset($_REQUEST['actualizar_contra'])){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                            <?php } ?>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label" for="password">Contraseña <span class="text-danger">*</span></label>
                                    <div class="pw-wrapper">
                                        <input type="password" id="password" name="password" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                        <span class="pw-toggle" onclick="togglePw('password','eye1')">
                                            <i class="fas fa-eye" id="eye1"></i>
                                        </span>
                                    </div>
                                    <div id="pw-indicadores" style="margin-top:.5rem"></div>
                                </div>

                                <div class="col-md-12">
                                    <label class="form-label" for="confirmPassword">Confirmar Contraseña <span class="text-danger">*</span></label>
                                    <div class="pw-wrapper">
                                        <input type="password" id="confirmPassword" name="confirmPassword" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                                        <span class="pw-toggle" onclick="togglePw('confirmPassword','eye2')">
                                            <i class="fas fa-eye" id="eye2"></i>
                                        </span>
                                    </div>
                                    <div id="pw-confirm-msg" style="font-size:.75rem;margin-top:.35rem;font-weight:600;min-height:1rem"></div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" name="actualizar_contra" id="btnRegistrar" class="btn-cuenta-save w-100">
                                    <i class="fas fa-key me-1"></i> Actualizar contraseña
                                </button>
                            </div>
                        </div>
                    </div>
                    </form>    
                </div>

            </div>

        </div></main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const filtroDesde = document.getElementById('filtroDesde');
    const filtroHasta = document.getElementById('filtroHasta');
    const filtroEstado = document.getElementById('filtroEstado');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    
    const tbody = document.getElementById('historialTbody');
    const allRows = Array.from(tbody.querySelectorAll('tr'));
    const paginationControls = document.getElementById('paginationControls');

    const infoRowsPerPage = document.getElementById('info-rows-per-page');
    const infoCurrentPage = document.getElementById('info-current-page');
    const infoTotalPages = document.getElementById('info-total-pages');
    let currentPage = 1;
    let rowsPerPage = 5;
    let filteredRows = [...allRows];
    function renderTable() {
        const totalRows = filteredRows.length;
        const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));
        
        if (currentPage < 1) currentPage = 1;
        if (currentPage > totalPages) currentPage = totalPages;
        
        infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
        infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
        infoTotalPages.textContent = totalPages;

        allRows.forEach(row => row.style.display = 'none');
        
        if (totalRows > 0) {
            let start = 0;
            let end = totalRows;

            if (rowsPerPage !== 'all') {
                start = (currentPage - 1) * rowsPerPage;
                end = start + rowsPerPage;
            }

            for (let i = start; i < end && i < totalRows; i++) {
                filteredRows[i].style.display = ''; 
            }
        }
        renderPagination(totalPages);
    }
    function renderPagination(totalPages) {
        if (!paginationControls) return;
        paginationControls.innerHTML = '';

        if (totalPages <= 1) return; 

        const spanInfo = document.createElement('span');
        spanInfo.className = 'page-info';
        spanInfo.textContent = 'Página:';
        paginationControls.appendChild(spanInfo);
        
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left me-1"></i>';
            btnPrev.onclick = () => { currentPage--; renderTable(); };
            paginationControls.appendChild(btnPrev);
        }

        const btnCurrent = document.createElement('button');
        btnCurrent.className = 'pg-btn active';
        btnCurrent.textContent = currentPage;
        paginationControls.appendChild(btnCurrent);
        
        if (currentPage < totalPages) {
            const btnNext = document.createElement('button');
            btnNext.className = 'pg-btn';
            btnNext.innerHTML = '<i class="fas fa-chevron-right ms-1"></i>';
            btnNext.onclick = () => { currentPage++; renderTable(); };
            paginationControls.appendChild(btnNext);
        }
    }
    function applyFilters() {
        const term = searchInput.value.toLowerCase().trim();
        const fDesde = filtroDesde.value; 
        const fHasta = filtroHasta.value;
        const fEstado = filtroEstado.value;

        filteredRows = allRows.filter(row => {
            const cells = row.querySelectorAll('td');
            const txtSearch = (cells[1].textContent + " " + cells[2].textContent).toLowerCase();
            const txtEstado = cells[5].textContent.trim(); 
const rawFecha = cells[6].textContent.trim();

            if (term && !txtSearch.includes(term)) return false;
            if (fEstado !== 'all' && txtEstado !== fEstado) return false;
            if (fDesde && rawFecha < fDesde) return false;
            if (fHasta && rawFecha > fHasta) return false;

            return true;
        });

        currentPage = 1;
        renderTable();
    }
    if(searchInput) searchInput.addEventListener('input', applyFilters);
    if(filtroDesde) filtroDesde.addEventListener('change', applyFilters);
    if(filtroHasta) filtroHasta.addEventListener('change', applyFilters);
    if(filtroEstado) filtroEstado.addEventListener('change', applyFilters);

    if(rowsPerPageSelect) {
        rowsPerPageSelect.addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });
    }
    renderTable();
});
</script>

<?php include('vista/vendedor/footer_repartidor.php'); ?>