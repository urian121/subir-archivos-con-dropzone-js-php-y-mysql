<?php
include('../settings/config.php');
include('../settings/settingBD.php');
include(FUNCTIONS_PATH . '/funciones.php');

$extension = isset($_GET['extension']) ? trim($_GET['extension']) : '';
$id_directorio = isset($_GET['id_directorio']) ? trim($_GET['id_directorio']) : 1;
$where = "WHERE activo = 1 AND id_directorio ='$id_directorio'";
if ($extension !== 'all' && $extension !== '') {
    $where .= " AND extension LIKE '%$extension%'";
}

$query = "SELECT * FROM tbl_drive_files $where";
$list_files = mysqli_query($servidor, $query);
include(BASE_PATH_COMPONENTS . '/files.php');