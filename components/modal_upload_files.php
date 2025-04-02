<div class="modal fade" id="modalUploadFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-3 text-center" style="width: 100%;">Subir nuevo archivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST" class="dropzone needsclick" id="demo-upload" enctype="multipart/form-data">
                    <input type="hidden" name="id_usuario" value="<?php echo $infUser['id']; ?>" class="form-control">
                    <input type="hidden" name="id_folder_seleccionado" id="id_folder_seleccionado" value="<?php echo isset($_GET['dir']) ? trim($_GET['dir']) : ''; ?>">
                    <input type="hidden" name="id_menu_link" id="id_menu_link">

                    <div class="dz-message needsclick">
                        <span class="text">
                            <img src="<?php echo ASSETS_IMG; ?>/uploadsfiles.png" alt="Upload" style="width: 40px;" />
                            <h3 class="opacity-75">Suelta archivos aquí o haga clic para subir.</h3>
                        </span>
                    </div>
                </form>

                <div class="modal-footer mt-3 mb-2 bg-white" style="border-top: 0px;">
                    <div class="d-grid gap-2 col-6 mx-auto">
                        <button id="uploadBtn" class="btn btn-primary text-center d-flex align-items-center justify-content-center" type="submit">
                            Subir archivo
                            <i class="bi bi-cloud-arrow-up ms-2"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>