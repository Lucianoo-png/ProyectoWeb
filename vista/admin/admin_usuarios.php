<div class="confirm-overlay" id="confirmOverlay">
    <div class="confirm-box">
        <div class="confirm-icon danger"><i class="fas fa-exclamation"></i></div>
        <h5>Eliminar Personal</h5>
        <p id="confirmMsg">¿Estás seguro de que deseas eliminar este registro?</p>
        
        <form action="/proyectoweb/admin/personal" method="POST" style="margin: 0;">
            <input type="hidden" id="delete_rfc" name="rfc">
            
            <div class="confirm-actions mt-3">
                <button type="submit" name="eliminar" class="btn-confirm-yes" id="confirmYes">
                    <i class="fas fa-trash me-1"></i> Sí, eliminar
                </button>
                <button type="button" class="btn-confirm-no" onclick="cerrarModalEliminar()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<div class="confirm-overlay" id="activateOverlay">
    <div class="confirm-box">
        <div class="confirm-icon" style="color: #28a745; background-color: #e8f5e9;"><i class="fas fa-user-check"></i></div>
        <h5>Activar Personal</h5>
        <p id="activateMsg">¿Estás seguro de que deseas reactivar este registro?</p>
        
        <form action="/proyectoweb/admin/personal" method="POST" style="margin: 0;">
            <input type="hidden" id="activate_rfc" name="rfc">
            
            <div class="confirm-actions mt-3">
                <button type="submit" name="activar" class="btn-confirm-yes" id="activateYes" style="background-color: #28a745;">
                    <i class="fas fa-check me-1"></i> Sí, activar
                </button>
                <button type="button" class="btn-confirm-no" onclick="cerrarModalActivar()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </form>
    </div>
</div>
    <div class="confirm-overlay" id="editModal" style="display: none; z-index: 1050;">
    <div class="admin-form-card" style="max-width: 800px; width: 90%; margin: 2rem auto; position: relative; max-height: 90vh; overflow-y: auto;">
        
        
        
        <div class="admin-form-header d-flex justify-content-between align-items-center" style="padding: 15px 20px;">
            <div>
                <i class="fas fa-user-edit me-2"></i> Edición de Usuario
            </div>
            <button type="button" onclick="cerrarModalEdicion()" style="background: none; border: none; font-size: 1.5rem; color: #fff; cursor: pointer; padding: 0; line-height: 1;">
                &times;
            </button>
        </div>
        <div class="admin-form-body">
            <form action="/proyectoweb/admin/personal" method="POST">
                <input type="hidden" id="edit_rfc" name="rfc">

                <div class="form-section-label"><i class="fas fa-id-card"></i> Datos Personales</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="edit_nombre" class="form-label">Nombre(s)<span class="text-danger">*</span></label>
                        <input type="text" id="edit_nombre" name="nombre" class="form-control" placeholder="Ej. Juan Francisco" maxlength="50">
                    </div>
                    <div class="col-md-6">
                        <label for="edit_apellidos" class="form-label">Apellido(s)<span class="text-danger">*</span></label>
                        <input type="text" id="edit_apellidos" name="apellidos" class="form-control" placeholder="Pérez López" maxlength="50">
                    </div>
                    <div class="col-md-6">
                        <label for="edit_correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                        <input type="email" id="edit_correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" maxlength="50">
                    </div>
                    <div class="col-md-6">
                        <label for="edit_telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                        <input type="tel" id="edit_telefono" name="telefono" class="form-control" placeholder="10 dígitos" maxlength="10">
                    </div>
                </div>

                <div class="form-section-label"><i class="fas fa-briefcase"></i> Datos Laborales</div>
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="edit_tipo_usuario" class="form-label">Tipo de Usuario <span class="text-danger">*</span></label>
                        <select id="edit_tipo_usuario" name="tipo_usuario" class="form-select">
                            <option value="" disabled>Selecciona un tipo</option>
                            <option value="A">Administrador</option>
                            <option value="E">Vendedor</option>
                            <option value="P">Proveedor</option>
                            <option value="R">Repartidor</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="edit_empresa" class="form-label">Empresa</label>
                        <input type="text" id="edit_empresa" name="empresa" class="form-control" placeholder="Ej. LuchanosCorp S.A." disabled>
                    </div>
                </div>

                <hr class="admin-form-divider">
                <div class="d-flex justify-content-end gap-3 mt-3">
                    <button type="submit" name="actualizar" class="btn-admin-primary"><i class="fas fa-save"></i> Actualizar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="topbar">
        <div class="container-fluid d-flex justify-content-between px-3">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
            </div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-fluid d-flex align-items-center gap-3 px-3">
            <a href="/proyectoweb/admin/inicio" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
        </div>
    </div>

    <div class="admin-layout">
        <nav class="admin-sidebar">
            <p class="sidebar-title">Menú Admin</p>
            <a href="/proyectoweb/admin/inicio"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="/proyectoweb/admin/personal"  class="nav-link active"><i class="fas fa-users"></i> Personal</a>
            <a href="/proyectoweb/admin/productos" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <a href="/proyectoweb/admin/clientes"  class="nav-link"><i class="fas fa-user-friends"></i> Clientes</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="/proyectoweb/admin/ventas"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="/proyectoweb/admin/compras"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="/proyectoweb/admin/pedidos"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
        <a href="/proyectoweb/admin/asignar-pedidos" class="nav-link"><i class="fas fa-user-plus"></i> Asignar Pedidos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Proveedores</p>
            <a href="/proyectoweb/admin/pedido-proveedor" class="nav-link"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Sistema</p>
            <a href="/proyectoweb/admin/logs" class="nav-link"><i class="fas fa-history"></i> Historial (Logs)</a>
            <hr class="sidebar-divider">
                        <a href="/proyectoweb/?" class="btn-cerrar" style="margin-top:.5rem">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </nav>

        <main class="admin-content">

            <!-- Breadcrumb -->
            <div class="mb-4 text-center">
                <h1 class="page-header-title mb-0">Gestión de Personal</h1>
                <p class="page-header-sub">Registra y consulta el personal del sistema.</p>
            </div>

            <?php 
                $postAction = '';
                if(isset($_POST['guardar'])) $postAction = 'tab-registro-usuario';
                if(isset($_POST['actualizar']) || isset($_POST["eliminar"]) || isset($_POST["activar"])) $postAction = 'tab-consulta-usuario';
            ?>

            <div class="admin-tabs" style="border-bottom: none;">
                <button class="admin-tab-btn"
                        data-tab-group="personal" data-target="tab-registro-usuario">
                    <i class="fas fa-user-plus me-1"></i> Registro
                </button>
                <button class="admin-tab-btn"
                        data-tab-group="personal" data-target="tab-consulta-usuario">
                    <i class="fas fa-search me-1"></i> Consulta
                </button>
            </div>

            <!-- ── PANEL REGISTRO ── -->
            <div class="admin-tab-panel" id="tab-registro-usuario" data-tab-group="personal">
                <div class="admin-form-card">
                    <div class="admin-form-header">
                        <i class="fas fa-user-plus"></i> Formulario de Registro de Nuevo Usuario
                    </div>
                    <div class="admin-form-body">
                    <form action="/proyectoweb/admin/personal" method="POST">
                        <?php if(!empty($msj) && isset($_POST['guardar'])){ ?>
                            <div class="alerta alerta-<?php echo $msj[0]; ?>"><?php echo $msj[1]; ?></div>
                        <?php } // error, exito, info ?>
                        <div class="form-section-label"><i class="fas fa-id-card"></i> Datos Personales</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre(s)<span class="text-danger">*</span></label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Juan Francisco" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="rfc" class="form-label">Apellido(s)<span class="text-danger">*</span></label>
                                <input type="text" id="apellidos" name="apellidos" class="form-control" placeholder="Pérez López" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" maxlength="50">
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="10 dígitos" maxlength="10">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento<span class="text-danger">*</span></label>
                                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control">
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-briefcase"></i> Datos Laborales</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuario <span class="text-danger">*</span></label>
                                <select id="tipo_usuario" name="tipo_usuario" class="form-select">
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                    <option value="A">Administrador</option>
                                    <option value="E">Vendedor</option>
                                    <option value="P">Proveedor</option>
                                    <option value="R">Repartidor</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="empresa" class="form-label">Empresa</label>
                                <input type="text" id="empresa" name="empresa" class="form-control" placeholder="Ej. LuchanosCorp S.A." disabled>
                            </div>
                        </div>


                        <hr class="admin-form-divider">
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <button type="submit" name="guardar" class="btn-admin-primary"><i class="fas fa-save"></i> Guardar Usuario</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /tab registro -->

            <!-- ── PANEL CONSULTA ── -->
            <div class="admin-tab-panel" id="tab-consulta-usuario" data-tab-group="personal">
                <div class="admin-form-card" style="max-width:100%">

                    <!-- Barra de búsqueda -->
                    <div class="admin-form-body pb-0">
                        <div class="admin-search-bar d-flex gap-2">
                            <input type="text" id="searchInput" class="form-control" placeholder="Nombre, correo, tipo, modalidad, estatus..." style="max-width: 85%;">
                            <select id="rowsPerPageSelect" class="form-select w-auto" style="width:100%;">
                                <option value="5" selected>5</option>
                                <option value="10">10</option>
                                <option value="15">15 </option>
                                <option value="20">20</option>
                                <option value="all">Todos</option>
                            </select>
                        </div>
                        <div class="table-page-info">
                            Número de registros por página: <span id="info-rows-per-page">5</span> &nbsp;|&nbsp; 
                            Página: <span id="info-current-page">1</span> de <span id="info-total-pages">3</span>
                        </div>
                    </div>
                    <div class="admin-pagination mt-3" id="paginationControls">
                    </div>
                    <?php if(!empty($msj) && (isset($_POST['actualizar']) || isset($_POST["eliminar"]) || isset($_POST["activar"]))){ ?>
                        <div class="alerta alerta-<?php echo $msj[0]; ?>" style="margin: 0 20px 15px 20px;">
                            <?php echo $msj[1]; ?>
                        </div>
                    <?php } ?>
                    <!-- Tabla -->
                    <div class="admin-form-body pt-0">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>RFC</th>
                                    <th>Nombre Completo</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>
                                    <th>Modalidad</th>
                                    <th>Conexión</th>
                                    <th>Estatus</th>
                                    <th>Editar</th>
                                    <th>Dar de Alta</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $emp = new EmpleadoControlador();
                                $personal = $emp->getEmpleado()->buscar('"Veracruz".empleado',["order"=>"rfc ASC"]);
                                $i = 0;
                                foreach ($personal as $p): ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= $p['rfc'] ?></td>
                                    <td class="td-name"><?= $p['nombre']." ".$p['apellidospama'] ?></td>
                                    <td><?= $p["correo"] ?></td>
                                    <td><?php if($p['tipousuario']=='A'){echo "ADMINISTRADOR";}else if($p['tipousuario']=='E'){echo "VENDEDOR";}else if($p['tipousuario']=='P'){echo "PROVEEDOR";}else{echo "REPARTIDOR";} ?></td>
                                    <td><?php if($p['modalidad']==='I'){echo "INTERNA";}else{echo "EXTERNA";} ?></td>
                                    <td>
                                        <?php if (($p['enlinea'])): ?>
                                            <strong>Activo(a) ahora</strong>
                                        <?php else: ?>
                                            <strong><?php echo "Última conexión: ".Helpers::obtenerTiempoRelativo($p['ultimavez']); ?></strong>
                                        <?php endif; ?>
                                    </td>
                                    <td><span class="badge-<?php if($p['estatus']){echo "activo";}else{echo "inactivo";} ?>"><?php if($p['estatus']){echo "Activo";}else{echo "Baja";} ?><span></td>
                                    <td>
                                        <?php if($p['estatus']){
                                            if($p['enlinea']==false){
                                            ?>
                                        <button class="btn-tbl-edit" title="Editar" 
                                                onclick="abrirModalEdicion('<?= $p['rfc'] ?>', '<?= addslashes($p['nombre']) ?>', '<?= addslashes($p['apellidospama']) ?>', '<?= $p['correo'] ?>', '<?= $p['telefono'] ?? '' ?>', '<?= $p['tipousuario'] ?>', '<?= addslashes($p['empresa'] ?? '') ?>')">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <?php }else{?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span> <?php }}else{?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span><?php } ?>
                                    </td>
                                    <td>
                                        <?php if($_SESSION["RFC"]!=$p['rfc'] && $p['enlinea']==false && !$p['estatus']): ?>
                                            <button type="button" class="btn-tbl-delete" title="Dar de alta"
                                                    onclick="abrirModalActivar('<?= $p['rfc'] ?>', '<?= htmlspecialchars($p['nombre'].' '.$p['apellidospama'], ENT_QUOTES, 'UTF-8') ?>')"
                                                    style="background-color:#16a34a; color:#fff;">
                                                <i class="fas fa-check-circle"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($_SESSION["RFC"]!=$p['rfc'] && $p['enlinea']==false && $p['estatus']): ?>
                                            <button type="button" class="btn-tbl-delete" title="Dar de baja"
                                                    onclick="abrirModalEliminar('<?= $p['rfc'] ?>', '<?= htmlspecialchars($p['nombre'].' '.$p['apellidospama'], ENT_QUOTES, 'UTF-8') ?>')">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        <?php else: ?>
                                            <span class="text-muted" style="font-size:.75rem;">—</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div><!-- !/tab consulta -->

        </main>
    </div>

 <?php include('vista/admin/footer_admin.php'); ?>

 <script>
document.addEventListener('DOMContentLoaded', function() {
    const selectTipo = document.getElementById('tipo_usuario');
    const inputEmpresa = document.getElementById('empresa');

    selectTipo.addEventListener('change', function() {
        if (this.value === 'R') {
            inputEmpresa.disabled = false;
            inputEmpresa.focus();
        } else {
            inputEmpresa.disabled = true;
            inputEmpresa.value = '';
        }
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const rowsPerPageSelect = document.getElementById('rowsPerPageSelect');
    const tbody = document.querySelector('.admin-table tbody');
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
        if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;
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
        if (totalPages <= 1) {
            paginationControls.innerHTML = '';
            return; 
        }

        paginationControls.innerHTML = '<span class="page-info">Página:</span>';
        if (currentPage > 1) {
            const btnPrev = document.createElement('button');
            btnPrev.className = 'pg-btn';
            btnPrev.innerHTML = '<i class="fas fa-chevron-left me-1"></i>';
            btnPrev.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage--;
                renderTable();
            });
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
            btnNext.addEventListener('click', (e) => {
                e.preventDefault();
                currentPage++;
                renderTable();
            });
            paginationControls.appendChild(btnNext);
        }
    }

    function filterData() {
        const term = searchInput.value.toLowerCase();
        
        filteredRows = allRows.filter(row => {
            const text = row.textContent.toLowerCase();
            return text.includes(term);
        });

        currentPage = 1;
        renderTable();
    }

    searchInput.addEventListener('input', filterData);
    
    rowsPerPageSelect.addEventListener('change', function() {
        rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
        currentPage = 1;
        renderTable();
    });
    renderTable();
});

function abrirModalEdicion(rfc, nombre, apellidos, correo, telefono, tipo, empresa) {
    document.getElementById('edit_rfc').value = rfc;
    document.getElementById('edit_nombre').value = nombre;
    document.getElementById('edit_apellidos').value = apellidos;
    document.getElementById('edit_correo').value = correo;
    document.getElementById('edit_telefono').value = telefono;
    const selectTipo = document.getElementById('edit_tipo_usuario');
    selectTipo.value = tipo;
    const inputEmpresa = document.getElementById('edit_empresa');
    if (tipo === 'R') {
        inputEmpresa.disabled = false;
        inputEmpresa.value = empresa;
    } else {
        inputEmpresa.disabled = true;
        inputEmpresa.value = '';
    }

    document.getElementById('editModal').style.display = 'flex';
}

function cerrarModalEdicion() {
    document.getElementById('editModal').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    const editSelectTipo = document.getElementById('edit_tipo_usuario');
    const editInputEmpresa = document.getElementById('edit_empresa');

    if(editSelectTipo) {
        editSelectTipo.addEventListener('change', function() {
            if (this.value === 'R') {
                editInputEmpresa.disabled = false;
                editInputEmpresa.focus();
            } else {
                editInputEmpresa.disabled = true;
                editInputEmpresa.value = '';
            }
        });
    }

    const inputFecha = document.getElementById('fecha_nacimiento');
    
    if (inputFecha) {
        const hoy = new Date();
        const anioLimite = hoy.getFullYear() - 18;
        const mes = String(hoy.getMonth() + 1).padStart(2, '0');
        const dia = String(hoy.getDate()).padStart(2, '0');
        const fechaMax = `${anioLimite}-${mes}-${dia}`;
        inputFecha.max = fechaMax;
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.admin-tab-btn');
    const tabPanels = document.querySelectorAll('.admin-tab-panel');
    const phpForcedTab = '<?= $postAction ?>';
    let activeTabId = phpForcedTab;
    if (!activeTabId) {
        activeTabId = localStorage.getItem('lastActiveTab') || 'tab-registro-usuario'; 
    } else {
        localStorage.setItem('lastActiveTab', activeTabId);
    }

    function activateTab(targetId) {
        tabBtns.forEach(btn => {
            if(btn.getAttribute('data-target') === targetId) {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });

        tabPanels.forEach(panel => {
            if(panel.id === targetId) {
                panel.classList.add('active');
            } else {
                panel.classList.remove('active');
            }
        });
    }

    activateTab(activeTabId);
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('data-target');
            localStorage.setItem('lastActiveTab', targetId);
            activateTab(targetId);
        });
    });
});

function abrirModalEliminar(rfc, nombreCompleto) {
    const mensaje = document.getElementById('confirmMsg');
    mensaje.innerHTML = `¿Estás seguro de que deseas eliminar al empleado <strong>${nombreCompleto}</strong>?`;
    document.getElementById('delete_rfc').value = rfc;
    document.getElementById('confirmOverlay').style.display = 'flex';
}

function cerrarModalEliminar() {
    document.getElementById('confirmOverlay').style.display = 'none';
}

function abrirModalActivar(rfc, nombreCompleto) {
    const mensaje = document.getElementById('activateMsg');
    mensaje.innerHTML = `¿Estás seguro de que deseas reactivar al empleado <strong>${nombreCompleto}</strong>?`;
    document.getElementById('activate_rfc').value = rfc;
    document.getElementById('activateOverlay').style.display = 'flex';
}

function cerrarModalActivar() {
    document.getElementById('activateOverlay').style.display = 'none';
}

document.addEventListener('DOMContentLoaded', function() {
    // --- LÓGICA PARA REGISTRO (Ya la tienes) ---
    const selectTipo = document.getElementById('tipo_usuario');
    const inputEmpresa = document.getElementById('empresa');

    selectTipo.addEventListener('change', function() {
        actualizarEstadoEmpresa(this.value, inputEmpresa);
    });

    // --- LÓGICA PARA EDICIÓN (Añade esto) ---
    const editSelectTipo = document.getElementById('edit_tipo_usuario');
    const editInputEmpresa = document.getElementById('edit_empresa');

    if(editSelectTipo) {
        editSelectTipo.addEventListener('change', function() {
            actualizarEstadoEmpresa(this.value, editInputEmpresa);
        });
    }

    function actualizarEstadoEmpresa(tipo, input) {
        if (tipo === 'R') {
            input.disabled = false;
            input.placeholder = "Ej. FedEx, DHL, Estafeta...";
        } else {
            input.disabled = true;
            input.value = '';
            input.placeholder = "Ej. LuchanosCorp S.A.";
        }
    }
});
</script>