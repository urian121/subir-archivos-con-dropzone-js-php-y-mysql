function obtenerArchivos($servidor, $filtros = [], $orden = 'fecha_subida', $direccion = 'DESC') {
    // Construir la consulta base
    $query = "SELECT * FROM archivos WHERE activo = 1";
    
    // Aplicar filtros si existen
    if (!empty($filtros)) {
        if (isset($filtros['extension'])) {
            $extension = $servidor->real_escape_string($filtros['extension']);
            $query .= " AND extension = '$extension'";
        }
        
        if (isset($filtros['id_usuario'])) {
            $id_usuario = intval($filtros['id_usuario']);
            $query .= " AND id_usuario = $id_usuario";
        }
        
        // Búsqueda por nombre
        if (isset($filtros['buscar'])) {
            $buscar = $servidor->real_escape_string($filtros['buscar']);
            $query .= " AND (nombre_original LIKE '%$buscar%' OR descripcion LIKE '%$buscar%')";
        }
    }
    
    // Aplicar ordenamiento
    $orden = $servidor->real_escape_string($orden);
    $direccion = ($direccion == 'ASC') ? 'ASC' : 'DESC';
    $query .= " ORDER BY $orden $direccion";
    
    // Ejecutar la consulta
    $resultado = $servidor->query($query);
    
    // Verificar si hubo error en la consulta
    if (!$resultado) {
        return [
            'success' => false,
            'error' => 'Error en la consulta: ' . $servidor->error
        ];
    }
    
    // Procesar los resultados
    $archivos = [];
    while ($archivo = $resultado->fetch_assoc()) {
        $archivos[] = $archivo;
    }
    
    // Liberar el resultado
    $resultado->free();
    
    return [
        'success' => true,
        'total' => count($archivos),
        'archivos' => $archivos
    ];
}