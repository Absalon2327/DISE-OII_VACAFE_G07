<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
 if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_actualizalo") {
		$array_update = array(
            "table" => "tb_control_vacunas",
            "int_id_control_vac" => $_POST['llave_vacuna'],
            "id_exped_aplicado"=>$_POST['exped_aplicado'],
            "dat_fecha_aplicacion" => $modelo->formatear_fecha($_POST['fecha_aplicacion']),
            "nva_vacuna_aplicada" => $_POST['vacuna'],
            "nva_dosis" => $_POST['dosis']
        	
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' && $resultado[4]>0){
        	print json_encode(array("Exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }


}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_condui_especifico") {

		$resultado = $modelo->get_todos("tb_control_vacunas","WHERE int_id_control_vac = '".$_POST['int_id_control_vac']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0]));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }



}else if (isset($_POST['ingreso_datos']) && $_POST['ingreso_datos']=="si_registro") {
			$encontro = "";
		//consulta para obtener el nombre de medicamento y la fecha de aplicacion la bd
		$sql = "SELECT
    id_exped_aplicado,
    date_format(dat_fecha_aplicacion, '%d/%m/%Y') as dat_fecha_aplicacion,
    nva_vacuna_aplicada 
    FROM
    tb_control_vacunas;";

		$result_nombre = $modelo->get_query($sql);

		//verifivamos si obtuvimos usuarios o no
		if($result_nombre[0]=='1'){

			foreach ($result_nombre[2] as $row) {
				
				if (($row['nva_vacuna_aplicada'] == $_POST['vacuna']) &&($row['dat_fecha_aplicacion'] == $_POST['fecha_aplicacion'])&&($row['id_exped_aplicado'] == $_POST['exped_aplicado'])){
					$encontro = "medicamento encontrado";
					break;
				}
			}
			 if ($encontro == "medicamento encontrado") {
				print json_encode(array("Error","Medicamento aplicado",$result_nombre));
				exit();

			//sino, guardamos todos los datos
			}else{
				$id_insertar = $modelo->retonrar_id_insertar("tb_control_vacunas"); 
       			$array_insertar = array(
			    "table" => "tb_control_vacunas",
			    "int_id_control_vac"=>$id_insertar,
			    "id_exped_aplicado"=>$_POST['exped_aplicado'],
			    "nva_vacuna_aplicada" => $_POST['vacuna'],
			    "dat_fecha_aplicacion" => $modelo->formatear_fecha($_POST['fecha_aplicacion']), 
			    "nva_dosis" => $_POST['dosis']);
                $result = $modelo->insertar_generica($array_insertar);
                if($result[0]=='1'){

        	    print json_encode(array("Exito",$_POST,$result));
			    exit();

                }else {
        	    print json_encode(array("Error",$_POST,$result));
			    exit();
                }
			}   
		}else{
			$id_insertar = $modelo->retonrar_id_insertar("tb_control_vacunas"); 
       			$array_insertar = array(
			    "table" => "tb_control_vacunas",
			    "int_id_control_vac"=>$id_insertar,
			    "id_exped_aplicado"=>$_POST['exped_aplicado'],
			    "nva_vacuna_aplicada" => $_POST['vacuna'],
			    "dat_fecha_aplicacion" => $modelo->formatear_fecha($_POST['fecha_aplicacion']), 
			    "nva_dosis" => $_POST['dosis']);
                $result = $modelo->insertar_generica($array_insertar);
                if($result[0]=='1' && $result[4]>0){

        	    print json_encode(array("Exito",$_POST,$result));
			    exit();

                }else {
        	    print json_encode(array("Error",$_POST,$result));
			    exit();
                }

		}

}else{
		$htmltr = $html="";
		$sql = "SELECT
	int_id_control_vac, 
	dat_fecha_aplicacion, 
	nva_nom_producto, 
	nva_nom_bovino
FROM
	tb_control_vacunas
	INNER JOIN
	tb_producto
	ON 
		nva_vacuna_aplicada = int_idproducto
	INNER JOIN
	tb_expediente
	ON 
		id_exped_aplicado = int_idexpediente
			WHERE
	nva_estado_bovino = 'activo' or nva_estado_bovino = 'parida' or nva_estado_bovino = 'preñada' ";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
          
			
			foreach ($result[2] as $row) {
				
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['nva_nom_bovino'].'</td>
	                            <td class="text-center">'.$row['nva_nom_producto'].'</td>
	                            <td class="text-center">'.$modelo->formatear_fecha($row['dat_fecha_aplicacion']).'</td>
                                <td class="text-center">
	                            <button class="btn btn-info btn-sm btn_editar "
			                        	data-int_id_control_vac=' . $row['int_id_control_vac'] . '>
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                         
			                </td>
	                        </tr>';	
			}
            	$html.='<table id="example1" class="table table-striped projects" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                           
                            <th class="text-center">Bovino</th>
                            <th class="text-center">Nombre de Vacuna</th>
                            <th class="text-center">Fecha de Aplicación</th>
                            <th class="text-center">Acciones</th>
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