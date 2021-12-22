<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) 
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_DE_INGRESOS.xls");
header("Pragma: no-cache");
header("Expires: 0");
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
			document.getElementById("fecha_periodo").style.display="inline";
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

.text
  {
 mso-number-format:"\@"
  }
-->
</style>
</head>
<body>
<?php
//-------
include('../config.php');	

global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
$sxx = "select * from fecha";
$rxx = $cx->query($sxx);
while($rowxxx = $rxx->fetch_array())
   {
   $idxxx=$rowxxx["id_emp"];
   $id_emp=$rowxxx["id_emp"];
   $ano=$rowxxx["ano"];
   }
$sxxq = "select * from fecha_ini_op";
$rxxq = $cx->query($sxxq);
while($rowxxxq = $rxxq->fetch_array())
   
   {
   $fecha_ini_op=$rowxxxq["fecha_ini_op"];
   }   
$sq2 = "select * from empresa where cod_emp = '$idxxx'";
$re2 = $cx->query($sq2);
while($row2 = $re2->fetch_array())
   
   {
   $empresa = $row2["raz_soc"];
   }
//--------	--------------------------------------------------------------------------------------------

	$fecha_ini=$_POST['fecha_ini']; //printf("fecha ini : %s",$fecha_ini);
	$fecha_fin=$_POST['fecha_fin'];	//printf("fecha fin : %s",$fecha_fin);
	$tipo = $_POST['mov_mes'];
	$fecha_per = $_POST['fecha_per'];
	$mov_periodo = $_POST['mov_periodo'];
	$central = $_POST['central'];
	$anno = substr($ano,0,4);
	if($central ==1) $sia = "and cod_sia != 'E' and cod_sia != 'S' and cod_sia != 'T' and cod_sia != 'v'"; 	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
?>

<table width="800" border="0" align="center">
<tr>
  <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
	<td align="center" colspan="11"></td>
</tr>
<tr>
	<td align="center" colspan="11"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="11"><font size="4"><b>EJECUCION PRESUPUESTAL DE INGRESOS X PERIODO</b></font></td>
</tr>
<tr>
    <td align="center" colspan="11"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="11"></td>
</tr>
<tr>
	<td align="left" colspan="12"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
</tr>
</table>
<br />
<?php


	printf("
	<center>
	
	<table width='1800' BORDER='1' class='bordepunteado1'>
	<tr bgcolor='#DCE9E5'>
	<td align='center' width='150'>
	<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
	<span class='Estilo4'><b>Cod. Pptal</b></span>
	</div>
	</td>
	<td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	// Calculo de gastos por mes 
$sq = "select * from z_central_ing  order by cod asc ";
$re = $cx->query($sq);
while($rw = $re->fetch_assoc())
{
	
	$cod=$rw["cod"];
	$nom=$rw["nombre"];
	//****
	
	//****
	$sql="select SUM(def) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs1=$cx->query($sql);
	$rw1=$rs1->fetch_assoc();
	$def=$rw1[0];
	
	$sq2="select SUM(adi) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs2=$cx->query($sq2);
	$rw2=$rs2->fetch_assoc();
	$adi=$rw2[0];
	
	$sq7="select SUM(red) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs7=$cx->query($sq7);
	$rw7=$rs7->fetch_assoc();
	$red=$rw7[0];
	
	$sq3="select SUM(cre) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs3=$cx->query($sq3);
	$rw3=$rs3->fetch_assoc();
	$cre=$rw3[0];
	
	$sq4="select SUM(ccre) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs4=$cx->query($sq4);
	$rw4=$rs4->fetch_assoc();
	$ccre=$rw4[0];
	
	$sq5="select SUM(rec) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs5=$cx->query($sq5);
	$rw5=$rs5->fetch_assoc();
	$rec=$rw5[0];
	
	$sq6="select SUM(gir) AS TOTAL from z_central_ing WHERE tip ='D' and cod LIKE '$cod%' and hom !='' and hom !='V' and hom !='S' and hom != 'T' and hom !='E'";
	$rs6=$cx->query($sq6);
	$rw6=$rs6->fetch_assoc();
	$gir=$rw5[0];
	
	
	//****
	
	
	printf("
	<span class='Estilo4'>
	<tr>
	
	<td align='left' class='text'>%s</td>
	<td align='left'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	
	
	
	</tr>", $cod, $nom, number_format($def,2,'.',','), number_format($adi,2,'.',','), number_format($red,2,'.',','),number_format($cre,2,'.',','),number_format($ccre,2,'.',','),   number_format($rec,2,'.',','), number_format($gir,2,'.',','), $rw["tip"], $rw["niv"]); 
	
	
	   
}
	printf("</table></center>");
	

	

	
//--------	
?>
<br />
</body>
</html>
<?php
}
?>