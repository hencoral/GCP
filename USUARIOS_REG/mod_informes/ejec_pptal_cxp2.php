<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) 
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_CXP.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
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

	if(isset($_POST['fecha_ini']))	$fecha_ini=$_POST['fecha_ini'];  else $fecha_ini ='';
	if(isset($_POST['fecha_fin']))	$fecha_fin=$_POST['fecha_fin'];  else $fecha_fin ='';
	if(isset($_POST['mov_mes'])) $tipo = $_POST['mov_mes']; else $tipo = "";
	if(isset($_POST['fecha_per'])) $fecha_per = $_POST['fecha_per']; else $fecha_per = "";
	if(isset($_POST['mov_periodo'])) $mov_periodo = $_POST['mov_periodo']; else $mov_periodo = "";

$anno = substr($ano,0,4);	
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
	<td align="center" colspan="9"></td>
</tr>
<tr>
	<td align="center" colspan="9"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="9"><font size="4"><b>EJECUCION PRESUPUESTAL DE CUENTAS X PAGAR</b></font></td>
</tr>
<tr>
    <td align="center" colspan="9"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="9"></td>
</tr>
<tr>
	<td align="left" colspan="10"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
</tr>
</table>
<p><br />
  <?php
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo4'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
    </p>
    <p>
      <?php
    //-------
    $sq = "select * from cxp where id_emp = '$id_emp' order by cod_pptal asc";
    $re = $cx->query($sq);
    
	// Si el usuario marco mostrar movimiento del mes
	if ($tipo ==1)
    {

    printf("
    <center>
    
    <table width='1300' BORDER='1' class='bordepunteado1'>
    <tr bgcolor='#DCE9E5'>
    <td align='center' width='150'>
    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
    <span class='Estilo4'><b>Cod. Pptal</b></span>
    </div>
    </td>
    <td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Adiciones mes</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Cancelaciones mes</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Cancelaciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Pagos mes</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Pagos </b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Saldo x Pagar</b></span></td>
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

	
	while($rw = $re->fetch_array())
	   {
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from cxp WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
	$rowx=$resultax->fetch_array();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_cxp WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_array();
	$total_adi=$row[0]; 
	
	$resulta1=$cx->query("select SUM(valor_adi) AS TOTAL from cancelaciones_cxp WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row1=$resulta1->fetch_array();
	$total_can=$row1[0]; 
	
	$definitivo = $inicial + $total_adi - $total_can;
	
	$resulta2=$cx->query("select SUM(valor) AS TOTAL from cecp_cuenta WHERE (fecha_cecp between '$fecha_ini' and '$fecha_fin' ) and cuenta LIKE '$cod%'");
	$row2=$resulta2->fetch_array();
	$total_cecp=$row2[0];
	
	$saldo_x_pagar = $definitivo - $total_cecp;
	
	// calculo mes 
	
	$resulta3=$cx->query("select SUM(valor_adi) AS TOTAL from adi_cxp WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row3=$resulta3->fetch_array();
	$total_adi_mes=$row3[0]; 

	$resulta4=$cx->query("select SUM(valor_adi) AS TOTAL from cancelaciones_cxp WHERE (fecha_adi between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row4=$resulta4->fetch_array();
	$total_can_mes=$row4[0]; 
	
	$resulta5=$cx->query("select SUM(valor) AS TOTAL from cecp_cuenta WHERE (fecha_cecp between '$mes_ini' and '$fecha_fin' ) and cuenta LIKE '$cod%'");
	$row5=$resulta5->fetch_array();
	$total_cecp_mes=$row5[0];


	
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'>%s</td>
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
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	</tr>", $cod, $nom_rubro,number_format($inicial,2,'.',','),number_format($total_adi_mes,2,'.',','),number_format($total_adi,2,'.',','),number_format($total_can_mes,2,'.',','),number_format($total_can,2,'.',','),number_format($definitivo,2,'.',','),number_format($total_cecp_mes,2,'.',','),number_format($total_cecp,2,'.',','),number_format($saldo_x_pagar,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	   }
	printf("</table></center>");
	
	
	}else{ // fin informe por mes 
	
    printf("
    <center>
    
    <table width='1300' BORDER='1' class='bordepunteado1'>
    <tr bgcolor='#DCE9E5'>
    <td align='center' width='150'>
    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
    <span class='Estilo4'><b>Cod. Pptal</b></span>
    </div>
    </td>
    <td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Vr. Inicial</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Cancelaciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Saldo x Pagar</b></span></td>
    <td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
    <td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
	");
	
	while($rw = $re->fetch_array())
	   {
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from cxp WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
	$rowx=$resultax->fetch_array();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_cxp WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_array();
	$total_adi=$row[0]; 
	
	$resulta1=$cx->query("select SUM(valor_adi) AS TOTAL from cancelaciones_cxp WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row1=$resulta1->fetch_array();
	$total_can=$row1[0]; 
	
	$definitivo = $inicial + $total_adi - $total_can;
	
	$resulta2=$cx->query("select SUM(valor) AS TOTAL from cecp_cuenta WHERE (fecha_cecp between '$fecha_ini' and '$fecha_fin' ) and cuenta LIKE '$cod%'");
	$row2=$resulta2->fetch_array();
	$total_cecp=$row2[0];
	
	$saldo_x_pagar = $definitivo - $total_cecp;
	
	printf("
	<span class='Estilo4'>
	<tr>
	
	<td align='left' class='text'>%s</td>
	<td align='left'><span class='Estilo4'>&nbsp; %s </span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	</tr>", $cod, $nom_rubro,number_format($inicial,2,'.',','),number_format($total_adi,2,'.',','),number_format($total_can,2,'.',','),number_format($definitivo,2,'.',','),number_format($total_cecp,2,'.',','),number_format($saldo_x_pagar,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	   }
	printf("</table></center>");
	
	} // fin informe noramal
//--------	
}else{
	
?>
<table width="800" border="0" align="center">
<tr>
  <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
	<td align="center" colspan="9"></td>
</tr>
<tr>
	<td align="center" colspan="9"><font size="4"><b><?php echo $empresa; ?></b></font></td>
</tr>
<tr>
    <td align="center" colspan="9"><font size="4"><b>EJECUCION PRESUPUESTAL DE CUENTAS X PAGAR - PERIODO</b></font></td>
</tr>
<tr>
    <td align="center" colspan="9"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
</tr>
<tr>
	<td align="center" colspan="9"></td>
</tr>
<tr>
	<td align="left" colspan="10"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
</tr>
</table>
<p><br />
  <?php
	printf("
	<div style='padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;'>
	<center class ='Estilo4'>Usted ha seleccionado como <b>Fecha Inicial</b> : %s y como <b>Fecha Final</b> : %s</center>
	</div>
	",$fecha_ini,$fecha_fin);
	?>
    </p>
    <p>
      <?php
    //-------
    $sq = "select * from cxp where id_emp = '$id_emp' order by cod_pptal asc";
    $re = $cx->query($sq);
    
	// Si el usuario marco mostrar movimiento del mes
    printf("
    <center>
    
    <table width='1300' BORDER='1' class='bordepunteado1'>
    <tr bgcolor='#DCE9E5'>
    <td align='center' width='150'>
    <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
    <span class='Estilo4'><b>Cod. Pptal</b></span>
    </div>
    </td>
    <td align='center' width='300'><span class='Estilo4'><b>Nombre Rubro</b></span></td>
	<td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Adiciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Cancelaciones</b></span></td>
    <td align='center' width='150'><span class='Estilo4'><b>Pagos </b></span></td>
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

	
	while($rw = $re->fetch_array())
	   {
	
	
	//****
	
	$cod=$rw["cod_pptal"];
	$nom_rubro=$rw["nom_rubro"];
	//****
	
	//****
	
	$resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from cxp WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
	$rowx=$resultax->fetch_assoc();
	$inicial=$rowx[0];
	//****
	
	$resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_cxp WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row=$resulta->fetch_assoc();
	$total_adi=$row[0]; 
	
	$resulta1=$cx->query("select SUM(valor_adi) AS TOTAL from cancelaciones_cxp WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
	$row1=$resulta1->fetch_assoc();
	$total_can=$row1[0]; 
	
	$definitivo = $inicial + $total_adi - $total_can;
	
	$resulta2=$cx->query("select SUM(valor) AS TOTAL from cecp_cuenta WHERE (fecha_cecp between '$fecha_per' and '$fecha_fin' ) and cuenta LIKE '$cod%'");
	$row2=$resulta2->fetch_assoc();
	$total_cecp=$row2[0];
	
	$saldo_x_pagar = $definitivo - $total_cecp;
	

	
	printf("
	<span class='Estilo4'>
	<tr>
	<td align='left' class='text'>%s</td>
	<td align='left' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='right'><span class='Estilo4'>%s</span></td>
	<td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	<td align='center'><span class='Estilo4'>%s</span></td>
	<td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
	</tr>", $cod, $nom_rubro,number_format($definitivo,2,'.',','),number_format($total_adi,2,'.',','),number_format($total_can,2,'.',','),number_format($total_cecp,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
	   }
	printf("</table></center>");
}
?>
  <br />
</p>
</body>
</html>
<?php
}
?>