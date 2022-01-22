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
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_inicio_r_cate']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_fin_r_producto']);
	    $idcategoria = $_POST['producto_r_cate'];

			    $sql = "SELECT * FROM tb_producto
			INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
			WHERE dat_fecha_vencimiento >= '$fecha_inicio' AND dat_fecha_vencimiento <= '$fecha_fin' 
			AND tb_producto.int_idcategoria = '$idcategoria'";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito",$fecha_inicio,$fecha_fin,$idcategoria));
        	exit();

   		}else{
   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idcategoria,$result));
        	exit();
   		}

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_categoria",
			"int_idcategoria"=>"nva_nom_categoria"

		);
		 
		$result_select = $modelo->crear_select($array_select);	
		if ($result_select[4] >= 1) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else {
        	print json_encode(array("Error",$result_select));
			exit();
        }
	}



?>