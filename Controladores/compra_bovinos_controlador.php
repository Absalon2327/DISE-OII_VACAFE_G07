<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];

	
	if (isset($_POST['almacenar_compra_b']) && $_POST['almacenar_compra_b']=="nueva_compra_b") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		
		if(isset($_POST['idexpediente']) && isset($_POST['costo_bovino_compra']) && isset($_POST['cantidad'])){
				$idexpediente = $_POST['idexpediente'];
				$costo_item = $_POST['costo_bovino_compra'];
				$cantidad = $_POST['cantidad'];
				$id_insertar = $modelo->retonrar_id_insertar("tb_compra");
				$sitio_compra = "n/a";
				//INSERTO EL ENCBEZADO DE LA COMPRA
		        $array_insertar = array(
		            "table" => "tb_compra",
		            "int_idcompra"=>$id_insertar,
		            "txt_descrip_compra" => $_POST['descrip_compra_b'],
		            "dou_total_compra" => $_POST['total_compra_guardar_b'],
		            "dou_iva_aplicado" => $_POST['iva_guardar_b'],
		            "dat_fecha_compra" => $modelo->formatear_fecha_hora($_POST['fecha_compra_b']),
		            "dat_fecha_sistema" => date("Y-m-d G:i:s"),
		            "nva_tipo_documento" => $_POST['tipo_doc_compra_b'],
		            "nva_numero_documento" => $_POST['num_doc_compra_b'],
		            "txt_sitio_compra" => $sitio_compra,
		            "int_idproveedor" => $_POST['proveedor_compra_b'],
		            "int_idempleado" => $_POST['empleado_compra_b']
		        );
		        $result_compra = $modelo->insertar_generica($array_insertar);

		    if($result_compra[0]=='1'){//EVALUA SI LA COMPRA SE RALIAZÓ CORRECTAMENTE

										
		        	//CON ESTA CONSULTA OBTENGO EL ÚLTIMO REGISTRO INGRESADO EN EL ENCABEZADO DE LA COMPRA
			        $sql ="SELECT * FROM tb_compra ORDER BY int_idcompra DESC LIMIT 1;";
					$result_ultima_compra = $modelo->get_query($sql);

					$num_elementos=0;

					if($result_ultima_compra[0] == '1' && $result_ultima_compra[4] >= 1){						
						
						while ($num_elementos < count($idexpediente)) {
							

							//INSERTANDO EN LA TABLA DETALLE-COMPRA
							$id_insertar = $modelo->retonrar_id_insertar("tb_detalle_compra");				
					        $array_insertar = array(
					            "table" => "tb_detalle_compra",
					            "int_iddcompra"=> $id_insertar,
					            "int_cantidad_compra" => 1,
					            "dou_costo_compra" => $costo_item[$num_elementos],
					            "dou_subtotal_item_compra" => 1 * $costo_item[$num_elementos],
					            "int_idexpediente" =>  $idexpediente[$num_elementos],
					            "int_idcompra" => $result_ultima_compra[2][0]['int_idcompra']
					        );
					        $result_det_compra = $modelo->insertar_generica($array_insertar);
					        //ACTUALIZO L EXISTANCIA DE LOS PRODUCTOS COMPRADOS 
					        if($result_det_compra[0]=='1'){

					        	$array_update_costo_expediente = array(
					            "table" => "tb_expediente",
					            "int_idexpediente" => $idexpediente[$num_elementos],
					            "dou_costo_bovino"=> $costo_item[$num_elementos]          
					       		);
								$resultado_costo_Expediente = $modelo->actualizar_generica($array_update_costo_expediente);							
							 	$num_elementos=$num_elementos+1;

					        }else{
					        	$array = array("Error","detalle",$result_det_compra);
								print json_encode($array);
								exit();
					        }
				        	
						}
					}else{
						//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
						$array = array("Error","ultimacompra",$result_ultima_compra);
						print json_encode($array);
						exit();
					}
					
		        	
		        	print json_encode(array("Exito",$_POST,$result_compra,$_SESSION));
					exit();
	        }else {
	        	//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
				$array = array("Error","en la insercion de la compra",$result_compra);
				print json_encode($array);
				exit();
	        }
    	}else {
	        //CUANDO NO HAY PRODUCTOS SELECCIONADOS
			$array = array("Error","no hay bovinos",$_SESSION);
			print json_encode($array);
			exit();
	    }		 
	}else{
		$array_select = array(
			"table"=>"tb_proveedor",
			"int_idproveedor"=>"nva_nom_proveedor"
		);		 
		$result_select = $modelo->crear_select($array_select);		
					
		$htmltr = $html="";
		$cuantos = 0;
		$sql ="SELECT
					int_idexpediente, 
					nva_nom_bovino, 
					nva_estado_bovino, 
					nva_nom_raza, 
					nva_foto_bovino
				FROM
					tb_expediente
					INNER JOIN
					tb_raza
					ON 
						tb_expediente.int_idraza = tb_raza.int_idraza
				WHERE
					nva_estado_bovino != 'vendido'";
		$result = $modelo->get_query($sql);
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td class="text-center">'.$row['nva_nom_bovino'].'</td>
	                            <td>
	                            	<div class="product-image-thumb active">
	                            		<img alt="Product Image" style="width: 89px; height: 81px;" src="'.$row['nva_foto_bovino'].'">
	                            	</div>
	                            </td>
	                            <td class="text-center">'.$row['nva_nom_raza'].'</td>

	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_bovino_seleccionado" data-idbovino_seleccionado="'.$row['int_idexpediente'].'"
			                        	data-nombre_bovino_selec="'.$row['nva_nom_bovino'].'" data-foto_bovino_selec="'.$row['nva_foto_bovino'].'"
			                        	data-raza_bovino_selec="'.$row['nva_nom_raza'].'">
			                            <i class="fas fa-check"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">Fotogrfía</th>
                            <th class="text-center">Raza</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';

            $_SESSION['comprando']="si";
        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result,$result_select));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result,$result_select));
			exit();
        }
	}



?>