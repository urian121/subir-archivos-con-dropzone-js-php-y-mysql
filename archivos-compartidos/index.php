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
		include(BASE_PATH_COMPONENTS . '/header.php');
		include(BASE_PATH_COMPONENTS . '/modalEliminarArchivoModal.html');
		include(BASE_PATH_COMPONENTS . '/modal_update_user.php');

		?>

		<div class="d-flex">
			<?php
			include(BASE_PATH_COMPONENTS . '/sidebar.php');
			include(BASE_PATH_COMPONENTS . '/modal_file.php');
			?>

			<div class="flex-grow-1 p-4 content-files">
				<div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
					<?php
					$list_files = obtenerArchivosCompartidos($servidor, $query_search = '');
					include(BASE_PATH_COMPONENTS . '/files.php');
					?>
				</div>
			</div>
		</div>
	</div>


	<script src="<?php echo ASSETS_JS; ?>/jquery-3.7.1.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/popper.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/bootstrap.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/sidebar.js"></script>

	<script src="<?php echo ASSETS_JS; ?>/axios.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/dropzone.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/custom_dropzone.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/search_files.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/fitro_files_extension.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/eliminar_archivo.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/sortable.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/custom_sortable.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/open_folder.js?v=<?php echo mt_rand(); ?>"></script>

</body>

</html>