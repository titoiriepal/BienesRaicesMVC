<?php 
     
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;

class AdminController{

    public static function index(Router $router){
        $propiedades= Propiedad::get(3);

        $router->render('Admin/index',[
            'propiedades' => $propiedades,
            'inicio' => true

        ]);
        
    }

    public static function anuncio(Router $router){
        if(!$_GET['id']){
            header('location: /admin?message=2');
        }
    
        //identificamos la propiedad
    
        $idPropiedad = (filter_var($_GET['id'],FILTER_VALIDATE_INT));
          
    
        if(!$idPropiedad){
    
            header('location:/');
    
        }else{
    
            $propiedad = Propiedad::find($idPropiedad);
    
            if(!$propiedad){
                header('location:/');
            }
        }
         

        $router->render('Admin/anuncio',[
            'propiedad' => $propiedad

        ]);
        
    }

    public static function anuncios(Router $router){
        $propiedades= Propiedad::get(9);

        $router->render('Admin/anuncios',[
            'propiedades' => $propiedades

        ]);
        
    }

    public static function blog(Router $router){

        $router->render('Admin/blog',[

        ]);
        
    }

    public static function contacto(Router $router){


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            echo "Enviando formulario...";
        }
        $router->render('Admin/contacto',[

        ]);
        
    }

    public static function nosotros(Router $router){

        $router->render('Admin/nosotros',[

        ]);
        
    }
}