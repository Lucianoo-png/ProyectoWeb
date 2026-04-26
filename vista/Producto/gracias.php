<?php include('vista/header_gral.php'); ?>
<div class="container my-5 py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 text-center">
            <div class="mb-4">
                <i class="fas fa-check-circle animate__animated animate__bounceIn" 
                   style="font-size: 5rem; color: #27ae60;"></i>
            </div>

            <h1 class="fw-bold mb-3" style="color: #2c3e50;">¡Muchas gracias por tu compra!</h1>
            <p class="lead text-muted mb-4">
                Tu pedido ha sido recibido y ya estamos trabajando en él. 
                Se ha enviado un correo electrónico con la confirmación.
            </p>

            <div class="card border-0 shadow-sm mb-5" style="border-radius: 15px; background: #f8f9fa;">
                <div class="card-body p-4">
                    <span class="text-uppercase small fw-bold text-muted d-block mb-2">Número de Referencia</span>
                    <h3 class="display-6 fw-bold" style="color: var(--btn-color, #007bff);">
                        <?php echo $mensaje_exito; ?>
                    </h3>
                    <hr class="my-4" style="opacity: 0.1;">
                    <div class="d-flex justify-content-around text-start">
                        <div>
                            <i class="fas fa-truck me-2 text-muted"></i>
                            <span class="small text-muted">Envío Estándar</span>
                        </div>
                        <div>
                            <i class="fas fa-calendar-alt me-2 text-muted"></i>
                            <span class="small text-muted"><?php echo date('d/m/Y'); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                <a href="/proyectoweb/?" class="btn btn-primary btn-lg px-5 shadow-sm" 
                   style="border-radius: 10px; font-weight: 600;">
                    Seguir comprando
                </a>
                <a href="/proyectoweb/mi-perfil/inicio" class="btn btn-outline-secondary btn-lg px-5" 
                   style="border-radius: 10px;">
                    Ver mi perfil
                </a>
            </div>
            
            <p class="mt-5 text-muted small">
                ¿Tienes alguna duda? <a href="/proyectoweb/contacto" class="text-decoration-none">Contáctanos</a>
            </p>
        </div>
    </div>
</div>
<?php include('vista/footer_gral.php'); ?>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        localStorage.removeItem('lc_carrito');
        localStorage.removeItem('direccion_envio_seleccionada');
        if (typeof actualizarBadge === 'function') {
            actualizarBadge();
        }
    });
</script>