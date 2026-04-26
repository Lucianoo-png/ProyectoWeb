<?php include('vista/header_gral.php'); ?>
    <!-- Pasos del checkout -->
    <div class="checkout-steps">
        <div class="step done">
            <div class="step-circle"><i class="fas fa-shopping-cart"></i></div>
            <div class="step-label">Carro de Compras</div>
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle"><i class="fas fa-info-circle"></i></div>
            <div class="step-label">Información de Envío</div>
        </div>
        <div class="step-line"></div>
        <div class="step">
            <div class="step-circle"><i class="fas fa-credit-card"></i></div>
            <div class="step-label">Pago</div>
        </div>
    </div>

    <!-- Contenido -->
    <div class="dir-layout">
        <div class="dir-card">
            <h5><i class="fas fa-map-marker-alt me-2" style="color:var(--btn-color)"></i>Dirección de envío</h5>
            <p class="dir-subtitle">Recibe tu pedido en cualquier dirección del país.</p>

            <div class="dir-instrucciones">
                ¿Se encuentra la dirección que quieres utilizar desplegada a continuación?<br>
                Si es así, haz click en el botón <strong>"ENVIAR AQUÍ"</strong>.
            </div>

            <div class="dir-address-card" id="dir-card-1">
                <div class="dir-address-name" id="dir-nombre-display">Cargando...</div>
                <div class="dir-address-detail" id="dir-detalle-display"></div>
                <div class="dir-address-actions">
                    <button class="btn-enviar-aqui" onclick="seleccionarYEnviar(0)">ENVIAR AQUÍ</button>
                </div>
            </div>

            <a href="#" class="ver-todas-link" onclick="verTodasDirecciones(event)">
                <i class="fas fa-list me-1"></i> Ver todas mis direcciones
            </a>
        </div>
    </div>

    <!-- ════════════════════════════════════════════════════════
         Modal: Ver todas mis direcciones
    ════════════════════════════════════════════════════════ -->
    <div id="modal-todas-dirs">
        <div class="modal-todas-dirs-card">
            <div class="modal-todas-dirs-header">
                <h6><i class="fas fa-map-marked-alt me-2"></i>Todas mis direcciones</h6>
                <button onclick="cerrarTodasDirs()">&times;</button>
            </div>
            <div class="modal-todas-dirs-body">
                <div id="todas-dirs-lista">
                    <!-- Renderizado por JS -->
                </div>
            </div>
        </div>
    </div>
<?php include('vista/footer_gral.php'); ?>
