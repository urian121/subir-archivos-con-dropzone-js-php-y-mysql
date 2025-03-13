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