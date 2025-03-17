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
    <link rel="stylesheet" href="../assets/css/loader.css">
</head>

<body>

    <div id='loader'></div>

    <div class="login-card" id="loginDefault">
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
            <!--
            <div class="remember-forgot">
                <a href="#" class="forgot-password">Has olvidado tu contraseña?</a>
            </div>
            -->
            <button type="submit" class="login-btn" id="loginButton">
                Iniciar sesión
            </button>
        </form>
        <div class="signup-link">
            <p>Sí eres un estudiante, <a href="#" id="loginEstudiante">Iniciar sesión aquí</a></p>
        </div>
        <!---
        <div class="signup-link">
            <p>No tienes una cuenta? <a href="#">Registrarse</a></p>
        </div>
        -->
    </div>

    <div class="login-card d-none" id="loginEstudianteForm" style="display: none;">
        <div class="brand">
            <img class="brand-logo" src="../assets/imgs/logo-edumetrix-drive.png" alt="logo">
            <h1>Iniciar sesión como estudiante</h1>
        </div>

        <form action="<?= ACTION_LOGIN ?>" autocomplete="off" id="loginForm" method="POST">
            <input type="text" name="action" value="login_estudiante" hidden>
            <div class="form-group">
                <label for="password">Clave</label>
                <input type="password" name="password_user" autocomplete="off" required>
            </div>

            <button type="submit" class="login-btn" id="loginButton">
                Iniciar sesión
            </button>
        </form>

        <div class="signup-link d-flex justify-content-center">
            <a href="#" id="volverLoginDefault" class="btn-back d-flex align-items-center text-decoration-none">
                <img src="../assets/imgs/back.png" alt="Atrás">
                <span>Volver</span>
            </a>
        </div>



    </div>

    <script src="../assets/js/jquery-3.7.1.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            $("#loader").fadeOut("slow");

            document.getElementById("loginEstudiante").addEventListener("click", toggleForms);
            document.getElementById("volverLoginDefault").addEventListener("click", toggleForms);
        });

        function toggleForms(event) {
            event.preventDefault();
            let loginDefault = document.getElementById("loginDefault");
            let loginEstudiante = document.getElementById("loginEstudianteForm");

            loginDefault.style.display = loginDefault.style.display === "none" ? "block" : "none";
            loginEstudiante.style.display = loginEstudiante.style.display === "none" ? "block" : "none";
        }
    </script>
</body>

</html>