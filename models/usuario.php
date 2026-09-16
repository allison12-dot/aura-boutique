<?php
require_once 'config/db.php';

class Usuario {
    private $id;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function setEmail($email) { $this->email = $this->db->real_escape_string($email); }
    public function setPassword($password) { $this->password = password_hash($this->db->real_escape_string($password), PASSWORD_BCRYPT, ['cost' => 4]); }
    public function setNombre($nombre) { $this->nombre = $this->db->real_escape_string($nombre); }
    public function setApellidos($apellidos) { $this->apellidos = $this->db->real_escape_string($apellidos); }

    public function save() {
        // Especificar las columnas exactas evita el error de conteo
        $sql = "INSERT INTO usuarios (id_rol, nombres, apellidos, correo, password) 
                VALUES (2, '{$this->nombre}', '{$this->apellidos}', '{$this->email}', '{$this->password}');";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }

    public function login($password_ingresada) {
        $result = false;
        $email = $this->email;

        $sql = "SELECT * FROM usuarios WHERE correo = '$email'";
        $login = $this->db->query($sql);

        if ($login && $login->num_rows == 1) {
            $usuario = $login->fetch_object();
            $verify = password_verify($password_ingresada, $usuario->password);

            if ($verify) {
                $result = $usuario;
            }
        }

        return $result;
    }
}