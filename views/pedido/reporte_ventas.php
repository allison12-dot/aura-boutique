<?php require_once 'views/layout/header.php'; ?>

<h1 style="color: #a8627a; text-align: center; margin-top: 20px;">📊 Reporte de Ventas</h1>

<p style="margin-bottom: 20px; text-align: center;">Listado general de los pedidos realizados en Aura Boutique:</p>

<?php if (isset($ventas) && $ventas->num_rows > 0): ?>
    <table border="1" style="width: 100%; border-collapse: collapse; text-align: left; background: white; border: 1px solid #f2c4ce; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
        <thead>
            <tr style="background-color: #c999af; color: white;">
                <th style="padding: 10px;">ID Pedido</th>
                <th style="padding: 10px;">Dirección</th>
                <th style="padding: 10px;">Ciudad</th>
                <th style="padding: 10px;">Coste Total</th>
                <th style="padding: 10px;">Estado</th>
                <th style="padding: 10px;">Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($ped = $ventas->fetch_object()): ?>
                <?php 
                    // Detección flexible de atributos de la BD
                    $id_pedido = $ped->id ?? $ped->id_pedido ?? 'N/A';
                    $direccion = $ped->direccion ?? 'N/A';
                    $ciudad = $ped->ciudad ?? 'N/A';
                    $coste = $ped->coste ?? $ped->total ?? $ped->monto ?? 0;
                    $estado = $ped->estado ?? $ped->status ?? 'Confirmado';
                    $fecha = $ped->fecha ?? $ped->created_at ?? 'N/A';
                ?>
                <tr style="border-bottom: 1px solid #ffe6eb;">
                    <td style="padding: 10px; font-weight: bold;">#<?= $id_pedido ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($direccion) ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($ciudad) ?></td>
                    <td style="padding: 10px; color: #2e7d32; font-weight: bold;">$<?= number_format($coste, 0, ',', '.') ?></td>
                    <td style="padding: 10px;"><?= htmlspecialchars($estado) ?></td>
                    <td style="padding: 10px;"><?= $fecha ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align: center; color: #888; margin-top: 30px;">No se han registrado ventas aún en el sistema.</p>
<?php endif; ?>

<?php require_once 'views/layout/footer.php'; ?>