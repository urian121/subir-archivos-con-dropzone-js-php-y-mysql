document.addEventListener("DOMContentLoaded", function () {
  const btnUpload = document.querySelector("#btnUploadFile");
  const btnCreateFolder = document.querySelector("#btnCreateFolder");
  const sidebarItems = document.querySelectorAll(".sidebar-item");
  const linkEnPapelera = document.querySelector("#linkEnPapelera");
  let folder_activo = document.querySelector(".active-folder");
  // Seleccionar todas las carpetas que no estan activas es decir que no estan seleccionadas
  // let inactiveFolders = document.querySelectorAll(".folder:not(.active-folder)");
  let folders = document.querySelectorAll(".folder");
  let linkVolver = document.querySelector("#linkVolver");

  // Función para actualizar el estado del botón según el id_menu_link
  function actualizarEstadoBoton() {
    let storedID = localStorage.getItem("id_menu_link");
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

      // Evitar crear una carpeta dentro de otra carpeta
      if (folder_activo) {
        btnCreateFolder.classList.add("disabled"); // Añadir clase para estilos
        btnCreateFolder.style.pointerEvents = "none"; // Evita clics
        btnCreateFolder.style.opacity = "0.5"; // Visualmente deshabilitado

        // recorrer todas las carpetas que no son activas y añadir la clase d-none para ocultarlas
        folders.forEach((folder) => {
          folder.classList.add("d-none");
        });

        // Habitilitar el link de volver
        linkVolver.classList.remove("d-none"); // Eliminar clase de volver
      }
    }
  }

  // Ejecutar al cargar la página
  actualizarEstadoBoton();

  sidebarItems.forEach((item) => {
    item.addEventListener("click", function () {
      const id_menu_link = this.getAttribute("data-id");
      if (id_menu_link) {
        // Guardar el ID en localStorage
        localStorage.setItem("id_menu_link", id_menu_link);
        console.log("Nuevo ID de directorio:", id_menu_link);

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
    document.querySelector("#id_menu_link").value =
      localStorage.getItem("id_menu_link");
  });

  //Mostrar imagen en la Modal
  let linkPreviewImg = document.querySelectorAll(".linkPreviewImg");
  if (linkPreviewImg) {
    linkPreviewImg.forEach((link) => {
      link.addEventListener("click", function (e) {
        e.preventDefault();

        // Seleccionar el src de la imagen dentro del enlace clickeado
        let imgElement = this.querySelector("img");
        let imgSrc = imgElement.getAttribute("src");

        // Mostrar el modal manualmente
        let idModal = document.querySelector("#modalPreviewImg");
        const modal = new bootstrap.Modal(idModal);
        modal.show();

        // Insertar la imagen en el modal
        document.querySelector(
          ".body-img-preview"
        ).innerHTML = `<img src="${imgSrc}" alt="Imagen de perfil" style="max-width: 100%;">`;
      });
    });
  }
});
