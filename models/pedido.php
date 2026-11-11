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

    // Guardar el detalle validando que las unidades no superen el stock disponible
    public function save_linea() {
        // 1. VALIDACIÓN PREVIA: Revisar si hay suficiente stock para todo el carrito antes de procesar
        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];
            $unidades_compradas = $elemento['unidades'];

            // Consultar el stock real en la base de datos
            $stock_query = $this->db->query("SELECT stock FROM productos WHERE id_producto = {$producto->id_producto};");
            $stock_actual = $stock_query->fetch_object()->stock;

            // Si el cliente pide más de lo que hay en stock, detenemos la compra
            if ($unidades_compradas > $stock_actual) {
                $_SESSION['error_stock'] = "No puedes comprar {$unidades_compradas} unidades. Solo hay {$stock_actual} disponibles en stock.";
                return false; 
            }
        }

        // 2. Si pasa la validación, procedemos a registrar las líneas y descontar el stock
        $sql = "SELECT LAST_INSERT_ID() as 'pedido';";
        $query = $this->db->query($sql);
        $pedido_id = $query->fetch_object()->pedido;

        foreach ($_SESSION['carrito'] as $elemento) {
            $producto = $elemento['producto'];

            // Insertar el detalle
            $insert = "INSERT INTO lineas_pedidos VALUES(NULL, {$pedido_id}, {$producto->id_producto}, {$elemento['unidades']});";
            $this->db->query($insert);

            // Descontar del stock
            $update_stock = "UPDATE productos SET stock = stock - {$elemento['unidades']} WHERE id_producto = {$producto->id_producto};";
            $this->db->query($update_stock);
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