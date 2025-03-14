/*document.addEventListener("DOMContentLoaded", function () {
  const searchInput = document.getElementById("searchInput");
  const fileContainer = document.getElementById("searchResults");

  function fetchFiles(query = "") {
    fetch(`components/result_search_file.php?q=${encodeURIComponent(query)}`)
      .then((response) => response.text())
      .then((html) => {
        fileContainer.innerHTML = html;
      })
      .catch((error) => console.error("Error al cargar archivos:", error));
  }

  searchInput.addEventListener("input", function () {
    fetchFiles(this.value);
  });

  fetchFiles(); // Cargar archivos al inicio
});*/
