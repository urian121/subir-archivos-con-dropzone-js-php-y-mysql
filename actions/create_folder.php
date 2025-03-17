<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$nombre_folder  = trim($_POST['nombre_folder']);
$created_by     = trim($_POST['created_by']);
$id_directorio  = trim($_POST['id_directorio']); // ID del directorio seleccionado


// Verificar si el directorio existe
$checkDirectorio = "SELECT id_directorio FROM tbl_drive_directorios WHERE id_directorio = $id_directorio";
$resultDir = $servidor->query($checkDirectorio);
if ($resultDir->num_rows == 0) {
    die("Error: El id_directorio ($id_directorio) no existe.");
}

$query = "INSERT INTO tbl_drive_folders (nombre_folder, id_directorio, created_by) 
VALUES ('$nombre_folder', '$id_directorio', '$created_by')";

if ($servidor->query($query) === TRUE) {
    // Redireccionar a la página anterior
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $query . "<br>" . $servidor->error;
}