<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte']) && $_POST['generar_reporte']=="si_generar") {
		
	    $idraza = $_POST['raza_r'];

	    $sql = "SELECT date_format(dat_fecha_monta, '%d/%m/%Y') as dat_fecha_monta,date_format(dat_fecha_parto, '%d/%m/%Y') as dat_fecha_parto, nva_nom_raza,nva_nom_bovino
			FROM tb_preñez INNER JOIN tb_raza ON tb_preñez.int_bovino_fk = tb_raza.int_idraza
			INNER JOIN tb_expediente ON tb_preñez.int_bovino_fk = tb_expediente.int_idexpediente  WHERE tb_preñez.int_bovino_fk = '$idraza'";
   		$result = $modelo->get_query($sql);

   		if($result[0]=='1' && $result[4]>=1){

   			print json_encode(array("Exito",$idraza));
        	exit();

   		}else{
   			print json_encode(array("Error",$raza_r));
        	exit();
   		}

	   	  
   		
	}else{

		$array_select = array(
			"table"=>"tb_raza",
			"int_idraza"=>"nva_nom_raza"

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