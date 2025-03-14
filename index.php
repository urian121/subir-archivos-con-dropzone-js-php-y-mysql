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
	<link rel="shortcut icon" href="assets/imgs/icon.ico" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo mt_rand(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/dashboard.css?v=<?php echo mt_rand(); ?>">

	<link rel="stylesheet" href="assets/css/dropzone.min.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="assets/css/home.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="assets/css/preview_files.css">
	<link rel="stylesheet" href="assets/css/loader.css">
</head>

<body>

	<div id='loader'></div>

	<div class="container-fluid p-0">
		<?php
		include_once(SETTINGS_BD);
		include('functions/funciones.php');
		$archivos_por_extensiones = archivosPorExtension($servidor);
		include('components/header.php');
		include('components/modalEliminarArchivoModal.html');
		include('components/modal_update_user.php');

		?>

		<div class="d-flex">
			<?php
			include('components/sidebar.php');
			include('components/modal_file.php');
			?>

			<div class="flex-grow-1 p-4 content-files">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
						<?php
						// Obtener carpetas (esto depende de cómo almacenas las carpetas en tu BD)
						$query_folders = "SELECT id_folder, nombre_folder FROM tbl_folders";
						$resultado_folders = mysqli_query($servidor, $query_folders);
						?>
						<div class="mt-4 mb-4">
							<h3>📂 Carpetas</h3>
							<div class="d-flex gap-3">
								<?php if ($resultado_folders) {
									foreach ($resultado_folders as $folder) { ?>
										<div class="folder border p-3" data-folder="<?php echo $folder['id_folder']; ?>">
											<h4>📁 <?php echo $folder['nombre_folder']; ?></h4>
											<ul class="list-group connected-list"></ul>
										</div>
								<?php }
								} ?>
							</div>
						</div>
					</div>
				</div>

				<div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
					<?php
					$list_files = obtenerArchivos($servidor, $query_search = '');
					include('components/files.php');
					?>
				</div>
			</div>
		</div>
	</div>


	<script src="assets/js/jquery-3.7.1.min.js"></script>
	<script src="assets/js/popper.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

	<script src="assets/js/axios.min.js"></script>
	<script src="assets/js/dropzone.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="assets/js/custom_dropzone.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="assets/js/search_files.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="assets/js/fitro_files_extension.js"></script>
	<script src="assets/js/eliminar_archivo.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="assets/js/sortable.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="assets/js/custom_sortable.js?v=<?php echo mt_rand(); ?>"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			// Cuando se hace clic en una carpeta, obtener los archivos dentro de esa carpeta
			document.querySelectorAll('.folder').forEach((folder) => {
				folder.addEventListener('click', function() {
					let folderId = folder.getAttribute('data-folder');

					// Realizar la solicitud para obtener los archivos de la carpeta
					fetch(`get_files_folder.php?folder_id=${folderId}`)
						.then((response) => response.text()) // Cambiar .json() por .text() ya que el PHP devuelve HTML
						.then((data) => {
							console.log('Archivos en la carpeta:', data); // Ver los archivos en la consola

							// Mostrar los archivos en la UI
							const filesContainer = document.getElementById('searchResults'); // El contenedor donde mostrar los archivos
							filesContainer.innerHTML = ''; // Limpiar el contenido antes de mostrar los nuevos archivos

							// Insertar el HTML recibido en el contenedor
							filesContainer.innerHTML = data; // Se inserta el HTML directamente
						})
						.catch((error) => {
							console.error('Error al cargar los archivos:', error);
						});
				});
			});
		});
	</script>

</body>

</html>