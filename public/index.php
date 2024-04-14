<?php 
     
require_once __DIR__ .'/../includes/app.php';

use Controllers\AdminController;
use MVC\Router;
use Controllers\PropiedadController;
use Controllers\VendedorController;

$router = new Router();

$router->get('/', [AdminController::class, 'index']);//Registra  la ruta para el index de la pagina principal
$router->get('/anuncio', [AdminController::class, 'anuncio']);//Registra  la ruta para mostrar cada anuncio particular
$router->get('/anuncios', [AdminController::class, 'anuncios']);//Registra  la ruta para mostrar los anuncios
$router->get('/blog', [AdminController::class, 'blog']);//Registra  la ruta para mostrar la página del blog
$router->get('/contacto', [AdminController::class, 'contacto']);//Registra  la ruta para mostrar la página de contacto
$router->get('/nosotros', [AdminController::class, 'nosotros']);//Registra  la ruta para mostrar la página de nosotros

$router->post('/contacto', [AdminController::class, 'contacto']);//Registra  la ruta para mostrar la página del blog

$router->get('/admin', [PropiedadController::class, 'index']);//Registra  la ruta para el index de administración
$router->get('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->get('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);

$router->post('/propiedades/crear', [PropiedadController::class, 'crear']);
$router->post('/propiedades/actualizar', [PropiedadController::class, 'actualizar']);
$router->post('/propiedades/eliminar', [PropiedadController::class, 'eliminar']);

$router->get('/vendedores/crear', [VendedorController::class, 'crear']);
$router->get('/vendedores/actualizar', [VendedorController::class, 'actualizar']);

$router->post('/vendedores/crear', [VendedorController::class, 'crear']);
$router->post('/vendedores/actualizar', [VendedorController::class, 'actualizar']);
$router->post('/vendedores/eliminar', [VendedorController::class, 'eliminar']);


$router->comprobarRutas();