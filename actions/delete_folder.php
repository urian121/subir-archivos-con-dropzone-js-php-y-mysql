<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$data = json_decode(file_get_contents("php://input"), true);
$idFolder = trim($data['idFolder']) ?? '';
$ruta_relativa_uploads = '../uploads/';

// Primero obtenemos todos los archivos asociados a esta carpeta
$query = "SELECT nombre_sistema FROM tbl_drive_files WHERE id_folder = '$idFolder'";
$resultado = $servidor->query($query);

$archivos_eliminados = 0;
$errores = [];

// Eliminamos físicamente los archivos
if ($resultado && $resultado->num_rows > 0) {
    while ($archivo = $resultado->fetch_assoc()) {
        $ruta_archivo = $ruta_relativa_uploads . $archivo['nombre_sistema'];
        
        if (file_exists($ruta_archivo)) {
            if (unlink($ruta_archivo)) {
                $archivos_eliminados++;
            } else {
                $errores[] = "Error al eliminar el archivo físico: " . $archivo['nombre_sistema'];
            }
        }
    }
}

// Eliminamos los registros de archivos de la base de datos
$query_eliminar_archivos = "DELETE FROM tbl_drive_files WHERE id_folder = '$idFolder'";
if (!$servidor->query($query_eliminar_archivos)) {
    $errores[] = "Error al eliminar registros de archivos de la base de datos";
}

// Eliminamos la carpeta de la base de datos
$query_eliminar = "DELETE FROM tbl_drive_folders WHERE id_folder = '$idFolder'";
if ($servidor->query($query_eliminar)) {
    if (empty($errores)) {
        echo json_encode([
            'success' => true, 
            'message' => 'Carpeta eliminada correctamente', 
        ]);
    } else {
        echo json_encode([
            'success' => true, 
            'message' => 'Carpeta eliminada con advertencias',
        ]);
    }
} else {
    $errores[] = "Error al eliminar la carpeta de la base de datos";
    echo json_encode([
        'success' => false, 
        'message' => 'Error al eliminar la carpeta',
    ]);
}

$servidor->close();