<?
ini_set("session.gc_maxlifetime","7200");
session_start();
if(!session_is_registered("login"))
{
header("Location: ../login.php");
exit;
} else {
$formato = $_GET['nom'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>CONTAFACIL</title>
<script language="JavaScript" type="text/javascript" src="javas.js"></script>
<link rel="stylesheet" type="text/css" href="../css/jquery.autocomplete.css" />
<script type="text/javascript" src="../js/jquery.js"></script>
<script type='text/javascript' src='jquery.autocomplete.js'></script>
<link rel="stylesheet" type="text/css" href="../css/estilos.css" />

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
    .suggestionsBox {
        position: relative;
        left: 30px;
        margin: 0px 0px 0px 0px;
        width: 600px;
        background-color:#335194;
        -moz-border-radius: 7px;
        -webkit-border-radius: 7px;
        border: 2px solid #2AAAFF;  
        color: #fff;
        font-size: 10px;
    }
    
    .suggestionList {
        margin: 0px;
        padding: 0px;
    }
    
    .suggestionList li {
        
        margin: 0px 0px 3px 0px;
        padding: 3px;
        cursor: pointer;
    }
    
    .suggestionList li:hover {
        background-color:#659CD8;
    }
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
.Estilo8 {color: #FFFFFF}
</style>



<script> 
var par=false;
function parpadeo() {
	document.getElementById('txt').style.visibility= (par) ? 'visible' : 'hidden';
	par = !par;
}
</script>




<script> 
function validar(e) { 
    tecla = (document.all) ? e.keyCode : e.which;
    if (tecla==8 || tecla==46 || tecla =='') return true; //Tecla de retroceso (para poder borrar) 
    patron = /\d/; //ver nota 
    te = String.fromCharCode(tecla); 
    return patron.test(te);  
}  
</script>
<link type="text/css" rel="stylesheet" href="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="../dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<style type="text/css">
<!--
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
.Estilo12 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
-->
</style>


<!--muestra - oculta naturales -->
<SCRIPT language="javascript">
var fils =0;
function MostrarOcultar (objetoVisualizar) 
{
        if (document.all['naturales'].style.display=='none')
        {
        document.all['naturales'].style.display='';
        document.a.ter_nat.disabled=false;
        document.all['juridicos'].style.display='none';
        document.a.ter_jur.disabled=true;
        }
        else 
        {
        document.a.ter_nat.disabled=true;
        document.a.ter_jur.disabled=true;
        document.all['naturales'].style.display='none';
        document.all['juridicos'].style.display='none';
        }
}
</SCRIPT>
<!--muestra - oculta juridicos -->
<SCRIPT language="javascript">
function MostrarOcultar2 (objetoVisualizar) 
{
    
        if (document.all['juridicos'].style.display=='none') 
        {
        document.all['naturales'].style.display='none';
        document.a.ter_nat.disabled=true;
        document.all['juridicos'].style.display='';
        document.a.ter_jur.disabled=false;
        }
        else 
        {
        document.a.ter_nat.disabled=true;
        document.a.ter_jur.disabled=true;
        document.all['naturales'].style.display='none';
        document.all['juridicos'].style.display='none';
        }
}
</SCRIPT>  
<!--validacion de forms-->
<script type="text/javascript" src="../jquery.validate.js"></script>
<style type="text/css">
* { font-family: Verdana; font-size: 10px; }
label { width: 10em; float: left; }
label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
p { clear: both; }
.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
.Estilo10 {
    color: #990000;
    font-style: italic;
}
.Estilo14 {color: #0000CC}
.Estilo15 {color: #0000FF}
.Estilo41 {font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: 10px; color: #333333; }
</style>

<script>
$(document).ready(function(){
$("#commentForm").validate();
});
function chk_rcgt(){
var pos_url = '../comprobadores/comprueba_rcgt.php';
var cod = document.getElementById('id_manu_rcgt').value;
var req = new XMLHttpRequest();
if (req) {
req.onreadystatechange = function() {
if (req.readyState == 4 ) {
document.getElementById('res_rcgt').innerHTML = req.responseText;
}
}
req.open('GET', pos_url +'?cod='+cod,false);
req.send(null);
}
}

function consecutivo2()
{
var fec = document.getElementById('fecha_recaudo').value;
var pos_url2 = 'consultas/concec_nota.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				var elem = dato.split(',');
				concec = elem[0];
				fecha2 = elem[1];
				document.getElementById('id_manu_rcgt').value =concec;
				if (fec != fecha2)
				{
				alert ("Fecha sugerida para el consecutivo disponible: "+fecha2);
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+fec,false);
	req1.send(null);
	}
document.getElementById('tercero').focus();
}

function mostrarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
	var x =screen.width;
    ventana.style.marginTop = "200px"; // Definimos su posici???n vertical. La ponemos fija para simplificar el c???digo
    ventana.style.marginLeft = x-300;//((document.body.clientWidth-10) / 2) +  "px"; // Definimos su posici???n horizontal
    ventana.style.display = ''; // Y lo hacemos visible
	parent.frames['datamain'].window.location.reload();

}

function ocultarVentana()
{
    var ventana = document.getElementById('miVentana'); // Accedemos al contenedor
    ventana.style.display = 'none'; // Y lo hacemos invisible
}


function Puntero()
{
	document.body.style.cursor="Pointer";
}

function PunteroNormal()
{
	document.body.style.cursor="Default";
}

//*************TABLA AUTO ************

var contLin=1;
function tabla_ini()
{
	agregar();
	agregar();
}


function agregar()
 {
	fila = document.all.tablaf.rows.length - 1;
	if(fila<2000)
	{
	var tr, td;
	//var v1=document.getElementById('retefuente').value;
	//var v2=document.getElementById('reteiva').value;
	//var v55=document.getElementById('id_obcg').value;
	var tab = 100+contLin;
	tr = document.all.tablaf.insertRow();
	tr.id = 'fil_'+contLin; 
	td = tr.insertCell();
	td.innerHTML =" <input type='text' size='15' style='text-align:left' id='pgcp"+contLin+"' name='pgcp"+contLin+"' onkeyup='lookup(this.value,"+contLin+");' onkeydown='displaycode(event,id);' onkeypress='return validar(event)' value='' alt='2' > <div class='suggestionsBox' id='sugges"+contLin+"' style='display: none; position:absolute; left: 130px;'><img src='../simbolos/upArrow.png' style='position: relative; top: -10px; left: 0px;' title='PGCP'> <div class='suggestionList' id='autoSug"+contLin+"' align=left> &nbsp;  </div></div> <input type='hidden' name='id_"+contLin+"' id='id_"+contLin+"' value=''> ";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='35' style='text-align:left' name='des"+contLin+"' id='des"+contLin+"' value='' readonly >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='15' style='text-align:right' name='vr_deb_"+contLin+"' id='vr_deb_" + contLin + "' value=0   onKeyUp='suma_tab();' onkeypress='return validar(event)' onkeydown='displaycode(event,id);' onblur='formato(id,value);' onfocus='siespgcp("+contLin+"); vaciar(id)'  alt='2' >";
	
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='15' style='text-align:right' name='vr_cre_" + contLin + "' id='vr_cre_" + contLin + "' value=0  onKeyUp='suma_tab();' onkeypress='return validar(event)'  onkeydown='displaycode(event,id);' onblur='formato(id,value);' alt='2' onfocus='vaciar(id);'>";
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='15' style='text-align:left' name='cheque"+contLin+"' id='cheque"+contLin+"' value='' alt='2' onkeydown='displaycode(event,id);'>";
	td = tr.insertCell();
	td.innerHTML = "<input type='text' size='15' style='text-align:left' name='termov_"+contLin+"' id='termov"+contLin+"' value=''  onDblClick='select_ter(id)' >" ;


	document.getElementById("contis").value=contLin;
	contLin++;
	 }
$().ready(function() {
		var k =14;	
		 $(":input").each(function (i) {
			   var value = this.alt;
			  if (value ==2)
			  {
			  $(this).attr('tabindex', k + 1);
			  k++;
			  }
		 });
})
}

function act_desc()
{
	//alert ("hola");
}


function borrarUltima() 
{
	
	ultima = document.all.tablaf.rows.length - 1;
	//alert (ultima);
	if(ultima >=0)
	{
		document.all.tablaf.deleteRow(ultima);
		contLin--;
		document.getElementById("contis").value=contLin-1;
	}
}


//***********************************


function generar_movimiento()
{ 
		var vacio = valorVacio();
		if (vacio != 1)
		{
		var j =0;
		var k=0;
		filas = document.getElementById('filas').value;
		var ul = document.all.tablaf.rows.length - 1;
		var suma =0;
		for (var i=0;i<=ul;i++)
		{
			borrarUltima();
		}
		for (j=1;j<=9;j++)
		{
			var conta =document.getElementById('conta_'+j).value.replace(/\,/g,'');
			if (conta >0)
			{
			k++;
			agregar();
			// consulta el codigo y lo escribe en el input
			var pos_url2 = 'consultas/con_cca.php';
			var req1 = new XMLHttpRequest();	
			if (req1)
			{																	
				req1.onreadystatechange = function() 
				{
					if (req1.readyState == 4 ) 
					{
						var dato = req1.responseText;
						var elem = dato.split(',');
						document.getElementById("pgcp"+k).value=elem[0];
						document.getElementById("des"+k).value=elem[1];
						document.getElementById("vr_cre_"+k).value=document.getElementById("conta_"+j).value;
						suma += parseInt(document.getElementById("conta_"+j).value.replace(/\,/g,''));
					}
				}
				req1.open('POST', pos_url2 +'?cod='+j,false);
				req1.send(null);
			}
			} // end if mayor a cero
		}// end for
		k++;
		agregar();
		document.getElementById("pgcp"+k).value='1110';
		document.getElementById("vr_deb_"+k).value=formatea(suma);
		suma_tab();
		}
document.getElementById('movim').value=1;
}

function suma_tab()
{
 	filas = document.all.tablaf.rows.length;	
	sum_deb=0;
	sum_cre=0;
	for(var i=1; i<=filas;i++)
	{ 
	     sum_deb=sum_deb+parseFloat(document.getElementById("vr_deb_"+i).value.replace(/\,/g,''));
		 sum_cre=sum_cre+parseFloat(document.getElementById("vr_cre_"+i).value.replace(/\,/g,''));
	}
	total=sum_deb-sum_cre;
	document.getElementById("tot_deb_a").value=formatea(Math.round(sum_deb*100)/100);
	document.getElementById("tot_cre_a").value=formatea(Math.round(sum_cre*100)/100);
	document.getElementById("total").value=(Math.round(total*100)/100);
	act_desc();
	copied();
}

function valorVacio()
{
	var k =0;
	filas = document.getElementById('filas').value;	
	for (k=1;k<=filas;k++)
	{
		if (document.getElementById("valor_"+k).value=='')
		{
			alert("El campo no puede estar vacio...");
			document.getElementById("valor_"+k).select();
			return 1;
		}
		
	}
	
}

function mas_inputs()
{
var vari=document.getElementById('filas').value;
	if (vari >=20) 
	{
		vari =20;
	}else{
		varix =parseFloat(vari)+1;
		document.getElementById('filas').value = varix;
		var mostrar = 'inputx'+varix;
		document.getElementById(mostrar).style.display="";
	}
}

function menos_inputs()
{
	vari2=document.getElementById('filas').value;
	if (vari2 >1) 
	{
		vari2 =parseFloat(vari2);
		document.getElementById('filas').value = vari2-1;		// envio el valor de las filas actuales al input para enviar tama???o al post 
		var mostrar = 'inputx'+vari2;
		document.getElementById(mostrar).style.display="none";
		document.getElementById('course_'+vari2).value ='';
		document.getElementById('valcourse_'+vari2).value ='';
		document.getElementById('valor_'+vari2).value ='';
		}
}

$().ready(function() {
	$("[id*=course_]").autocomplete("cuentas.php", {
		width: 600,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#course").result(function(event, data, formatted) {
		$("#valcourse_1").val(data[1]);
	});
});
</script>
<script>
function tipo_cuenta(id)
{
var llega =id.split("_");
var cuenta = document.getElementById('valcourse_'+llega[1]).value;
if (cuenta=='')
{
alert("La cuenta no puede estar vacia...");
document.getElementById('course_'+llega[1]).select();
}
var pos_url2 = 'consultas/tipo_cuenta.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				var dato = req1.responseText;
				if (dato =='M')
				{
					alert("La cuenta seleccionada no es de detalle...");
					document.getElementById('course_'+llega[1]).select();
					return false;
				}
			}
		}
	req1.open('POST', pos_url2 +'?cod='+cuenta,false);
	req1.send(null);
	}
}

function validaForm(valf)
{
	 
	// valida fecha
	var fecha = document.getElementById('fecha_recaudo').value;
	if (fecha =='')
	{
		alert ("El campo fecha no debe estar vacio...");
		document.getElementById('fecha_recaudo').select();
		return false;	
	}
	var num = document.getElementById('id_manu_rcgt').value;
	if (num =='')
	{
		alert ("El n???mero no debe estar vacio...");
		document.getElementById('id_manu_rcgt').select();
		return false;	
	}
	var ter = document.getElementById('tercero').value;
	if (ter =='')
	{
		alert ("El campo tercero no debe estar vacio...");
		document.getElementById('tercero').select();
		return false;	
	}
	var des = document.getElementById('des_recaudo').value;
	if (des =='')
	{
		alert ("El campo detalle no debe estar vacio...");
		document.getElementById('des_recaudo').select();
		return false;	
	}
	var filcot = document.getElementById('contis').value;
	if (filcot ==0)
	{
		alert ("El registro no tiene movimieto contable...");
		return false;	
	}
	//
	var t =0;
	for (t=1;t<=filcot;t++)
	{
		var cuen = document.getElementById("pgcp"+t).value;
		if (cuen =='1110')
		{
			alert("Debe seleccionar una cuenta de banco valida...");	
			document.getElementById("pgcp"+t).select();
			return false;
			break;
		}
		if (cuen =='')
		{
			alert("La cuenta contable no debe estar vacia...");	
			document.getElementById("pgcp"+t).select();
			return false;
			break;
		}
	} 
	var total =document.getElementById('total').value;
	if (total != 0 || total !=0.00)
	{
			alert("Las sumas del movimiento contable no son iguales...");	
			document.getElementById("total").select();
			return false;

	}

	document.forms(valf).submit();
}

function select_ter(id)
{
	
	var ter = document.getElementById('course_').value;
	var elem = ter.split('-');
	var texto = elem[0].replace(/ /g, '');
	document.getElementById(id).value=texto;
}


$().ready(function() {
	$("[id*=course_]").autocomplete("terceros.php", {
		width: 600,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#course").result(function(event, data, formatted) {
		$("#tercerom").val(data[1]);
	});
});

function sumac(id)
{
var i=0;
var resl =0;
var campo = document.getElementById(id).value;
var valores = campo.split('+');
for (i=0;i<valores.length;i++)
{
	 resl += parseInt(valores[i].replace(/\,/g,''));
}
document.getElementById(id).value=formatea(resl);

}



function vaciar(id)
{
var dato = document.getElementById(id).value;
if (dato ==0)
document.getElementById(id).select();
}

function procesar_reporte()
{
	var i=0; var j=0; var k =0;
	var datos =0;
	var cuentas ='';
	var filas = document.getElementById('filas').value;
	for(j=0;j<filas;j++)
	{
		menos_inputs();	
	}
	for (i=1;i<=9;i++)
	{
		datos = document.getElementById('press_'+i).value.replace(/\,/g,'');
		if (datos > 0) 
		{
			k++;
			if (k >1) mas_inputs()	;
			// llenar inputs
			cuentas = cuenta_press(i);
			valores = cuentas.split(',');
			document.getElementById('course_'+k).value=valores[0]+ ' - '+ valores[1];
			document.getElementById('valcourse_'+k).value=valores[0];
			document.getElementById('valor_'+k).value=document.getElementById('press_'+i).value;
		}
	}
document.getElementById('pgcp1').select();
}

function cuenta_press(id)
{
var dato='';
var pos_url2 = 'consultas/cca_predial.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				 dato = req1.responseText;
				
			}
		}
	
	req1.open('POST', pos_url2 +'?cod='+id,false);
	req1.send(null);
	}
	 return dato;	
}

function copied()
{
	var s=0;
	var campos ='';
		var filas = document.getElementById('contis').value;
		for (s=1;s<=filas;s++)
		{
			campos += document.getElementById('pgcp'+s).value + "," + document.getElementById('vr_deb_'+s).value.replace(/\,/g,'') + "," + document.getElementById('vr_cre_'+s).value.replace(/\,/g,'') + "\n";
		}	
	if (window.clipboardData){ 	
		window.clipboardData.setData ("Text", campos);
	}
}

function pegar ()
{
	var datos = window.clipboardData.getData ("Text");
	var campos = datos.split("\n");
	var filas = campos.length;
	var filas3= document.getElementById('contis').value;
	var j=0;
	var n=0;
	for(j=0;j<=filas3;j++)
	{
		borrarUltima();
	}
	var a = 0;
	for(a=1;a<filas;a++)
	{
		agregar();	
		var resul = campos[n].split(",");
		document.getElementById('pgcp'+a).value=resul[0];
		document.getElementById('vr_deb_'+a).focus();
		document.getElementById('vr_deb_'+a).value=resul[1];
		document.getElementById('vr_cre_'+a).value=resul[2];
		
		n++;
	}
	document.getElementById('vr_deb_1').focus();
}

function displaycode(evt,camp)
 {
	 var charCode = (evt.which) ? evt.which : event.keyCode;
	 //alert(charCode);
	 if (charCode == 107) agregar();
	 if (charCode == 109) borrarUltima();
     var fil = camp.split("_");
	 if  (charCode ==114 && fil[1]=='cre')
	 {
		document.getElementById('pgcp'+fil[2]).value=0;
		document.getElementById('vr_deb_'+fil[2]).value=0;
		document.getElementById('vr_cre_'+fil[2]).value=0;
		document.getElementById('cheque'+fil[2]).value='';
		document.getElementById('fil_'+fil[2]).style.display='none';
		suma_tab();	 
	 }
	 
	 if (charCode == 119)
	 {
		pegar ();
		suma_tab();
	 }
	 
	
	 if (charCode == 120 || charCode == 16 )
	 {
		var pgcp = camp.substring(0,4);
		var largo = camp.length;
		if (pgcp =='pgcp')
		{
			if (largo ==5)
			{
				var campo = camp.substring(0,camp.length-1);
				var linea = parseInt(camp.substring(camp.length-1,camp.length));
				var linea_ant = linea-1;
				document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				document.getElementById('vr_deb_'+linea).select();
			}
			if (largo ==6)
			{
				var campo = camp.substring(0,camp.length-2);
				var linea = parseInt(camp.substring(camp.length-2,camp.length));
				var linea_ant = linea-1;
				document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				document.getElementById('vr_deb_'+linea).select();
			}
			if (largo ==7)
			{
				var campo = camp.substring(0,camp.length-3);
				var linea = parseInt(camp.substring(camp.length-3,camp.length));
				var linea_ant = linea-1;
				document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				document.getElementById('vr_deb_'+linea).select();
			}
		}
		var valores = camp.substring(0,7);
		if (valores == 'vr_deb_' || valores == 'vr_cre_')
			{
				if (largo==8)
				{
				var campo = camp.substring(0,camp.length-1);
				var linea = parseInt(camp.substring(camp.length-1,camp.length));
				var linea_ant = linea-1;
				document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				}
				if (largo ==9)
				{
					var campo = camp.substring(0,camp.length-2);
					var linea = parseInt(camp.substring(camp.length-2,camp.length));
					var linea_ant = linea-1;
					document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				}
				if (largo ==10)
				{
					var campo = camp.substring(0,camp.length-3);
					var linea = parseInt(camp.substring(camp.length-3,camp.length));
					var linea_ant = linea-1;
					document.getElementById(campo+linea).value=	document.getElementById(campo+linea_ant).value;	
				}
			}	
	 }
	 if (charCode == 39)
	 {
		var tabx = document.getElementById(camp).tabIndex;
		var nextab =tabx+1;
 		$('input[tabindex='+nextab+']').select();
	 }
 	 if (charCode == 37)
	 {
		var tabx = document.getElementById(camp).tabIndex;
		var nextab =tabx-1;
 		$('input[tabindex='+nextab+']').select();
	 }
	 if (charCode == 40)
	 {
		var tabx = document.getElementById(camp).tabIndex;
		var nextab =tabx+3;
 		$('input[tabindex='+nextab+']').select();
	 }
 	 if (charCode == 38)
	 {
		var tabx = document.getElementById(camp).tabIndex;
 		$('input[tabindex='+nextab+']').select();
	 }


 }

$().ready(function() {
	$("#tercero").autocomplete("terceros.php", {
		width: 500,
		matchContains: true,
		mustMatch: true,
		//minChars: 0,
		//multiple: true,
		//highlight: false,
		//multipleSeparator: ",",
		selectFirst: false
	});
	$("#tercero").result(function(event, data, formatted) {
		$("#valtercero").val(data[1]);
	});
});

function formatea(valor)
{
	var valor = valor.toString();
	var num = valor.replace(/\,/g,'');
	if(!isNaN(num)){
		num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1,');
		num = num.split('').reverse().join('').replace(/^[\,]/,'');
		return num;
	}
}

// asigono tabindex a tdos los que tengan title 1
$().ready(function() {
		var k =0;	
		 $(":input").each(function (i) {
			   var value = this.alt;
			  if (value ==1)
			  {
			  $(this).attr('tabindex', k + 1);
			  k++;
			  }
		 });
})

$().ready(function() {
	$("input").keyup(function (e) {
	var letra = e.which;
	var campo =this.id;
	if (letra == 40 && campo != 'tercero')
	{	
     var tabx = this.tabIndex;
	 var nextab =tabx+1;
	$('input[tabindex='+nextab+']').select();
	}
	if (letra == 38 && campo != 'tercero')
	{	
     var tabx = this.tabIndex;
	 var nextab =tabx-1;
	$('input[tabindex='+nextab+']').select();
	}
 }).keypress();
})

function formato(id,val)
{
document.getElementById(id).value=formatea(val);
}

function entrada()
{
var i=0;j=0;k=5;h=0;
	var cpgcp = pgcp();
	
	var cpgcp2 =cpgcp.split(",");
	var f = (cpgcp2.length/5)-1;
	var cg =cpgcp2.length/5;
	for (h=1;h<=f;h++)
		{
			agregar();
			var cuenta = cpgcp2[h].split("_");
			document.getElementById('pgcp'+h).value=cuenta[0];
			document.getElementById('vr_deb_'+h).value=formatea(parseInt(cpgcp2[h+cg]));
			document.getElementById('vr_cre_'+h).value=formatea(parseInt(cpgcp2[h+cg*2]));
			document.getElementById('cheque'+h).value=cpgcp2[h+cg*3];
			document.getElementById('termov'+h).value=cpgcp2[h+cg*4];
			document.getElementById('id_'+h).value=cuenta[1];
			document.getElementById('vr_deb_'+h).focus();
		}
	suma_tab();
	consecutivo2();

}

function pgcp()
{
var reg =document.getElementById('consec_ncbt').value;
var dato='';
var pos_url2 = 'consultas/conta_pgcp.php';	
var req1 = new XMLHttpRequest();	
	if (req1)
	{																	
		req1.onreadystatechange = function() 
		{
			if (req1.readyState == 4 ) 
			{
				 dato = req1.responseText;
				
			}
		}
	
	req1.open('POST', pos_url2 +'?cod='+reg,false);
	req1.send(null);
	}
	 return dato;	
}



</script>

<!--fin val forms--> 

</head>

<body onload="entrada();">
<?php
include('../config.php');		
$id = $_GET['id1'];
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
 
$sq2= "select * from lib_aux2 where id_auto ='$id'";
$rs2= mysql_query($sq2);
$rw2 =mysql_fetch_array($rs2);
$filas =mysql_num_rows($rs2);
$id_manu_rcgt = substr($rw2['dcto'],4);
 ?>
<script>
var fils = "<?php echo $filas; ?>" ;
</script>
 
 <br />
 <form name="forma" method="post" id="forma" action="proc_rcgt.php">
              <input name="consec_ncbt" type="hidden" id="consec_ncbt" value="<? printf("%s",$id);?>"   />

<table width="1000" border="0" align="center">
  <tr>
    
    <td colspan="3">
	<div class="Estilo2" id="main_div" style="padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px;">
	  <div align="center">
	  <img src="../images/PLANTILLA PNG PARA BANNER COMUN.png" width="585" height="100" />	  </div>
	</div>	</td>
  </tr>
  
  <tr>
    <td colspan="3">
	<div style="padding-left:10px; padding-top:30px; padding-right:10px; padding-bottom:10px;">
      <div align="center" class="Estilo4"><strong><?php echo $formato; ?></strong>
        <?



// extraer datos
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $id_emp=$rowxx["id_emp"];
  $ano=$rowxx["ano"];
}		
$num_filas =1;

include('../objetos/incrementar_fecha.php');  
   $fecha_ncon = incrementa_mes($rw2['fecha']);
?>
      </div>
	</div>	</td>
  </tr>
  
 
  <tr>
  <td colspan="3">
 
  
	<table width="1000" border="1" align="center" class="bordepunteado1">
      <tr>
        <td width="178"></td>
        <td width="164"></td>
        <td width="143"></td>
        <td width="285"></td>
      </tr>
     
      <tr>
        <td colspan="4" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>REGISTRE LA INFORMACION REQUERIDA </strong></div>
        </div></td>
      </tr>
            <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Fecha del RCGT</strong></div>
          </div>
        </div></td>
        <td colspan="2"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          
            <div align="center">
              <input name="fecha_recaudo" type="text" class="required Estilo4" id="fecha_recaudo" value="<? printf("%s",$fecha_ncon);?>" size="12" alt="1" />
              <span class="Estilo8">:::</span>
              <input name="button2" type="button" class="Estilo4" onclick="displayCalendar(document.forms[0].fecha_recaudo,'yyyy/mm/dd',this)" value="Seleccione Fecha" />
              </div>
        </div></td>
        <td><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center">
            <strong>Consecutivo</strong>:
            <input name="id_manu_rcgt" type="text" class="required Estilo12" id="id_manu_rcgt" size="20" onkeypress="return validar(event)" style="text-align:center" onkeyup="chk_rcgt();" alt="1"  />
            <a href="javascript:mostrarVentana();">Mas</a>
            <div id="miVentana" style="position: fixed; width: 210px; height: 330px; top: 0; left: 0; font-family:Verdana,
                    Arial, Helvetica, sans-serif; font-size: 12px; font-weight: normal; border: #333333 
                     3px solid; background-color: #FAFAFA; color: #000000; display:none;">
              <div style="font-weight: bold; text-align: center; color: #FFFFFF; padding: 5px; background-color:#006394">
                <table border="0" width="100%">
                  <tr>
                    <td>Consecutivos del Documento</td>
                    <td align="right"><img src="../simbolos/cerrar.png"  width="15" border="0"
                                 onclick="ocultarVentana();" onmouseover="Puntero();" onmouseout="PunteroNormal();" /></td>
                  </tr>
                </table>
              </div>
              <iframe id="datamain" src="rcgtconsecutivo.php"  width="200" height="290" marginwidth="0" 
                               marginheight="1" hspace="0" vspace="0" frameborder="0" scrolling="si"> </iframe>
            </div>
            <div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
              <div class="Estilo41" align="center" id='res_rcgt'></div>
            </div>
          </div>
        </div></td>
      </tr>

      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="right"><strong>Tercero</strong></div>
          </div>
        </div></td>
        <td colspan="3" bgcolor="#FFFFFF"><div style="padding-left:10px; padding-top:5px; padding-right:0px; padding-bottom:5px;">
          		<input type='text' name='tercero' class='Estilo4' id='tercero' size='70' alt="1" value="<?php echo $rw2['ccnit']."-".$rw2['tercero']; ?> " /> &nbsp;<a href="../terceros/terceros.php" target="_new">Nuevo</a>
                <input type='hidden' name='valtercero' id='valtercero' value="<?php echo $rw2['ccnit']; ?>" /></div> </td>

        </tr>
      
      
      <tr>
        <td bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">
              <div align="right"><strong>Detalle del Recibo</strong></div>
            </div>
        </div></td>
        <td colspan="3"><div style="padding-left:10px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
            <div align="center" class="Estilo4">

                  <div align="left">
                    <input name="des_recaudo" type="text" class="required Estilo4" id="des_recaudo"  size="110" alt="1" value="<?php echo $rw2['detalle']; ?>" />
                    </div>
            </div></div></td>
      </tr>
      
      <tr>
        <td width="178"></td>
        <td width="164"></td>
        <td width="143"></td>
        <td width="285"></td>
      </tr>
    </table>
	<br />
    
    
	</td>
  </tr>
  <tr>
    <td colspan="3">
	<table width="100%" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan="6" bgcolor="#FFFFFF"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4">
            <div align="center"><strong>IMPORTANTE</strong><br />
                <br />
              Si la cuenta que desea utilizar no aparece en el listado de CUENTAS P.G.C.P, posiblemente se encuentra BLOQUEADA. <br />
              Consulte el Item 4.2 del Menu Principal - Opcion &quot;Maestro P.G.C.P &quot; </div>
          </div>
      </div></td>
    </tr>
    <tr>
      <td colspan="6" bgcolor="#DCE9E5"><div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center" class="Estilo4"><strong>MOVIMIENTO CONTABLE
          <input type="hidden" name='contador' value='0' id="contador"><br>
          <input name="generar" type="button" value="Generar movimiento" onclick="generar_movimiento();"/>
          <br>
          <img src="../simbolos/mas.png" alt="" title="Agregar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='agregar();'>
          &nbsp;
          <!--span id='contis' class='Estilo4'>0</span-->
          <input type="text" name='contis' id="contis" style="background:#DCE9E5 ; color:#333; border:hidden; text-align:center" size="4" >
            <input type="hidden" name='movim' id="movim" value="0"  >
          &nbsp;
          <img src="../simbolos/menos.png" alt="" title="Quitar Fila" width="20" height="20" border="0" style='cursor: pointer'; onclick='borrarUltima();'>
          </strong></div>
      </div></td>
    </tr>
    <tr>
      <td width="14%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>CUENTA P.G.C.P </strong></div>
      </div></td>
      <td width="29%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>NOMBRE DE LA CUENTA</strong><strong></strong> </div>
      </div></td>
      <td width="14%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR DEBITO </strong></div>
      </div></td>
      <td width="14%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
          <div align="center" class="Estilo4"><strong>VALOR CREDITO </strong></div>
      </div></td>
       <td width="14%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
         <div align="center" class="Estilo4"><strong>REFERENCIA  </strong></div>
      </div></td>
       <td width="15%" bgcolor="#F5F5F5"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
         <div align="center" class="Estilo4"><strong>TERCERO  </strong></div>
      </div></td>
    </tr>
    
    </table>
    <!--table width="800" border="1" align="center" class="bordepunteado1"-->
    <table width="1000" border="1" id="tablaf" align="center" class="bordepunteado1">   
 
    </table>
    
     <!--/table-->
    <table width="1000" border="1" align="center" class="bordepunteado1">
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>VERIFIQUE QUE LAS SUMAS SEAN IGUALES ANTES DE GRABAR: </strong></div>
      </div></td>
      <td bgcolor="#990000" width="130"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_deb_a" type="text" class="Estilo12" id="tot_deb_a" style="text-align:right" value="0.00" disabled="disabled" >
          </div>
        </div>
      </div></td>
      <td bgcolor="#990000" width="134"><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="right">
            <input name="tot_cre_a" type="text" class="Estilo12" id="tot_cre_a" style="text-align:right" value="0.00" disabled="disabled" >
          </div>
        </div>
      </div></td>
	  

	  
	  
    </tr>
    <tr>
      <td colspan=2 bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
        <div align="right" class="Estilo8"><strong>DIFERENCIA: </strong></div>
      </div></td>
      <td bgcolor="#990000" colspan=2><div class="Estilo8" style="padding-left:5px; padding-top:3px; padding-right:5px; padding-bottom:3px;">
        <div align="center" class="Estilo12">
          <div align="center">
            <input name="total" type="text" class="Estilo12" id="total" style="text-align:right" value="0.00" onkeyup='Calcular();'>
          </div>
        </div>
      </div></td>

    </tr>
    <tr>
      <td colspan="4" bgcolor="#990000"><div class="Estilo12 Estilo8" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="right" class="Estilo8">
            <div align="center"><strong>VERIFIQUE FECHA, CONSECUTIVO, TERCERO Y DETALLE ANTES DE GRABAR</strong></div>
          </div>
      </div></td>

      </tr>
    <tr>
        <td colspan="4"><div class="Estilo12" style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:10px;">
          <div align="center"> Buscar Tercero :&nbsp;<input type='text' name='course_' class='Estilo4' id='course_' size='35' value="" />
							<input type='hidden' name='tercerom' id='tercerom' /><br /><br />
            
            <span class="Estilo8">:::</span>
            <input name="submit0" type="submit"  id="btn2" class="Estilo12"  value="Guardar formulario" onclick="return validaForm(form)" />
          </div>
        </div></td>
      </tr>
      <!--secciones de fila -->
      <!--secciones de fila -->
    </table></td>
  </tr>


<?
/*}*/
?>  
  
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">
	<div style="padding-left:5px; padding-top:10px; padding-right:5px; padding-bottom:5px;">
	  <div align="center">
	  
        <div style='padding-left:3px; padding-top:3px; padding-right:3px; padding-bottom:3px; background:#004080; width:150px'>
          <div style='padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px; background:#FFFFFF'>
            <div align="center"><a href='../mvto_contable/menu_cont.php?a=NCON&nn=NCON' target='_parent'>VOLVER </a> </div>
          </div>
        </div>
	    </div>
	</div>	</td>
  </tr>
  <tr>
    <td colspan="3"><div style="padding-left:5px; padding-top:5px; padding-right:5px; padding-bottom:5px;">
      <div align="center"> <span class="Estilo4">Fecha de  esta Sesion:</span> <br />
          <span class="Estilo4"> <strong>
          <? include('../config.php');				
$cx = new mysqli($server, $dbuser, $dbpass, $database) or die ("Fallo en la Conexion a la Base de Datos");
$sqlxx = "select * from fecha";
$resultadoxx = mysql_db_query($database, $sqlxx, $cx);

while($rowxx = mysql_fetch_array($resultadoxx)) 
{
  $ano=$rowxx["ano"];
}
echo $ano;
?>
          </strong> </span> <br />
          <span class="Estilo4"><b>Usuario: </b><u><? echo $_SESSION["login"];?></u> </span> </div>
    </div></td>
  </tr>
  <tr>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><?PHP include('../config.php'); echo $nom_emp ?><br />
	    <?PHP echo $dir_tel ?><BR />
	    <?PHP echo $muni ?> <br />
	    <?PHP echo $email?>	</div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:3px;">
	  <div align="center"><a href="../../politicas.php" target="_blank">POLITICAS DE PRIVACIDAD <BR />
	      </a><BR /> 
        <a href="../../condiciones.php" target="_blank">CONDICIONES DE USO	</a></div>
	</div>	</td>
    <td width="266">
	<div class="Estilo7" id="main_div" style="padding-left:3px; padding-top:5px; padding-right:3px; padding-bottom:15px;">
	  <div align="center">Desarrollado por <br />
	    <a href="http://www.qualisoftsalud.com" target="_blank"><img src="../images/logoqsft2.png" width="150" height="69" border="0" /></a><br />
	  Derechos Reservados - 2009	</div>
	</div>	</td>
  </tr>
</table>
  </form>
<script>
document.getElementById("tercero").focus();
</script>

</body>
</html>






<?
}
?>