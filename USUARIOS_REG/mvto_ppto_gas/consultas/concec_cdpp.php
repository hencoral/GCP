<?php
header("Cache-Control: no-store, no-cache, must-revalidate"); 
$fecha = $_REQUEST['cod'];
$anno =explode("/",$fecha);
$anno2 =$anno[0]."/01/01";
include('../../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);

		// Consulto la tabla de pagos por sumar el valor total pagado del cada rubro
		$sql2 = "select max(cdpp) from cdpp where fecha_reg='$fecha'";
		$res = $cx->query($sql2);
		$row = $res->fetch_array();
		$concec= $row["max(cdpp)"];
		if ($concec)
		{
			$i=1;
			do {
					$con = $concec + $i;
					$sq2 =$cx->query("select * from cdpp where cdpp ='$con'");
					$fil = $sq2->num_rows;
					$conant = $con-1;
					$sq3 =$cx->query("select * from cdpp where cdpp ='$conant'");
					$row3 = $sq3->fetch_array();
					$fecha2 =$row3["fecha_reg"]; 
					if ($fil >0)
					{
						$i++;
						$j =0;
					}else{
						echo $con.",".$fecha2;
						$j=1;
						break;
					}
				} while ($j=1);	
		// si la fecha no tiene registros
		}else{
			$k=0;
			// Cuando el sistema no encuentra un registro para la fecha seleccionada
			do {
					// redusca la fecha en d�as
					$fecha_b = date("Y/m/d", strtotime( "$fecha -$k day"));
					// para consultar solo en la vigencia
					if ($fecha_b < $anno2) break;
					// busco el valor maximo del consecutivo para la fecha reducida
					$sql4 = "select max(cdpp) from cdpp where fecha_reg='$fecha_b'";
					$res4 = $cx->query($sql4);
					$row4 = $res4->fetch_array();
					// Evaluo si la consulta arroja resultados
					$fila4 = $res4->num_rows;
					$concec2= $row4["max(cdpp)"];
					if ($concec2)
						{
							// Si la consulta devuelve datos incremento consecutivo para repetir la busqueda hasta encontrar espacio
							// consultar consecutivo y verificar disponibilidad, romper el ciclo
							$i=1;
								do {
									$con = $concec2 + $i;
									$sq2 =$cx->query("select * from cdpp where cdpp ='$con'",);
									$fil = $sq2->num_rows;
									$conant = $con-1;
									$sq3 =$cx->query("select * from cdpp where cdpp ='$conant'");
									$row3 = $sq3->fetch_array();
									$fecha2 =$row3["fecha_reg"]; 
									if ($fil >0)
									{
										$i++;
										$j =0;
									}else{
										echo $con.",".$fecha2;
										$j='1';
										break;
									}
								} while ($j=1);				
						break;
						}else{
							// restar la fecha en dos y repetir consulta hasta que fecha sea igual a inicio de vigencia
							$k++;
							$j=0;
						}
			} while ($j='1'); 
		 
		}
//$cx->close();
?>
