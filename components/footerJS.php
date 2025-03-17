	<script src="<?php echo ASSETS_JS; ?>/jquery-3.7.1.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/popper.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/bootstrap.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/sidebar.js"></script>

	<script src="<?php echo ASSETS_JS; ?>/axios.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/dropzone.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/custom_dropzone.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/search_files.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/fitro_files_extension.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/send_file_dash.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/sortable.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/open_folder.js?v=<?php echo mt_rand(); ?>"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const btnCrearCarpeta = document.querySelector('[data-bs-target="#createFolder"]');
			btnCrearCarpeta.addEventListener("click", function() {
				setTimeout(function() {
					document.querySelector('#nombre_folder').focus();
				}, 500);

				// Pasar el ID al formulario de creación de carpeta
				document.querySelector('#id_directorio').value = "<?php echo $_SESSION['id_directorio']; ?>";

			});
		});
	</script>