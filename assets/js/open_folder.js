let folders = document.querySelectorAll(".folder");

// Cuando se hace clic en una carpeta, obtener los archivos dentro de esa carpeta
folders.forEach((folder) => {
  folder.addEventListener("click", function () {
    let folderId = folder.getAttribute("data-folder");

    // Remover la clase "active" de todas las carpetas
    folders.forEach((f) => f.classList.remove("active-folder"));

    // Agregar la clase "active" a la carpeta seleccionada
    folder.classList.add("active-folder");

    // Realizar la solicitud para obtener los archivos de la carpeta
    fetch(`get_files_folder.php?folder_id=${folderId}`)
      .then((response) => response.text()) // Cambiar .json() por .text() ya que el PHP devuelve HTML
      .then((data) => {
        // Mostrar los archivos en la UI
        const filesContainer = document.getElementById("searchResults");
        filesContainer.innerHTML = data; // Insertar el HTML recibido
      })
      .catch((error) => {
        console.error("Error al cargar los archivos:", error);
      });
  });
});
