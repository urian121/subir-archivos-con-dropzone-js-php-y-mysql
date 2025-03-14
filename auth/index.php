<?php
include_once '../settings/auth.php'; // valida si hay session activa
$infUser = obtenerSesionActiva();
// si hay sesion activa, redirigir al home
if ($infUser) {
    header("location:../");
    exit();
}
include_once '../settings/config.php'; // obtener parametros de configuracion
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edumetrics Drive</title>
    <link rel="shortcut icon" href="../assets/imgs/icon.ico" />
    <link rel="stylesheet" href="../assets/css/login.css">
</head>

<body>
    <div class="login-card">
        <div class="brand">
            <img class="brand-logo" src="../assets/imgs/logo-edumetrix-drive.png" alt="logo">
            <h1>Iniciar sesión en EduDrive</h1>
        </div>

        <form action="<?= ACTION_LOGIN ?>" autocomplete="off" id="loginForm" method="POST">
            <input type="text" name="action" value="login_user" hidden>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email_user" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="password">Clave</label>
                <input type="password" name="password_user" autocomplete="off" required>
            </div>

            <div class="remember-forgot">
                <a href="#" class="forgot-password">Has olvidado tu contraseña?</a>
            </div>

            <button type="submit" class="login-btn" id="loginButton">
                Iniciar sesión
            </button>
        </form>

        <div class="signup-link">
            <p>Sí eres un estudiante, <a href="#">Iniciar sesión aquí</a></p>
        </div>
        <div class="signup-link">
            <p>No tienes una cuenta? <a href="#">Registrarse</a></p>
        </div>
    </div>
</body>

</html>