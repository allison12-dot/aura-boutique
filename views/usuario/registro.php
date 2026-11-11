<h2>Registrarse en Aura Boutique</h2>

<!-- Muestra las notificaciones según el estado del registro -->
<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
    <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; max-width: 400px; font-weight: bold; text-align: center;">
        ¡Registro completado con éxito! 🎉 Ya puedes iniciar sesión.
    </div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'duplicate'): ?>
    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; max-width: 400px; font-weight: bold; text-align: center;">
        El correo ya se encuentra registrado. Intenta con otro.
    </div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed_password'): ?>
    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; max-width: 400px; font-weight: bold; text-align: center;">
        La contraseña no cumple con los requisitos mínimos de seguridad.
    </div>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
    <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 12px 15px; border-radius: 6px; margin-bottom: 15px; max-width: 400px; font-weight: bold; text-align: center;">
        Error al registrar el usuario. Introduce bien los datos.
    </div>
<?php endif; ?>

<?php 
// Borramos la sesión para que el mensaje desaparezca al actualizar la página
if (isset($_SESSION['register'])) {
    unset($_SESSION['register']);
} 
?>

<form action="<?=base_url?>usuario/save" method="POST" style="max-width: 400px; margin: 20px 0;">
    <div style="margin-bottom: 15px;">
        <label for="nombre" style="display:block; margin-bottom: 5px;">Nombre:</label>
        <input type="text" name="nombre" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="apellidos" style="display:block; margin-bottom: 5px;">Apellidos:</label>
        <input type="text" name="apellidos" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="email" style="display:block; margin-bottom: 5px;">Email:</label>
        <input type="email" name="email" required style="width: 100%; padding: 8px;">
    </div>

    <div style="margin-bottom: 15px;">
        <label for="password" style="display:block; margin-bottom: 5px;">Contraseña:</label>
        <input type="password" name="password" required 
               pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&]).{8,}" 
               title="Debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas, un número y un carácter especial (@$!%*?&)." 
               style="width: 100%; padding: 8px;">
    </div>

    <button type="submit" style="background: #c999af; color: white; border: none; padding: 10px 20px; cursor: pointer;">
        Registrarse
    </button>
</form>