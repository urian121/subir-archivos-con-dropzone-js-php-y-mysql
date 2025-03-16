document.addEventListener("DOMContentLoaded", function () {
  // Mostrar el loader
  $("#loader").fadeOut("slow");

  // Desactivar el autodescubrimiento
  Dropzone.autoDiscover = false;

  // Verificar si ya existe una instancia de Dropzone en el elemento
  var dropzoneElement = document.getElementById("demo-upload");

  // Si ya hay una instancia, la destruimos primero
  if (dropzoneElement.dropzone) {
    dropzoneElement.dropzone.destroy();
  }

  // Inicializar Dropzone
  var myDropzone = new Dropzone("#demo-upload", {
    url: "./actions/upload.php", // URL de destino
    paramName: "file", // Nombre del parámetro de archivo
    maxFilesize: 10, // Tamaño máximo en MB
    maxFiles: 10, // Cantidad máxima de archivos
    acceptedFiles:
      "image/*,application/pdf,text/plain,.zip,.tar,.gz,.sql,.md,.markdown,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,text/csv,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,video/*",
    //acceptedFiles: "image/*,application/pdf",
    dictDefaultMessage: "Arrastra y suelta archivos aquí o haz clic para subir",
    autoProcessQueue: false, // No procesar automáticamente la cola
    addRemoveLinks: true,
  });

  // Manejar el envío del formulario
  dropzoneElement.addEventListener("submit", function (e) {
    e.preventDefault(); // Evitar el envío del formulario
    e.stopPropagation(); // Evitar la propagación del evento de submit
  });

  // Configurar el botón de subida
  document.getElementById("uploadBtn").addEventListener("click", function (e) {
    e.preventDefault();
    e.stopPropagation();

    if (myDropzone.getQueuedFiles().length > 0) {
      console.log("Subiendo archivos...");
      myDropzone.processQueue();
    } else {
      alert("No hay archivos para subir.");
    }
  });

  // Verificar cuando se completen todos los archivos
  myDropzone.on("queuecomplete", function () {
    console.log("Todos los archivos han sido subidos.");
    // Eliminar todos los archivos de la zona de carga
    myDropzone.removeAllFiles(true);

    // Cerrar el modal
    var modal = bootstrap.Modal.getInstance(
      document.getElementById("exampleModal")
    );
    modal.hide();
    window.location.reload();
  });

  // Opcional: Para mostrar mensaje de éxito cuando todos los archivos se suban
  myDropzone.on("complete", function (file) {
    if (
      myDropzone.getUploadingFiles().length === 0 &&
      myDropzone.getQueuedFiles().length === 0
    ) {
      console.log("Todos los archivos han sido subidos.");
    }
  });
});
