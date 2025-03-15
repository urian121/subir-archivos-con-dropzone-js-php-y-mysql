<?php
include('settings/config.php');
include('settings/settingBD.php');

// Recibir datos JSON
$data = json_decode(file_get_contents("php://input"), true);
$fileId = $data['file_id'];
$folderId = $data['folder_id'];

// Actualizar la base de datos, mover el archivo a la nueva carpeta
$queryUpdate = "UPDATE tbl_files SET id_folder = '$folderId' WHERE id = '$fileId'";
$query = $servidor->query($queryUpdate);

// Verificar si la actualización fue exitosa
if ($query) {
    // echo json_encode(["status" => "success", "message" => "Archivo movido exitosamente"]);
} else {
    // echo json_encode(["status" => "error", "message" => "Error al mover el archivo"]);
}

mysqli_close($servidor);
