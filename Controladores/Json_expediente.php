<?php
require_once("../Conexion/Modelo.php");
$modelo = new Modelo();

if (isset($_GET['subir_imagen']) && $_GET['subir_imagen'] == "subir_imagen_ajax") {
	$trozos = explode(".", $_FILES['file-0']['name']);
	$extension = end($trozos);
	$name = "imgcarta_" . $_GET['id'] . "." . $extension;
	$file_path = "../archivo_carta_venta/" . $name;
	$sql = "SELECT nva_carta_venta, nva_foto_bovino FROM tb_expediente where int_idexpediente = " .
		$_GET['id'] . ";";

	$fotoActual = $modelo->get_query($sql);
	if ($fotoActual[0] == 1) {
		$fotoBorrar = $fotoActual[2][0]['nva_carta_venta'];
		if (is_file($fotoBorrar)) {
			unlink($fotoBorrar);
		}
	}

	try {
		$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_GET['id'],
			"nva_carta_venta" => $file_path, //campo en la tabla

		);
		$resultado = $modelo->actualizar_generica($array_update);
		if ($resultado[0] == '1' && $resultado[4] > 0) {
			print json_encode(array("Exito", $mover, $resultado));
		} else {
			print json_encode(array("Error", $mover, $resultado));
		}
	} catch (Exception $e) {
		print json_encode(array("Error", $_POST));
		exit();
	}
} else if (isset($_GET['subir_imagen']) && $_GET['subir_imagen'] == "subir_imagen_bovino") {
	$trozos = explode(".", $_FILES['file-0']['name']);
	$extension = end($trozos);
	$name = "imgfoto_" . $_GET['id'] . "." . $extension;
	$file_path = "../archivo_expdiente/" . $name;
	$sql = "SELECT nva_carta_venta, nva_foto_bovino FROM tb_expediente where int_idexpediente = " .
		$_GET['id'] . ";";

	$fotoActual = $modelo->get_query($sql);
	if ($fotoActual[0] == 1) {
		$fotoBorrar = $fotoActual[2][0]['nva_foto_bovino'];
		if (is_file($fotoBorrar)) {
			unlink($fotoBorrar);
		}
	}
	try {
		$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
		$array_update = array(
			"table" => "tb_expediente",
			"int_idexpediente" => $_GET['id'],
			"nva_foto_bovino" => $file_path //campo en la tabla
		);
		$resultado = $modelo->actualizar_generica($array_update);
		if ($resultado[0] == '1' && $resultado[4] > 0) {
			print json_encode(array("Exito", $mover, $resultado));
		} else {
			print json_encode(array("Error", $mover, $resultado));
		}
	} catch (Exception $e) {
		print json_encode(array("Error", $_POST));
		exit();
	}
} else if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_expediente_especifico") {
	$sql = "SELECT *
				FROM tb_expediente WHERE int_idexpediente = '$_POST[idexpediente]'";


	$resultado = $modelo->get_query($sql);
	//get_todos("tb_expediente","WHERE int_idexpediente = '".$_POST['idexpediente']."'"); cambios aqui en ideexpediente
	if ($resultado[0] == '1') {
		print json_encode(array("Exito", $_POST, $resultado[2][0]));
		exit();
	} else {
		print json_encode(array("Error", $_POST, $resultado));
		exit();
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_registro") {

	$encontro = "";
	//consulta para obtener el nombre 
	$sql = "SELECT
				nva_nom_bovino 
				FROM
				tb_expediente;";

	$result_nombre = $modelo->get_query($sql);

	//se verifica si hay bovino con el mismo nombre
	if ($result_nombre[0] == '1') {

		foreach ($result_nombre[2] as $row) {

			if ($row['nva_nom_bovino'] == $_POST['nom_bovino']) {
				$encontro = "nombre econtrado";
				break;
			}
		}
		//si encontramos un nombre identico, notificamos antes de guardar
		if ($encontro == "nombre econtrado") {
			print json_encode(array("Error", "existe bovino", $result_nombre));
			exit();
			//si encontramos un empleado con un usuario creado, notificamos antes de guardar
		} else {
			if ($_POST['tipo_bovino'] == "vaca_lechera" && $_POST['control_fecha'] == "si_hay_fecha" && $_POST['cant_parto_bovino']>=1) {
				$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
				$estado_bovino = "activo";
				$array_insertar = array(
					"table" => "tb_expediente",
					"int_idexpediente" => $id_insertar,
					"nva_nom_bovino" => $_POST['nom_bovino'],
					"nva_estado_bovino" => $estado_bovino,
					"nva_sexo_bovino" => $_POST['sexo_bovino'],
					"int_cant_parto" => $_POST['cant_parto_bovino'],
					"txt_descrip_expediente" => $_POST['descrip_expediente'],
					"int_id_propietario" => $_POST['propietario'],
					"int_idraza" => $_POST['raza_bovino_select'],
					"nva_tipo_bovino" => $_POST['tipo_bovino'],
					"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['fecha_ult_parto']),
					"dou_costo_bovino" => $_POST['costo'],
					"dou_precio_venta_bovino" => $_POST['precioVenta']

				);
			}else if ($_POST['tipo_bovino'] == "vaca_lechera" && $_POST['cant_parto_bovino']==0) {
				$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
				$estado_bovino = "activo";
				$array_insertar = array(
					"table" => "tb_expediente",
					"int_idexpediente" => $id_insertar,
					"nva_nom_bovino" => $_POST['nom_bovino'],
					"nva_estado_bovino" => $estado_bovino,

					"nva_sexo_bovino" => $_POST['sexo_bovino'],
					"int_cant_parto" => $_POST['cant_parto_bovino'],
					"txt_descrip_expediente" => $_POST['descrip_expediente'],
					"int_id_propietario" => $_POST['propietario'],
					"int_idraza" => $_POST['raza_bovino_select'],
					"nva_tipo_bovino" => $_POST['tipo_bovino'],
					"dou_costo_bovino" => $_POST['costo'],
					"dou_precio_venta_bovino" => $_POST['precioVenta']
					
				);
			} else {
				$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
				$estado_bovino = "activo";
				$array_insertar = array(
					"table" => "tb_expediente",
					"int_idexpediente" => $id_insertar,
					"nva_nom_bovino" => $_POST['nom_bovino'],
					"nva_estado_bovino" => $estado_bovino,

					"nva_sexo_bovino" => $_POST['sexo_bovino'],
					"txt_descrip_expediente" => $_POST['descrip_expediente'],
					"int_id_propietario" => $_POST['propietario'],
					"int_idraza" => $_POST['raza_bovino_select'],
					"nva_tipo_bovino" => $_POST['tipo_bovino'],
					"dou_costo_bovino" => $_POST['costo'],
					"dou_precio_venta_bovino" => $_POST['precioVenta']
				);
			}
			$result = $modelo->insertar_generica($array_insertar);

			if ($result[0] == '1') {
				print json_encode(array("Exito", $id_insertar, $result));
				exit();
			} else {
				print json_encode(array("Error", $result));
				exit();
			}
		}
	} else {
		if ($_POST['tipo_bovino'] == "vaca_lechera") {
			$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
			$estado_bovino = "activo";
			$array_insertar = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $id_insertar,
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,
				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"int_cant_parto" => $_POST['cant_parto_bovino'],
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['fecha_ult_parto']),
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']
			);
		} else {
			$id_insertar = $modelo->retonrar_id_insertar("tb_expediente");
			$estado_bovino = "activo";
			$array_insertar = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $id_insertar,
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,

				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']);
			}
			$result = $modelo->insertar_generica($array_insertar);

			if ($result[0] == '1') {
			print json_encode(array("Exito", $id_insertar, $result));
			exit();
			} else {
			print json_encode(array("Error", $result));
			exit();
			}
	}
} else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos'] == "si_actualizalo") {
	$encontro = "";
	//consulta para obtener el nombre 
	$sql = "SELECT
				nva_nom_bovino 
			FROM
				tb_expediente 
			WHERE
				int_idexpediente != '$_POST[llave_expediente]';";

	$result_nombre = $modelo->get_query($sql);

	if ($result_nombre[0] == '1'){

		foreach ($result_nombre[2] as $row) {

			if ($row['nva_nom_bovino'] == $_POST['nom_bovino']) {
				$encontro = "nombre econtrado";
				break;
			}
		}
		if ($encontro == "nombre econtrado") {
			print json_encode(array("Error", "existe bovino", $result_nombre));
			exit();
			//si encontramos un empleado con un usuario creado, notificamos antes de guardar
		
		}else{
			if ($_POST['tipo_bovino'] == "vaca_lechera") {
				$estado_bovino = "activo";
				$array_update = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $_POST['llave_expediente'],
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,
				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"int_cant_parto" => $_POST['cant_parto_bovino'],
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['fecha_ult_parto']),
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']);
	    	}else{
	    		$estado_bovino = "activo";
				$array_update = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $_POST['llave_expediente'],
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,
				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"int_cant_parto" => 0,
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dat_fecha_ult_parto" => "",
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']);
			}
			$resultado = $modelo->actualizar_generica($array_update);

			if ($resultado[0] == '1') {
			print json_encode(array("Exito", $_POST['llave_expediente'], $resultado));
			exit();
			} else {
			print json_encode(array("Error", $_POST, $resultado));
			exit();
			}

        //termina el if  ELSE encontrado
		}

	 
	 //aqui termina el if de exito
	}else{
		if ($_POST['tipo_bovino'] == "vaca_lechera") {
				$estado_bovino = "activo";
				$array_update = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $_POST['llave_expediente'],
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,
				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"int_cant_parto" => $_POST['cant_parto_bovino'],
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dat_fecha_ult_parto" => $modelo->formatear_fecha($_POST['fecha_ult_parto']),
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']);
	    	}else{
	    		$estado_bovino = "activo";
				$array_update = array(
				"table" => "tb_expediente",
				"int_idexpediente" => $_POST['llave_expediente'],
				"nva_nom_bovino" => $_POST['nom_bovino'],
				"nva_estado_bovino" => $estado_bovino,
				"nva_sexo_bovino" => $_POST['sexo_bovino'],
				"int_cant_parto" => 0,
				"txt_descrip_expediente" => $_POST['descrip_expediente'],
				"int_id_propietario" => $_POST['propietario'],
				"int_idraza" => $_POST['raza_bovino_select'],
				"nva_tipo_bovino" => $_POST['tipo_bovino'],
				"dat_fecha_ult_parto" => "",
				"dou_costo_bovino" => $_POST['costo'],
				"dou_precio_venta_bovino" => $_POST['precioVenta']);
			}
			$resultado = $modelo->actualizar_generica($array_update);

			if ($resultado[0] == '1') {
			print json_encode(array("Exito", $_POST['llave_expediente'], $resultado));
			exit();
			} else {
			print json_encode(array("Error", $_POST, $resultado));
			exit();
			}
	}

} else {
	$htmltr = $html = "";
	$cuantos = 0;
	$sql = "SELECT
						nva_nom_raza, 
						int_idexpediente, 
						nva_nom_bovino, 
						nva_tipo_bovino, 
						nva_foto_bovino,
						nva_nombres_propietario
					FROM
						tb_expediente
						INNER JOIN
						tb_propietario
						ON 
							tb_expediente.int_id_propietario = tb_propietario.int_id_propietario
						INNER JOIN
						tb_raza
						ON 
							tb_expediente.int_idraza = tb_raza.int_idraza
							WHERE nva_estado_bovino !='inactivo' ";
	$result = $modelo->get_query($sql);
	if ($result[0] == '1') {

		foreach ($result[2] as $row) {
			$htmltr .= '<tr>
		                            <td>' . $row['nva_nom_bovino'] . '</td>
		                            <td><img alt="img" width="90" height="90" src="'. $row['nva_foto_bovino'] .'"></td>
		                            <td>' . $row['nva_tipo_bovino'] . '</td>
		                            <td>' . $row['nva_nombres_propietario'] . '</td>
		                            <td>' . $row['nva_nom_raza'] . '</td>
		                            <td>
		                            <button class="btn btn-info btn-sm btn_editar"
				                        	data-int_idexpediente=' . $row['int_idexpediente'] . '>
				                            <i class="fas fa-pencil-alt"></i>
				                      

				                </td>
		                        </tr>';
		}
		$html .= '<table id="tabla_expediente" class="table table-striped projects" cellspacing="0" width="100%">
	                    <thead>
	                    
	                        <tr>
	                            <th>Bovino</th>
	                            <th>Imagen</th>
	                            <th>Tipo</th>
	                            <th>Propietario</th>
	                            <th>Raza</th>
	                            <th>Acciones</th>
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
