<main class="contenedor seccion contenido-centrado">
        <h1>Iniciar Sesion</h1>

        <div class="errores">
            <?php foreach($errores as $error) :?>

            <p class="alerta error"><?php echo $error;?></p>

            <?php endforeach; ?>
        </div>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Datos de Conexión</legend>

                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" placeholder="Tu E-mail" value="<?php echo $usuario->email ?>">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Tu Password"> 

            </fieldset>

            <input type="submit" value="Iniciar Sesion" class="boton boton-verde">
        </form>
     </main>