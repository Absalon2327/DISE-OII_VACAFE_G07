<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	//require_once("../reportes/r_reporte_proveedor_compras.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte_ventas_g']) && $_POST['generar_reporte_ventas_g']=="si_generar") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_inicio_r_ventas_g']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_fin_r_ventas_g']);
	    $idempleado = "";
	    $provee = "";

	    if (isset($_POST['empleados_ventas_g'])) {
	    	$idempleado = $_POST['empleados_ventas_g'];
	    	$sql = "SELECT
		                * 
		            FROM
		                tb_venta
						INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
						INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado  
		            WHERE
		                dat_fecha_sistema_venta >= '$fecha_inicio' 
		                AND dat_fecha_sistema_venta <= '$fecha_fin' 
		                AND tb_venta.int_idempleado = '$idempleado'";
	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();
	   		}
	    }else{
	    	$sql = "SELECT
		                * 
		            FROM
		                tb_venta
						INNER JOIN tb_clientes ON tb_venta.int_id_cliente = tb_clientes.int_idcliente
						INNER JOIN tb_empleado ON tb_venta.int_idempleado = tb_empleado.int_idempleado  
		            WHERE
		                dat_fecha_sistema_venta >= '$fecha_inicio' 
		                AND dat_fecha_sistema_venta <= '$fecha_fin'";
	   		$result = $modelo->get_query($sql);

	   		if($result[0]=='1' && $result[4]>=1){

	   			print json_encode(array("Exito",$fecha_inicio,$fecha_fin,$idempleado,$result));
	        	exit();

	   		}else{
	   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idempleado,$result));
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