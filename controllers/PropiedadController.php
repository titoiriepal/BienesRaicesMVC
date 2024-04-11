<?php 
     
namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManager as Image;
use Intervention\Image\Drivers\Gd\Driver;

class PropiedadController{

    public static function index(Router $router){
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $message = $_GET['message'] ?? null;
        $router->render('propiedades/admin',[
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'message' => $message

        ]);
    }
    
    public static function crear(Router $router){
        
        $propiedad = new Propiedad();
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $propiedad = new Propiedad($_POST);

            if($_FILES['imagen']['tmp_name'] !="") {

                $extension = imageExtension($_FILES['imagen']['type']);   
   
                $nombreImagen = md5(uniqid(rand(), true)) . $extension;
                $propiedad->setImagen($nombreImagen);
            
            }
            
            $errores = $propiedad->validar();
            if($_FILES['imagen']['tmp_name'] !="" && $_FILES['imagen']['error']){
                $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $_FILES['imagen']['error'];
            }

            if(empty($errores)){


                //Crear Carpeta
    
                if(!is_dir(CARPETA_IMAGENES)){
                    mkdir(CARPETA_IMAGENES);
                }
    
                //Subir la imagen
                //creamos la imagen con Imagemin
                $manager = new Image(Driver::class);
                //Transformamos la imagen y la cambiamos el tamaño
                $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600);  

                $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                /**Subida de archivos*/
                $resultado = $propiedad->guardar();             
    
                if($resultado){
                    header('location: /admin?message=1');
                }
    
            }
            
        }

        $router->render('propiedades/crear',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }

    public static function actualizar(){
        echo 'Desde actualizar propiedad';
    }

}