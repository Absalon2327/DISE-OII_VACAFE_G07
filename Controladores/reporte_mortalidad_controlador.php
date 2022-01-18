<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte']) && $_POST['generar_reporte']=="si_generar") {
		

	    $sql = "SELECT
	nva_nom_bovino, 
	descripcion_baja, 
	date_format(fehca_baja, '%d/%m/%Y') as fehca_baja

	FROM
	tb_baja
	INNER JOIN
	tb_expediente
	ON 
		idexpeiente_baja = tb_expediente.int_idexpediente";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito"));
        	exit();

   		}else{
   			print json_encode(array("Error"));
        	exit();
   		}

	   	  
   		
	}else{

		 
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