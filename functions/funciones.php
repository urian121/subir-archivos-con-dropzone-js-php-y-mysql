<?php
function obtenerArchivos($servidor)
{
    // Construir la consulta base
    $query = "SELECT * FROM archivos WHERE activo = 1 ORDER BY id DESC";
    $resultado = $servidor->query($query);

    // Verificar si hubo error en la consulta
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

function archivosPorExtension($servidor)
{
    $query = "SELECT extension FROM archivos WHERE activo = 1 GROUP BY extension";
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