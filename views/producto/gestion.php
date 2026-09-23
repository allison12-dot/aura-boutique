<div style="max-width: 1000px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
    <h2 style="margin-bottom: 15px; color: #2c3e50;">Gestión de Productos</h2>

    <a href="<?=base_url?>Producto/crear" style="display: inline-block; background: #cdb4db; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; margin-bottom: 15px; font-weight: bold;">+ Crear Producto</a>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #2c3e50; color: white;">
                <th style="padding: 10px; text-align: left;">ID</th>
                <th style="padding: 10px; text-align: left;">Nombre</th>
                <th style="padding: 10px; text-align: left;">Precio</th>
                <th style="padding: 10px; text-align: left;">Stock</th>
                <th style="padding: 10px; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while($pro = $productos->fetch_object()): ?>
                <?php $id_actual = $pro->id_producto ?? $pro->id; ?>
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding: 10px;"><?= $id_actual ?></td>
                    <td style="padding: 10px;"><?= $pro->nombre ?></td>
                    <td style="padding: 10px;">$<?= number_format($pro->precio, 2) ?></td>
                    <td style="padding: 10px;"><?= isset($pro->stock) ? $pro->stock : ($pro->unidades ?? 0) ?></td>
                    <td style="padding: 10px; text-align: center;">
                        <a href="<?=base_url?>Producto/editar&id=<?=$id_actual?>" style="background: #3498db; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; margin-right: 5px; font-size: 0.85rem;" title="Editar">✏️ Editar</a>
                        <a href="<?=base_url?>Producto/eliminar&id=<?=$id_actual?>" onclick="return confirm('¿Estás seguro de eliminar este producto?')" style="background: #e74c3c; color: white; padding: 5px 10px; text-decoration: none; border-radius: 4px; font-size: 0.85rem;" title="Eliminar">🗑️ Eliminar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>