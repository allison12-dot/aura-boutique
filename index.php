<?php
session_start();
require_once 'helpers/utils.php';
require_once 'config/parameters.php';
require_once 'config/db.php';
require_once 'autoload.php';

// Procesar la URL amigable si viene de .htaccess
if (isset($_GET['url'])) {
    $url = explode('/', trim($_GET['url'], '/'));
    $controller_name = ucfirst($url[0]) . 'Controller';
    $action_name = isset($url[1]) ? $url[1] : action_default;
} else {
    $controller_name = isset($_GET['controller']) ? $_GET['controller'] . 'Controller' : controller_default;
    $action_name = isset($_GET['action']) ? $_GET['action'] : action_default;
}

// Verificar y cargar el controlador y la acción
if (class_exists($controller_name)) {
    $controlador = new $controller_name();
    
    if (method_exists($controlador, $action_name)) {
        $controlador->$action_name();
    } else {
        echo "<h1>La página que buscas no existe (Acción no encontrada)</h1>";
    }
} else {
    echo "<h1>La página que buscas no existe (Controlador no encontrado)</h1>";
}