<?php
require_once 'models/producto.php';

class CarritoController {

    public function index() {
        if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) {
            $carrito = $_SESSION['carrito'];
        } else {
            $carrito = array();
        }
        require_once 'views/carrito/index.php';
    }

    public function add() {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header('Location:' . base_url);
            exit();
        }

        // CAPTURAR LA TALLA SELECCIONADA POR EL CLIENTE (M por defecto si no envía)
        $talla = isset($_POST['talla']) ? $_POST['talla'] : 'M';

        // Obtener datos del producto para verificar su stock real
        $producto = new Producto();
        $producto->setId($producto_id);
        $producto_data = $producto->getOne();

        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $indice => $elemento) {
                // Comprobar que seja el mismo producto Y la misma talla
                if ($elemento['id_producto'] == $producto_id && $elemento['talla'] == $talla) {
                    // Validar que no supere el stock al añadir
                    if ($_SESSION['carrito'][$indice]['unidades'] < $producto_data->stock) {
                        $_SESSION['carrito'][$indice]['unidades']++;
                    }
                    $counter++;
                }
            }
        }

        if (!isset($counter) || $counter == 0) {
            if (is_object($producto_data)) {
                // Validar que el stock inicial permita al menos 1 unidad
                $unidades_iniciales = ($producto_data->stock > 0) ? 1 : 0;
                
                if ($unidades_iniciales > 0) {
                    $_SESSION['carrito'][] = array(
                        "id_producto" => $producto_data->id_producto,
                        "precio" => $producto_data->precio,
                        "unidades" => $unidades_iniciales,
                        "talla" => $talla, // GUARDAMOS LA TALLA EN EL CARRITO
                        "producto" => $producto_data
                    );
                }
            }
        }

        header("Location:" . base_url . "carrito/index");
    }

    public function up() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            
            // Obtener el producto y su stock actual de la base de datos para comparar
            $producto_id = $_SESSION['carrito'][$index]['id_producto'];
            $producto = new Producto();
            $producto->setId($producto_id);
            $producto_data = $producto->getOne();
            
            // VALIDACIÓN: Solo incrementar si las unidades actuales son menores al stock disponible
            if (is_object($producto_data) && $_SESSION['carrito'][$index]['unidades'] < $producto_data->stock) {
                $_SESSION['carrito'][$index]['unidades']++;
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function down() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            $_SESSION['carrito'][$index]['unidades']--;
            
            if ($_SESSION['carrito'][$index]['unidades'] == 0) {
                unset($_SESSION['carrito'][$index]);
            }
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function delete() {
        if (isset($_GET['index'])) {
            $index = $_GET['index'];
            unset($_SESSION['carrito'][$index]);
        }
        header("Location:" . base_url . "carrito/index");
    }

    public function delete_all() {
        unset($_SESSION['carrito']);
        header("Location:" . base_url . "carrito/index");
    }
}