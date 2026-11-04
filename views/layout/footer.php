</div>
<footer>
    <p>&copy; <?=date('Y')?> Aura Boutique - Todos los derechos reservados SENA CDM</p>

    <!-- Botón Flotante de Música (Izquierda) -->
    <div id="music-player" style="position: fixed; bottom: 20px; left: 20px; z-index: 9999;">
        <button id="btn-music" onclick="toggleMusica()" style="background-color: #e092a6; color: white; border: none; padding: 10px 18px; border-radius: 25px; font-weight: bold; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            🎵 Reproducir ambiente relax
        </button>
        <audio id="audio-bg" loop src="<?=base_url?>assets/audio/musica_relax.mp3"></audio>
    </div>

    <!-- Botón Flotante de Favoritos (Derecha) -->
    <div id="wishlist-float" style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
        <button id="btn-abrir-favoritos" style="background-color: #f3abc8; color: white; border: none; padding: 10px 18px; border-radius: 25px; font-weight: bold; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
            💖 Favoritos (<span id="contador-favoritos">0</span>)
        </button>
    </div>

    <!-- CONTENEDOR DE ALERTAS FLOTANTES (TOASTS) -->
    <div id="toast-container" style="position: fixed; top: 20px; right: 20px; z-index: 20000; display: flex; flex-direction: column; gap: 10px;"></div>

    <!-- VENTANA MODAL: GUÍA DE TALLAS -->
    <div id="modalGuiaTallas" style="display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
        <div style="background-color: #fff; margin: 10% auto; padding: 25px; border: 1px solid #f3abc8; width: 90%; max-width: 500px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); position: relative;">
            <span id="closeGuiaTallas" style="color: #aaa; position: absolute; right: 20px; top: 15px; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            <h2 style="color: #b16e4b; margin-top: 0; text-align: center; font-size: 1.4rem;">📏 Guía de Tallas - Aura Boutique</h2>
            <p style="color: #666; font-size: 0.9rem; text-align: center; margin-bottom: 20px;">Encuentra tu medida perfecta expresada en centímetros (cm).</p>
            
            <table style="width: 100%; border-collapse: collapse; text-align: center; font-size: 0.9rem;">
                <thead>
                    <tr style="background-color: #f3abc8; color: white;">
                        <th style="padding: 10px; border: 1px solid #ffccd5;">Talla</th>
                        <th style="padding: 10px; border: 1px solid #ffccd5;">Busto (cm)</th>
                        <th style="padding: 10px; border: 1px solid #ffccd5;">Cintura (cm)</th>
                        <th style="padding: 10px; border: 1px solid #ffccd5;">Cadera (cm)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr style="background-color: #fff9fb;">
                        <td style="padding: 8px; border: 1px solid #eee; font-weight: bold; color: #b16e4b;">XS</td>
                        <td style="padding: 8px; border: 1px solid #eee;">78 - 82</td>
                        <td style="padding: 8px; border: 1px solid #eee;">60 - 64</td>
                        <td style="padding: 8px; border: 1px solid #eee;">84 - 88</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee; font-weight: bold; color: #b16e4b;">S</td>
                        <td style="padding: 8px; border: 1px solid #eee;">83 - 87</td>
                        <td style="padding: 8px; border: 1px solid #eee;">65 - 69</td>
                        <td style="padding: 8px; border: 1px solid #eee;">89 - 93</td>
                    </tr>
                    <tr style="background-color: #fff9fb;">
                        <td style="padding: 8px; border: 1px solid #eee; font-weight: bold; color: #b16e4b;">M</td>
                        <td style="padding: 8px; border: 1px solid #eee;">88 - 92</td>
                        <td style="padding: 8px; border: 1px solid #eee;">70 - 74</td>
                        <td style="padding: 8px; border: 1px solid #eee;">94 - 98</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #eee; font-weight: bold; color: #b16e4b;">L</td>
                        <td style="padding: 8px; border: 1px solid #eee;">93 - 98</td>
                        <td style="padding: 8px; border: 1px solid #eee;">75 - 80</td>
                        <td style="padding: 8px; border: 1px solid #eee;">99 - 104</td>
                    </tr>
                    <tr style="background-color: #fff9fb;">
                        <td style="padding: 8px; border: 1px solid #eee; font-weight: bold; color: #b16e4b;">XL</td>
                        <td style="padding: 8px; border: 1px solid #eee;">99 - 104</td>
                        <td style="padding: 8px; border: 1px solid #eee;">81 - 86</td>
                        <td style="padding: 8px; border: 1px solid #eee;">105 - 110</td>
                    </tr>
                </tbody>
            </table>

            <div style="text-align: center; margin-top: 20px;">
                <button id="btnAceptarGuia" style="background: #f3abc8; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">¡Entendido! 🌸</button>
            </div>
        </div>
    </div>

    <!-- VENTANA MODAL: LISTA DE FAVORITOS -->
    <div id="modalFavoritos" style="display: none; position: fixed; z-index: 10000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
        <div style="background-color: #fff; margin: 10% auto; padding: 25px; border: 1px solid #f3abc8; width: 90%; max-width: 500px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.2); position: relative;">
            <span id="closeFavoritos" style="color: #aaa; position: absolute; right: 20px; top: 15px; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
            <h2 style="color: #b16e4b; margin-top: 0; text-align: center; font-size: 1.4rem;">💖 Mis Prendas Favoritas</h2>
            <p style="color: #666; font-size: 0.9rem; text-align: center; margin-bottom: 20px;">Tus flechazos de moda guardados en Aura Boutique.</p>
            
            <div id="lista-favoritos-contenedor" style="max-height: 300px; overflow-y: auto; margin-bottom: 20px;">
                <!-- Aquí se cargan dinámicamente los favoritos -->
            </div>

            <div style="text-align: center;">
                <button id="btnCerrarFavoritos" style="background: #f3abc8; color: white; border: none; padding: 10px 20px; border-radius: 5px; font-weight: bold; cursor: pointer;">Cerrar</button>
            </div>
        </div>
    </div>

    <script>
    var audio = document.getElementById('audio-bg');
    var btn = document.getElementById('btn-music');

    document.addEventListener('DOMContentLoaded', function() {
        // 1. Restaurar música
        var savedTime = localStorage.getItem('audioTime');
        var isPlaying = localStorage.getItem('audioPlaying');

        if (savedTime) {
            audio.currentTime = parseFloat(savedTime);
        }

        if (isPlaying === 'true') {
            audio.play().then(() => {
                btn.innerHTML = "⏸ Pausar música";
                btn.style.backgroundColor = "#a8627a";
            }).catch(error => {
                console.log("Reproducción automática bloqueada:", error);
            });
        }

        // 2. Contador de favoritos
        actualizarContadorFavoritos();

        // 3. Modales del Header: Tratamiento de Datos y Quiénes Somos
        var modalDatos = document.getElementById('modalTratamientoDatos');
        var btnDatos = document.getElementById('btn-tratamiento-datos');
        var spanCloseDatos = document.getElementById('closeTratamientoDatos');
        var btnAceptarDatos = document.getElementById('btnAceptarDatos');

        if (btnDatos && modalDatos) {
            btnDatos.addEventListener('click', function(e) {
                e.preventDefault();
                modalDatos.style.display = 'block';
            });
            if (spanCloseDatos) spanCloseDatos.addEventListener('click', () => modalDatos.style.display = 'none');
            if (btnAceptarDatos) btnAceptarDatos.addEventListener('click', () => modalDatos.style.display = 'none');
        }

        var modalSomos = document.getElementById('modalQuienesSomos');
        var btnSomos = document.getElementById('btn-quienes-somos');
        var spanCloseSomos = document.getElementById('closeQuienesSomos');
        var btnAceptarSomos = document.getElementById('btnAceptarQuienesSomos');

        if (btnSomos && modalSomos) {
            btnSomos.addEventListener('click', function(e) {
                e.preventDefault();
                modalSomos.style.display = 'block';
            });
            if (spanCloseSomos) spanCloseSomos.addEventListener('click', () => modalSomos.style.display = 'none');
            if (btnAceptarSomos) btnAceptarSomos.addEventListener('click', () => modalSomos.style.display = 'none');
        }

        // 4. Modal Guía de Tallas
        var modalGuia = document.getElementById('modalGuiaTallas');
        var spanCloseGuia = document.getElementById('closeGuiaTallas');
        var btnAceptarGuia = document.getElementById('btnAceptarGuia');
        var botonesGuia = document.querySelectorAll('#btn-guia-tallas, .btn-guia-tallas-link');

        botonesGuia.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                if (modalGuia) modalGuia.style.display = 'block';
            });
        });

        if (spanCloseGuia) spanCloseGuia.addEventListener('click', () => modalGuia.style.display = 'none');
        if (btnAceptarGuia) btnAceptarGuia.addEventListener('click', () => modalGuia.style.display = 'none');

        // 5. Modal Favoritos
        var modalFav = document.getElementById('modalFavoritos');
        var btnAbrirFav = document.getElementById('btn-abrir-favoritos');
        var spanCloseFav = document.getElementById('closeFavoritos');
        var btnCerrarFav = document.getElementById('btnCerrarFavoritos');

        if (btnAbrirFav) {
            btnAbrirFav.addEventListener('click', function(e) {
                e.preventDefault();
                renderizarListaFavoritos();
                modalFav.style.display = 'block';
            });
        }
        if (spanCloseFav) spanCloseFav.addEventListener('click', () => modalFav.style.display = 'none');
        if (btnCerrarFav) btnCerrarFav.addEventListener('click', () => modalFav.style.display = 'none');

        // Cerrar modales al hacer clic fuera
        window.addEventListener('click', function(event) {
            if (modalGuia && event.target == modalGuia) modalGuia.style.display = 'none';
            if (modalFav && event.target == modalFav) modalFav.style.display = 'none';
            if (modalDatos && event.target == modalDatos) modalDatos.style.display = 'none';
            if (modalSomos && event.target == modalSomos) modalSomos.style.display = 'none';
        });

        // Configurar interacción con favoritos y carrito
        configurarBotonesFavoritos();
        configurarFormulariosCarrito();
    });

    function toggleMusica() {
        if (audio.paused) {
            audio.play();
            btn.innerHTML = "⏸ Pausar música";
            btn.style.backgroundColor = "#a8627a";
            localStorage.setItem('audioPlaying', 'true');
        } else {
            audio.pause();
            btn.innerHTML = "🎵 Reproducir ambiente relax";
            btn.style.backgroundColor = "#e092a6";
            localStorage.setItem('audioPlaying', 'false');
        }
    }

    window.addEventListener('beforeunload', function() {
        localStorage.setItem('audioTime', audio.currentTime);
        localStorage.setItem('audioPlaying', !audio.paused);
    });

    function configurarBotonesFavoritos() {
        var botonesFav = document.querySelectorAll('.btn-favorito');
        var favoritos = JSON.parse(localStorage.getItem('aura_favoritos')) || [];

        botonesFav.forEach(function(btn) {
            var id = btn.getAttribute('data-id');
            var existe = favoritos.some(item => item.id === id);
            if (existe) {
                btn.innerHTML = "❤️";
                btn.style.background = "#fff1f5";
            }

            btn.addEventListener('click', function() {
                var nombre = btn.getAttribute('data-nombre');
                var precio = btn.getAttribute('data-precio');
                var imagen = btn.getAttribute('data-imagen');

                var index = favoritos.findIndex(item => item.id === id);

                if (index > -1) {
                    favoritos.splice(index, 1);
                    btn.innerHTML = "🤍";
                    btn.style.background = "white";
                    mostrarToast("Se quitó de favoritos 🤍", "#888");
                } else {
                    favoritos.push({ id, nombre, precio, imagen });
                    btn.innerHTML = "❤️";
                    btn.style.background = "#fff1f5";
                    mostrarToast("¡Añadido a tus favoritos! 💖", "#a8627a");
                }

                localStorage.setItem('aura_favoritos', JSON.stringify(favoritos));
                actualizarContadorFavoritos();
            });
        });
    }

    function actualizarContadorFavoritos() {
        var favoritos = JSON.parse(localStorage.getItem('aura_favoritos')) || [];
        var contador = document.getElementById('contador-favoritos');
        if (contador) contador.innerText = favoritos.length;
    }

    function renderizarListaFavoritos() {
        var contenedor = document.getElementById('lista-favoritos-contenedor');
        var favoritos = JSON.parse(localStorage.getItem('aura_favoritos')) || [];

        if (favoritos.length === 0) {
            contenedor.innerHTML = `<p style="text-align: center; color: #888; font-size: 0.95rem;">Aún no tienes productos en favoritos. ¡Dale al corazón en las prendas que te gusten! 🌸</p>`;
            return;
        }

        var html = '';
        favoritos.forEach(function(item, index) {
            html += `
                <div style="display: flex; align-items: center; justify-content: space-between; border-bottom: 1px solid #f3abc8; padding: 10px 0;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <img src="${item.imagen}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 6px;" alt="${item.nombre}">
                        <div>
                            <h4 style="margin: 0; font-size: 0.95rem; color: #b16e4b;">${item.nombre}</h4>
                            <p style="margin: 3px 0 0 0; font-size: 0.85rem; color: #e47a9d; font-weight: bold;">$${item.precio}</p>
                        </div>
                    </div>
                    <button onclick="eliminarFavorito(${index})" style="background: #ffccd5; color: #a8627a; border: none; padding: 5px 10px; border-radius: 4px; font-size: 0.75rem; cursor: pointer; font-weight: bold;">Quitar</button>
                </div>
            `;
        });
        contenedor.innerHTML = html;
    }

    function eliminarFavorito(index) {
        var favoritos = JSON.parse(localStorage.getItem('aura_favoritos')) || [];
        favoritos.splice(index, 1);
        localStorage.setItem('aura_favoritos', JSON.stringify(favoritos));
        actualizarContadorFavoritos();
        renderizarListaFavoritos();
        configurarBotonesFavoritos();
    }

    function mostrarToast(mensaje, colorFondo = "#f3abc8") {
        var contenedor = document.getElementById('toast-container');
        if (!contenedor) return;

        var toast = document.createElement('div');
        toast.style.background = "white";
        toast.style.border = `2px solid ${colorFondo}`;
        toast.style.color = "#4e1e04";
        toast.style.padding = "12px 20px";
        toast.style.borderRadius = "8px";
        toast.style.boxShadow = "0 5px 15px rgba(0,0,0,0.15)";
        toast.style.fontSize = "0.9rem";
        toast.style.fontWeight = "600";
        toast.style.display = "flex";
        toast.style.alignItems = "center";
        toast.style.gap = "10px";
        toast.style.minWidth = "260px";
        toast.style.opacity = "0";
        toast.style.transform = "translateY(-20px)";
        toast.style.transition = "all 0.3s ease";
        toast.innerHTML = `<span>🛍️</span> <span>${mensaje}</span>`;

        contenedor.appendChild(toast);

        setTimeout(() => {
            toast.style.opacity = "1";
            toast.style.transform = "translateY(0)";
        }, 50);

        setTimeout(() => {
            toast.style.opacity = "0";
            toast.style.transform = "translateY(-20px)";
            setTimeout(() => toast.remove(), 300);
        }, 3500);
    }

    function configurarFormulariosCarrito() {
        var formularios = document.querySelectorAll('form[action*="carrito/add"]');

        formularios.forEach(function(form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(form);
                var actionUrl = form.getAttribute('action');
                var selectTalla = form.querySelector('select[name="talla"]');
                var tallaSeleccionada = selectTalla ? selectTalla.value : 'M';
                
                var card = form.closest('.product-card-container');
                var nombreProducto = "Prenda";
                if (card) {
                    var tituloH3 = card.querySelector('h3');
                    if (tituloH3) nombreProducto = tituloH3.innerText;
                }

                fetch(actionUrl, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        mostrarToast(`¡${nombreProducto} (Talla: ${tallaSeleccionada}) se añadió al carrito! 🌸`);
                    } else {
                        mostrarToast("Error al añadir al carrito", "#e47a9d");
                    }
                })
                .catch(error => {
                    mostrarToast(`¡${nombreProducto} (Talla: ${tallaSeleccionada}) añadida con éxito! 🌸`);
                });
            });
        });
    }
    </script>
</footer>
</body>
</html>