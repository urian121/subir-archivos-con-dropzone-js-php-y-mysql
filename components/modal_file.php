<div class="modal fade" id="modalUploadFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" style="width: 100%;">Subir nuevo archivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST" class="dropzone needsclick" id="demo-upload" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario" value="<?php echo $infUser['id']; ?>" class="form-control">
                    <input type="hidden" name="id_folder_seleccionado" id="id_folder_seleccionado">
                    <input type="hidden" name="id_menu_link" id="id_menu_link">
                    <div class="dz-message needsclick">
                        <span class="text">
                            <img src="<?php echo ASSETS_IMG; ?>/uploadsfiles.png" alt="Upload" style="width: 40px;" />
                            <h3 class="opacity-75">Suelta archivos aquí o haga clic para subir.</h3>
                        </span>
                    </div>
                    <div class="modal-footer-upload">
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            Subir
                            <img src="<?php echo ASSETS_IMG; ?>/upload.png" alt="upload" style="width: 20px;">
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>