<?php 
	session_start();
	date_default_timezone_set('America/El_Salvador');
	require_once("../Conexion/Modelo.php");
	//require_once("../reportes/r_reporte_proveedor_compras.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte_insu']) && $_POST['generar_reporte_insu']=="si_generar") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_in_r_compras_insu']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_f_r_compras_ins']);
	    $cbcat = "";
	    $cbpro = "";
	    $idproveedor = "";
	    $cat_pro = "";

	    if (isset($_POST['categoria_r_compras_ins'])) {
	    	$cbcat = "existe";
	    }else{
	    	$cbcat = "no_existe";
	    }
	    if (isset($_POST['proveedor_r_compras_ins'])) {
	    	$cbpro = "existe";
	    }else{
	    	$cbpro = "no_existe";
	    }
	   

	    if (isset($_POST['proveedor_r_compras_ins']) && ($cbcat == "no_existe")) {
	    	$idproveedor = $_POST['proveedor_r_compras_ins'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_proveedor.int_idproveedor = $idproveedor
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_pro,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproveedor));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['categoria_r_compras_ins']) && ($cbpro == "no_existe")) {
	    	 $cat_pro = $_POST['categoria_r_compras_ins'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_categoria.nva_nom_categoria = '$cat_pro' 
						AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_pro,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproveedor));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['proveedor_r_compras_ins']) && isset($_POST['categoria_r_compras_ins'])) {
			$idproveedor = $_POST['proveedor_r_compras_ins'];
			$cat_pro = $_POST['categoria_r_compras_ins'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_proveedor.int_idproveedor = $idproveedor 
						AND tb_categoria.nva_nom_categoria = '$cat_pro' 
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_pro,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$idproveedor,$cat_pro,$fecha_inicio,$fecha_fin));
	        	exit();
	   		}
	    }else{
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria  
					WHERE
						tb_detalle_compra.int_idproducto != 'null' 
						AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idproveedor,$cat_pro,$fecha_inicio,$fecha_fin));
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