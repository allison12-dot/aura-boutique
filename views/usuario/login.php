<div style="max-width: 400px; margin: 0 auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
    <h2 style="text-align: center; margin-bottom: 20px; color: #2c3e50;">Iniciar Sesión</h2>

    <?php if (isset($_SESSION['error_login'])): ?>
        <p style="color: red; text-align: center; margin-bottom: 15px;"><?= $_SESSION['error_login'] ?></p>
        <?php unset($_SESSION['error_login']); ?>
    <?php endif; ?>

    <form action="<?= base_url ?>usuario/loginProcess" method="POST" style="display: flex; flex-direction: column; gap: 15px;">
        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Correo Electrónico:</label>
            <input type="email" name="email" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <div>
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Contraseña:</label>
            <input type="password" name="password" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>

        <button type="submit" style="background: #c999af; color: white; border: none; padding: 10px; border-radius: 4px; cursor: pointer; font-weight: bold; margin-top: 10px;">Ingresar</button>
    </form>
</div>