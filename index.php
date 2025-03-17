<?php
include_once 'settings/auth.php';
$infUser = obtenerSesionActiva();
if (!$infUser) {
	header("location:./auth");
	exit();
}
include_once 'settings/config.php';
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
			?>

			<div class="flex-grow-1 p-4 content-files">
				<div class="mt-4 mb-4">
					<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 g-3">
						<?php
						include(BASE_PATH_COMPONENTS . '/folders.php');
						?>
					</div>
				</div>


				<div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
					<?php
					$list_files = obtenerArchivosCompartidos($servidor, $id_directorio, $query_search = '');
					include(BASE_PATH_COMPONENTS . '/files.php');
					?>
				</div>
			</div>
		</div>
	</div>


	<?php include(BASE_PATH_COMPONENTS . '/footerJS.php'); ?>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Hacer los archivos arrastrables
			new Sortable(document.getElementById("searchResults"), {
				group: "shared",
				animation: 150,
			});

			// Hacer las carpetas receptivas a archivos
			document.querySelectorAll(".connected-list").forEach((folder) => {
				new Sortable(folder, {
					group: "shared",
					animation: 150,
					onAdd: function(evt) {
						let fileId = evt.item.getAttribute("data-id");
						let folderId = evt.to.closest(".folder").getAttribute("data-folder");
						let ruta = "actions/move_file.php";

						// Ocultar el archivo en la lista original
						let draggedFile = document.querySelector(`.file-item[data-id='${fileId}']`);
						if (draggedFile) {
							draggedFile.style.display = "none";
						}
						// Enviar datos al backend
						fetch(ruta, {
								method: "POST",
								headers: {
									"Content-Type": "application/json",
								},
								body: JSON.stringify({
									file_id: fileId,
									folder_id: folderId,
								}),
							})
							.then((response) => response.text())
							.then((html) => {
								console.log('Todo OK');
							})
							.catch((error) => console.error("Error al cargar archivos:", error));
					},
				});
			});
		});
	</script>

</body>

</html>