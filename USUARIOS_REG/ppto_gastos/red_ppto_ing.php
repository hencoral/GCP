<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: ../login.php");
	exit;
} else {
?>

	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<title>CONTAFACIL</title>
		<link rel=StyleSheet href="../css/estilos.css" TYPE="text/css" />

		<style type="text/css">
			.Estilo2 {
				font-size: 9px
			}

			.Estilo4 {
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size: 10px;
				color: #333333;
			}

			a {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 11px;
				color: #666666;
			}

			a:link {
				text-decoration: none;
			}

			a:visited {
				text-decoration: none;
				color: #666666;
			}

			a:hover {
				text-decoration: underline;
				color: #666666;
			}

			a:active {
				text-decoration: none;
				color: #666666;
			}

			.Estilo7 {
				font-family: Verdana, Arial, Helvetica, sans-serif;
				font-size: 9px;
				color: #666666;
			}
		</style>

		<style>
			.fc_main {
				background: #FFFFFF;
				border: 1px solid #000000;
				font-family: Verdana;
				font-size: 10px;
			}

			.fc_date {
				border: 1px solid #D9D9D9;
				cursor: pointer;
				font-size: 10px;
				text-align: center;
			}

			.fc_dateHover,
			TD.fc_date:hover {
				cursor: pointer;
				border-top: 1px solid #FFFFFF;
				border-left: 1px solid #FFFFFF;
				border-right: 1px solid #999999;
				border-bottom: 1px solid #999999;
				background: #E7E7E7;
				font-size: 10px;
				text-align: center;
			}

			.fc_wk {
				font-family: Verdana;
				font-size: 10px;
				text-align: center;
			}

			.fc_wknd {
				color: #FF0000;
				font-weight: bold;
				font-size: 10px;
				text-align: center;
			}

			.fc_head {
				background: #000066;
				color: #FFFFFF;
				font-weight: bold;
				text-align: left;
				font-size: 11px;
			}
		</style>
		<style type="text/css">
			table.bordepunteado1 {
				border-style: solid;
				border-collapse: collapse;
				border-width: 2px;
				border-color: #004080;
			}
		</style>
		<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
		</LINK>

		<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>

		<script>
			var comp;
			var def;

			function ValidaValor() {
				valor1 = def;
				valor2 = comp;
				valor3 = valor1 - valor2;
				if (valor3 <= 0) {
					alert("El valor a reducir es mayor al saldo del rubro");
					document.a.valor_adi.value = valor3;

				}



			}

			function cambia() {
				cambia1();
				cambia2();


			}

			function cambia1() {
				cod_pptal = document.a.cod_pptal.value;
				var pos_url2 = 'comprobadores/comprueba_comp.php'; // Carga la variable con el archivo que se pretende cargar en el servidor
				var cod = cod_pptal; // Lee de un campo o id la variable que se pasa al servidor

				var req1 = new XMLHttpRequest(); // Crea el objeto XML
				if (req1) {
					req1.onreadystatechange = function() {
						if (req1.readyState == 4 && (req1.status == 200 || req1.status == 304)) {

							//document.procedimientos.observaciones.value = req.responseText;
							document.getElementById('resp').innerHTML = req1.responseText;
							comp = req1.responseText;
							return comp;



						}
					}
					req1.open('GET', pos_url2 + '?cod=' + cod, true);
					req1.send(null);
				}
			}

			function cambia2() {
				cod_pptal = document.a.cod_pptal.value;



				var pos_url = 'comprobadores/comprueba_def.php'; // Carga la variable con el archivo que se pretende cargar en el servidor
				var cod = cod_pptal; // Lee de un campo o id la variable que se pasa al servidor

				var req = new XMLHttpRequest(); // Crea el objeto XML
				if (req) {
					req.onreadystatechange = function() {
						if (req.readyState == 4 && (req.status == 200 || req.status == 304)) {

							//document.procedimientos.observaciones.value = req.responseText;
							document.getElementById('resp2').innerHTML = req.responseText;
							def = req.responseText;
							return def;

						}
					}
					req.open('GET', pos_url + '?cod=' + cod, true);
					req.send(null);
				}
			}
		</script>
	</head>

	<body>
		<table width="70%" border="0" align="center">
			<tr>

				<td colspan="3">
					<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
						<div align="center">
							<img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />
						</div>
					</div>
				</td>
			</tr>

			<tr>
				<td colspan="3">
					<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:10px;">
						<div align="center">
							<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
								<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
									<div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
								</div>
							</div>
						</div>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan="3">
					<form name="a" method="post" action="red_ppto_ing_2.php">
						<table width="100%" border="1" align="center" class="bordepunteado1">
							<tr>
								<td colspan="3" bgcolor="#DCE9E5">
									<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
										<div align="center" class="Estilo4"><strong>MODIFICACIONES AL PRESUPUESTO DE GASTOS <br />
												<BR />
												Reducciones al Presupuesto </strong></div>
									</div>
								</td>
							</tr>

							<tr>
								<td colspan="3">
									<div id="div6" style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
										<div align="center">
											<input name="Submit" type="submit" class="Estilo4" value="Nueva Reducci&oacute;n" />
										</div>
									</div>
								</td>
							</tr>
						</table>
					</form>
					<br />

					<table width="100%" border="0" align="center">
						<tr>
							<td width="1250" colspan="3" bgcolor="#FFFFFF">
								<div style='padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;'>
									<div align="center" class="Estilo4"><strong>REDUCCIONES REALIZADAS AL PRESUPUESTO HASTA LA FECHA</strong> </div>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<?php

		// conecto la base de datos
		include('../config.php');
		$cx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");

		// Estraigo encabezados por tipo de acto, numero de acto y fecha
		$sq = "SELECT fecha_adi, tipo_acto, num_acto,concepto_adi from red_ppto_gas  group by tipo_acto,num_acto order by fecha_adi asc ";
		$re = $cx->query($sq);


		// imprimo encabezados 
		while ($rw = $re->fetch_assoc()) {
			$acuerdo = $rw["num_acto"];
			$fecha = $rw["fecha_adi"];
			$doc = $rw["tipo_acto"];
			$concepto_adi = $rw["concepto_adi"];

		?>
			<table width="68%" border="1" align="center" class="bordepunteado1">
				<tr class="Titulotd">
					<td colspan="5">
						<?php printf("$doc&nbsp$acuerdo:&nbsp");
						print("<font size='1' color ='#666666'>$concepto_adi</font>"); ?>
					</td>
					<td>
						<img src="simbolos/reporte_azul.JPG" width="16px" border="0" alt="Imprimir" align="right" />
					</td>
				</tr>
				<tr align="center" class="Titulotds">
					<td width="10%">
						FECHA
					</td>
					<td width="15%">
						RUBRO
					</td>
					<td width="54%">
						NOMBRE RUBRO PRESUPUESTAL
					</td>
					<td width="15%">
						VALOR
					</td>
					<td width="3%">

					</td>
					<td width="3%">

					</td>
				</tr>

				<?php

				// Selecciono los registros relacionados con el encabezado
				$sq2 = "SELECT * from red_ppto_gas  where tipo_acto = '$doc' and num_acto ='$acuerdo'";
				$re2 = $cx->query($sq2);

				while ($rw2 = $re2->fetch_array()) {
					$id = $rw2[0];
					$cod_pptal = $rw2[2];
					$sq4 = "SELECT nom_rubro from car_ppto_gas where cod_pptal ='$cod_pptal'";
					$rs4 =  $cx->query($sq4);
					$rw4 = $rs4->fetch_array();
					$nom_rubro = ucfirst(preg_replace("[,;%]", "", $rw4['nom_rubro']));
					$fecha_adi = $rw2[4];
					$valor_adi = $rw2[8];

				?>

					<tr class="Estilo4">
						<td align="center">
							<?php printf("$fecha_adi"); ?>
						</td>
						<td>
							<?php printf("$cod_pptal"); ?>
						</td>
						<td>
							<?php echo ("$nom_rubro"); ?>
						</td>
						<td align="right">
							<?php printf(number_format($valor_adi, 2, ",", ".")); ?>
						</td>
						<td>

							<?php
							echo "
										<a href=\"mod_red_ppto_ing_2.php?borrar=$id&fecha_a=$fecha_adi&cod=$cod_pptal \"><img src=\"../simbolos/modificarblanco.png\" width=\"16px\" border=\"0\" title=\"Modificar\" /></a>
										";
							?>
						</td>
						<td>
							<?php
							echo "
										<a href=\"borra_red_ppto_ing.php?borrar=$id&fecha_a=$fecha_adi \"><img src=\"../simbolos/eliminarblanco.png\" width=\"16px\" border=\"0\" title=\"Eliminar\" /></a>
										";
							?>
						</td>
					</tr>

				<?php

				}

				$sq3 = "SELECT sum(valor_adi) as valor from red_ppto_gas  where tipo_acto = '$doc' and num_acto ='$acuerdo'";
				$re3 = $cx->query($sq3);

				while ($rw3 = $re3->fetch_assoc()) {
					$total = $rw3["valor"];
				?>
					<tr class="Titulotds">
						<td colspan="3" align="right">
							TOTAL
						</td>

						<td align="right">
							<?php printf(number_format($total, 2, ",", ".")); ?>
						</td>

						<td>
						</td>

						</td>
						<td>
					</tr>
			<?php
				}

				print("<br>");
				print("</table>");
			}

			$cx = null;
			?>

			<table align="center">
				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
							<div align="center">
								<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
									<div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
										<div align="center"><a href='carga_ppto_gas.php' target='_parent'>VOLVER </a> </div>
									</div>
								</div>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td colspan="3">
						<div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
							<div align="center"> <span class="Estilo4">Fecha de esta Sesion:</span> <br />
								<span class="Estilo4"> <strong>
										<?php include('../config.php');
										$connectionxx = new mysqli($server, $dbuser, $dbpass, $database) or die("Fallo en la Conexion a la Base de Datos");
										$sqlxx = "SELECT * from fecha";
										$resultadoxx = $connectionxx->query($sqlxx);

										while ($rowxx = $resultadoxx->fetch_assoc()) {
											$ano = $rowxx["ano"];
										}
										echo $ano;
										?>
									</strong> </span> <br />
								<span class="Estilo4"><b>Usuario: </b><u><?php echo $_SESSION["login"]; ?></u> </span>
							</div>
						</div>
					</td>
				</tr>
				<tr>
					<td width="296">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><?php include('../config.php');
												echo $nom_emp ?><br />
								<?php echo $dir_tel ?><BR />
								<?php echo $muni ?> <br />
								<?php echo $email ?> </div>
						</div>
					</td>
					<td width="296">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
							<div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
								</a><BR />
								<a href="../../condiciones.php" target="_blank">CONDICIONES DE USO </a>
							</div>
						</div>
					</td>
					<td width="296">
						<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
							<div align="center">Desarrollado por <br />
								<a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
								Derechos Reservados - 2009
							</div>
						</div>
					</td>
				</tr>
			</table>
	</body>

	</html>






<?php
}
?>