<html>
<head>
<title>Marco flotante con scroll controlado</title>

</head>

<body onLoad=llamaralancla() >

<p align="center"><b></b></p>
<!-- ESTO VA EN EL IFRAME
DO NOT REMOVE BELOW SCRIPT. IT SHOULD ALWAYS APPEAR AT THE VERY END OF YOUR CONTENT-->
<script>
function llamaralancla(){
document.location.href = "#ancla";
}
//Scrollable content III- By http://www.dynamicdrive.com

var speed, currentpos=curpos1=0,alt=1,curpos2=-1;

function initialize(){
if (window.parent.scrollspeed!=0){
speed=window.parent.scrollspeed
scrollwindow()
}
}

function scrollwindow(){
temp=(document.all)? document.body.scrollTop : window.pageYOffset
alt=(alt==0)? 1 : 0
if (alt==0)
curpos1=temp
else
curpos2=temp

window.scrollBy(0,speed)
}

setInterval("initialize()",1)

</script>

<?php 
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
			
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_array())
{
  $ano=$rowxx["ano"];
}

//header("Cache-Control: no-store, no-cache, must-revalidate"); 

			$sql2 = "SELECT fecha_reg , cdpp FROM cdpp order by fecha_reg, cdpp asc;";
			$res = $cx->query($sql2);
		   // $row = mysql_fetch_array($res);
			
			 echo"<center>";
      		 echo "<table  align=center border=0 width='40%'class='bordepunteado1'>"; 
       		 $columnes = 2; # numero de columnas (variable) 
             if ($rows=$res->num_rows==0)
			 {   
                       echo " No Se Han Encontrado  datos";
             } 
			 
			 else 
     		 { 
               			echo "<tr><td colspan=$columnes><div align='center'><strong>$rows resultados De  cdpp </strong></div></font> </td></tr>"; 
              			echo"<tr>";
              		 	echo "<td ><div align='center'><font size='4'> <strong>fecha</strong></div></font></td>"; 
            			echo "<td ><div align='center'><font size='4'><strong>cdpp</strong></div></font></td>";                                                  
                        echo"</tr>";
						for ($i=1; $row = $res->fetch_array(); $i++) 
						{ 
           					 $resto = ($i % $columnes); # numero de celda del <tr> en que nos encontramos 
           					 if ($resto == 1) 
							 {    
                    				echo "<tr>";
                			 }     # Si es la primera celda, abrimos <tr>                     
                    				//$nom="select ='$row[0]'";  
									
							if($i%2==0)
							{		                  
                    			if ($row[0]==$ano)
								{
									$ancla = "<a name=ancla></a>";
									echo "<td bgcolor='#8AAFEC'><font size='4'>$row[0]$ancla</font></td>";
									echo "<td bgcolor='#8AAFEC'><font size='4'>$row[1]</font></td>";  
									echo "</tr>"; 
								}else
								{
									echo "<td bgcolor='#CCCCCC'><class='required Estilo4'><font size='4'>$row[0]</font></td>";
									echo "<td bgcolor='#CCCCCC'><class='required Estilo4'><font size='4'>$row[1]</font></td>"; 										echo "</tr>"; 

								} 
							}
							else
							{
								if ($row[0]==$ano)
								{
									$ancla = "<a name=ancla></a>";
									echo "<td bgcolor='#8AAFEC'><font size='4'>$row[0]$ancla</font></td>";
									echo "<td bgcolor='#8AAFEC'><font size='4'>$row[1]</font></td>";  
									echo "</tr>"; 
								}else
								{
									echo "<td ><class='required Estilo4'><font size='4'>$row[0]</font></td>";
									echo "<td ><class='required Estilo4'><font size='4'>$row[1]</font></td>";  									
									echo "</tr>"; 

								} 
							}
							                                                                       

							
							if ($resto == 0) 
                			{                    
                			} # Si es la ultima celda, cerramos </tr> 
           				 } 
						  echo "</table>"; 
               			  echo"</center>";
							 
          } 
 
?>

</body>

</html>