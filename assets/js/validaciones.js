document.addEventListener("DOMContentLoaded", function () {
  const btnUpload = document.querySelector("#btnUploadFile");
  const btnCreateFolder = document.querySelector("#btnCreateFolder");
  const sidebarItems = document.querySelectorAll(".sidebar-item");

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
      }
    }
  }

  // Ejecutar al cargar la página
  actualizarEstadoBoton();

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function () {
      const directorioID = this.getAttribute("data-id");
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
    document.querySelector("#id_directorio").value = localStorage.getItem("id_directorio")
  });
});
