<?php

/**
 * Función para obtener los archivos compartidos,que pertenecen al directorio actual
 */
function obtenerArchivosCompartidos($servidor, $id_directorio, $query_search)
{
    // Construir la consulta base
    $query = "SELECT 
            id_drive, nombre_original,
            nombre_sistema, extension, ruta 
        FROM tbl_drive_files
        WHERE activo = 1 
        -- AND  shared_files = 1
        AND id_directorio = '$id_directorio'
        AND  nombre_original LIKE '%$query_search%'
        ORDER BY id_drive DESC";
    $resultado = $servidor->query($query);
    $archivos = [];
    while ($archivo = $resultado->fetch_assoc()) {
        $archivos[] = $archivo;
    }

    return $archivos;
}

function archivosPorExtension($servidor)
{
    $query = "SELECT extension FROM tbl_drive_files WHERE activo = 1 GROUP BY extension";
    $resultado = $servidor->query($query);

    if (!$resultado) {
        return [
            'success' => false,
            'error' => 'Error en la consulta: ' . $servidor->error
        ];
    }

    $archivos = [];
    while ($archivo = $resultado->fetch_assoc()) {
        $archivos[] = $archivo;
    }

    return $archivos;
}

function obtenerIcono($extension)
{
    $iconos = [
        'csv' => '📊',
        'doc' => '📄',
        'gif' => '🖼️',
        'jpg' => '🖼️',
        'md' => '📜',
        'mp4' => '🎥',
        'pdf' => '📕',
        'pptx' => '📽️',
        'sql' => '💾',
        'tar' => '🗜️',
        'txt' => '📑',
        'webp' => '🖼️',
        'zip' => '📦'
    ];
    return $iconos[$extension] ?? '📁'; // Icono por defecto si no encuentra la extensión
}

// Obtener archivos de una carpeta específica
function obtenerArchivosPorCarpeta($servidor, $folderId)
{
    $folderId = trim($folderId);
    $query = "SELECT * FROM tbl_drive_files WHERE id_folder = '$folderId'";
    $result = mysqli_query($servidor, $query);

    // Crear un array para almacenar los archivos
    $archivos = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $archivos[] = $row;
        }
    }
    return $archivos;
}


function obtenerVistaPrevia($archivo)
{
    $extension = strtolower(pathinfo($archivo['nombre_sistema'], PATHINFO_EXTENSION));

    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
        // Vista previa de imágenes y SVG
        $ruta_file = UPLOADS_PATH . $archivo['nombre_sistema'];
        return "<img src='{$ruta_file}' class='file-preview-img' alt='Vista previa'>";
    } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
        // Vista previa de videos
        return "<video class='file-preview-video' controls>
                    <source src='{$archivo['ruta']}' type='video/{$extension}'>
                    Tu navegador no soporta el video.
                </video>";
    }
    return ''; // Si no es un tipo soportado, retornar vacío
}

function obtenerIconoArchivo($extension)
{
    $icons = [
        'pdf'   => 'bi-file-earmark-pdf text-danger',
        'doc'   => 'bi-file-earmark-word text-primary',
        'docx'  => 'bi-file-earmark-word text-primary',
        'xls'   => 'bi-file-earmark-excel text-success',
        'xlsx'  => 'bi-file-earmark-excel text-success',
        'ppt'   => 'bi-file-earmark-ppt text-warning',
        'pptx'  => 'bi-file-earmark-ppt text-warning',
        'zip'   => 'bi-file-earmark-zip text-secondary',
        'rar'   => 'bi-file-earmark-zip text-secondary',
        'tar'   => 'bi-file-earmark-zip text-secondary',
        'gz'    => 'bi-file-earmark-zip text-secondary',
        'sql'   => 'bi-file-earmark-code text-info',
        'md'    => 'bi-file-earmark-code text-dark',
        'markdown' => 'bi-file-earmark-code text-dark',
        'csv'   => 'bi-file-earmark-spreadsheet text-success',
        'txt'   => 'bi-file-earmark-text text-muted',
        'svg'   => 'bi-file-earmark-image text-primary'
    ];

    return $icons[$extension] ?? 'bi-file-earmark-text';
}

function getPerfil($servidor, $id_user)
{
    $row = [];
    $sql = "SELECT email_user, id_user, name_user FROM tbl_users WHERE id_user = '{$id_user}' AND estatus_user = 1";
    $result = $servidor->query($sql);
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }
    return $row;
}


// Archivos en papelera
function obtenerArchivosPapelera($servidor)
{
    $archivos = [];
    $sql = "SELECT * FROM tbl_drive_files WHERE en_papelera = 1 ORDER BY id_drive DESC";
    $result = $servidor->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $archivos[] = $row;
        }
    }
    return $archivos;
}

// Lista de directorios
function obtenerDirectorios($servidor)
{
    $directorios = [];
    $sql = "SELECT * FROM tbl_drive_directorios  WHERE estatus_directorio = 1 ORDER BY posicion_directorio ASC";
    $result = $servidor->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $directorios[] = $row;
        }
    }
    return $directorios;
}

// Funcion para obtener carpetas por directorio
function obtenerCarpetasPorDirectorio($servidor, $id_folder)
{
    $carpetas = [];
    $sql = "SELECT * FROM tbl_drive_folders  WHERE estatus_folder = 1 AND id_directorio ='$id_folder ' ORDER BY id_folder DESC";
    $resultado = mysqli_query($servidor, $sql);

    if ($resultado) {
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $carpetas[] = $fila;
        }
    }

    return $carpetas;
}