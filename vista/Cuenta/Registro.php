<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <?php if(isset($_SESSION["NoCliente"])){ ?>
            <div class="d-flex gap-3">
                <a href="/proyectoweb/rastrear-pedido" class="topbar-link-track">
                    <i class="fas fa-truck me-1"></i> Rastrear Pedido
                </a>
            </div>
            <?php } ?>
    </div>
</div>

    <!-- Main navbar -->
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
                <?php if(isset($_SESSION["NoCliente"])){ ?><a href="/proyectoweb/carrito" class="nav-icon" title="Carrito"><i class="fas fa-shopping-cart"></i></a> <?php } ?>
                <a <?php if(!isset($_SESSION["NoCliente"])){ ?>href="/proyectoweb/login" <?php }else{ ?> href="/proyectoweb/mi-perfil/inicio" <?php } ?> class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
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
                                <a class="dropdown-item" href="/proyectoweb/microondas">
                                    <svg style="width:1em;height:1em;vertical-align:-0.125em;flex-shrink:0"
         xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
        <path d="M20 4H4C2.9 4 2 4.9 2 6v12c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm-1 13H5V7h14v10zm-8-8H7v6h4v-6zm5 4.5c.83 0 1.5-.67 1.5-1.5S16.83 11 16 11s-1.5.67-1.5 1.5.67 1.5 1.5 1.5zm0-4c.55 0 1 .45 1 1s-.45 1-1 1-1-.45-1-1 .45-1 1-1zm0 5c-.55 0-1-.45-1-1s.45-1 1-1 1 .45 1 1-.45 1-1 1z"/>
    </svg> Microondas
                                </a>
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

    <div class="register-wrapper">
        <div class="register-card">
        <form action="/proyectoweb/registro" method="POST">
            
            <div class="register-card-header">
                <h5><i class="fas fa-user-plus me-2"></i>Formulario de registro nuevo cliente</h5>
            </div>

            <div class="register-card-body">
                
                <?php if(!empty($msj) && isset($_POST['registrar'])){ ?>
                    <div class="alerta alerta-<?php echo $msj[0]; ?>"><?php echo $msj[1]; ?></div>
                <?php } ?>

                <p class="section-label">Datos Personales</p>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label" for="nombre">Nombre <span class="text-danger">*</span></label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Tu nombre">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="apellidos">Apellidos <span class="text-danger">*</span></label>
                        <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Tus apellidos">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="correo">Correo <span class="text-danger">*</span></label>
                        <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="telefono">Teléfono <span class="text-danger">*</span></label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="10 dígitos">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="password">Contraseña <span class="text-danger">*</span></label>
                        <div class="pw-wrapper">
                            <input type="password" id="password" name="password" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                            <span class="pw-toggle" onclick="togglePw('password','eye1')">
                                <i class="fas fa-eye" id="eye1"></i>
                            </span>
                        </div>
                        <div id="pw-indicadores" style="margin-top:.5rem"></div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label" for="confirmPassword">Confirmar Contraseña <span class="text-danger">*</span></label>
                        <div class="pw-wrapper">
                            <input type="password" id="confirmPassword" name="confirmPassword" class="form-control pe-5" placeholder="••••••••" autocomplete="new-password">
                            <span class="pw-toggle" onclick="togglePw('confirmPassword','eye2')">
                                <i class="fas fa-eye" id="eye2"></i>
                            </span>
                        </div>
                        <div id="pw-confirm-msg" style="font-size:.75rem;margin-top:.35rem;font-weight:600;min-height:1rem"></div>
                    </div>

                    <div class="row g-3">
    <div class="col-12">
        <label class="form-label fw-semibold small">Calle y número</label>
        <input type="text" id="dCalle" name="calle_numero" class="form-control" placeholder="Ej: Av. Independencia 120">
    </div>
    <div class="col-md-6">
        <label class="form-label fw-semibold small">Estado</label>
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
        <label class="form-label fw-semibold small">Ciudad</label>
        <select id="dCiudad" name="ciudad" class="form-select" disabled>
            <option value="" selected disabled>Primero selecciona un estado</option>
        </select>
    </div>
    <div class="col-md-5">
        <label class="form-label fw-semibold small">Colonia</label>
        <input type="text" id="dColonia" name="colonia" class="form-control">
    </div>
    <div class="col-md-4">
        <label class="form-label fw-semibold small">C.P.</label>
        <input type="text" id="dCP" name="cp" class="form-control" maxlength="5">
    </div>
    <div class="col-md-3">
        <label class="form-label fw-semibold small">País</label>
        <input type="text" id="dPais" name="pais" class="form-control" value="México" readonly>
    </div>
</div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" name="registrar" class="btn-register" id="btnRegistrar">Registrar Cuenta</button>
                </div>

                <p class="login-redirect">
                    ¿Ya tienes cuenta? <a href="/proyectoweb/login">Inicia sesión aquí</a>
                </p>
            </div>
        </form>
        </div>
    </div>
    <?php include('vista/footer_gral.php'); ?>


    <script>
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