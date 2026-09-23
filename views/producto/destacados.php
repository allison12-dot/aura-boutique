<h1 style="text-align: center; margin: 20px 0 30px 0; color: #b16e4b;">¡Algunos de nuestros productos!</h1>

<div style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; max-width: 1100px; margin: 0 auto;">
    <?php while($product = $productos->fetch_object()): ?>
        <div style="background: white; border: 1px solid #f3abc8; border-radius: 8px; padding: 15px; width: 230px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
            
            <!-- Recuadro Gris de la Imagen -->
            <div style="width: 100%; height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 6px; margin-bottom: 12px; overflow: hidden;">
                <?php if (!empty($product->imagen)): ?>
                    <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?=$product->nombre?>" style="width: 100%; height: 100%; object-fit: cover;">
                <?php else: ?>
                    <span style="color: #888; font-size: 0.9rem;">Sin imagen</span>
                <?php endif; ?>
            </div>

            <h3 style="font-size: 1.1rem; color: #b16e4b; margin-bottom: 8px; font-weight: 600;"><?=$product->nombre?></h3>
            <p style="color: #e47a9d; font-size: 0.9rem; margin-bottom: 10px; height: 40px; overflow: hidden;"><?=$product->descripcion?></p>

            <div>
                <p style="color: #b16e4b; font-weight: bold; font-size: 1.3rem; margin-bottom: 12px;">$<?=number_format($product->precio, 2)?></p>
                <a href="#" style="background: #f3abc8; color: white; padding: 8px 15px; text-decoration: none; border-radius: 4px; display: block; font-weight: bold;">Comprar</a>
            </div>

        </div>
    <?php endwhile; ?>
</div>