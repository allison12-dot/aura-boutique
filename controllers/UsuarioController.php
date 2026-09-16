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
            $usuario = new Usuario();
            $usuario->setNombre($_POST['nombre']);
            $usuario->setApellidos($_POST['apellidos']);
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);

            $save = $usuario->save();
            
            if ($save) {
                echo "<h2 style='color: green; text-align: center; margin-top: 30px;'>¡Registro completado con éxito!</h2>";
            } else {
                echo "<h2 style='color: red; text-align: center; margin-top: 30px;'>Error al registrar el usuario.</h2>";
            }
        }
    }

    public function loginProcess() {
        if (isset($_POST)) {
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            
            $identity = $usuario->login($_POST['password']);

            if ($identity && is_object($identity)) {
                $_SESSION['identity'] = $identity;

                // Verificamos si id_rol es 1 (Administrador)
                if ($identity->id_rol == 1) {
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
}