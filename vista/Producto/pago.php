<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LuchanosCorp | Pago</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.14.0/js/all.js"></script>
    <link rel="stylesheet" href="../../estilos/styles.css">
</head>
<body class="checkout-bg">

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
            </div>
        </div>
    </div>

    <!-- Navbar -->
    <div class="main-nav">
        <div class="container d-flex align-items-center gap-3">
            <a href="../../index.php" class="brand-logo me-3">
                <span class="electro">Luchanos</span><span class="pendejo">Corp</span>
            </a>
            <div class="input-group search-bar flex-grow-1 mx-lg-4">
                <input type="text" class="form-control" placeholder="¿Qué estás buscando?">
                <button class="btn px-4"><i class="fas fa-search"></i></button>
            </div>
            <div class="d-flex align-items-center gap-3 ms-2">
                <a href="carrito.php" class="nav-icon" title="Carrito">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cart-count" style="display:none">0</span>
                </a>
                <a href="../Cuenta/login.php" class="nav-icon" title="Mi Cuenta">
                    <i class="fas fa-user"></i>
                </a>
            </div>
        </div>
    </div>

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
    <div class="pago-layout">

        <!-- ── Columna izquierda: formulario ── -->
        <div>
            <!-- Dirección seleccionada -->
            <div class="pago-card mb-3">
                <h5><i class="fas fa-map-marker-alt me-2" style="color:var(--btn-color)"></i>Enviando a</h5>
                <div class="pago-dir-box">
                    <i class="fas fa-home mt-1"></i>
                    <div>
                        <div class="pago-dir-nombre" id="pago-dir-nombre">—</div>
                        <div class="pago-dir-detalle" id="pago-dir-detalle">—</div>
                        <a href="direccion.php" class="pago-dir-cambiar">
                            <i class="fas fa-pencil-alt me-1"></i>Cambiar dirección
                        </a>
                    </div>
                </div>
            </div>

            <!-- Método de pago -->
            <div class="pago-card">
                <h5><i class="fas fa-lock me-2" style="color:var(--btn-color)"></i>Método de pago</h5>

                <!-- Selector de método -->
                <div class="pago-metodos">
                    <button class="pago-metodo-btn active" onclick="setMetodo('tarjeta', this)">
                        <i class="fas fa-credit-card"></i>Tarjeta
                    </button>
                    <button class="pago-metodo-btn" onclick="setMetodo('oxxo', this)">
                        <i class="fas fa-store"></i>OXXO
                    </button>
                    <button class="pago-metodo-btn" onclick="setMetodo('transferencia', this)">
                        <i class="fas fa-university"></i>Transferencia
                    </button>
                    <button class="pago-metodo-btn" onclick="setMetodo('efectivo', this)">
                        <i class="fas fa-money-bill-wave"></i>Efectivo
                    </button>
                </div>

                <!-- ══ Panel: Tarjeta ══════════════════ -->
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
                               oninput="formatCardNumber(this)" onfocus="flipCard(false)">
                    </div>
                    <div class="pago-group">
                        <label>Nombre del titular</label>
                        <input type="text" id="cardName" class="pago-input"
                               placeholder="Como aparece en tu tarjeta"
                               oninput="updateCardName(this)" onfocus="flipCard(false)">
                    </div>
                    <div class="pago-row">
                        <div class="pago-group">
                            <label>Fecha de vencimiento</label>
                            <input type="text" id="cardExp" class="pago-input"
                                   placeholder="MM/AA" maxlength="5"
                                   oninput="formatExp(this)" onfocus="flipCard(false)">
                        </div>
                        <div class="pago-group">
                            <label>CVV</label>
                            <input type="text" id="cardCvv" class="pago-input"
                                   placeholder="•••" maxlength="4"
                                   oninput="updateCvv(this)"
                                   onfocus="flipCard(true)" onblur="flipCard(false)">
                        </div>
                    </div>
                </div>

                <!-- ══ Panel: OXXO ══════════════════════ -->
                <div class="pago-panel" id="panel-oxxo">
                    <div class="oxxo-info">
                        <p>
                            Al confirmar tu pedido recibirás una referencia de pago.<br>
                            Acude a cualquier tienda <strong>OXXO</strong> y realiza tu pago en caja.<br>
                            Tu pedido se procesará en un plazo de <strong>1–2 horas</strong> después de confirmar el pago.
                        </p>
                        <div class="oxxo-ref">OXXO-2026-XXXX</div>
                        <p style="font-size:.75rem;color:#888;text-align:center;margin-top:0">
                            La referencia se generará al confirmar.
                        </p>
                    </div>
                </div>

                <!-- ══ Panel: Transferencia ════════════ -->
                <div class="pago-panel" id="panel-transferencia">
                    <div class="trans-info">
                        <p>
                            Realiza una transferencia o depósito a la siguiente cuenta y envía tu comprobante a
                            <strong>pagos@LuchanosCorp.com</strong><br><br>
                            Banco: <span class="trans-data">BBVA México</span><br>
                            Titular: <span class="trans-data">LuchanosCorp S.A. de C.V.</span><br>
                            CLABE: <span class="trans-data">012 XXX XXXX XXXX XX XX X</span><br>
                            Número de cuenta: <span class="trans-data">1234 5678 9012</span>
                        </p>
                    </div>
                </div>

                <!-- ══ Panel: Efectivo ═════════════════ -->
                <div class="pago-panel" id="panel-efectivo">
                    <div class="oxxo-info" style="background:#e8f5e9;border-color:#a5d6a7;">
                        <p style="color:#1b5e20;">
                            Puedes pagar en efectivo al momento de recibir tu pedido.<br>
                            El repartidor llegará con terminal punto de venta.<br>
                            <strong>Costo adicional por pago en efectivo: $0.00 MXN</strong>
                        </p>
                    </div>
                </div>

                <!-- Botón confirmar -->
                <button class="btn-confirmar" id="btnConfirmar" onclick="confirmarPedido()">
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

        <!-- ── Columna derecha: resumen ── -->
        <div class="pago-resumen">
            <div class="pago-card">
                <h5><i class="fas fa-receipt me-2" style="color:var(--btn-color)"></i>Resumen del pedido</h5>

                <div id="resumen-items">
                    <!-- Renderizado por JS -->
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
            <a href="../../index.php" class="btn-exito-ok">
                <i class="fas fa-home me-1"></i>Volver al inicio
            </a>
        </div>
    </div>

    <footer class="site-footer-minimal">© 2026 LuchanosCorp S.A. Todos los derechos reservados.</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../js/scripts.js"></script>
    <!--<script src="../../js/pago.js"></script>-->
</body>
</html>