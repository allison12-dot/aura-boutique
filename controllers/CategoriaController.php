<?php
require_once 'models/categoria.php';

class categoriaController {

    public function index() {
        // Método para mostrar todas las categorías
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function crear() {
        // Vista para crear categoría (si la tienes)
        require_once 'views/categoria/crear.php';
    }

    public function save() {
        // Lógica para guardar la categoría nueva
        if (isset($_POST) && isset($_POST['nombre'])) {
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();
        }
        header("Location:" . base_url . "categoria/index");
    }

    public function eliminar() {
        // MÉTODO DE ELIMINACIÓN QUE NECESITAS
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            
            $categoria = new Categoria();
            $categoria->setId($id);
            
            $delete = $categoria->delete();
            
            if ($delete) {
                $_SESSION['categoria'] = "complete";
            } else {
                $_SESSION['categoria'] = "failed";
            }
        } else {
            $_SESSION['categoria'] = "failed";
        }
        
        header('Location:' . base_url . 'categoria/index');
    }
}