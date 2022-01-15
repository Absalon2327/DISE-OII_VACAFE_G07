<?php 
	session_start();
	date_default_timezone_set('America/El_Salvador');
	require_once("../Conexion/Modelo.php");
	//require_once("../reportes/r_reporte_proveedor_compras.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte_ventas_b']) && $_POST['generar_reporte_ventas_b']=="si_generar") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_in_r_ventas_b']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_f_r_ventas_b']);
	    $cbcat = "";
	    $cbbov = "";
	    $idempleado = "";
	    $cat_bov = "";

	    if (isset($_POST['categoria_r_ventas_b'])) {
	    	$cbcat = "existe";
	    }else{
	    	$cbcat = "no_existe";
	    }
	    if (isset($_POST['empleados_ventas_b'])) {
	    	$cbbov = "existe";
	    }else{
	    	$cbbov = "no_existe";
	    }
	   

	    if (isset($_POST['empleados_ventas_b']) && ($cbcat == "no_existe")) {
	    	$idempleado = $_POST['empleados_ventas_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_proveedor.int_idempleado = $idempleado
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$cat_bov,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['categoria_r_ventas_b']) && ($cbbov == "no_existe")) {
	    	 $cat_bov = $_POST['categoria_r_ventas_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_categoria.nva_nom_categoria = '$cat_bov' 
						AND tb_compra.dat_fecha_sistema >= 'fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$cat_bov,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['empleados_ventas_b']) && isset($_POST['categoria_r_ventas_b'])) {
			$idempleado = $_POST['empleados_ventas_b'];
			$cat_bov = $_POST['categoria_r_ventas_b'];
	    	$sql = "SELECT
						* 
					FROM
						tb_compra
						INNER JOIN tb_proveedor ON tb_compra.int_idempleado = tb_proveedor.int_idempleado
						INNER JOIN tb_detalle_compra ON tb_compra.int_idcompra = tb_detalle_compra.int_idcompra
						INNER JOIN tb_producto ON tb_detalle_compra.int_idproducto = tb_producto.int_idproducto
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria 
					WHERE
						tb_proveedor.int_idempleado = $idempleado 
						AND tb_categoria.nva_nom_categoria = '$cat_bov' 
						AND tb_compra.dat_fecha_sistema >= '$fecha_inicio' 
						AND tb_compra.dat_fecha_sistema <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$cat_bov,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$idempleado,$cat_bov,$fecha_inicio,$fecha_fin,$result));
	        	exit();
	   		}
	    }else{
	    	$sql = "SELECT
						* 
					FROM
						tb_venta
						INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
						INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_detalle_venta ON tb_venta.int_idventa = tb_detalle_venta.int_idventa
						INNER JOIN tb_expediente ON tb_detalle_venta.int_idexpediente = tb_expediente.int_idexpediente  
					WHERE
						tb_detalle_venta.int_idexpediente != 'null' 
						AND tb_venta.dat_fecha_sistema_venta >= 'fecha_inicio' 
						AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$cat_bov,$fecha_inicio,$fecha_fin));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado));
	        	exit();
	   		}
	    }

	    

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_empleado",
			"int_idempleado"=>"nva_nom_empleado"
		);
		$where = "WHERE int_idcargo = 1";
		 
		$result_select = $modelo->crear_select($array_select,$where);	
		if ($result_select[4] >= 1) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else {
        	print json_encode(array("Error",$result_select));
			exit();
        }

	}



?>