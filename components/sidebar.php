<div class="sidebar pt-2" id="sidebar">
    <div class="px-3">
        <button id="btnUploadFile" class="new-button btn d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modalUploadFile">
            <i class="bi bi-plus me-2"></i>
            <span>Subir nuevo archivo</span>
        </button>
    </div>

    <a id="btnCreateFolder" href="#" data-bs-toggle="modal" data-bs-target="#createFolder" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
        <i class="bi bi-folder me-3"></i>
        <span>Crear carpeta</span>
    </a>

    <div class="mt-2">
        <?php
        // Obtener el nombre del archivo actual sin parámetros
        $current_page = basename(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
        foreach ($directorios as $directorio) {
            $dir_url = trim($directorio['url_directorio'], './');
            // Verificar si la URL actual coincide con la URL del directorio
            $is_active = ($current_page == basename($dir_url));
        ?>
            <a href="<?php echo BASE_HOME . $dir_url; ?>?link=<?php echo $directorio['id_directorio']; ?>"
                id="directorio_<?php echo $directorio['id_directorio']; ?>?"
                data-id="<?php echo $directorio['id_directorio']; ?>"
                <?php echo ($directorio['id_directorio'] == 5) ? 'data-bs-toggle="modal" data-bs-target="#updateUser"' : ''; ?>
                class="sidebar-item d-flex align-items-center text-decoration-none mb-1 
            <?php echo ($is_active ? 'active' : ''); ?>">
                <i class="<?php echo $directorio['icono_directorio']; ?> me-3"></i>
                <span><?php echo $directorio['nombre_directorio'] . ' - ' . $directorio['id_directorio']; ?></span>
            </a>
        <?php } ?>
    </div>
</div>