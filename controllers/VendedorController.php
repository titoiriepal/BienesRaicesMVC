<?php 
     
namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController{


    public static function crear(Router $router){

        estaAutorizado();

        $vendedor = new Vendedor();

        $errores = Vendedor::getErrores();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            
            $vendedor = new Vendedor($_POST);

            $errores = $vendedor->validar();
            
            if(empty($errores)){
                $resultado = $vendedor->guardar();
            }

            if ($resultado){
                header('location:/admin?message=7');
            }

        }

        $router->render('vendedores/vendedores',[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }

    public static function actualizar(Router $router){

        estaAutorizado();

        $idVendedor = validarORedireccionar('/admin?message=2');
    
        $vendedor = Vendedor::find( $idVendedor );
 
        if (!$vendedor){
            header('location: /admin?message=3');
        }

        $errores = Vendedor::getErrores();
        
        if($_SERVER['REQUEST_METHOD']==='POST'){
            
            $vendedor->sincronizar($_POST);

            $errores = $vendedor->validar();

            if(empty($errores)){

                $resultado = $vendedor->guardar();

                if($resultado){
                    header('location:/admin?message=8');
                }
            }
        }

        $router->render('vendedores/vendedores',[
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
        
    }

    public static function eliminar(){

        estaAutorizado();
        
        $id = filter_var($_POST['idVendedor'], FILTER_VALIDATE_INT);

        if($id){
            $vendedor = Vendedor::find($id);
            $resultado = $vendedor->eliminar();
            //Eliminar la imagen del servidor

            if($resultado){   
                
                header('location: /admin?message=6');
            }else{
                header('location: /admin');
            }
        }else{
            header('location: /admin?message=3');
        }
    }



}