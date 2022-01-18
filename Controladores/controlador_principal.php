 <?php
  require_once("../Conexion/Modelo.php");
  $modelo = new Modelo();
  //consulta para obtener la fecha
  if (isset($_POST['consultar_info']) && $_POST['consultar_info'] == "si_consultala") {
    $htmltr = $html = "";
    $parida = "";
    $cuantos = 0;
    $status = "";
    $esParida = false;
    $sql = "SELECT dat_fecha_parto,
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
          $status = "ya pario";
          $parida .= '<button class="btn btn-info btn-sm btn_ok " id="bntok"
                                               data-int_id_preñez=' . $row['int_id_preñez'] . ' >
                                                 <i class="fas fa-check">ok</i>
                                         </button >';
          $esParida = true;

          //si encontramos un empleado con un usuario creado, notificamos antes de guardar
        } else if ($dias <= 15) {
          $status = "está a " . $dias . " días de parir";
          $esParida = false;
        } else if ($dias <= 1) {
          $status = "mañana va a parir";
          $esParida = false;
        }
        $htmltr .= '<div class="alert alert-info alert-dismissible" id="alert_preñez">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <h4><i class="icon fas fa-info"></i> Alerta!</h4>
                      ' . $row['nva_nom_bovino'] . ' ' . $status . ' ' . ($esParida ?  $parida : '') . '     
                    </div>
                  
                   ';
      }




      print json_encode(array("Exito", $htmltr, $_POST, $result, $status));


      exit();
    } else {
      print json_encode(array("Error", $_POST, $result));
      exit();
    }
  }
