<?php
include('../settings/config.php');
include('../settings/settingBD.php');

// Directorio de carga
$uploadDir = '../uploads';

// Crear el directorio si no existe
if (!is_dir($uploadDir)) {
	mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES)) {
	$tmpFile = $_FILES['file']['tmp_name'];

	// Obtener la extensión del archivo original
	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	// Obtener información adicional del archivo
	$nombreOriginal = $_FILES['file']['name'];
	$tipoMime = $_FILES['file']['type'];
	$tamano = $_FILES['file']['size'];
	$id_usuario = trim($_POST['id_usuario']);
	$id_folder_seleccionado = trim($_POST['id_folder_seleccionado']);
	$id_directorio_seleccionado = trim($_POST['id_directorio_seleccionado']);

	// Generar un nombre único basado en timestamp y un número aleatorio
	$newFileName = time() . '_' . mt_rand(1000, 9999) . '.' . $extension;

	// Ruta completa del archivo
	$filePath = $uploadDir . '/' . $newFileName;
	$rutaRelativa = 'uploads/' . $newFileName;

	// Mover el archivo subido a la ubicación final con el nuevo nombre
	if (move_uploaded_file($tmpFile, $filePath)) {
		// Escapar los valores para evitar inyección SQL
		$nombreOriginalEsc = $servidor->real_escape_string($nombreOriginal);
		$newFileNameEsc = $servidor->real_escape_string($newFileName);
		$rutaRelativaEsc = $servidor->real_escape_string($rutaRelativa);
		$extensionEsc = $servidor->real_escape_string($extension);
		$tipoMimeEsc = $servidor->real_escape_string($tipoMime);
		$tamanoEsc = intval($tamano);

		// Construir consulta SQL
		$query = "INSERT INTO tbl_drive_files (nombre_original, nombre_sistema, ruta, extension, tipo_mime, tamano, fecha_subida, id_usuario, id_folder, id_directorio) 
                 VALUES ('$nombreOriginalEsc', '$newFileNameEsc', '$rutaRelativaEsc', '$extensionEsc', '$tipoMimeEsc', $tamanoEsc, NOW(), $id_usuario, $id_folder_seleccionado, $id_directorio_seleccionado)";
		// Ejecutar la consulta
		if ($servidor->query($query)) {
			// Obtener el ID insertado
			$fileId = $servidor->insert_id;

			// Éxito al subir y guardar en la BD
			echo json_encode([
				'success' => true,
				'fileId' => $fileId,
				'fileName' => $newFileName,
				'originalName' => $nombreOriginal
			]);
		} else {
			echo json_encode([
				'success' => false,
				'error' => 'Error al guardar en la base de datos: ' . $servidor->error,
				'fileName' => $newFileName
			]);
		}

		// Cerrar la conexión
		$servidor->close();
	} else {
		// Error al subir
		echo json_encode([
			'success' => false,
			'error' => 'Error al mover el archivo subido'
		]);
	}
} else {
	// No se encontraron archivos
	echo json_encode([
		'success' => false,
		'error' => 'No se recibieron archivos'
	]);
}
