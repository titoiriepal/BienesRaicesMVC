<main class="contenedor seccion">
        <h1>Crear Vendedor</h1>
        <a href="/admin" class="boton boton-verde">Página de Administración</a>
        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <div class="errores">

        <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

        <?php endforeach; ?>

        </div>

        <form class="formulario" method="POST" action="/vendedores/crear">
            <?php 
                include TEMPLATES_URL."/formulario_vendedores.php";
            ?>

            <input type="submit" value="Crear Vendedor" class="boton boton-verde">


        </form>
     </main>