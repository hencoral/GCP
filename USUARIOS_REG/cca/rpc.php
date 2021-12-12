<?php
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);
while($rowxx = $resultadoxx->fetch_assoc()) 
{
  $id_emp=$rowxx["id_emp"];
}
    if(isset($_POST['queryString']))
    {
        $queryString =$_POST['queryString'];
        $id = $_POST['qid'];
            if(strlen($queryString) > 0) {
            $query = $cx->query("Select * from pgcp where cod_pptal like '".$queryString."%' and id_emp ='$id_emp';");
                if($query) {
                        while($row2 = $query->fetch_assoc()) 
                        {$r1=$row2["cod_pptal"];
                         $r2=$row2["nom_rubro"];
                        echo "<li value='$r1 $r2' id='$r1/$r2' onClick='fill(this,$id);'>$r1 $r2</li>";
                     }
                } else {
                    echo "ERROR: Existe un problema con la conexi&oacute;n.";
                }
            } else {

            }
        } else {
            echo 'No hay acceso directo a este script!';
        }
        $cx->close();
?>