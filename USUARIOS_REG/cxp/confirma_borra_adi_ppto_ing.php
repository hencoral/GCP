<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>
	<?php
	include("../config.php");

	$id = $_POST['id'];

	// saco el id de la empresa
	$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from fecha";
	$resultadoxx = $connectionxx->query($sqlxx);
	while ($rowxx = $resultadoxx->fetch_assoc()) {
		$idxx = $rowxx["id_emp"];
	}

	// saco el valor a reducir y cod_pptal

	$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
	$sqlxx = "select * from adi_cxp where id ='$id' and id_emp ='$idxx'";
	$resultadoxx = $cx->query($sqlxx);
	while ($r = $resultadoxx->fetch_assoc()) {
		$h = $r["valor_adi"];
		$ingresa = $r["cod_pptal"];
	}

	//	printf("%s<br>%s<br>%s<br>",$idxx,$h,$ingresa);


	//resto el valor a todos sus padres
	$connection = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

	$longitud = strlen($ingresa);
	switch ($longitud) {
		case (0):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (1):

			break;
			//---------
		case (2):
			$tipo = 1;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 2;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0', $afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (3):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (4):
			$tipo = 2;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 3;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (5):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (6):
			$tipo = 4;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 4;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (7):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (8):
			$tipo = 6;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 5;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (9):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (10):
			$tipo = 8;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 6;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);


			break;
			//---------
		case (11):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (12):
			$tipo = 10;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 7;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (13):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (14):
			$tipo = 12;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 8;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (15):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (16):
			$tipo = 14;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 9;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (17):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (18):
			$tipo = 16;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 10;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (19):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (20):
			$tipo = 18;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 11;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (21):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (22):
			$tipo = 20;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 12;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 12
			$pk = substr($codigo, 0, 20);
			$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
			while ($rowpk = $consultapk->fetch_assoc()) {
				$vrpk = $rowpk["definitivo"];
			}
			$respk = $vrpk - $h;
			$sqlpk = "update cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
			$resultadopk = $connection->query($sqlpk);
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (23):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (24):
			$tipo = 22;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 13;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 13
			$pl = substr($codigo, 0, 22);
			$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
			while ($rowpl = $consultapl->fetch_assoc()) {
				$vrpl = $rowpl["definitivo"];
			}
			$respl = $vrpl - $h;
			$sqlpl = "update cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
			$resultadopl = $connection->query($sqlpl);
			// padre cuenta nivel 12
			$pk = substr($codigo, 0, 20);
			$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
			while ($rowpk = $consultapk->fetch_assoc()) {
				$vrpk = $rowpk["definitivo"];
			}
			$respk = $vrpk - $h;
			$sqlpk = "update cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
			$resultadopk = $connection->query($sqlpk);
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (25):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (26):
			$tipo = 24;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 14;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 14
			$pm = substr($codigo, 0, 24);
			$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
			while ($rowpm = $consultapm->fetch_assoc()) {
				$vrpm = $rowpm["definitivo"];
			}
			$respm = $vrpm - $h;
			$sqlpm = "update cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
			$resultadopm = $connection->query($sqlpm);
			// padre cuenta nivel 13
			$pl = substr($codigo, 0, 22);
			$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
			while ($rowpl = $consultapl->fetch_assoc()) {
				$vrpl = $rowpl["definitivo"];
			}
			$respl = $vrpl - $h;
			$sqlpl = "update cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
			$resultadopl = $connection->query($sqlpl);
			// padre cuenta nivel 12
			$pk = substr($codigo, 0, 20);
			$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
			while ($rowpk = $consultapk->fetch_assoc()) {
				$vrpk = $rowpk["definitivo"];
			}
			$respk = $vrpk - $h;
			$sqlpk = "update cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
			$resultadopk = $connection->query($sqlpk);
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (27):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (28):
			$tipo = 26;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 15;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 15
			$pn = substr($codigo, 0, 26);
			$consultapn = $connection->query("SELECT * from cxp where cod_pptal ='$pn' and id_emp ='$idxx'");
			while ($rowpn = $consultapn->fetch_assoc()) {
				$vrpn = $rowpn["definitivo"];
			}
			$respn = $vrpn - $h;
			$sqlpn = "update cxp set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
			$resultadopn = $connection->query($sqlpn);
			// padre cuenta nivel 14
			$pm = substr($codigo, 0, 24);
			$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
			while ($rowpm = $consultapm->fetch_assoc()) {
				$vrpm = $rowpm["definitivo"];
			}
			$respm = $vrpm - $h;
			$sqlpm = "update cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
			$resultadopm = $connection->query($sqlpm);
			// padre cuenta nivel 13
			$pl = substr($codigo, 0, 22);
			$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
			while ($rowpl = $consultapl->fetch_assoc()) {
				$vrpl = $rowpl["definitivo"];
			}
			$respl = $vrpl - $h;
			$sqlpl = "update cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
			$resultadopl = $connection->query($sqlpl);
			// padre cuenta nivel 12
			$pk = substr($codigo, 0, 20);
			$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
			while ($rowpk = $consultapk->fetch_assoc()) {
				$vrpk = $rowpk["definitivo"];
			}
			$respk = $vrpk - $h;
			$sqlpk = "update cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
			$resultadopk = $connection->query($sqlpk);
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------
		case (29):
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
			break;
			//---------
		case (30):
			$tipo = 28;
			$codigo = $ingresa;
			$padre = substr($codigo, 0, $tipo);
			$nivel = 16;
			//lo actualizo a el mismo
			$c = $connection->query("SELECT * from cxp where cod_pptal ='$codigo' and id_emp ='$idxx'");
			while ($r = $c->fetch_assoc()) {
				$vr = $r["definitivo"];
			}
			$re = $vr - $h;
			$sql = "update cxp set definitivo = '$re', afectado_otros = '0' where cod_pptal ='$codigo' and id_emp ='$idxx'";
			$res = $connection->query($sql);
			// actualizo el valor de todos los padres
			// padre cuenta nivel 16
			$po = substr($codigo, 0, 28);
			$consultapo = $connection->query("SELECT * from cxp where cod_pptal ='$po' and id_emp ='$idxx'");
			while ($rowpo = $consultapo->fetch_assoc()) {
				$vrpo = $rowpo["definitivo"];
			}
			$respo = $vrpo - $h;
			$sqlpo = "update cxp set definitivo = '$respo' where cod_pptal ='$po' and id_emp ='$idxx'";
			$resultadopo = $connection->query($sqlpo);
			// padre cuenta nivel 15
			$pn = substr($codigo, 0, 26);
			$consultapn = $connection->query("SELECT * from cxp where cod_pptal ='$pn' and id_emp ='$idxx'");
			while ($rowpn = $consultapn->fetch_assoc()) {
				$vrpn = $rowpn["definitivo"];
			}
			$respn = $vrpn - $h;
			$sqlpn = "update cxp set definitivo = '$respn' where cod_pptal ='$pn' and id_emp ='$idxx'";
			$resultadopn = $connection->query($sqlpn);
			// padre cuenta nivel 14
			$pm = substr($codigo, 0, 24);
			$consultapm = $connection->query("SELECT * from cxp where cod_pptal ='$pm' and id_emp ='$idxx'");
			while ($rowpm = $consultapm->fetch_assoc()) {
				$vrpm = $rowpm["definitivo"];
			}
			$respm = $vrpm - $h;
			$sqlpm = "update cxp set definitivo = '$respm' where cod_pptal ='$pm' and id_emp ='$idxx'";
			$resultadopm = $connection->query($sqlpm);
			// padre cuenta nivel 13
			$pl = substr($codigo, 0, 22);
			$consultapl = $connection->query("SELECT * from cxp where cod_pptal ='$pl' and id_emp ='$idxx'");
			while ($rowpl = $consultapl->fetch_assoc()) {
				$vrpl = $rowpl["definitivo"];
			}
			$respl = $vrpl - $h;
			$sqlpl = "update cxp set definitivo = '$respl' where cod_pptal ='$pl' and id_emp ='$idxx'";
			$resultadopl = $connection->query($sqlpl);
			// padre cuenta nivel 12
			$pk = substr($codigo, 0, 20);
			$consultapk = $connection->query("SELECT * from cxp where cod_pptal ='$pk' and id_emp ='$idxx'");
			while ($rowpk = $consultapk->fetch_assoc()) {
				$vrpk = $rowpk["definitivo"];
			}
			$respk = $vrpk - $h;
			$sqlpk = "update cxp set definitivo = '$respk' where cod_pptal ='$pk' and id_emp ='$idxx'";
			$resultadopk = $connection->query($sqlpk);
			// padre cuenta nivel 11
			$pj = substr($codigo, 0, 18);
			$consultapj = $connection->query("SELECT * from cxp where cod_pptal ='$pj' and id_emp ='$idxx'");
			while ($rowpj = $consultapj->fetch_assoc()) {
				$vrpj = $rowpj["definitivo"];
			}
			$respj = $vrpj - $h;
			$sqlpj = "update cxp set definitivo = '$respj' where cod_pptal ='$pj' and id_emp ='$idxx'";
			$resultadopj = $connection->query($sqlpj);
			// padre cuenta nivel 10
			$pi = substr($codigo, 0, 16);
			$consultapi = $connection->query("SELECT * from cxp where cod_pptal ='$pi' and id_emp ='$idxx'");
			while ($rowpi = $consultapi->fetch_assoc()) {
				$vrpi = $rowpi["definitivo"];
			}
			$respi = $vrpi - $h;
			$sqlpi = "update cxp set definitivo = '$respi' where cod_pptal ='$pi' and id_emp ='$idxx'";
			$resultadopi = $connection->query($sqlpi);
			// padre cuenta nivel 9
			$ph = substr($codigo, 0, 14);
			$consultaph = $connection->query("SELECT * from cxp where cod_pptal ='$ph' and id_emp ='$idxx'");
			while ($rowph = $consultaph->fetch_assoc()) {
				$vrph = $rowph["definitivo"];
			}
			$resph = $vrph - $h;
			$sqlph = "update cxp set definitivo = '$resph' where cod_pptal ='$ph' and id_emp ='$idxx'";
			$resultadoph = $connection->query($sqlph);
			// padre cuenta nivel 8
			$pg = substr($codigo, 0, 12);
			$consultapg = $connection->query("SELECT * from cxp where cod_pptal ='$pg' and id_emp ='$idxx'");
			while ($rowpg = $consultapg->fetch_assoc()) {
				$vrpg = $rowpg["definitivo"];
			}
			$respg = $vrpg - $h;
			$sqlpg = "update cxp set definitivo = '$respg' where cod_pptal ='$pg' and id_emp ='$idxx'";
			$resultadopg = $connection->query($sqlpg);
			// padre cuenta nivel 7
			$pf = substr($codigo, 0, 10);
			$consultapf = $connection->query("SELECT * from cxp where cod_pptal ='$pf' and id_emp ='$idxx'");
			while ($rowpf = $consultapf->fetch_assoc()) {
				$vrpf = $rowpf["definitivo"];
			}
			$respf = $vrpf - $h;
			$sqlpf = "update cxp set definitivo = '$respf' where cod_pptal ='$pf' and id_emp ='$idxx'";
			$resultadopf = $connection->query($sqlpf);
			// padre cuenta nivel 6
			$pe = substr($codigo, 0, 8);
			$consultape = $connection->query("SELECT * from cxp where cod_pptal ='$pe' and id_emp ='$idxx'");
			while ($rowpe = $consultape->fetch_assoc()) {
				$vrpe = $rowpe["definitivo"];
			}
			$respe = $vrpe - $h;
			$sqlpe = "update cxp set definitivo = '$respe' where cod_pptal ='$pe' and id_emp ='$idxx'";
			$resultadope = $connection->query($sqlpe);
			// padre cuenta nivel 5
			$pd = substr($codigo, 0, 6);
			$consultapd = $connection->query("SELECT * from cxp where cod_pptal ='$pd' and id_emp ='$idxx'");
			while ($rowpd = $consultapd->fetch_assoc()) {
				$vrpd = $rowpd["definitivo"];
			}
			$respd = $vrpd - $h;
			$sqlpd = "update cxp set definitivo = '$respd' where cod_pptal ='$pd' and id_emp ='$idxx'";
			$resultadopd = $connection->query($sqlpd);
			// padre cuenta nivel 4
			$pc = substr($codigo, 0, 4);
			$consultapc = $connection->query("SELECT * from cxp where cod_pptal ='$pc' and id_emp ='$idxx'");
			while ($rowpc = $consultapc->fetch_assoc()) {
				$vrpc = $rowpc["definitivo"];
			}
			$respc = $vrpc - $h;
			$sqlpc = "update cxp set definitivo = '$respc' where cod_pptal ='$pc' and id_emp ='$idxx'";
			$resultadopc = $connection->query($sqlpc);
			// padre cuenta nivel 3
			$pb = substr($codigo, 0, 2);
			$consultapb = $connection->query("SELECT * from cxp where cod_pptal ='$pb' and id_emp ='$idxx'");
			while ($rowpb = $consultapb->fetch_assoc()) {
				$vrpb = $rowpb["definitivo"];
			}
			$respb = $vrpb - $h;
			$sqlpb = "update cxp set definitivo = '$respb' where cod_pptal ='$pb' and id_emp ='$idxx'";
			$resultadopb = $connection->query($sqlpb);
			// padre cuenta nivel 2
			$pa = substr($codigo, 0, 1);
			$consultapa = $connection->query("SELECT * from cxp where cod_pptal ='$pa' and id_emp ='$idxx'");
			while ($rowpa = $consultapa->fetch_assoc()) {
				$vrpa = $rowpa["definitivo"];
			}
			$respa = $vrpa - $h;
			$sqlpa = "update cxp set definitivo = '$respa' where cod_pptal ='$pa' and id_emp ='$idxx'";
			$resultadopa = $connection->query($sqlpa);

			break;
			//---------

		default:
			$error = "
<center class='Estilo4'><br><br><b>ERROR</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>";
	}


	//printf("%s <br><br></center>", $error);


	$cx = new mysqli($server, $dbuser, $dbpass, $database);

	$sSQL = "Delete from adi_cxp Where id='$id' and id_emp ='$idxx'";
	$cx->query($sSQL);

	printf("
<center class='Estilo4'><br><br><b>ADICION ELIMINADA CON EXITO</B><br><br>
<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
<div align='center'><a href='adi_ppto_ing.php' target='_parent'>VOLVER</a>
</div>
</div>
</div></center>");



	?>
<?php
}
?><title>CONTAFACIL</title>
<style type="text/css">
	<!--
	.Estilo1 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 12px;
		font-weight: bold;
	}

	.Estilo2 {
		font-size: 9px
	}

	a {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #666666;
	}

	a:visited {
		color: #666666;
		text-decoration: none;
	}

	a:hover {
		color: #666666;
		text-decoration: underline;
	}

	a:active {
		color: #666666;
		text-decoration: none;
	}

	a:link {
		text-decoration: none;
	}

	.Estilo7 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 11px;
		color: #666666;
	}

	.Estilo4 {
		font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
		font-size: 10px;
		color: #333333;
	}
	-->
</style>

<style type="text/css">
	table.bordepunteado1 {
		border-style: solid;
		border-collapse: collapse;
		border-width: 2px;
		border-color: #004080;
	}
</style>