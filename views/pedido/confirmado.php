<?php require_once 'views/layout/header.php'; ?>

<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
    <div style="text-align: center; margin: 50px 0;">
        <h1 style="color: #b16e4b;">🎉 ¡Tu pedido ha sido confirmado!</h1>
        <p style="color: #666; font-size: 1.1rem; margin: 15px 0;">Tu pedido se ha guardado con éxito. Procesaremos el envío a la brevedad.</p>
        <a href="<?=base_url?>producto/catalogo" style="background: #f3abc8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Seguir Comprando</a>
    </div>
<?php else: ?>
    <div style="text-align: center; margin: 50px 0;">
        <h1 style="color: #e74a3c;">❌ El pedido no ha podido procesarse</h1>
        <p style="color: #666; margin-bottom: 20px;">Revisa los datos e inténtalo nuevamente.</p>
        <a href="<?=base_url?>carrito/index" style="background: #f3abc8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Volver al Carrito</a>
    </div>
<?php endif; ?>

<?php require_once 'views/layout/footer.php'; ?>