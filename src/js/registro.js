import Swal from "sweetalert2";

(function() {
    let eventos = [];

    const resumen = document.querySelector('#registro-resumen');

    if( resumen ) {
        const eventosBoton = document.querySelectorAll('.evento__agregar');
        eventosBoton.forEach(boton => boton.addEventListener('click', selecionarEvento));

        const formularioRegistro = document.querySelector('#registro');
        formularioRegistro.addEventListener('submit', submitFormulario);

        mostrarEventos();

        function selecionarEvento(e) {

            if(eventos.length < 5) {
                // desabilitar el evento una vez se añade, para evitar que pueda añadirlo otra vez:
                e.target.disabled = true;
                eventos = [...eventos, {
                    id: e.target.dataset.id,
                    titulo: e.target.parentElement.querySelector('.evento__nombre').textContent.trim()
                }];
                mostrarEventos();
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Maxímo de 5 eventos alcanzado.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        }

        function mostrarEventos() {
            //Limpiar el html:
            limpiarEventos();

            if(eventos.length > 0 ) {
                eventos.forEach( evento => {
                    const eventoDom = document.createElement('DIV');
                    eventoDom.classList.add('registro__evento');

                    const titulo = document.createElement('H3');
                    titulo.classList.add('registro__nombre');
                    titulo.textContent = evento.titulo;

                    const botonEliminar = document.createElement('BUTTON');
                    botonEliminar.classList.add('registro__eliminar');
                    botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                    botonEliminar.onclick = function() {
                        eliminarEvento(evento.id);
                    }

                    //Renderizar en el html:
                    eventoDom.appendChild(titulo);
                    eventoDom.appendChild(botonEliminar);
                    resumen.appendChild(eventoDom);
                });
            } else {
                const noRegistro = document.createElement('P');
                noRegistro.textContent = 'No has añadido eventos aún. Añade tus eventos';
                noRegistro.classList.add('registro__texto');
                resumen.appendChild(noRegistro);
            }
        }

        function eliminarEvento(id) {
            eventos = eventos.filter( evento => evento.id !== id);
            const botonAgregar = document.querySelector(`[data-id="${id}"]`);
            botonAgregar.disabled = false;
            mostrarEventos();
        }

        function limpiarEventos() {
            while(resumen.firstChild) {
                resumen.removeChild(resumen.firstChild);
            }
        }

        async function submitFormulario(e) {
            e.preventDefault();

            // Obtener el regalo
            const regaloId = document.querySelector('#regalo').value
            const eventosId = eventos.map(evento => evento.id)

            if(eventosId.length === 0 || regaloId === '') {
                 Swal.fire({
                    title: 'Error',
                    text: 'Elige al menos un Evento y un Regalo',
                    icon: 'error',
                    confirmButtonText: 'OK'
                })
                return;
            }

            // Objeto de formdata
            const datos = new FormData();
            datos.append('eventos', eventosId)
            datos.append('regalo_id', regaloId)

            const url = '/finalizar-registro/conferencias'
            const respuesta = await fetch(url, {
                method: 'POST',
                body: datos
            })
            const resultado = await respuesta.json();

            console.log(resultado);

            if(resultado.resultado) {
                Swal.fire(
                    'Registro Exitoso',
                    'Tus eventos se han almacenado y el registro fue un éxito. ¡Te esperamos en DevWebCamp!',
                    'success'
                ).then( () => location.href = `/boleto?id=${resultado.token}`) 
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Hubo un error',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then( () => location.reload() )
            }

        }

    }

})();