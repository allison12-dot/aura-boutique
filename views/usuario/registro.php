<h2>Registrarse en Aura Boutique</h2>

<form action="<?=base_url?>usuario/save" method="POST" style="max-width: 400px; margin: 20px 0;">
    <div style="margin-bottom: 15px;">
        <label for="nombre" style="display:block; margin-bottom: 5px;">Nombre:</label>
        <input type="text" name="nombre" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="apellidos" style="display:block; margin-bottom: 5px;">Apellidos:</label>
        <input type="text" name="apellidos" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display:block; margin-bottom: 5px;">Email:</label>
        <input type="email" name="email" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="password" style="display:block; margin-bottom: 5px;">Contraseña:</label>
        <input type="password" name="password" required style="width: 100%; padding: 8px;">
    </div>

    <button type="submit" style="background: #c999af; color: white; border: none; padding: 10px 20px; cursor: pointer;">
        Registrarse
    </button>
</form>