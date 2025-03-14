<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$q = isset($_GET['q']) ? $_GET['q'] : '';

$query = "SELECT id, nombre_original, nombre_sistema, extension, ruta FROM tbl_files WHERE nombre_original LIKE '%$q%'";
$resultado_files = mysqli_query($servidor, $query);

if ($resultado_files) {

    foreach ($resultado_files as $archivo) {
        // Obtener la extensión del archivo
        $extension = strtolower(pathinfo($archivo['nombre_sistema'], PATHINFO_EXTENSION));
        // Determinar el tipo de vista previa
        $preview = '';
        if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
            // Vista previa de imágenes y SVG
            $preview = "<img src='{$archivo['ruta']}' class='file-preview-img' alt='Vista previa'>";
        } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
            // Vista previa de videos
            $preview = "<video class='file-preview-video' controls>
                        <source src='{$archivo['ruta']}' type='video/{$extension}'>
                        Tu navegador no soporta el video.
                    </video>";
        } else {
            // Icono por defecto según el tipo de archivo
            $icons = [
                'pdf'   => 'bi-file-earmark-pdf text-danger',
                'doc'   => 'bi-file-earmark-word text-primary',
                'docx'  => 'bi-file-earmark-word text-primary',
                'xls'   => 'bi-file-earmark-excel text-success',
                'xlsx'  => 'bi-file-earmark-excel text-success',
                'ppt'   => 'bi-file-earmark-ppt text-warning',
                'pptx'  => 'bi-file-earmark-ppt text-warning',
                'zip'   => 'bi-file-earmark-zip text-secondary',
                'rar'   => 'bi-file-earmark-zip text-secondary',
                'tar'   => 'bi-file-earmark-zip text-secondary',
                'gz'    => 'bi-file-earmark-zip text-secondary',
                'sql'   => 'bi-file-earmark-code text-info',
                'md'    => 'bi-file-earmark-code text-dark',
                'markdown' => 'bi-file-earmark-code text-dark',
                'csv'   => 'bi-file-earmark-spreadsheet text-success',
                'txt'   => 'bi-file-earmark-text text-muted',
                'svg'   => 'bi-file-earmark-image text-primary' // Añadido icono para SVG por si falla la vista previa
            ];

            // Usar el icono correspondiente o el icono por defecto
            $icon = $icons[$extension] ?? 'bi-file-earmark-text';
            $preview = "<i class='bi $icon file-icon'></i>";
        }
?>
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="card h-100">
                <div class="dropdown">
                    <button class="btn file-menu p-0" type="button" id="fileMenu<?php echo $archivo['id']; ?>"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="fileMenu<?php echo $archivo['id']; ?>">
                        <li><a class="dropdown-item" href="<?php echo $archivo['ruta']; ?>" target="_blank"><i
                                    class="bi bi-box-arrow-up-right"></i> Abrir archivo</a></li>
                        <li><a class="dropdown-item" download="<?php echo $archivo['nombre_sistema']; ?>"
                                href="actions/descargar.php?id=<?php echo $archivo['id']; ?>"><i class="bi bi-download"></i>
                                Descargar</a></li>
                        <li><a class="dropdown-item eliminar-archivo" onclick="eliminarArchivo('<?php echo $archivo['id']; ?>', '<?php echo $archivo['nombre_original']; ?>')" href="#" data-id="<?php echo $archivo['id']; ?>"
                                data-nombre="<?php echo htmlspecialchars($archivo['nombre_original']); ?>"><i
                                    class="bi bi-trash"></i> Eliminar archivo</a></li>
                    </ul>
                </div>
                <div class="card-body d-flex flex-column">
                    <a href="<?php echo $archivo['ruta']; ?>" target="_blank" class="text-decoration-none text-dark">
                        <div class="file-preview mb-3 d-flex justify-content-center align-items-center" style="height: 130px;">
                            <?php if (empty($preview)): ?>
                                <!-- Si no hay vista previa, mostramos el icono centrado -->
                                <i class="bi <?php echo $icon; ?> file-icon"></i>

                            <?php else: ?>
                                <!-- Vista previa de archivo -->
                                <?php echo $preview; ?>
                            <?php endif; ?>
                        </div>
                        <p class="card-text text-truncate p-3"><?php echo $archivo['nombre_original']; ?></p>
                    </a>
                </div>
            </div>
        </div>

<?php }
} else {
    echo "<p class='text-danger text-center'>No se encontraron archivos.</p>";
} ?>