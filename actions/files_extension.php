<?php
include('../settings/config.php');
include('../settings/settingBD.php');
include(FUNCTIONS_PATH . '/funciones.php');

$extension = isset($_GET['extension']) ? trim($_GET['extension']) : '';
$id_directorio = isset($_GET['id_directorio']) ? trim($_GET['id_directorio']) : 1;

$list_files = obtenerArchivosPorExtension($servidor, $extension, $id_directorio);
include(BASE_PATH_COMPONENTS . '/files.php');