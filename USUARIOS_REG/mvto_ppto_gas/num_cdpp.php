<?php
session_start();
if(!isset($_SESSION["login"]))
{
header("Location: ../login.php");
exit;
} else {
?>
<html>
<head>
<title>CONTAFACIL</title>
</head>
<body>
<table width='50%' BORDER='1' class='bordepunteado1'>
<tr bgcolor='#DCE9E5'>
     <td width='50%'>Fecha</td>
    <td width='50%'>Numero</td>
</tr>

<?php
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

		$sql2 = "select min(id) from cdpp";
		$res = $cx->query($sql2);
		$row = $res->fetch_array();
		$min_id = $row['min(id)'];
		// consulto el numero del primer cdpp
		$sq2 ="select fecha_reg,cdpp from cdpp where id = '$min_id' group by consecutivo";
		$rs2 = $cx->query($sq2);
		$rw2 = $rs2->fetch_array();
		// Consulto el total de cdpp que existen en la base de datos
		$sq3 = "select * from cdpp ";
		$rs3 = $cx->query($sq3);
		$fil = $rs3->num_rows;
		// Recorro la tabla cdpp para ver que consecutivos no he utilizado
		$i =1;
		for($i=1;$i<=$fil;$i++)
		{
			$consec=$rw2['cdpp'] + $i;
			$sq4 = "select cdpp,fecha_reg from cdpp where cdpp='$consec'";
			$rs4 = $cx->query($sq4);
			$fi4 = $rs4->num_rows;
			$rw4 = $rs4->fetch_array();
			if ($fi4 ==1) echo "<tr>
    								 <td width='50%'>$rw4[fecha_reg]</td>
    								<td width='50%'>$rw4[cdpp]</td>
								</tr>";

			if ($fi4 ==0) echo "<tr bgcolor='#339966'>
    								 <td width='50%'>&nbsp;</td>
    								<td width='50%'>$consec</td>
								</tr>";
		}
?>
</table>
<?php
}
?>