<?php 
session_start();
set_time_limit(3600);
include('../config.php');
					// verifico permisos del usuario
		$cx = mysql_connect("$server","$dbuser","$dbpass")or die ("Conexion no Exitosa");
		mysql_select_db("$database"); 
       	$sql="SELECT teso FROM usuarios2 where login = '$_SESSION[login]'";
		$res=mysql_db_query($database,$sql,$cx);
		$rw =mysql_fetch_array($res);
if ($rw['teso']=='SI')
{


header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=RELACION_PAGOS_DETALLE.xls");
header("Pragma: no-cache");
header("Expires: 0");
set_time_limit(1200);

$cx=mysql_connect($server,$dbuser,$dbpass);
// consulta para determinar las estampillas utilizadas y crear la tabla
$res = mysql_db_query($database,"select * from estampillas",$cx);
$fila =mysql_num_rows($res);
$j=0;
$cont =0;
while ($row = mysql_fetch_array($res))
{
	for ($j=1;$j<6;$j++)
	{
		$sq1 =mysql_db_query($database,"select * from ceva where estampilla$j = '$row[concepto]'",$cx);
		$fil = mysql_num_rows($sq1);
		if ($fil >0)
		{
			$estampillas[$cont] = $row["concepto"];
			$cont++;
			break;
		}
	}
}
$fil_e =count($estampillas);
mysql_free_result($res);
// **********************************************************************
// consulta para determinar las retenciones utilizadas
$cont=0;
$res = mysql_db_query($database,"select * from retefuente",$cx);
while ($row = mysql_fetch_array($res))
{
		$sq1 =mysql_db_query($database,"select * from ceva where retefuente = '$row[concepto]'",$cx);
		$fil = mysql_num_rows($sq1);
		if ($fil >0)
		{
			$retefuente[$cont] = $row["concepto"];
			$cont++;
	    }
}
$fil_r =count($retefuente);
mysql_free_result($res);
// ************************************************************************
?> 
<table border="1" width="90%">
  <tr>
  <td colspan="6" align="center" bgcolor="#D0F5A9">DATOS GENERALES</td>
  <td colspan="11" align="center" bgcolor="#F6E3CE">DESCUENTOS</td>
  <td colspan="<?php echo $fil_r; ?>"  align="center" bgcolor="#CECEF6">RETENCIONES</td>
  <td colspan="<?php echo $fil_e; ?>" align="center" bgcolor="#F8E0E0">ESTAMPILLAS</td>
  <td></td>
  </tr>
  <tr>
  	<td>FECHA </td>
	<td>COMPRTOBANTE</td>
	<td>TERCERO</td>
	<td>CC/NIT</td>
	<td>CONCEPTO</td>
	<td>VALOR</td>
	<td>SALUD</td>
	<td>PENSION</td>
	<td>LIBRANZAS</td>
	<td>FONDO SOLIDARIDAD</td>
	<td>FONDO EMPLEADOS</td>
	<td>SINDICATO</td>
	<td>EMBARGOS</td>
	<td>CRUCE DE CUENTAS</td>
	<td>OTROS</td>
	<td>RETEIVA</td>
	<td>RETEICA</td>
	
	<?php 
	  $k=0;
	  for ($k=0;$k<$fil_r;$k++)
	  {
	  	echo "<td>$retefuente[$k]</td>";
	  }
	  $n=0;
	  for ($n=0;$n<$fil_e;$n++)
	  {
	  	echo "<td>$estampillas[$n]</td>";
	  }
	?>
	<td>NETO PAGADO</td>
  </tr>
	<?php 
		$sq2 =mysql_db_query($database,"select * from ceva order by fecha_ceva asc",$cx);
		while ($rw2 =mysql_fetch_array($sq2))
		{
	    	$valor_pagado = $rw2["salud"] + $rw2["pension"] + $rw2["libranza"] + $rw2["f_solidaridad"] + 
			$rw2["f_empleados"] + $rw2["sindicato"] + $rw2["cruce"] + $rw2["embargo"] + $rw2["otros"] + 
			$rw2["vr_retefuente"] + $rw2["vr_reteiva"] + $rw2["vr_reteica"] + $rw2["vr_estampilla1"] + 
			$rw2["vr_estampilla2"] + $rw2["vr_estampilla3"] +	$rw2["vr_estampilla4"] + $rw2["vr_estampilla5"] +
			$rw2["total_pagado"];

			echo "<tr>";
			echo "<td>$rw2[fecha_ceva]</td>";
			echo "<td>$rw2[id_manu_ceva]</td>";
			echo "<td>$rw2[tercero]</td>";
			echo "<td>$rw2[ccnit]</td>";
			echo "<td>$rw2[des_ceva]</td>";
			echo "<td align='right'>$valor_pagado</td>";
			echo "<td align='right'>$rw2[salud]</td>";
			echo "<td align='right'>$rw2[pension]</td>";
			echo "<td align='right'>$rw2[libranza]</td>";
			echo "<td align='right'>$rw2[f_solidaridad]</td>";
			echo "<td align='right'>$rw2[f_empleados]</td>";
			echo "<td align='right'>$rw2[sindicato]</td>";
			echo "<td align='right'>$rw2[embargo]</td>";
			echo "<td align='right'>$rw2[cruce]</td>";
			echo "<td align='right'>$rw2[otros]</td>";
			echo "<td align='right'>$rw2[vr_reteiva]</td>";
			echo "<td align='right'>$rw2[vr_reteica]</td>";
		
			$n=0;
			for ($n=0;$n<$fil_r;$n++)
			{
				$m=$n+1;
				$sq3 =mysql_db_query($database,"select * from ceva where retefuente ='$retefuente[$n]' 
				and id_auto_ceva ='$rw2[id_auto_ceva]'",$cx);
				$rw3 =mysql_fetch_array($sq3);
				$valor = $rw3["vr_retefuente"];
				if (!$valor) $valor=0; 
				echo "<td align='right' width='10%'>$valor</td>";
			}
			$valor=0;
			$n=0;
			for ($n=0;$n<$fil_e;$n++)
			{
				$m=$n+1;
				$sq3 =mysql_db_query($database,"select * from ceva where estampilla$m ='$estampillas[$n]' and id_auto_ceva ='$rw2[id_auto_ceva]'",$cx);
				$rw3 =mysql_fetch_array($sq3);
				$valor = $rw3["vr_estampilla".$m];
				$consulta = "select * from ceva where estampilla$m ='$estampillas[$n]' and id_auto_ceva ='$rw2[id_auto_ceva]'";
				if (!$valor) $valor=0; 
				echo "<td align='right'>$valor</td>";
			}
			$valor=0;
			echo "<td align='right'>$rw2[total_pagado]</td>";
		//*********consultar 1110 ********
		
			/*$n=1;
			for ($n=1;$n<16;$n++)
			{
				if ($n=1) $cta="cta_cheque";
				else $cta = "cta_cheque".$n;
				$sq4 = "select * from ceva where cta_cheque='$cta' and id_auto_ceva ='$rw2[id_auto_ceva]'";
				$res4=mysql_db_query($database,$sq4,$cx);
				while ($row = mysql_fetch_array($res4))
				{
					$cuenta=$row[$cta];
				}
			}*/
			$n=1;
			for($n=1;$n<16;$n++)
			{
			
				$cuenta2='';
				
				if ($n==1) $m='';
				else $m=$n;
				$sq4 = "select * from ceva where cta_cheque$m!='' and id_auto_ceva ='$rw2[id_auto_ceva]'";
				$res4=mysql_db_query($database,$sq4,$cx);
				while ($row = mysql_fetch_array($res4))
				{
						$cuenta=$row["pgcp".$n];
						$subcadena=substr($cuenta,0,4);
						if($subcadena=="1110")
						{
							$cuenta2=$cuenta;
							$n=16;
							break;
						}
				}
				
			}
			echo "<td align='right'>$cuenta2</td>"; 
			echo "</tr>";
	      //$cx = null;
		
		
		//********************************
		
		
		
		}
	$cx = null;
	}else{ // si no tiene persisos de usuario
	echo "<br><br><center>Usuario no tiene permisos en este m&oacute;dulo</center><br>";
	echo "<center>Click <a href=\"../user.php\">aqu&iacute; para volver</a></center>";
		
}
	?>
</table>


