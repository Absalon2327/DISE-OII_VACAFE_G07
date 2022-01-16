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
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_in_r_compras_b']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_f_r_compras_b']);
	    $cbcat = "";
	    $cbpro = "";
	    $idproveedor = "";
	    $cat_bov = "";

	    if (isset($_POST['categoria_r_compras_b'])) {
	    	$cbcat = "existe";
	    }else{
	    	$cbcat = "no_existe";
	    }
	    if (isset($_POST['proveedor_r_compras_b'])) {
	    	$cbpro = "existe";
	    }else{
	    	$cbpro = "no_existe";
	    }
	   

	    if (isset($_POST['proveedor_r_compras_b']) && ($cbcat == "no_existe")) {
	    	$idproveedor = $_POST['proveedor_r_compras_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
					WHERE
						tb_proveedor.int_idproveedor = $idproveedor
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['categoria_r_compras_b']) && ($cbpro == "no_existe")) {
	    	 $cat_bov = $_POST['categoria_r_compras_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
					WHERE
						tb_expediente.nva_tipo_bovino = '$cat_bov' 
						AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproveedor));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['proveedor_r_compras_b']) && isset($_POST['categoria_r_compras_b'])) {
			$idproveedor = $_POST['proveedor_r_compras_b'];
			$cat_bov = $_POST['categoria_r_compras_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
					WHERE
						tb_proveedor.int_idproveedor = $idproveedor 
						AND tb_expediente.nva_tipo_bovino = '$cat_bov' 
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$idproveedor,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();
	   		}
	    }else{
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_expediente ON tb_detalle_compra.int_idexpediente = tb_expediente.int_idexpediente 
					WHERE
						tb_detalle_compra.int_idexpediente != 'null' 
						AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproveedor));
	        	exit();
	   		}
	    }

	    

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_proveedor",
			"int_idproveedor"=>"nva_nom_proveedor"

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