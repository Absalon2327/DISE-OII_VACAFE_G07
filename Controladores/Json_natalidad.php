<?php 
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
 if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {

 	    $encontro = "";
		//consulta para obtener el nombre de la vaca y el tenero o ternera de la base
		$sql = "SELECT
				int_id_expe_madre, 
				int_id_expe_ternero,
			    date_format(dat_fecha_nacimiento,'%d/%m/%Y') as dat_fecha_nacimiento
				FROM
					tb_natalidad 
					WHERE
					int_id_natalidad != '$_POST[llave_natalidad]';";
						$result_nombre = $modelo->get_query($sql);
		if($result_nombre[0]=='1'){
						foreach ($result_nombre[2] as $row) {
				
				if (($row['int_id_expe_madre'] == $_POST['int_id_expe_madre']) &&($row['int_id_expe_ternero'] == $_POST['int_id_expe_ternero'])){
					$encontro = "bovinos encontrados";
					break;
				}
			}
			if ($encontro == "bovinos encontrados") {
				print json_encode(array("Error","Ternero asignado a la vaca",$result_nombre));
				exit();
               //sino, guardamos todos los datos
			}else{
				$array_update = array(
	            "table" => "tb_natalidad",
	            "int_id_natalidad" => $_POST['llave_natalidad'],
	            "dat_fecha_nacimiento" => $modelo->formatear_fecha($_POST['dat_fecha_nacimiento']), 
	            "int_id_expe_madre" => $_POST['int_id_expe_madre'],
	            "int_id_expe_ternero" => $_POST['int_id_expe_ternero']);
				$resultado = $modelo->actualizar_generica($array_update);

				if($resultado[0]=='1' && $resultado[4]>0){
        		print json_encode(array("Exito",$_POST,$resultado));
				exit();

      		    }else {
        		print json_encode(array("Error",$_POST,$resultado));
				exit();
        		}



			}
        }else{
			
				$array_update = array(
	            "table" => "tb_natalidad",
	            "int_id_natalidad" => $_POST['llave_natalidad'],
	            "dat_fecha_nacimiento" => $modelo->formatear_fecha($_POST['dat_fecha_nacimiento']), 
	            "int_id_expe_madre" => $_POST['int_id_expe_madre'],
	            "int_id_expe_ternero" => $_POST['int_id_expe_ternero']);
				$resultado = $modelo->actualizar_generica($array_update);

				if($resultado[0]=='1' && $resultado[4]>0){
        		print json_encode(array("Exito",$_POST,$resultado));
				exit();

      		    }else {
        		print json_encode(array("Error",$_POST,$resultado));
				exit();
        		}

				}

	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_nombre_especifico") {
		$resultado = $modelo->get_todos("tb_natalidad","WHERE int_id_natalidad = '".$_POST['int_id_natalidad']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



	}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
   	    $encontro = "";
		//consulta para obtener el nombre de la vaca y el tenero o ternera de la base
		$sql = "SELECT
				int_id_expe_madre, 
				int_id_expe_ternero
				FROM
					tb_natalidad;";
		$result_nombre = $modelo->get_query($sql);
		if($result_nombre[0]=='1'){
			foreach ($result_nombre[2] as $row) {
				
				if (($row['int_id_expe_madre'] == $_POST['int_id_expe_madre']) &&($row['int_id_expe_ternero'] == $_POST['int_id_expe_ternero'])){
					$encontro = "bovinos encontrados";
					break;
				}
			}
			if ($encontro == "bovinos encontrados") {
				print json_encode(array("Error","Ternero asignado a la vaca",$result_nombre));
				exit();
               //sino, guardamos todos los datos
			}else{
			$id_insertar = $modelo->retonrar_id_insertar("tb_natalidad"); 
        	$array_insertar = array(
            "table" => "tb_natalidad",
            "int_id_natalidad"=>$id_insertar,
            "dat_fecha_nacimiento" => $modelo->formatear_fecha($_POST['dat_fecha_nacimiento']),
            "int_id_expe_madre" => $_POST['int_id_expe_madre'],
            "int_id_expe_ternero" => $_POST['int_id_expe_ternero']);
        	$result = $modelo->insertar_generica($array_insertar);

       		 if($result[0]=='1'){
       		 		$estado = "activo";
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['int_id_expe_madre'],
			"nva_estado_bovino" => $estado
		);
		$resultado_Expediente = $modelo->actualizar_generica($array_update);
		
        	print json_encode(array("Exito",$_POST,$result[2][0],$resultado_Expediente));
			exit();

       		 }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
       		 }

			 }
	    }
		else{
			$id_insertar = $modelo->retonrar_id_insertar("tb_natalidad"); 
        	$array_insertar = array(
            "table" => "tb_natalidad",
            "int_id_natalidad"=>$id_insertar,
            "dat_fecha_nacimiento" => $modelo->formatear_fecha($_POST['dat_fecha_nacimiento']),
            "int_id_expe_madre" => $_POST['int_id_expe_madre'],
            "int_id_expe_ternero" => $_POST['int_id_expe_ternero']);
        	$result = $modelo->insertar_generica($array_insertar);

       		 if($result[0]=='1'){
       		 	$estado = "activo";
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['int_bovino_fk'],
			"nva_estado_bovino" => $estado
		);
		$resultado_Expediente = $modelo->actualizar_generica($array_update);
        	print json_encode(array("Exito",$_POST,$result[2][0],$resultado_Expediente));
			exit();

       		 }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
       		 }

		}
			
		//aqui termina el if else de exito
		

    }else if (isset($_POST['consultar_parto']) && $_POST['consultar_parto'] == "fecha") {
		$idExpediente = $_POST['idExpediente'];
		$sql = "SELECT  date_format(dat_fecha_ult_parto, '%d/%m/%Y') as dat_fecha_ult_parto FROM tb_expediente
		WHERE int_idexpediente = ".$idExpediente.";";
		$fecha_ultimo_parto = $modelo->get_query($sql);
		if($fecha_ultimo_parto[0]=='1'){
			$fecha = $fecha_ultimo_parto[2][0]['dat_fecha_ult_parto'];
			print json_encode(array("Exito",$fecha));
			exit();
		}else{
			print json_encode(array("Error",$_POST,$result));
			exit();
		}
	}else{
		$htmltr = $html="";
		$cuantos = 0;
		$sql = "SELECT tbn.int_id_natalidad, tbn.dat_fecha_nacimiento, tbn.int_id_expe_madre, tbn.int_id_expe_ternero, 
				madre.nva_nom_bovino as mama, ternero.nva_nom_bovino as hijo
				FROM tb_natalidad as tbn 
				JOIN tb_expediente as madre on tbn.int_id_expe_madre = madre.int_idexpediente
				JOIN tb_expediente as ternero on tbn.int_id_expe_ternero = ternero.int_idexpediente";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {
			$htmltr.='<tr>
	                            <td>'.$row['hijo'].'</td>
	                            <td>'.$row['mama'].'</td>
	                            <td>'.$modelo->formatear_fecha($row['dat_fecha_nacimiento']).'</td>
	                         <td>
	                            <button class="btn btn-info btn-sm btn_editar"
			                        	data-int_id_natalidad='.$row['int_id_natalidad'].'>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                </td>
	                        </tr>';	
			}
			$html.='<table id="tabla_natalidad" class="table table-striped projects" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Nombre del Recien Nacido</th>
                            <th>Nombre de la Madre</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';
     	print json_encode(array("Exito",$html,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

?>