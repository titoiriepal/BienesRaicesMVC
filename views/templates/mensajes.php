
    
    <?php 
    if (mostrarNotificación($message)[0] !='') {?> 
        <div class="errores">

        <p class="alerta <?php echo s(mostrarNotificación($message)[1])?>"><?php echo s(mostrarNotificación($message)[0])?></p>
    
        </div>
    <?php }?> <!--Mostramos los errores según su codigo -->
    
