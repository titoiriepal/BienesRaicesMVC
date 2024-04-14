<?php 
    $pagina =  ($_GET['id']) ?  "Actualizar Vendedor" : "Crear Vendedor";
?>

<main class="contenedor seccion">
        <h1><?php echo $pagina ?></h1>
        <a href="/admin" class="boton boton-verde">Página de Administración</a>
        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        </div>

        <form class="formulario" method="POST">
            <?php 
                include __DIR__ . '/formulario.php'; 
            ?>

            <input type="submit" value="<?php echo $pagina ?>" class="boton boton-verde">


        </form>
     </main>
