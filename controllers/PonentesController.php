<?php

namespace Controllers;

use Classes\Paginacion;
use MVC\Router;
use Model\Ponente;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
// use Intervention\Image\ImageManagerStatic as Image;

class PonentesController {
    public static function index(Router $router) {

        //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
        if(!is_admin()) {
            header('Location: /login');
        }

        //PAGINACIÓN
        $pagina_actual = $_GET['page'];
        $pagina_actual = filter_var($pagina_actual, FILTER_VALIDATE_INT);

        if( !$pagina_actual || $pagina_actual < 1 ) {
            header('Location: /admin/ponentes?page=1');
        }

        $registros_por_pagina = 10;

        $total = Ponente::total();

        $paginacion = new Paginacion($pagina_actual, $registros_por_pagina, $total);

        if( $paginacion->total_paginas() < $pagina_actual ) {
            header('Location: /admin/ponentes?page=1');
        }

        //Instancio clase ponente para traer todos los registros de la base de datos
        $ponentes = Ponente::paginar($registros_por_pagina, $paginacion->offset());

        // Render a la vista 
        $router->render('admin/ponentes/index', [
            'titulo' => 'Ponentes / Expositores',
            'ponentes' => $ponentes, 
            'paginacion' => $paginacion->paginacion()
        ]);
    }

    public static function crear(Router $router) {

        //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        $ponente = new Ponente;

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
            if(!is_admin()) {
                header('Location: /login');
            }
            
            //Leer imagen
            if( !empty($_FILES['imagen']['tmp_name'])) {
                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/speakers';

                //Si la carpeta no existe, la creará
                if( !is_dir($carpeta_imagenes) ) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes
                $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_png->scale(800,800);
                
                $imagen_webp = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_webp->scale(800,800);

                $imagen_avif = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_avif->scale(800,800);

                // $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                // $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                //Agregar el nombre de la imagen al POST:
                $_POST['imagen'] = $nombre_imagen;
            } 

            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES );        
            $ponente -> sincronizar($_POST);
            //Sincronizar

            //Validar
            $alertas = $ponente->validar();

            //Guardar el registro
            if(empty($alertas)) {
                //Guardar las imágenes:
                $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');

                //Guarda en la base de datos:
                $resultado = $ponente->guardar();

                //Si todo va bien, redirecciono:
                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        //Convertir el string de redes en un arreglo:
        $redes = json_decode($ponente->redes);

        // Render a la vista 
        $router->render('admin/ponentes/crear', [
            'titulo' => 'Registrar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function editar(Router $router) {
        //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
        if(!is_admin()) {
            header('Location: /login');
        }

        $alertas = [];
        
        //Validar el id
        $id = $_GET['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT); //Validará que es un número entero

        if( !$id ) { //Si no es un entero, redireccionamos
            header('Location: /admin/ponentes');
        }

        //Obtener ponente a editar
        $ponente = Ponente::find($id);

        if( !$ponente ) { //Si no existe el ponente, redireccionamos
            header('Location: /admin/ponentes');
        }

        $ponente->imagen_actual = $ponente->imagen;

        //Convertir el string de redes en un arreglo:
        $redes = json_decode($ponente->redes);

        if( $_SERVER['REQUEST_METHOD'] === 'POST'){
            //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
            if(!is_admin()) {
                header('Location: /login');
            }

            //Leer imagen
            if( !empty($_FILES['imagen']['tmp_name'])) {
                //Crear una carpeta para las imágenes
                $carpeta_imagenes = '../public/img/speakers';

                //Si la carpeta no existe, la creará
                if( !is_dir($carpeta_imagenes) ) {
                    mkdir($carpeta_imagenes, 0755, true);
                }

                //Crea las imágenes
                $nombre_imagen = md5( uniqid( rand(), true ) );

                $manager = new ImageManager(new Driver());

                $imagen_png = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_png->scale(800,800);
                
                $imagen_webp = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_webp->scale(800,800);

                $imagen_avif = $manager->read( $_FILES['imagen']['tmp_name'] );
                $imagen_avif->scale(800,800);

                // $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('png', 80);
                // $imagen_webp = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('webp', 80);

                //Agregar el nombre de la imagen al POST:
                $_POST['imagen'] = $nombre_imagen;

            } else {
                $_POST['imagen'] = $ponente->imagen_actual;
            }

            $_POST['redes'] = json_encode( $_POST['redes'], JSON_UNESCAPED_SLASHES ); 
            $ponente->sincronizar($_POST);
            $alertas = $ponente->validar();

            if( empty($alertas) ) {
                if( isset($nombre_imagen) ) {
                    //Guardar las imágenes:
                $imagen_png->toPng()->save($carpeta_imagenes . '/' . $nombre_imagen . '.png');
                $imagen_webp->toWebp()->save($carpeta_imagenes . '/' . $nombre_imagen . '.webp');
                $imagen_avif->toAvif()->save($carpeta_imagenes . '/' . $nombre_imagen . '.avif');
                }

                $resultado = $ponente->guardar();

                if($resultado) {
                    header('Location: /admin/ponentes');
                }
            }
        }

        // Render a la vista 
        $router->render('admin/ponentes/editar', [
            'titulo' => 'Actualizar Ponente',
            'alertas' => $alertas,
            'ponente' => $ponente,
            'redes' => $redes
        ]);
    }

    public static function eliminar() {
        if( $_SERVER['REQUEST_METHOD'] === 'POST') {
            //Si no es administrador, redireccionaos a login para que vuelva a iniciar sesión
            if(!is_admin()) {
                header('Location: /login');
            }
            
            $id = $_POST['id'];
            $ponente = Ponente::find($id);

            if(isset($ponente)) {
                header('Location: /admin/ponentes');
            }
            
            $resultado = $ponente->eliminar();

            if($resultado) {
                header('Location: /admin/ponentes');
            }
        }
    }
}