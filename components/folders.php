<?php
$id_directorio = $_SESSION['id_directorio'] ?? null;
$carpetasPorDirectorio = $id_directorio ? obtenerCarpetasPorDirectorio($servidor, $id_directorio) : [];

if (!empty($carpetasPorDirectorio)):
    foreach ($carpetasPorDirectorio as $folder): ?>
        <div class="folder border p-3 mx-4 d-flex flex-column align-items-center text-center connected-list"
            data-folder="<?= $folder['id_folder']; ?>">
            <h4 class="icon fs-1">📁</h4>
            <h4 class="folder-name fs-6 text-break"><?= htmlspecialchars($folder['nombre_folder']) . ' - ' . $folder['id_folder']; ?></h4>
        </div>
    <?php endforeach;
else: ?>
    <div class="col text-center fw-bold">No hay carpetas</div>
<?php endif;
