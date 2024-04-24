<?php

namespace Controllers;

use Model\Registro;
use Classes\Paginacion;
use Model\Paquete;
use Model\Usuario;
use MVC\Router;

class RegistradosController {
    public static function index(Router $router) {

        //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
        if(!is_admin()) {
            header('Location: /login');
        }

        //PAGINACIÓN
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if( !$pagina_actual || $pagina_actual < 1 ) {
            header('Location: /admin/registrados?page=1');
        }

        $registros_por_pagina = 10;

        $total = Registro::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if( $paginacion->total_paginas() < $pagina_actual ) {
            header('Location: /admin/registrados?page=1');
        }

        //Instancio clase ponente para traer todos los registros de la base de datos
        $registros = Registro::paginar($registros_por_pagina, $paginacion->offset());
        foreach($registros as $registro) {
            $registro->usuario = Usuario::find($registro->usuario_id);
            $registro->paquete = Paquete::find($registro->paquete_id);
        }

        // Render a la vista 
        $router->render('admin/registrados/index', [
            'titulo' => 'Usuarios Registrados',
            'registros' => $registros,
            'paginacion' => $paginacion->paginacion()
        ]);
    }
}