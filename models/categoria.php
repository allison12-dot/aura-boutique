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
        $sql = "INSERT INTO categorias (nombre) VALUES('{$this->nombre}');";
        $save = $this->db->query($sql);
        return $save ? true : false;
    }

    public function delete() {
        $sql = "DELETE FROM categorias WHERE id_categoria = {$this->getId()};";
        $delete = $this->db->query($sql);

        // Fallback por si en la base de datos la columna id se llama 'id' en lugar de 'id_categoria'
        if (!$delete) {
            $sql = "DELETE FROM categorias WHERE id = {$this->getId()};";
            $delete = $this->db->query($sql);
        }

        return $delete ? true : false;
    }
}