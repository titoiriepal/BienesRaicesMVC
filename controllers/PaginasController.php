<?php 
     
namespace Controllers;
use MVC\Router;
use Dotenv\Dotenv;
use Model\Vendedor;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;



class PaginasController{

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

        require __DIR__ . '/../vendor/autoload.php';

        $dotenv = Dotenv::createImmutable(__DIR__ . '/..');
        $dotenv->load();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $continuar = false;
            if ($_POST['contacto'] === 'telefono'){
                $contacto = '<p> Eligio ser contactado por Teléfono </p>';
                $contacto .= '<p> Teléfono de Contacto : ' . $_POST[ 'telefono' ] . ' </p>';
                $contacto .= '<p> Fecha y hora de contacto :' . $_POST[ 'fecha' ] . ' a las ' . $_POST['hora'] .' </p>';
                $continuar = true;
            }else if ($_POST['contacto'] === 'email'){
                $contacto = '<p> Eligio ser contactado por Email </p>';
                $contacto .='<p> Email de Contacto : ' . $_POST[ 'email' ] . ' </p>';
                $continuar = true;
            }
            
            if($continuar){
                 //Creamos una instancia de PhpMailer
                $mail = new PHPMailer();

                //Configuramos SMTP
                $mail->isSMTP();
                $mail->Host = 'sandbox.smtp.mailtrap.io';
                $mail->SMTPAuth = true;
                $mail->Port = 2525;
                $mail->Username = $_SERVER['MAIL_USER'];
                $mail->Password = $_SERVER['MAIL_PWD'];
                $mail->SMTPSecure = 'tls';
    
                //Configurar el contenido del email
                $mail->setFrom('admin@bienesraices.com');
                $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com');
                $mail->Subject = 'Tienes un Nuevo Mensaje';
    
                //Habilitar HTML
                $mail->isHTML(true);
                $mail->CharSet = "UTF-8";
    
                //Definir el contenido
                $contenido = '<html>';
                $contenido .= '<h2> Tienes un nuevo mensaje de ' . $_POST['nombre'] . '</h2>';
                $contenido .= '<p> Mensaje : ' . $_POST[ 'mensaje' ] . ' </p>';
                $contenido .= '<p> Tipo de transacción : ' . $_POST[ 'opciones' ] . ' </p>';
                $contenido .= '<p> Precio o Presupuesto : ' . $_POST[ 'presupuesto' ] . '€ </p>';
                $contenido .= '<p> Forma de Contacto : ' . $_POST[ 'contacto' ] . ' </p>';
                $contenido .= $contacto;
                $contenido .='</html>';
    
                $mail->Body = $contenido;
                $mail->AltBody = "Esto es texto alternativo sin html";
    
                //Enviar el email
                if($mail->send()){
                    $mensaje = "Mensaje Enviado Correctamente";
                }else{
                    $mensaje = "Error al enviar el correo: {$mail->ErrorInfo}";
                }

            }else{
                $mensaje = "Error en el envío del formulario";

            }



        }
        $router->render('Admin/contacto',[
            'mensaje' => $mensaje ?? null
        ]);
        
    }

    public static function nosotros(Router $router){

        $router->render('Admin/nosotros',[
            
        ]);
        
    }
}