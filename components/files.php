<?php
if ($list_files) {
    foreach ($list_files as $archivo) {
        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($archivo['nombre_sistema'], PATHINFO_EXTENSION));

        // Obtener la vista previa del archivo
        $preview = obtenerVistaPrevia($archivo);

        // Si no hay vista previa, se asigna un icono por defecto
        if (empty($preview)) {
            $icon = obtenerIconoArchivo($extension);
            $preview = "<i class='bi $icon file-icon'></i>";
        } ?>
        <div data-search="<?php echo $archivo['nombre_original']; ?>" class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 file-item mb-3 m-2" data-id="<?php echo $archivo['id_drive']; ?>">
            <div class="dropdown" style="position: relative; z-index: 1000;">
                <button class="btn file-menu p-0" type="button" id="fileMenu<?php echo $archivo['id_drive']; ?>"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-three-dots-vertical"></i>
                </button>
                <ul class="dropdown-menu" aria-labelledby="fileMenu<?php echo $archivo['id_drive']; ?>">
                    <li>
                        <a class="dropdown-item" href="<?php echo UPLOADS_PATH . $archivo['nombre_sistema']; ?>" target="_blank"><i
                                class="bi bi-box-arrow-up-right"></i>
                            Abrir archivo
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" download="<?php echo $archivo['nombre_sistema']; ?>"
                            href="<?php echo DOWNLOADS_FILE; ?>?id_drive=<?php echo $archivo['id_drive']; ?>"><i class="bi bi-download"></i>
                            Descargar
                        </a>
                    </li>
                    <?php if ($link_seleccionado != '4') { ?>
                        <li id="linkEnPapelera">
                            <a class="dropdown-item eliminar-archivo" onclick="sendFileTrash('<?php echo $archivo['id_drive']; ?>')" href="#" data-id="<?php echo $archivo['id_drive']; ?>"
                                data-nombre="<?php echo htmlspecialchars($archivo['nombre_original']); ?>"><i
                                    class="bi bi-trash"></i>
                                Enviar a la papelera
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="card h-100 shadow-sm animate-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span class="text-truncate"><?php echo $archivo['nombre_original']; ?></span>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="<?php echo UPLOADS_PATH . $archivo['nombre_sistema']; ?>" target="_blank" class="text-decoration-none text-dark">
                        <div class="file-preview mb-3 d-flex justify-content-center align-items-center" style="height: 130px;">
                            <?php echo $preview; ?>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    <?php
    }
} else { ?>
    <p class="text-center" style="width: 100%;">No hay archivos 📄</p>
<?php }
?>