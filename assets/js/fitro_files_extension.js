document.addEventListener("DOMContentLoaded", () => {
  const selectedExtension = document.querySelector("#extensionSelect");
  const fileContainer = document.getElementById("searchResults");
  const loadingSpinner = document.createElement("div");

  loadingSpinner.innerHTML =
    '<img src="assets/imgs/loading.svg" alt="Cargando..." width="150">';
  loadingSpinner.style.display = "none";
  loadingSpinner.style.textAlign = "center";
  fileContainer.parentNode.insertBefore(loadingSpinner, fileContainer);

  selectedExtension?.addEventListener("change", () => {
    const selectedExtensionValue = selectedExtension.value;
    loadingSpinner.style.display = "block";
    fileContainer.innerHTML = "";

    fetch(`actions/files_extension.php?extension=${selectedExtensionValue}`)
      .then((response) => response.text())
      .then((html) => (fileContainer.innerHTML = html))
      .catch((error) => console.error("Error:", error))
      .finally(() => (loadingSpinner.style.display = "none"));
  });
});
