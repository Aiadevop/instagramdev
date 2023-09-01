
import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

if (document.querySelector('#dropzone')) {
    let dropzone = new Dropzone("#dropzone", {
        dictDefaultMessage: "Arrastra aquí tu imagen 🖼",
        acceptedFiles: ".png,.jpg,.jpeg,.gif",
        addRemoveLinks: true,
        dictRemoveFile: "Borrar Archivo",
        maxFiles: 1,
        uploadMultiple: false,

        init: function () {
            if (document.querySelector('[name="imagen"]').value.trim()) {
                const imagenPublicada = {}
                //Le pongo un valor aleatorio pq debe tener un size obligatorio, se podría rescatar el dato de dropzone
                imagenPublicada.size = 1234;
                imagenPublicada.name = document.querySelector('[name="imagen"]').value;

                //call para que la funcion se llame en automatico, bind hay que llamar a la función
                this.options.addedfile.call(this, imagenPublicada);
                this.options.thumbnail.call(this, imagenPublicada, '/uploads/${imagenPublicada.name}')

                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete')
            }
        }

    });
    // dropzone.on('sending', function(file,xht,formData){
    //     console.log(file)
    // })

    dropzone.on('success', function (file, response) {
        // console.log(file)
        // console.log(response);
        document.querySelector('[name="imagen"]').value = response.imagen;
    })
    // dropzone.on ('error', function(file, message){
    //     console.log(message);
    // })

    dropzone.on('removedfile', function () {
        // console.log("Archivo eliminado.");
        document.querySelector('[name="imagen"]').value = '';
    })
}

