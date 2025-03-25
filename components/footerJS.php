	<script src="<?php echo ASSETS_JS; ?>/jquery-3.7.1.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/popper.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/bootstrap.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/sidebar.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/axios.min.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/dropzone.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/custom_dropzone.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/search_files.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/fitro_files_extension.js"></script>
	<script src="<?php echo ASSETS_JS; ?>/send_file_to_trash.js?v=<?php echo mt_rand(); ?>"></script>

	<script src="<?php echo ASSETS_JS; ?>/sortable.min.js?v=<?php echo mt_rand(); ?>"></script>
	<script src="<?php echo ASSETS_JS; ?>/validaciones.js?v=<?php echo mt_rand(); ?>"></script>

	<script>
		let ruta_base = window.location.origin + "/driver/";
		let id_menu_link = localStorage.getItem("id_menu_link");

		function abrirModalConValor(modalId, inputSelector) {
			const modalElement = document.getElementById(modalId);
			if (!modalElement) return;

			const modal = new bootstrap.Modal(modalElement);
			modal.show();

			const input = modalElement.querySelector(inputSelector);
			if (input) input.value = id_menu_link;
		}
	</script>