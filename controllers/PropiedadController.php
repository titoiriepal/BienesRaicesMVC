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
                //Crear Carpeta de Imágenes si no existe
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

    public static function actualizar(Router $router){

        $idPropiedad = validarORedireccionar('/admin?message=2');
        

        $propiedad = Propiedad::find( $idPropiedad );
        if (!$propiedad){
            header('location: /admin?message=3');
        
        }

        //Almacenamos el nombre de la imagen para comprobar si hay imagen en el registro
        $nombreImagen = $propiedad->imagen;

        //Consulta para obtener los vendedores de BD

        $vendedores = Vendedor::all();

        $errores=[];

        if($_SERVER['REQUEST_METHOD']==='POST'){
         
            $propiedad->sincronizar($_POST);
    
            //Asignar files hacia una variable  
            $imagen = $_FILES[ 'imagen' ] ?? '';
             
            $errores = $propiedad->validar();
            //Comprobar que existe la imagen y que pesa menos de 200KB   
    
            $limiteKB=2000000; //Limite de 2MB para las imagenes
            if(!$imagen['name'] && !$propiedad->imagen){
                $errores[] = 'La imagen es obligatoria';
            }else if($imagen['name'] && $imagen['error']){
                $errores[] = 'Ha ocurrido un error en el envío del archivo: '. $imagen['error'];
            
            }else if($imagen['name'] && $imagen['size'] > $limiteKB){
                $errores[] = "El archivo es demasiado grande. El tamaño máximo permitido son " . $limiteKB / 1000 . "KB";
            }

            if(empty($errores)){

                if($imagen['name']){ //Si se ha elegido una imagen, cambiamos la imagen elegida
    
                    //Crear Carpeta
    
                    if(!is_dir(CARPETA_IMAGENES)){
                        mkdir(CARPETA_IMAGENES);
                    }
        
                    //Borramos la imagen anterior si esta existe
        
                    if ($propiedad->imagen){
                        if(file_exists(CARPETA_IMAGENES. $propiedad->imagen)){
                            unlink(CARPETA_IMAGENES. $propiedad->imagen);
                        }
                    }
              
                    /**Subida de archivos*/
        
                    //Subir la imagen
                    //Identificamos el tipo de imagen para poner la extensión en la bd
                    $extension = imageExtension($_FILES['imagen']['type']);
        
                    //Generar un nombre único
                    $nombreImagen = md5(uniqid(rand(), true)) . $extension;
        
                                //creamos la imagen con Imagemin
                    $manager = new Image(Driver::class);
                    //Transformamos la imagen y la cambiamos el tamaño
                    $image = $manager->read($_FILES['imagen']['tmp_name'])->cover(800,600); 
    
                    //Guardamos la imagen
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
    
                    //añadimos el nombre de la imagen a los atributos de Propiedad, siempre y cuando haya una imagen
                    $propiedad->setImagen($nombreImagen);
    
                }
    
                /**Subida de archivos*/
                $resultado = $propiedad->guardar();  
    
                if($resultado){
                    header('location: /admin?message=4');
                }
    
            }

        }
        $router->render('propiedades/actualizar',[
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);

    }

    public static function eliminar (){

        $id = filter_var($_POST['idPropiedad'], FILTER_VALIDATE_INT);

        if($id){
            $propiedad = Propiedad::find($id);
            $resultado = $propiedad->eliminar();
            //Eliminar la imagen del servidor

            if($resultado){
                $nombreImagen = $propiedad->imagen; 

                if(file_exists(CARPETA_IMAGENES. $nombreImagen)){
                    unlink(CARPETA_IMAGENES . $nombreImagen);
                }      
                
                header('location: /admin?message=5');
            }else{
                header('location: /admin');
            }
        }else{
            header('location: /admin?message=3');
        }
        
    }

}