<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
include('../config.php');

global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

$cod = $_REQUEST['cod'];
$sq2="select cdpp from cdpp where consecutivo ='$cod'";
$re2=$cx->query($sq2);
$rw2=$re2->fetch_array();
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);
while($rowxx = $resultadoxx->fetch_array())
{
  $id_emp=$rowxx["id_emp"];
}
$servidor = $server;
$usuario = $dbuser;
$password = $dbpass;

$usuarios = $cx->query("Select * from cdpp where id_emp ='$id_emp' and cdpp = '$cod'");

$num = $usuarios->num_rows;

if ($num==0 || $cod == $rw2['cdpp'])
{
printf(1);
}
else
{
printf("<font color ='#FF0000'>COD. YA UTILIZADO</font>");
}
$cx->close();
}
?>

