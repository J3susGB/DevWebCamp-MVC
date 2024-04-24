<main class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">Elige tu plan</p>

    <div class="paquetes__grid">
        <div <?php aos_animacion(); ?> class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>

            <p class="paquete__precio">$0</p>

            <form method="POST" action="/finalizar-registro/gratis">
                <input class="paquetes__submit" type="submit" value="Inscripción Gratis">
            </form>
        </div>

        <div <?php aos_animacion(); ?> class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>

            <p class="paquete__precio">$199</p>
            <div id="paypal-container-H35Y83Y2GUNNA"></div>
        </div>

        <div <?php aos_animacion(); ?> class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a talleres y conferencias</li>
                <li class="paquete__elemento">Acceso a las grabaciones</li>
            </ul>

            <p class="paquete__precio">$49</p>
            <div id="paypal-container-XKCGRBY9XFMKL"></div>
        </div>
    </div>
</main>

<!-- //Botón pase presencial
<script src="https://www.paypal.com/sdk/js?client-id=AV9qQJdsN_BUraOPV-nZQcYgq2Bp8ciE1CrZ6tzTysrrpFg2ufZTCbSay8CQkTNJvKcIsXoCpspdeEM3&currency=USD"></script>
//Botón pase virtual:
<script src="https://www.paypal.com/sdk/js?client-id=BAAbV6G4oNVU6LoZbACX7GuZLHFhwAaeDPkxDMy65-0Scao4arZj0zsKJDGD3gzkDXunfnez1FRei-CNsU&components=hosted-buttons&disable-funding=venmo&currency=USD"></script> -->

<script src="https://www.paypal.com/sdk/js?client-id=AV9qQJdsN_BUraOPV-nZQcYgq2Bp8ciE1CrZ6tzTysrrpFg2ufZTCbSay8CQkTNJvKcIsXoCpspdeEM3&currency=USD"></script>

<script>
    // function initPayPalButton() {
    //     //Pase presencial
    //     paypal.Buttons({
    //         createOrder: function(data, actions) {
    //             // Configurar los detalles de la transacción
    //             return actions.order.create({
    //                 purchase_units: [{
    //                     description: "1",
    //                     amount: {
    //                         currency_code: "USD",
    //                         value: "199"
    //                     }
    //                 }]
    //             });
    //         },
    //         onApprove: function(data, actions) {
    //             // Capturar los fondos de la transacción
    //             return actions.order.capture().then(function(orderData) {

    //                 const datos = new FormData();
    //                 datos.append('paquete_id', orderData.purchase_units[0].description);
    //                 datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

    //                 // Enviar los datos a tu servidor
    //                 fetch('/finalizar-registro/pagar', {
    //                         method: 'POST',
    //                         body: datos
    //                     })
    //                     .then(response => response.json())
    //                     .then(result => {
    //                         // Verificar el resultado y redirigir si es necesario
    //                         if (result.resultado) {
    //                             window.location.href = 'http://localhost:3000/finalizar-registro/conferencias';
    //                         } else {
    //                             console.error('El resultado no fue exitoso:', result);
    //                         }
    //                     })
    //                     .catch(error => {
    //                         console.error('Error en la solicitud fetch:', error);
    //                     });
    //             });
    //         },
    //         onError: function(err) {
    //             console.error(err);
    //         }
    //     }).render('#paypal-container-H35Y83Y2GUNNA');
    

    // //Pase virtual:
    // paypal.Buttons({
    //         createOrder: function(data, actions) {
    //             // Configurar los detalles de la transacción
    //             return actions.order.create({
    //                 purchase_units: [{
    //                     description: "2",
    //                     amount: {
    //                         currency_code: "USD",
    //                         value: "49"
    //                     }
    //                 }]
    //             });
    //         },
    //         onApprove: function(data, actions) {
    //             // Capturar los fondos de la transacción
    //             return actions.order.capture().then(function(orderData) {

    //                 const datos = new FormData();
    //                 datos.append('paquete_id', orderData.purchase_units[0].description);
    //                 datos.append('pago_id', orderData.purchase_units[0].payments.captures[0].id);

    //                 // Enviar los datos a tu servidor
    //                 fetch('/finalizar-registro/pagar', {
    //                         method: 'POST',
    //                         body: datos
    //                     })
    //                     .then(response => response.json())
    //                     .then(result => {
    //                         // Verificar el resultado y redirigir si es necesario
    //                         if (result.resultado) {
    //                             window.location.href = 'http://localhost:3000/finalizar-registro/conferencias';
    //                         } else {
    //                             console.error('El resultado no fue exitoso:', result);
    //                         }
    //                     })
    //                     .catch(error => {
    //                         console.error('Error en la solicitud fetch:', error);
    //                     });
    //             });
    //         },
    //         onError: function(err) {
    //             console.error(err);
    //         }
    //     }).render('#paypal-container-XKCGRBY9XFMKL');
    // }

    // initPayPalButton();
    function initPayPalButtons() {
        // Configurar botón de PayPal para el pase presencial
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Configurar detalles de la transacción
                return actions.order.create({
                    purchase_units: [{
                        description: '1',
                        amount: {
                            currency_code: 'USD',
                            value: '199'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capturar los fondos de la transacción
                return actions.order.capture().then(function(orderData) {
                    // Extraer datos del pedido
                    const purchaseUnit = orderData.purchase_units[0];
                    const datos = new FormData();
                    datos.append('paquete_id', purchaseUnit.description);
                    datos.append('pago_id', purchaseUnit.payments.captures[0].id);

                    // Enviar los datos al servidor
                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.resultado) {
                            window.location.href = '/finalizar-registro/conferencias';
                        } else {
                            console.error('El resultado no fue exitoso:', result);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la solicitud fetch:', error);
                    });
                });
            },
            onError: function(err) {
                console.error('Error de PayPal:', err);
            }
        }).render('#paypal-container-H35Y83Y2GUNNA'); // Renderizar botón en el contenedor
    }

    function initPayPalButtonVirtual() {
        // Configurar botón de PayPal para el pase virtual
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Configurar detalles de la transacción
                return actions.order.create({
                    purchase_units: [{
                        description: '2',
                        amount: {
                            currency_code: 'USD',
                            value: '49'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capturar los fondos de la transacción
                return actions.order.capture().then(function(orderData) {
                    // Extraer datos del pedido
                    const purchaseUnit = orderData.purchase_units[0];
                    const datos = new FormData();
                    datos.append('paquete_id', purchaseUnit.description);
                    datos.append('pago_id', purchaseUnit.payments.captures[0].id);

                    // Enviar los datos al servidor
                    fetch('/finalizar-registro/pagar', {
                        method: 'POST',
                        body: datos
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.resultado) {
                            window.location.href = '/finalizar-registro/conferencias';
                        } else {
                            console.error('El resultado no fue exitoso:', result);
                        }
                    })
                    .catch(error => {
                        console.error('Error en la solicitud fetch:', error);
                    });
                });
            },
            onError: function(err) {
                console.error('Error de PayPal:', err);
            }
        }).render('#paypal-container-XKCGRBY9XFMKL'); // Renderizar botón en el contenedor
    }

    // Inicializar los botones de PayPal
    document.addEventListener('DOMContentLoaded', function() {
        initPayPalButtons();
        initPayPalButtonVirtual();
    });

</script>