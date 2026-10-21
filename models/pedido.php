<?php

class Pedido {
    private $id;
    private $usuario_id;
    private $departamento;
    private $ciudad;
    private $direccion;
    private $coste;
    private $estado;
    private $fecha;
    private $hora;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    // Getters y Setters
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getUsuarioId() { return $this->usuario_id; }
    public function setUsuarioId($usuario_id) { $this->usuario_id = $usuario_id; }

    public function getDepartamento() { return $this->departamento; }
    public function setDepartamento($departamento) { $this->departamento = $this->db->real_escape_string($departamento); }

    public function getCiudad() { return $this->ciudad; }
    public function setCiudad($ciudad) { $this->ciudad = $this->db->real_escape_string($ciudad); }

    public function getDireccion() { return $this->direccion; }
    public function setDireccion($direccion) { $this->direccion = $this->db->real_escape_string($direccion); }

    public function getCoste() { return $this->coste; }
    public function setCoste($coste) { $this->coste = $coste; }

    // Guardar el pedido en la base de datos
    public function save() {
        $sql = "INSERT INTO pedidos (id_usuario, departamento, ciudad, direccion, coste, estado, fecha, hora) "
     . "VALUES({$this->getUsuarioId()}, '{$this->getDepartamento()}', '{$this->getCiudad()}', '{$this->getDireccion()}', {$this->getCoste()}, 'confirm', CURDATE(), CURTIME());";
        $save = $this->db->query($sql);

        if ($save) {
            return true;
        } else {
            echo "Error en MySQL al guardar pedido: " . $this->db->error;
            die();
        }
    }

    // Guardar el detalle de los productos en lineas_pedidos
    public function save_linea() {
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id_producto}, {$elemento['unidades']});";
            $this->db->query($insert);
        }

        return true;
    }

    // Consultar todos los pedidos directamente
    public function getAll() {
        $sql = "SELECT * FROM pedidos;";
        $pedidos = $this->db->query($sql);
        return $pedidos;
    }
}