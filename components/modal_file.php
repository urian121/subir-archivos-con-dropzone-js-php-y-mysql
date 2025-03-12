<div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-center" id="exampleModalLabel" style="width: 100%;">Subir nuevo archivo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form action="#" method="POST" class="dropzone needsclick" id="demo-upload" enctype="multipart/form-data">
                    <div class="dz-message needsclick">
                        <span class="text">
                            <img src="assets/imgs/uploadsfiles.png" alt="Upload" style="width: 40px;" />
                            <h3 class="opacity-75">Suelta archivos aquí o haga clic para subir.</h3>
                        </span>
                    </div>
                    <div class="modal-footer-upload">
                        <button type="submit" class="btn btn-primary" id="uploadBtn">
                            Subir
                            <img src="assets/imgs/upload.png" alt="upload" style="width: 20px;">
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>