<?php require_once 'views/layout/header.php'; ?>

<div style="max-width: 1000px; margin: 30px auto; font-family: Arial, sans-serif;">
    <h1 style="color: #a8627a; text-align: center; margin-bottom: 25px;">📊 Panel de Control - Aura Boutique</h1>

    <!-- Tarjetas de Estadísticas -->
    <div style="display: flex; gap: 20px; justify-content: space-between; margin-bottom: 30px; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 200px; background: #fff0f5; border: 1px solid #f2c4ce; border-radius: 10px; padding: 20px; text-align: center;">
            <h3 style="color: #a8627a; margin: 0;">🛍️ Productos</h3>
            <p style="font-size: 28px; font-weight: bold; color: #333; margin: 10px 0 0 0;"><?= $num_productos ?></p>
        </div>

        <div style="flex: 1; min-width: 200px; background: #fff0f5; border: 1px solid #f2c4ce; border-radius: 10px; padding: 20px; text-align: center;">
            <h3 style="color: #a8627a; margin: 0;">📦 Pedidos</h3>
            <p style="font-size: 28px; font-weight: bold; color: #333; margin: 10px 0 0 0;"><?= $num_pedidos ?></p>
        </div>

        <div style="flex: 1; min-width: 200px; background: #fff0f5; border: 1px solid #f2c4ce; border-radius: 10px; padding: 20px; text-align: center;">
            <h3 style="color: #a8627a; margin: 0;">💰 Ventas</h3>
            <p style="font-size: 28px; font-weight: bold; color: #2e7d32; margin: 10px 0 0 0;">$<?= number_format($total_ventas, 0, ',', '.') ?></p>
        </div>

        <div style="flex: 1; min-width: 200px; background: #fff0f5; border: 1px solid #f2c4ce; border-radius: 10px; padding: 20px; text-align: center;">
            <h3 style="color: #a8627a; margin: 0;">👥 Clientes</h3>
            <p style="font-size: 28px; font-weight: bold; color: #333; margin: 10px 0 0 0;"><?= $num_usuarios ?></p>
        </div>
    </div>

    <!-- Botones Acceso Rápido -->
    <div style="text-align: center; margin-bottom: 35px;">
        <a href="<?= base_url ?>producto/gestion" style="background-color: #e092a6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; margin-right: 10px; display: inline-block;">⚙️ Gestionar Productos</a>
        <a href="<?= base_url ?>categoria/index" style="background-color: #e092a6; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; display: inline-block;">📁 Gestionar Categorías</a>
    </div>

    <!-- Tabla Últimos Pedidos -->
    <div style="background: white; border: 1px solid #f2c4ce; border-radius: 10px; padding: 20px; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <h3 style="color: #a8627a; margin-top: 0;">📋 Últimos Pedidos Realizados</h3>
        
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #f2c4ce; color: #a8627a;">
                    <th style="padding: 10px;">N° Pedido</th>
                    <th style="padding: 10px;">Cliente</th>
                    <th style="padding: 10px;">Monto</th>
                    <th style="padding: 10px;">Fecha</th>
                    <th style="padding: 10px;">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($ultimos_pedidos && $ultimos_pedidos->num_rows > 0): ?>
                    <?php while ($pedido = $ultimos_pedidos->fetch_object()): ?>
                        <?php 
                            // Obtención del ID de pedido
                            $id_p = $pedido->id ?? $pedido->id_pedido ?? 'N/A';
                            
                            // Obtención del nombre del cliente
                            $nombre_cliente = 'Cliente / Invitado';
                            if (isset($pedido->usr_nombre) && !empty($pedido->usr_nombre)) {
                                $nombre_cliente = $pedido->usr_nombre . ' ' . ($pedido->usr_apellidos ?? '');
                            } elseif (isset($pedido->nombre) && !empty($pedido->nombre)) {
                                $nombre_cliente = $pedido->nombre . ' ' . ($pedido->apellidos ?? '');
                            } elseif (isset($pedido->nombre_cliente)) {
                                $nombre_cliente = $pedido->nombre_cliente;
                            }

                            // Obtención del costo o monto
                            $monto = $pedido->coste ?? $pedido->total ?? $pedido->monto ?? 0;

                            // Obtención de fecha y estado
                            $fecha = $pedido->fecha ?? $pedido->created_at ?? 'N/A';
                            $estado = $pedido->estado ?? $pedido->status ?? 'Pendiente';
                        ?>
                        <tr style="border-bottom: 1px solid #ffe6eb;">
                            <td style="padding: 10px; font-weight: bold;">#<?= $id_p ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($nombre_cliente) ?></td>
                            <td style="padding: 10px; color: #2e7d32; font-weight: bold;">$<?= number_format($monto, 0, ',', '.') ?></td>
                            <td style="padding: 10px;"><?= $fecha ?></td>
                            <td style="padding: 10px;"><?= htmlspecialchars($estado) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="padding: 15px; text-align: center; color: #888;">No hay pedidos registrados aún.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once 'views/layout/footer.php'; ?>