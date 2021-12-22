<?php
set_time_limit(1200);
session_start();
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

if (!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
		// verifico permisos del usuario
   	$sql="SELECT info FROM usuarios2 where login = '$_SESSION[login]'";
		$res=$cx->query($sql);
		$rw =$res->fetch_assoc();
if ($rw['info']=='SI')
{

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script>
function VerFecha()
{
	if (document.getElementById("mov_periodo").checked)
		{
			document.getElementById("fecha_periodo").style.display="";
			document.getElementById("mov_mes").checked='';
		}else{
			document.getElementById("fecha_periodo").style.display="none";
		}
}

function VerMes()
{
	if (document.getElementById("mov_mes").checked)
		{
			document.getElementById("mov_periodo").checked='';
			document.getElementById("fecha_periodo").style.display="none";
		}
}
</script>


<style type="text/css">
<!--
.Estilo1 {
	font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
	font-size: 12px;
	font-weight: bold;
}
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
a {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	color: #666666;
}
a:link {
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo10 {
	color: #FFFFFF;
	font-weight: bold;
}
.Estilo11 {font-size: 10px}
-->
</style>
</head>


</head>

<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div>
      <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
        <div align="center">
	      <?php
//-------
$sxx = "select * from fecha";
$rxx = $cx->query($sxx);

while($rowxxx = $rxx->fetch_assoc())
   {
   
   $idxxx=$rowxxx["id_emp"];
   $id_emp=$rowxxx["id_emp"];
   $ano=$rowxxx["ano"];

   }
   

$sxxq = "select * from fecha_ini_op";
$rxxq = $cx->query($sxxq);

while($rowxxxq = $rxxq->fetch_assoc())
   
   {
   
   $fecha_ini_op=$rowxxxq["fecha_ini_op"];


   }   

			
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = $cx->query($sq2);

while($row2 = $re2->fetch_assoc())
   
   {
printf("<span class='Estilo4'><b>...::: %s :::...</b></span><br>", $row2["raz_soc"]);  
   }
//--------	--------------------------------------------------------------------------------------------
?><br />
<span class="Estilo1">EJECUCION PRESUPUESTAL DE GASTOS CON DISPONIBILIDAD </span></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">
	
	<form name="a" method="post" action="ejec_pptal_gastos4.php">
	  <table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="2" bgcolor="#DCE9E5"><div class="Estilo4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:5px;">
      <div align="center" class="Estilo5"><b>NOTA</b>: La consulta se hara con base a la <b>Fecha de Inicio</b> y <b>Fecha Final</b> que usted seleccione </div>
    </div></td>
  </tr>
  <tr id="fecha_periodo" style="display:none">
    <td width="250"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right"> Fecha inicio periodo :</div>
    </div></td>
    <td width="350">
      <div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left">
        <input name="fecha_per" type="text" class="Estilo4" id="fecha_per" value="<?php printf($fecha_ini_op); ?>" size="12" />
        <span class="Estilo10">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_per,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
  
  <tr>
    <td><div id="div2" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="right" class="Estilo4">
	  <input type="hidden" name="fecha_ini" value="<?php printf($fecha_ini_op); ?>"	   />
      <?php printf('Fecha de corte :'); ?></div>
    </div></td>
    <td><div id="div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="left">
        <input name="fecha_fin" type="text" class="Estilo4" id="fecha_fin" value="<?php printf($ano); ?>" size="12" />
        <span class="Estilo10">::</span>
        <input name="button2" type="button" class="Estilo4" id="button2" onclick="displayCalendar(document.a.fecha_fin,'yyyy/mm/dd',this)" value="Seleccionar Fecha" />
      </div>
    </div></td>
  </tr>
    <tr>
    <td ><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right">Generar movimiento del mes : 
       
      </div>
    </div></td>
    <td>&nbsp;<input name="mov_mes" id="mov_mes" type="checkbox" class="Estilo4" value="1" onclick="VerMes();" /></td>
  </tr>
  
  <tr>
    <td ><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="right">Ejecuci&oacute;n por periodo : 
       
      </div>
    </div></td>
    <td>&nbsp;<input name="mov_periodo" id="mov_periodo" type="checkbox" class="Estilo4" value="1" onclick="VerFecha();" /></td>
  </tr>
  <tr>
    <td colspan="2"><div class="Estilo4" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <input name="Submit" type="submit" class="Estilo4" value="Consultar" />
      </div>
    </div></td>
  </tr>
</table>
</form>	</td>
  </tr>
</table>
<?php
  if(isset($_POST['fecha_ini']))	$fecha_ini=$_POST['fecha_ini']; else $fecha_ini=''; 
  if(isset($_POST['fecha_fin']))	$fecha_fin=$_POST['fecha_fin']; else $fecha_fin='';
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo4'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
<br />
<br />
<table width="800" border="0" align="center">
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../user.php' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
            <span class="Estilo4"> <strong>
            <?php   			
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc())
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
            </strong> </span> <br />
            <span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266"><div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center">
        <?php  echo $nom_emp ?>
        <br />
        <?php echo $dir_tel ?><br />
        <?php echo $muni ?> <br />
        <?php echo $email?> </div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
      <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <br />
        </a><br />
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a></div>
    </div></td>
    <td width="266"><div class="Estilo7" id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
      <div align="center">Desarrollado por <br />
            <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
        Derechos Reservados - 2009 </div>
    </div></td>
  </tr>
</table>
</body>
</html>






<?php
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
}
?>