<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Natalidad|Registro</title>
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">
    <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- daterange picker -->
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
                <div class="card">
                    <div class="card-header bg-success">
                        <h2 class="card-title">Registro de Natalidad</h2>
                        <div class="card-tools">
                            <a class="btn btn-success " href="#md_registrar_Natalidad" data-toggle="modal">
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
            <div class="modal fade" id="md_registrar_Natalidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">

                <div class="modal-dialog modal-ml" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h1 class="modal-title text-center " id="exampleModalLabel">Registro de Natalidad </h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <form name="formulario_registroN" id="formulario_registroN">
                                <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                                <input type="hidden" id="llave_natalidad" name="llave_natalidad" value="si_registro">
                                <div class="row">
                                    <div class="col-md-12">
                                        <?php
                                        $usuario = 'root';
                                        $password = '';
                                        $db = new PDO('mysql:host=localhost;dbname=db_finca', $usuario, $password);
                                        ?>
                                        <div class="form-group">

                                            <label>Vaca</label>
                                            <div class="input-group
                                            mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-expand-arrows-alt"></i>
                                                </span>
                                                <select class="form-control" name="int_id_expe_madre" id="int_id_expe_madre" class="form-control select2" data-parsley-required-message="Campo requerido" required>
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php
                                                    $query = $db->prepare("SELECT int_idexpediente,nva_nom_bovino FROM tb_expediente WHERE nva_estado_bovino = 'parida' and nva_tipo_bovino='vaca_lechera'");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_idexpediente"] . '">' . $valores["nva_nom_bovino"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">


                                            <label>Recien Nacido</label>
                                            <div class="input-group
                                            mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-expand-arrows-alt"></i>
                                                </span>
                                                <select class="form-control" name="int_id_expe_ternero" id="int_id_expe_ternero" class="form-control select2" required>
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php
                                                    $query = $db->prepare("SELECT int_idexpediente,nva_nom_bovino FROM tb_expediente WHERE nva_estado_bovino = 'activo' and nva_tipo_bovino='ternero' or
                                                    nva_tipo_bovino='novia' ");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_idexpediente"] . '">' . $valores["nva_nom_bovino"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>


                                        <label>Fecha de nacimiento</label>
                                        <div class="input-group
                                                mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="fas fa-calendar"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control
                                                    disabled" placeholder="mm/dd/yyyy" required name="dat_fecha_nacimiento" id="dat_fecha_nacimiento" autocomplete="off">
                                        </div>




                                    </div>
                                </div>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" id="boton_enviar" class="btn bg-success"><i class="fa fa-save"></i>Guardar</button>

                            <button type="button" class="btn bg-success btn_cerrar_class">Cerrar</button>
                            </form>
                        </div>
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
    </div>
  
    <aside class="control-sidebar control-sidebar-dark"></aside>
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
    <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
    <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
    <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

    <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
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
    <script src="../Scripts/funcion_natalidad.js"></script>



</body>

</html>