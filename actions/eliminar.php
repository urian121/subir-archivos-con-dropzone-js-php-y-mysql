<?php
include('../settings/config.php');
include('../settings/bd.php');

// Verificar que la solicitud sea POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Leer datos JSON del cuerpo de la solicitud
    $data = json_decode(file_get_contents("php://input"), true);

    // Verificar que el ID del archivo esté presente y sea válido
    if (isset($data['id_archivo']) && is_numeric($data['id_archivo'])) {
        $id_archivo = intval($data['id_archivo']);

        // Consultar el archivo
        $query = "SELECT nombre_sistema FROM archivos WHERE id = $id_archivo";
        $resultado = $servidor->query($query);

        if ($resultado && $archivo = $resultado->fetch_assoc()) {
            $ruta_archivo = "uploads/" . $archivo['nombre_sistema'];

            // Eliminar el archivo de la base de datos
            $query_eliminar = "DELETE FROM archivos WHERE id = $id_archivo";
            if ($servidor->query($query_eliminar)) {
                // Intentar eliminar el archivo físico
                $mensaje = (file_exists($ruta_archivo) && unlink($ruta_archivo))
                    ? 'Archivo eliminado correctamente'
                    : 'Archivo eliminado de la base de datos, pero no se pudo eliminar del servidor';

                echo json_encode(['success' => true, 'message' => $mensaje]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error al eliminar el archivo de la base de datos']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'El archivo no existe en la base de datos']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ID del archivo inválido']);
    }

    // Cerrar conexión
    $servidor->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Solicitud inválida']);
}
?>