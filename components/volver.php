<section class="d-none text-white" id="linkVolver">
    <a href="./?link=<?php echo $link_seleccionado; ?>" class="text-decoration-none text-white" title="Volver">
        <i class="bi bi-arrow-left-circle"></i>
        Volver <i class="bi bi-chevron-right"></i>
    </a>
    <a href="<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>" class="text-decoration-none text-white link-folder-activo">
        <?php echo $nombre_carpeta_seleccionada; ?>
    </a>
</section>