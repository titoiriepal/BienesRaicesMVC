<?php 
     
namespace Model;


class Usuario extends ActiveRecord{
    

    protected static $tabla = 'usuarios';
    protected static $columnas_DB = ['id','email', 'password'];

    public $id;
    public $email;
    public $password;

    public function __construct($args = []) {

        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::$errores[]= 'Introduce un email valido, por favor';
        }
    
        if(!$this->password){
            self::$errores[]= 'Introduce un password, por favor';
        }

        return self::$errores;
    }

    public function comprobarPassword($cadena){
        return password_verify($cadena, $this->password);
    }

    public function autenticar(){
        session_start();
        //Llenar el arreglo de la sesion
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true;

        header( "Location:/admin" );
    }
}