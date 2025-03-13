<div class="drive-header">
    <div class="d-flex align-items-center px-3 h-100">
        <button class="btn d-none mobile-menu-toggle me-2" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>

        <!-- Drive logo and title -->
        <div class="d-flex align-items-center me-4">
            <a href="index.php" class="text-decoration-none">
                <img src="assets/imgs/logo-edumetrix-drive.png" alt="driver edumetrisc" style="width: 150px; padding: 5px">
            </a>
        </div>

        <!-- Search bar -->
        <div class="search-bar d-flex align-items-center flex-grow-1 py-1 px-3 mx-auto">
            <i class="bi bi-search me-3 text-secondary"></i>
            <input type="text" id="searchInput" class="search-input form-control border-0 shadow-none"
                placeholder="Buscar archivos">
        </div>

        <?php include('components/filtro_select.php'); ?>

        <!-- User profile -->
        <div class="ms-auto">
            <img src="assets/imgs/user.png" alt="User Profile" class="avatar">
        </div>
    </div>
</div>