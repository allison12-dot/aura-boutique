<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>✨ Aura Boutique ✨</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background-color: #fff1f5; color: #bc8c6b; }
        
        header { 
            background: #c999af; 
            color: black; 
            padding: 1.2rem 2rem; 
            display: flex; 
            flex-direction: column; 
            align-items: center;    
            justify-content: center;
            gap: 15px; 
            text-align: center;
        }
        
        header h1 { 
            font-size: 2.2rem; 
            letter-spacing: 2px; 
            white-space: nowrap;
            margin: 0 auto;        
        }
        
        nav { 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            gap: 16px; 
            flex-wrap: wrap; 
        }
        
        nav a { 
            color: #ffc8dd; 
            text-decoration: none; 
            font-weight: 500; 
            transition: color 0.3s; 
            white-space: nowrap;
        }
        
        nav a:hover { 
            color: #382417; 
        }
        
        .user-greeting {
            color: #4e1e04; 
            font-weight: bold; 
            white-space: nowrap;
        }

        /* --- Estilos para la Barra de Búsqueda --- */
        .search-form {
            display: flex;
            align-items: center;
            background-color: #ffffff;
            border-radius: 20px;
            padding: 4px 10px;
            border: 1px solid #ffc8dd;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .search-input {
            border: none;
            outline: none;
            padding: 6px 10px;
            font-size: 0.9rem;
            border-radius: 20px;
            color: #4e1e04;
            width: 160px;
            transition: width 0.3s ease;
        }

        .search-input:focus {
            width: 200px;
        }

        .search-btn {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 1rem;
            padding: 0 4px;
        }

        .container { max-width: 1100px; margin: 30px auto; padding: 0 20px; min-height: 70vh; }
        footer { background: #c999af; color: black; text-align: center; padding: 1.5rem; margin-top: 40px; }

        /* Estilos integrados para las Modales */
        .modal-datos-overlay {
            display: none; 
            position: fixed; 
            z-index: 99999; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            background-color: rgba(0, 0, 0, 0.5); 
            backdrop-filter: blur(2px);
        }

        .modal-datos-content {
            background-color: #ffffff;
            margin: 8% auto; 
            padding: 24px;
            border-radius: 12px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            color: #333;
            text-align: center;
        }

        .modal-datos-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
        }

        .modal-datos-header h3 {
            margin: 0;
            color: #4e1e04;
            font-size: 1.2rem;
        }

        .modal-datos-close {
            color: #aaa;
            font-size: 26px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
        }

        .modal-datos-close:hover {
            color: #000;
        }

        .modal-datos-body p {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .equipo-foto {
            width: 100%;
            max-height: 250px;
            object-fit: contain;
            background-color: #fff;
            border-radius: 8px;
            margin-bottom: 15px;
            border: 3px solid #ffc8dd;
        }

        .modal-datos-footer {
            text-align: right;
        }

        .btn-modal-aceptar {
            background-color: #c999af;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
        }

        .btn-modal-aceptar:hover {
            background-color: #a8627a;
        }
    </style>
</head>
<body>
    <header>
        <h1>🌸 AURA BOUTIQUE</h1>
        <nav>
            <a href="<?=base_url?>">Inicio 🏠</a>
            <a href="<?=base_url?>producto/catalogo">Catálogo 👗</a>
            
            <?php 
                $stats = class_exists('Utils') ? Utils::statsCarrito() : ['count' => 0];
            ?>
            <a href="<?=base_url?>carrito/index">Carrito 🛒 (<?=$stats['count']?>)</a>

            <?php if (isset($_SESSION['admin'])): ?>
                <a href="<?=base_url?>usuario/dashboard">Dashboard 📊</a>
                <a href="<?=base_url?>categoria/index">Gestionar Categorías 📁</a>
                <a href="<?=base_url?>producto/gestion">Gestionar Productos ⚙️</a>
                <a href="<?=base_url?>pedido/reporteVentas">Reporte de Ventas 📈</a>
            <?php endif; ?>

            <?php if (isset($_SESSION['identity'])): ?>
                <?php 
                    $nombre_usuario = $_SESSION['identity']->nombre 
                        ?? $_SESSION['identity']->nombres 
                        ?? $_SESSION['identity']->usr_nombre 
                        ?? 'Usuario';
                ?>
                <span class="user-greeting">Hola, <?= htmlspecialchars($nombre_usuario) ?> 💖</span>
                <a href="<?=base_url?>usuario/logout">Cerrar Sesión 🚪</a>
            <?php else: ?>
                <a href="<?=base_url?>usuario/registro">Registro 📝</a>
                <a href="<?=base_url?>usuario/login">Login 🔑</a>
            <?php endif; ?>

            <a href="#" id="btn-quienes-somos">Quiénes somos 👥</a>
            <a href="#" id="btn-tratamiento-datos">Tratamiento de datos 📋</a>

            <!-- Formulario de Búsqueda adaptado con ID para AJAX -->
            <form action="<?=base_url?>producto/buscar" method="POST" class="search-form" id="search-form-ajax">
                <input type="text" name="busqueda" id="input-buscador-ajax" placeholder="Buscar producto..." class="search-input" autocomplete="off" required>
                <button type="submit" class="search-btn">🔍</button>
            </form>
        </nav>

        <!-- Ventana Modal de Quiénes Somos -->
        <div id="modalQuienesSomos" class="modal-datos-overlay">
            <div class="modal-datos-content">
                <div class="modal-datos-header">
                    <h3>👥 Quiénes Somos</h3>
                    <span class="modal-datos-close" id="closeQuienesSomos">&times;</span>
                </div>
                <div class="modal-datos-body">
                    <img src="<?=base_url?>uploads/images/equipo.png.jpeg" 
                         onerror="
                            if (!this.step) this.step = 1;
                            if (this.step === 1) { this.step = 2; this.src='<?=base_url?>uploads/images/equipo.jpg'; }
                            else if (this.step === 2) { this.step = 3; this.src='<?=base_url?>uploads/images/equipo.png'; }
                            else if (this.step === 3) { this.step = 4; this.src='<?=base_url?>uploads/equipo.jpg'; }
                         " 
                         alt="Foto del equipo Aura Boutique" 
                         class="equipo-foto">
                    
                    <p>
                        Los integrantes del grupo <strong>AURA BOUTIQUE</strong> somos:<br>
                        <strong>ALLISON, SARA Y ALEJANDRO</strong> 💖
                    </p>
                </div>
                <div class="modal-datos-footer">
                    <button id="btnAceptarQuienesSomos" class="btn-modal-aceptar">Aceptar</button>
                </div>
            </div>
        </div>

        <!-- Ventana Modal de Tratamiento de Datos -->
        <div id="modalTratamientoDatos" class="modal-datos-overlay">
            <div class="modal-datos-content">
                <div class="modal-datos-header">
                    <h3>Tratamiento de Datos</h3>
                    <span class="modal-datos-close" id="closeTratamientoDatos">&times;</span>
                </div>
                <div class="modal-datos-body" style="text-align: justify;">
                    <p>
                        El presente proyecto tiene fines exclusivamente académicos. Los datos utilizados durante el desarrollo, las pruebas y la demostración del sistema son ficticios y fueron creados únicamente con fines de simulación. El sistema no recolecta, almacena ni procesa datos personales reales de estudiantes, docentes o terceros.
                    </p>
                </div>
                <div class="modal-datos-footer">
                    <button id="btnAceptarDatos" class="btn-modal-aceptar">Aceptar</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenedor global para mostrar los resultados de la búsqueda en tiempo real -->
    <div id="resultados-busqueda-ajax" style="display: flex; flex-wrap: wrap; gap: 25px; justify-content: center; max-width: 1200px; margin: 20px auto; padding: 0 15px;"></div>

    <script>
    // Script rápido para conectar el input del header con el método busquedaAjax
    document.addEventListener('DOMContentLoaded', function() {
        var inputBuscador = document.getElementById('input-buscador-ajax');
        var contenedorResultados = document.getElementById('resultados-busqueda-ajax');
        var formBusqueda = document.getElementById('search-form-ajax');

        if (formBusqueda) {
            formBusqueda.addEventListener('submit', function(e) {
                e.preventDefault(); // Evita recarga al dar ENTER o click en la lupa
            });
        }

        if (inputBuscador && contenedorResultados) {
            inputBuscador.addEventListener('keyup', function() {
                var query = inputBuscador.value.trim();

                if (query.length === 0) {
                    contenedorResultados.innerHTML = "";
                    return;
                }

                fetch(`<?=base_url?>producto/busquedaAjax&q=${encodeURIComponent(query)}`)
                    .then(response => response.text())
                    .then(html => {
                        contenedorResultados.innerHTML = html;
                        if (typeof configurarBotonesFavoritos === 'function') {
                            configurarBotonesFavoritos();
                        }
                    })
                    .catch(error => console.error("Error en búsqueda AJAX:", error));
            });
        }
    });
    </script>

    <div class="container">