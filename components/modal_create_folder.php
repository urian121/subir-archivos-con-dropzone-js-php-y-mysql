<div class="modal fade" id="createFolder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo_modal">Crear una carpeta</h1>
                <button type="button" class="close_modal btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= CREATE_FOLDER ?>" autocomplete="off" class="pt-3">
                    <input type="text" name="created_by" value="<?php echo $infUser['id']; ?>" hidden class="form-control">
                    <div class="mb-3">
                        <label for="nombre_folder" class="form-label">Nombre de la carpeta</label>
                        <input type="text" name="nombre_folder" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Crear carpeta</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>