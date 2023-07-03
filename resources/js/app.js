import './bootstrap';

// Initialization for ES Users
import { Select, initTE } from "tw-elements";
initTE({ Select });

// If you are using JavaScript/ECMAScript modules:
import Dropzone from "dropzone";

const dropzone = new Dropzone("#dropzone", {
  dictDefaultMessage: "Suba un pdf y un xml",
  acceptedFiles: ".pdf,.xml",
  addRemoveLinks: true,
  dictRemoveFile: "Borrar archivo",
  maxFiles: 2,
  uploadMultiple: true,

  init: function () {
    if (document.querySelector('[name="id_documents"]').value.trim()) {
      let documentsExtensions = [".pdf", ".xml"];
      let uploadedFiles = [];

      for (let index = 0; index < documentsExtensions.length; index++) {
        const file = new File(
          [
            new Blob([""], {
              type: documentsExtensions[index],
            }),
          ],
          document.querySelector('[name="id_documents"]').value +
            documentsExtensions[index]
        );

        uploadedFiles.push(file);

        this.emit("addedfile", file);
        this.emit("thumbnail", file, `/uploads/${file.name}`);
        file.previewElement.classList.add("dz-success", "dz-complete");
      }

      this.files = uploadedFiles;
      this.options.maxFiles = 0; // Deshabilitar la opción de subir más archivos
    }
  },
});

dropzone.on("success", function (file, response) {
  document.querySelector('[name="id_documents"]').value = response.id;
});

dropzone.on("removedfile", function () {
  document.querySelector('[name="id_documents"]').value = "";
});
