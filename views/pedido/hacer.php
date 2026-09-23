<?php require_once 'views/layout/header.php'; ?>

<?php if (isset($_SESSION['identity'])): ?>
    <h1 style="text-align: center; margin: 25px 0; color: #b16e4b;">Hacer Pedido</h1>
    <p style="text-align: center; color: #666;">Por favor, ingresa los datos para el envío de tu compra.</p>

    <div style="max-width: 500px; margin: 30px auto; background: white; padding: 25px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <form action="<?=base_url?>pedido/add" method="POST">
            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #b16e4b; font-weight: bold; margin-bottom: 5px;">Departamento:</label>
                <input type="text" name="departamento" required style="width: 100%; padding: 8px; border: 1px solid #f3abc8; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 15px;">
                <label style="display: block; color: #b16e4b; font-weight: bold; margin-bottom: 5px;">Ciudad / Municipio:</label>
                <input type="text" name="ciudad" required style="width: 100%; padding: 8px; border: 1px solid #f3abc8; border-radius: 4px; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; color: #b16e4b; font-weight: bold; margin-bottom: 5px;">Dirección de residencia:</label>
                <input type="text" name="direccion" required style="width: 100%; padding: 8px; border: 1px solid #f3abc8; border-radius: 4px; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; background: #f3abc8; color: white; padding: 10px; border: none; border-radius: 5px; font-weight: bold; cursor: pointer; font-size: 1rem;">Confirmar Pedido</button>
        </form>
    </div>

<?php else: ?>
    <div style="text-align: center; margin: 40px 0;">
        <h1 style="color: #b16e4b;">Necesitas estar identificado</h1>
        <p style="color: #666; margin-bottom: 20px;">Debes iniciar sesión para poder realizar un pedido en la tienda.</p>
        <a href="<?=base_url?>usuario/login" style="background: #f3abc8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Iniciar Sesión</a>
    </div>
<?php endif; ?>

<?php require_once 'views/layout/footer.php'; ?>