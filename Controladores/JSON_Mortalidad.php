<?php

require_once("../Conexion/Modelo.php");
$modelo = new Modelo();

if (isset($_POST['validar_campos']) && $_POST['validar_campos'] == "si_por_campo") {
	$array_seleccionar = array();
	$array_seleccionar['table'] = "tb_baja";
	$array_seleccionar['campo'] = "id_baja";

	if ($_POST['tipo'] == "fehca_baja") {
		$array_seleccionar['fehca_baja'] = $_POST['campo'];
	} else if ($_POST['tipo'] == "int_idexpediente") {
		$array_seleccionar['table'] = "tb_expediente";
		$array_seleccionar['int_idexpediente'] = $_POST['campo'];
	} else if ($_POST['tipo'] == "descripcion_baja") {
		$array_seleccionar['descripcion_baja'] = $_POST['campo'];
	}
	$resultado = $modelo->seleccionar_cualquiera($array_seleccionar);
	if ($resultado[0] == 0 && $resultado[4] == 0) {
		print json_encode(array("Exito", $resultado, $array_seleccionar));
		exit();
	} else {
		print json_encode(array("Error", $resultado, $array_seleccionar));
		exit();
	}
}else if (isset($_POST['eliminar_baja']) && $_POST['eliminar_baja']=="si_eliminala") {
		$array_eliminar = array(
			"table"=>"tb_baja",
			"id_baja"=>$_POST['id_bajaE']);

		$result = $modelo->eliminar_generica($array_eliminar);
	    if ($result[0] == '1') {
			$estado = "activo";
			$array_update = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $_POST['idexpeiente'],
				"nva_estado_bovino" => $estado);
			$resultado_Expediente = $modelo->actualizar_generica($array_update);
			print json_encode(array("Exito", $_POST, $result, $resultado_Expediente));
			exit();
		} else {
			print json_encode(array("Error", $_POST, $result));
			exit();
		}


} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_este_id") {

		$resultado = $modelo->get_todos("tb_baja", "WHERE id_baja = '" . $_POST['id_baja'] . "'");
		if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0]));
		exit();
		} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
		}
} else if (isset($_POST['ingreso_datos_edit']) && $_POST['ingreso_datos_edit'] == "si_actualizalo_ya") {

	$array_update = array(
		"table" => "tb_baja",
		"id_baja" => $_POST['llave_baja_edit'],
		"fehca_baja" => $modelo->formatear_fecha($_POST['fecha']),
		"descripcion_baja" => $_POST['descripcion'],
		"idexpeiente_baja" => $_POST['idbajaeditar']
	);
	$resultado = $modelo->actualizar_generica($array_update);
		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }
	
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {
	$id_insertar = $modelo->retonrar_id_insertar("tb_baja");
	$array_insertar = array(
		"table" => "tb_baja",
		"id_baja" => $id_insertar,
		"fehca_baja" => $modelo->formatear_fecha($_POST['fehca_baja']),
		"descripcion_baja" => $_POST['descripcion_baja'],
		"idexpeiente_baja" => $_POST['idexpeiente_baja']
	);
	$result = $modelo->insertar_generica($array_insertar);

	if ($result[0] == '1') {
		$estado = "inactivo";
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['idexpeiente_baja'],
			"nva_estado_bovino" => $estado
		);
		$resultado_Expediente = $modelo->actualizar_generica($array_update);
		//print json_encode(array("Exito",$_POST,$result,$resultado_Expediente));
		print json_encode(array("Exito", $id_insertar, $_POST, $result, $resultado_Expediente));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $result));
		exit();
	}
} else {
	$htmltr = $html = "";
	$cuantos = 0;
	$sql = "SELECT * 
		        FROM   tb_baja
	           INNER JOIN  tb_expediente ON idexpeiente_baja = int_idexpediente
						 ";
	$result = $modelo->get_query($sql);
	if ($result[0] == '1') {

		foreach ($result[2] as $row) {
			$htmltr .= '<tr>
	                            <td class=text-center>' . $row['nva_nom_bovino'] . '</td>
	                            <td class=text-center>' . $modelo->formatear_fecha($row['fehca_baja']) . '</td>
	                            <td class=text-center>' . $row['descripcion_baja'] . '</td>
	                           
	                             <td class="text-center">
	                            <button class="btn btn-info btn-sm btn_editar "
			                        	data-id_baja=' . $row['id_baja'] . '>
			                            <i class="fas fa-pencil-alt"></i>
			                    </button>
			                    <button class="btn btn-danger btn-sm btn_eliminar"
			                        	data-id_baja="'.$row['id_baja'] .'" 
			                        	data-id_bajaEX="' . $row['idexpeiente_baja'] .'">
			                            <i class="fas fa-trash"></i>
			                        </button>
			                        
			                </td>
	                        </tr>';
		}
		$html .= '<table id="tabla_baja" class="table table-striped projects" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class=text-center>Bovino</th>
                            <th class=text-center>Fecha de Baja</th>
                            <th class=text-center>Descripción</th>
                            <th class=text-center>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
		$html .= $htmltr;
		$html .= '</tbody>
                    	</table>';


		print json_encode(array("Exito", $html, $_POST, $result));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $result));
		exit();
	}
}
