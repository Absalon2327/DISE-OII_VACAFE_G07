<?php 
	session_start();
	date_default_timezone_set('America/El_Salvador');
	require_once("../Conexion/Modelo.php");
	//require_once("../reportes/r_reporte_proveedor_compras.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte_dev']) && $_POST['generar_reporte_dev']=="si_generar") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_in_r_ventas_dev']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_f_r_ventas_dev']);
	    $cbxpro = "";
	    $cbxemp = "";
	    $idempleado = "";
	    $pro = "";

	    if (isset($_POST['producto_r_ventas_dev'])) {
	    	$cbxpro = "existe";
	    }else{
	    	$cbxpro = "no_existe";
	    }
	    if (isset($_POST['empleados_ventas_dev'])) {
	    	$cbxemp = "existe";
	    }else{
	    	$cbxemp = "no_existe";
	    }
	   

	    if (isset($_POST['empleados_ventas_dev']) && ($cbxpro == "no_existe")) {
	    	$idempleado = $_POST['empleados_ventas_dev'];
	    	$sql = "SELECT
		                * 
		            FROM
		                tb_venta
		                INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
		                INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
		                INNER JOIN tb_producto
		                INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
		                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
		                INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
		            WHERE
		                tb_venta.int_idempleado = $idempleado
		                AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
		                AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['producto_r_ventas_dev']) && ($cbxemp == "no_existe")) {
	    	 $pro = $_POST['producto_r_ventas_dev'];
	    	if ($pro == 'Botella de Leche') {
				$sql = "SELECT
		                    * 
		                FROM
		                    tb_venta
		                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
		                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
		                    INNER JOIN tb_producto
		                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
		                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
		                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
		                WHERE
		                    tb_producto.nva_nom_producto = '$pro'
		                    AND tb_producto.int_idcategoria = 1
		                    AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
		                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

			}else{
				$sql = "SELECT
		                    * 
		                FROM
		                    tb_venta
		                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
		                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
		                    INNER JOIN tb_producto
		                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
		                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
		                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
		                WHERE
		                    tb_producto.int_idcategoria = '$pro'
		                    AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
		                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";
			}

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();
	   		}
	    	
	    }else if (isset($_POST['empleados_ventas_dev']) && isset($_POST['producto_r_ventas_dev'])) {
			$idempleado = $_POST['empleados_ventas_dev'];
			$pro = $_POST['producto_r_ventas_dev'];

			if ($pro == 'Botella de Leche') {
				$sql = "SELECT
		                    * 
		                FROM
		                    tb_venta
		                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
		                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
		                    INNER JOIN tb_producto
		                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
		                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
		                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
		                WHERE
		                    tb_venta.int_idempleado = $idempleado 
		                    AND tb_producto.nva_nom_producto = '$pro'
		                    AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
		                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

			}else{
				$sql = "SELECT
		                    * 
		                FROM
		                    tb_venta
		                    INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
		                    INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
		                    INNER JOIN tb_producto
		                    INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
		                    AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
		                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
		                WHERE
		                    tb_venta.int_idempleado = $idempleado
		                    AND tb_producto.int_idcategoria = '$pro'
		                    AND tb_producto.nva_nom_producto != 'Botella de Leche '
		                    AND tb_venta.dat_fecha_sistema_venta >= '$fecha_inicio' 
		                    AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";
			}
	    	
	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			
	   			print json_encode(array("Error",$idempleado,$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();
	   		}
	    
	    }else{

	    	$sql = "SELECT
						* 
					FROM
						tb_venta
						INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado
						INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
						INNER JOIN tb_producto
						INNER JOIN tb_detalle_venta ON tb_producto.int_idproducto = tb_detalle_venta.int_idproducto 
						AND tb_venta.int_idventa = tb_detalle_venta.int_idventa
						INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria    
					WHERE
						tb_venta.dat_fecha_sistema_venta >= 'fecha_inicio' 
						AND tb_venta.dat_fecha_sistema_venta <= '$fecha_fin'";

	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$idempleado,$pro,$fecha_inicio,$fecha_fin,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado));
	        	exit();
	   		}
	    }

	    

	   	  
   		
	}else{

		$array_select_prov = array(
			"table"=>"tb_proveedor",
			"int_idproveedor"=>"nva_nom_proveedor"
		);
		
		$array_select_prod = array(
			"table"=>"tb_producto",
			"int_idproducto"=>"nva_nom_producto"
		);
		$where_prod = "WHERE int_idcategoria = 4 AND nva_estado_producto = 'Activo'";
		 
		$result_select_prov = $modelo->crear_select($array_select_prov);
		$result_select_prod = $modelo->crear_select($array_select_prod,$where_prod);	
		if (($result_select_prov[4] >= 1) && ($result_select_prod[4] >= 1) ) {
			print json_encode(array("Exito",$result_select_prov,$result_select_prod));
			exit();
		}else {
        	print json_encode(array("Error",$result_select_prov,$result_select_prod));
			exit();
        }

	}



?>