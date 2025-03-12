<?php
// Directorio de carga
$uploadDir = 'uploads';

// Crear el directorio si no existe
if (!is_dir($uploadDir)) {
	mkdir($uploadDir, 0777, true);
}

if (!empty($_FILES)) {
	$tmpFile = $_FILES['file']['tmp_name'];

	// Obtener la extensión del archivo original
	$extension = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);

	// Generar un nombre único basado en timestamp y un número aleatorio
	$newFileName = time() . '_' . mt_rand(1000, 9999) . '.' . $extension;

	// Ruta completa del archivo
	$filePath = $uploadDir . '/' . $newFileName;

	// Mover el archivo subido a la ubicación final con el nuevo nombre
	if (move_uploaded_file($tmpFile, $filePath)) {
		// Éxito al subir
		echo json_encode([
			'success' => true,
			'fileName' => $newFileName,
			'originalName' => $_FILES['file']['name']
		]);
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
