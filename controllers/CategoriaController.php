<?php
require_once 'models/categoria.php';

class CategoriaController {

    public function index() {
        if (isset($_SESSION['admin'])) {
            $categoria = new Categoria();
            $categorias = $categoria->getAll();

            require_once 'views/layout/header.php';
            require_once 'views/categoria/index.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url);
        }
    }

    public function crear() {
        if (isset($_SESSION['admin'])) {
            require_once 'views/layout/header.php';
            require_once 'views/categoria/crear.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url);
        }
    }

    public function save() {
        if (isset($_SESSION['admin']) && isset($_POST) && isset($_POST['nombre'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $categoria->save();
        }
        header("Location: " . base_url . "categoria/index");
    }
}