(function() {

    const tagsInput = document.querySelector('#tags_input');

    if(tagsInput) {
        //Variable que almacena como valor el div donde quiero 'pintar' las etiquetas:
        const tagsDiv = document.querySelector('#tags');

        //Variable que almacena como valor del input tipo hidden, que usaré para almacenar el array, para la BD:
        const tagsInputHidden = document.querySelector('[name="tags"]');

        //Creo arreglo para ir almacenando las etiquetas:
        let tags = [];

        //Recuperar la información del input oculto:
        if( tagsInputHidden !== '' ) { //Si el input es diferente a un string vacio, significa que hay algo
            tags = tagsInputHidden.value.split(','); //Transforma el string en un array con cada uno de ellos
            mostrarTags(); //Los mostrará en pantalla
        }

        //Escuchar los cambios en el input:
        tagsInput.addEventListener('keypress', guardarTag);

        function guardarTag(e) {
            if(e.keyCode === 44){

                //Si el valor es un espacio o menor que 1 caracter, retornará y no ejecutará lo siguiente:
                if(e.target.value.trim() === '' || e.target.value < 1) {
                    return;
                }

                //Prevenir que cuando pulse la coma y se añada al array, se quede la coma escrita:
                e.preventDefault();

                //Añadir lo escrito al array:
                tags = [...tags, e.target.value.trim()];

                //Una vez añadido al array, limpio el input para que se vacíe y escriba desde cero
                tagsInput.value = '';
                
                //Llamo a la función para mostrar las etiquetas en pantalla:
                mostrarTags();
            }  
        }

        function mostrarTags() {
            tagsDiv.textContent = '';
            tags.forEach(tag=>{
                const etiqueta = document.createElement('LI');
                etiqueta.classList.add('formulario__tag');
                etiqueta.textContent = tag;
                //Asocio elemento onclick para que cuando se cliquee sobre alguna etiqueta, se elimine:
                etiqueta.onclick = eliminarTag;
                tagsDiv.appendChild(etiqueta);
            });

            //Llamo función para almacenar el array como value del input del tipo hidden:
            actualizarInputHidden();
        }

        function eliminarTag(e) {
            //Eliminar tags del DOM:
            e.target.remove();

            //Quitar el tag eliminado del arreglo:
            tags = tags.filter(tag => tag !== e.target.textContent); //Traerá todo el arreglo quitando al que se le dio click
            console.log(tags);

            //Llamo a la función para actualizar el array del input hidden:
            actualizarInputHidden();
        }

        function actualizarInputHidden() {
            //Alamacenar los tags en el input oculto como un string completo:
            tagsInputHidden.value = tags.toString();
        }
    }
})()