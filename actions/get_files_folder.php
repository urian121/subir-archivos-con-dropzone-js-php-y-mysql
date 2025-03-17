<?php
include('../settings/config.php');
include('../settings/settingBD.php');
include('../functions/funciones.php');

$folderId = trim($_GET['folder_id']);
$list_files_folder = obtenerArchivosPorCarpeta($servidor, $folderId);

if ($list_files_folder) {
    foreach ($list_files_folder as $archivo) {
        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($archivo['nombre_sistema'], PATHINFO_EXTENSION));

        // Obtener la vista previa del archivo
        $preview = obtenerVistaPrevia($archivo);

        // Si no hay vista previa, se asigna un icono por defecto
        if (empty($preview)) {
            $icon = obtenerIconoArchivo($extension);
            $preview = "<i class='bi $icon file-icon'></i>";
        } ?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 file-item mb-3" data-id="<?php echo $archivo['id_drive']; ?>">
            <div class="card h-100">
                <div class="dropdown">
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
                        <li>
                            <a class="dropdown-item eliminar-archivo" onclick="sendFileDash('<?php echo $archivo['id_drive']; ?>', '<?php echo $archivo['nombre_original']; ?>')" href="#" data-id="<?php echo $archivo['id_drive']; ?>"
                                data-nombre="<?php echo htmlspecialchars($archivo['nombre_original']); ?>">
                                <i class="bi bi-trash"></i>
                                Eliminar archivo
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="<?php echo $archivo['ruta']; ?>" target="_blank" class="text-decoration-none text-dark">
                        <div class="file-preview mb-3 d-flex justify-content-center align-items-center" style="height: 130px;">
                            <?php echo $preview; ?>
                        </div>
                        <p class="card-text text-truncate p-3"><?php echo $archivo['nombre_original']; ?></p>
                    </a>
                </div>
            </div>
        </div>
<?php
    }
} else {
    echo "<p class='text-danger text-center'>No se encontraron archivos 😥.</p>";
}
?>