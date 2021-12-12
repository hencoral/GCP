
<html>
<head>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />
</head>
<body>
<?php
include('../config.php');
include ('../objetos/busca_terceros.php');
//
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
// Establezco la viegencia de acuerdo a la vigecia
$ctrl='';
$filas =0;
$error='';
// Encabezado de la tabla para reporte
echo "<div align='center'>ERRORES DE IMPORTACION DE TERCEROS</div>";
echo "<br>";
echo "<table border='1' align='center' width='80%' class='bordepunteado1'>";
echo "<tr bgcolor='#DCE9E5' class='Titulotd'>
		<td>Fila</td>
		<td>Documento</td>
		<td>Apellido 1</td>
		<td>Apellido 2</td>
		<td>Nombre 1</td>
		<td>Nombre 2</td>
		<td>Errores</td>
	  </tr>"	;
if(!$cx) 
	die("no db");
if(!$cx)
 	die("No database selected.");
     $filename='terceros.csv'; 
     $handle = fopen("$filename", "r");
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE)
     {	
	 
	 if ($data[0] == 'D')
		 {	
		// Verificar si la fecha esta dentro de la vigencia actual
		  $fecha = date('Y/m/d');
		// Verificar que el campo documento este lleno
			if ($data[2] =='')
			{
				$ctrl ='1';
				$error .='El campo documento no puede estar vacio <br>';
			}
			if ($data[3] =='')
			{
				$ctrl ='1';
				$error .='El campo primer apellido no puede estar vacio <br>';
			}
			if ($data[5] =='')
			{
				$ctrl ='1';
				$error .='El campo primer nombre no puede estar vacio <br>';
			}
			// Verificar si existe el tercero 
			$ter = busca_terceros($data[2]);
			if ($ter !='')
			{
				$ctrl ='1';
				$error .='El tercero ya existe en la base de datos <br>';
			}
     		// VERIFICO QUE NO EXISTAN ERRORES
			 if($ctrl !='1')
			 {

			 // Trabajar con transacciones guarda en cdpp y crpp

			 // Si es natural inserta
			 	if($data[1] == 'N'){
						   $import="INSERT INTO terceros_naturales ( 
							id_emp,
							fecha_reg,
							tipo_id,
							num_id,
							clase,
							regimen,
							ent_ofi,
							pri_ape,
							seg_ape,
							pri_nom,
							seg_nom,
							pais,
							dpto,
							mpio,
							dir,
							tel,
							email,
							empleado,
							ref,
							monto,
							embargo
							)VALUES(
							'2',
							'$fecha',
							'1',
							'$data[2]',
							'CONTRATISTA',
							'SIMPLIFICADO',
							'NO',
							'$data[3]',
							'$data[4]',
							'$data[5]',
							'$data[6]',
							'$data[8]',
							'$data[9]',
							'$data[10]',
							'$data[11]',
							'$data[12]',
							'$data[13]',
							'$data[15]',
							'$data[14]',
							0,
							0
							)";
							$cx->query($import);
							  // Reporte registro exitoso
						}
					// si es juridico insertar
					if($data[1] == 'J'){
						echo "dfgdfgdfgfd";
							$import="INSERT INTO terceros_juridicos ( 
							id_emp,
							fecha_reg,
							tip_id2,
							num_id2,
							clase2,
							regimen2,
							ent_ofi2,
							raz_soc2,
							pais2,
							dpto2,
							mpio2,
							dir2,
							tel2,
							em2,
							ref,
							em22,
							cree,
							act_eco
							)VALUES(
							'2',
							'$fecha',
							'2',
							'$data[2]',
							'CONTRATISTA',
							'SIMPLIFICADO',
							'NO',
							'$data[7]',	
							'$data[8]',
							'$data[9]',
							'$data[10]',
							'$data[11]',
							'$data[12]',
							'$data[13]',
							'$data[14]',
							'',
							'',
							''
							)";
							$cx->query($import);

					}					
			 }else{
				 // Reporte registro con error 
				 echo "<tr>
							<td>$filas</td>
							<td>$data[1]</td>
							<td>$data[2]</td>
							<td>$data[3]</td>
							<td>$data[4]</td>
							<td>$data[5]</td>
							<td>$error</td>
						  </tr>"	;
					 
				 } // end else errores
			} // end campo D
			$error='';
			$ctrl='';
			$filas++;
		} // end while
	
	
	   fclose($handle);
	   
	echo "</table>";

printf("

<center >
<form method='post' action='upload_ter.php'>
<input type='hidden' name='nn' value='CDPP'>
 <input type='submit' name='Submit' value='Volver' class='Estilo4' style='background:#72A0CF; color:#FFFFFF; border:none; font-size: 13px;' /> 
</form>
</center>
");

?>
</body>
</html>
