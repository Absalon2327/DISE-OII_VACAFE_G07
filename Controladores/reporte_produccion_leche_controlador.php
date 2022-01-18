<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	//require_once("../reportes/r_reporte_proveedor_compras.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte']) && $_POST['generar_reporte']=="si_generar") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_in_r_leche_pro']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_f_r_leche_pro']);
	    $idproducto = $_POST['producto_r_leche'];

			    $sql = "SELECT * FROM tb_botellas
			INNER JOIN tb_producto ON tb_botellas.int_idproducto = tb_producto.int_idproducto
			WHERE dat_fecha_vencimiento_botella >= '$fecha_inicio' AND dat_fecha_vencimiento_botella <= '$fecha_fin' 
			AND tb_botellas.int_idproducto = '$idproducto'";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito",$fecha_inicio,$fecha_fin,$idproducto));
        	exit();

   		}else{
   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproducto,$result));
        	exit();
   		}

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_producto",
			"int_idproducto"=>"nva_nom_producto"
		);
		 $where = "WHERE int_idcategoria = 1 AND nva_estado_producto = 'Activo'";
		$result_select = $modelo->crear_select($array_select, $where);	
		if ($result_select[4] >= 1) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else {
        	print json_encode(array("Error",$result_select));
			exit();
        }
	}



?>