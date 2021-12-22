<? header('Content-Type: text/html; charset=latin1');  ?>
<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="css/estilos.css" rel="stylesheet">
    <!--link href="css/ionicons.min.css" rel="stylesheet"-->
    <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <title>CONTAFACIL</title>
    <script>
      function mostrarLogin(){
      var dialogo = document.getElementById('formLogin');
      dialogo.showModal();
      }
      function cerrarLogin(){
      var dialogo = document.getElementById('formLogin');
      dialogo.close();
      }
    // Para mostrar menu vertical del formulario de causacion
    function verMenu(id,archivo,campo){
    for (i=1;i<= 5;i++)
		{
			var opci = "menu"+i;
			if (opci != id)
			{
				document.getElementById(opci).style.backgroundColor="#ffffff";
				document.getElementById(opci).style.fontWeight="normal";
			}
		}
      document.getElementById(id).style.backgroundColor="rgb(220, 233, 229)";
      document.getElementById(id).style.fontWeight="bold";
      //aplicar funcion de acuerdo a archivos a cargar en el div
      document.body.style.cursor = "default"; 
		  $("#"+campo).load(archivo);	
    }
    // para cargar archivos
    function cargaArchivo(archivo,campo){
      $("#"+campo).load(archivo);	
      
    }

    </script>
    </head>
  <? //Bloque de codigo php

    
  ?>
  <body>
  <div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
      <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
      </div>
  </div>
   <!-- tabla para contenido de los datos -->  
   <br>
  <div class="container" style="width:60%">
      <ul class="list-group" >
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="" >  Cuentas por cobrar</a>
        <span class="badge bg-primary rounded-pill">1</span>
      
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
        <a href="../mvto_contable/menu_cont.php?nn='OBCG'" >Cuentas por pagar</a>
        <span class="badge bg-primary rounded-pill">2</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="" > Activos fijos </a>
        <span class="badge bg-primary rounded-pill">1</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="" >Almacen </a>
        <span class="badge bg-primary rounded-pill">1</span>
      </li>
      <li class="list-group-item d-flex justify-content-between align-items-center">
      <a href="" >Notas de contabilidad</a>
        <span class="badge bg-primary rounded-pill"></span>
      </li>
    </ul>
  </div>
    
    <!-- Optional JavaScript; choose one of the two! -->
    <!--script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
   
  
  </body>
</html>
