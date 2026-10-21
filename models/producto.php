<?php

class Producto {
    private $id;
    private $categoria_id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $talla;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getCategoriaId() {
        return $this->categoria_id;
    }

    public function setCategoriaId($categoria_id) {
        $this->categoria_id = $categoria_id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $this->db->real_escape_string($nombre);
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $this->db->real_escape_string($descripcion);
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function setPrecio($precio) {
        $this->precio = $this->db->real_escape_string($precio);
    }

    public function getStock() {
        return $this->stock;
    }

    public function setStock($stock) {
        $this->stock = $this->db->real_escape_string($stock);
    }

    public function getTalla() {
        return $this->talla;
    }

    public function setTalla($talla) {
        $this->talla = $this->db->real_escape_string($talla);
    }

    public function getOferta() {
        return $this->oferta;
    }

    public function setOferta($oferta) {
        $this->oferta = $this->db->real_escape_string($oferta);
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getImagen() {
        return $this->imagen;
    }

    public function setImagen($imagen) {
        $this->imagen = $imagen;
    }

    public function getAll() {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id_producto DESC;");
        return $productos;
    }

    public function getOne() {
        $producto = $this->db->query("SELECT * FROM productos WHERE id_producto = {$this->id}");
        return $producto->fetch_object();
    }

    public function save() {
        $imagen = $this->getImagen() ? "'{$this->getImagen()}'" : "NULL";
        $talla = $this->getTalla() ? "'{$this->getTalla()}'" : "NULL";
        
        $sql = "INSERT INTO productos (id_categoria, nombre, descripcion, precio, stock, talla, imagen, estado, fecha_creacion) 
                VALUES({$this->getCategoriaId()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, {$talla}, {$imagen}, 'activo', CURDATE());";
        
        return $this->db->query($sql) ? true : false;
    }

    public function edit() {
        $talla = $this->getTalla() ? "'{$this->getTalla()}'" : "NULL";

        $sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, talla={$talla}, id_categoria={$this->getCategoriaId()}";

        if ($this->getImagen() != null) {
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id_producto={$this->id};";

        return $this->db->query($sql) ? true : false;
    }

    public function delete() {
        $sql = "DELETE FROM productos WHERE id_producto={$this->id};";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }

    public function getBusqueda($busqueda) {
        $busqueda = $this->db->real_escape_string($busqueda);
        $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$busqueda}%' ORDER BY id_producto DESC;";
        $productos = $this->db->query($sql);
        return $productos;
    }
}