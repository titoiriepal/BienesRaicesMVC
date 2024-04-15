<?php 

namespace Controllers;
use Model\Usuario;
use MVC\Router;

     
class LoginController{

    public static function login(Router $router){
        $errores = Usuario::getErrores();
        $usuario = new Usuario();

        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario = new Usuario($_POST);

            $errores = $usuario->validar();

            if(empty($errores)){
                $existeUsuario = $usuario->findby('email', $usuario->email);
                if (!$existeUsuario) {
                    $errores[] = "Compruebe que el usuario y la contraseña sean correctos" ;
                }else{
                    $auth = $existeUsuario->comprobarPassword($usuario->password);
                    
                    if(!$auth){
                        $errores[] = "Compruebe que el usuario y la contraseña sean correctos" ;
                    }else{

                        $existeUsuario->autenticar();
                    }
                }

            }
            
        }
        
        
        $router->render('Auth/login',[
            'errores' =>  $errores,
            'usuario' => $usuario
        ]);
    }

    public static function logout(){
        
        session_start(); 

        $_SESSION = [];

        header('location:/');

    }
}