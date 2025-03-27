<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
include('../settings/config.php');
include('../settings/settingBD.php');

$nombre_folder  = trim($_POST['nombre_folder']);
$created_by     = trim($_POST['created_by']);
$id_menu_link  = ucfirst(trim($_POST['id_menu_link'])) ?? 1; // ID del directorio seleccionado por default el directorio 1
$id_folder_padre = !empty(trim($_POST['id_folder_padre'])) ? trim($_POST['id_folder_padre']) : null;

// Verificar si el directorio existe
$checkDirectorio = "SELECT id_menu_link FROM tbl_drive_menu_links WHERE id_menu_link = $id_menu_link";
$resultDir = $servidor->query($checkDirectorio);
if ($resultDir->num_rows == 0) {
    die("Error: El id_menu_link ($id_menu_link) no existe.");
}

$query = $id_folder_padre === null
    ? "INSERT INTO tbl_drive_folders (nombre_folder, id_menu_link, created_by) VALUES ('$nombre_folder', '$id_menu_link', '$created_by')"
    : "INSERT INTO tbl_drive_folders (nombre_folder, id_menu_link, created_by, id_folder_padre) VALUES ('$nombre_folder', '$id_menu_link', '$created_by', '$id_folder_padre')";


if ($servidor->query($query) === TRUE) {
    // Redireccionar a la página anterior
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $query . "<br>" . $servidor->error;
}
} else {
    echo "Error: Método de solicitud no permitido.";
}