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
                <p style="color: #b16e4b; font-weight: bold; font-size: 1.3rem; margin-bottom: 8px;">$<?=number_format($product->precio, 2)?></p>
                
                <!-- Formulario con selector de talla para el cliente -->
                <form action="<?=base_url?>carrito/add&id=<?=$product->id_producto?>" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="talla_destacados_<?=$product->id_producto?>" style="font-size: 0.8rem; color: #b16e4b; font-weight: bold; display: block; margin-bottom: 3px;">Selecciona tu Talla:</label>
                        <select name="talla" id="talla_destacados_<?=$product->id_producto?>" style="width: 100%; padding: 5px; border: 1px solid #f3abc8; border-radius: 4px; color: #4e1e04; font-weight: 500; background-color: #fff1f5;" required>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M" selected>M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <button type="submit" style="background: #f3abc8; color: white; padding: 8px 15px; border: none; border-radius: 4px; display: block; font-weight: bold; width: 100%; cursor: pointer;">Comprar 🛒</button>
                </form>
            </div>

        </div>
    <?php endwhile; ?>
</div>