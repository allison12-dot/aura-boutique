<h1>Resultados de la búsqueda: "<?= htmlspecialchars($_POST['busqueda'] ?? '') ?>"</h1>

<?php if (isset($productos) && $productos->num_rows > 0): ?>
    <div class="product-grid" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 20px;">
        <?php while ($product = $productos->fetch_object()): ?>
            <div class="product-card" style="background: white; border-radius: 12px; padding: 15px; width: 230px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); border: 1px solid #f3abc8;">
                <?php if ($product->imagen != null): ?>
                    <img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;" alt="<?= $product->nombre ?>">
                <?php else: ?>
                    <img src="<?= base_url ?>assets/img/camiseta.png" style="width: 100%; height: 180px; object-fit: cover; border-radius: 8px;" alt="Sin imagen">
                <?php endif; ?>
                
                <h2 style="font-size: 1.1rem; margin: 10px 0; color: #4e1e04;"><?= $product->nombre ?></h2>
                <p style="font-weight: bold; color: #bc8c6b; margin-bottom: 8px;">$<?= number_format($product->precio, 2) ?></p>
                
                <!-- Formulario con selector de talla para el cliente -->
                <form action="<?= base_url ?>carrito/add&id=<?= $product->id_producto ?>" method="POST">
                    <div style="margin-bottom: 10px;">
                        <label for="talla_busqueda_<?= $product->id_producto ?>" style="font-size: 0.8rem; color: #b16e4b; font-weight: bold; display: block; margin-bottom: 3px;">Selecciona tu Talla:</label>
                        <select name="talla" id="talla_busqueda_<?= $product->id_producto ?>" style="width: 100%; padding: 5px; border: 1px solid #f3abc8; border-radius: 4px; color: #4e1e04; font-weight: 500; background-color: #fff1f5;" required>
                            <option value="XS">XS</option>
                            <option value="S">S</option>
                            <option value="M" selected>M</option>
                            <option value="L">L</option>
                            <option value="XL">XL</option>
                        </select>
                    </div>
                    <button type="submit" style="display: inline-block; background: #c999af; color: white; padding: 8px 15px; border-radius: 6px; border: none; font-weight: bold; width: 100%; cursor: pointer;">Comprar 🛒</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>
<?php else: ?>
    <p style="text-align: center; margin-top: 30px; font-size: 1.1rem; color: #4e1e04;">No se encontraron productos que coincidan con tu búsqueda 🌸</p>
<?php endif; ?>