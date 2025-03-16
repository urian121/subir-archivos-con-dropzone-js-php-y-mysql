<div class="sidebar pt-2" id="sidebar">
    <div class="px-3">
        <button class="new-button btn d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus me-2"></i>
            <span>Subir nuevo archivo</span>
        </button>
    </div>

    <a href="#" data-bs-toggle="modal" data-bs-target="#createFolder" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
        <i class="bi bi-folder me-3"></i>
        <span>Crear carpeta</span>
    </a>

    <div class="mt-2">
        <?php
        $current_page = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
        foreach ($directorios as $directorio) {
            $dir_url = trim($directorio['url_directorio'], './');
            $is_active = ($current_page == $dir_url);
        ?>
            <a href="<?php echo BASE_HOME . $dir_url; ?>"
                <?php echo ($directorio['id_directorio'] == 5) ? 'data-bs-toggle="modal" data-bs-target="#updateUser"' : ''; ?>
                class="sidebar-item d-flex align-items-center text-decoration-none mb-1 
        <?php echo ($is_active ? 'active' : ''); ?>">
                <i class="<?php echo $directorio['icono_directorio']; ?> me-3"></i>
                <span><?php echo $directorio['nombre_directorio']; ?></span>
            </a>
        <?php } ?>
    </div>
</div>