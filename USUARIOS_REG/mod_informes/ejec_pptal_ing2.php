<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) 
{
header("Location: ../login.php");
exit;
} else {

header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_DE_INGRESOS cc.xls");
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
	if(isset($_POST['mov_mes'])) $tipo = $_POST['mov_mes']; else $tipo = '';
	$fecha_per = $_POST['fecha_per'];
	if(isset($_POST['mov_periodo'])) $mov_periodo = $_POST['mov_periodo']; else $mov_periodo = "";
	if(isset($_POST['central'])) $central = $_POST['central']; else $central = "";
	$anno = substr($ano,0,4);
	if($central ==1) $sia = "and cod_sia != 'E' and cod_sia != 'S' and cod_sia != 'T' and cod_sia != 'v'"; 	
// Para cargar la url e incluir imagenes al archivo que se genera
//echo "http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/imagen.gif";          
//***** Consulto la base para llenar la tabla 
$ruta_img = "http://$_SERVER[HTTP_HOST]/USUARIOS_REG/images/PLANTILLA PNG PARA LOGO EMPRESA.png";
if($mov_periodo =='')
{

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
    <td align="center" colspan="11"><font size="4"><b>EJECUCION PRESUPUESTAL DE INGRESOS </b></font></td>
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
$sia='';
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo4'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
//-------
$sq = "select * from car_ppto_ing where id_emp = '$id_emp' $sia order by cod_pptal asc ";
$re = $cx->query($sq);
// ******************************************************* con recaudos del mes **********************************************************************************
if ($tipo ==1) 
{
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
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Reducciones del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Creditos del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
		<td align='center' width='150'><span class='Estilo4'><b>Contracreditos del mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos Mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos Mes</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Cobrar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	
	");
	
	$mes = explode("/",$fecha_fin);
	
	if ($mes[1]=="01") {$mes_ini = "$anno/01/01"; $mes_fin ="$anno/01/31";}
	if ($mes[1]=="02") {$mes_ini = "$anno/02/01"; $mes_fin ="$anno/02/29";}
	if ($mes[1]=="03") {$mes_ini = "$anno/03/01"; $mes_fin ="$anno/03/31";}
	if ($mes[1]=="04") {$mes_ini = "$anno/04/01"; $mes_fin ="$anno/04/30";}
	if ($mes[1]=="05") {$mes_ini = "$anno/05/01"; $mes_fin ="$anno/05/31";}
	if ($mes[1]=="06") {$mes_ini = "$anno/06/01"; $mes_fin ="$anno/06/30";}
	if ($mes[1]=="07") {$mes_ini = "$anno/07/01"; $mes_fin ="$anno/07/31";}
	if ($mes[1]=="08") {$mes_ini = "$anno/08/01"; $mes_fin ="$anno/08/31";}
	if ($mes[1]=="09") {$mes_ini = "$anno/09/01"; $mes_fin ="$anno/09/30";}
	if ($mes[1]=="10") {$mes_ini = "$anno/10/01"; $mes_fin ="$anno/10/31";}
	if ($mes[1]=="11") {$mes_ini = "$anno/11/01"; $mes_fin ="$anno/11/30";}
	if ($mes[1]=="12") {$mes_ini = "$anno/12/01"; $mes_fin ="$anno/12/31";}

	while($rw = $re->fetch_array())
	   {
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$cod_sia= $rw["cod_sia"];
	
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE ano <= '$fecha_fin'  and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%' ");
	$rowx=$resultax->fetch_array();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_array();
	$total_adi=$row[0]; 
	
	
	$resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row2=$resulta2->fetch_array();
	$total_red=$row2[0];
	
	$resulta9=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row9=$resulta9->fetch_array();
	$total_cotracred=$row9[0];
	
	$resulta8=$cx->query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row8=$resulta8->fetch_array();
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
	
	$resulta3=$cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE fecha_reg <=  '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row3=$resulta3->fetch_array();
	$total_reip=$row3[0];
	
	$resulta4=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row4=$resulta4->fetch_array();
	$total_ncbt=$row4[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_array();
	$total_rcgt=$row5[0];
	
    $resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	echo "select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'";
	$row8=$resulta8->fetch_array();
	$total_riip=$row8[0];	
	
if ($empresa =='MUNICIPIO DE IPIALES')
{
	
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=$resulta8->fetch_array();
	$total_riur=$row8[0];
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=$resulta8->fetch_array();
	$total_rtic=$row8[0];
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=	$resulta8->fetch_array();
	$total_rica=$row8[0];


	$resulta81=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row81=	$resulta81->fetch_array();
	$total_rica1=$row81[0];


$resulta82=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row82=	$resulta82->fetch_array();
	$total_rica2=$row82[0];
}


	$resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row6=	$resulta6->fetch_array();
	$total_tnat=$row6[0];
	
	$resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
	$row7=	$resulta7->fetch_array();
	$total_roit=$row7[0];
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat +$total_riip+$total_riur+$total_rtic+$total_rica+$total_rica1+$total_rica2;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	// Consultas VALORES CAUSADOS EN EL MES ***********************************************************************************************************
	
	$resulta10=$cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$mes_ini' and '$fecha_fin') and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row10=$resulta10->fetch_array();
	$total_reip_mes=$row10[0];
	
	$resulta11=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE fecha_recaudo  <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row11=$resulta11->fetch_array();
	$total_ncbt_mes=$row11[0];
	
	$resulta12=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row12=$resulta12->fetch_array();
	$total_rcgt_mes=$row12[0];
	
	$resulta13=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row13=$resulta13->fetch_array();
	$total_tnat_mes=$row13[0];
	
	$resulta14=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
	$row14=$resulta14->fetch_array();
	$total_roit_mes=$row14[0];
	
	 $resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=$resulta15->fetch_array();
	$total_riip_mes=$row15[0];
if ($empresa =='MUNICIPIO DE IPIALES')
{

	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=	$resulta15->fetch_array();
	$total_riur_mes=$row15[0];
	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=	$resulta15->fetch_array();
	$total_rtic_mes=$row15[0];
	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=	$resulta15->fetch_array();
	$total_rica_mes=$row15[0];
	
	$resulta151=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row151=	$resulta151->fetch_array();
	$total_rica_mes1=$row151[0];
	
	$resulta152=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row152=	$resulta152->fetch_array();
	$total_rica_mes2=$row152[0];
}
	$sq153 ="select SUM(valor_adi) AS totalam from adi_ppto_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'";
	$resulta153=$cx->query($sq153);
	$row153=$resulta153->fetch_array();
	$total_adi_mes=$row153[0];
	
	$resulta154=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row154=$resulta154->fetch_array();
	$total_red_mes=$row154[0];
	
	$resulta155=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row155=$resulta155->fetch_array();
	$total_ccr_mes=$row155[0];
	
	$resulta156=$cx->query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row156=$resulta156->fetch_array();
	$total_cre_mes=$row156[0];

	
	$recaudos_mes = $total_roit_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes + $total_riip_mes+ $total_riur_mes+ $total_rtic_mes+ $total_rica_mes+$total_rica_mes1+ $total_rica_mes2;
	
	$reconocimientos_mes = $recaudos_mes + $total_reip_mes - $total_roit_mes ;
	
	printf("
	<span class='Estilo4'>
	<tr>
	
	<td align='left' class='text'>%s </td>  
	<td align='left'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	
	
	</tr>", $cod , $nom_rubro, number_format($inicial,2,'.',','),  number_format($total_adi_mes,2,'.',',') ,number_format($total_adi,2,'.',','),  number_format($total_red_mes,2,'.',','),number_format($total_red,2,'.',','),number_format($total_cre_mes,2,'.',','),number_format($total_cred,2,'.',','),number_format($total_ccr_mes,2,'.',','),number_format($total_cotracred,2,'.',','), number_format($definitivo,2,'.',','),  number_format($reconocimientos_mes,2,'.',','), number_format($reconocimientos,2,'.',','), number_format($recaudos_mes,2,'.',','),number_format($recaudos,2,'.',','), number_format($saldo_x_ejec,2,'.',','), number_format($cxc,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   $reconocimientos_mes=0;
	   }
	printf("</table></center>");
	
}else{
	
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
	<td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reducciones</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Creditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Contracreditos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Reconocimientos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Recaudos</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Cuentas x Cobrar</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
	<td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	while($rw = $re->fetch_assoc()) 
	   {
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE ano <= '$fecha_fin'  and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
	$rowx=$resultadoxx->fetch_assoc();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_assoc();
	$total_adi=$row[0]; 
	
	$resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row2=$resulta2->fetch_assoc();
	$total_red=$row2[0];
	
	$resulta9=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row9=$resulta9->fetch_assoc();
	$total_cotracred=$row9[0];
	
	$resulta8=$cx->query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE fecha_adi <= '$fecha_fin' and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row8=$resulta8->fetch_assoc();
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
	
	$resulta3=$cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE fecha_reg <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row3=$resulta3->fetch_assoc();
	$total_reip=$row3[0];
	
	$resulta4=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt where fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row4=$resulta4->fetch_assoc();
	$total_ncbt=$row4[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_rcgt=$row5[0];
	
	$resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE fecha_recaudo <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row6=$resulta6->fetch_assoc();
	$total_tnat=$row6[0];
	
	$resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE fecha_recaudo <= '$fecha_fin' and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
	$row7=$resulta7->fetch_assoc();
	$total_roit=$row7[0];
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=$resulta8->fetch_assoc();
	$total_riip=$row8[0];
	
if ($empresa =='MUNICIPIO DE IPIALES')
{
	
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=$resulta8->fetch_assoc();
	$total_riur=$row8[0];
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=	$resulta8->fetch_assoc();
	$total_rtic=$row8[0];
	
	$resulta8=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row8=	$resulta8->fetch_assoc();
	$total_rica=$row8[0];

	$resulta81=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row81=	$resulta81->fetch_assoc();
	$total_rica1=$row81[0];

	$resulta82=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row82=	$resulta82->fetch_assoc();
	$total_rica2=$row82[0];
}
	
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat + $total_riip+ $total_riur+ $total_rtic+ $total_rica+ $total_rica1+ $total_rica2;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur+ $total_rtic+ $total_rica+ $total_rica1+ $total_rica2;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	
	
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'>%s</td>
	<td align='left'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	</tr>", $cod, $nom_rubro, number_format($inicial,2,'.',','), number_format($total_adi,2,'.',','), number_format($total_red,2,'.',','),number_format($total_cred,2,'.',','),number_format($total_cotracred,2,'.',','), number_format($definitivo,2,'.',','), number_format($reconocimientos,2,'.',','), number_format($recaudos,2,'.',','), number_format($saldo_x_ejec,2,'.',','), number_format($cxc,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   }
	   
	printf("</table></center>");

}

}else{
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
	$mes = explode("/",$fecha_fin);
	
	if ($mes[1]=="01") {$mes_ini = "$anno/01/01"; $mes_fin ="$anno/01/31";}
	if ($mes[1]=="02") {$mes_ini = "$anno/02/01"; $mes_fin ="$anno/02/29";}
	if ($mes[1]=="03") {$mes_ini = "$anno/03/01"; $mes_fin ="$anno/03/31";}
	if ($mes[1]=="04") {$mes_ini = "$anno/04/01"; $mes_fin ="$anno/04/30";}
	if ($mes[1]=="05") {$mes_ini = "$anno/05/01"; $mes_fin ="$anno/05/31";}
	if ($mes[1]=="06") {$mes_ini = "$anno/06/01"; $mes_fin ="$anno/06/30";}
	if ($mes[1]=="07") {$mes_ini = "$anno/07/01"; $mes_fin ="$anno/07/31";}
	if ($mes[1]=="08") {$mes_ini = "$anno/08/01"; $mes_fin ="$anno/08/31";}
	if ($mes[1]=="09") {$mes_ini = "$anno/09/01"; $mes_fin ="$anno/09/30";}
	if ($mes[1]=="10") {$mes_ini = "$anno/10/01"; $mes_fin ="$anno/10/31";}
	if ($mes[1]=="11") {$mes_ini = "$anno/11/01"; $mes_fin ="$anno/11/30";}
	if ($mes[1]=="12") {$mes_ini = "$anno/12/01"; $mes_fin ="$anno/12/31";}
$sq = "select * from car_ppto_ing where id_emp = '$id_emp' order by cod_pptal asc ";
$re =$cx->query($sq);
while($rw = $re->fetch_array())
{
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_ing WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
	$rowx=$resultax->fetch_assoc();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_assoc();
	$total_adi=$row[0]; 
	
	$resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row2=$resulta2->fetch_assoc();
	$total_red=$row2[0];
	
	$resulta9=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row9=$resulta9->fetch_assoc();
	$total_cotracred=$row9[0];
	
	$resulta8=$cx->query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row8=$resulta8->fetch_assoc();
	$total_cred=$row8[0];
	
	$definitivo = $inicial + $total_adi - $total_red + $total_cred - $total_cotracred;
	
		$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_assoc();
	$total_adi_p=$row[0]; 
	
	$resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row2=$resulta2->fetch_assoc();
	$total_red_p=$row2[0];
	
	$resulta9=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row9=$resulta9->fetch_assoc();
	$total_cotracred_p=$row9[0];
	
	$resulta8=$cx->query("select SUM(valor_adi) AS TOTAL from creditos_ing WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row8=$resulta8->fetch_assoc();
	$total_cred=$row8[0];

	$resulta3=$cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row3=$resulta3->fetch_assoc();
	$total_reip=$row3[0];
	
	$resulta4=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row4=$resulta4->fetch_assoc();
	$total_ncbt=$row4[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_rcgt=$row5[0];
if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_riip=$row5[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_riur=$row5[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_rtic=$row5[0];
	
	$resulta5=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_assoc();
	$total_rica=$row5[0];


$resulta51=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row51=$resulta51->fetch_assoc();
	$total_rica1=$row51[0];


$resulta52=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row52=$resulta52->fetch_assoc();
	$total_rica2=$row52[0];
}
	
	$resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row6=$resulta6->fetch_assoc();
	$total_tnat=$row6[0];
	
	$resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
	$row7=$resulta7->fetch_assoc();
	$total_roit=$row7[0];
	
	$reconocimientos = $total_reip + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur + $total_rtic + $total_rica + $total_rica1+ $total_rica2 ;
	$recaudos = $total_roit + $total_ncbt + $total_rcgt + $total_tnat + $total_riip + $total_riur + $total_rtic + $total_rica + $total_rica1+ $total_rica2 ;
	$saldo_x_ejec = $definitivo - $reconocimientos;
	$cxc = $reconocimientos - $recaudos;
	
	// Consultas reconocimientos mes
	
	$resulta10=$cx->query("select SUM(valor) AS TOTAL from reip_ing WHERE (fecha_reg between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row10=$resulta10->fetch_assoc();
	$total_reip_mes=$row10[0];
	
	$resulta11=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_ncbt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row11=$resulta11->fetch_assoc();
	$total_ncbt_mes=$row11[0];
	
	$resulta12=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rcgt WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row12=$resulta12->fetch_assoc();
	$total_rcgt_mes=$row12[0];
	
	$resulta13=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_tnat WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row13=$resulta13->fetch_assoc();
	$total_tnat_mes=$row13[0];
	
	$resulta14=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_roit WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
	$row14=$resulta14->fetch_assoc();
	$total_roit_mes=$row14[0];

if ($empresa =='MUNICIPIO DE IPIALES')
{
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riip WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=$resulta15->fetch_assoc();
	$total_riip_mes=$row15[0];
	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_riur WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=$resulta15->fetch_assoc();
	$total_riur_mes=$row15[0];
	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rtic WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=$resulta15->fetch_assoc();
	$total_rtic_mes=$row15[0];
	
	$resulta15=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row15=$resulta15->fetch_assoc();
	$total_rica_mes=$row15[0];


$resulta151=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica1 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row151=$resulta151->fetch_assoc();
	$total_rica_mes1=$row151[0];


$resulta152=$cx->query("select SUM(vr_digitado) AS TOTAL from recaudo_rica2 WHERE (fecha_recaudo between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
	$row152=	$resulta152->fetch_assoc();
	$total_rica_mes2=$row152[0];
}

	$reconocimientos_mes = $total_reip_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes + $total_riip_mes +$total_riur_mes +$total_rtic_mes +$total_rica_mes +$total_rica_mes1 +$total_rica_mes2 ;
	$recaudos_mes = $total_roit_mes + $total_ncbt_mes + $total_rcgt_mes + $total_tnat_mes +$total_riip_mes +$total_riur_mes +$total_rtic_mes +$total_rica_mes +$total_rica_mes1 +$total_rica_mes2 ;
	
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
	
	
	
	</tr>", $cod, $nom_rubro, number_format($definitivo,2,'.',','), number_format($total_adi_p,2,'.',','), number_format($total_red_p,2,'.',','),number_format($total_cred_p,2,'.',','),number_format($total_cotracred_p,2,'.',','),   number_format($reconocimientos,2,'.',','), number_format($recaudos,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	
	
	   
}
	printf("</table></center>");
	

	
}
	
//--------	
?>
<br />
</body>
</html>
<?php
}
?>