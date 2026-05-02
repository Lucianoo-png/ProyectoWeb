<?php include('vista/cuentausuario/header_usuario.php'); ?>
<?php if ($mostrarCategorias): ?>

<div class="bg-white border-bottom shadow-sm sticky-top" style="overflow:visible; z-index:1020">
    <div class="container">
        <ul class="nav nav-categories justify-content-center">

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'blanca' ? 'active' : '' ?>"
                   href="/proyectoweb/linea-blanca">Línea Blanca</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'marron' ? 'active' : '' ?>"
                   href="/proyectoweb/linea-marron">Línea Marrón</a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= $categoriaActiva === 'cocina' ? 'active' : '' ?>"
                   href="/proyectoweb/cocina">Cocina</a>
            </li>

            <li class="nav-item dropdown mega-dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center gap-1"
                   href="#" id="megaDropdown" role="button"
                   data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-th-large me-1 small"></i> Categorías Específicas
                </a>
                <div class="dropdown-menu mega-menu" aria-labelledby="megaDropdown">
                    <div class="row g-3">
                        <div class="col-6 category-col">
                            <h6>Lavado</h6>
                            <a class="dropdown-item" href="/proyectoweb/lavadoras">
                                <i class="fas fa-tshirt"></i> Lavadoras
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/secadoras">
                                <i class="fas fa-wind"></i> Secadoras
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/lavasecadoras">
                                <i class="fas fa-sync-alt"></i> Lavasecadoras
                            </a>
                            <h6 class="mt-3">Refrigeración</h6>
                            <a class="dropdown-item" href="/proyectoweb/refrigeradores">
                                <i class="fas fa-snowflake"></i> Refrigeradores
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/congeladores">
                                <i class="fas fa-cube"></i> Congeladores
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/frigobar">
                                <i class="fas fa-wine-bottle"></i> Frigobar / Cava de Vinos
                            </a>
                        </div>
                        <div class="col-6 category-col">
                            <h6>Cocina</h6>
                            <a class="dropdown-item" href="/proyectoweb/hornos">
                                <i class="fas fa-fire"></i> Hornos
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/estufas">
                                <i class="fas fa-burn"></i> Estufas
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/microondas">
                                <i class="fas fa-blender"></i> Microondas
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/lavavajillas">
                                <i class="fas fa-utensils"></i> Lavavajillas
                            </a>
                            <h6 class="mt-3">Bienestar</h6>
                            <a class="dropdown-item" href="/proyectoweb/cuidado-hogar">
                                <i class="fas fa-home"></i> Cuidado del Hogar
                            </a>
                            <a class="dropdown-item" href="/proyectoweb/cuidado-personal">
                                <i class="fas fa-spa"></i> Cuidado Personal
                            </a>
                        </div>
                    </div>
                </div>
            </li>

        </ul>
    </div>
</div>
<?php endif; ?>

<div class="cuenta-layout">

    <aside class="cuenta-sidebar">
        <div class="cuenta-sidebar-header">
            <div class="cuenta-avatar"><?php 
            $arr = explode(" ",($info[0]['nombre']." ".$info[0]['apellidospama']));
            echo mb_substr($arr[0],0,1).mb_substr($arr[1],0,1); ?></div>
            <p class="cuenta-sidebar-name"><?php echo $info[0]['nombre']." ".$info[0]['apellidospama']; ?></p>
            <p class="cuenta-sidebar-email"><i class="fas fa-envelope me-1"></i><?php echo $info[0]['correo']; ?>
        </div>
        <nav class="cuenta-nav">
            <button class="cuenta-nav-link <?php echo (!(isset($_POST['guardar_direccion']) || isset($_POST['eliminar_direccion'])) ? 'active' : ''); ?>" onclick="switchPanel('panel-datos',this)">
                <i class="fas fa-user-edit"></i> Mis Datos
            </button>
            <button class="cuenta-nav-link <?php echo ((isset($_POST['guardar_direccion']) || isset($_POST['eliminar_direccion'])) ? 'active' : ''); ?>" onclick="switchPanel('panel-direcciones',this)">
                <i class="fas fa-map-marker-alt"></i> Mis Direcciones
            </button>
            <hr class="cuenta-nav-divider">
            <button class="cuenta-nav-link" onclick="switchPanel('panel-pedidos',this)">
                <i class="fas fa-box-open"></i> Mis Pedidos
            </button>
            <button class="cuenta-nav-link" onclick="switchPanel('panel-solicitudes',this)">
                <i class="fas fa-headset"></i> Mis Solicitudes
            </button>
            <hr class="cuenta-nav-divider">
            <a href="/proyectoweb/mi-perfil/logout" class="cuenta-nav-link" style="color:#dc3545">
                <i class="fas fa-sign-out-alt" style="color:#dc3545"></i> Cerrar Sesión
            </a>
        </nav>
    </aside>

    <main>

        <!-- PANEL DATOS -->
        <div class="cuenta-panel <?php echo (!(isset($_POST['guardar_direccion']) || isset($_POST['eliminar_direccion'])) ? 'active' : ''); ?>" id="panel-datos">
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-id-card"></i> Información Personal</span>
                    <button class="btn-cuenta-edit" onclick="toggleEditDatos()">
                        <i class="fas fa-pencil-alt"></i> Editar
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <div id="vistaData">
                        <?php if(isset($_POST["actualizar_datos"]) || isset($_POST["actualizar_contra"]) || isset($_POST["guardar_direccion"])){ if(count($msj)>0){?><div class="alerta alerta-<?php echo $msj[0]; ?>"><?php echo $msj[1]; ?></div><?php } } //error, exito, info ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Nombre completo</div>
                                    <div class="perfil-valor" id="vNombre"><?php echo $info[0]['nombre']." ".$info[0]["apellidospama"]; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Teléfono</div>
                                    <div class="perfil-valor" id="vTel"><?php echo $info[0]['telefono']; ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Correo electrónico</div>
                                   <p class="perfil-valor"><?php echo $info[0]['correo']; ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="perfil-campo">
                                    <div class="perfil-label">Tipo de cliente</div>
                                    <div class="perfil-valor" id="vFecha">Cliente online</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="formData" style="display:none">
                        <form action="/proyectoweb/mi-perfil/inicio" method="POST">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nombre(s)*</label>
                                <input type="text" id="eNombre" class="form-control" name="nombre" value="<?php echo $info[0]['nombre']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Apellido(s)*</label>
                                <input type="text" id="eNombre" class="form-control" name="apellidos" value="<?php echo $info[0]['apellidospama']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Teléfono</label>
                                <input type="tel" id="eTel" class="form-control" name="telefono" value="<?php echo $info[0]['telefono']; ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Correo electrónico</label>
                                <input type="email" id="eEmail" class="form-control" name="correo" value="<?php echo $info[0]['correo']; ?>">
                            </div>
                        </div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" name="actualizar_datos" class="btn-cuenta-save" onclick="guardarDatos()">
                                <i class="fas fa-save me-1"></i> Guardar cambios
                            </button>
                            <button class="btn-cuenta-cancel" onclick="cancelarEditDatos()">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>

            <form action="/proyectoweb/mi-perfil/inicio" method="POST">
                <div class="cuenta-card">
                    <div class="cuenta-card-header">
                        <span><i class="fas fa-lock"></i> Cambiar Contraseña</span>
                    </div>
                    <div class="cuenta-card-body">
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
                        <div class="mt-3">
                            <button type="submit" id="btnRegistrar" name="actualizar_contra" class="btn-cuenta-save">
                                <i class="fas fa-key me-1"></i> Actualizar contraseña
                            </button>
                        </div>
                    </div>
                </div>
            </form>    
        </div><!-- /panel-datos -->


        <!-- PANEL DIRECCIONES -->
        <div class="cuenta-panel <?php echo ((isset($_POST['guardar_direccion']) || isset($_POST['eliminar_direccion'])) ? 'active' : ''); ?>" id="panel-direcciones">
            <div class="cuenta-card">
                <div class="cuenta-card-header">
                    <span><i class="fas fa-map-marker-alt"></i> Mis Direcciones</span>
                    <button class="btn-dir-add" onclick="toggleFormDir()">
                        <i class="fas fa-plus"></i> Nueva dirección
                    </button>
                </div>
                <div class="cuenta-card-body">
                    <?php if(isset($_POST["guardar_direccion"]) || isset($_POST["eliminar_direccion"])){ if(count($msj)>0){ ?>
                        <div class="alerta alerta-<?php echo $msj[0]; ?> mb-3"><?php echo $msj[1]; ?></div>
                    <?php } } ?>
                    <div id="listaDirecciones">
                        <?php foreach($direcciones as $dir){ ?>
                        <div class="dir-item">
                            <div class="dir-item-detail">
                                <?php echo $dir['calle_numero']; ?>, <?php echo $dir['colonia']; ?><br>
                                <?php echo $dir['ciudad']; ?>, <?php echo $dir['estado']; ?>. <?php echo $dir['cp']; ?> · <?php echo $dir['pais']; ?>
                            </div>
                            <div class="dir-item-actions">
                                <button class="btn-dir-sec" onclick="editarDireccion(<?php echo intval($dir['no_dirección']); ?>)">
                                    <i class="fas fa-edit me-1"></i>Editar
                                </button>
                                <form action="/proyectoweb/mi-perfil/inicio" method="POST">
                                    <input type="hidden" name="no_direccion" value="<?php echo intval($dir['no_dirección']); ?>">
                                    <button type="submit" name="eliminar_direccion" class="btn-dir-sec" style="color:#dc3545;border-color:#f5c2c2">
                                        <i class="fas fa-trash me-1"></i>Eliminar
                                    </button>
                                </form>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div id="formDirWrapper" style="display:none">
                        <form action="/proyectoweb/mi-perfil/inicio" method="POST">
                        <hr>
                        <input type="hidden" name="no_direccion" id="updateDirId" value="">
                        <h6 id="formDirTitle" style="color:var(--azul-marino);font-weight:700;margin-bottom:.75rem">
                            <i class="fas fa-plus-circle me-2"></i>Nueva dirección
                        </h6>
                        <div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold small">Calle y número *</label>
        <input type="text" id="dCalle" name="calle_numero" class="form-control" placeholder="Ej: Av. Independencia 120">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold small">Estado *</label>
        <select id="dEstado" name="estado" class="form-select">
            <option value="" selected disabled>Selecciona un estado...</option>
<option value="Aguascalientes">Aguascalientes</option>
<option value="Baja California">Baja California</option>
<option value="Baja California Sur">Baja California Sur</option>
<option value="Campeche">Campeche</option>
<option value="Chiapas">Chiapas</option>
<option value="Chihuahua">Chihuahua</option>
<option value="Ciudad de México">Ciudad de México</option>
<option value="Coahuila">Coahuila</option>
<option value="Colima">Colima</option>
<option value="Durango">Durango</option>
<option value="Estado de México">Estado de México</option>
<option value="Guanajuato">Guanajuato</option>
<option value="Guerrero">Guerrero</option>
<option value="Hidalgo">Hidalgo</option>
<option value="Jalisco">Jalisco</option>
<option value="Michoacán">Michoacán</option>
<option value="Morelos">Morelos</option>
<option value="Nayarit">Nayarit</option>
<option value="Nuevo León">Nuevo León</option>
<option value="Oaxaca">Oaxaca</option>
<option value="Puebla">Puebla</option>
<option value="Querétaro">Querétaro</option>
<option value="Quintana Roo">Quintana Roo</option>
<option value="San Luis Potosí">San Luis Potosí</option>
<option value="Sinaloa">Sinaloa</option>
<option value="Sonora">Sonora</option>
<option value="Tabasco">Tabasco</option>
<option value="Tamaulipas">Tamaulipas</option>
<option value="Tlaxcala">Tlaxcala</option>
<option value="Veracruz">Veracruz</option>
<option value="Yucatán">Yucatán</option>
<option value="Zacatecas">Zacatecas</option>
            </select>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold small">Ciudad *</label>
        <select id="dCiudad" name="ciudad" class="form-select" disabled>
            <option value="" selected disabled>Primero selecciona un estado</option>
        </select>
    </div>
    <div class="col-md-5">
        <label class="form-label fw-semibold small">Colonia *</label>
        <input type="text" id="dColonia" name="colonia" placeholder="Costa de Oro" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold small">C.P. *</label>
        <input type="text" id="dCP" name="cp" class="form-control" placeholder="91809" maxlength="5">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold small">País *</label>
        <input type="text" id="dPais" name="pais" class="form-control" value="México" readonly>
    </div>
</div>
                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" name="guardar_direccion" class="btn-cuenta-save">
                                <i class="fas fa-save me-1"></i> Guardar dirección
                            </button>
                            <button type="button" class="btn-cuenta-cancel" onclick="cancelarDir()">Cancelar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /panel-direcciones -->


        <!-- PANEL PEDIDOS -->
         <?php 
// 1. Agrupar los productos por pedido (para evitar el error de variable indefinida)
$pedidosAgrupados = [];
if (isset($pedidosRaw) && is_array($pedidosRaw)) {
    foreach($pedidosRaw as $f) {
        $ref = $f['no_referencia'];
        if(!isset($pedidosAgrupados[$ref])) {
            $pedidosAgrupados[$ref] = [
                'no_referencia' => $f['no_referencia'],
                'fechayhora'    => $f['fechayhora'],
                'total_pedido'  => $f['total_pedido'],
                'estado_envio'  => $f['estado_envio'],
                'items'         => []
            ];
        }
        $pedidosAgrupados[$ref]['items'][] = $f;
    }
}

// 2. Contadores para los Badges
$countP = 0; $countR = 0; $countE = 0;
foreach($pedidosAgrupados as $p) {
    $est = trim($p['estado_envio']);
    if($est == 'P') $countP++;
    if($est == 'R') $countR++;
    if($est == 'E') $countE++;
}
?>
        <div class="cuenta-panel" id="panel-pedidos">
    <?php 
        $countP = 0; $countR = 0; $countE = 0;
        foreach($pedidosAgrupados as $p) {
            $est = trim($p['estado_envio']);
            if($est == 'P') $countP++;
            if($est == 'R') $countR++;
            if($est == 'E') $countE++;
        }
    ?>
    <div class="pedido-tabs">
        <button class="pedido-tab-btn active" onclick="filtrarPedidos('P', this)">
            <i class="fas fa-cog"></i> En Preparación <span class="tab-badge"><?php echo $countP; ?></span>
        </button>
        <button class="pedido-tab-btn" onclick="filtrarPedidos('R', this)">
            <i class="fas fa-truck"></i> En Ruta <span class="tab-badge"><?php echo $countR; ?></span>
        </button>
        <button class="pedido-tab-btn" onclick="filtrarPedidos('E', this)">
            <i class="fas fa-check-double"></i> Entregados <span class="tab-badge"><?php echo $countE; ?></span>
        </button>
    </div>

    <div id="contenedor-pedidos">
        <?php foreach($pedidosAgrupados as $p): 
            $estado = trim($p['estado_envio']);
        ?>
            <div class="pedido-card item-pedido" data-estado="<?php echo $estado; ?>" style="display: none;">
                <div class="pedido-card-header" <?php echo ($estado == 'E') ? 'style="background:#065f46"' : ''; ?>>
                    <div>
                        <div class="pedido-num">Pedido <strong>#<?php echo str_pad($p['no_referencia'], 4, "0", STR_PAD_LEFT); ?></strong></div>
                        <div class="pedido-fecha">Realizado el <?php echo date("d/m/Y", strtotime($p['fechayhora'])); ?></div>
                    </div>
                    <div class="pedido-total">
                        <?php if($estado == 'E'): ?>
                            <span style="background:rgba(255,255,255,.2); padding:2px 8px; border-radius:10px; font-size:0.7rem; margin-right:10px;">
                                <i class="fas fa-check-circle"></i> Entregado
                            </span>
                        <?php endif; ?>
                        $<?php echo number_format($p['total_pedido'], 2); ?>
                    </div>
                </div>
                
                <div class="pedido-body">
                    <?php foreach($p['items'] as $item): ?>
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="/proyectoweb/public/uploads/img/<?php echo $item['imagen']; ?>" onerror="this.src='https://placehold.co/56x56?text=Prod'">
                            </div>
                            <div class="flex-grow-1">
                                <div class="pedido-item-name"><?php echo $item['nombre']; ?></div>
                                <div class="pedido-item-sku">SKU: <?php echo Helpers::crearSKU($item['categoria'], $item['nombre']); ?> · Cant: <?php echo $item['cantidad']; ?></div>
                            </div>
                            <div class="pedido-item-price">$<?php echo number_format($item['precio_venta'] * $item['cantidad'], 2); ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="pedido-tracking">
                    <div class="tracking-steps">
                        <?php 
                            // P=1 (Recibido automático + Preparación), R=2 (Ruta), E=3 (Entregado)
                            $n = ($estado == 'P') ? 1 : (($estado == 'R') ? 2 : 3);
                        ?>
                        <div class="tracking-step done">
                            <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                            <div class="tracking-step-label">Pedido recibido</div>
                        </div>

                        <div class="tracking-line done"></div>

                        <div class="tracking-step <?php echo ($n == 1) ? 'current' : 'done'; ?>">
                            <div class="tracking-step-circle"><i class="fas fa-box"></i></div>
                            <div class="tracking-step-label">En preparación</div>
                        </div>

                        <div class="tracking-line <?php echo ($n >= 2) ? 'done' : ''; ?>"></div>

                        <div class="tracking-step <?php echo ($n == 2) ? 'current' : (($n > 2) ? 'done' : ''); ?>">
                            <div class="tracking-step-circle"><i class="fas fa-truck"></i></div>
                            <div class="tracking-step-label">Salió a ruta</div>
                        </div>

                        <div class="tracking-line <?php echo ($n >= 3) ? 'done' : ''; ?>"></div>

                        <div class="tracking-step <?php echo ($n == 3) ? 'current done' : ''; ?>">
                            <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                            <div class="tracking-step-label">Entregado</div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<div id="contenedor-pedidos">
   </div>
<div id="paginacion-controles" class="text-center py-4"></div>
</div>


        <!-- PANEL SOLICITUDES -->
        <div class="cuenta-panel" id="panel-solicitudes">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 style="color:var(--azul-marino);font-weight:700;margin:0">Mis Solicitudes</h5>
                    <p style="font-size:.8rem;color:#6c757d;margin:0">
                        Envía y consulta tus solicitudes de garantía o devolución.
                    </p>
                </div>
            </div>
            <!-- Historial -->

            <div id="listaSolicitudes">

                <div class="cuenta-card mb-3">
                    <div class="cuenta-card-header" style="background:#065f46">
                        <span><i class="fas fa-check-double me-1"></i> LC-SOL-230050 — Devolución</span>
                        <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.72rem;padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                            Resuelto
                        </span>
                    </div>
                    <div class="cuenta-card-body">
                        <div class="row g-2 mb-2">
                            <div class="col-md-4">
                                <div class="perfil-label">Fecha</div>
                                <div class="perfil-valor" style="font-size:.84rem">10/03/2026 11:20</div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-label">Producto</div>
                                <div class="perfil-valor" style="font-size:.84rem">WM3911D — Microondas AirFry</div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-label">Asunto</div>
                                <div class="perfil-valor" style="font-size:.84rem">Cambio por unidad defectuosa</div>
                            </div>
                        </div>
                        <div class="p-2 rounded" style="background:#f0fdf4;border-left:3px solid #065f46;font-size:.8rem;color:#333">
                            <strong style="color:#065f46"><i class="fas fa-comment-dots me-1"></i> Respuesta del vendedor:</strong><br>
                            Se realizó el cambio de la unidad por una nueva. El cliente confirmó recibir el producto en buen estado.
                        </div>
                    </div>
                </div>

                <div class="cuenta-card mb-3">
                    <div class="cuenta-card-header">
                        <span><i class="fas fa-clock me-1"></i> LC-SOL-240001 — Garantía</span>
                        <span style="background:rgba(255,255,255,.15);color:#fff;font-size:.72rem;padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                            Pendiente
                        </span>
                    </div>
                    <div class="cuenta-card-body">
                        <div class="row g-2 mb-2">
                            <div class="col-md-4">
                                <div class="perfil-label">Fecha</div>
                                <div class="perfil-valor" style="font-size:.84rem">21/03/2026 09:15</div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-label">Producto</div>
                                <div class="perfil-valor" style="font-size:.84rem">8MWTW2024WJM — Lavadora 20kg</div>
                            </div>
                            <div class="col-md-4">
                                <div class="perfil-label">Asunto</div>
                                <div class="perfil-valor" style="font-size:.84rem">Lavadora no enciende tras instalación</div>
                            </div>
                        </div>
                        <div class="p-2 rounded" style="background:#f8fafc;border-left:3px solid #d0dae8;font-size:.8rem;color:#888">
                            <i class="fas fa-hourglass-half me-1"></i> En espera de atención por parte del vendedor.
                        </div>
                    </div>
                </div>

                        </div><!-- /listaSolicitudes -->

                        <div class="row g-4">

            <!-- ══ Columna principal: formulario ══ -->
            <div class="col-lg-8">

                <h1 class="sol-page-title">
                    <i class="fas fa-plus-circle me-2" style="color:var(--btn-color)"></i>
                    Nueva Solicitud
                </h1>
                <p class="sol-page-sub">
                    Completa los campos para registrar tu solicitud de garantía o devolución.
                </p>

                <div class="cuenta-card">
                    <div class="cuenta-card-body">

                        <p class="sol-required-note">
                            Los campos marcados con <span>*</span> son obligatorios.
                        </p>

                        <!-- ── Sección 1: Datos generales (CreaSolicitud) ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-file-alt me-1"></i> Datos de la solicitud
                        </p>

                        <div class="row g-3">

                            <!-- Tipo — DetalleSolicitud.Tipo -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="solTipo">
                                    Tipo de solicitud <span class="text-danger">*</span>
                                </label>
                                <select class="form-select" id="solTipo"
                                        onchange="actualizarResumen()">
                                    <option value="">— Seleccionar tipo —</option>
                                    <option value="Garantía">Garantía</option>
                                    <option value="Devolución">Devolución</option>
                                </select>
                                <div class="invalid-feedback">Selecciona el tipo de solicitud.</div>
                            </div>

                            <!-- No. Referencia — CreaSolicitud.NoReferencia -->
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small" for="solNoReferencia">
                                    No. de referencia de compra <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="solNoReferencia"
                                       placeholder="Ej: LC-2026-0041"
                                       oninput="actualizarResumen()">
                                <div class="form-text">Número de orden asociado al producto.</div>
                                <div class="invalid-feedback">Ingresa el número de referencia.</div>
                            </div>

                        </div><!-- /row datos generales -->

                        <!-- ── Sección 2: Detalle (DetalleSolicitud) ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-clipboard-list me-1"></i> Detalle del problema
                        </p>

                        <div class="row g-3">

                            <!-- Asunto — DetalleSolicitud.Asunto -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small" for="solAsunto">
                                    Asunto <span class="text-danger">*</span>
                                </label>
                                <input type="text" class="form-control" id="solAsunto"
                                       maxlength="120"
                                       placeholder="Resumen breve del problema…"
                                       oninput="actualizarResumen(); contarCaracteres(this,'solAsuntoCount',120)">
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="invalid-feedback">El asunto es obligatorio.</div>
                                    <small class="text-muted ms-auto" style="font-size:.7rem">
                                        <span id="solAsuntoCount">0</span>/120
                                    </small>
                                </div>
                            </div>

                            <!-- Descripción — DetalleSolicitud.Descripcion -->
                            <div class="col-12">
                                <label class="form-label fw-semibold small" for="solDescripcion">
                                    Descripción <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="solDescripcion"
                                          rows="5" style="resize:vertical" maxlength="1000"
                                          placeholder="Describe el problema con detalle: cuándo ocurrió, qué síntomas presenta, si ya intentaste alguna solución, etc."
                                          oninput="contarCaracteres(this,'solDescCount',1000)"></textarea>
                                <div class="d-flex justify-content-between mt-1">
                                    <div class="invalid-feedback">La descripción es obligatoria.</div>
                                    <small class="text-muted ms-auto" style="font-size:.7rem">
                                        <span id="solDescCount">0</span>/1000
                                    </small>
                                </div>
                            </div>

                        </div><!-- /row detalle -->

                        <!-- ── Sección 3: Evidencia — DetalleSolicitud.Evidencia ── -->
                        <p class="sol-section-title">
                            <i class="fas fa-paperclip me-1"></i> Evidencia
                        </p>

                        <!-- Zona de arrastre -->
                        <div class="sol-dropzone" id="solDropzone">
                            <input type="file" id="solEvidencia"
                                   accept="image/*,.pdf"
                                   onchange="manejarEvidencia(this)">
                            <i class="fas fa-cloud-upload-alt sol-dropzone-icon"></i>
                            <div class="sol-dropzone-label">
                                <strong>Haz clic</strong> o arrastra tu archivo aquí
                            </div>
                            <p class="sol-dropzone-hint">
                                Imagen (JPG, PNG) o PDF · Máx. 5 MB ·
                                Requerida si la falla es física o visible
                            </p>
                        </div>

                        <!-- Preview del archivo seleccionado -->
                        <div class="sol-file-preview" id="solFilePreview">
                            <i id="solFileIcon" class="fas fa-file-image sol-file-img"></i>
                            <span id="solFileName"></span>
                            <span id="solFileSize" class="text-muted" style="font-size:.75rem"></span>
                            <button class="sol-file-remove" type="button" onclick="quitarEvidencia()">
                                <i class="fas fa-times-circle"></i> Quitar
                            </button>
                        </div>

                        <!-- Acciones -->
                        <div class="sol-actions">
                            <button class="btn-sol-enviar" id="btnEnviar" type="submit">
                                <i class="fas fa-paper-plane"></i> Enviar solicitud
                            </button>
                            <a href="/proyectoweb/mi-perfil/inicio" class="btn-sol-cancelar">
                                Cancelar
                            </a>
                        </div>

                    </div><!-- /cuenta-card-body -->
                </div><!-- /cuenta-card -->

            </div><!-- /col formulario -->

            <!-- ══ Columna lateral: resumen ══ -->
            <div class="col-lg-4">
                <!-- Tarjeta de ayuda -->
                <div class="cuenta-card mt-3">
                    <div class="cuenta-card-body sol-help-card">
                        <p class="sol-help-title">
                            <i class="fas fa-shield-alt"></i> ¿Cuándo usar cada tipo?
                        </p>
                        <p class="mb-2">
                            <strong>Garantía:</strong> cuando el producto presenta fallas de
                            funcionamiento dentro del período de garantía del fabricante.
                        </p>
                        <p class="mb-0">
                            <strong>Devolución:</strong> cuando deseas regresar el producto
                            por daño involuntario, error en el pedido o insatisfacción.
                        </p>
                    </div>
                </div>

            </div><!-- /col resumen -->

        </div><!-- /row -->
        </div><!-- /panel-solicitudes -->

    </main>
</div><!-- /cuenta-layout -->
<script>
    let pedFiltro = 'P';
    let pedPagina = 1;
    const pedPorPag = 3;

    function filtrarPedidos(estado, btn) {
        // UI Tabs
        document.querySelectorAll('.pedido-tab-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        pedFiltro = estado;
        pedPagina = 1;
        aplicarLogicaVista();
    }

    function aplicarLogicaVista() {
    const contenedor = document.getElementById('contenedor-pedidos');
    const todos = document.querySelectorAll('.item-pedido');
    
    // Filtramos
    const filtrados = Array.from(todos).filter(el => el.dataset.estado.trim() === pedFiltro);
    
    // Ocultar todos
    todos.forEach(el => el.style.display = 'none');

    // SI NO HAY PEDIDOS EN ESTA PESTAÑA:
    // Eliminamos cualquier mensaje previo y ponemos el nuevo
    const mensajeVacio = document.getElementById('mensaje-vacio-pedidos');
    if (mensajeVacio) mensajeVacio.remove();

    if (filtrados.length === 0) {
        const divVacio = document.createElement('div');
        divVacio.id = 'mensaje-vacio-pedidos';
        divVacio.style.cssText = 'text-align:center; width:100%; padding:3rem 1rem; display:flex; flex-direction:column; align-items:center; justify-content:center; gap:.75rem;';
        divVacio.innerHTML = `
            <i class="fas fa-box-open" style="font-size:3rem; color:#cbd5e0;"></i>
            <p style="color:#718096; font-weight:500; margin:0;">No tienes pedidos en esta categoría todavía.</p>
            <a href="/proyectoweb/?" class="btn btn-sm btn-outline-primary" style="border-radius:20px;">Ir a la tienda</a>
        `;
        contenedor.appendChild(divVacio);
        renderizarControles(0);
        return;
    }

    // Si hay pedidos, aplicar paginación
    const inicio = (pedPagina - 1) * pedPorPag;
    const fin = inicio + pedPorPag;
    
    filtrados.forEach((el, index) => {
        if (index >= inicio && index < fin) {
            el.style.display = 'block';
        }
    });

    renderizarControles(filtrados.length);
}

function renderizarControles(total) {
    const numPags = Math.ceil(total / pedPorPag);
    const cont = document.getElementById('paginacion-controles');
    if(!cont) return;
    
    cont.innerHTML = '';

    // Si solo hay una página o ninguna, no mostramos botones
    if (numPags <= 1) return;

    for (let i = 1; i <= numPags; i++) {
        const btn = document.createElement('button');
        btn.innerText = i;
        btn.className = (i === pedPagina) ? 'btn btn-sm btn-primary mx-1' : 'btn btn-sm btn-outline-primary mx-1';
        btn.style.borderRadius = "8px";
        btn.style.minWidth = "35px";
        
        btn.onclick = () => {
            pedPagina = i;
            aplicarLogicaVista();
            document.getElementById('panel-pedidos').scrollIntoView({behavior: 'smooth'});
        };
        cont.appendChild(btn);
    }
}
    // Iniciar al cargar el DOM
    document.addEventListener('DOMContentLoaded', () => aplicarLogicaVista());
</script>