<div class="d-flex flex-wrap justify-content-start">
    <?php
    $carpetasPorDirectorio = isset($id_directorio) ? obtenerCarpetasPorDirectorio($servidor, $id_directorio) : [];

    if (!empty($carpetasPorDirectorio)): ?>
        <?php foreach ($carpetasPorDirectorio as $folder):
            $isActive = ($folder['id_folder'] == $folderSelected) ? 'active-folder' : ''; ?>
            <section class="folder border p-3 mx-4 d-flex flex-column align-items-center text-center connected-list mb-3 <?= $isActive; ?>"
                data-folder="<?= $folder['id_folder']; ?>">

                <!-- Botón dropdown separado del enlace -->
                <div class="align-self-end mb-2 dropdown">
                    <button class="btn file-menu p-0" type="button" id="folderMenu<?= $folder['id_folder']; ?>"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="folderMenu<?= $folder['id_folder']; ?>">
                        <li>
                            <a class="dropdown-item" href="<?php echo BASE_HOME; ?>actions/estatus_public_folder.php?id_folder=<?= $folder['id_folder']; ?>&estatus=<?= $folder['public']; ?>">
                                <?php if ($folder['public'] == 1) { ?>
                                    <i class="bi bi-lock fw-bold text-black"></i> Bloquear
                                <?php } else { ?>
                                    <i class="bi bi-eye fw-bold text-success"></i> Publica
                                <?php } ?>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" onclick="deleteFolder('<?php echo $folder['id_folder']; ?>')" href="#">
                                <i class="bi bi-trash"></i> Eliminar
                            </a>
                        </li>
                    </ul>
                </div>

                <a href="./index.php?dir=<?= $folder['id_folder']; ?>" class="text-decoration-none">
                    <h4 class="icon fs-1">📁</h4>
                    <h4 class="folder-name fs-5 mt-3 text-break"><?= htmlspecialchars($folder['nombre_folder']); ?></h4>
                </a>
            </section>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="col-md-12">
            <p class="text-center fw-bold">No hay carpetas 📁</p>
        </div>
    <?php endif; ?>
</div>