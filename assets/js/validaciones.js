document.addEventListener("DOMContentLoaded", function () {
  const btnUpload = document.querySelector("#btnUploadFile");
  const btnCreateFolder = document.querySelector("#btnCreateFolder");
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const linkEnPapelera = document.querySelector("#linkEnPapelera");
  const folders = document.querySelectorAll(".folder"); // Seleccionamos todas las carpetas

  // Función para actualizar el estado del botón según el id_directorio
  function actualizarEstadoBoton() {
    let storedID = localStorage.getItem("id_directorio");
    if (btnUpload) {
      if (storedID == "4") {
        btnUpload.disabled = true;
        btnUpload.style.border = "none";

        btnCreateFolder.classList.add("disabled"); // Añadir clase para estilos
        btnCreateFolder.style.pointerEvents = "none"; // Evita clics
        btnCreateFolder.style.opacity = "0.5"; // Visualmente deshabilitado

        if (linkEnPapelera) {
          linkEnPapelera.style.display = "none"; // Ocultar el enlace
        }
      }
    }
  }

  // Ejecutar al cargar la página
  actualizarEstadoBoton();

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function () {
      const directorioID = this.getAttribute("data-id");

      // Remover la clase 'active' de todos los elementos
      sidebarItems.forEach((el) => el.classList.remove("active"));
      this.classList.add("active");

      if (directorioID) {
        // Guardar el ID en localStorage
        localStorage.setItem("id_directorio", directorioID);
        console.log("Nuevo ID de directorio:", directorioID);

        // Actualizar el estado del botón
        actualizarEstadoBoton();
      }
    });
  });

  // Manejar el clic en el botón de creación de carpeta
  btnCreateFolder.addEventListener("click", function () {
    setTimeout(function () {
      document.querySelector("#nombre_folder").focus();
    }, 500);

    // Pasar el ID al formulario de creación de carpeta
    document.querySelector("#id_directorio").value =
      localStorage.getItem("id_directorio");
  });

  /**
   * Cuando se hace click en el boton de subir archivos, se obtiene el id del directorio activo y tambien el id de la carpeta activa
   * para saber a donde se subira el archivo
   */
  // Manejar el clic en el botón de subida de archivos
  btnUpload.addEventListener("click", function () {
    let directorio_seleccionado = localStorage.getItem("id_directorio");
    console.log("Directorio:", directorio_seleccionado);

    let folderId = 0;
    // Recorremos todas las carpetas
    folders.forEach((folder) => {
      // Si tiene la clase 'active-folder'
      if (folder.classList.contains("active-folder")) {
        folderId = folder.getAttribute("data-folder"); // Obtenemos el valor de 'data-folder'
        console.log("Id de Carpeta activa:", folderId);
      }
    });

    document.querySelector("#id_folder_seleccionado").value = folderId;
    document.querySelector("#id_directorio_seleccionado").value =
      directorio_seleccionado;
  });
});
