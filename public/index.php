<?php 
     
require_once __DIR__ .'/../includes/app.php';

use MVC\Router;
use Controllers\PropiedadController;

$router = new Router();

$router->get('/admin', [PropiedadController::class, 'index']);//Registra  la ruta para el index de la pagina principal
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->post('/propiedades/eliminar', [PropiedadController::class, 'index']);//Registra  la ruta para el index de la pagina principal
$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);


$router->comprobarRutas();