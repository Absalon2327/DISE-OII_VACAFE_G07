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
		$fecha_inicio = $modelo->formatear_fecha_hora($_POST['fecha_inicio_r_compras']);
	    $fecha_fin = $modelo->formatear_fecha_hora($_POST['fecha_fin_r_compras']);
	    $idproveedor = $_POST['proveedor_r_compras'];

	    $sql = "SELECT
	                * 
	            FROM
	                tb_compra
	                INNER JOIN tb_proveedor ON tb_compra.int_idproveedor = tb_proveedor.int_idproveedor
	                INNER JOIN tb_empleado ON tb_compra.int_idempleado = tb_empleado.int_idempleado 
	            WHERE
	                dat_fecha_sistema >= '$fecha_inicio' 
	                AND dat_fecha_sistema <= '$fecha_fin' 
	                AND tb_compra.int_idproveedor = '$idproveedor'";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito",$fecha_inicio,$fecha_fin,$idproveedor));
        	exit();

   		}else{
   			print json_encode(array("Error",$fecha_inicio,$fecha_fin,$idproveedor));
        	exit();
   		}

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_proveedor",
			"int_idproveedor"=>"nva_nom_proveedor"

		);
		 
		$result_select = $modelo->crear_select($array_select);	
		if (!$result_select[3]) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else {
        	print json_encode(array("Error",$result_select));
			exit();
        }
	}



?>