<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include('../settings/config.php');
include('../settings/settingBD.php');

$en_papelera ='1';
$ruta_relativa_uploads = '../uploads/';

// Obtener todos los archivos que deben eliminarse
$query = "SELECT nombre_sistema FROM tbl_drive_files WHERE en_papelera = '$en_papelera'";
$resultado = $servidor->query($query);

$archivos_a_eliminar = [];
if ($resultado) {
    while ($archivo = $resultado->fetch_assoc()) {
        $ruta_archivo =$ruta_relativa_uploads . $archivo['nombre_sistema'];
        if (file_exists($ruta_archivo)) {
            if (unlink($ruta_archivo)) {
                $archivos_a_eliminar[] = $archivo['nombre_sistema'];
            } else {
                echo "Error al eliminar: " . $archivo['nombre_sistema'] . "<br>";
                exit;
            }
        } else {
            echo "No se encontró el archivo: " . $ruta_archivo . "<br>";
        }
    }
}

// Si se eliminaron archivos del servidor, eliminamos los registros de la base de datos
if (!empty($archivos_a_eliminar)) {
    $query_eliminar = "DELETE FROM tbl_drive_files WHERE en_papelera = '$en_papelera'";
    if ($servidor->query($query_eliminar)) {
        header("location:../archivos-en-papelera/");
        exit;
    } else {
        //echo "Error al eliminar registros de la base de datos: " . $servidor->error;
        header("location:../");
       exit;
    }
} else {
    // echo 'no hay archivos para eliminar';
   header("location:../");
   exit;
}
$servidor->close();
