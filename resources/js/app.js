import './bootstrap';

// Inicialización para los usuarios de ES
import { Select, Modal, Ripple, initTE } from "tw-elements";
initTE({ Select, Modal, Ripple });

// Si estás utilizando módulos JavaScript/ECMAScript:
import Dropzone from "dropzone";

// Crea una instancia de Dropzone en el elemento con el id "dropzone"
const dropzone = new Dropzone("#dropzone", {
  dictDefaultMessage: "Suba un pdf y un xml",
  acceptedFiles: ".pdf,.xml",
  addRemoveLinks: true,
  dictRemoveFile: "Borrar archivo",
  maxFiles: 2,
  uploadMultiple: true,

  // Inicialización personalizada de Dropzone
  init: function () {
    // Verifica si el campo con el nombre "id_documents" tiene un valor
    if (document.querySelector('[name="id_documents"]').value.trim()) {
      let documentsExtensions = [".pdf", ".xml"];
      let uploadedFiles = [];

      // Itera sobre las extensiones de documentos
      for (let index = 0; index < documentsExtensions.length; index++) {
        // Crea un nuevo archivo con una extensión y un nombre basado en el campo "id_documents"
        const file = new File(
          [
            new Blob([""], {
              type: documentsExtensions[index],
            }),
          ],
          document.querySelector('[name="id_documents"]').value +
            documentsExtensions[index]
        );

        // Agrega el archivo a la lista de archivos cargados
        uploadedFiles.push(file);

        // Emite eventos para indicar que se ha agregado y se ha creado una vista previa del archivo
        this.emit("addedfile", file);
        this.emit("thumbnail", file, `/uploads/${file.name}`);
        file.previewElement.classList.add("dz-success", "dz-complete");
      }

      // Asigna los archivos cargados a la instancia de Dropzone y deshabilita la opción de subir más archivos
      this.files = uploadedFiles;
      this.options.maxFiles = 0;
    }
  },
});

// Maneja el evento "success" cuando se ha cargado un archivo exitosamente
dropzone.on("success", function (file, response) {
  console.log(response);
  // Verifica la respuesta del servidor
  if (response['res'] === false) {
    // Hace clic en un botón o elemento modal para mostrar una notificación o realizar alguna acción
    document.querySelector('[data-button-modal]').click();
    // Borra el valor del campo "id_documents" y elimina todos los archivos cargados en Dropzone
    document.querySelector('[name="id_documents"]').value = "";
    dropzone.removeAllFiles();
    // Restablece el número máximo de archivos permitidos
    dropzone.options.maxFiles = 2;
    return 1;
  } else {
    // Asigna el valor de "id" de la respuesta al campo "id_documents"
    document.querySelector('[name="id_documents"]').value = response.id;
  }
});

// Maneja el evento "removedfile" cuando se ha eliminado un archivo de Dropzone
dropzone.on("removedfile", function () {
  // Borra el valor del campo "id_documents" y elimina todos los archivos cargados en Dropzone
  document.querySelector('[name="id_documents"]').value = "";
  dropzone.removeAllFiles();
  // Restablece el número máximo de archivos permitidos
  dropzone.options.maxFiles = 2;
});
