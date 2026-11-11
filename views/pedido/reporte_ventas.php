<?php require_once 'views/layout/header.php'; ?>

<style>
    .reporte-container {
        max-width: 950px;
        margin: 30px auto;
        background: #ffffff;
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        font-family: 'Poppins', sans-serif;
    }
    .reporte-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 2px solid #f2cfd9;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }
    .reporte-header h2 {
        color: #a8627a;
        margin: 0;
        font-size: 26px;
    }
    .btn-print {
        background-color: #c999af;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        transition: 0.3s;
    }
    .btn-print:hover {
        background-color: #b0728d;
    }
    .tabla-reporte {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    .tabla-reporte th {
        background-color: #c999af;
        color: white;
        padding: 12px;
        text-align: left;
        font-size: 14px;
    }
    .tabla-reporte td {
        padding: 12px;
        border-bottom: 1px solid #ffe6eb;
        color: #4a4a4a;
        font-size: 14px;
    }
    .tabla-reporte tr:nth-child(even) {
        background-color: #fff9fb;
    }
    .monto-valido {
        color: #27ae60;
        font-weight: bold;
    }

    /* Ocultar elementos de la tienda al imprimir o guardar en PDF */
    @media print {
        header, footer, .btn-print, nav, .sidebar {
            display: none !important;
        }
        .reporte-container {
            box-shadow: none;
            margin: 0;
            width: 100%;
            padding: 0;
        }
    }
</style>

<div class="reporte-container">
    <div class="reporte-header">
        <div>
            <h2>📊 Reporte General de Ventas</h2>
            <p style="color: #888; margin: 5px 0 0 0; font-size: 13px;">Aura Boutique - Listado oficial de pedidos realizados</p>
        </div>
        <!-- Botón para imprimir o guardar como PDF -->
        <button onclick="window.print()" class="btn-print">
            📄 Imprimir / Guardar PDF
        </button>
    </div>

    <?php if (isset($ventas) && $ventas->num_rows > 0): ?>
        <table class="tabla-reporte">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Dirección</th>
                    <th>Ciudad</th>
                    <th>Coste Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hay_ventas = false;
                // Reseteamos el puntero por si acaso y recorremos con tu lógica original adaptada
                while ($ped = $ventas->fetch_object()): 
                    $id_pedido = $ped->id ?? $ped->id_pedido ?? 'N/A';
                    $direccion = $ped->direccion ?? 'N/A';
                    $ciudad = $ped->ciudad ?? 'N/A';
                    $coste = $ped->coste ?? $ped->total ?? $ped->monto ?? 0;
                    $estado = $ped->estado ?? $ped->status ?? 'Confirmado';
                    $fecha = $ped->fecha ?? $ped->created_at ?? 'N/A';

                    // FILTRO: Ocultar los que tengan coste 0 o dirección N/A (los registros antiguos vacíos)
                    if ($coste > 0 && $direccion != 'N/A'):
                        $hay_ventas = true;
                ?>
                    <tr>
                        <td><strong>#<?= $id_pedido ?></strong></td>
                        <td><?= htmlspecialchars($direccion) ?></td>
                        <td><?= htmlspecialchars(ucfirst($ciudad)) ?></td>
                        <td class="monto-valido">$<?= number_format($coste, 0, ',', '.') ?></td>
                        <td>
                            <span style="background: #e8f5e9; color: #2e7d32; padding: 4px 8px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                                <?= htmlspecialchars(ucfirst($estado)) ?>
                            </span>
                        </td>
                        <td><?= $fecha ?></td>
                    </tr>
                <?php 
                    endif;
                endwhile; 

                if (!$hay_ventas):
                ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: #999; padding: 25px;">
                            No hay ventas válidas registradas para mostrar.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #888; margin-top: 30px;">No se han registrado ventas aún en el sistema.</p>
    <?php endif; ?>
</div>

<?php require_once 'views/layout/footer.php'; ?>