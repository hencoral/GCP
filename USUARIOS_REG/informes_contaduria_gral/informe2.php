<?php
set_time_limit(600);
session_start();
if(isset($_SESSION['user']))
{
header("Location: ../login.php");
exit;
} else {
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=CATALOGO_CUENTAS_DETALLE.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<style>
.text
  {
 mso-number-format:"\@"
  }
.date
	{
	mso-number-format:"yyyy\/mm\/dd"	
	}
.numero
	{
	mso-number-format:"#,##0.00"	
	}
</style>
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
	
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
</head>
<body>
<table width="800" border="0" align="center">
  <tr>
    
    <td width="798" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <!--img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /-->	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center">
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <!--div align="center"><a href='a.php' target='_parent'>VOLVER </a> </div-->
          </div>
        </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong>CATALOGO DE CUENTAS A NIVEL DE DETALLE (MILES DE PESOS) </strong></div>
	   <div align="center" class="Estilo4"><strong>Las celdas marcadas con color presentan errores</strong></div>
    </div></td>
  </tr>
</table>
<div align="center">
<?php 
include('../config.php');		
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
// ide emp
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);
while($rowxx = $resultadoxx->fetch_array())

{
  $id_emp=$rowxx["id_emp"];
}
// corte
$sqlxx = "select corte from aux_corte_cgn";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_array())

{
  $corte=$rowxx["corte"];
}
// fecha ini op
$sqlxx1 = "select * from vf";
$resultadoxx1 = $cx->query($sqlxx1);

while($rowxx1 = $resultadoxx1->fetch_array())

{
  $fecha_ini_op=$rowxx1["fecha_ini"];
}




//**** borro tabla por si las moscas

$tabla6="aux_contaduria_gral_may";
$anadir6="truncate TABLE ";
$anadir6.=$tabla6;
$anadir6.=" ";



///**** creo la tabla

$tabla7="aux_contaduria_gral_may";
$anadir7="CREATE TABLE ";
$anadir7.=$tabla7;
$anadir7.="
(
`d` varchar(200) NOT NULL default '',
`nivel` varchar(200) NOT NULL default '',
`cuenta` varchar(200) NOT NULL default '',
`nombre` varchar(200) NOT NULL default '',
`inicial` decimal(20,2) NOT NULL default '0.00',
`debito` decimal(20,2) NOT NULL default '0.00',
`credito` decimal(20,2) NOT NULL default '0.00',
`saldo` decimal(20,2) NOT NULL default '0.00',
`corriente` decimal(20,2) NOT NULL default '0.00',
`no_corriente` decimal(20,2) NOT NULL default '0.00'

)TYPE=MyISAM COLLATE=latin1_general_ci";
$cx->query($anadir7);

//encabezado tabla
printf("
<center>
<table width='1360' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
<td align='center' width='30'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;'>
<span class='Estilo4'></span>
</div>
</td>
<td align='center' width='30'><span class='Estilo4'><b>NIVEL</b></span></td>
<td align='center' width='100'><span class='Estilo4'><b>CUENTA</b></span></td>
<td align='center' width='300'><span class='Estilo4'><b>NOMBRE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>INICIAL</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>DEBITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CREDITO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>SALDO</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>CORRIENTE</b></span></td>
<td align='center' width='150'><span class='Estilo4'><b>NO CORRIENTE</b></span></td>
</tr>

");



$sqlxx2 = "select aux_contaduria_gral.cuenta,aux_contaduria_gral.debito, aux_contaduria_gral.credito, inicial from aux_contaduria_gral where (aux_contaduria_gral.fecha <= '$corte') group by aux_contaduria_gral.cuenta order by aux_contaduria_gral.cuenta asc";
$resultadoxx2 = $cx->query($sqlxx2);

while($rowxx2 =  $resultadoxx2->fetch_array())
{
		  
			   printf("<span class='Estilo4'><tr>");
			   printf("<td align='center'><span class='Estilo4'> D </span></td>");
			  
			  $cuenta_aux=$rowxx2["cuenta"];
			  
			  $sd=round(($rowxx2["debito"]),0);
			  $sc=round(($rowxx2["credito"]),0);
			  
			  $inicial_aux=round(($rowxx2["inicial"]),0);
		  
//********************************* NIVEL		  

$sql = "select * from pgcp where cod_pptal = '$cuenta_aux'";
$result = $cx->query($sql);
if ($result->num_rows == 0)
{
//NIVEL
 printf("<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'> error </span></td>");
}
else
{
$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta_aux'";
$resultadoxx2a = $cx->query($sqlxx2a);

while($rowxx2a = $resultadoxx2a->fetch_array())

{
  $nivel=$rowxx2a["nivel"];
}

 //NIVEL
 printf("<td align='center'><span class='Estilo4'> %s </span></td>",$nivel);
}

//*************************** CUENTA	

//CUENTA
 printf("<td align='left' class='text'>%s</td>",$cuenta_aux);

//******************************** NOMBRE			  
$sql = "select * from pgcp where cod_pptal = '$cuenta_aux'";
$result = $cx->query($sql);
if ($result->num_rows == 0)
{
//NOMBRE
 printf("<td align='center' bgcolor ='#990000'><span class='Estilo4' style='color:#FFFF00'> error </span></td>");
}
else
{
$sqlxx2a = "select * from pgcp where cod_pptal = '$cuenta_aux'";
$resultadoxx2a = $cx->query($sqlxx2a);

while($rowxx2a =$resultadoxx2a->fetch_array())
{
  $nom_rubro_pgcp=$rowxx2a["nom_rubro"];
}

  //NOMBRE
 printf("<td align='left'><span class='Estilo4'> %s </span></td>",$nom_rubro_pgcp);
}
			  
//******************************* SICO		  
					  $saldo_sico = $inicial_aux;
					  //SICO
				       printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($inicial_aux,2,',','.'));
			//	}
//************************ DEBITO Y CREDITO ACUMULADO				
		  		//TOT DEBITO ACUMULADO
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($sd,2,',','.'));
				//TOT CREDITO ACUMULADO
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($sc,2,',','.'));
//****************************** CALCULO SALDOS

			/*LAS CUENTAS QUE INICIAN CON : 1,5,6,7 Y 8 SON DE SALDO DEBITO
			LAS CUENTAS QUE INICIAN CON : 2,3,4 Y 9 SON DE SALDO CREDITO*/
			//******* naturaleza de la cuenta
			$nat1 = substr($cuenta_aux,0,1);
			$nat2 = substr($cuenta_aux,0,2);
			if($nat1 != 0)
			{
				
				if($nat1 == '1' or $nat1 == '5' or $nat1 == '6' or $nat1 == '7' or $nat2 == '81' or $nat2 == '83' or $nat2 == '99')
				{	$naturaleza = "DEBITO";	}
				else
				{   if($nat1 == '2' or $nat1 == '3' or $nat1 == '4' or $nat2 == '91' or $nat2 == '92'  or $nat2 == '93' or $nat2 == '89')
					{
					$naturaleza = "CREDITO";
					}
				}
				
				
							
						if($naturaleza == 'DEBITO')
						{
						
						   $saldo=$saldo_sico + $sd - $sc;
						//SALDO
							 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
						}
						else
						{
						   $saldo=$saldo_sico - $sd + $sc;
						//SALDO
							 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
						}
			}
			else
			{
						$saldo=$saldo_sico + $sd - $sc;
						//SALDO
						printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
			}			
//********************************* CTE  - NO CTE		  
				
			$c_nc = substr($cuenta_aux,0,2);
			
if($c_nc == '11' or $c_nc == '12' or $c_nc == '13' or $c_nc == '14' or $c_nc == '15' or $c_nc == '21' or $c_nc == '22' or $c_nc == '23' or $c_nc == '24' or $c_nc == '25' or $c_nc == '27')
			
			{	
			$nat_c_nc = "C";	
			}
			  
		  if($c_nc == '16' or $c_nc == '17' or $c_nc == '18' or $c_nc == '19' or $c_nc == '26' or $c_nc == '28' or $c_nc == '29')
		  
			{
			$nat_c_nc = "NC";
			}
			
		   if($c_nc > '29')
		   
			{
			$nat_c_nc = "NC";
			}
				if($nat_c_nc == 'C')
				{
				$cte_aux=$saldo;
				//CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
				//NO CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> 0,00 </span></td>");
				}
				else
				{
				$n_cte_aux=$saldo;
				//CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> 0,00 </span></td>");
				//NO CORRIENTE
				 printf("<td align='right'><span class='Estilo4'> %s </span></td>",number_format($saldo,2,',','.'));
				}
$sql_ok = "INSERT INTO aux_contaduria_gral_may  
(d,nivel,cuenta,nombre,inicial,debito,credito,saldo,corriente,no_corriente) 
VALUES 
('$d','$nivel','$cuenta_aux','$nom_rubro_pgcp','$saldo_sico','$sd','$sc','$saldo','$cte_aux','$n_cte_aux')";
$cx->query($sql_ok);
				
				
				
				printf("</tr>"); 
		  		  
		  
} 

//-------
 printf("</table></center>");
//--------	
?>
</body>
</html>
<?php
}
?>