window.eliminarArchivo = function (idFile, nombreFile) {
  console.log(idFile, nombreFile);

  // Mostrar el modal
  let idModal = document.querySelector("#eliminarArchivoModal");
  new bootstrap.Modal(idModal).show();

  // Manejar confirmación de eliminación
  document
    .getElementById("confirmarEliminar")
    .addEventListener("click", async function () {
      try {
        const { data } = await axios.post("actions/eliminar.php", {
          id_archivo: idFile,
        });

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
