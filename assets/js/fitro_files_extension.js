const selectedExtension = document.querySelector("#extensionSelect");
const fileContainer = document.getElementById("searchResults");

selectedExtension?.addEventListener("change", () => {
  const selectedExtensionValue = selectedExtension.value;

  // Mostrar el loader antes de la solicitud
  $("#loader").fadeIn("fast");

  fileContainer.innerHTML = "";

  let paramts = `actions/files_extension.php?extension=${selectedExtensionValue}`;
  fetch(`${ruta_base}${paramts}`)
    .then((response) => response.text())
    .then((html) => (fileContainer.innerHTML = html))
    .catch((error) => console.error("Error:", error))
    .finally(() => {
      // Ocultar el loader cuando la solicitud termine
      $("#loader").fadeOut("slow");
    });
});
