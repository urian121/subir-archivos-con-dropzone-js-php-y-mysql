<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edumetrics Drive</title>
	<link rel="shortcut icon" href="assets/imgs/dirve-edumetric.png" />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css?v=<?php echo mt_rand(); ?>">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/dashboard.css?v=<?php echo mt_rand(); ?>">

	<script src="assets/js/dropzone.min.js?v=<?php echo mt_rand(); ?>"></script>
	<link rel="stylesheet" href="assets/css/dropzone.min.css?v=<?php echo mt_rand(); ?>" />
	<link rel="stylesheet" href="assets/css/home.css?v=<?php echo mt_rand(); ?>" />

</head>

<body>

	<div class="container-fluid p-0">
		<?php include('components/header.php'); ?>

		<div class="d-flex">
			<?php
			include('settings/config.php');
			include('settings/bd.php');
			include('functions/funciones.php');
			include('components/sidebar.php');
			include('components/modal_file.php');
			$resultado = obtenerArchivos($servidor);
			?>

			<!-- Main content -->
			<div class="flex-grow-1 p-4">
				<div class="row g-3">

					<?php
					foreach ($resultado as $archivo) { ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3">
							<div class="file-card file-csv shadow-sm">
								<div class="dropdown">
									<button class="btn file-menu p-0" type="button" id="fileMenu4" data-bs-toggle="dropdown" aria-expanded="false">
										<i class="bi bi-three-dots-vertical"></i>
									</button>
									<ul class="dropdown-menu" aria-labelledby="fileMenu4">
										<li><a class="dropdown-item" href="<?php echo $archivo['ruta']; ?>" target="_blank"><i class="bi bi-box-arrow-up-right"></i> Abrir archivo</a></li>
										<li><a class="dropdown-item" download="<?php echo $archivo['nombre_sistema']; ?>" href="descargar.php?id=<?php echo $archivo['id']; ?>"><i class="bi bi-download"></i> Descargar</a></li>
										<li><a class="dropdown-item eliminar-archivo" href="#" data-id="<?php echo $archivo['id']; ?>" data-nombre="<?php echo htmlspecialchars($archivo['nombre_original']); ?>"><i class="bi bi-trash"></i> Eliminar archivo</a></li>
									</ul>
								</div>
								<div class="file-preview">
									<i class="bi bi-file-earmark-text file-icon"></i>
								</div>
								<div class="file-name">
									<?php echo $archivo['nombre_sistema']; ?>
								</div>
							</div>
						</div>
					<?php } ?>

					<!-- Agregar el modal de confirmación -->
					<div class="modal fade" id="eliminarArchivoModal" tabindex="-1" aria-labelledby="eliminarArchivoModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="eliminarArchivoModalLabel">Confirmar eliminación</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									¿Estás seguro de que deseas eliminar el archivo?
									<input type="hidden" id="idArchivoEliminar">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
									<button type="button" class="btn btn-danger" id="confirmarEliminar">Eliminar</button>
								</div>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/bootstrap.bundle.min.js"></script>
	<script src="assets/js/axios.min.js"></script>
	<script src="assets/js/eliminar_archivo.js"></script>
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
				url: "./upload.php", // URL de destino
				paramName: "file", // Nombre del parámetro de archivo
				maxFilesize: 10, // Tamaño máximo en MB
				maxFiles: 10, // Cantidad máxima de archivos
				acceptedFiles: "image/*,application/pdf",
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
				// Opcional: mostrar un mensaje de éxito
				alert("Archivos subidos con éxito");
				// Cerrar el modal
				var modal = bootstrap.Modal.getInstance(document.getElementById('exampleModal'));
				modal.hide();
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