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
            $talla = isset($_POST['talla']) ? $_POST['talla'] : false;

            if ($nombre && $descripcion && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDescripcion($descripcion);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoriaId($categoria);
                
                if ($talla) {
                    $producto->setTalla($talla);
                }

                if (isset($_FILES['imagen']) && !empty($_FILES['imagen']['name'])) {
                    $file = $_FILES['imagen'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == "image/gif" || $mimetype == "image/webp") {
                        if (!is_dir('uploads/images')) {
                            mkdir('uploads/images', 0777, true);
                        }
                        move_uploaded_file($file['tmp_name'], 'uploads/images/' . $filename);
                        $producto->setImagen($filename);
                    }
                }

                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->edit();
                } else {
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

    // MÉTODO PARA LA BUSQUEDA DE PRODUCTOS (Tradicional)
    public function buscar() {
        if (isset($_POST['busqueda'])) {
            $busqueda = trim($_POST['busqueda']);
            
            $producto = new Producto();
            $productos = $producto->getBusqueda($busqueda);
            
            require_once 'views/layout/header.php';
            require_once 'views/producto/busqueda.php';
            require_once 'views/layout/footer.php';
        } else {
            header("Location: " . base_url);
        }
    }

    // NUEVO MÉTODO PARA BÚSQUEDA RÁPIDA EN TIEMPO REAL (AJAX)
    public function busquedaAjax() {
        if (isset($_GET['q'])) {
            $busqueda = trim($_GET['q']);
            
            $producto = new Producto();
            $productos = $producto->getBusqueda($busqueda);
            
            if ($productos && $productos->num_rows > 0) {
                while ($product = $productos->fetch_object()) {
                    ?>
                    <div class="product-card-container" style="background: white; border: 1px solid #f3abc8; border-radius: 8px; padding: 15px; width: 230px; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.05); position: relative;">
                        
                        <!-- Botón de Favoritos (Corazón) -->
                        <button class="btn-favorito" data-id="<?=$product->id_producto?>" data-nombre="<?=$product->nombre?>" data-precio="<?=number_format($product->precio, 2, '.', '')?>" data-imagen="<?=base_url?>uploads/images/<?=$product->imagen?>" style="position: absolute; top: 10px; right: 10px; background: white; border: 1px solid #f3abc8; border-radius: 50%; width: 32px; height: 32px; cursor: pointer; font-size: 1rem; display: flex; align-items: center; justify-content: center; z-index: 10; box-shadow: 0 2px 5px rgba(0,0,0,0.1);" title="Añadir a favoritos">
                            🤍
                        </button>

                        <div style="width: 100%; height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; border-radius: 6px; margin-bottom: 12px; overflow: hidden;">
                            <?php if (!empty($product->imagen)): ?>
                                <img src="<?=base_url?>uploads/images/<?=$product->imagen?>" alt="<?=$product->nombre?>" style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <span style="color: #888; font-size: 0.9rem;">Sin imagen</span>
                            <?php endif; ?>
                        </div>

                        <h3 style="font-size: 1.1rem; color: #b16e4b; margin-bottom: 8px; font-weight: 600;"><?=$product->nombre?></h3>
                        <p style="color: #e47a9d; font-size: 0.85rem; margin-bottom: 10px; height: 38px; overflow: hidden;"><?=$product->descripcion?></p>

                        <div>
                            <p style="color: #b16e4b; font-weight: bold; font-size: 1.2rem; margin-bottom: 8px;">$<?=number_format($product->precio, 2)?></p>
                            
                            <form action="<?=base_url?>carrito/add&id=<?=$product->id_producto?>" method="POST">
                                <div style="margin-bottom: 8px; text-align: left;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3px;">
                                        <label style="font-size: 0.8rem; color: #b16e4b; font-weight: bold;">Talla:</label>
                                        <a href="#" class="btn-guia-tallas-link" style="font-size: 0.75rem; color: #a8627a; text-decoration: underline; font-weight: 600;">📏 Guía</a>
                                    </div>
                                    <select name="talla" style="width: 100%; padding: 5px; border: 1px solid #f3abc8; border-radius: 4px; color: #4e1e04; font-weight: 500; background-color: #fff1f5;" required>
                                        <option value="XS">XS</option>
                                        <option value="S">S</option>
                                        <option value="M" selected>M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                    </select>
                                </div>
                                <button type="submit" style="background: #f3abc8; color: white; padding: 8px 15px; border: none; border-radius: 4px; display: block; font-weight: bold; width: 100%; cursor: pointer; margin-top: 10px;">Comprar 🛒</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo '<p style="text-align: center; color: #888; width: 100%;">No se encontraron prendas con ese nombre 🌸</p>';
            }
        }
    }
}