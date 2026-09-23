<?php require_once 'views/layout/header.php'; ?>

<h1 style="text-align: center; margin: 25px 0; color: #b16e4b;">Carrito de Compras</h1>

<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0): ?>
    
    <table style="width: 90%; max-width: 1000px; margin: 0 auto 30px auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <thead>
            <tr style="background-color: #f3abc8; color: white; text-align: left;">
                <th style="padding: 12px 15px;">Imagen</th>
                <th style="padding: 12px 15px;">Nombre</th>
                <th style="padding: 12px 15px;">Precio</th>
                <th style="padding: 12px 15px;">Unidades</th>
                <th style="padding: 12px 15px;">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $stats = Utils::statsCarrito();
                foreach ($carrito as $indice => $elemento): 
                    $producto = $elemento['producto'];
            ?>
                <tr style="border-bottom: 1px solid #eee;">
                    <td style="padding: 10px 15px;">
                        <?php if ($producto->imagen != null): ?>
                            <img src="<?=base_url?>uploads/images/<?=$producto->imagen?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                        <?php else: ?>
                            <span style="color: #888; font-size: 0.8rem;">Sin imagen</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 10px 15px; font-weight: bold; color: #4a4a4a;">
                        <a href="<?=base_url?>producto/ver&id=<?=$producto->id_producto?>" style="color: #b16e4b; text-decoration: none;">
                            <?=$producto->nombre?>
                        </a>
                    </td>
                    <td style="padding: 10px 15px; color: #b16e4b; font-weight: bold;">
                        $<?=number_format($producto->precio, 2)?>
                    </td>
                    <td style="padding: 10px 15px;">
                        <a href="<?=base_url?>carrito/up&index=<?=$indice?>" style="padding: 2px 8px; background: #eee; text-decoration: none; color: #333; font-weight: bold; border-radius: 3px;">+</a>
                        <span style="margin: 0 8px; font-weight: bold;"><?=$elemento['unidades']?></span>
                        <a href="<?=base_url?>carrito/down&index=<?=$indice?>" style="padding: 2px 8px; background: #eee; text-decoration: none; color: #333; font-weight: bold; border-radius: 3px;">-</a>
                    </td>
                    <td style="padding: 10px 15px;">
                        <a href="<?=base_url?>carrito/delete&index=<?=$indice?>" style="color: #cdb4db; text-decoration: none; font-weight: bold;">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div style="width: 90%; max-width: 1000px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
        <div>
            <a href="<?=base_url?>carrito/delete_all" style="background: #cdb4db; color: white; padding: 10px 18px; text-decoration: none; border-radius: 5px; font-weight: bold;">Vaciar Carrito</a>
        </div>
        <div style="text-align: right;">
            <h3 style="color: #b16e4b; margin-bottom: 10px;">Total: $<?=number_format($stats['total'], 2)?></h3>
            <a href="<?=base_url?>pedido/hacer" style="background: #f3abc8; color: white; padding: 12px 25px; text-decoration: none; border-radius: 5px; font-weight: bold; display: inline-block;">Hacer Pedido</a>
        </div>
    </div>

<?php else: ?>
    <div style="text-align: center; margin: 40px 0;">
        <p style="color: #888; font-size: 1.1rem; margin-bottom: 20px;">El carrito está vacío, ¡añade algún producto!</p>
        <a href="<?=base_url?>producto/catalogo" style="background: #f3abc8; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; font-weight: bold;">Ir al Catálogo</a>
    </div>
<?php endif; ?>

<?php require_once 'views/layout/footer.php'; ?>