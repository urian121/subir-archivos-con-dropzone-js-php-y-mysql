<?php
include_once '../settings/auth.php';
$infUser = obtenerSesionActiva();
if (!$infUser) {
	header("location:../auth");
	exit();
}
include_once '../settings/config.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edumetrics Drive</title>
	<link rel="shortcut icon" href="<?php echo ASSETS_IMG ?>/icon.ico" />
	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/bootstrap.min.css?v=<?php echo mt_rand(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/dashboard.css?v=<?php echo mt_rand(); ?>">

	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/dropzone.min.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/home.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/preview_files.css">
	<link rel="stylesheet" href="<?php echo ASSETS_CSS ?>/loader.css">
</head>

<body>
	<div id='loader'></div>

	<div class="container-fluid p-0">
		<?php
		include_once(SETTINGS_BD);
		include(FUNCTIONS_PATH . '/funciones.php');
		$archivos_por_extensiones = archivosPorExtension($servidor);

		include(BASE_PATH_COMPONENTS . '/header.php');
		include(BASE_PATH_COMPONENTS . '/modalEliminarArchivoModal.html');
		include(BASE_PATH_COMPONENTS . '/modal_create_folder.php');
		include(BASE_PATH_COMPONENTS . '/modal_update_user.php');
		?>

		<div class="d-flex">
			<?php
			$directorios = obtenerDirectorios($servidor);
			include(BASE_PATH_COMPONENTS . '/sidebar.php');
			include(BASE_PATH_COMPONENTS . '/modal_file.php');
			$list_files = obtenerArchivosPapelera($servidor, $query_search = '');
			?>


			<div class="flex-grow-1 p-4 content-files">
				<div class="mt-4 mb-4">
					<?php
					if (count($list_files) > 0) { ?>
						<div class="row">
							<div class="col mb-5">
								<a href="<?php echo CLEAR_DASH; ?>">
									<i class="bi bi-trash me-3"></i>
									Limpiar la papelera</a>
							</div>
						</div>
					<?php } ?>

					<div id="searchResults" class="row">
						<?php
						include(BASE_PATH_COMPONENTS . '/files.php');
						?>
					</div>
				</div>
			</div>
		</div>


		<?php include(BASE_PATH_COMPONENTS . '/footerJS.php'); ?>

</body>

</html>