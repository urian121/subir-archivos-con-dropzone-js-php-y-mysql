document.addEventListener("DOMContentLoaded", function () {
  // Hacer los archivos arrastrables
  new Sortable(document.getElementById("searchResults"), {
    group: "shared",
    animation: 150,
  });

  // Hacer las carpetas receptivas a archivos
  document.querySelectorAll(".connected-list").forEach((folder) => {
    new Sortable(folder, {
      group: "shared",
      animation: 150,
      onAdd: function (evt) {
        let fileId = evt.item.getAttribute("data-id");
        let folderId = evt.to.closest(".folder").getAttribute("data-folder");

        // Enviar datos al backend
        fetch("move_file.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            file_id: fileId,
            folder_id: folderId,
          }),
        })
          .then((response) => response.text())
          .then((html) => {
            // Actualizar el contenedor de archivos después de mover
              let folderContainer = document.querySelector(
                `.folder[data-folder='${folderId}'] .connected-list`
              );
              folderContainer.innerHTML = html;            
          })
          .catch((error) => console.error("Error al cargar archivos:", error));
      },
    });
  });
});
