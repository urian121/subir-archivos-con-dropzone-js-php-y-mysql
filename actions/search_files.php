<?php
include('../settings/config.php');
include('../settings/settingBD.php');

$q = isset($_GET['q']) ? $_GET['q'] : '';

// Obtener archivos
$query = "SELECT id_drive, nombre_original, nombre_sistema, extension, ruta FROM tbl_drive_files WHERE nombre_original LIKE '%$q%'";
$resultado_files = mysqli_query($servidor, $query);

// Obtener carpetas (esto depende de cómo almacenas las carpetas en tu BD)
$query_folders = "SELECT id_folder, nombre_folder FROM tbl_drive_folders";
$resultado_folders = mysqli_query($servidor, $query_folders);
?>

<!-- Contenedor de archivos -->
<div id="file-list">
    <?php if ($resultado_files) {
        foreach ($resultado_files as $archivo) {
            $extension = strtolower(pathinfo($archivo['nombre_sistema'], PATHINFO_EXTENSION));
            $preview = '';

            if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'])) {
                $preview = "<img src='{$archivo['ruta']}' class='file-preview-img' alt='Vista previa'>";
            } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
                $preview = "<video class='file-preview-video' controls>
                            <source src='{$archivo['ruta']}' type='video/{$extension}'>
                            Tu navegador no soporta el video.
                        </video>";
            } else {
                $icons = [
                    'pdf' => 'bi-file-earmark-pdf text-danger',
                    'doc' => 'bi-file-earmark-word text-primary',
                    'xls' => 'bi-file-earmark-excel text-success',
                    'zip' => 'bi-file-earmark-zip text-secondary',
                    'txt' => 'bi-file-earmark-text text-muted',
                ];
                $icon = $icons[$extension] ?? 'bi-file-earmark-text';
                $preview = "<i class='bi $icon file-icon'></i>";
            }
    ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 file-item mb-3" data-id="<?php echo $archivo['id_drive']; ?>">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="file-preview mb-3 d-flex justify-content-center align-items-center" style="height: 130px;">
                            <?php echo $preview; ?>
                        </div>
                        <p class="card-text text-truncate p-3"><?php echo $archivo['nombre_original']; ?></p>
                    </div>
                </div>
            </div>
    <?php }
    } else {
        echo "<p class='text-danger text-center'>No se encontraron archivos.</p>";
    } ?>
</div>

<!-- Contenedor de carpetas -->
<div id="folder-container" class="mt-4">
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