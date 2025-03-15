const sidebarToggle = document.getElementById("sidebarToggle");
const sidebar = document.getElementById("sidebar");

if (sidebarToggle) {
  sidebarToggle.addEventListener("click", function () {
    sidebar.classList.toggle("show");
  });
}

// Close sidebar when clicking outside on mobile
document.addEventListener("click", function (event) {
  if (
    window.innerWidth <= 768 &&
    sidebar.classList.contains("show") &&
    !sidebar.contains(event.target) &&
    event.target !== sidebarToggle
  ) {
    sidebar.classList.remove("show");
  }
});

// Handle window resize
window.addEventListener("resize", function () {
  if (window.innerWidth > 768) {
    sidebar.classList.remove("show");
  }
});
