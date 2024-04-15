<main class="contenedor seccion">
        <h1>Contacto</h1>
        <?php if($mensaje) { ?>

            <div class="errores">
                <p class="alerta exito"><?php echo $mensaje;?></p>
            </div>
        <?php } ?>
        <picture> 
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jepg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="Imagen Contacto" width="100%" height="100%">
        </picture> 

        <a href="/" class="boton boton-verde">Página Principal</a>
        <a href="javascript:history.back()" class="boton boton-verde">Volver</a>

        <h2>Rellene el formulario de contacto</h2>

        <form class="formulario" method="POST">
            <fieldset>
                <legend>Información Personal</legend>


                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" placeholder="Tu nombre" required> 

                <label for="mensaje">Tu mensaje:</label>
                <textarea id="mensaje" name="mensaje" required></textarea>

            </fieldset>

            <fieldset>
                <legend>Información sobre la Propiedad</legend>

                <label for="opciones">Venta o compra:</label>
                <select id="opciones" name="opciones" required>
                    <option value="" disabled selected>-- Seleccione --</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o presupuesto:</label>
                <input type="number" id="presupuesto" name="presupuesto" placeholder="Tu precio o presupuesto" requiered>
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado:</p>

                <div class="forma-contacto">
                    <label for="contactar-telefono">Teléfono</label>
                    <input name="contacto" type="radio" value="telefono" id="contactar-telefono" required>

                    <label for="contactar-email">E-Mail</label>
                    <input name="contacto" type="radio" value="email" id="contactar-email" required>
                </div>

                <div id="contacto"></div>

            </fieldset>

            <input type="submit" value="Enviar" class="boton-verde">
        </form>
        

     </main>