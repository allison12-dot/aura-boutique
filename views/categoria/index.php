<div style="max-width: 600px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px;">
    <h2 style="margin-bottom: 15px;">Gestionar Categorías</h2>
    
    <a href="<?=base_url?>categoria/crear" style="display: inline-block; background: #27ae60; color: white; padding: 8px 12px; text-decoration: none; border-radius: 4px; margin-bottom: 15px; font-weight: bold;">+ Crear Categoría</a>

    <table style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background: #2c3e50; color: white;">
                <th style="padding: 10px; text-align: left;">ID</th>
                <th style="padding: 10px; text-align: left;">Nombre</th>
            </tr>
        </thead>
        <tbody>
            <?php while($cat = $categorias->fetch_object()): ?>
                <tr style="border-bottom: 1px solid #ccc;">
                    <td style="padding: 10px;"><?= $cat->id_categoria ?></td>
                    <td style="padding: 10px;"><?= $cat->nombre ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>