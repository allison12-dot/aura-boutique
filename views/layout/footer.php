</div>
<footer>
    <p>&copy; <?=date('Y')?> Aura Boutique - Todos los derechos reservados SENA CDM</p>

    <!-- Botón Flotante Estilizado (Opción 2) -->
    <div id="music-player" style="position: fixed; bottom: 20px; left: 20px; z-index: 9999;">
        <button id="btn-music" onclick="toggleMusica()" style="background-color: #e092a6; color: white; border: none; padding: 10px 18px; border-radius: 25px; font-weight: bold; cursor: pointer;">
            🎵 Reproducir ambiente relax
        </button>
        <audio id="audio-bg" loop src="/aura-boutique/assets/audio/musica_relax.mp3"></audio>
    </div>

    <script>
    function toggleMusica() {
        var audio = document.getElementById('audio-bg');
        var btn = document.getElementById('btn-music');

        if (audio.paused) {
            audio.play();
            btn.innerHTML = "⏸ Pausar música";
            btn.style.backgroundColor = "#a8627a";
        } else {
            audio.pause();
            btn.innerHTML = "🎵 Reproducir ambiente relax";
            btn.style.backgroundColor = "#e092a6";
        }
    }

    // Lógica para las ventanas modales (Tratamiento de Datos y Quiénes Somos)
    document.addEventListener('DOMContentLoaded', function() {
        // --- Modal Tratamiento de Datos ---
        var modalDatos = document.getElementById('modalTratamientoDatos');
        var btnDatos = document.getElementById('btn-tratamiento-datos');
        var spanCloseDatos = document.getElementById('closeTratamientoDatos');
        var btnAceptarDatos = document.getElementById('btnAceptarDatos');

        if (btnDatos && modalDatos) {
            btnDatos.addEventListener('click', function(e) {
                e.preventDefault();
                modalDatos.style.display = 'block';
            });

            if (spanCloseDatos) {
                spanCloseDatos.addEventListener('click', function() {
                    modalDatos.style.display = 'none';
                });
            }

            if (btnAceptarDatos) {
                btnAceptarDatos.addEventListener('click', function() {
                    modalDatos.style.display = 'none';
                });
            }
        }

        // --- Modal Quiénes Somos ---
        var modalSomos = document.getElementById('modalQuienesSomos');
        var btnSomos = document.getElementById('btn-quienes-somos');
        var spanCloseSomos = document.getElementById('closeQuienesSomos');
        var btnAceptarSomos = document.getElementById('btnAceptarQuienesSomos');

        if (btnSomos && modalSomos) {
            btnSomos.addEventListener('click', function(e) {
                e.preventDefault();
                modalSomos.style.display = 'block';
            });

            if (spanCloseSomos) {
                spanCloseSomos.addEventListener('click', function() {
                    modalSomos.style.display = 'none';
                });
            }

            if (btnAceptarSomos) {
                btnAceptarSomos.addEventListener('click', function() {
                    modalSomos.style.display = 'none';
                });
            }
        }

        // Cerrar si el usuario hace clic fuera de cualquiera de las ventanas modales
        window.addEventListener('click', function(event) {
            if (modalDatos && event.target == modalDatos) {
                modalDatos.style.display = 'none';
            }
            if (modalSomos && event.target == modalSomos) {
                modalSomos.style.display = 'none';
            }
        });
    });
    </script>
</footer>
</body>
</html>