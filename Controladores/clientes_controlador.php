<?php 
    
    require_once("../Conexion/Modelo.php");
    $modelo = new Modelo();
    if (isset($_POST['dar_baja']) && $_POST['dar_baja']=="si_dar") {

        $estado = "inactivo";

        $array_update = array(
                    "table" => "tb_clientes",
                    "int_idcliente" => $_POST['id_baja'],
                    "nva_estado_cliente" => $estado);

        $resultado = $modelo->actualizar_generica($array_update);

        if($resultado[0]=='1' && $resultado[4]>0){
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

    }else if (isset($_POST['consultar_info']) && $_POST['consultar_info']=="si_id_especifico") {


        
        $resultado = $modelo->get_todos("tb_clientes","WHERE int_idcliente = '".$_POST['id']."'");

        if($resultado[0]=='1'){
            print json_encode(array("Exito",$_POST,$resultado[2][0]));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$resultado));
            exit();
        }



    }else if (isset($_POST['almacenar_datos']) && $_POST['almacenar_datos']=="datonuevo") {

        $encontro = "";
        //consulta para obtener el nombre y el id del empleado registrados en la bd
       $sql = "SELECT
                    *
                FROM
                    tb_clientes
                WHERE
                    nva_estado_cliente != 'inactivo' ";

        $result_cliente_validado = $modelo->get_query($sql);

        if($result_cliente_validado[0]=='1' && $result_cliente_validado[4] >= 1){


            foreach ($result_cliente_validado[2] as $row) {
                
                if (($row['nva_dui_cliente'] == $_POST['dui_cliente']) && ($row['nva_nom_cliente'] == $_POST['nombre_cliente']) && ($row['nva_ape_cliente'] == $_POST['apellido_cliente']) && ($row['txt_direc_cliente'] == $_POST['direc_cliente']) && ($row['nva_telefono_cliente'] == $_POST['telefono_cliente'])) {
                    $encontro = "completos";
                    break;
                }else if ($row['nva_dui_cliente'] == $_POST['dui_cliente']) {
                    $encontro = "dui encontrado";
                    break;
                }else if($row['nva_telefono_cliente'] == $_POST['telefono_cliente']){
                   $encontro = "tel encontrado";
                    break;
                }
            }
            //si encontramos un datos ya registrados, notificamos antes de guardar
            if ($encontro == "completos") {
                print json_encode(array("Error","datos iguales",$result_cliente_validado));
                exit();
          
            }else if ($encontro == "dui encontrado") {
                print json_encode(array("Error","dui",$result_cliente_validado));
                exit();

            
            }else if ($encontro == "tel encontrado") {
                print json_encode(array("Error","tel",$result_cliente_validado));
                exit();
            //sino, guardamos todos los datos   
            }else{
                
                $id_insertar = $modelo->retonrar_id_insertar("tb_clientes");
                $estado_cliente = "Activo" ;
                $array_insertar = array(
                    "table" => "tb_clientes",
                    "int_idcliente"=>$id_insertar,
                    "nva_dui_cliente" => $_POST['dui_cliente'],
                    "nva_nom_cliente" => $_POST['nombre_cliente'],
                    "nva_ape_cliente" => $_POST['apellido_cliente'],
                    "txt_direc_cliente" => $_POST['direc_cliente'],
                    "nva_telefono_cliente" => $_POST['telefono_cliente'],
                    "nva_estado_cliente" => $estado_cliente);
                $result = $modelo->insertar_generica($array_insertar);
                if($result[0]=='1' ){

                    print json_encode(array("Exito",$id_insertar,$_POST,$result));
                    exit();

                }else {
                    print json_encode(array("Error",$_POST,$result));
                    exit();
                }
            }
        }else{

            $id_insertar = $modelo->retonrar_id_insertar("tb_clientes");
                $estado_cliente = "Activo" ;
                $array_insertar = array(
                    "table" => "tb_clientes",
                    "int_idcliente"=>$id_insertar,
                    "nva_dui_cliente" => $_POST['dui_cliente'],
                    "nva_nom_cliente" => $_POST['nombre_cliente'],
                    "nva_ape_cliente" => $_POST['apellido_cliente'],
                    "txt_direc_cliente" => $_POST['direc_cliente'],
                    "nva_telefono_cliente" => $_POST['telefono_cliente'],
                    "nva_estado_cliente" => $estado_cliente);
                $result = $modelo->insertar_generica($array_insertar);
                if($result[0]=='1' ){

                    print json_encode(array("Exito",$id_insertar,$_POST,$result));
                    exit();

                }else {
                    print json_encode(array("Error",$_POST,$result));
                    exit();
                }
        }

        
    
         
    }else{

      

        $htmltr = $html="";
        $cuantos = 0;
        $sql = "SELECT
                    *
                FROM
                    tb_clientes
                WHERE
                    nva_nom_cliente != 'Consumidor Final'
                AND  nva_estado_cliente != 'inactivo' ";
        $result = $modelo->get_query($sql);
        if($result[0]=='1'){
            
            foreach ($result[2] as $row) {  
                 $htmltr.='<tr>
                                <td class="text-center">'.$row['nva_dui_cliente'].'</td>
                                <td >'.$row['nva_nom_cliente'].'</td>
                                <td >'.$row['nva_ape_cliente'].'</td>
                                <td >'.$row['txt_direc_cliente'].'</td>
                                <td class="text-center">'.$row['nva_telefono_cliente'].'</td>                              
                                <td class="text-center project-actions">
                                    <button class="btn btn-info btn-sm btn_edit_cliente"  data-idcliente='.$row['int_idcliente'].'>
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm btn_baja_cliente" 
                                     data-idcltbaja='.$row['int_idcliente'].'>
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>'; 
            }
            $html.='<table id="example1" class="table table-striped projects" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center">DUI</th>
                            <th >Nombre</th>
                            <th >Apellido</th>
                            <th >Direción</th>
                            <th class="text-center">Teléfono</th>
                            <th class="text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>';
            $html.=$htmltr;
            $html.='</tbody>
                        </table>';


            print json_encode(array("Exito",$html,$cuantos,$_POST,$result));
            exit();

        }else {
            print json_encode(array("Error",$_POST,$result));
            exit();
        }
    }

?>