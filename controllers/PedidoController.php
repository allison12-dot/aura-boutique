<?php
require_once 'models/pedido.php';

class PedidoController {

    public function hacer() {
        require_once 'views/pedido/hacer.php';
    }

    public function add() {
        if (isset($_SESSION['identity'])) {
            $usuario_id = $_SESSION['identity']->id_usuario ?? $_SESSION['identity']->id;
            $departamento = $_POST['departamento'] ?? false;
            $ciudad = $_POST['ciudad'] ?? false;
            $direccion = $_POST['direccion'] ?? false;

            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($departamento && $ciudad && $direccion) {
                // Guardar datos en DB
                $pedido = new Pedido();
                $pedido->setUsuarioId($usuario_id);
                $pedido->setDepartamento($departamento);
                $pedido->setCiudad($ciudad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                $save = $pedido->save();
                $save_linea = $pedido->save_linea();

                if ($save && $save_linea) {
                    $_SESSION['pedido'] = "complete";
                } else {
                    $_SESSION['pedido'] = "failed";
                }
            } else {
                $_SESSION['pedido'] = "failed";
            }

            header("Location:" . base_url . "pedido/confirmado");
        } else {
            header("Location:" . base_url);
        }
    }

    public function confirmado() {
        if (isset($_SESSION['identity'])) {
            $identity = $_SESSION['identity'];
            // Vaciar el carrito tras confirmar
            unset($_SESSION['carrito']);
        }
        require_once 'views/pedido/confirmado.php';
    }
}