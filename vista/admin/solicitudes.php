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
        <form action="/proyectoweb/admin/solicitudes" method="POST">
        <input type="hidden" name="no_referencia" id="modal-hidden-id">
        <div class="mb-3">
            <label class="modal-sol-label" for="modal-respuesta">Respuesta / Resolución:</label>
            <textarea id="modal-respuesta" name="respuesta" class="form-control resize-v" rows="3"
                      placeholder="Escribe aquí la acción tomada para resolver la solicitud…"></textarea>
        </div>
        <div class="confirm-actions">
            <button type="submit" name="guardar" class="btn-confirm-yes" id="btnGuardarSol">
                <i class="fas fa-save me-1"></i> Guardar Respuesta
            </button>
            <button class="btn-confirm-no" id="btnCancelarSol">
                <i class="fas fa-times me-1"></i> Cancelar
            </button>
        </div>
        </form>
    </div>
</div>

<?php include('vista/admin/header_admin.php'); ?>

<!-- Layout -->
<div class="admin-layout">

<?php include('vista/admin/menu_admin.php'); ?>
   

    <!-- Contenido -->
    <main class="admin-content">

        <div class="mb-4 text-center">
            <h1 class="page-header-title mb-0">Solicitudes de Clientes</h1>
            <p class="page-header-sub">
                Verifica y gestiona las solicitudes de garantía y devolución enviadas por los clientes.
            </p>
            <?php if(!empty($msj)){ ?>
                                <div class="alerta alerta-<?php echo $msj[0]; ?>" style="margin: 15px 15px 15px 15px;"><?php echo $msj[1]; ?></div>
                            <?php } ?>
        </div>

        <!-- Tabs: Pendientes / En Proceso / Resueltas (sin Nueva Solicitud) -->
        <div class="admin-tabs admin-tabs-left mb-4" style="justify-content:center">
            <button class="admin-tab-btn active" data-tab-group="sol" data-target="tab-pendientes">
                <i class="fas fa-clock me-1"></i> Pendientes
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
                <input type="text" class="form-control sol-filter-input" id="solBuscarPend" placeholder="No. referencia o cliente…">
                <select class="form-select sol-filter-select" id="solTipoPend">
                    <option value="">Todos los tipos</option>
                    <option value="Garantía">Garantía</option>
                    <option value="Devolución">Devolución</option>
                </select>
                <select id="rowsPerPageSelect" class="form-select w-auto">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="all">Todos</option>
                </select>
            </div>
            <div class="table-page-info">
                Número de registros por página: <span id="info-rows-per-page">5</span> &nbsp;|&nbsp; 
                Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
            </div>
        </div>
        <div class="admin-form-body pt-0">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha y Hora</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $hayPendientes = false;
                        foreach ($solicitudes as $s): 
                            if ($s['estado'] === 'P'):
                                $hayPendientes = true;
                                $tipoTexto = ($s['tipo'] === 'G') ? 'Garantía' : 'Devolución';
                                $folio = str_pad($s['no_referencia'], 5, "0", STR_PAD_LEFT);
                                $data = htmlspecialchars(json_encode([
                                    'ref' => $folio, 'no_ref' => $s['no_referencia'], 'cliente' => $s['nombre_cliente'],
                                    'tipo' => $tipoTexto, 'fecha' => date("d/m/Y H:i", strtotime($s['fechayhora'])),
                                    'asunto' => $s['asunto'], 'desc' => $s['descripción'], 'evidencia' => $s['evidencia']
                                ]), ENT_QUOTES);
                        ?>
                            <tr>
                                <td><code class="sol-ref-code"><?= $folio ?></code></td>
                                <td class="td-fecha"><?= date("d/m/Y H:i", strtotime($s['fechayhora'])) ?></td>
                                <td class="td-name"><?= htmlspecialchars($s['nombre_cliente']) ?></td>
                                <td><?= $tipoTexto ?></td>
                                <td class="td-asunto"><?= htmlspecialchars($s['asunto']) ?></td>
                                <td><span class="badge-inactivo">Pendiente</span></td>
                                <td>
                                    <button class="btn-tbl-edit js-atender" data-sol='<?= $data ?>'>
                                        <i class="fas fa-headset"></i> Atender
                                    </button>
                                </td>
                            </tr>
                        <?php endif; endforeach; 
                        if (!$hayPendientes): ?>
                            <tr><td colspan="7" class="text-center py-4">No hay solicitudes pendientes.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-pagination mt-3"></div>
        </div>
    </div>
</div>

        <!-- ══ TAB: RESUELTAS ═══════════════════════════════════ -->
        <div class="admin-tab-panel" id="tab-resueltas" data-tab-group="sol">
    <div class="admin-form-card">
        <div class="admin-form-body pb-0">
            <div class="admin-search-bar">
                <input type="text" class="form-control sol-filter-input" id="solBuscarRes" placeholder="No. referencia o cliente…">
                <select class="form-select sol-filter-select" id="solTipoRes">
                    <option value="">Todos los tipos</option>
                    <option value="Garantía">Garantía</option>
                    <option value="Devolución">Devolución</option>
                </select>
                <select id="rowsPerPageSelect" class="form-select w-auto">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="all">Todos</option>
                </select>
            </div>
            <div class="table-page-info">
                Página: <span id="info-current-page">1</span> de <span id="info-total-pages">1</span>
            </div>
        </div>
        <div class="admin-form-body pt-0">
            <div class="admin-table-wrap">
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Tipo</th>
                            <th>Asunto</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $hayResueltas = false;
                        foreach ($solicitudes as $s): 
                            if ($s['estado'] === 'A'):
                                $hayResueltas = true;
                                $tipoTexto = ($s['tipo'] === 'G') ? 'Garantía' : 'Devolución';
                                $folio = str_pad($s['no_referencia'], 5, "0", STR_PAD_LEFT);
                        ?>
                            <tr>
                                <td><code class="sol-ref-code"><?= $folio ?></code></td>
                                <td><?= date("d/m/Y", strtotime($s['fechayhora'])) ?></td>
                                <td class="td-name"><?= htmlspecialchars($s['nombre_cliente']) ?></td>
                                <td><?= $tipoTexto ?></td>
                                <td class="td-asunto-sm"><?= htmlspecialchars($s['asunto']) ?></td>
                                <td><span class="badge-activo">Resuelto</span></td>
                            </tr>
                        <?php endif; endforeach; 
                        if (!$hayResueltas): ?>
                            <tr><td colspan="6" class="text-center py-4">No hay solicitudes resueltas.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <div class="admin-pagination mt-3"></div>
        </div>
    </div>
</div><!-- /tab-resueltas -->

    </main>
</div>
<?php include('vista/admin/footer_admin.php'); ?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // ══ CONFIGURACIÓN GENERAL ══════════════════════════════════
    const setupTableLogic = (panelId) => {
        const panel = document.getElementById(panelId);
        if (!panel) return;

        const searchInput = panel.querySelector('.sol-filter-input');
        const typeSelect = panel.querySelector('.sol-filter-select');
        const rowsSelect = panel.querySelector('#rowsPerPageSelect');
        const tbody = panel.querySelector('table tbody');
        const allRows = Array.from(tbody.querySelectorAll('tr'));
        const paginationControls = panel.querySelector('.admin-pagination') || panel.nextElementSibling;

        const infoRowsPerPage = panel.querySelector('#info-rows-per-page');
        const infoCurrentPage = panel.querySelector('#info-current-page');
        const infoTotalPages = panel.querySelector('#info-total-pages');

        let currentPage = 1;
        let rowsPerPage = 5;
        let filteredRows = [...allRows];

        function renderTable() {
            const totalRows = filteredRows.length;
            const totalPages = rowsPerPage === 'all' ? 1 : Math.max(1, Math.ceil(totalRows / rowsPerPage));

            if (currentPage < 1) currentPage = 1;
            if (currentPage > totalPages && totalPages > 0) currentPage = totalPages;

            // Actualizar etiquetas de información
            if (infoRowsPerPage) infoRowsPerPage.textContent = rowsPerPage === 'all' ? 'Todos' : rowsPerPage;
            if (infoCurrentPage) infoCurrentPage.textContent = totalPages === 0 ? 0 : currentPage;
            if (infoTotalPages) infoTotalPages.textContent = totalPages;

            // Ocultar todas y mostrar solo el rango
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

            const createBtn = (content, targetPage, active = false) => {
                const btn = document.createElement('button');
                btn.className = `pg-btn ${active ? 'active' : ''}`;
                btn.innerHTML = content;
                btn.onclick = (e) => {
                    e.preventDefault();
                    currentPage = targetPage;
                    renderTable();
                };
                return btn;
            };

            if (currentPage > 1) paginationControls.appendChild(createBtn('<i class="fas fa-chevron-left"></i>', currentPage - 1));
            paginationControls.appendChild(createBtn(currentPage, currentPage, true));
            if (currentPage < totalPages) paginationControls.appendChild(createBtn('<i class="fas fa-chevron-right"></i>', currentPage + 1));
        }

        function applyFilters() {
            const term = searchInput.value.toLowerCase();
            const type = typeSelect.value;

            filteredRows = allRows.filter(row => {
                const text = row.textContent.toLowerCase();
                const rowType = row.cells[3].textContent.trim(); // Columna "Tipo"

                const matchText = text.includes(term);
                const matchType = type === "" || rowType === type;

                return matchText && matchType;
            });

            currentPage = 1;
            renderTable();
        }

        // Eventos
        searchInput.addEventListener('input', applyFilters);
        typeSelect.addEventListener('change', applyFilters);
        rowsSelect.addEventListener('change', function() {
            rowsPerPage = this.value === 'all' ? 'all' : parseInt(this.value);
            currentPage = 1;
            renderTable();
        });

        renderTable();
    };

    // ══ INICIALIZAR AMBAS TABS ══════════════════════════════════
    setupTableLogic('tab-pendientes');
    setupTableLogic('tab-resueltas');

    // ══ LÓGICA DEL MODAL DE ATENCIÓN ════════════════════════════
    const modal = document.getElementById('modalSolicitud');
    
    document.querySelectorAll('.js-atender').forEach(btn => {
        btn.onclick = function() {
            const data = JSON.parse(this.getAttribute('data-sol'));
            
            // Llenar campos del modal
            document.getElementById('modal-ref').textContent = data.ref;
            document.getElementById('modal-cliente').textContent = data.cliente;
            document.getElementById('modal-tipo').textContent = data.tipo;
            document.getElementById('modal-fecha').textContent = data.fecha;
            document.getElementById('modal-asunto').textContent = data.asunto;
            document.getElementById('modal-desc').textContent = data.desc;
            document.getElementById('modal-hidden-id').value = data.no_ref;
            
           // Manejo de evidencia en el Modal
const evBox = document.getElementById('modal-evidencia');

// ESTO ES CLAVE: Borra CUALQUIER cosa que haya adentro antes de empezar
evBox.innerHTML = ''; 

if (data.evidencia && data.evidencia.trim() !== "") {
    console.log("Cargando imagen:", data.evidencia);
    
    const link = document.createElement('a');
    link.href = "/proyectoweb/" + data.evidencia;
    link.target = "_blank";

    const img = document.createElement('img');
    img.src = "/proyectoweb/" + data.evidencia;
    img.style.cssText = "max-width: 100%; height: 120px; border-radius: 8px; border: 1px solid #ddd; display: block; object-fit: contain; cursor: pointer;";
    
    // Si la imagen falla (ruta mal), ponemos un aviso
    img.onerror = function() {
        evBox.innerHTML = '<span class="text-danger small">Error al cargar la imagen.</span>';
    };

    link.appendChild(img);
    evBox.appendChild(link);
} else {
    evBox.innerHTML = '<span class="text-muted small">Sin evidencia adjunta</span>';
}

            // Guardar el ID real para el envío al back
            document.getElementById('btnGuardarSol').setAttribute('data-no-ref', data.no_ref);
            
            modal.classList.add('active');
        };
    });

    // Cerrar modal
    const cerrarModal = () => {
        modal.classList.remove('active');
        document.getElementById('modal-respuesta').value = '';
    };

    document.getElementById('btnCerrarModal').onclick = cerrarModal;
    document.getElementById('btnCancelarSol').onclick = cerrarModal;
});
</script>