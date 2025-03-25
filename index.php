<?php
include_once 'settings/auth.php';
$infUser = obtenerSesionActiva();
if (!$infUser) {
	header("location:./auth");
	exit();
}

header("Location: " . './mis-archivos/');
exit;

?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Drive</title>
</head>

<body>

</body>

</html>