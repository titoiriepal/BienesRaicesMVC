<?php 
    
namespace MVC;

class Router{

    public $rutasGET =[];

    public $rutasPOST =[];

    public function get($url, $fn){ //Asigna en el array de GET la funcion que se va a realizar cuando se cargue la URL. La guardara en el arreglo con la llave del nombre de la url
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn){ //Asigna en el array de POST la funcion que se va a realizar cuando se cargue la URL. La guardara en el arreglo con la llave del nombre de la url
        $this->rutasPOST[$url] = $fn;
    }

    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //Leemos la url a la que queremos acceder. Si estamos en la raiz de las rutas asigna '/' para poder acceder a ella desde esta clase

        $metodo = $_SERVER['REQUEST_METHOD'];//Leemos el método de acceso a la url
        
        
        if ($metodo === 'GET'){//Acedemos a la función determinada dependiendo de la url. 
            $fn = $this->rutasGET[$urlActual] ?? null;        
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }



        if ($fn){ //La URL existe en nuestro index.php y tiene una función asociada
            call_user_func($fn, $this);//Llamamos a la función con los parámetros que le pasamos
        }else{
            echo 'Pagina no encontrada';
        }
        
    }

    //Muestra una vista
    public function render($view, $datos = []){

        foreach ($datos as $key => $value) {
            $$key= $value; //crea una variable con cada nombre de las llaves del arreglo y le asigna su valor
        }

        ob_start(); //Colocamos la vista en memoria
        include __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); //Recojamos lo que hay en la memoria y lo asignamos a la variable contenido, la cual mostraremos desde el layout.php
        include __DIR__. '/views/layout.php';
    }
}