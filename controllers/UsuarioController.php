<?php
require_once 'models/usuario.php';

class UsuarioController {
    
    public function registro() {
        require_once 'views/layout/header.php';
        require_once 'views/usuario/registro.php';
        require_once 'views/layout/footer.php';
    }

    public function login() {
        require_once 'views/layout/header.php';
        require_once 'views/usuario/login.php';
        require_once 'views/layout/footer.php';
    }

    public function save() {
        if (isset($_POST)) {
            $nombre = $_POST['nombre'] ?? false;
            $apellidos = $_POST['apellidos'] ?? false;
            $email = $_POST['email'] ?? false;
            $password = $_POST['password'] ?? false;

            // Expresión regular: Mínimo 8 caracteres, al menos 1 letra, 1 número y 1 carácter especial
            $patron_password = '/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

            // Validar que la contraseña cumpla con la regla en el servidor
            if (!$password || !preg_match($patron_password, $password)) {
                $_SESSION['register'] = "failed_password";
                header("Location: " . base_url . "usuario/registro");
                exit();
            }

            if ($nombre && $apellidos && $email && $password) {
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellidos($apellidos);
                $usuario->setEmail($email);
                $usuario->setPassword($password);

                try {
                    $save = $usuario->save();
                    if ($save) {
                        $_SESSION['register'] = "complete";
                    } else {
                        $_SESSION['register'] = "failed";
                    }
                } catch (Exception $e) {
                    // Captura si el correo ya está duplicado en la base de datos
                    $_SESSION['register'] = "duplicate";
                }
            } else {
                $_SESSION['register'] = "failed";
            }
        }
        
        // Redirigir siempre al formulario para mostrar la notificación tipo alerta
        header("Location: " . base_url . "usuario/registro");
        exit();
    }

    public function loginProcess() {
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);

            $identity = $usuario->login($_POST['password']);

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                // Verificamos si id_rol es 1 (Administrador) o si la propiedad es 'rol'
                if (isset($identity->id_rol) && $identity->id_rol == 1) {
                    $_SESSION['admin'] = true;
                } elseif (isset($identity->rol) && $identity->rol == 'admin') {
                    $_SESSION['admin'] = true;
                }
            } else {
                $_SESSION['error_login'] = 'Identificación fallida. Revisa tu correo o contraseña.';
            }
        }
        header("Location: " . base_url);
    }

    public function logout() {
        if (isset($_SESSION['identity'])) {
            unset($_SESSION['identity']);
        }
        if (isset($_SESSION['admin'])) {
            unset($_SESSION['admin']);
        }
        header("Location: " . base_url);
    }

    public function dashboard() {
        // Verificar si es administrador
        if (!isset($_SESSION['admin'])) {
            header("Location: " . base_url);
            exit();
        }

        $db = Database::connect();

        // 1. Total de productos
        $num_productos = $db->query("SELECT COUNT(*) as total FROM productos")->fetch_object()->total;

        // 2. Total de pedidos
        $num_pedidos = $db->query("SELECT COUNT(*) as total FROM pedidos")->fetch_object()->total;

        // 3. Inspeccionar columnas de la tabla 'pedidos'
        $total_ventas = 0;
        $columnas_pedidos = $db->query("SHOW COLUMNS FROM pedidos");
        $col_monto = null;
        $col_fk_usuario = null;

        if ($columnas_pedidos) {
            while ($col = $columnas_pedidos->fetch_object()) {
                if (in_array($col->Field, ['total', 'coste', 'monto', 'precio_total'])) {
                    $col_monto = $col->Field;
                }
                if (in_array($col->Field, ['usuario_id', 'id_usuario', 'usuario'])) {
                    $col_fk_usuario = $col->Field;
                }
            }
        }

        if ($col_monto) {
            $res_ventas = $db->query("SELECT SUM($col_monto) as total FROM pedidos");
            if ($res_ventas) {
                $total_ventas = $res_ventas->fetch_object()->total ?? 0;
            }
        }

        // 4. Inspeccionar columna de clave primaria en 'usuarios'
        $columnas_usuarios = $db->query("SHOW COLUMNS FROM usuarios");
        $col_pk_usuario = 'id_usuario'; // Valor por defecto común

        if ($columnas_usuarios) {
            while ($col = $columnas_usuarios->fetch_object()) {
                if ($col->Key == 'PRI') {
                    $col_pk_usuario = $col->Field;
                    break;
                }
            }
        }

        // 5. Conteo de clientes registrados
        $query_usuarios = $db->query("SELECT COUNT(*) as total FROM usuarios WHERE id_rol != 1");
        $num_usuarios = ($query_usuarios) ? $query_usuarios->fetch_object()->total : 0;

        // 6. Últimos 5 pedidos haciendo el JOIN correcto con la columna PK detectada
        $fk_query = $col_fk_usuario ? "p.$col_fk_usuario" : "p.id_usuario";
        $ultimos_pedidos = $db->query("
            SELECT p.*, u.*
            FROM pedidos p
            LEFT JOIN usuarios u ON u.$col_pk_usuario = $fk_query
            ORDER BY 1 DESC
            LIMIT 5
        ");

        require_once 'views/usuario/dashboard.php';
    }
}