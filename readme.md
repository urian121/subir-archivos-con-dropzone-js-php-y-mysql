actions/
archivos-compartidos/
    index.php
archivos-en-papelera/
    index.php
assets/
    css/
    imgs/
    js/
auth/
    index.php
components/
    files.php
    footerJS.php
    header.php
    ......
functions/
    action_login.php
    funciones.php
settings/
    auth.php
    config.php
    settingBD.php
uploads/
    aqui se almacenan los archivos subidos

index.php
move_file.php
get_files_foldeer.php



### Marcar el directorio seleccionado

    <div class="mt-2">
        <?php
        $current_page = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
        foreach ($directorios as $directorio) {
            $dir_url = trim($directorio['url_directorio'], './');
            $is_active = ($current_page == $dir_url);
        ?>
            <a href="<?php echo BASE_HOME . $dir_url; ?>" id="directorio_<?php echo $directorio['id_directorio']; ?>"
                <?php echo ($directorio['id_directorio'] == 5) ? 'data-bs-toggle="modal" data-bs-target="#updateUser"' : ''; ?>
                class="sidebar-item d-flex align-items-center text-decoration-none mb-1 
        <?php echo ($is_active ? 'active' : ''); ?>">
                <i class="<?php echo $directorio['icono_directorio']; ?> me-3"></i>
                <span><?php echo $directorio['nombre_directorio']; ?></span>
            </a>

        <?php } ?>
    </div>