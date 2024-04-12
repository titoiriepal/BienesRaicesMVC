<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>

    <?php 
        include TEMPLATES_URL."/mensajes.php"; 
    ?>

    <a href="propiedades/crear" class="boton boton-verde">Nueva Propiedad</a>
    <a href="vendedores/crear" class="boton boton-amarillo">Nuevo Vendedor</a>

    <h2>Propiedades</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php  foreach ($propiedades as $propiedad): ?>

                <tr>
                    <td><?php echo $propiedad->id?></td>
                    <td><?php echo $propiedad->titulo?></td>
                    <td class="centrar">
                        <img class= "imagen-tabla" src="imagenes/<?php echo $propiedad->imagen?>" alt="Imagen Propiedad" width="200px" height="160px">  
                    </td>
                    <td><?php echo $propiedad->precio?> €</td>
                    <td class= "acciones">
                        <a class="boton boton-amarillo-block" href="/propiedades/actualizar?id=<?php echo $propiedad->id?>">Actualizar</a>
                        <form method="POST" class="w-100" action="/propiedades/eliminar">
                            <input type="hidden" name="idPropiedad" value="<?php echo $propiedad->id?>">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        

                    </td>
                </tr>
            <?php endforeach; ?>

            
        </tbody>
    </table>

    <h2>Vendedores</h2>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Telefono</th>
                <th>Acciones</th>

            </tr>
        </thead>

        <tbody>
            <?php  foreach ($vendedores as $vendedor): ?>

                <tr>
                    <td><?php echo $vendedor->id?></td>
                    <td><?php echo $vendedor->nombre?></td>
                    <td><?php echo $vendedor->apellidos?></td>
                    <td><?php echo $vendedor->telefono?></td>
                    <td class= "acciones">
                        <a class="boton boton-amarillo-block" href="/vendedores/actualizar?id=<?php echo $vendedor->id?>">Actualizar</a>
                        <form action="/vendedores/eliminar" method="POST" class="w-100">
                            <input type="hidden" name="idVendedor" value="<?php echo $vendedor->id?>">
                            <input type="submit" class="boton boton-rojo-block" value="Eliminar">
                        </form>
                        

                    </td>
                </tr>
            <?php endforeach; ?>
            
            
        </tbody>
    </table>

</main>

