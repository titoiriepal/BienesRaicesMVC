<?php 
    
namespace MVC;

class Router{

    public $rutasGET =[];

    public $rutasPOST =[];

    public function get($url, $fn){ //Asigna en el array de GET la funcion que se va a realizar cuando se cargue la URL. La guardara en el arreglo con la llave del nombre de la url
        $this->rutasGET[$url] = $fn;
    }

    public function comprobarRutas(){

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //Leemos la url a la que queremos acceder. Si estamos en la raiz de las rutas asigna '/' para poder acceder a ella desde esta clase

        $metodo = $_SERVER['REQUEST_METHOD'];//Leemos el método de acceso a la url

        if ($metodo = 'GET'){//Acedemos a la función determinada dependiendo de la url. 
            $fn = $this->rutasGET[$urlActual] ?? null;
        }

        if ($fn){ //La URL existe en nuestro index.php y tiene una función asociada
            call_user_func($fn, $this);//Llamamos a la función con los parámetros que le pasamos
        }else{
            echo 'Pagina no encontrada';
        }
        
    }
}