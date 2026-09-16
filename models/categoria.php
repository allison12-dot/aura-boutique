<?php
require_once 'config/db.php';

class Categoria {
    private $id;
    private $nombre;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() { return $this->id; }
    public function getNombre() { return $this->nombre; }

    public function setId($id) { $this->id = $id; }
    public function setNombre($nombre) { $this->nombre = $this->db->real_escape_string($nombre); }

    public function getAll() {
        $categorias = $this->db->query("SELECT * FROM categorias ORDER BY id_categoria DESC;");
        return $categorias;
    }

    public function save() {
        $sql = "INSERT INTO categorias VALUES(NULL, '{$this->nombre}');";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }
}