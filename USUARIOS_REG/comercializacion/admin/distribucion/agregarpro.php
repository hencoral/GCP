<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate"); 
include ('../../config.php');
$cx = mysql_connect($server,$dbuser,$dbpass);

// recibo variables del formulario
		$id = $_GET["id"]; 
		$fecha = $_GET["fecha"]; 
		$bodega = $_GET["bodega"];
		$tipo_art = $_GET["tipo_art"];
		$concepto = $_GET["concepto"]; 
		$factura = $_GET["acta"]; 
		$codigo = $_GET["codigo"];
		$barras = $_GET["barras"];
		$lote = $_GET["lote"];
		$fecha_ven = $_GET["fecha_ven"];
		$cant = str_replace(',','',$_GET['cant']);
		$cc = str_replace(',','',$_GET['cc']);
		$venta = str_replace(',','',$_GET['venta']);
		$Invima = $_GET["Invima"];
		$log = date('d/m/Y g:ia');
		
		if ($id =='')
		{
		// Inserta articulo en listado
		$sql4 ="insert into farm_kardex (tipo_mov,fecha,tipo_art,bodega,doc_ref,doc_num,cod_barras,cod_int,salida,fecha_ven,lote,invima,valor,pedido,user,cc,venta,log) values('DTR','$fecha','$tip_art','$bodega','5','$factura','$barras','$codigo','$cant','$fecha_ven','$lote','$Invima','$venta','$pedido','$_SESSION[user]','$cc','$venta','$log')";
		$re14 = mysql_query($sql4);	
		}else{
		$sq5="
				UPDATE `farm_kardex` SET 
				`fecha` = '$fecha',
				`bodega` = '$bodega',
				`doc_num` = '$factura',
				`cod_barras` = '$barras',
				`cod_int` = '$codigo',
				`entrada` = '$cant',
				`fecha_ven` = '$fecha_ven',
				`lote` = '$lote',
				`invima` = '$Invima',
				`valor` = '$compra',
				`user` = '$_SESSION[user]',
				`venta` = '$venta' 
				WHERE `id` ='$id' ;
				";	
		$re5 = mysql_query($sq5);	
		}
// Archivo a mostar desùes de guardar
		echo "<script>	cargaArchivo('admin/distribucion/reporte.php?factura=$factura','reporte');</script>	";	
		echo "<script> document.getElementById('acta').select(); </script>";
?>
