<?php 

    if(!isset($_SESSION)){
        session_start();
    }

    $auth = $_SESSION['login'] ?? null;
    
     if(!isset($inicio)){
        $inicio = false;
     }
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
     <header class="header <?php echo $inicio ? 'inicio' : ''; ?>">
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/index.php">
                    <img src="/build/img/logo.svg" height="50px" width="auto" alt="Logotipo de la empresa Bienes Raices">
                </a>

                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono Menú Responsive" height="50%" width="50%">
                </div>

                <div class="derecha">

                    <img src="/build/img/dark-mode.svg" alt="Botón para el dark mode" class="dark-mode-boton" width="50%" height="50%">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <?php if($auth): ?>
                            
                        <a href="/cerrar-sesion.php">Cerrar Sesión</a>
                             
                        <?php endif; ?>
                    </nav>
                    

                </div>



            </div><!-- barra -->
            <?php if($inicio) {?> 
                <h1>Venta de Casas y apartamentos exclusivos de lujo</h1>
            <?php }; ?>

        </div>
     </header>

    <?php 
        echo $contenido; 
    ?>


     <footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="/nosotros.php">Nosotros</a>
                <a href="/anuncios.php">Anuncios</a>
                <a href="/blog.php">Blog</a>
                <a href="/contacto.php">Contacto</a>
            </nav>
            
        </div>

        <?php 
            $fecha = date("Y"); 
        ?>

        <p class="copyright">Todos los derechos Reservados <?php echo "$fecha";?> &copy;</p>
     </footer>



    <script src="/build/js/bundle.min.js"></script>
</body>
</html>