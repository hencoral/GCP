<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header('Content-Type: text/html; charset=latin1');
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

$q = $_GET["q"];
if (!$q) return;
$sql = "select cod_pptal as cod_pptal, nom_rubro  as nom_rubro from car_ppto_gas where cod_pptal LIKE '$q%' order by cod_pptal asc";
$rsd = $cx->query($sql);
$fil = $rsd->num_rows;
while($rs = $rsd->fetch_array()) {
	$cid = $rs['cod_pptal'];
	$cname = $rs['cod_pptal'] ." - ". $rs['nom_rubro'];
	echo "$cname|$cid\n";
}
if ($fil==0){
	$cid = '';
	$cname = 'Sin resultados...';
	echo "$cname|$cid\n";
}
?>
