<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Admin — Personal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
     <!-- <link rel="stylesheet" href="../../estilos/styles.css">-->
    <link rel="stylesheet" href="../../estilos/vendedor.css">
</head>
<body>

    <!-- Modal de confirmación eliminación -->
    <div class="confirm-overlay" id="confirmOverlay">
        <div class="confirm-box">
            <div class="confirm-icon danger"><i class="fas fa-exclamation"></i></div>
            <h5>Eliminar Personal</h5>
            <p id="confirmMsg">¿Estás seguro de que deseas eliminar este registro?</p>
            <div class="confirm-actions">
                <button class="btn-confirm-yes" id="confirmYes">
                    <i class="fas fa-trash me-1"></i> Sí, eliminar
                </button>
                <button class="btn-confirm-no" onclick="closeConfirm()">
                    <i class="fas fa-times me-1"></i> Cancelar
                </button>
            </div>
        </div>
    </div>

    <div class="topbar">
        <div class="container-fluid d-flex justify-content-between px-3">
            <div>
                <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
                <span class="d-none d-md-inline"><i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com</span>
            </div>
            <div><span><i class="fas fa-user-shield me-1"></i> Panel Administrador</span></div>
        </div>
    </div>
    <div class="main-nav">
        <div class="container-fluid d-flex align-items-center gap-3 px-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="Buscar usuarios, productos...">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <span class="nav-icon" style="font-size:.82rem; color:#555">
                    <i class="fas fa-user-circle me-1" style="color:var(--btn-color)"></i> Admin
                </span>
            </div>
        </div>
    </div>

    <div class="admin-layout">
        <nav class="admin-sidebar">
            <p class="sidebar-title">Menú Admin</p>
            <a href="vistaadmin.php"      class="nav-link"><i class="fas fa-tachometer-alt"></i> Inicio</a>
            <a href="admin_usuarios.php"  class="nav-link active"><i class="fas fa-users"></i> Personal</a>
            <a href="admin_productos.php" class="nav-link"><i class="fas fa-box"></i> Productos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Reportes</p>
            <a href="admin_reportes_ventas.php"   class="nav-link"><i class="fas fa-chart-bar"></i> Ventas</a>
            <a href="admin_reportes_compras.php"  class="nav-link"><i class="fas fa-shopping-bag"></i> Compras</a>
            <a href="admin_reportes_pedidos.php"  class="nav-link"><i class="fas fa-truck"></i> Pedidos</a>
            <hr class="sidebar-divider">
            <p class="sidebar-title">Proveedores</p>
            <a href="admin_pedido_proveedor.php" class="nav-link"><i class="fas fa-clipboard-list"></i> Pedir a Proveedor</a>
                        <a href="../Cuenta/login.php" class="btn-cerrar">
                <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
            </a>
</nav>

        <main class="admin-content">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0 small">
                    <li class="breadcrumb-item">
                        <a href="vistaadmin.php" class="text-decoration-none" style="color:var(--btn-color)">Inicio</a>
                    </li>
                    <li class="breadcrumb-item active text-muted">Personal</li>
                </ol>
            </nav>

            <div class="mb-4">
                <h1 class="page-header-title mb-0">Gestión de Personal</h1>
                <p class="page-header-sub">Registra y consulta el personal del sistema.</p>
            </div>

            <!-- Tabs -->
            <div class="admin-tabs">
                <button class="admin-tab-btn active"
                        data-tab-group="personal" data-target="tab-registro-usuario">
                    <i class="fas fa-user-plus me-1"></i> Registro
                </button>
                <button class="admin-tab-btn"
                        data-tab-group="personal" data-target="tab-consulta-usuario">
                    <i class="fas fa-search me-1"></i> Consulta
                </button>
            </div>

            <!-- ── PANEL REGISTRO ── -->
            <div class="admin-tab-panel active" id="tab-registro-usuario" data-tab-group="personal">
                <div class="admin-form-card">
                    <div class="admin-form-header">
                        <i class="fas fa-user-plus"></i> Formulario de Registro de Nuevo Usuario
                    </div>
                    <div class="admin-form-body">
                    <form action="admin_usuarios.php" method="POST" novalidate class="needs-validation">

                        <div class="form-section-label"><i class="fas fa-id-card"></i> Datos Personales</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="nombre" class="form-label">Nombre Completo <span class="text-danger">*</span></label>
                                <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ej. Juan Pérez López" required>
                                <div class="invalid-feedback">Ingresa el nombre completo.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="rfc" class="form-label">RFC <span class="text-danger">*</span></label>
                                <input type="text" id="rfc" name="rfc" class="form-control" placeholder="Ej. PELJ850101ABC" maxlength="13" required>
                                <div class="invalid-feedback">Ingresa el RFC.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="correo" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                                <input type="email" id="correo" name="correo" class="form-control" placeholder="ejemplo@correo.com" required>
                                <div class="invalid-feedback">Ingresa un correo válido.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="telefono" class="form-label">Teléfono <span class="text-danger">*</span></label>
                                <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="10 dígitos" maxlength="10" required>
                                <div class="invalid-feedback">Ingresa el teléfono.</div>
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-briefcase"></i> Datos Laborales</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="empresa" class="form-label">Empresa</label>
                                <input type="text" id="empresa" name="empresa" class="form-control" placeholder="Ej. LuchanosCorp S.A.">
                            </div>
                            <div class="col-md-6">
                                <label for="tipo_usuario" class="form-label">Tipo de Usuario <span class="text-danger">*</span></label>
                                <select id="tipo_usuario" name="tipo_usuario" class="form-select" required>
                                    <option value="" disabled selected>Selecciona un tipo</option>
                                    <option value="admin">Administrador</option>
                                    <option value="vendedor">Vendedor</option>
                                    <option value="cliente">Cliente</option>
                                </select>
                                <div class="invalid-feedback">Selecciona el tipo de usuario.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="modalidad" class="form-label">Modalidad <span class="text-danger">*</span></label>
                                <select id="modalidad" name="modalidad" class="form-select" required>
                                    <option value="" disabled selected>Selecciona modalidad</option>
                                    <option value="presencial">Presencial</option>
                                    <option value="remoto">Remoto</option>
                                    <option value="hibrido">Híbrido</option>
                                </select>
                                <div class="invalid-feedback">Selecciona la modalidad.</div>
                            </div>
                        </div>

                        <div class="form-section-label"><i class="fas fa-lock"></i> Credencial de Acceso</div>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label for="usuario" class="form-label">Nombre de Usuario <span class="text-danger">*</span></label>
                                <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Ej. jperez01" required>
                                <div class="invalid-feedback">Define un nombre de usuario.</div>
                            </div>
                            <div class="col-md-6"><!-- espacio --></div>
                            <div class="col-md-6">
                                <label for="contrasena" class="form-label">Contraseña <span class="text-danger">*</span></label>
                                <div class="pw-wrapper">
                                    <input type="password" id="contrasena" name="contrasena" class="form-control" placeholder="Mínimo 8 caracteres" minlength="8" required>
                                    <span class="pw-toggle" onclick="togglePw('contrasena','eyeA')"><i id="eyeA" class="fas fa-eye"></i></span>
                                </div>
                                <div class="invalid-feedback">Mínimo 8 caracteres.</div>
                            </div>
                            <div class="col-md-6">
                                <label for="confirmar" class="form-label">Confirmar Contraseña <span class="text-danger">*</span></label>
                                <div class="pw-wrapper">
                                    <input type="password" id="confirmar" name="confirmar" class="form-control" placeholder="Repite la contraseña" required>
                                    <span class="pw-toggle" onclick="togglePw('confirmar','eyeB')"><i id="eyeB" class="fas fa-eye"></i></span>
                                </div>
                                <div class="invalid-feedback" id="confirmar-feedback">Confirma la contraseña.</div>
                            </div>
                        </div>

                        <hr class="admin-form-divider">
                        <div class="d-flex justify-content-end gap-3 mt-3">
                            <a href="vistaadmin.php" class="btn-admin-secondary"><i class="fas fa-times"></i> Cancelar</a>
                            <button type="submit" class="btn-admin-primary"><i class="fas fa-save"></i> Guardar Usuario</button>
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
                        <div class="admin-search-bar">
                            <input type="text" class="form-control" placeholder="Nombre o usuario..." style="max-width:260px">
                            <select class="form-select" style="max-width:180px">
                                <option value="">Todos los tipos</option>
                                <option value="admin">Administrador</option>
                                <option value="vendedor">Vendedor</option>
                                <option value="cliente">Cliente</option>
                            </select>
                            <button class="btn-buscar"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                        <div class="table-page-info">Número de registros por página: 5 &nbsp;|&nbsp; Página: 1 de 3</div>
                    </div>

                    <!-- Tabla -->
                    <div class="admin-form-body pt-0">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>ID</th>
                                    <th>Nombre Completo</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th>Tipo</th>
                                    <th>Modalidad</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $personal = [
                                    [1,'Juan Pérez López','jperez01','jperez@email.com','Administrador','Presencial',true],
                                    [2,'María García Ruiz','mgarcia','mgarcia@email.com','Vendedor','Remoto',true],
                                    [3,'Carlos Mendoza','cmendoza','cmendoza@email.com','Vendedor','Híbrido',true],
                                    [4,'Ana Torres Vega','atorres','atorres@email.com','Cliente','Presencial',false],
                                    [5,'Luis Ramírez','lramirez','lramirez@email.com','Vendedor','Presencial',true],
                                ];
                                foreach ($personal as $i => $p): ?>
                                <tr>
                                    <td><?= $i+1 ?></td>
                                    <td><?= $p[0] ?></td>
                                    <td class="td-name"><?= $p[1] ?></td>
                                    <td><?= $p[2] ?></td>
                                    <td><?= $p[3] ?></td>
                                    <td><?= $p[4] ?></td>
                                    <td><?= $p[5] ?></td>
                                    <td>
                                        <?php if ($p[6]): ?>
                                            <span class="badge-activo">Activo</span>
                                        <?php else: ?>
                                            <span class="badge-inactivo">Inactivo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn-tbl-edit" title="Editar">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </td>
                                    <td>
                                        <button class="btn-tbl-delete"
                                                onclick="confirmDelete('personal','<?= htmlspecialchars($p[1]) ?>',<?= $p[0] ?>)"
                                                title="Eliminar">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="admin-pagination mt-3">
                        <span class="page-info">Página:</span>
                        <button class="pg-btn active">1</button>
                        <button class="pg-btn">2</button>
                        <button class="pg-btn">3</button>
                    </div>
                    </div>
                </div>
            </div><!-- !/tab consulta -->

        </main>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/vendedor.js"></script>
    <link rel="stylesheet" href="../../estilos/responsive.css">
    <script src="../../js/responsive.js"></script>
</body>
</html>