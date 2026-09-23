<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
    <h2 style="margin-bottom: 20px; color: #2c3e50;">Editar Producto: <?= $pro->nombre ?></h2>
    <?php $url_action = base_url . "Producto/save&id=" . $pro->id_producto; ?>
<?php else: ?>
    <h2 style="margin-bottom: 20px; color: #2c3e50;">Crear Nuevo Producto</h2>
    <?php $url_action = base_url . "Producto/save"; ?>
<?php endif; ?>

<div style="max-width: 500px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <form action="<?=base_url?>Producto/save" method="POST" enctype="multipart/form-data">
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre del producto:</label>
            <input type="text" name="nombre" value="<?= isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Descripción:</label>
            <textarea name="descripcion" rows="3" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;"><?= isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Precio ($):</label>
            <input type="number" step="0.01" name="precio" value="<?= isset($pro) && is_object($pro) ? $pro->precio : ''; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Stock / Unidades:</label>
            <input type="number" name="stock" value="<?= isset($pro) && is_object($pro) ? $pro->stock : ''; ?>" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>


        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Categoría:</label>
            <?php 
                require_once 'models/categoria.php';
                $cat_model = new Categoria();
                $categorias_lista = $cat_model->getAll();
            ?>
            <select name="categoria" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <?php while($cat = $categorias_lista->fetch_object()): ?>
                    <option value="<?=$cat->id_categoria?>" <?=isset($pro) && is_object($pro) && $cat->id_categoria == $pro->id_categoria ? 'selected' : ''?>>
                        <?=$cat->nombre?>
                    </option>
                <?php endwhile; ?>
            </select>
        </div>


        <div style="margin-bottom: 20px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Imagen del Producto:</label>
            <?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
                <img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" style="width: 80px; height: 80px; object-fit: cover;">
            <?php endif; ?>
            <input type="file" name="imagen" accept="image/*" style="width: 100%;">
        </div>

        <button type="submit" style="background: #c999af; color: white; padding: 10px 15px; border: none; border-radius: 4px; font-weight: bold; cursor: pointer; width: 100%;">Guardar Producto</button>
    </form>
</div>