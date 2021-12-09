<?php
set_time_limit(600);
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
   <title>CONTAFACIL</title>
<script src="jquery-1.3.2.min.js" type="text/javascript"></script>   
<script>
$(document).ready(function(){
   $("#enlaceajax").click(function(evento){
      evento.preventDefault();
      $("#cargando").css("display", "inline");
      $("#destino").load("balance_prueba2.php", function(){
         $("#cargando").css("display", "none");
      });
   });
})
</script>
<style type="text/css">
<!--
.Estilo1x {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
a:link {
	color: #666666;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
	color: #666666;
}
a:hover {
	text-decoration: underline;
	color: #666666;
}
a:active {
	text-decoration: none;
	color: #666666;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>

<body>
<?php
include('../config.php');
global $server, $database, $dbpass,$dbuser,$charset;
// Conexion con la base de datos
$cx= new mysqli ($server, $dbuser, $dbpass, $database);
$fecha_ini=$_POST['fecha_ini']; //printf("fecha_ini : %s <br>",$fecha_ini);
$fecha_fin=$_POST['fecha_fin'];//printf("fecha_fin : %s <br>",$fecha_fin);
$cod_ini=$_POST['cod_ini'];//printf("cod_ini : %s <br>",$cod_ini);
$cod_fin=$_POST['cod_fin'];
if ($_POST['mov']) $mov=$_POST['mov']; else $mov='';//printf("cod_fin : %s <br>",$cod_fin);
//**** variables para generacion dinamica
$tabla6="aux_bal_prueba";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";

///**** creo la tabla 
		$tabla7="aux_bal_prueba";
		$anadir7="CREATE TABLE ";
		$anadir7.=$tabla7;
		$anadir7.="
		(
  `fecha_ini` varchar(200) NOT NULL default '',
  `fecha_fin` varchar(200) NOT NULL default '',
  `cod_ini` varchar(200) NOT NULL default '',
  `cod_fin` varchar(200) NOT NULL default '',
  `mov` varchar(2) NOT NULL default ''

)TYPE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci";
		

$sql = "INSERT INTO aux_bal_prueba ( fecha_ini , fecha_fin , cod_ini , cod_fin,mov) VALUES ( '$fecha_ini', '$fecha_fin', '$cod_ini', '$cod_fin','$mov')";
$cx->query($sql)
?>
<center>
<br>
<a href="#" class="Estilo1x" id="enlaceajax"><b>Paso No. 2 : 
<br>
<br>
Clic AQUI para Generar BALANCE DE PRUEBA </b></a><br>
<div style="padding-left:5px; padding-top:15px; padding-right:5px; padding-bottom:10px;">
  <div align="center">
    <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:200px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='balance_prueba.php' target='_parent' class="Estilo1x">VOLVER A PASO 1 </a> </div>
      </div>
    </div>
  </div>
</div>

<div id="cargando" style="display:none; color: green;">
<img src="libaux2.gif" width="160" height="150">
<br><center class="Estilo1x">La consulta tardara 1 min 45 seg seg aprox, Tenga Paciencia por favor</center>
</div>
</center>
<br>
<div id="destino"></div>
</body>
</html> 
<?php
}
?>