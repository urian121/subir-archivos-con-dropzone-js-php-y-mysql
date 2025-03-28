<?php
// Iniciar la sesión
session_start();

// Función para verificar si la sesión está activa y obtener información del usuario
function obtenerSesionActiva()
{
    if (isset($_SESSION['email_user']) && !empty($_SESSION['email_user'])) {
        return [
            'name' => $_SESSION['name_user'],
            'email' => $_SESSION['email_user'],
            'id' => $_SESSION['id_user'],
        ];
    }
    return false;
}