<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	//$pdf = new PDF();
	
	if (isset($_POST['generar_reporte']) && $_POST['generar_reporte']=="si_generar") {
		
	    $idexpediente = $_POST['idexpe'];

	    $sql = "SELECT tbn.int_id_natalidad, tbn.dat_fecha_nacimiento, tbn.int_id_expe_madre, tbn.int_id_expe_ternero, 
				madre.nva_nom_bovino as mama, ternero.nva_nom_bovino as hijo
				FROM tb_natalidad as tbn 
				JOIN tb_expediente as madre on tbn.int_id_expe_madre = madre.int_idexpediente
				JOIN tb_expediente as ternero on tbn.int_id_expe_ternero = ternero.int_idexpediente
					
				WHERE   tbn.int_id_expe_madre = '$idexpediente'";
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

		);$where = "WHERE  nva_tipo_bovino = 'vaca_lechera'";

		$result_select = $modelo->crear_select($array_select,$where);	
		if ($result_select[4] >= 1 ) {
			print json_encode(array("Exito",$result_select));
			exit();
		}else {
        	print json_encode(array("Error",$result_select));
			exit();
        }
	}



?>