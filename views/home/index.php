<div style="max-width: 800px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h1 style="color: #a8627a; text-align: center; margin-bottom: 25px;">Gestionar Categorías</h1>

    <div style="margin-bottom: 20px;">
        <a href="<?= base_url ?>categoria/crear" style="background-color: #2e8b57; color: white; padding: 10px 18px; border-radius: 5px; text-decoration: none; font-weight: bold; display: inline-block;">
            + Crear Categoría
        </a>
    </div>

    <table style="width: 100%; border-collapse: collapse; text-align: left; background: white; border: 1px solid #f2c4ce; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <thead>
            <tr style="background-color: #2c3e50; color: white;">
                <th style="padding: 12px; width: 15%;">ID</th>
                <th style="padding: 12px; width: 55%;">Nombre</th>
                <th style="padding: 12px; width: 30%; text-align: center;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($categorias) && $categorias->num_rows > 0): ?>
                <?php while ($cat = $categorias->fetch_object()): ?>
                    <tr style="border-bottom: 1px solid #ffe6eb;">
                        <td style="padding: 12px; font-weight: bold; color: #555;">
                            <?= $cat->id_categoria ?? $cat->id ?>
                        </td>
                        <td style="padding: 12px; color: #b87b8c;">
                            <?= htmlspecialchars($cat->nombre) ?>
                        </td>
                        <td style="padding: 12px; text-align: center;">
                            <a href="<?= base_url ?>categoria/delete&id=<?= $cat->id_categoria ?? $cat->id ?>" 
                               onclick="return confirm('¿Estás segura de que deseas eliminar la categoría <?= htmlspecialchars($cat->nombre) ?>?');" 
                               style="background-color: #d9534f; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 13px; display: inline-block;">
                               🗑️ Eliminar
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" style="padding: 15px; text-align: center; color: #888;">No hay categorías registradas.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>