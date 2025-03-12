<?php
include('settings/config.php');
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

	// Obtener información adicional del archivo
	$nombreOriginal = $_FILES['file']['name'];
	$tipoMime = $_FILES['file']['type'];
	$tamano = $_FILES['file']['size'];

	// Generar un nombre único basado en timestamp y un número aleatorio
	$newFileName = time() . '_' . mt_rand(1000, 9999) . '.' . $extension;

	// Ruta completa del archivo
	$filePath = $uploadDir . '/' . $newFileName;
	$rutaRelativa = $uploadDir . '/' . $newFileName;

	// Mover el archivo subido a la ubicación final con el nuevo nombre
	if (move_uploaded_file($tmpFile, $filePath)) {
		// Conectar a la base de datos
		$servidor = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

		// Verificar conexión
		if ($servidor->connect_error) {
			echo json_encode([
				'success' => false,
				'error' => 'Error de conexión a la base de datos: ' . $servidor->connect_error
			]);
			exit;
		}

		// Configurar el charset
		if (!$servidor->set_charset("utf8mb4")) {
			echo json_encode([
				'success' => false,
				'error' => 'Error al cargar el conjunto de caracteres utf8mb4: ' . $servidor->error
			]);
			exit;
		}

		// Escapar los valores para evitar inyección SQL
		$nombreOriginalEsc = $servidor->real_escape_string($nombreOriginal);
		$newFileNameEsc = $servidor->real_escape_string($newFileName);
		$rutaRelativaEsc = $servidor->real_escape_string($rutaRelativa);
		$extensionEsc = $servidor->real_escape_string($extension);
		$tipoMimeEsc = $servidor->real_escape_string($tipoMime);
		$tamanoEsc = intval($tamano);

		// Construir consulta SQL
		$query = "INSERT INTO archivos (nombre_original, nombre_sistema, ruta, extension, tipo_mime, tamano, fecha_subida) 
                 VALUES ('$nombreOriginalEsc', '$newFileNameEsc', '$rutaRelativaEsc', '$extensionEsc', '$tipoMimeEsc', $tamanoEsc, NOW())";

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
