let folders = document.querySelectorAll(".folder");
let ruta =
  window.location.origin + "/driver-edumetrics/actions/get_files_folder.php";

// Cuando se hace clic en una carpeta, obtener los archivos dentro de esa carpeta
folders?.forEach((folder) => {
  folder.addEventListener("click", function () {
    let folderId = folder.getAttribute("data-folder");

    // Remover la clase "active" de todas las carpetas
    folders.forEach((f) => f.classList.remove("active-folder"));

    // Agregar la clase "active" a la carpeta seleccionada
    folder.classList.add("active-folder");

    // Realizar la solicitud para obtener los archivos de la carpeta
    fetch(`${ruta}?folder_id=${folderId}`)
      .then((response) => response.text()) // Convertir la respuesta a texto
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
