<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod'];
$tipo = $_REQUEST['tipo'];
$ica = $_REQUEST['ica']; 
$c = $ica{0};
//$valor=$_REQUEST['valor'];
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo la cuenta y el nombre del rubro    	
		$sql = "select cuenta_press from cca_ica where campo='$id' and (tipo ='$tipo' or tipo ='') and (ica ='$c' or ica ='0')";
		$res = mysql_db_query($database, $sql, $cx);
		//$numf=mysql_num_rows($res);
		while ($row = mysql_fetch_array($res))
		{			
		     $cuenta=$row["cuenta_press"];	
			 $sq2 = "select nom_rubro from car_ppto_ing where cod_pptal='$cuenta'";
			 $res2 = mysql_db_query($database, $sq2, $cx);
			 while ($row2 = mysql_fetch_array($res2))
			 {
				 $rubro=$row2["nom_rubro"];
			 }
			 
		}		
	echo $cuenta.','.$rubro;
	//echo $sql;
	
$cx = null;
?>
