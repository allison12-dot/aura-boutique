<?php
require_once 'models/producto.php';

class ProductoController {

    public function index() {
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/layout/header.php';
        require_once 'views/producto/destacados.php';
        require_once 'views/layout/footer.php';
    }

    public function gestion() {
        if (isset($_SESSION['admin'])) {
            $producto = new Producto();
            $productos = $producto->getAll();

            require_once 'views/layout/header.php';
            require_once 'views/producto/gestion.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url);
        }
    }

    public function crear() {
        if (isset($_SESSION['admin'])) {
            require_once 'views/layout/header.php';
            require_once 'views/producto/crear.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url);
        }
    }

    public function editar() {
        if (isset($_SESSION['admin']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $edit = true;

            $producto = new Producto();
            $producto->setId($id);
            $pro = $producto->getOne();

            require_once 'views/layout/header.php';
            require_once 'views/producto/crear.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url . "Producto/gestion");
        }
    }

   public function save() {
        if (isset($_SESSION['admin']) && $_POST) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);

                // Subida de imagen
                if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif" || $mimetype == "image/webp") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        
                        // ASIGNAMOS EL NOMBRE REAL DEL ARCHIVO
                        $producto->setImagen($filename);
                    }
                }

                // SI ESTAMOS EDITANDO UN PRODUCTO EXISTENTE
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
                    // SI ES UN PRODUCTO NUEVO
                    $save = $producto->save();
                }
            }
        }

        header("Location: " . base_url . "Producto/gestion");
    }

    public function eliminar() {
        if (isset($_SESSION['admin']) && isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();
        }
        header("Location: " . base_url . "Producto/gestion");
    }

    public function catalogo() {
        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/catalogo.php';
    }
}

