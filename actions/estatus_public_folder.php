<?php
include('../settings/config.php');
include('../settings/settingBD.php');


$id_folder = trim($_GET['id_folder']);
$estatus = trim($_GET['estatus'] == 1 ? 0 : 1);

$queryUpdate = "UPDATE tbl_drive_folders 
    SET public = '$estatus'
    WHERE id_folder = '$id_folder'";
    print_r($queryUpdate);
if ($servidor->query($queryUpdate) === TRUE) {
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    echo "Error: " . $queryUpdate . "<br>" . $servidor->error;
}
