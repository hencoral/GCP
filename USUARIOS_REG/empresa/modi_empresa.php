<?php
session_start();
include('../config.php');
global $server, $database, $dbpass, $dbuser, $charset;
// Conexion con la base de datos
$cx = new mysqli($server, $dbuser, $dbpass, $database);
if(!isset($_SESSION["login"]))
{
header("Location: login.php");
exit;
} else {
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>

<style type="text/css">
<!--
.Estilo2 {font-size: 9px}
.Estilo4 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
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
.Estilo7 {font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 9px; color: #666666; }
.Estilo8 {color: #FFFFFF}
-->
</style>

<style>
.fc_main { background: #FFFFFF; border: 1px solid #000000; font-family: Verdana; font-size: 10px; }
.fc_date { border: 1px solid #D9D9D9;  cursor:pointer; font-size: 10px; text-align: center;}
.fc_dateHover, TD.fc_date:hover { cursor:pointer; border-top: 1px solid #FFFFFF; border-left: 1px solid #FFFFFF; border-right: 1px solid #999999; border-bottom: 1px solid #999999; background: #E7E7E7; font-size: 10px; text-align: center; }
.fc_wk {font-family: Verdana; font-size: 10px; text-align: center;}
.fc_wknd { color: #FF0000; font-weight: bold; font-size: 10px; text-align: center;}
.fc_head { background: #000066; color: #FFFFFF; font-weight:bold; text-align: left;  font-size: 11px; }
</style>

<style type="text/css">
table.bordepunteado1 { border-style: solid; border-collapse:collapse; border-width: 2px; border-color: #004080; }
.Estilo9 {font-weight: bold}
.Estilo10 {font-weight: bold}
.Estilo11 {font-weight: bold}
.Estilo12 {font-weight: bold}
.Estilo13 {font-weight: bold}
.Estilo14 {font-weight: bold}
.Estilo15 {font-size: 12px}
</style>

<script language="">

function cursor(){document.empresa.raz_soc.focus();}
// -->
</script>



<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which; 
    if (tecla==8 || tecla==46) return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>


</head>

<body onLoad=cursor()>
<table width="600" border="0" align="center">
  <tr>
    
    <td width="600" colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" /></div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../crear_empresa.php' target='_parent'>VOLVER</a> </div>
      </div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
  
    <td colspan="3">
	
	<form name="empresa" method="post" action="proc_modi_emp.php" onsubmit="return confirm('Verifique si todos los datos estan correctos')">

	<table width="790"  border ='1' class='bordepunteado1' >
       
      <tr>
        <td colspan="2" bgcolor="#DCE9E5" class="Estilo4"><div id="div32" style="padding-left:3px; padding-top:10px; padding-right:3px; padding-bottom:10px;">
          <div align="center"><strong>MODIFICAR DATOS DE LA  EMPRESA </strong></div>
        </div></td>
        </tr>
      <tr>
        <td width="350" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">RAZON SOCIAL 		</div>
		</div>		</td>
        <td width="422" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		<input name="id" type="hidden" value="<?php $a=$_GET['id1']; printf("%d", $a); ?>" size="40">
		<input name="raz_soc" type="text" class="Estilo7" id="raz_soc" tabindex="0" size="40" onkeyup="empresa.raz_soc.value=empresa.raz_soc.value.toUpperCase();" value="<?php   $a=$_GET['id1'];  $a1=$cx->query("select raz_soc from empresa where cod_emp = $a");  while($row = $a1->fetch_assoc()) { printf("%s", $row["raz_soc"]); }?>" />
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">NIT		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="nit" type="text" class="Estilo7" id="nit" tabindex="0" size="15" onkeypress="return validar(event)" value="<?php   $a=$_GET['id1'];  $a1=$cx->query("select nit from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%d", $row["nit"]); }  ?>" /> 
		  <span class="Estilo8">..</span> DV
          <input name="dv" type="text" class="Estilo4" id="dv" size="4" value="<?php   $a=$_GET['id1'];  $a1=$cx->query("select dv from empresa where cod_emp = $a");  while($row = $a1->fetch_assoc()) { printf("%d", $row["dv"]); }  ?>" />
		0 - 9 </div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">CODIGO INSTITUCION 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="cod_ins" type="text" class="Estilo7" id="cod_ins" tabindex="0" size="15" onkeyup="empresa.cod_ins.value=empresa.cod_ins.value.toUpperCase();" value="<?php  $a=$_GET['id1'];  $a1=$cx->query("select cod_ins from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["cod_ins"]); }  ?>" />
</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">CODIGO C.G.N 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="cod_cgn" type="text" class="Estilo7" id="cod_cgn" tabindex="0" size="15" onkeyup="empresa.cod_cgn.value=empresa.cod_cgn.value.toUpperCase();" value="<?php  $a=$_GET['id1'];  $a1=$cx->query("select cod_cgn from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["cod_cgn"]); }  ?>" />
</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">CODIGO DEPARTAMENTO 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="cod_dep" type="text" class="Estilo7" id="cod_dep" tabindex="0" value="85" size="5" />
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right"> MUNICIPIO 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <select name="cod_mpio" class="Estilo4" id="cod_mpio">
		    <option value="001">YOPAL</option>
		    <option value="010">AGUAZUL</option>
		    <option value="015">CHAMEZA</option>
		    <option value="125">HATO COROZAL</option>
		    <option value="136">LA SALINA</option>
		    <option value="139">MANI</option>
		    <option value="162">MONTERREY</option>
		    <option value="225">NUNCHIA</option>
		    <option value="230">OROCUE</option>
		    <option value="250">PAZ DE ARIPORO</option>
		    <option value="263">PORE</option>
		    <option value="279">RECETOR</option>
		    <option value="300">SABANALARGA</option>
		    <option value="315">SACAMA</option>
		    <option value="325">SAN LUIS DE PALENQUE</option>
		    <option value="400">TAMARA</option>
		    <option value="410">TAURAMENA</option>
		    <option value="430">TRINIDAD</option>
		    <option value="440">VILLANUEVA</option>
		    
		    </select>
		  </div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">DIRECCION EMPRESA 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="dir" type="text" class="Estilo7" id="dir" tabindex="0" size="40" onkeyup="empresa.dir.value=empresa.dir.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select dir from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["dir"]); }  ?>" />
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">TELEFONO EMPRESA 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="tel" type="text" class="Estilo7" id="tel" tabindex="0" size="15" onkeypress="return validar(event)" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tel from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tel"]); }  ?>"/>
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">FAX EMPRESA 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="fax" type="text" class="Estilo7" id="fax" tabindex="0" size="15" onkeypress="return validar(event)" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select fax from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["fax"]); }  ?>" />
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">E - MAIL EMPRESA 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="email" type="text" class="Estilo7" id="email" tabindex="0" size="40" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select email from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["email"]); }  ?>"/>
</div>		</td>
      </tr>
      <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">SITIO WEB EMPRESA 		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <input name="web_site" type="text" class="Estilo7" id="web_site" tabindex="0" size="40" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select web_site from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["web_site"]); }  ?>"/>
</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">UNIDAD EJECUTORA  		</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <select name="uni_eje" class="Estilo4" id="uni_eje">
		    <option value="ALCALDIA SECTOR CENTRAL">ALCALDIA SECTOR CENTRAL</option>
		    <option value="CONCEJO">CONCEJO</option>
		    <option value="CABILDO">CABILDO</option>
		    <option value="DLS">DLS</option>
		    <option value="EMPRESA">EMPRESA</option>
		    <option value="PERSONERIA">PERSONERIA</option>
		    </select>
		  </div>		</td>
      </tr>
	  
	<?php 
	$sqlx = "select * from empresa where cod_emp = $a";
	$rx = $cx->query($sqlx);

	while($rwx = $rx->fetch_assoc()){
   
   	$otra_uni_eje=$rwx["otra_uni_eje"];
   	$tipo_entidad=$rwx["tipo_entidad"];
	$regional=$rwx["regional"];
	$contrata = $rwx["reg_contratacion"]; 
	$cargo_rep_leg = $rwx["cargo_rep_leg"];
	$cargo_conta = $rwx["cargo_conta"];
	$cargo_rev = $rwx["cargo_rev"];
	$cargo_ci = $rwx["cargo_ci"];
	$cargo_teso = $rwx["cargo_teso"];
	$cargo_ppto = $rwx["cargo_ppto"];
	
    }
	?>	
	  
	  
	  <tr>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  	<div align="right">OTRA UNIDAD EJECUTORA		</div>
			</div>	
		</td>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
			<input name="otra_uni_eje" type="text" class="Estilo7" id="otra_uni_eje" tabindex="0" size="40" value=" <?php printf ($otra_uni_eje); ?>"/>
			</div>	
		</td>
     </tr>
	 
	 
	<tr>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  	<div align="right">TIPO DE ENTIDAD  		</div>
			</div>	
		</td>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
			
			<select name="tipo_entidad" class="Estilo4" id="uni_eje">
		    
		<?php
			if ($tipo_entidad == "ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES")
			{
				?>
				<option value="ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES" selected="selected">ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES</option>
		    	<option value="EMPRESAS NACIONALES Y TERRITORIALES">EMPRESAS NACIONALES Y TERRITORIALES</option>
		    	<option value="ENTIDADES TERRITORIALES">ENTIDADES TERRITORIALES</option>
		    	</select>
				<?php
			}
			if ($tipo_entidad == "EMPRESAS NACIONALES Y TERRITORIALES")
			{
				?>
				<option value="ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES">ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES</option>
		    	<option value="EMPRESAS NACIONALES Y TERRITORIALES" selected="selected">EMPRESAS NACIONALES Y TERRITORIALES</option>
		    	<option value="ENTIDADES TERRITORIALES">ENTIDADES TERRITORIALES</option>
		    	</select>
				<?php
			}
			if ($tipo_entidad == "ENTIDADES TERRITORIALES")
			{
				?>
				<option value="ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES">ENTIDAD ADMIN CENTRAL NACIONAL Y ESTAB. NACIONALES</option>
		    	<option value="EMPRESAS NACIONALES Y TERRITORIALES">EMPRESAS NACIONALES Y TERRITORIALES</option>
		    	<option value="ENTIDADES TERRITORIALES" selected="selected">ENTIDADES TERRITORIALES</option>
		    	</select>
				<?php
			}
		?>
		  </div>
		</td>
    </tr>
	  
	 <tr>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  	<div align="right">REGIONAL	</div>
			</div>
		</td>
        <td class="Estilo4">
			<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
			<input name="regional" type="text" class="Estilo7" id="regional" tabindex="0" size="40" value="<?php printf($regional); ?>"/>
			</div>		
		</td>
     </tr>
	 <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">REGIMEN DE CONTRTACION</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		     <select name="contratacion" class="Estilo4" id="contratacion">
             
              <?php 
			 $k=0;
			  $datos = array("","LEY 80","CONVENIOS LEY 489","CONSTITUCION POLITICA ART. 355","REGIMEN PRIVADO");
			  for ($k=0;$k<5;$k++)
					   {
					   if ($contrata == $k)
					   		echo "<option value='$k' selected>$datos[$k]</option>";
					   else		
                       		echo "<option value='$k' >$datos[$k]</option>";
					   }
				?> 
		     </select>
		      </div>
		</div>		</td>
      </tr>

	 <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">ORDEN DE LOS RECURSOS</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		     <select name="orden" class="Estilo4" id="orden">
             
              <?php 
			  $orden =0;
			 $k=0;
			  $datos = array("","NACIONAL","DEPARTAMENTAL","MUNICIPAL");
			  for ($k=0;$k<4;$k++)
					   {
					   if ($orden == $k)
					   		echo "<option value='$k' selected>$datos[$k]</option>";
					   else		
                       		echo "<option value='$k' >$datos[$k]</option>";
					   }
				?> 
		     </select>
		      </div>
		</div>		</td>
      </tr>
	  
	  <tr>
        <td colspan="2" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="center"><B>DEFINA EQUIVALENCIA PARA UNIDAD EJECUTORA </B></div>
		</div>		</td>
        </tr>
	   <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">CODIGO F.U.T :		    </div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		      <select name="fut" class="Estilo4" id="fut">
		        <option value="1">1 . Admin.Central</option>
		        <option value="2">2. Concejo (Mpio)</option>
		        <option value="3">3. Asamblea (Dpto)</option>
		        <option value="4">4. Contraloria</option>
		        <option value="5">5. Personeria (Mpio)</option>
		        <option value="6">6. Sec. Educacion</option>
		        <option value="7">7. Sec. Salud</option>
		        <option value="8">8. Uni. Serv. Publicos</option>
		        <option value="9">9. Licores (Dpto)</option>
		        <option value="10">10. NINGUNA</option>
		        </select>
		      </div>
		</div>		</td>
      </tr>
	  <tr>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  <div align="right">CODIGO C.G.R :</div>
		</div>		</td>
        <td class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
		  
		    <div align="left">
		      <select name="cgr" class="Estilo4" id="cgr">
		        <option value="0">0. Consolidado Entidad</option>
		        <option value="2">2. Concejo</option>
		        <option value="3">3. Contraloria</option>
		        <option value="4">4. Personeria</option>
		        <option value="7">7. Admin. Central</option>
		        <option value="14">14. Educacion</option>
		        <option value="16">16. Salud</option>
		        <option value="10">10. NINGUNA</option>
		        </select>
		      </div>
		</div>		</td>
      </tr>
      <tr>
        <td colspan="2" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">		
		  <div align="center" class="Estilo8">RESPONSABLES		</div>
		</div>		</td>
        </tr>
      <tr>
        <td colspan="2" class="Estilo4">
		<div id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
       
		  <table width="820" border="0">
            <tr>
              <td width="138"><div id="div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                &nbsp;</div></td>
              <td width="181"><div class="Estilo9" id="div5" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">NOMBRES COMPLETOS  </div>
              </div></td>
              <td width="86"><div class="Estilo10" id="div28" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">No. CEDULA  </div>
              </div></td>
              <td width="89"><div class="Estilo11" id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">No. T.P. </div>
              </div></td>
              <td width="204"><div class="Estilo11" id="div6" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">DENOMINACION DEL CARGO</div>
              </div></td>
            </tr>
            <tr>
              <td><div id="div2" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">REPRESENTANTE LEGAL : </div>
              </div></td>
              <td><div id="div10" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="nom_rep_leg" type="text" class="Estilo4" id="nom_rep_leg" size="35" onkeyup="empresa.nom_rep_leg.value=empresa.nom_rep_leg.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select nom_rep_leg from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_rep_leg"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div27" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="ced_rep_leg" type="text" class="Estilo4" id="ced_rep_leg" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_rep_leg from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_rep_leg"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div16" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                
                  <div align="center">
                    <input name="tp_rep_leg" type="text" class="Estilo4" id="tp_rep_leg" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_rep_leg from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_rep_leg"]); }  ?>"/>
                    </div>
              </div></td>
              <td><input name="cargo_rep_leg" type="text" class="Estilo4" id="cargo_rep_leg" size="40" value='<?php echo $cargo_rep_leg; ?>' /></td>
            </tr>
            <tr>
              <td><div id="div3" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">CONTADOR : </div>
              </div></td>
              <td><div id="div11" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="nom_cont" type="text" class="Estilo4" id="nom_cont" size="35" onkeyup="empresa.nom_cont.value=empresa.nom_cont.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select nom_cont from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_cont"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div26" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="ced_cont" type="text" class="Estilo4" id="ced_cont" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_cont from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_cont"]); }  ?>"/>
                </div>
              </div></td>
              <td><div id="div17" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                
                  <div align="center">
                    <input name="tp_cont" type="text" class="Estilo4" id="tp_cont" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_cont from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_cont"]); }  ?>"/>
                    </div>
              </div></td>
              <td><input name="cargo_conta" type="text" class="Estilo4" id="cargo_conta" size="40" value='<?php echo $cargo_conta; ?>' /></td>
            </tr>
            <tr>
              <td><div id="div4" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">REVISOR FISCAL :</div>
              </div></td>
              <td><div id="div12" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="nom_rev_fis" type="text" class="Estilo4" id="nom_rev_fis" size="35" onkeyup="empresa.nom_rev_fis.value=empresa.nom_rev_fis.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select nom_rev_fis from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_rev_fis"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div25" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="ced_rev_fis" type="text" class="Estilo4" id="ced_rev_fis" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_rev_fis from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_rev_fis"]); }  ?>"/>
                </div>
              </div></td>
              <td><div id="div18" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                
                  <div align="center">
                    <input name="tp_rev_fis" type="text" class="Estilo4" id="tp_rev_fis" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_rev_fis from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_rev_fis"]); }  ?>" />
                    </div>
              </div></td>
              <td><input name="cargo_rev" type="text" class="Estilo4" id="cargo_rev" size="40" value='<?php echo $cargo_rev; ?>' /></td>
            </tr>
            <tr>
              <td><div id="div7" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">CONTROL INTERNO :</div>
              </div></td>
              <td><div id="div13" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="nom_ctrl_int" type="text" class="Estilo4" id="nom_ctrl_int" size="35" onkeyup="empresa.nom_ctrl_int.value=empresa.nom_ctrl_int.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select nom_ctrl_int from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_ctrl_int"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div24" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="ced_ctrl_int" type="text" class="Estilo4" id="ced_ctrl_int" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_ctrl_int from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_ctrl_int"]); }  ?>"/>
                </div>
              </div></td>
              <td><div id="div19" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                
                  <div align="center">
                    <input name="tp_ctrl_int" type="text" class="Estilo4" id="tp_ctrl_int" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_ctrl_int from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_ctrl_int"]); }  ?>"/>
                    </div>
              </div></td>
              <td><input name="cargo_ci" type="text" class="Estilo4" id="cargo_ci" size="40"  value='<?php echo $cargo_ci; ?>' /></td>
            </tr>
            <tr>
              <td><div id="div8" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">JEFE PRESUPUESTO :</div>
              </div></td>
              <td><div id="div14" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="nom_jefe_ppto" type="text" class="Estilo4" id="nom_jefe_ppto" size="35" onkeyup="empresa.nom_jefe_ppto.value=empresa.nom_jefe_ppto.value.toUpperCase();" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select nom_jefe_ppto from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_jefe_ppto"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div23" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="center">
                  <input name="ced_jefe_ppto" type="text" class="Estilo4" id="ced_jefe_ppto" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_jefe_ppto from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_jefe_ppto"]); }  ?>" />
                </div>
              </div></td>
              <td><div id="div20" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                
                  <div align="center">
                    <input name="tp_jefe_ppto" type="text" class="Estilo4" id="tp_jefe_ppto" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_jefe_ppto from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_jefe_ppto"]); }  ?>"/>
                    </div>
              </div></td>
              <td><input name="cargo_ppto" type="text" class="Estilo4" id="cargo_ppto" size="40"  value='<?php echo $cargo_ppto; ?>' /></td>
            </tr>
            <tr>
                  <td><div id="div8" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
                <div align="right">TESORERO :</div>
              </div></td>
                  <td  valign="middle"><div id="div15" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                    
                      <div align="center">
                        <input name="nom_otr_resp" type="text" class="Estilo4" id="nom_otr_resp" size="35" onkeyup="empresa.nom_otr_resp.value=empresa.nom_otr_resp.value.toUpperCase();" value="<?php  $a=$_GET['id1'];  $a1=$cx->query("select nom_otr_resp from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["nom_otr_resp"]); }  ?>" />
                      </div>
                  </div></td>
                  <td  valign="middle"><div id="div21" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                    
                      <div align="center">
                        <input name="ced_otr_resp" type="text" class="Estilo4" id="ced_otr_resp" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select ced_otr_resp from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["ced_otr_resp"]); }  ?>"/>
                      </div>
                  </div></td>
                  <td  valign="middle"><div id="div22" style="padding-left:0px; padding-top:5px; padding-right:0px; padding-bottom:3px;">
                    
                      <div align="center">
                        <input name="tp_otr_resp" type="text" class="Estilo4" id="tp_otr_resp" onkeypress="return validar(event)" size="16" value="<?php    $a=$_GET['id1'];  $a1=$cx->query("select tp_otr_resp from empresa where cod_emp = $a");   while($row = $a1->fetch_assoc()) { printf("%s", $row["tp_otr_resp"]); }  ?>"/>
                        </div>
                  </div></td>
                  <td><input name="cargo_teso" type="text" class="Estilo4" id="cargo_teso" size="40" value='<?php echo $cargo_teso; ?>' /></td>
            <tr>
              <td colspan="4"></td>
              </tr>
            <tr>
              <td colspan="4"><?php
//-------
$sql = "select * from fecha";
$resultado = $cx->query($sql);
while($row = $resultado->fetch_assoc())
   {
printf(" <input name='ano' id='ano' type='hidden' value='%s' />", $row["ano"]);  
   }
//--------	
?></td>
            </tr>
            <tr>
              <td colspan="5"><div class="Estilo4" id="div30" style="padding-left:0px; padding-top:15px; padding-right:0px; padding-bottom:15px;">
                <div align="center">
                  <input name="Submit" type="submit" class="Estilo4" value="Modificar Empresa" />
                  </label>
                </div>
              </div></td>
            </tr>
            <tr>
              <td colspan="5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
                <div align="center"> Fecha de  esta Sesion: <br />
                    <strong>
                    <?php			
$sqlxx = "select * from fecha";
$resultadoxx = $cx->query($sqlxx);

while($rowxx = $resultadoxx->fetch_assoc())
   
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
                    </strong> <br />
                    <b>Usuario: </b><u><?php echo $_SESSION["login"];?></u> </div>
              </div></td>
            </tr>
          </table>
		</div>		</td>
        </tr>
    </table>
	</form>	
	<br />

	<div align="center">
	<div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
      <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
        <div align="center"><a href='../crear_empresa.php' target='_parent'>VOLVER</a> </div>
      </div>
    </div>
	</div>
	
	</td>
  </tr>
  <tr>
    <td width="200">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?php include('../config.php'); echo $nom_emp ?><br />
	    <?php echo $dir_tel ?><BR />
	    <?php echo $muni ?> <br />
	    <?php echo $email ?>	</div>
	</div>	</td>
    <td width="200">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="200">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
</body>
</html>
<?php
}
?>