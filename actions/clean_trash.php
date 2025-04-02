<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$en_papelera ='1';
$ruta_relativa_uploads = '../uploads/';
$id_user = trim($_GET['id_user']);

// Obtener todos los archivos que deben eliminarse
$query = "SELECT nombre_sistema FROM tbl_drive_files WHERE en_papelera = '$en_papelera' AND id_usuario = '$id_user'";
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
    $query_eliminar = "DELETE FROM tbl_drive_files WHERE en_papelera = '$en_papelera' AND id_usuario = '$id_user'";
    if ($servidor->query($query_eliminar)) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        //echo "Error al eliminar registros de la base de datos: " . $servidor->error;
        header("Location: " . $_SERVER['HTTP_REFERER']);
       exit;
    }
} else {
    // echo 'no hay archivos para eliminar';
    header("Location: " . $_SERVER['HTTP_REFERER']);
   exit;
}
$servidor->close();
