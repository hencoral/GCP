<script>
	// increase the default animation speed to exaggerate the effect
	$(function() {
		// especificaciones de la ventana de dialogo
		$( "#dialog2" ).dialog({
			
			autoOpen: false,  // Abrir automaicamente
			height: 400, // Tamaño de la ventana
			width: 900,
			modal: true, // bloqueo de la pagian que genera el evento
			//show: "Clip"
            //hide: "explode" 
		}); 

		// funcion que se carga cuando se llama el archivo onload
		$( "#opener" ).ready(function() {
			
			$( "#dialog2" ).dialog( "open" );
			//$('#form2').each (function(){
				//					  this.reset();
					//				});
				

			return false;
		});
		 
	});

</script>

<!-- Espacio para cargar formulario -->
    <div id="dialog2" title="Configuracion de productos">
    <br />
     	<?php include('form_mod_val.php'); ?>
    </div>



