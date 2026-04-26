

<?php include('vista/header_gral.php'); ?>

<main class="py-4">
    <div class="container">

        <?php 
$productoControl = new ProductoControlador();
$productosSlider = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true' AND imagen IS NOT NULL", 
    "order" => "no_producto ASC",
    "limit" => 5
]);

$totalSlider = is_array($productosSlider) ? count($productosSlider) : 0;
?>



<div id="heroCarousel" class="carousel slide hero-carousel mb-5" data-bs-ride="carousel">
    
    <div class="carousel-indicators">
        <?php for($i = 0; $i < $totalSlider; $i++): ?>
            <button type="button" data-bs-target="#heroCarousel" 
                    data-bs-slide-to="<?php echo $i; ?>" 
                    class="<?php echo ($i === 0) ? 'active' : ''; ?>" 
                    aria-current="<?php echo ($i === 0) ? 'true' : 'false'; ?>">
            </button>
        <?php endfor; ?>
    </div>

    <div class="carousel-inner">
        <?php if($totalSlider > 0): ?>
            <?php foreach($productosSlider as $index => $prodSlider): 
                $imgPath = "/proyectoweb/public/uploads/img/" . $prodSlider['imagen'];
                $activeClass = ($index === 0) ? 'active' : '';
            ?>
                <div class="carousel-item <?php echo $activeClass; ?>">
                    <a href="/proyectoweb/producto/<?php echo $prodSlider['no_producto']; ?>">
                    <img src="<?php echo $imgPath; ?>" class="d-block w-100" alt="<?php echo $prodSlider['nombre']; ?>"
                         style="object-fit: cover; height: 500px;"
                         onerror="this.style.background='linear-gradient(135deg,#002366 0%,#4b7dd9 100%)';this.removeAttribute('src')">
                    
                    <div class="carousel-caption">
                        <h5 class="fw-bold"><?php echo $prodSlider['nombre']; ?></h5>
                        <p><?php echo substr($prodSlider['descripción'], 0, 100) . '...'; ?></p>
                    </div></a>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Anterior</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Siguiente</span>
    </button>
</div>

        <div class="mb-2"><span class="section-title">Productos Destacados</span></div>
        <?php 
$productoControl = new ProductoControlador();
$destacados = $productoControl->getProducto()->buscar('"Veracruz".producto', [
    "where" => "stock > 0 AND estatus='true'", 
    "order" => "no_producto ASC",
    "limit" => 4
]);
?>

<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3 mb-5">
    <?php 
    if(is_array($destacados) && count($destacados) > 0):
        foreach($destacados as $prod): 
            $nombre = $prod['nombre'];
            $precio = '$' . number_format($prod['precio_venta'], 2);
            $sku = Helpers::crearSKU($prod['categoria'], $nombre);
            $id = $prod['no_producto'];
            
            $imgProd = "/proyectoweb/public/uploads/img/" . $prod['imagen'];
            $placeholder = "https://placehold.co/300x250?text=" . urlencode($prod['categoria']);
    ?>
        <div class="col">
            <div class="product-card">
                <div class="product-img-wrap">
                    <img src="<?php echo $imgProd; ?>" 
                         alt="<?php echo $nombre; ?>" 
                         onerror="this.src='<?php echo $placeholder; ?>'">
                </div>
                <div class="product-body">
                    <span class="product-sku"><?php echo $sku; ?></span>
                    <p class="product-name"><?php echo $nombre; ?></p>
                    <div class="product-price-row">
                        <span class="product-price"><?php echo $precio; ?></span>
                    </div>
                </div>
                <a href="/proyectoweb/producto/<?php echo $id; ?>" class="btn-mas-info">
                    Más información
                </a>
            </div>
        </div>
    <?php 
        endforeach; 
    else:
    ?>
        <div class="col-12 text-center py-5">
            <p class="text-muted">Próximamente nuevos productos destacados.</p>
        </div>
    <?php endif; ?>
</div>

    </div>
</main>

<?php include('vista/footer_gral.php'); ?>