<?php 
 
function busca_terceros($doc) {
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
$rs2=$cx->query("select num_id,nombre from z_terceros where num_id ='$doc'");
$rw2=$rs2->fetch_assoc();
$fi2=$rs2->num_rows;
if ($fi2 >0)
{
	$datos = $rw2['num_id'].",".$rw2['nombre'];
	return $datos;	
}
//mysql_close($cx2);
}
?> 
