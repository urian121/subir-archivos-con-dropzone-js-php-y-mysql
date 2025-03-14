<?php
include('../settings/config.php');
include('../settings/settingBD.php');


// Obtener y validar el ID del archivo
$id_archivo = trim($_GET['id']);

$path = "../uploads/";
// Consultar el archivo en la base de datos
$query = "SELECT * FROM tbl_files WHERE id = $id_archivo AND activo = 1";
$resultado = $servidor->query($query);

// Verificar si el archivo existe
if ($resultado && $resultado->num_rows > 0) {
    $archivo = $resultado->fetch_assoc();

    // Construir la ruta completa al archivo
    $ruta_archivo = $path . $archivo['nombre_sistema'];

    // Verificar si el archivo existe físicamente
    if (file_exists($ruta_archivo)) {
        // Establecer las cabeceras para forzar la descarga
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivo['nombre_original'] . '"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta_archivo));

        // Limpiar el buffer de salida
        ob_clean();
        flush();

        // Leer y enviar el archivo
        readfile($ruta_archivo);

        // Cerrar la conexión
        $servidor->close();
        exit;
    } else {
        // El archivo no existe físicamente
        header('HTTP/1.0 404 Not Found');
        echo "El archivo solicitado no existe en el servidor. Ruta: " . $ruta_archivo;
    }
} else {
    // El archivo no existe en la base de datos
    header('HTTP/1.0 404 Not Found');
    echo "El archivo solicitado no existe o no está disponible.";
}

// Cerrar la conexión
$servidor->close();
