<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$nombre_folder = trim($_POST['nombre_folder']);
$created_by = trim($_POST['created_by']);

$query = "INSERT INTO tbl_drive_folders (nombre_folder, created_by) VALUES ('$nombre_folder', '$created_by')";
if ($servidor->query($query) === TRUE) {
    header("location:../");
}else{
    echo "Error: " . $query . "<br>" . $servidor->error;
}
