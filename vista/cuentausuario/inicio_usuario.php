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
                                    <div class="perfil-label">Nombre completo*</div>
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
        <div class="cuenta-panel" id="panel-pedidos">
            <div class="mb-3">
                <h5 style="color:var(--azul-marino);font-weight:700;margin:0">Mis Pedidos</h5>
                <p style="font-size:.8rem;color:#6c757d;margin:0">Consulta y da seguimiento a tus compras.</p>
            </div>

            <div class="pedido-tabs">
                <button class="pedido-tab-btn active" id="btn-tab-proceso" onclick="switchPedidoTab('tab-proceso',this)">
                    <i class="fas fa-cog"></i> En Proceso <span class="tab-badge ms-1">1</span>
                </button>
                <button class="pedido-tab-btn" id="btn-tab-envio" onclick="switchPedidoTab('tab-envio',this)">
                    <i class="fas fa-truck"></i> En Envío <span class="tab-badge ms-1">1</span>
                </button>
                <button class="pedido-tab-btn" id="btn-tab-historial" onclick="switchPedidoTab('tab-historial',this)">
                    <i class="fas fa-history"></i> Historial <span class="tab-badge ms-1">3</span>
                </button>
            </div>

            <!-- En Proceso -->
            <div class="pedido-tab-panel active" id="tab-proceso">
                <div class="pedido-card">
                    <div class="pedido-card-header">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0041</strong></div>
                            <div class="pedido-fecha">Realizado el 20 de marzo de 2026</div>
                        </div>
                        <div class="pedido-total">Total: $9,999.00</div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="../../multimedia/Imagenes/productos/lavadora-8mwtw2024wjm.jpg"
                                     onerror="this.src='https://placehold.co/56x56/e8f4fb/002366?text=Prod'" alt="Lavadora">
                            </div>
                            <div>
                                <div class="pedido-item-name">Lavadora 20kg Carga Superior Xpert System</div>
                                <div class="pedido-item-sku">SKU: 8MWTW2024WJM · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$9,999.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title"><i class="fas fa-map-marker-alt me-1"></i> Estado del pedido</div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">20 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step current">
                                <div class="tracking-step-circle"><i class="fas fa-box"></i></div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">Hoy</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle"><i class="fas fa-truck"></i></div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /tab-proceso -->

            <!-- En Envío -->
            <div class="pedido-tab-panel" id="tab-envio">
                <div class="pedido-card">
                    <div class="pedido-card-header">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0038</strong></div>
                            <div class="pedido-fecha">Realizado el 17 de marzo de 2026</div>
                        </div>
                        <div class="pedido-total">Total: $4,599.00</div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="https://placehold.co/56x56/e8f4fb/002366?text=WM" alt="Microondas">
                            </div>
                            <div>
                                <div class="pedido-item-name">Microondas AirFry 4 en 1 (1CuFt)</div>
                                <div class="pedido-item-sku">SKU: WM3911D · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$4,599.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title"><i class="fas fa-map-marker-alt me-1"></i> Estado del pedido</div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">17 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">18 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step current">
                                <div class="tracking-step-circle"><i class="fas fa-truck"></i></div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">Hoy</div>
                            </div>
                            <div class="tracking-line"></div>
                            <div class="tracking-step">
                                <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">—</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /tab-envio -->

            <!-- Historial -->
            <div class="pedido-tab-panel" id="tab-historial">

                <!-- Alerta de referencia buscada (se muestra solo si viene de rastrear_pedido) -->
                <div id="refAlert" class="ref-alert">
                    <i class="fas fa-search"></i>
                    <span id="refAlertText"></span>
                </div>

                <!-- Pedido entregado 1 -->
                <div class="pedido-card" id="hist-LC-2026-0035">
                    <div class="pedido-card-header" style="background:#065f46">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0035</strong></div>
                            <div class="pedido-fecha">Realizado el 5 de marzo de 2026</div>
                        </div>
                        <div class="pedido-total" style="display:flex;align-items:center;gap:.5rem">
                            <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.72rem;
                                  padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                                <i class="fas fa-check-circle me-1"></i>Entregado
                            </span>
                            $2,799.00
                        </div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="https://placehold.co/56x56/e8f4fb/002366?text=TV" alt="Televisor">
                            </div>
                            <div>
                                <div class="pedido-item-name">Televisor LED Smart 32" HD</div>
                                <div class="pedido-item-sku">SKU: TV32SMART · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$2,799.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title"><i class="fas fa-map-marker-alt me-1"></i> Estado del pedido</div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">5 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">6 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">8 mar</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">9 mar</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pedido entregado 2 -->
                <div class="pedido-card" id="hist-LC-2026-0021">
                    <div class="pedido-card-header" style="background:#065f46">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2026-0021</strong></div>
                            <div class="pedido-fecha">Realizado el 12 de febrero de 2026</div>
                        </div>
                        <div class="pedido-total" style="display:flex;align-items:center;gap:.5rem">
                            <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.72rem;
                                  padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                                <i class="fas fa-check-circle me-1"></i>Entregado
                            </span>
                            $1,349.00
                        </div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="https://placehold.co/56x56/e8f4fb/002366?text=LIC" alt="Licuadora">
                            </div>
                            <div>
                                <div class="pedido-item-name">Licuadora de Alto Rendimiento 2L</div>
                                <div class="pedido-item-sku">SKU: LIC2L900W · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$1,349.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title"><i class="fas fa-map-marker-alt me-1"></i> Estado del pedido</div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">12 feb</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">13 feb</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">15 feb</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">16 feb</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pedido entregado 3 -->
                <div class="pedido-card" id="hist-LC-2025-0198">
                    <div class="pedido-card-header" style="background:#065f46">
                        <div>
                            <div class="pedido-num">Pedido <strong>#LC-2025-0198</strong></div>
                            <div class="pedido-fecha">Realizado el 3 de diciembre de 2025</div>
                        </div>
                        <div class="pedido-total" style="display:flex;align-items:center;gap:.5rem">
                            <span style="background:rgba(255,255,255,.2);color:#fff;font-size:.72rem;
                                  padding:.2rem .65rem;border-radius:2rem;font-weight:700">
                                <i class="fas fa-check-circle me-1"></i>Entregado
                            </span>
                            $6,499.00
                        </div>
                    </div>
                    <div class="pedido-body">
                        <div class="pedido-item">
                            <div class="pedido-item-img">
                                <img src="https://placehold.co/56x56/e8f4fb/002366?text=REF" alt="Refrigerador">
                            </div>
                            <div>
                                <div class="pedido-item-name">Refrigerador Top Mount 14 pies³</div>
                                <div class="pedido-item-sku">SKU: RT14AXMX · Cant: 1</div>
                            </div>
                            <div class="pedido-item-price">$6,499.00</div>
                        </div>
                    </div>
                    <div class="pedido-tracking">
                        <div class="pedido-tracking-title"><i class="fas fa-map-marker-alt me-1"></i> Estado del pedido</div>
                        <div class="tracking-steps">
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Pedido recibido</div>
                                <div class="tracking-step-date">3 dic</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">En preparación</div>
                                <div class="tracking-step-date">4 dic</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-check"></i></div>
                                <div class="tracking-step-label">Salió a ruta</div>
                                <div class="tracking-step-date">6 dic</div>
                            </div>
                            <div class="tracking-line done"></div>
                            <div class="tracking-step done">
                                <div class="tracking-step-circle"><i class="fas fa-home"></i></div>
                                <div class="tracking-step-label">Entregado</div>
                                <div class="tracking-step-date">7 dic</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /tab-historial -->

        </div><!-- /panel-pedidos -->


        <!-- PANEL SOLICITUDES -->
        <div class="cuenta-panel" id="panel-solicitudes">

            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div>
                    <h5 style="color:var(--azul-marino);font-weight:700;margin:0">Mis Solicitudes</h5>
                    <p style="font-size:.8rem;color:#6c757d;margin:0">
                        Envía y consulta tus solicitudes de garantía o devolución.
                    </p>
                </div>
                <a href="/proyectoweb/mi-perfil/solicitud" class="btn-dir-add">
                    <i class="fas fa-plus"></i> Nueva solicitud
                </a>
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
        </div><!-- /panel-solicitudes -->

    </main>
</div><!-- /cuenta-layout -->

<script>
    const DIRS = <?php echo json_encode($direcciones); ?>;
document.addEventListener('DOMContentLoaded', function() {
    const estadosYCiudades = {
        "Aguascalientes": ["Aguascalientes", "Jesús María", "Calvillo", "Rincón de Romos"],
        "Baja California": ["Tijuana", "Mexicali", "Ensenada", "Playas de Rosarito", "Tecate"],
        "Baja California Sur": ["La Paz", "Los Cabos", "San José del Cabo", "Loreto", "Ciudad Constitución"],
        "Campeche": ["Campeche", "Ciudad del Carmen", "Champotón", "Escárcega"],
        "Chiapas": ["Tuxtla Gutiérrez", "Tapachula", "San Cristóbal de las Casas", "Comitán", "Palenque"],
        "Chihuahua": ["Chihuahua", "Ciudad Juárez", "Delicias", "Cuauhtémoc", "Hidalgo del Parral"],
        "Ciudad de México": ["Álvaro Obregón", "Azcapotzalco", "Benito Juárez", "Coyoacán", "Cuajimalpa", "Cuauhtémoc", "Gustavo A. Madero", "Iztacalco", "Iztapalapa", "Magdalena Contreras", "Miguel Hidalgo", "Milpa Alta", "Tláhuac", "Tlalpan", "Venustiano Carranza", "Xochimilco"],
        "Coahuila": ["Saltillo", "Torreón", "Monclova", "Piedras Negras", "Ciudad Acuña"],
        "Colima": ["Colima", "Manzanillo", "Tecomán", "Villa de Álvarez"],
        "Durango": ["Durango", "Gómez Palacio", "Lerdo", "Santiago Papasquiaro"],
        "Estado de México": ["Toluca", "Ecatepec", "Nezahualcóyotl", "Naucalpan", "Tlalnepantla", "Chimalhuacán", "Cuautitlán Izcalli", "Atizapán", "Metepec"],
        "Guanajuato": ["León", "Irapuato", "Celaya", "Salamanca", "Guanajuato", "San Miguel de Allende"],
        "Guerrero": ["Acapulco", "Chilpancingo", "Iguala", "Zihuatanejo", "Taxco"],
        "Hidalgo": ["Pachuca", "Tulancingo", "Tula de Allende", "Tizayuca", "Mineral de la Reforma"],
        "Jalisco": ["Guadalajara", "Zapopan", "Tlaquepaque", "Tonalá", "Puerto Vallarta", "Tlajomulco de Zúñiga", "Lagos de Moreno"],
        "Michoacán": ["Morelia", "Uruapan", "Zamora", "Lázaro Cárdenas", "Pátzcuaro"],
        "Morelos": ["Cuernavaca", "Jiutepec", "Cuautla", "Temixco", "Yautepec"],
        "Nayarit": ["Tepic", "Bahía de Banderas", "Xalisco", "Compostela"],
        "Nuevo León": ["Monterrey", "Apodaca", "Guadalupe", "San Nicolás de los Garza", "San Pedro Garza García", "Santa Catarina", "General Escobedo"],
        "Oaxaca": ["Oaxaca de Juárez", "Salina Cruz", "San Juan Bautista Tuxtepec", "Juchitán de Zaragoza", "Santa María Huatulco"],
        "Puebla": ["Puebla", "Cholula", "Tehuacán", "Atlixco", "San Martín Texmelucan", "Cuautlancingo"],
        "Querétaro": ["Querétaro", "San Juan del Río", "Corregidora", "El Marqués", "Tequisquiapan"],
        "Quintana Roo": ["Cancún", "Playa del Carmen", "Chetumal", "Cozumel", "Tulum"],
        "San Luis Potosí": ["San Luis Potosí", "Soledad de Graciano Sánchez", "Ciudad Valles", "Matehuala"],
        "Sinaloa": ["Culiacán", "Mazatlán", "Los Mochis", "Guasave", "Navolato"],
        "Sonora": ["Hermosillo", "Ciudad Obregón", "Nogales", "San Luis Río Colorado", "Navojoa", "Guaymas"],
        "Tabasco": ["Villahermosa", "Cárdenas", "Comalcalco", "Macuspana", "Tenosique"],
        "Tamaulipas": ["Reynosa", "Matamoros", "Nuevo Laredo", "Ciudad Victoria", "Tampico", "Ciudad Madero"],
        "Tlaxcala": ["Tlaxcala", "Apizaco", "Huamantla", "Chiautempan", "Zacatelco"],
        "Veracruz": ["Veracruz", "Boca del Río", "Xalapa", "Córdoba", "Orizaba", "Coatzacoalcos", "Minatitlán", "Poza Rica", "Tuxpan"],
        "Yucatán": ["Mérida", "Valladolid", "Tizimín", "Progreso", "Kanasín"],
        "Zacatecas": ["Zacatecas", "Guadalupe", "Fresnillo", "Jerez"]
    };

    const selectEstado = document.getElementById('dEstado');
    const selectCiudad = document.getElementById('dCiudad');

    selectEstado.addEventListener('change', function() {
        const estadoSeleccionado = this.value;
        const ciudades = estadosYCiudades[estadoSeleccionado] || [];
        selectCiudad.innerHTML = '<option value="" selected disabled>Selecciona una ciudad...</option>';
        
        if (ciudades.length > 0) {
            selectCiudad.disabled = false;
            ciudades.forEach(ciudad => {
                const option = document.createElement('option');
                option.value = ciudad;
                option.textContent = ciudad;
                selectCiudad.appendChild(option);
            });
        } else {
            selectCiudad.disabled = true;
        }
    });
});
</script>