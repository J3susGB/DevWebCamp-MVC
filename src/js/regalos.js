// (function () {
//     const grafica = document.querySelector('#regalos-grafica');
//     if( grafica ) {

//         obtenerDatos();

//         async function obtenerDatos() {
//             const url = '/api/regalos'
//             const respuesta = await fetch(url)
//             const resultado = await respuesta.json()

//             console.log(resultado);

//             const ctx = document.getElementById('regalos-grafica');
//             new Chart(ctx, {
//                 type: 'bar',
//                 data: {
//                     labels: resultado.map(regalo=>regalo.nombre),
//                     datasets: [{
//                         label: '',
//                         data: resultado.map(regalo=>regalo.total),
//                         backgroundColor: [
//                             '#ea580c',
//                             '#84cc16',
//                             '#22d3ee',
//                             '#a855f7',
//                             '#ef4444',
//                             '#14b8a6',
//                             '#db2777',
//                             '#e11d48',
//                             '#7e22ce'
//                         ],
//                         // borderWidth: 2,
//                         // borderColor:[]
//                     }]
//                 },
//                 options: {
//                     scales: {
//                         y: {
//                             beginAtZero: true
//                         }
//                     },
//                     plugins: {
//                         legend: {
//                             display: false
//                         }
//                     }
//                 }
//             });
//         }
//     }    
// })();

(function () {
    const grafica = document.querySelector('#regalos-grafica');
    let graficaInstance = null; // Variable para almacenar la instancia de la gráfica

    if (grafica) {
        obtenerDatos();

        async function obtenerDatos() {
            const url = '/api/regalos';
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();

            console.log(resultado);

            // Destruir la instancia existente de la gráfica si existe
            if (graficaInstance) {
                graficaInstance.destroy();
            }

            const ctx = document.getElementById('regalos-grafica');
            graficaInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: resultado.map(regalo => regalo.nombre),
                    datasets: [{
                        label: '',
                        data: resultado.map(regalo => regalo.total),
                        backgroundColor: [
                            '#ea580c',
                            '#84cc16',
                            '#22d3ee',
                            '#a855f7',
                            '#ef4444',
                            '#14b8a6',
                            '#db2777',
                            '#e11d48',
                            '#7e22ce'
                        ]
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        }
    }
})();
