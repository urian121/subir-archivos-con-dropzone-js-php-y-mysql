<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Edumetrics Drive</title>
	<link rel="shortcut icon" href="assets/imgs/dirve-edumetric.png" />
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="assets/css/dashboard.css">

	<script src="assets/js/dropzone.min.js"></script>
	<link rel="stylesheet" href="assets/css/dropzone.min.css">
	<link rel="stylesheet" href="assets/css/home.css">

</head>

<body>

	<div class="container-fluid p-0">
		<?php include('components/header.php'); ?>

		<div class="d-flex">
			<?php
			include('components/sidebar.php');
			include('components/modal_file.php');
			?>

			<!-- Main content -->
			<div class="flex-grow-1 p-4">
				<div class="row g-3">
					<!-- File card 1 - Video -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="file-card file-video shadow-sm">
							<div class="file-preview">
								<i class="bi bi-film file-icon"></i>
							</div>
							<div class="file-name">
								Loading.mp4
							</div>

							<!-- File menu -->
							<div class="dropdown">
								<button class="btn file-menu p-0" type="button" id="fileMenu1" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="fileMenu1">
									<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-up-right"></i> Open
											File</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-download"></i> Download</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Rename</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-star"></i> Add to starred</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- File card 2 - Image -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="file-card file-image shadow-sm">
							<div class="file-preview">
								<img src="https://via.placeholder.com/320x180.png?text=33.png" alt="33.png">
							</div>
							<div class="file-name">
								33.png
							</div>

							<!-- File menu -->
							<div class="dropdown">
								<button class="btn file-menu p-0" type="button" id="fileMenu2" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="fileMenu2">
									<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-up-right"></i> Open
											File</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-download"></i> Download</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Rename</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-star"></i> Add to starred</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- File card 3 - Image -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="file-card file-image shadow-sm">
							<div class="file-preview">
								<img src="https://via.placeholder.com/320x180.png?text=5.png" alt="5.png">
							</div>
							<div class="file-name">
								5.png
							</div>

							<!-- File menu -->
							<div class="dropdown">
								<button class="btn file-menu p-0" type="button" id="fileMenu3" data-bs-toggle="dropdown"
									aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="fileMenu3">
									<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-up-right"></i> Open
											File</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-download"></i> Download</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Rename</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-star"></i> Add to starred</a>
									</li>
								</ul>
							</div>
						</div>
					</div>

					<!-- File card 4 - CSV -->
					<div class="col-12 col-sm-6 col-md-4 col-lg-3">
						<div class="file-card file-csv shadow-sm">
							<!-- File menu -->
							<div class="dropdown">
								<button class="btn file-menu p-0" type="button" id="fileMenu4" data-bs-toggle="dropdown" aria-expanded="false">
									<i class="bi bi-three-dots-vertical"></i>
								</button>
								<ul class="dropdown-menu" aria-labelledby="fileMenu4">
									<li><a class="dropdown-item" href="#"><i class="bi bi-box-arrow-up-right"></i> Open
											File</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-download"></i> Download</a>
									</li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-pencil"></i> Rename</a></li>
									<li><a class="dropdown-item" href="#"><i class="bi bi-star"></i> Add to starred</a>
									</li>
								</ul>
							</div>
							<div class="file-preview">
								<i class="bi bi-file-earmark-text file-icon"></i>
							</div>
							<div class="file-name">
								tbl_clientes.csv
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="assets/js/bootstrap.bundle.min.js"></script>
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