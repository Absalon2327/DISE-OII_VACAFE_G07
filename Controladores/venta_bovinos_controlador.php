<?php 
	session_start();
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();	
	$agregar_pro_seleccionado = [];
	$tipo_doc = "";
	
	if (isset($_POST['almacenar_venta_b']) && $_POST['almacenar_venta_b']=="nueva_venta_b") {

		
				//VERIFICAMOS SI HAY PRODUCTOS SELECCIONADOS
		
		if(isset($_POST['idexpediente']) && isset($_POST['precio_bovino_venta']) && isset($_POST['cantidad'])){
				$idexpediente = $_POST['idexpediente'];
				$precio_bovino = $_POST['precio_bovino_venta'];
				$cantidad = $_POST['cantidad'];

				//INSERTO EL ENCBEZADO DE LA VENTA
				$id_insertar = $modelo->retonrar_id_insertar("tb_venta");
				$sitio_compra = "n/a";				
		        $array_insertar = array(
		            "table" => "tb_venta",
		            "int_idventa"=>$id_insertar,
		            "dou_total_venta" => $_POST['total_g_venta_b'],
		            "dou_iva_venta" => $_POST['iva_v_venta_b'],
		            "dat_fecha_venta" => $modelo->formatear_fecha_hora($_POST['fecha_venta_b']),
		            "dat_fecha_sistema_venta" => date("Y-m-d G:i:s"),
		            "nva_tipo_documento" => $_POST['tipo_doc_venta_b'],
		            "int_idempleado" => $_POST['empleado_venta_b'],
		            "int_id_cliente" => $_POST['cliente_venta_b'],
		            "int_num_doc" => $_POST['num_fact_guardar_b']
		        );
		        $result_venta = $modelo->insertar_generica($array_insertar);
				$tipo_doc = $_POST['tipo_doc_venta_b'];
				$numfact = $_POST['num_fact_guardar_b'];
				$id_mostrar_v_b = $id_insertar;
		    if($result_venta[0]=='1'){//EVALUA SI LA VENTA SE RALIAZÓ CORRECTAMENTE

										
		        	//CON ESTA CONSULTA OBTENGO EL ÚLTIMO REGISTRO INGRESADO EN EL ENCABEZADO DE LA VEENTA
			        $sql ="SELECT * FROM tb_venta ORDER BY int_idventa DESC LIMIT 1;";
					$result_ultima_venta = $modelo->get_query($sql);

					$num_elementos=0;

					if($result_ultima_venta[0]=='1'){						
						
						while ($num_elementos < count($idexpediente)) {
							
							//INSERTANDO EN LA TABLA DETALLE-VENTA
							$id_insertar = $modelo->retonrar_id_insertar("tb_detalle_venta");				
					        $array_insertar = array(
					            "table" => "tb_detalle_venta",
					            "int_iddventa"=> $id_insertar,
					            "int_cantidad_vender" => $cantidad[$num_elementos],
					            "dou_precio_venta" => $precio_bovino[$num_elementos],
					            "dou_subtotal_item_vender" => $cantidad[$num_elementos] * $precio_bovino[$num_elementos],
					            "int_idexpediente" =>  $idexpediente[$num_elementos],
					            "int_idventa" => $result_ultima_venta[2][0]['int_idventa']
					        );
					        $result_det_compra = $modelo->insertar_generica($array_insertar);
					        //ACTUALIZO L EXISTANCIA DE LOS PRODUCTOS COMPRADOS 
					        $estado = "vendido";
				        	$array_update_stock_productos = array(
					            "table" => "tb_expediente",
					            "int_idexpediente" => $idexpediente[$num_elementos],
					            "nva_estado_bovino"=> $estado          
				       		);
							$resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);							
						 	$num_elementos=$num_elementos+1;
						}
					}else{
						//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
						$array = array("Error","ultimaventa",$result_existencia);
						print json_encode($array);
						exit();
					}
					
		        	
		        	print json_encode(array("Exito",$_POST,$result_venta,$tipo_doc,$id_mostrar_v_b,$numfact));
					exit();
	        }else {
	        	//ENVIO EL ERROR OBTENIDO EN ESTA POSICIÓN
				$array = array("Error","en la insercion de la venta",$result_venta);
				print json_encode($array);
				exit();
	        }
    	}else {
	        //CUANDO NO HAY PRODUCTOS SELECCIONADOS
			$array = array("Error","no hay productos",$_POST);
			print json_encode($array);
			exit();
	    }		 
	}else{

		$array_select = array(
			"table"=>"tb_clientes",
			"int_idcliente"=>"nva_nom_cliente"

		);
		 
		$result_select = $modelo->crear_select($array_select);		
					
		$htmltr = $html="";
		$cuantos = 0;
		$num_Factura = 0;
		$sql ="SELECT
					int_idexpediente, 
					nva_nom_bovino, 
					nva_estado_bovino, 
					nva_nom_raza,
					dou_precio_venta_bovino, 
					nva_foto_bovino
				FROM
					tb_expediente
					INNER JOIN
					tb_raza
					ON 
						tb_expediente.int_idraza = tb_raza.int_idraza
				WHERE
					nva_estado_bovino != 'vendido'";

		$sql_num ="SELECT int_idventa FROM tb_venta ORDER BY int_idventa DESC LIMIT 1;";

		$result = $modelo->get_query($sql);
		$result_num_fact = $modelo->get_query($sql_num);
		if($result_num_fact[0]=='1' && $result_num_fact[4] >= 1){

			$num_Factura = $result_num_fact[2][0]['int_idventa'];
			
		}else{
			$num_Factura = 0;
		}
		if($result[0]=='1'){
			
			foreach ($result[2] as $row) {	
				 $htmltr.='<tr>
	                            <td>'.$row['nva_nom_bovino'].'</td>
	                            <td>
	                            <div class="product-image-thumb active">
	                            	<img alt="Product Image" style="width: 89px; height: 81px;" src="'.$row['nva_foto_bovino'].'">
	                            </div>
	                            </td>
	                            <td class="text-center">'.$row['nva_nom_raza'].'</td>
	                            <td class="text-center">'."$".''.$row['dou_precio_venta_bovino'].'</td>
	                            <td class="text-center project-actions">
			                        <button class="btn btn-info btn-sm btn_bovino_seleccionado" 
			                        	data-idbovino_seleccionado="'.$row['int_idexpediente'].'" 
			                        	data-nombre_bovino_selec="'.$row['nva_nom_bovino'].'"	
			                        	data-precio_bovino_selec="'.$row['dou_precio_venta_bovino'].'"
			                        	data-foto_bovino_selec="'.$row['nva_foto_bovino'].'"
			                        	data-raza_bovino_selec="'.$row['nva_nom_raza'].'">
			                            <i class="fas fa-check"></i>
			                        </button>
			                    </td>
	                        </tr>';	
			}
			$html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Imagen</th>
                            <th class="text-center">Raza</th>
                            <th class="text-center">Precio $</th>
                            <th class="text-center">Acción</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
			$html.='</tbody>
                    	</table>';

        	print json_encode(array("Exito",$html,$cuantos,$_POST,$result,$result_select,$num_Factura));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result,$_SESSION));
			exit();
        }
	}



?>