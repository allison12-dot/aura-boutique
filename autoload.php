<?php

function controllers_autoload($classname) {
    $file = __DIR__ . '/controllers/' . $classname . '.php';
    
    if (file_exists($file)) {
        require_once $file;
    } else {
        // Intento de búsqueda en minúsculas por si Windows cambió el nombre
        $file_lower = __DIR__ . '/controllers/' . strtolower($classname) . '.php';
        if (file_exists($file_lower)) {
            require_once $file_lower;
        }
    }
}

spl_autoload_register('controllers_autoload');