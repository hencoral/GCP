<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$id = $_REQUEST['cod']; 
include('../../config.php');
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
// Obtengo el nombre del rubro y el valor inicial constituido como cuenta por pagar
	$sql = "select * from ceva where id_auto_ceva='$id'";
	$res = $cx->query($sql);
	while ($row = $res->fetch_assoc())
	{	
		$fecha=$row[fecha_ceva];	
	}
	
	echo $fecha;
$cx = null;
?>
