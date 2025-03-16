<?php $detallesPerfil = getPerfil($servidor, $infUser['id']); ?>
<div class="modal fade" id="updateUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 titulo_modal">Actualizar mis datos</h1>
                <button type="button" class="close_modal btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= ACTION_LOGIN ?>" autocomplete="off" class="pt-3">
                    <input type="text" name="action" value="update_user" hidden class="form-control">
                    <input type="text" name="id_user" value="<?= $detallesPerfil['id_user'] ?>" hidden class="form-control" autocomplete="off" required>

                    <div class="mb-3">
                        <label for="name_user" class="form-label">Nombre y Apellido</label>
                        <input type="text" name="name_user" value="<?= $detallesPerfil['name_user'] ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_user" class="form-label">Correo electr&oacute;nico</label>
                        <input type="email" name="email_user" value="<?= $detallesPerfil['email_user'] ?>" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_user" class="form-label">Clave</label>
                        <input type="password" name="password_user" class="form-control" autocomplete="off">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Actualizar datos</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>