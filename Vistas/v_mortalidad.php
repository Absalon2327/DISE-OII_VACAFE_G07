<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baja| Registro</title>
     <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
    <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Bootstrap4 Duallistbox -->
    <link rel="stylesheet" href="../plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
    <!-- BS Stepper -->
    <link rel="stylesheet" href="../plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- dropzonejs -->
    <link rel="stylesheet" href="../plugins/dropzone/min/dropzone.min.css">

    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <?php
        require_once('../Menus/menusidebar.php');
        ?>

        <!-- CCONTENIDO DE LA PÁGINA -->
        <div class="content-wrapper">

            <!-- Main content -->
            <section class="content">
                <div class="card ">
                    <div class="card-header bg-success">

                        <h1 class=" card-title">Registro de Baja</h1>
                        <div class="card-tools">
                            <a class="btn btn-success " href="#md_registrar_mortalidad" data-toggle="modal">
                                <i class="fas fa-plus-circle"></i>
                                Nuevo
                            </a>
                        </div>
                    </div>

                    <div class="col-xs-12">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- TABLA VACUNA -->
                        <div class="card-body" id="datos_tabla">


                        </div>
                    </div>
                </div>
            </section>

            <!-- MODAL GUARDAR -->
            <div class="modal fade" id="md_registrar_mortalidad">
                <div class="modal-dialog modal-ml" role="document">
                    <div class="modal-content">
                        <form name="formulario_registroM" id="formulario_registroM">
                            <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                            <input type="hidden" id="llave_baja" name="llave_baja" value="si_registro">
                            <input type="hidden" name="almacenar_datos" value="datonuevo">
                            <div class="modal-header bg-success">
                                <h1 class="modal-title text-center " id="exampleModalLabel">Registro de Baja </h1>
                                <button type="button" class="btn bg-success btn_cerrar_class" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $usuario = 'root';
                                        $password = '';
                                        $db = new PDO('mysql:host=localhost;dbname=db_finca', $usuario, $password);
                                        ?>
                                        <div class="form-group">

                                            <label>Bovino</label>
                                            <div class="input-group
                                            mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-expand-arrows-alt"></i>
                                                </span>
                                                <select class="form-control" name="idexpeiente_baja" id="idexpeiente_baja" class="form-control select2">
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php
                                                    $query = $db->prepare("SELECT int_idexpediente,nva_nom_bovino FROM tb_expediente WHERE nva_estado_bovino != 'inactivo'");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_idexpediente"] . '">' . $valores["nva_nom_bovino"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <label>Fecha de baja</label>

                                        <div class="input-group
                                                mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas
                                                            fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control
                                                    disabled" placeholder="mm/dd/yyyy" required name="fehca_baja" id="fehca_baja" autocomplete="off">
                                        </div>

                                        <label>Descripción</label>
                                        <div class="input-group
                                                mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa fa-square"></i></span>
                                            </div>

                                            <input type="text are" class="form-control" required id="descripcion_baja" name="descripcion_baja" autocomplete="off">
                                            <div class="input-group-append">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                  <div class="modal-footer float-right">
                                   <button type="submit" id="boton_enviar" class="btn bg-success" ><i class="fa fa-save"></i> Guardar</button>
                                </div>
                                <div class="modal-footer float-left">
                                  <button type="button" class="btn btn-success  btn_cerrar_class"  aria-label="Close">Cerrar
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div> 


                            </div>
                    </div>
                    </form>
                </div>
            </div>
              <!-- MODAL EDITAR -->
            <div class="modal fade" id="md_modificar_mortalidad">
                <div class="modal-dialog modal-ml" role="document">
                    <div class="modal-content">
                    <form name="formulario_Editar" id="formulario_Editar">
                             <input type="hidden" id="ingreso_datos_edit" name="ingreso_datos_edit" value="si_actualizalo">
                            <input type="hidden" id="llave_baja_edit" name="llave_baja_edit" value="si_actualizalo">
                            
                            <div class="modal-header bg-success">
                                <h1 class="modal-title text-center " id="exampleModalLabel">Registro de Baja </h1>
                                <button type="button" class="btn bg-success btn_cerrar_class" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $usuario = 'root';
                                        $password = '';
                                        $db = new PDO('mysql:host=localhost;dbname=db_finca', $usuario, $password);
                                        ?>
                                        <div class="form-group">

                                            <label>Bovino</label>
                                            <div class="input-group
                                            mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-expand-arrows-alt"></i>
                                                </span>
                                                <select class="form-control" name="idbajaeditar" id="idbajaeditar" class="form-control select2">
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php
                                                    $query = $db->prepare("SELECT int_idexpediente,nva_nom_bovino FROM tb_expediente WHERE nva_estado_bovino = 'inactivo'");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_idexpediente"] . '">' . $valores["nva_nom_bovino"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <label>Fecha de baja</label>

                                        <div class="input-group
                                                mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas
                                                            fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control
                                                    disabled" placeholder="mm/dd/yyyy" required name="fecha" id="fecha" autocomplete="off">
                                        </div>

                                        <label>Descripción</label>
                                        <div class="input-group
                                                mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fa fa fa-square"></i></span>
                                            </div>

                                            <input type="text are" class="form-control" required id="descripcion" name="descripcion" autocomplete="off">
                                            <div class="input-group-append">

                                            </div>
                                        </div>

                                    </div>

                                </div>

                                  <div class="modal-footer float-right">
                                   <button type="submit" id="boton_enviar" class="btn bg-success" ><i class="fa fa-save"></i>Modificar</button>
                                </div>
                                <div class="modal-footer float-left">
                                  <button type="button" class="btn bg-success btn_cerrar_class" data-dismiss="modal" aria-label="Close">Cerrar
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div> 


                            </div>
                   
                    </form>
                     </div>
                </div>
            </div>
               <!-- MODAL ELIMINAR -->
            <div class="modal fade" id="md_Eliminar_mortalidad">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                    <form name="formulario_Eliminar" id="formulario_Eliminar">
                            <input type="hidden" id="eliminar_baja" name="eliminar_baja" value="si_eliminala">
                            <input type="hidden" id="idexpeiente" name="idexpeiente">
                            <input type="hidden" id="id_bajaE" name="id_bajaE">
                            
                            <div class="modal-header bg-danger text-center">
                              <h5 class="modal-title text-center" id="exampleModalLabel">Eliminar de Baja </h5>
                            </div>
                            <div class="modal-body">

                                <div class="row">
                                    
                                    <label class="text-center">Se eliminara Bovino de baja y se actualizará en el Expediente </label>
                                </div>
                                
                                <div class="modal-footer float-right">
                                     <button type="button" class="btn btn-danger btn_cerrar_class" data-dismiss="modal" aria-label="Close"> Cancelar
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-footer float-left">
                                  <button type="submit" id="boton_enviar" class="btn btn-danger" ><i class="fas fa-trash"></i>Eliminar</button>
                                </div>
                                 
                           </div>
                   
                    </form>
                     </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
            </div>
            <strong>UES &copy; 2021</strong>
            Todos los Derechos Reservados
        </footer>
        <aside class="control-sidebar control-sidebar-dark"></aside>
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- InputMask -->
    <script src="../plugins/moment/moment.min.js"></script>

    <script src="../plugins/inputmask/jquery.inputmask.min.js"></script>
    <!-- date-range-picker -->
    <script src="../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Bootstrap Switch -->
    <script src="../plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
    <!-- BS-Stepper -->
    <script src="../plugins/bs-stepper/js/bs-stepper.min.js"></script>
    <!-- dropzonejs -->
    <script src="../plugins/dropzone/min/dropzone.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="../plugins/toastr/toastr.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
    <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
      <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="../Scripts/funcion_mortalidad.js"></script>

</body>

</html>