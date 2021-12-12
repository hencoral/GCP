<?php
  if(isset($_POST["val"])){
    $conten=$_POST["val"];
    include('../config.php');
    global $server, $database, $dbpass, $dbuser, $charset;
    // Conexion con la base de datos
    $cx = new mysqli($server, $dbuser, $dbpass, $database);
    $sqlxx = "select id_emp from fecha";
    $resultadoxx = $cx->query($sqlxx);
    $id_emp  = $resultadoxx->fetch_assoc();
    $id_emp =$id_emp['id_emp'];
    $usuario_consulta = $cx->query("Select nom_rubro from pgcp where cod_pptal = '$conten' and id_emp ='$id_emp' and tip_dato = 'D'") or die(mysqli_error($cx));
    
    $ntuplas = $usuario_consulta->num_rows;
    if($ntuplas > 0){
      $xcodme =$usuario_consulta->fetch_assoc();
      $codme = $xcodme['nom_rubro'];
      echo $codme;
    }
    else{echo $ntuplas;}
    $cx->close();
  }
?>

