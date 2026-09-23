<?php require_once 'views/layout/header.php'; ?>

<h1 style="text-align: center; margin: 25px 0; color: #b16e4b;">Catálogo de Productos</h1>

<div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; max-width: 1200px; margin: 0 auto; padding: 0 15px;">
    <?php if ($productos && $productos->num_rows > 0): ?>
        <?php while($product = $productos->fetch_object()): ?>
            <div style="background: white; border: 1px solid #f3abc8; border-radius: 8px; padding: 15px; width: 230px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
                
                <!-- Recuadro de la Imagen -->
                <div style="width: 100%; height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 6px; margin-bottom: 12px; overflow: hidden;">
                    <?php if (!empty($product->imagen)): ?>
                        <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?=$product->nombre?>" style="width: 100%; height: 100%; object-fit: cover;">
                    <?php else: ?>
                        <span style="color: #888; font-size: 0.9rem;">Sin imagen</span>
                    <?php endif; ?>
                </div>

                <h3 style="font-size: 1.1rem; color: #b16e4b; margin-bottom: 8px; font-weight: 600;"><?=$product->nombre?></h3>
                <p style="color: #e47a9d; font-size: 0.85rem; margin-bottom: 10px; height: 38px; overflow: hidden;"><?=$product->descripcion?></p>

                <div>
                    <p style="color: #b16e4b; font-weight: bold; font-size: 1.2rem; margin-bottom: 12px;">$<?=number_format($product->precio, 2)?></p>
                    <a href="<?=base_url?>carrito/add&id=<?=$product->id_producto?>" style="background: #f3abc8; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; display: block; font-weight: bold;">Comprar</a>
                </div>

            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p style="text-align: center; color: #888;">No hay productos disponibles en el catálogo por el momento.</p>
    <?php endif; ?>
</div>

<?php require_once 'views/layout/footer.php'; ?>