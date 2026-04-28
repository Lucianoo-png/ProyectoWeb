<div class="checkout-bg">

    <?php include('vista/header_gral.php'); ?>
    <!-- Pasos del checkout -->
    <div class="checkout-steps">
        <div class="step done">
            <div class="step-circle"><i class="fas fa-shopping-cart"></i></div>
            <div class="step-label">Carro de Compras</div>
        </div>
        <div class="step-line done"></div>
        <div class="step done">
            <div class="step-circle"><i class="fas fa-info-circle"></i></div>
            <div class="step-label">Información de Envío</div>
        </div>
        <div class="step-line done"></div>
        <div class="step active">
            <div class="step-circle"><i class="fas fa-credit-card"></i></div>
            <div class="step-label">Pago</div>
        </div>
    </div>

    <!-- ═══ Layout principal ═══════════════════════════════════ -->
      <?php if(isset($_REQUEST["pagar"]) && isset($msj)): ?>
    <div id="contenedor-alertas" style="position: fixed !important; top: 80px !important; left: 50% !important; transform: translateX(-50%) !important; z-index: 999999 !important; display: flex !important; flex-direction: column !important; align-items: center !important; gap: 12px !important; pointer-events: none !important; width: 100% !important; margin: 0 !important;">
        
        <div class="alerta alerta-<?php echo $msj[0]; ?> shadow animate__animated animate__fadeInDown" 
             style="position: relative !important; pointer-events: auto !important; margin: 0 !important; padding: 15px !important; display: flex !important; align-items: center !important; justify-content: space-between !important; border-radius: 8px !important; width: 350px !important; max-width: 90vw !important; box-sizing: border-box !important;">
            
            <div style="display: flex; align-items: center; gap: 12px; flex-grow: 1;">
                <i class="fas <?php echo ($msj[0] === 'exito') ? 'fa-check-circle' : 'fa-times-circle'; ?>" style="font-size: 1.3rem;"></i>
                
                <div style="font-weight: 600; font-size: 0.95rem; line-height: 1.3;">
                    <?php echo $msj[1]; ?>
                </div>
            </div>
            
            <button type="button" style="background: none; border: none; font-size: 1.5rem; cursor: pointer; opacity: 0.6; padding: 0; line-height: 1; color: inherit;" onclick="this.parentElement.remove()">&times;</button>
        </div>
    </div>

<?php endif; ?>
    <div class="pago-layout">

    <form action="/proyectoweb/pago" method="POST">

        <!-- ── Columna izquierda: Método de pago (el grande) ── -->
        <div class="pago-col-main">
            <input type="hidden" name="id_direccion" id="form-id-direccion">
            <input type="hidden" name="items_json" id="form-items-json">
            <div class="pago-card">
                <h5><i class="fas fa-lock me-2" style="color:var(--btn-color)"></i>Método de pago</h5>

                <!-- Selector de método -->
                <div class="pago-metodos">
                    <button class="pago-metodo-btn active" onclick="setMetodo('tarjeta', this)">
                        <i class="fas fa-credit-card"></i>Tarjeta
                    </button>
                </div>

                <!-- Panel: Tarjeta -->
                <div class="pago-panel active" id="panel-tarjeta">
                    <!-- Vista previa de tarjeta -->
                    <div class="card-preview">
                        <div class="card-inner" id="cardInner">
                            <div class="card-front">
                                <div class="card-chip"></div>
                                <div class="card-logo" id="cardLogoFront">
                                    <i class="fab fa-cc-visa"></i>
                                </div>
                                <div class="card-number" id="cardNumberDisplay">•••• •••• •••• ••••</div>
                                <div class="card-info-row">
                                    <div>
                                        <div class="card-label">Titular</div>
                                        <div class="card-value" id="cardNameDisplay">NOMBRE APELLIDO</div>
                                    </div>
                                    <div>
                                        <div class="card-label">Vence</div>
                                        <div class="card-value" id="cardExpDisplay">MM/AA</div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-back">
                                <div class="card-strip"></div>
                                <div class="card-cvv-area">
                                    <div class="card-cvv-label">CVV</div>
                                    <div class="card-cvv-box" id="cardCvvDisplay">•••</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Íconos aceptados -->
                    <div class="tarjetas-aceptadas">
                        <span style="font-size:.72rem;color:#999">Aceptamos:</span>
                        <i class="fab fa-cc-visa tarjeta-icon"></i>
                        <i class="fab fa-cc-mastercard tarjeta-icon"></i>
                        <i class="fab fa-cc-amex tarjeta-icon"></i>
                    </div>

                    <!-- Campos -->
                    <div class="pago-group">
                        <label>Número de tarjeta</label>
                        <input type="text" id="cardNumber" class="pago-input"
                               placeholder="1234 5678 9012 3456" maxlength="19"
                               oninput="formatCardNumber(this)" name="numero" onfocus="flipCard(false)">
                    </div>
                    <div class="pago-group">
                        <label>Nombre del titular</label>
                        <input type="text" id="cardName" class="pago-input"
                               placeholder="Como aparece en tu tarjeta"
                               oninput="updateCardName(this)" name="titular" onfocus="flipCard(false)">
                    </div>
                    <div class="pago-row">
                        <div class="pago-group">
                            <label>Fecha de vencimiento</label>
                            <input type="text" id="cardExp" class="pago-input"
                                   placeholder="MM/AA" maxlength="5" name="fecha_vencimiento"
                                   oninput="formatExp(this)" onfocus="flipCard(false)">
                        </div>
                        <div class="pago-group">
                            <label>CVV</label>
                            <input type="text" id="cardCvv" class="pago-input"
                                   placeholder="•••" minlength="3" maxlength="4" name="cvv"
                                   oninput="updateCvv(this)"
                                   onfocus="flipCard(true)" onblur="flipCard(false)">
                        </div>
                    </div>
                </div>

                <!-- Botón confirmar -->
                <button type="submit" name="pagar" class="btn-confirmar" id="btnConfirmar">
                    <span class="btn-confirmar-text">
                        <i class="fas fa-lock me-1"></i>Confirmar y Pagar
                    </span>
                    <div class="spinner-confirmar"></div>
                </button>

                <div class="seguridad-badge">
                    <i class="fas fa-shield-alt"></i>
                    Pago seguro con cifrado SSL de 256 bits
                </div>
            </div>
        </div>

        <!-- ── Columna derecha: los dos chicos apilados ── -->
        <div class="pago-resumen">

            <!-- Dirección seleccionada -->
            <div class="pago-card">
                <h5><i class="fas fa-map-marker-alt me-2" style="color:var(--btn-color)"></i>Enviando a</h5>
                <div class="pago-dir-box">
                    <i class="fas fa-home mt-1"></i>
                    <div>
                        <div class="pago-dir-nombre" id="pago-dir-nombre">—</div>
                        <div class="pago-dir-detalle" id="pago-dir-detalle">—</div>
                        <a href="/proyectoweb/envio" class="pago-dir-cambiar">
                            <i class="fas fa-pencil-alt me-1"></i>Cambiar dirección
                        </a>
                    </div>
                </div>
            </div>

            <!-- Resumen del pedido -->
            <div class="pago-card">
                <h5><i class="fas fa-receipt me-2" style="color:var(--btn-color)"></i>Resumen del pedido</h5>

                <div id="resumen-items">
                    <div class="resumen-empty">
                        <i class="fas fa-shopping-cart"></i>
                        Cargando artículos...
                    </div>
                </div>

                <div class="resumen-totales" id="resumen-totales" style="display:none">
                    <div class="resumen-linea">
                        <span>Subtotal</span>
                        <span id="res-subtotal">$0.00</span>
                    </div>
                    <div class="resumen-linea">
                        <span>Envío</span>
                        <span style="color:#27ae60;font-weight:600">GRATIS</span>
                    </div>
                    <div class="resumen-linea">
                        <span>IVA (16%)</span>
                        <span id="res-iva">$0.00</span>
                    </div>
                    <div class="resumen-linea total">
                        <span>Total</span>
                        <span id="res-total">$0.00</span>
                    </div>
                </div>
            </div>

        </div>
    </form>
    </div>

    <!-- ═══ Modal de confirmación exitosa ═══ -->
    <div id="modal-exito">
        <div class="exito-card">
            <div class="exito-icon">
                <i class="fas fa-check"></i>
            </div>
            <h4>¡Pedido confirmado!</h4>
            <p>Gracias por tu compra. Recibirás un correo con los detalles de tu pedido.</p>
            <div class="exito-ref" id="exito-ref-num">LC-00000000</div>
            <p style="font-size:.8rem;color:#999;margin-bottom:1.2rem">
                Guarda este número para rastrear tu pedido.
            </p>
            <a href="/proyectoweb/?" class="btn-exito-ok">
                <i class="fas fa-home me-1"></i>Volver al inicio
            </a>
        </div>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

 <script>
const NOMBRE_REAL_CLIENTE = "<?php echo $nombreReal; ?>";


document.addEventListener('DOMContentLoaded', () => {
    if (typeof renderResumenPago === 'function') renderResumenPago();
    const rawDir = localStorage.getItem('direccion_envio_seleccionada');
    
    if (rawDir && rawDir !== "undefined") {
        try {
            const dir = JSON.parse(rawDir);
            cargarDir(dir);
        } catch (e) {
            console.error("Error al parsear dirección:", e);
            window.location.href = '/proyectoweb/envio';
        }
    } else {
        window.location.href = '/proyectoweb/envio';
    }
});

function cargarDir(dir) {
    const nombreEl  = document.getElementById('pago-dir-nombre');
    const detalleEl = document.getElementById('pago-dir-detalle');
    
    if (!dir || !nombreEl || !detalleEl) return;

    nombreEl.textContent = NOMBRE_REAL_CLIENTE;
    detalleEl.innerHTML = `
        ${dir.calle_numero || 'Calle no especificada'}<br>
        Col. ${dir.colonia || ''}, C.P. ${dir.cp || ''}<br>
        ${dir.ciudad || ''}, ${dir.estado || ''}, ${dir.pais || 'México'}
    `;
}

document.querySelector('form').onsubmit = function() {
    const dir = JSON.parse(localStorage.getItem('direccion_envio_seleccionada'));
    const carrito = obtenerCarrito();
    
    if(!dir) {
        mostrarAlerta('error', 'Por favor selecciona una dirección de envío');
        return false;
    }
    
    document.getElementById('form-id-direccion').value = dir.no_dirección;
    document.getElementById('form-items-json').value = JSON.stringify(carrito);

   
    return true;
};

</script>