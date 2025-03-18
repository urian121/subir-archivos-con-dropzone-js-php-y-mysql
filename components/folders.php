<div class="d-flex flex-wrap justify-content-start">
    <?php
    $carpetasPorDirectorio = isset($id_directorio) ?  obtenerCarpetasPorDirectorio($servidor, $id_directorio) : [];

    if (!empty($carpetasPorDirectorio)): ?>
        <?php foreach ($carpetasPorDirectorio as $folder):
            $isActive = ($folder['id_folder'] == $folderSelected) ? 'active-folder' : ''; ?>

            <a href="./?dir=<?= $folder['id_folder']; ?>" class="text-decoration-none">
                <div class="folder border p-3 mx-4 d-flex flex-column align-items-center text-center connected-list mb-3 <?= $isActive; ?>"
                    data-folder="<?= $folder['id_folder']; ?>">
                    <h4 class="icon fs-1">📁</h4>
                    <h4 class="folder-name fs-6 text-break"><?= htmlspecialchars($folder['nombre_folder']); ?></h4>
                </div>
            </a>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <p class="text-center fw-bold">No hay carpetas 📁</p>
        </div>
    <?php endif; ?>
</div>