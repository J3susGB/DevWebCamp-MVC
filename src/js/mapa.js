// if( document.querySelector('#mapa') ) {
//     const lat = 40.453054;
//     const lng = -3.688344;
//     const zoom = 16;

//     const map = L.map('mapa').setView([lat, lng], zoom);

//     L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
//         attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
//     }).addTo(map);
    
//     L.marker([lat, lng]).addTo(map)
//         .bindPopup(`
//             <h3 class="mapa__heading">DevWebCamp</h3>
//             <p class="mapa__texto">Estadio Santiago Bernabeu, Madrid, España</p>
//         `)
//         .openPopup(); 
// }

if (document.querySelector('#mapa')) {
    const lat = 40.453054;
    const lng = -3.688344;
    const zoom = 16;

    const map = L.map('mapa').setView([lat, lng], zoom);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Agregar marcador al mapa
    const marker = L.marker([lat, lng]).addTo(map)
        .bindPopup(`
            <h3 class="mapa__heading">DevWebCamp</h3>
            <p class="mapa__texto">Estadio Santiago Bernabeu, Madrid, España</p>
        `)
        .openPopup();

    // Función para reestablecer la vista del mapa
    function resetView() {
        map.setView([lat, lng], zoom);
    }

    // Agregar botón de reestablecer vista debajo de los botones de zoom
    const resetButton = L.Control.extend({
        options: {
            position: 'topleft'
        },

        onAdd: function () {
            const container = L.DomUtil.create('div', 'reset-button-container');
            const button = L.DomUtil.create('button', 'reset-button', container);
            button.innerHTML = 'Reestablecer Vista';
            button.onclick = function () {
                resetView();
            };
            return container;
        }
    });

    map.addControl(new resetButton());
}
