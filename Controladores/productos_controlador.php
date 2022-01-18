<?php 
	require_once("../Conexion/Modelo.php");
	$modelo = new Modelo();
	if (isset($_GET['subir_imagen']) && $_GET['subir_imagen']=="subir_imagen_ajax") {
		$trozos=explode(".",$_FILES['file-0']['name']);
		$extension= end($trozos);
		$name="img_".$_GET['id'].".".$extension;
		$file_path = "../archivo_producto/".$name;
		try {
			$mover = move_uploaded_file($_FILES['file-0']['tmp_name'], $file_path);
			$array_update= array(
				"table" => "tb_producto",
				"int_idproducto"=>$_GET['id'],
				"nva_image_producto"=> $file_path,
			);
			$resultado =$modelo->actualizar_generica($array_update);
			if($resultado[0]=='1' && $resultado[4]>0){
 			print json_encode(array("Exito",$mover,$resultado));

			}else{
             print json_encode(array("Error",$mover,$resultado));

			}			 
		} catch (Exception $e) {
			print json_encode(array("Error",$_POST));
				exit();
		}
		 

	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {
    $encontro = "";
		//consulta para obtener el nombre y el id del empleado registrados en la bd
		$sql = "SELECT
					int_idproducto,
					nva_nom_producto 
				FROM
					tb_producto;";

		$result_nombre = $modelo->get_query($sql);

		//verifivamos si obtuvimos usuarios o no
		if($result_nombre[0]=='1'){

			foreach ($result_nombre[2] as $row) {
				
				if ($row['nva_nom_producto'] == $_POST['nombre_Producto']) {
					$encontro = "nombre econtrado";
					break;
				}
			}
			//si encontramos un nombre identico, notificamos antes de guardar
			if ($encontro == "nombre econtrado") {
				print json_encode(array("Error","existe producto",$result_nombre));
				exit();
			//si encontramos un empleado con un usuario creado, notificamos antes de guardar			
			}else{
				if(($_POST['ctg_Producto'] == '2') || ($_POST['ctg_Producto'] == '3')){
					$id_insertar = $modelo->retonrar_id_insertar("tb_producto"); 
						$estado_producto = "Activo";
				        $array_insertar = array(
				            "table" => "tb_producto",
				            "int_idproducto"=>$id_insertar,
				            "nva_nom_producto" => $_POST['nombre_Producto'],
				            "int_existencia" => $_POST['existencia_Producto'],
				            "int_existencia_minima" => $_POST['existencia_Producto_min'],
				            "dou_costo_producto" => $_POST['precio_Producto'],
				            "txt_descrip_producto" => $_POST['descrip_Producto'],
				            "dat_fecha_vencimiento" => $modelo->formatear_fecha($_POST['fechav_Producto']),
				            "nva_estado_producto" => $estado_producto,
				            "int_idcategoria" => $_POST['ctg_Producto']  
				        );
				}else{
					$id_insertar = $modelo->retonrar_id_insertar("tb_producto"); 
					$estado_producto = "Activo";
			        $array_insertar = array(
			            "table" => "tb_producto",
			            "int_idproducto"=>$id_insertar,
			            "nva_nom_producto" => $_POST['nombre_Producto'],
			            "int_existencia" => $_POST['existencia_Producto'],
			            "dou_costo_producto" => $_POST['precio_Producto'],
			            "dou_precio_venta_producto" => $_POST['costo_Producto'],
			            "txt_descrip_producto" => $_POST['descrip_Producto'],
			            "dat_fecha_vencimiento" => $modelo->formatear_fecha($_POST['fechav_Producto']),
			            "nva_estado_producto" => $estado_producto,
			            "int_idcategoria" => $_POST['ctg_Producto']  
			        );
				}
       		 $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){
        	print json_encode(array("Exito",$id_insertar,$_POST,$result));
			exit();

        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
					}
				
			}
		}

	}else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevoc") {
		  
		  $encontro = "";
		//consulta para obtener el nombre y el id del empleado registrados en la bd
		$sql = "SELECT
					int_idcategoria,
					nva_nom_categoria 
				FROM
					tb_categoria;";

		$result_nombre = $modelo->get_query($sql);
		//verifivamos si obtuvimos usuarios o no
		if($result_nombre[0]=='1'){
			foreach ($result_nombre[2] as $row) {
				
				if ($row['nva_nom_categoria'] == $_POST['nombre_Categoria']) {
					$encontro = "nombre encontrado";
					break;
				}
			}
            //si encontramos un nombre identico, notificamos antes de guardar
			if ($encontro == "nombre en contrado") {
				print json_encode(array("Error","existe categoria",$result_nombre));
				exit();
			//si encontramos un empleado con un usuario creado, notificamos antes de guardar
		}else{
			$id_insertar = $modelo->retonrar_id_insertar("tb_categoria"); 
        $array_insertar = array(
            "table" => "tb_categoria",
            "int_idcategoria"=>$id_insertar,
            "nva_nom_categoria" => $_POST['nombre_Categoria']
        );
        $result = $modelo->insertar_generica($array_insertar);
        if($result[0]=='1'){
        	print json_encode(array("Exito",$id_insertar,$_POST,$result));
			exit();
        }else {
        	print json_encode(array("Error",$_POST,$result));
			exit();
		    }
		}
	}
}else if (isset($_POST['consultar_categorias']) && $_POST['consultar_categorias']=="si_consultar") {
		$array_select = array(
			"table"=>"tb_categoria",
			"int_idcategoria"=>"nva_nom_categoria"
		);		 
		$result_select = $modelo->crear_select($array_select);
		
        	print json_encode(array("Exito",$_POST,$result_select));
			exit();
	}
?>