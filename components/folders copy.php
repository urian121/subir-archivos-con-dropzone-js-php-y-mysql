<div class="d-flex flex-wrap justify-content-start">
    <?php
    $carpetasPorDirectorio = isset($id_directorio) ? obtenerCarpetasPorDirectorio($servidor, $id_directorio) : [];

    if (!empty($carpetasPorDirectorio)): ?>
        <?php foreach ($carpetasPorDirectorio as $folder):
            $isActive = ($folder['id_folder'] == $folderSelected) ? 'active-folder' : ''; ?>

            <section class="folder border p-3 mx-4 d-flex flex-column align-items-center text-center connected-list mb-3 <?= $isActive; ?>"
                data-folder="<?= $folder['id_folder']; ?>">
                <!-- Aquí el botón de dropdown, fuera del enlace -->
                <div class="dropdown">
                    <button class="btn file-menu p-0" type="button" id="folderMenu<?= $folder['id_folder']; ?>"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="folderMenu<?= $folder['id_folder']; ?>">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="toggleFolderVisibility(<?= $folder['id_folder']; ?>)">
                                <i class="bi bi-box-arrow-up-right"></i> Publicar
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="javascript:void(0);" onclick="toggleFolderVisibility(<?= $folder['id_folder']; ?>)">
                                <i class="bi bi-lock"></i> Bloquear
                            </a>
                        </li>
                    </ul>
                </div>

                <h4 class="icon fs-1">📁</h4>
                <h4 class="folder-name fs-5 mt-3 text-break"><?= htmlspecialchars($folder['nombre_folder']); ?></h4>

            </section>

        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <p class="text-center fw-bold">No hay carpetas 📁</p>
        </div>
    <?php endif; ?>
</div>