<div style="max-width: 400px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px;">
    <h2 style="margin-bottom: 15px;">Crear Nueva Categoría</h2>

    <form action="<?=base_url?>categoria/save" method="POST">
        <label style="display: block; margin-bottom: 5px; font-weight: bold;">Nombre de la Categoría:</label>
        <input type="text" name="nombre" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 15px;">

        <button type="submit" style="background: #2c3e50; color: white; border: none; padding: 10px 15px; border-radius: 4px; cursor: pointer; font-weight: bold;">Guardar</button>
    </form>
</div>