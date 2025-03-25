<?php
include_once('../settings/config.php');
include_once(SETTINGS_BD);

date_default_timezone_set("America/Bogota");

// Verificar si la sesión está activa
session_start();

// Si no existe la sesión, redirigir
if (!isset($_SESSION['id_user'])) {
    header("Location: ../?error=not_logged_in");
    exit();
}

$sesion_hasta_user = date("Y-m-d H:i:A");
$id_user = $_SESSION['id_user'];

// Actualizar la hora de cierre de sesión en la base de datos
$Update = "UPDATE tbl_users 
           SET sesion_hasta_user='$sesion_hasta_user'
           WHERE id_user='$id_user'";
$servidor->query($Update);

// Limpiar los datos de la sesión
session_unset();  // Elimina todas las variables de sesión
session_destroy(); // Destruye la sesión

// Eliminar la cookie de sesión
$parametros_cookies = session_get_cookie_params();
setcookie(session_name(), '', time() - 3600, $parametros_cookies["path"]);

// Redirigir al usuario
header("Location: ../?logout=1");
exit();
