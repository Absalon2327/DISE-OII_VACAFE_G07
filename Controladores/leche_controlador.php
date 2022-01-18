<?php 
	
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="si_actualizalo") {
		$array_update = array(
            "table" => "tb_botellas",
            "int_idbotella" => $_POST['llave_leche'],
            "dat_fecha_vencimiento_botella" => $modelo->formatear_fecha($_POST['fecha_Leche']),
            "int_cantidad" => $_POST['cantidad_Leche'], 
            "dou_costo_botella" => $_POST['precio_Leche'],
            "int_idproducto" => $_POST['botella_Leche']
        );
		$resultado = $modelo->actualizar_generica($array_update);

		if($resultado[0]=='1' ){
        	print json_encode(array("exito",$_POST,$resultado));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }

	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {
		$id_insertar = $modelo->retonrar_id_insertar("tb_botellas"); 
        $array_insertar = array(
            "table" => "tb_botellas",
            "int_idbotella"=>$id_insertar,
            "dou_costo_botella" => $_POST['precio_Leche'],
            "int_cantidad" => $_POST['cantidad_Leche'],
            "dat_fecha_vencimiento_botella" => $modelo->formatear_fecha($_POST['fecha_Leche']),
            "int_idproducto" => $_POST['botella_Leche']  
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){


        	print json_encode(array("Exito",$id_insertar,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
    
		 
	}else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_coneste_id") {


			$array_select = array(
			"table"=>"tb_producto",
			"int_idproducto"=>"nva_nom_producto" 

		);
		$where = "WHERE int_idproducto=".$_POST['idproducto']."";
		$result_select = $modelo->crear_select($array_select,$where);


		$resultado = $modelo->get_todos("tb_botellas","WHERE int_idbotella = '".$_POST['idbotella']."'");
		if($resultado[0]=='1'){
        	print json_encode(array("Exito",$_POST,$resultado[2][0],$result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$resultado));
			exit();
        }

	}else{
		$array_select = array(
			"table"=>"tb_producto",
			"int_idproducto"=>"nva_nom_producto" 

		);
		$where = "WHERE int_idcategoria = 1";
		$result_select = $modelo->crear_select($array_select,$where);
		 
		$htmltr = $html="";
		$cuantos = 0;
					$sql = "SELECT
						    tb_botellas.int_idbotella,
							tb_botellas.dat_fecha_vencimiento_botella, 
							tb_botellas.int_cantidad, 
							tb_botellas.dou_costo_botella,
							tb_producto.nva_nom_producto,
							tb_botellas.int_idproducto
						FROM
							tb_botellas
							INNER JOIN tb_producto ON tb_botellas.int_idproducto = tb_producto.int_idproducto 
							WHERE int_idcategoria = 1";		
	$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
				 				<td>'.$row['nva_nom_producto'].'</td>
	                            <td>'.$modelo->formatear_fecha($row['dat_fecha_vencimiento_botella']).'</td>
	                            <td>'.$row['int_cantidad'].'</td>
	                            <td>$'.$row['dou_costo_botella'].'</td>
	                                              
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_editar" 
			                        	data-idbotella="'.$row['int_idbotella'].'"
			                        	data-idproducto="'.$row['int_idproducto'].'">
			                            <i class="fas fa-pencil-alt"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects"  style="text-align:center;"width="100%">
                    <thead>
                        <tr>
                        	<th>Producto</th>
                            <th>Fecha Vencimiento</th>
                            <th>Cantidad</th>
                            <th>Costo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';


        	print json_encode(array("Exito",$html,$_POST,$result, $result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
        }
	}

?>