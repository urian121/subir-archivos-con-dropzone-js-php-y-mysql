document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const fileCards = document.querySelectorAll(".file-item"); // Ahora seleccionamos correctamente los archivos
  const searchResults = document.querySelector("#searchResults");
  const searchResultsParent = searchResults.parentNode;

  searchInput.addEventListener("input", function () {
    let searchTerm = this.value.toLowerCase().trim(); // Convertir a minúsculas y eliminar espacios extra
    let archivoEncontrado = false;

    fileCards.forEach((file) => {
      let searchData = file.getAttribute("data-search").toLowerCase();

      if (searchData.includes(searchTerm) || searchTerm === "") {
        file.style.display = "block";
        archivoEncontrado = true;
      } else {
        file.style.display = "none";
      }
    });

    // Mostrar mensaje si no se encuentra ningún archivo
    const existingMessage = document.querySelector(".alert-warning");
    if (!archivoEncontrado && !existingMessage) {
      const row = document.createElement("div");
      row.classList.add("row", "justify-content-center", "align-items-center");

      const col = document.createElement("div");
      col.classList.add("col-md-6", "text-center", "justify-content-center");
      col.innerHTML = `<div class="alert alert-warning" role="alert">Archivo no encontrado 😭</div>`;

      // Insertar el nuevo div col con el mensaje antes de #searchResults
      searchResultsParent.insertBefore(row, searchResults);
      row.appendChild(col);
    } else if (archivoEncontrado && existingMessage) {
      existingMessage.remove();
    }
  });
});
