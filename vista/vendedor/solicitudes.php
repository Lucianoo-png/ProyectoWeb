<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Solicitudes de Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/vendedor.css">
</head>
<body>

<!-- Modal para atender solicitud -->
<div class="confirm-overlay" id="modalSolicitud">
    <div class="modal-sol-box">
        <div class="modal-sol-header">
            <h5><i class="fas fa-headset"></i> Atender Solicitud</h5>
            <button class="btn-tbl-edit btn-modal-close" id="btnCerrarModal">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="row g-2">
            <div class="col-6">
                <span class="modal-sol-label">No. Referencia</span>
                <p id="modal-ref" class="modal-sol-value mono"></p>
            </div>
            <div class="col-6">
                <span class="modal-sol-label">Cliente</span>
                <p id="modal-cliente" class="modal-sol-value"></p>
            </div>
            <div class="col-6">
                <span class="modal-sol-label">Tipo</span>
                <p id="modal-tipo" class="modal-sol-value"></p>
            </div>
            <div class="col-6">
                <span class="modal-sol-label">Fecha y Hora</span>
                <p id="modal-fecha" class="modal-sol-value"></p>
            </div>
            <div class="col-12">
                <span class="modal-sol-label">Asunto</span>
                <p id="modal-asunto" class="modal-sol-value"></p>
            </div>
            <div class="col-12">
                <span class="modal-sol-label">Descripción del cliente</span>
                <p id="modal-desc" class="modal-sol-value modal-desc-box"></p>
            </div>
            <div class="col-12">
                <span class="modal-sol-label">Evidencia Adjunta</span>
                <p id="modal-evidencia" class="modal-sol-value"></p>
            </div>
        </div>
        <hr class="modal-sol-divider">
        <div class="mb-3">
            <label class="modal-sol-label" for="modal-respuesta">Respuesta / Resolución:</label>
            <textarea id="modal-respuesta" class="form-control resize-v" rows="3"
                      placeholder="Escribe aquí la acción tomada para resolver la solicitud…"></textarea>
        </div>
        <div class="mb-4">
            <label class="modal-sol-label" for="modal-estado">Cambiar Estado:</label>
            <select id="modal-estado" class="form-select">
                <option value="en_proceso">En proceso</option>
                <option value="resuelto">Resuelto</option>
                <option value="cancelado">Cancelado</option>
            </select>
        </div>
        <div class="confirm-actions">
            <button class="btn-confirm-yes" id="btnGuardarSol">
                <i class="fas fa-save me-1"></i> Guardar Respuesta
            </button>
            <button class="btn-confirm-no" id="btnCancelarSol">
                <i class="fas fa-times me-1"></i> Cancelar
            </button>
        </div>
    </div>
</div>

<!-- Topbar -->
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <span class="me-3"><i class="fas fa-phone-alt me-1"></i> 800-123-4567</span>
            <span class="d-none d-md-inline">
                <i class="fas fa-envelope me-1"></i> soporte@LuchanosCorp.com
            </span>
        </div>
        <div class="d-flex gap-3">
            <a href="../rastrear_pedido.php" class="topbar-link-track">
                <i class="fas fa-truck me-1"></i> Rastrear Pedido
            </a>
            <a href="#" class="topbar-link-muted">Ayuda</a>
          </div>
        </div>
    </div>

<!-- Navbar -->
<div class="main-nav">
    <div class="container-fluid d-flex align-items-center gap-3 px-3">
        <a href="../../index.php" class="brand-logo me-3">
            <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
        </a>
        <div class="input-group search-bar flex-grow-1 mx-lg-4">
            <input type="text" class="form-control" placeholder="Buscar solicitudes…">
            <button class="btn px-4"><i class="fas fa-search"></i></button>
        </div>
    </div>
</div>

<!-- Layout -->
<div class="admin-layout">

    <!-- Sidebar -->
    <nav class="admin-sidebar">
        <p class="sidebar-title">Menú Vendedor</p>
        <a href="inicio_vendedor.php" class="nav-link">
            <i class="fas fa-tachometer-alt"></i> Inicio
        </a>
        <a href="ventas.php" class="nav-link">
            <i class="fas fa-cash-register"></i> Venta
        </a>
        <a href="detalle_ventas.php" class="nav-link">
            <i class="fas fa-receipt"></i> Detalle Ventas
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Consultas</p>
        <a href="inventario.php" class="nav-link">
            <i class="fas fa-boxes"></i> Inventario
        </a>
        <a href="catalogo.php" class="nav-link">
            <i class="fas fa-th-large"></i> Catálogo
        </a>
        <hr class="sidebar-divider">
        <p class="sidebar-title">Atención</p>
        <a href="solicitudes.php" class="nav-link active">
            <i class="fas fa-headset"></i> Solicitudes
            <span class="tab-badge">2</span>
        </a>
        <a href="../../vista/Cuenta/login.php" class="btn-cerrar">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </nav>

    <!-- Contenido -->
    <main class="admin-content">

        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb mb-0 small">
                <li class="breadcrumb-item">
                    <a href="inicio_vendedor.php" class="breadcrumb-link">Inicio</a>
                </li>
                <li class="breadcrumb-item active text-muted">Solicitudes</li>
            </ol>
        </nav>

        <div class="mb-4">
            <h1 class="page-header-title mb-0">Solicitudes de Clientes</h1>
            <p class="page-header-sub">
                Verifica y gestiona las solicitudes de garantía y devolución enviadas por los clientes.
            </p>
        </div>

        <!-- Tabs: Pendientes / En Proceso / Resueltas (sin Nueva Solicitud) -->
        <div class="admin-tabs admin-tabs-left mb-4">
            <button class="admin-tab-btn active" data-tab-group="sol" data-target="tab-pendientes">
                <i class="fas fa-clock me-1"></i> Pendientes
                <span class="tab-badge">2</span>
            </button>
            <button class="admin-tab-btn" data-tab-group="sol" data-target="tab-proceso">
                <i class="fas fa-spinner me-1"></i> En Proceso
            </button>
            <button class="admin-tab-btn" data-tab-group="sol" data-target="tab-resueltas">
                <i class="fas fa-check-circle me-1"></i> Resueltas
            </button>
        </div>

        <!-- ══ TAB: PENDIENTES ══════════════════════════════════ -->
        <div class="admin-tab-panel active" id="tab-pendientes" data-tab-group="sol">
            <div class="admin-form-card">
                <div class="admin-form-body pb-0">
                    <div class="admin-search-bar">
                        <input type="text"
                               class="form-control sol-filter-input"
                               id="solBuscar"
                               placeholder="No. referencia o cliente…"
                               oninput="filtrarSolicitudes()">
                        <select class="form-select sol-filter-select"
                                id="solTipo"
                                onchange="filtrarSolicitudes()">
                            <option value="">Todos los tipos</option>
                            <option value="Garantía">Garantía</option>
                            <option value="Devolución">Devolución</option>
                        </select>
                        <button class="btn-buscar" onclick="filtrarSolicitudes()">
                            <i class="fas fa-search"></i> Buscar
                        </button>
                    </div>
                </div>
                <div class="admin-form-body pt-0">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Referencia</th>
                                    <th>Fecha y Hora</th>
                                    <th>Cliente</th>
                                    <th>Tipo</th>
                                    <th>Asunto</th>
                                    <th>Estado</th>
                                    <th>Atender</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $pendientes = [
                                    ['LC-SOL-240001','21/03/2026 09:15','Ana Torres',   'Garantía',
                                     'Lavadora no enciende tras instalación',
                                     'La lavadora adquirida el 14/03/2026 no enciende al conectarla. El panel no responde. Solicita revisión técnica.',
                                     'foto_lavadora.jpg'],
                                    ['LC-SOL-240002','21/03/2026 10:02','Luis Ramírez', 'Devolución',
                                     'Refrigerador llegó con golpe en la puerta',
                                     'Daño físico evidente en la puerta del refrigerador al momento de la entrega. Solicita reposición o descuento.',
                                     'foto_golpe.jpg'],
                                ];
                                foreach ($pendientes as $i => $s):
                                    $data = htmlspecialchars(json_encode([
                                        'ref'       => $s[0],
                                        'cliente'   => $s[2],
                                        'tipo'      => $s[3],
                                        'fecha'     => $s[1],
                                        'asunto'    => $s[4],
                                        'desc'      => $s[5],
                                        'evidencia' => $s[6] ?? null,
                                    ]), ENT_QUOTES);
                                ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><code class="sol-ref-code"><?= $s[0] ?></code></td>
                                    <td class="td-fecha"><?= $s[1] ?></td>
                                    <td class="td-name"><?= htmlspecialchars($s[2]) ?></td>
                                    <td><?= $s[3] ?></td>
                                    <td class="td-asunto"><?= htmlspecialchars($s[4]) ?></td>
                                    <td><span class="badge-inactivo">Pendiente</span></td>
                                    <td>
                                        <button class="btn-tbl-edit js-atender"
                                                data-sol='<?= $data ?>'
                                                title="Atender solicitud">
                                            <i class="fas fa-headset"></i> Atender
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /tab-pendientes -->

        <!-- ══ TAB: EN PROCESO ══════════════════════════════════ -->
        <div class="admin-tab-panel" id="tab-proceso" data-tab-group="sol">
            <div class="admin-form-card">
                <div class="admin-form-body">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Referencia</th>
                                    <th>Fecha y Hora</th>
                                    <th>Cliente</th>
                                    <th>Tipo</th>
                                    <th>Asunto</th>
                                    <th>Estado</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $enProceso = [
                                    ['LC-SOL-230098','19/03/2026 14:20','Ana Torres',  'Garantía',
                                     'Lavadora deja ropa húmeda',
                                     'Técnico enviado al domicilio el 21/03/2026. Revisión en curso.'],
                                    ['LC-SOL-230099','20/03/2026 08:55','Luis Ramírez','Devolución',
                                     'Refrigerador Samsung con puerta abollada',
                                     'Se coordinó con almacén para reposición. Pendiente confirmación del cliente.'],
                                ];
                                foreach ($enProceso as $i => $s):
                                    $data = htmlspecialchars(json_encode([
                                        'ref'       => $s[0], 'cliente' => $s[2],
                                        'tipo'      => $s[3], 'fecha'   => $s[1],
                                        'asunto'    => $s[4], 'desc'    => $s[5],
                                        'evidencia' => null,
                                    ]), ENT_QUOTES);
                                ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><code class="sol-ref-code"><?= $s[0] ?></code></td>
                                    <td class="td-fecha"><?= $s[1] ?></td>
                                    <td class="td-name"><?= htmlspecialchars($s[2]) ?></td>
                                    <td><?= $s[3] ?></td>
                                    <td class="td-asunto-sm"><?= htmlspecialchars($s[4]) ?></td>
                                    <td><span class="badge-proceso">En proceso</span></td>
                                    <td>
                                        <button class="btn-tbl-edit js-atender" data-sol='<?= $data ?>'>
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /tab-proceso -->

        <!-- ══ TAB: RESUELTAS ═══════════════════════════════════ -->
        <div class="admin-tab-panel" id="tab-resueltas" data-tab-group="sol">
            <div class="admin-form-card">
                <div class="admin-form-body">
                    <div class="admin-table-wrap">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>No. Referencia</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Tipo</th>
                                    <th>Asunto</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $resueltas = [
                                    ['LC-SOL-230050','10/03/2026','Roberto Méndez','Devolución',
                                     'Cambio de microondas por unidad defectuosa'],
                                    ['LC-SOL-230053','17/03/2026','Luis Ramírez',  'Garantía',
                                     'Reparación de estufa dentro de garantía'],
                                ];
                                foreach ($resueltas as $i => $s): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><code class="sol-ref-code"><?= $s[0] ?></code></td>
                                    <td><?= $s[1] ?></td>
                                    <td class="td-name"><?= htmlspecialchars($s[2]) ?></td>
                                    <td><?= $s[3] ?></td>
                                    <td class="td-asunto-sm"><?= htmlspecialchars($s[4]) ?></td>
                                    <td><span class="badge-activo">Resuelto</span></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /tab-resueltas -->

    </main>
</div>

<footer class="site-footer-minimal">© <?= date('Y') ?> LuchanosCorp S.A. Todos los derechos reservados.</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="../../js/vendedor.js"></script>
</body>
</html>