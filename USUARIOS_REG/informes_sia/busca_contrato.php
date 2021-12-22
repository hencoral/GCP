<?php
set_time_limit(1800);
session_start();
?>
<html>
<head>
<title>CONTAFACIL ...::: Informe por terceros  :::...</title>

<script language="">
//function cursor(){document.login.login.focus();}
// -->
</script>
<script type="text/javascript" src="../jquery.js"></script>
<script type="text/javascript"> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}
function  cargaArchivo(archivo,valor,div)
	{
		archivo = archivo + '?doc='+valor;
		//alert(archivo);
		$("#"+div).load(archivo);	
	}
</script>

<style type="text/css">
<!--
.Estilo1 {font-family: Verdana, Arial, Helvetica, sans-serif}
.Estilo2 {font-size: 9px}
.Estilo4 {color: #666666}
.Estilo5 {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #000000;
	font-size: 12px;
	font-weight: bold;
}
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; font-weight: bold; }
a:link {
	text-decoration: none;
	color: #0000FF;
}
a:visited {
	text-decoration: none;
	color: #0000FF;
}
a:hover {
	text-decoration: underline;
	color: #0000FF;
}
a:active {
	text-decoration: none;
	color: #0000FF;
}
.Estilo8 {
	font-size: 12px;
	font-family: Verdana;
}
.Estilo11 {color: #CC0000}
a {
	font-family: Verdana;
	font-size: 9px;
}
.Estilo12 {font-size: 10px}
-->
 @media print {
    .oculto {display:none}
  }
</style>
<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></head>
<?php				// verifico permisos del usuario
		include('../config.php');
		global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

       	$sql="SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
		$res=$cx->query($sql);
		$rw = $res->fetch_array();
if ($rw['teso']=='SI')
{
if(isset($_POST['cheque']))	$num = $_POST['cheque']; else $num='';
?>
<body >

<table width="600" border="1" align="center" class="bordepunteado1">
  <tr>
    <td colspan="3"><div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100"></div></td>
  </tr>
  <tr>
    <td colspan="3">
	<div id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:3px;">
	  <div align="center" class="Estilo5">Generar historial SIA - OBSERVA<BR>
	   <br>
	  </div>
	  <div align="center" class="Estilo8 "></div>
	</div>
	</td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:15px; padding-right:3px; padding-bottom:5px;">
	  <div align="center">
	    
		
<table border="0" cellspacing="0" cellpadding="2">
  <form action="busca_contrato.php" method="POST" class="miform" name="tercero">
    <tr>
      <td>
	  <div id="main_div" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
	    <div align="right"><span class="Estilo5">No Contrato:</span> </div>
	  </div>	  </td>
      <td>
        <input type="text" name="cheque" id="cheque" onKeyPress="return validar(event)" value="<?php echo $num; ?>">     </td>
    </tr>
    
    <tr>
      <td colspan="2">
        <div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:3px;">
            <center><input type="submit" value="Consultar" class="boton"></center>
          </div></td>
    </tr>
  </form>
  </table>
  <br>
  <br> 
  <br>
  <br> 
  <?php
  
  
  $sq1 = "select * from crpp where n_contrato = '$num'";
  $re1 = $cx->query($sq1);
  $rw1 = $re1->fetch_array();
  $ccnit='';
  if($rw1['ter_nat'] !='')
  {
  $sqn ="select num_id from terceros_naturales where id ='$rw1[ter_nat]'";
  $ren = $cx->query($sqn);
  $rwn = $ren->fetch_array();
  $ccnit = $rwn['num_id'];
  }
  
  if($rw1['ter_jur'] !='')
  {
  $sqj ="select num_id2 from terceros_juridicos where id ='$rw1[ter_jur]'";
  $rej = $cx->query($sqj);
  $rwj = $rej->fetch_array();
  $ccnit = $rwj['num_id2'];
  }
  $sq8 = "select nom_rubro from car_ppto_gas  where cod_pptal ='$rw1[cuenta]'";
  $re8 = $cx->query($sq8);
  $rw8 = $re8->fetch_array();
  ?>
  <div id="ejecuta"></div>
  <div id="enca" class="oculto">
   <table border="1" cellspacing="0" cellpadding="2"  width="90%">
 		<tr class='Estilo8'>
        	 <td align="left" width="30%">Tercero:</td>
             <td align="left" width="70%"><?php echo $rw1['tercero'];  ?></td>
        </tr>
        <tr class='Estilo8'>
        	 <td align="left" width="30%">CC/Nit:</td>
             <td align="left" width="70%"><?php echo $ccnit;  ?></td>
        </tr>
        <tr class='Estilo8'>
        	 <td align="left" width="30%">No Contrato:</td>
             <td align="left" width="70%"><?php echo $num;  ?></td>
        </tr>
      	<tr class='Estilo8'>
        	 <td align="left">Objeto:</td>
             <td align="left"><?php echo $rw1['detalle_crpp'];  ?></td>
        </tr>
        <tr class='Estilo8'>
        	 <td align="left">Rubro:</td>
             <td align="left"><?php echo $rw1['cuenta']. ' - ' . $rw8['nom_rubro'] ;  ?></td>
        </tr>

   </table>
  <br>
  <br>
  </div>
  
  <table border="1" cellspacing="0" cellpadding="2"  width="90%">
  <tr class='Estilo7'>
  	<td width="30%" align="center">Fecha</td>
    <td width="30%" align="center">No Documento</td>
    <td width="30%" align="center">Valor</td>
    <td width="5%" align="center">Imprimir</td>
    <td width="5%" align="center">Control</td>
  </tr>
<?php
	$total =0;
	$bases =0;
	if ($num != '')
	{
	$sq2= "select sum(vr_digitado) as valor,fecha_crpp,id_manu_crpp,id_auto_cdpp,id_auto_crpp,id from crpp where n_contrato ='$num' group by n_contrato";
	$rs2 = $cx->query($sq2);
	while ($rw2 = $rs2->fetch_array())
		{
			// Buscar el valor del pago sin iva
			$sq3 = "select sum(valor) as valcdp,fecha_reg,cdpp,consecutivo from cdpp where consecutivo ='$rw2[id_auto_cdpp]' group by consecutivo";
			$rs3 = $cx->query($sq3);
			$rw3 = $rs3->fetch_array();
			
			$sq7 = "select estado from si_observa where doc ='$rw3[cdpp]' ";
			$re7 = $cx->query($sq7);
			$rw7 = $re7->fetch_array();
			
			$val_cdp =number_format($rw3['valcdp'],0,'.',',');
			if (!$rw7['estado']) $estado1 =''; else $estado1='checked';
			echo "  <tr class='Estilo8'>
						<td>$rw3[fecha_reg]</td>
						<td align='left'>CDPP$rw3[cdpp]</td>
						<td align='right'>$val_cdp</td>
						<td align='center'> <a href=\"../mvto_ppto_gas/imp_cdppsia.php?id2=$rw3[consecutivo]\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</a></td>
					<td align='center'><input type='checkbox' name='dispon' id='$rw3[cdpp]' $estado1 onclick=cargaArchivo('cambia_estado.php',id,'ejecuta');></td>	
					</tr>	
			";	
			$sq6 = "select estado from si_observa where doc ='$rw2[id_manu_crpp]' ";
			$re6 = $cx->query($sq6);
			$rw6 = $re6->fetch_array();
			$val_crp =number_format($rw2['valor'],0,'.',',');
			if (!$rw6['estado']) $estado2 =''; else $estado2='checked';
			echo "  <tr class='Estilo8'>
						<td>$rw2[fecha_crpp]</td>
						<td align='left'>$rw2[id_manu_crpp]</td>
						<td align='right'>$val_crp</td>
						<td align='center'><a href=\"../mvto_ppto_gas/imp_crppsia.php?id2=$rw2[id_auto_crpp]\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</a></td>
				<td align='center'><input type='checkbox' name='comprom' id='$rw2[id_manu_crpp]' $estado2 onclick=cargaArchivo('cambia_estado.php',id,'ejecuta');></td>	
					</tr>	
			";	
			// Buscar el valor del pago sin iva
			$sq4 = "select fecha_ceva,id_manu_ceva, (iva+salud + pension + libranza + f_solidaridad + f_empleados + sindicato + embargo + cruce + otros+ vr_retefuente+ vr_reteiva+ vr_retecree  +  vr_reteica + vr_estampilla1 + vr_estampilla2 + vr_estampilla3 + vr_estampilla4 + vr_estampilla5 + total_pagado) as valor,id_auto_ceva from ceva where id_auto_crpp = '$rw2[id_auto_crpp]'";
			$rs4 = $cx->query($sq4);
			while ($rw4 =$rs4->fetch_assoc())
			{	
				$sq5 = "select estado from si_observa where doc ='$rw4[id_manu_ceva]' ";
				$re5 = $cx->query($sq5);
				$rw5 = $re5->fetch_array();
				if (!$rw5['estado']) $estado3 =''; else $estado3='checked';
			$val_ce =number_format($rw4['valor'],0,'.',',');
			echo "  <tr class='Estilo8'>
						<td>$rw4[fecha_ceva]</td>
						<td align='left'>$rw4[id_manu_ceva]</td>
						<td align='right'>$val_ce </td>
						<td align='center'><a href=\"../pagos_tesoreria/imp_ceva.php?id1=$rw4[id_auto_ceva]\" target=\"_blank\" title='Imprimir'>
<img src='../simbolos/fuentes/imprimir.png' width='20' height='20' border='0' title='Imprimir'></a>
</a></td>
					<td align='center'><input type='checkbox' name='concia' id='$rw4[id_manu_ceva]' $estado3 onclick=cargaArchivo('cambia_estado.php',id,'ejecuta');></td>	
					</tr>	
			";	
			$estado3 =0;
			}
			$estado2 =0;
			$estado1 =0;
		}
	}

?>

  </table>	
  
		<BR>
  <a href="../user.php" class="Estilo12">VOLVER</a>	    </div>
	</div>	</td>
  </tr>
  
</table>

<input type="checkbox" 
<!-- --------------------------------------------- -->


</body>
</html>
<?php
}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}?>