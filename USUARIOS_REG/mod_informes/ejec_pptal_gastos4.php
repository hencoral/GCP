<?php
set_time_limit(1200);
session_start();
if (!isset($_SESSION["login"])) 
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=EJECUCION_GASTOS_DISPONIBILIDAD.xls");
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
    if(isset($_POST['mov_mes'])) $tipo = $_POST['mov_mes']; else $tipo = "";
	$fecha_per = $_POST['fecha_per'];
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
        <td align="center" colspan="15"></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b><?php echo $empresa; ?></b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b>EJECUCION PRESUPUESTAL DE GASTOS CON DISPONIBILIDAD</b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"></td>
    </tr>
    <tr>
        <td align="left" colspan="16"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
    </tr>
    </table>
    <br />
    <?php
    //-------
    $sq = "select * from car_ppto_gas where id_emp = '$id_emp' order by cod_pptal asc ";
    $re = $cx->query($sq);
// CON REPORTE DEL MES  ******************************************************************************************************************************************* 
    if ($tipo ==1)
        {
        printf("
        <center>
        
        <table width='2550' BORDER='1' class='bordepunteado1'>
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
        <td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Compromisos Mes</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Compromisos</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Aplazamientos</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Obligaciones Mes</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Obligaciones</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Pagos Mes</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Reservas</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Cuentas x Pagar</b></span></td>
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
    
        while($rw = $re->fetch_assoc())
           {
        
        
        //****
        
        $cod=$rw["cod_pptal"];
        //****
        
        $resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_gas WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
        $rowx=$resultax->fetch_assoc();
        $inicial=$rowx[0]; 
        //****
        
        
        $resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total_adi=$row[0]; 
        
        $resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row2=$resulta2->fetch_assoc();
        $total_red=$row2[0];
        
        $resulta3=$cx->query("select SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row3=$resulta3->fetch_assoc();
        $total_cre=$row3[0];
        
        $resulta4=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row4=$resulta4->fetch_assoc();
        $total_ccre=$row4[0];
        
        $definitivo = $inicial + $total_adi - $total_red + $total_cre - $total_ccre;
        
        
            
        $resulta5=$cx->query("select SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row5=$resulta5->fetch_assoc();
        $total_cdpp=$row5[0];
        
        
        
        $resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row6=$resulta6->fetch_assoc();
        $total_crpp=$row6[0];
        
        $resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row7=$resulta7->fetch_assoc();
        $total_cobp=$row7[0];
        
        
        $resulta=$cx->query("select SUM(valor_aplazado) AS TOTAL from aplazamientos WHERE (fecha_adi between '$fecha_ini' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total5=$row[0]; 
        $total_apla = $total5;
        
        
          
        
        $sqlceva = $cx->query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_ini' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI'");
        $row8=$sqlceva->fetch_assoc();
        $total_ceva1=$row8[0];
		
		$sq3 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_ini' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI' ";
		$rs3 = $cx->query($sq3);
		$rw3 = $rs3->fetch_assoc();
		$total_ceva_acum = $rw3['total2'];
		
		$total_ceva = $total_ceva1 + $total_ceva_acum;
        
        $saldo_sin_afec = $definitivo - $total_cdpp - $total_apla;
        //$saldo_x_ejec = $definitivo - $total_crpp;
        $reservas = $total_cdpp - $total_cobp;
        $cxp = $total_cobp - $total_ceva;
        
        // Calculos gastos del mes
    
        $resulta10=$cx->query("select SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and valor <> '0'");
        $row10=$resulta10->fetch_assoc();
        $total_cdpp_mes=$row10[0];
        
        $resulta11=$cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp between '$mes_ini' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%' and vr_digitado <> '0'");
        $row11= $resulta11->fetch_assoc();
        $total_cobp_mes=$row11[0];
       
	    
       	$sqlcevam = $cx->query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$mes_ini' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI' ");
		$row12=$sqlcevam->fetch_assoc();
		$total_ceva_mes1=$row12[0];
		
		$sq4 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$mes_ini' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> 0 AND cobp.pagado ='SI' ";
		$rs4 = $cx->query($sq4);
		$rw4 = $rs4->fetch_assoc();
		$total_ceva_acum_mes = $rw4['total2'];
		
		$total_ceva_mes = $total_ceva_mes1 + $total_ceva_acum_mes;

    
        printf("
        <span class='Estilo4'>
        <tr>
        
        <td align='left' class='text'>%s</td>
        <td align='left'><span class='Estilo4'>%s</span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s </span></td>
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
        
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        
        <td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='center'><span class='Estilo4'>%s</span></td>
        
        
        </tr>", $rw["cod_pptal"], $rw["nom_rubro"], number_format($inicial,2,'.',','), number_format($total_adi,2,'.',','), number_format($total_red,2,'.',','), number_format($total_cre,2,'.',','), number_format($total_ccre,2,'.',','), number_format($definitivo,2,'.',','), number_format($total_cdpp_mes,2,'.',','), number_format($total_cdpp,2,'.',','), number_format($total_apla,2,'.',','),  number_format($total_cobp_mes,2,'.',','),  number_format($total_cobp,2,'.',','),  number_format($total_ceva_mes,2,'.',','),number_format($total_ceva,2,'.',','), number_format($saldo_sin_afec,2,'.',','), number_format($reservas,2,'.',','), number_format($cxp,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
        
        
           }
        
        printf("</table></center>");
		
// NORMAL ****************************************************************************************************************************************************************

    }else{
        printf("
        <center>
        
        <table width='2550' BORDER='1' class='bordepunteado1'>
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
        <td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Definitivo</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Compromisos</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Aplazamientos</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Obligaciones</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Saldo x Ejec</b></span></td>
        
        <td align='center' width='150'><span class='Estilo4'><b>Reservas</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Cuentas x Pagar</b></span></td>
        <td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
        <td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
        
        
        
        
        ");
        
        while($rw = $re->fetch_assoc())
           {
        
        
        //****
        
        $cod=$rw["cod_pptal"];
        //****
        
        //****
        
        $resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_gas WHERE ano <= '$fecha_fin' and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
        $rowx=$resultax->fetch_assoc();
        $inicial=$rowx[0]; 
        //****
        
        
        $resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total_adi=$row[0]; 
        
        $resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row2=  $resulta2->fetch_assoc();
        $total_red=$row2[0];
        
        $resulta3=$cx->query("select SUM(valor_adi) AS TOTAL from creditos WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row3=  $resulta3->fetch_assoc();
        $total_cre=$row3[0];
        
        $resulta4=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE fecha_adi <= '$fecha_fin'  and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row4=  $resulta4->fetch_assoc();
        $total_ccre=$row4[0];
        
        $definitivo = $inicial + $total_adi - $total_red + $total_cre - $total_ccre;
        
        
            
        $resulta5=$cx->query("select SUM(valor) AS TOTAL from cdpp WHERE fecha_reg <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row5=  $resulta5->fetch_assoc();
        $total_cdpp=$row5[0];
        
        
        
        $resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE fecha_crpp <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row6=  $resulta6->fetch_assoc();
        $total_crpp=$row6[0];
        
        $resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE fecha_cobp <= '$fecha_fin'  and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row7=  $resulta7->fetch_assoc();
        $total_cobp=$row7[0];
        
        
        $resulta=$cx->query("select SUM(valor_aplazado) AS TOTAL from aplazamientos WHERE fecha_adi <= '$fecha_fin'  and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total5=$row[0]; 
        $total_apla = $total5;
        
         $sqlceva = $cx->query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE ceva.fecha_ceva <= '$fecha_fin'  AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI'");
        $row8=  $sqlceva->fetch_assoc();
        $total_ceva1=$row8[0];
		
		$sq3 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where ceva.fecha_ceva <= '$fecha_fin'  AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI' ";
		$rs3 = $cx->query($sq3);
		$rw3 = $rs3->fetch_assoc();
		$total_ceva_acum = $rw3['total2'];
		
		$total_ceva = $total_ceva1 + $total_ceva_acum;
        
        $saldo_sin_afec = $definitivo - $total_cdpp - $total_apla;
        //$saldo_x_ejec = $definitivo - $total_crpp;
        $reservas = $total_cdpp - $total_cobp;
        $cxp = $total_cobp - $total_ceva;
        
              
        printf("
        <span class='Estilo4'>
        <tr>
        
        <td align='left' class='text'>%s</td>
        <td align='left'><span class='Estilo4'> %s </span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s </span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        
        <td align='right'><span class='Estilo4'>%s</span></td>
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        
        <td align='right' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='right'><span class='Estilo4'>%s</span></td>
        
        <td align='center' bgcolor='#F5F5F5'><span class='Estilo4'>%s</span></td>
        <td align='center'><span class='Estilo4'>%s</span></td>
        
        
        </tr>", $rw["cod_pptal"], $rw["nom_rubro"], number_format($inicial,2,'.',','), number_format($total_adi,2,'.',','), number_format($total_red,2,'.',','), number_format($total_cre,2,'.',','), number_format($total_ccre,2,'.',','), number_format($definitivo,2,'.',','), number_format($total_cdpp,2,'.',','), number_format($total_apla,2,'.',','), number_format($total_cobp,2,'.',','), number_format($total_ceva,2,'.',','), number_format($saldo_sin_afec,2,'.',','), number_format($reservas,2,'.',','), number_format($cxp,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
        
        
           }
        
        printf("</table></center>");
    }
// POR PERIODO	***********************************************************************************************************************************************************
}else{
	
?>
 <table width="800" border="0" align="center">
    <tr>
      <td rowspan="5" align="center"><img src='<?php echo $ruta_img; ?>' /></td>
        <td align="center" colspan="15"></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b><?php echo $empresa; ?></b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b>EJECUCION PRESUPUESTAL DE GASTOS CON DISPONIBILIDAD X PERIODO</b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"><font size="4"><b>VIGENCIA <?php echo $anno; ?></b></font></td>
    </tr>
    <tr>
        <td align="center" colspan="15"></td>
    </tr>
    <tr>
        <td align="left" colspan="16"><b>FECHA DE CORTE :</b><?php echo $fecha_fin; ?></td>
    </tr>
    </table>
    <br />
    <?php
    //-------
    $sq = "select * from car_ppto_gas where id_emp = '$id_emp' order by cod_pptal asc ";
    $re = $cx->query($sq);
    
        printf("
        <center>
        
        <table width='2550' BORDER='1' class='bordepunteado1'>
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
        <td align='center' width='150'><span class='Estilo4'><b>ContraCreditos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Compromisos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Aplazamientos</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Obligaciones</b></span></td>
        <td align='center' width='150'><span class='Estilo4'><b>Pagos</b></span></td>
        <td align='center' width='75'><span class='Estilo4'><b>Tipo</b></span></td>
        <td align='center' width='75'><span class='Estilo4'><b>Nivel</b></span></td>
        ");
        
        while($rw = $re->fetch_array()){
           
        
        
        //****
        
        $cod=$rw["cod_pptal"];
        //****
        
        //****
        
        $resultax=$cx->query("select SUM(ppto_aprob) AS TOTAL from car_ppto_gas WHERE (ano between '$fecha_ini' and '$fecha_fin' ) and id_emp='$id_emp' and tip_dato ='D' and cod_pptal LIKE '$cod%'");
        $rowx=$resultax->fetch_assoc();
        $inicial=$rowx[0]; 
        //****
        
        
        $resulta=$cx->query("select SUM(valor_adi) AS TOTAL from adi_ppto_gas WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total_adi=$row[0]; 
        
        $resulta2=$cx->query("select SUM(valor_adi) AS TOTAL from red_ppto_gas WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row2=$resulta2->fetch_assoc();
        $total_red=$row2[0];
        
        $resulta3=$cx->query("select SUM(valor_adi) AS TOTAL from creditos WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row3=$resulta3->fetch_assoc();
        $total_cre=$row3[0];
        
        $resulta4=$cx->query("select SUM(valor_adi) AS TOTAL from contracreditos WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cod_pptal LIKE '$cod%'");
        $row4=$resulta4->fetch_assoc();
        $total_ccre=$row4[0];
        
        $definitivo = $inicial + $total_adi - $total_red + $total_cre - $total_ccre;
        
        
            
        $resulta5=$cx->query("select SUM(valor) AS TOTAL from cdpp WHERE (fecha_reg between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row5=$resulta5->fetch_assoc();
        $total_cdpp=$row5[0];
        
        
        
        $resulta6=$cx->query("select SUM(vr_digitado) AS TOTAL from crpp WHERE (fecha_crpp between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row6=  $resulta6->fetch_assoc();
        $total_crpp=$row6[0];
        
        $resulta7=$cx->query("select SUM(vr_digitado) AS TOTAL from cobp WHERE (fecha_cobp between '$fecha_per' and '$fecha_fin' ) and id_emp='$id_emp' and cuenta LIKE '$cod%'");
        $row7=  $resulta7->fetch_assoc();
        $total_cobp=$row7[0];
        
        
        $resulta=$cx->query("select SUM(valor_aplazado) AS TOTAL from aplazamientos WHERE (fecha_adi between '$fecha_per' and '$fecha_fin' ) and cod_pptal LIKE '$cod%'");
        $row=$resulta->fetch_assoc();
        $total5=$row[0]; 
        $total_apla = $total5;
        
         $sqlceva = $cx->query("SELECT SUM(vr_digitado) AS TOTAL FROM cobp INNER JOIN ceva ON cobp.id_auto_cobp = ceva.id_auto_cobp WHERE (ceva.fecha_ceva between '$fecha_per' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI'");
        $row8=  $sqlceva->fetch_assoc();
        $total_ceva1=$row8[0];
		
		$sq3 = "select sum(vr_digitado) as total2 from cobp INNER JOIN ceva ON cobp.ceva =ceva.id_auto_ceva where (ceva.fecha_ceva between '$fecha_per' AND '$fecha_fin' ) AND cobp.cuenta LIKE '$cod%' AND ceva.id_emp ='$id_emp' AND cobp.vr_digitado <> '0' AND cobp.pagado ='SI' ";
		$rs3 = $cx->query($sq3);
		$rw3 = $rs3->fetch_assoc();
		$total_ceva_acum = $rw3['total2'];
		
		$total_ceva = $total_ceva1 + $total_ceva_acum;
        
        $saldo_sin_afec = $definitivo - $total_cdpp - $total_apla;
        //$saldo_x_ejec = $definitivo - $total_crpp;
        $reservas = $total_cdpp - $total_cobp;
        $cxp = $total_cobp - $total_ceva;
        
              
        printf("
        <span class='Estilo4'>
        <tr>
        <td align='left' bgcolor='#F5F5F5'>%s</td>
		<td align='left' class='text'>%s</td>
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
        </tr>", $rw["cod_pptal"], $rw["nom_rubro"], number_format($definitivo,2,'.',','), number_format($total_adi,2,'.',','), number_format($total_red,2,'.',','), number_format($total_cre,2,'.',','), number_format($total_ccre,2,'.',','),  number_format($total_cdpp,2,'.',','), number_format($total_apla,2,'.',','), number_format($total_cobp,2,'.',','), number_format($total_ceva,2,'.',','), $rw["tip_dato"], $rw["nivel"]); 
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