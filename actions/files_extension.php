<?php
include('../settings/config.php');
include('../settings/settingBD.php');
include(FUNCTIONS_PATH . '/funciones.php');

$extension = isset($_GET['extension']) ? trim($_GET['extension']) : '';
$id_menu_link = isset($_GET['id_menu_link']) ? trim($_GET['id_menu_link']) : 1;

$list_files = obtenerArchivosPorExtension($servidor, $extension, $id_menu_link);
include(BASE_PATH_COMPONENTS . '/files.php');