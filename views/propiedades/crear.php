<main class="contenedor seccion">
    <h1>Crear Propiedad</h1>

    <a href="/admin" class="boton boton-verde">Página de Administración</a>
    <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

    <?php 
        include __DIR__ . '/../templates/errores.php'; 
    ?>

    <form class="formulario" method="POST" action="/propiedades/crear" enctype="multipart/form-data">

        <?php 
            include __DIR__ . '/formulario.php'; 
        ?>

        <input type="submit" value="Crear Propiedad" class="boton boton-verde">

    </form>
</main>