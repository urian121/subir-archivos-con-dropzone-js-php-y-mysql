<?php
include_once '../middleware/authMiddleware.php';
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
	<title>Drive</title>
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
		$link_seleccionado = isset($_GET['link']) ? trim($_GET['link']) : 1;
		include_once(SETTINGS_BD);
		include(FUNCTIONS_PATH . '/funciones.php');
		$archivos_por_extensiones = archivosPorExtensionYDirectorio($servidor, $link_seleccionado);

		include(BASE_PATH_COMPONENTS . '/header.php');
		include(BASE_PATH_COMPONENTS . '/modal_update_user.php');
		include(BASE_PATH_COMPONENTS . '/modalPreviewImg.html');
		?>

		<div class="d-flex">
			<?php
			$links_menu = getLinksMenu($servidor);
			include(BASE_PATH_COMPONENTS . '/sidebar.php');
			include(BASE_PATH_COMPONENTS . '/modal_upload_files.php');
			$list_files = obtenerArchivosPapelera($servidor);
			?>


			<div class="flex-grow-1 p-4 content-files">
				<?php if (count($list_files)): ?>
					<section class="text-white" id="linkLimpiarPapelera">
						<a href="<?php echo CLEAR_TRASH; ?>?id_user=<?php echo $infUser['id']; ?>" class=" text-decoration-none text-white" title="Volver">
							<i class="bi bi-trash me-3"></i>
							Limpiar la papelera
						</a>
					</section>
				<?php endif; ?>
				<div class="mt-4 mb-4">
					<div id="searchResults" class="row mt-5">
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