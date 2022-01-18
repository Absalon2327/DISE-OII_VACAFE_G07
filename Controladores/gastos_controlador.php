<?php 
    
    require_once("../Conexion/Modelo.php");
    $modelo = new Modelo();
    if (isset($_POST['anular_gasto']) && $_POST['anular_gasto']=="si_anular") {

        $estado = "anulado";
        $balance_existencia = 0;

        $sql = "SELECT
                    *
                FROM
                    tb_producto 
                WHERE int_idproducto = '".$_POST['idpro']."';";

        $resultado = $modelo->get_query($sql);
        $array_update = array(
            "table" => "tb_gastos",
            "int_idgastos" => $_POST['idgasto'],
            "nva_estado_gasto" => $estado
        );

        $balance_existencia = $resultado[2][0]['int_existencia'] + $_POST['existencia'];
        
        $resultado = $modelo->actualizar_generica($array_update);

        if($resultado[0]=='1' && $resultado[4]>0){

            $array_update_stock_productos = array(
                    "table" => "tb_producto",
                    "int_idproducto" => $_POST['idpro'],
                    "int_existencia"=> $balance_existencia           
                );
                $resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);

                

            print json_encode(array("Exito",$_POST,$resultado));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }
        


    }else if (isset($_POST['editar_datos']) && $_POST['editar_datos']=="si_editar") {
        $encontro = "";
        //consulta para obtener el nombre y el id del empleado registrados en la bd
       $sql = "SELECT
                    *
                FROM
                    tb_clientes
                WHERE
                    int_idcliente != '$_POST[llave_cliente]' 
                AND
                    nva_estado_cliente != 'inactivo'";

        $result_cliente_val_edit = $modelo->get_query($sql);

        if($result_cliente_val_edit[0]=='1' && $result_cliente_val_edit[4] >= 1){

            foreach ($result_cliente_val_edit[2] as $row) {
                
                if (($row['nva_dui_cliente'] == $_POST['dui_cliente_edit']) && ($row['nva_nom_cliente'] == $_POST['nombre_cliente_edit']) && ($row['nva_ape_cliente'] == $_POST['apellido_cliente_edit']) && ($row['direc_cliente_edit'] == $_POST['direc_cliente']) && ($row['nva_telefono_cliente'] == $_POST['telefono_cliente_edit'])) {
                    $encontro = "completos";
                    break;
                }else if ($row['nva_dui_cliente'] == $_POST['dui_cliente_edit']) {
                    $encontro = "dui encontrado";
                    break;
                }else if($row['nva_telefono_cliente'] == $_POST['telefono_cliente_edit']){
                   $encontro = "tel encontrado";
                    break;
                }
            }
             if ($encontro == "completos") {
                print json_encode(array("Error","datos iguales",$result_cliente_val_edit));
                exit();
          
            }else if ($encontro == "dui encontrado") {
                print json_encode(array("Error","dui",$result_cliente_val_edit));
                exit();

            
            }else if ($encontro == "tel encontrado") {
                print json_encode(array("Error","tel",$result_cliente_val_edit));
                exit();
            //sino, guardamos todos los datos   
            }else{
                $array_update = array(
                    "table" => "tb_clientes",
                    "int_idcliente" => $_POST['llave_cliente'],
                    "nva_dui_cliente"=>$_POST['dui_cliente_edit'],
                    "nva_nom_cliente" => $_POST['nombre_cliente_edit'],
                    "nva_ape_cliente" => $_POST['apellido_cliente_edit'],
                    "txt_direc_cliente" => $_POST['direc_cliente_edit'], 
                    "nva_telefono_cliente" => $_POST['telefono_cliente_edit']);
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
                    "table" => "tb_clientes",
                    "int_idcliente" => $_POST['llave_cliente'],
                    "nva_dui_cliente"=>$_POST['dui_cliente_edit'],
                    "nva_nom_cliente" => $_POST['nombre_cliente_edit'],
                    "nva_ape_cliente" => $_POST['apellido_cliente_edit'],
                    "txt_direc_cliente" => $_POST['direc_cliente_edit'], 
                    "nva_telefono_cliente" => $_POST['telefono_cliente_edit']);
                $resultado = $modelo->actualizar_generica($array_update);

                if($resultado[0]=='1' && $resultado[4]>0){
                    print json_encode(array("Exito",$_POST,$resultado));
                    exit();

                }else {
                    print json_encode(array("Error",$_POST,$resultado));
                    exit();
                }
            }

    }else if (isset($_POST['consulta_existencia']) && $_POST['consulta_existencia']=="si_consultala") {


        
        $resultado = $modelo->get_todos("tb_producto","WHERE int_idcategoria != 4 AND nva_estado_producto = 'Activo' AND int_idproducto = '$_POST[idProducto]'");

        if($resultado[0]=='1' && $resultado[4] >= 1 ){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if (isset($_POST['almacenar_gasto']) && $_POST['almacenar_gasto']=="gastonuevo") {
            $estado_gasto = 'Activo';
            $nueva_existencia = 0;
            $resultado = $modelo->get_todos("tb_producto","WHERE int_idproducto = '".$_POST['cbx_insumo']."'");
            $id_insertar = $modelo->retonrar_id_insertar("tb_gastos");
            $array_insertar = array(
                "table" => "tb_gastos",
                "int_idgastos"=>$id_insertar,
                "dat_fecha_gasto" => $modelo->formatear_fecha_hora($_POST['fecha_gasto']),
                "int_idproducto" => $_POST['cbx_insumo'],
                "int_cantidad_gastar" => $_POST['cantidad_insumo'],
                "nva_estado_gasto" => $estado_gasto
            );


            $nueva_existencia = $resultado[2][0]['int_existencia'] - $_POST['cantidad_insumo'];
            $result = $modelo->insertar_generica($array_insertar);

            if($result[0]=='1' ){


                $array_update_stock_productos = array(
                    "table" => "tb_producto",
                    "int_idproducto" => $_POST['cbx_insumo'],
                    "int_existencia"=> $nueva_existencia           
                );
                $resultado_stock = $modelo->actualizar_generica($array_update_stock_productos);

                if ($resultado_stock[0]=='1') {
                    print json_encode(array("Exito",$resultado_stock));
                    exit();
                }else{
                    print json_encode(array("Error","existencias",$resultado_stock));
                    exit();
                }

                print json_encode(array("Exito",$id_insertar,$_POST,$result));
                exit();

            }else {
                print json_encode(array("Error",$_POST,$result));
                exit();
            }
        
    }else{

        $array_select = array(
            "table"=>"tb_producto",
            "int_idproducto"=>"nva_nom_producto"

        );
        $where = "WHERE int_idcategoria != 4 AND nva_estado_producto = 'Activo'";       
        $result_select = $modelo->crear_select($array_select, $where);

        $htmltr = $html="";
        $cuantos = 0;
        $sql = "SELECT
                    * 
                FROM
                    tb_gastos
                    INNER JOIN tb_producto ON tb_gastos.int_idproducto = tb_producto.int_idproducto
                    INNER JOIN tb_categoria ON tb_producto.int_idcategoria = tb_categoria.int_idcategoria
                WHERE nva_estado_gasto = 'Activo'";
        $result = $modelo->get_query($sql);
        if($result[0]=='1'){
            
            foreach ($result[2] as $row) {  
                 $htmltr.='<tr>
                                <td >'.datetimeformateado($row['dat_fecha_gasto']).'</td>
                                <td >'.$row['nva_nom_producto'].'</td>
                                <td class="text-center">'.$row['int_cantidad_gastar'].'</td>
                                <td class="text-center">'.$row['int_existencia'].'</td>                           
                                <td class="text-center project-actions">
                                    <button class="btn btn-danger btn-sm btn_anular_gasto"  data-idgasto="'.$row['int_idgastos'].'" data-existencia="'.$row['int_cantidad_gastar'].'" data-pro="'.$row['int_idproducto'].'">
                                        <i class="fa fa-trash"></i>
                                    </button>                                    
                                </td>
                            </tr>'; 
            }
            $html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th>Fecha y Hora</th>
                            <th >Insumo</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-center">Sado Actual</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
            $html.='</tbody>
                        </table>';


            print json_encode(array("Exito",$html,$cuantos,$_POST,$result,$result_select));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$result));
            exit();
        }
    
    }

    function datetimeformateado($fecha3){

            //divido la feha de la hora
            $separacion= explode(" ",$fecha3);
            $hora = $separacion[1];
            $fecha = $separacion[0];

            $pos = strpos($fecha, "/");
            if ($pos === false) $fecha = explode("-",$fecha);
            else $fecha = explode("/",$fecha);
            $dia1 = (strlen($fecha[0])==1) ? '0'.$fecha[0] : $fecha[0];

            //Concateno la fecha formteada con la hora y un espacio
            $fecha1 = $fecha[2].'-'.$fecha[1].'-'.$dia1.' '.$hora;
            return $fecha1;
    }

?>