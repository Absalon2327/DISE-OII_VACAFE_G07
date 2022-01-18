<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte']) && $_POST['generar_reporte']=="si_generar") {
		
	    $idexpediente = $_POST['idexpe'];

	    $sql = "SELECT
	tb_expediente.nva_nom_bovino, 
	tb_control_vacunas.dat_fecha_aplicacion, 
	tb_producto.nva_nom_producto, 
	tb_categoria.nva_nom_categoria,
	tb_control_vacunas.nva_dosis
	FROM
	tb_expediente
	INNER JOIN
	tb_control_vacunas
	ON 
		tb_expediente.int_idexpediente = tb_control_vacunas.id_exped_aplicado
	INNER JOIN
	tb_producto
	ON 
		tb_producto.int_idproducto = tb_control_vacunas.nva_vacuna_aplicada
	INNER JOIN
	tb_categoria
	ON 
		tb_producto.int_idcategoria = tb_categoria.int_idcategoria
				WHERE tb_control_vacunas.id_exped_aplicado = '$idexpediente'";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito",$idexpediente));
        	exit();

   		}else{
   			print json_encode(array("Error",$idexpediente));
        	exit();
   		}

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_expediente",
			"int_idexpediente"=>"nva_nom_bovino"

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