<div class="sidebar pt-2" id="sidebar">

    <div class="px-3">
        <button class="new-button btn d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="bi bi-plus me-2"></i>
            <span>Subir nuevo archivo</span>
        </button>
    </div>

    <div class="mt-2">
        <a href="./" class="sidebar-item d-flex align-items-center active text-decoration-none mb-1">
            <i class="bi bi-hdd me-3"></i>
            <span>Mis archivos</span>
        </a>
        <a href="#" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
            <i class="bi bi-star me-3"></i>
            <span>Favoritos</span>
        </a>
        <a href="#" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
            <i class="bi bi-share me-3"></i>
            <span>archivos compartidos</span>
        </a>
        <a href="#" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
            <i class="bi bi-trash me-3"></i>
            <span>Papelera</span>
        </a>

        <a href="#" data-bs-toggle="modal" data-bs-target="#updateUser" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
            <i class="bi bi-person me-3"></i>
            <span>Mi perfil</span>
        </a>
        <a href="<?php echo ACTION_LOGIN; ?>?logout=1" class="sidebar-item d-flex align-items-center text-decoration-none mb-1">
            <i class="bi bi-box-arrow-right me-3"></i>
            <span>Cerrar sesión</span>
        </a>
    </div>
</div>