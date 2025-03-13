<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edumetrics Drive</title>
	<link rel="shortcut icon" href="assets/imgs/logo-edumetrix-drive.png" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo mt_rand(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/dashboard.css?v=<?php echo mt_rand(); ?>">

	<link rel="stylesheet" href="assets/css/dropzone.min.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="assets/css/home.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="assets/css/preview_files.css">

</head>

<body>

	<div class="container-fluid p-0">
		<?php
		include('settings/config.php');
		include('settings/bd.php');
		include('functions/funciones.php');
		$archivos_por_extensiones = archivosPorExtension($servidor);
		include('components/header.php');
		$resultado = obtenerArchivos($servidor);
		?>

		<div class="d-flex">
			<?php
			include('components/sidebar.php');
			include('components/modal_file.php');
			?>

			<div class="flex-grow-1 p-4 content-files">
				<div id="searchResults" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">

					<?php
					include('components/modalEliminarArchivoModal.html');
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
	<script src="assets/js/eliminar_archivo.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="assets/js/search_files.js"></script>
	<script src="assets/js/fitro_files_extension.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Desactivar el autodescubrimiento
			Dropzone.autoDiscover = false;

			// Verificar si ya existe una instancia de Dropzone en el elemento
			var dropzoneElement = document.getElementById("demo-upload");

			// Si ya hay una instancia, la destruimos primero
			if (dropzoneElement.dropzone) {
				dropzoneElement.dropzone.destroy();
			}

			// Inicializar Dropzone
			var myDropzone = new Dropzone("#demo-upload", {
				url: "./actions/upload.php", // URL de destino
				paramName: "file", // Nombre del parámetro de archivo
				maxFilesize: 10, // Tamaño máximo en MB
				maxFiles: 10, // Cantidad máxima de archivos
				acceptedFiles: "image/*,application/pdf,text/plain,.zip,.tar,.gz,.sql,.md,.markdown,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,video/*",
				//acceptedFiles: "image/*,application/pdf",
				dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para subir",
				autoProcessQueue: false, // No procesar automáticamente la cola
				addRemoveLinks: true
			});

			// Manejar el envío del formulario
			dropzoneElement.addEventListener("submit", function(e) {
				e.preventDefault(); // Evitar el envío del formulario
				e.stopPropagation(); // Evitar la propagación del evento de submit
			});

			// Configurar el botón de subida
			document.getElementById("uploadBtn").addEventListener("click", function(e) {
				e.preventDefault();
				e.stopPropagation();

				if (myDropzone.getQueuedFiles().length > 0) {
					console.log("Subiendo archivos...");
					myDropzone.processQueue();
				} else {
					alert("No hay archivos para subir.");
				}
			});

			// Verificar cuando se completen todos los archivos
			myDropzone.on("queuecomplete", function() {
				console.log("Todos los archivos han sido subidos.");
				// Eliminar todos los archivos de la zona de carga
				myDropzone.removeAllFiles(true);

				// Cerrar el modal
				var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
				modal.hide();
				window.location.reload();
			});

			// Opcional: Para mostrar mensaje de éxito cuando todos los archivos se suban
			myDropzone.on("complete", function(file) {
				if (myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0) {
					console.log("Todos los archivos han sido subidos.");
				}
			});



			// Sidebar toggle
			const sidebarToggle = document.getElementById('sidebarToggle');
			const sidebar = document.getElementById('sidebar');

			if (sidebarToggle) {
				sidebarToggle.addEventListener('click', function() {
					sidebar.classList.toggle('show');
				});
			}

			// Close sidebar when clicking outside on mobile
			document.addEventListener('click', function(event) {
				if (window.innerWidth <= 768 &&
					sidebar.classList.contains('show') &&
					!sidebar.contains(event.target) &&
					event.target !== sidebarToggle) {
					sidebar.classList.remove('show');
				}
			});

			// Handle window resize
			window.addEventListener('resize', function() {
				if (window.innerWidth > 768) {
					sidebar.classList.remove('show');
				}
			});
		});
	</script>
</body>

</html>