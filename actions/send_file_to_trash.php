<?php
include('../settings/config.php');
include('../settings/settingBD.php');


// Leer datos JSON del cuerpo de la solicitud
$data = json_decode(file_get_contents("php://input"), true);
$id_archivo = trim($data['id_archivo']) ?? '';

// Consultar el archivo
$query = "SELECT nombre_sistema FROM tbl_drive_files WHERE id_drive = $id_archivo";
$resultado = $servidor->query($query);

if ($resultado && $archivo = $resultado->fetch_assoc()) {

    $queryUpdate = "UPDATE tbl_drive_files SET en_papelera = 1, id_menu_link = 4 WHERE id_drive = '$id_archivo'";
    $query = $servidor->query($queryUpdate);
    if ($query) {
        echo json_encode(['success' => true, 'message' => 'Archivo enviado a la papelera correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al enviar el archivo a la papelera']);
    }

} else {
    echo json_encode(['success' => false, 'message' => 'El archivo no existe en la base de datos']);
}

// Cerrar conexión
$servidor->close();
