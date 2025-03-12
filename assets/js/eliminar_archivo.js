document.addEventListener("DOMContentLoaded", function () {
  const enlaces = document.querySelectorAll(".eliminar-archivo");

  enlaces.forEach((enlace) => {
    enlace.addEventListener("click", function (e) {
      e.preventDefault();

      const id = this.getAttribute("data-id");  
      document.getElementById("idArchivoEliminar").value = id;

      // Mostrar el modal
      new bootstrap.Modal(
        document.getElementById("eliminarArchivoModal")
      ).show();
    });
  });

  // Manejar confirmación de eliminación
  document
    .getElementById("confirmarEliminar")
    .addEventListener("click", async function () {
      const id = document.getElementById("idArchivoEliminar").value;

      try {
        const { data } = await axios.post("eliminar.php", { id_archivo: id });

        if (data.success) {
          // Cerrar el modal
          const modal = bootstrap.Modal.getInstance(
            document.getElementById("eliminarArchivoModal")
          );
          modal.hide();

          // Eliminar el elemento de la interfaz
          document
            .querySelector(`[data-id="${id}"]`)
            .closest(".col-12")
            ?.remove();

          window.location.reload();
        } else {
          alert("Error: " + data.message);
        }
      } catch (error) {
        console.error("Error:", error);
        alert("Error al procesar la solicitud.");
      }
    });
});
