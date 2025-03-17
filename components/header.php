<div class="drive-header">
    <div class="d-flex flex-column flex-md-row align-items-center px-3 h-100">
        <!-- Primera fila en móvil, todo en línea en desktop -->
        <div class="d-flex align-items-center w-100 justify-content-between justify-content-md-start">
            <!-- Botón de menú (ajustado para estar siempre visible en móvil) -->
            <button class="btn mobile-menu-toggle me-2 d-none d-md-none" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Drive logo and title (centrado en móvil) -->
            <div class="d-flex align-items-center me-md-4 mx-auto mx-md-0">
                <a href="<?php echo BASE_HOME; ?>/index.php" class="text-decoration-none">
                    <img src="<?php echo ASSETS_IMG; ?>/logo-edumetrix-drive.png" alt="driver edumetrisc">
                </a>
            </div>

            <!-- Search bar (en línea en desktop, oculto en móvil) -->
            <div class="search-bar d-none d-md-flex align-items-center flex-grow-1 py-1 px-3 mx-auto">
                <i class="bi bi-search me-3 text-secondary"></i>
                <input type="text" id="searchInput" class="search-input form-control border-0 shadow-none"
                    placeholder="Buscar archivos">
            </div>

            <!-- Filtro select (visible solo en desktop) -->
            <div class="ms-auto d-none d-md-block px-3">
                <div class="custom-select-container">
                    <select name="extension" id="extensionSelect" class="custom-select">
                        <option value="" default> Seleccione una extensión</option>
                        <?php foreach ($archivos_por_extensiones as $extension_file):
                            $ext = $extension_file['extension'];
                            $icono = obtenerIcono($ext);
                        ?>
                            <option value="<?= htmlspecialchars($ext) ?>">
                                <?= $icono . ' ' . strtoupper($ext) ?>
                            </option>
                        <?php endforeach; ?>
                        <option value="all">😅 Todas</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Search bar (segunda fila, solo visible en móvil) -->
        <div class="search-bar d-flex d-md-none align-items-center w-100 py-1 px-3 mt-2">
            <i class="bi bi-search me-3 text-secondary"></i>
            <input type="text" id="searchInputMobile" class="search-input form-control border-0 shadow-none"
                placeholder="Buscar archivos">
        </div>
    </div>
</div>