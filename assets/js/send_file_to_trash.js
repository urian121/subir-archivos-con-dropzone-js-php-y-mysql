window.sendFileTrash = function (idFile) {
  // Mostrar el modal
  let idModal = document.querySelector("#eliminarArchivoModal");
  new bootstrap.Modal(idModal).show();

  // Manejar confirmación de eliminación
  document
    .getElementById("confirmarEliminar")
    .addEventListener("click", async function () {
      try {
        const { data } = await axios.post(
          `${ruta_base}actions/send_file_to_trash.php`,
          {
            id_archivo: idFile,
          }
        );

        if (data.success) {
          // Cerrar el modal
          const modal = bootstrap.Modal.getInstance(idModal);
          modal.hide();

          window.location.reload();
        } else {
          alert("Error: " + data.message);
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Error al procesar la solicitud.");
      }
    });
};

window.deleteFolder = function (idFolder) {
  let idModal = document.querySelector("#modalEliminarFolder");
  new bootstrap.Modal(idModal).show();

  // Manejar confirmación de eliminación
  document
    .getElementById("confirmarEliminarCarpeta")
    .addEventListener("click", async function () {
      try {
        const { data } = await axios.post(
          `${ruta_base}actions/delete_folder.php`,
          {
            idFolder: idFolder,
          }
        );

        if (data.success) {
          // Cerrar el modal
          const modal = bootstrap.Modal.getInstance(idModal);
          modal.hide();

          window.location.reload();
        } else {
          alert("Error: " + data.message);
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Error al procesar la solicitud.");
      }
    });
};
