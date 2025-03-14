<?php

/**
 * Configuración de la base de datos
 *
 * DB_HOST: Dirección del servidor de la base de datos
 * DB_USER: Nombre de usuario de la base de datos
 * DB_PASSWORD: Contrasena de la base de datos
 * DB_NAME: Nombre de la base de datos
 */

$servidor = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
// Verificar conexión
if ($servidor->connect_error) {
    die("Error de conexión: " . $servidor->connect_error);
}


// Configurar el charset a utf8mb4 o utf8 para aceptar caracteres especiales
if (!$servidor->set_charset("utf8mb4")) {
    die("Error cargando el conjunto de caracteres utf8mb4: " . $servidor->error);
} else {
  // echo "Conexión exitosa con charset utf8mb4";
}
