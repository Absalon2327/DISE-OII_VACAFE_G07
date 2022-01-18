<?php

require_once("../Conexion/Modelo.php");
$modelo = new Modelo();
if (isset($_POST['validar_campos']) && $_POST['validar_campos'] == "si_por_campo") {
	$array_seleccionar = array();
	$array_seleccionar['table'] = "tb_preñez";
	$array_seleccionar['campo'] = "int_id_preñez";
	$resultado = $modelo->seleccionar_cualquiera($array_seleccionar);
	if ($resultado[0] == 0 && $resultado[4] == 0) {
		print json_encode(array("Exito", $resultado, $array_seleccionar));
		exit();
	} else {
		print json_encode(array("Error", $resultado, $array_seleccionar));
		exit();
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {
	
	$array_update = array(
		"table" => "tb_preñez",
		"int_id_preñez" => $_POST['llave_preñez'],
		"int_bovino_fk" => $_POST['int_bovino_edit'],
		"dat_fecha_monta" => $modelo->formatear_fecha($_POST['dat_fecha_monta_edit']),
		"dat_fecha_celo" => $modelo->formatear_fecha($_POST['dat_fecha_celo_edit']),
		"dat_fecha_parto" => $modelo->formatear_fecha($_POST['dat_fecha_parto_edit']),

	);
	$resultado = $modelo->actualizar_generica($array_update);

	if ($resultado[0] == '1' && $resultado[4] > 0) {
		print json_encode(array("Exito", $_POST, $resultado));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_condui_especifico") {

	$resultado = $modelo->get_todos("tb_preñez", "WHERE int_id_preñez = '" . $_POST['int_id_preñez'] . "'");
	if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {

	$id_insertar = $modelo->retonrar_id_insertar("tb_preñez");
	$array_insertar = array(
		"table" => "tb_preñez",
		"int_id_preñez" => $id_insertar,
		"int_bovino_fk" => $_POST['int_bovino_fk'],
		"dat_fecha_monta" => $modelo->formatear_fecha($_POST['dat_fecha_monta']),
		"dat_fecha_celo" => $modelo->formatear_fecha($_POST['dat_fecha_celo']),
		"dat_fecha_parto" => $modelo->formatear_fecha($_POST['dat_fecha_parto']),
	);

	$result = $modelo->insertar_generica($array_insertar);
	if ($result[0] == '1') {
		$estado = "preñada";
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_POST['int_bovino_fk'],
			"nva_estado_bovino" => $estado
		);
		$resultado_Expediente = $modelo->actualizar_generica($array_update);
		print json_encode(array("Exito", $id_insertar, $_POST, $result, $resultado_Expediente));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $result));
		exit();
	}
} else if (isset($_POST['cambiar_estado']) && $_POST['cambiar_estado'] == "cambio_estado") {
	$idPrenez = $_POST['idPrenez'];
	$fechaHoy = date('Y-m-d');
	$sql = "SELECT tbp.int_bovino_fk, tbp.dat_fecha_parto, tbe.int_cant_parto FROM tb_preñez tbp
	INNER JOIN tb_expediente tbe on tbp.int_bovino_fk = tbe.int_idexpediente
	WHERE int_id_preñez = " . $idPrenez  . ";";
	$result = $modelo->get_query($sql);
	if ($result[0] == '1') {
		$idBovino = $result[2][0]['int_bovino_fk'];
		$cantidadParto = $result[2][0]['int_cant_parto'];
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $idBovino,
			"nva_estado_bovino" => 'parida',
			"int_cant_parto" => ($cantidadParto + 1),
			"dat_fecha_ult_parto" =>  $fechaHoy
		);
		$resultado = $modelo->actualizar_generica($array_update);
		if ($resultado[0] == '1' && $resultado[4] > 0) {
			print json_encode(array("Exito", $idBovino, $resultado));
		} else {
			print json_encode(array("Error", $idBovino, $resultado));
		}
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else {
	$htmltr = $html = "";
	$cuantos = 0;
	$status = "";
	$sql = "SELECT dat_fecha_monta,dat_fecha_parto,dat_fecha_celo,
		int_id_preñez,nva_nom_bovino
        FROM
	    tb_preñez
	    INNER JOIN
	    tb_expediente  ON 
		int_bovino_fk = int_idexpediente
		WHERE nva_estado_bovino ='preñada'";
	$result = $modelo->get_query($sql);
	if ($result[0] == '1') {
		$fecha_actual = new DateTime(date('Y-m-d')); //nueva variable para vencimiento//
		foreach ($result[2] as $row) {

			$fecha_final = new DateTime($row['dat_fecha_parto']);
			$dias = $fecha_actual->diff($fecha_final)->format('%r%a');
			// Si la fecha final es igual a la fecha actual o anterior
			if ($dias <= 0) {
				$status = "Ya pario";

				//si encontramos un empleado con un usuario creado, notificamos antes de guardar
			} else if ($dias <= 15) {
				$status = "Está a " . $dias . " días de parir";
			} else if ($dias <= 1) {
				$status = "mañana va a parir";
			}
			$htmltr .= '<tr>
	                             <td class="text-center">' . $row['nva_nom_bovino'] . '</td>
	                            <td class="text-center">' . $modelo->formatear_fecha($row['dat_fecha_celo']) . '</td>
	                            <td class="text-center">' . $modelo->formatear_fecha($row['dat_fecha_monta']) . '</td>
	                            <td class="text-center">' . $modelo->formatear_fecha($row['dat_fecha_parto']) . '</td>
	                            <td class="text-center"> ' . $status . ' </td>

	                                <td class="text-center">
	                            <button class="btn btn-info btn-sm btn_editar "
			                        	data-int_id_preñez=' . $row['int_id_preñez'] . '>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                        
			                </td>
	                        </tr>';
		}

		$html .= '<table id="tabla_preñez" class="table table-striped projects" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Bovino</th>
                            <th class="text-center">Fecha de Celo</th>
                            <th class="text-center">Fecha de Monta</th>
                            <th class="text-center">Fecha de Parto</th>
                            <th class="text-center">Alerta</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
		$html .= $htmltr;
		$html .= '</tbody>
                    	</table>';


		print json_encode(array("Exito", $html, $_POST, $result, $status));


		exit();
	} else {
		print json_encode(array("Error", $_POST, $result));
		exit();
	}
}

