<!DOCTYPE html>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Expediente | Registro</title>
    <!-- Google Font: Source Sans Pro -->
    <meta charset="utf-8">
    <!-- Google Font: Source Sans Pro -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- C3 charts css -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="../plugins/c3/c3.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
    <link href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
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
            <section class="content">
                <div class="card">
                    <div class="card-header bg-success">

                        <h2 class=" card-title">Registro de Expediente</h2>
                        <div class="card-tools">
                            <a class="btn btn-success btn_abrir_modal" href="#" data-toggle="modal">
                                <i class="fas fa-plus-circle"></i>
                                Nuevo Expediente
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
                        <div class="card-body p-0" id="datos_tabla">


                        </div>
                    </div>
                </div>
            </section>
            <div class="modal fade" id="md_registrar_expediente">
                <form name="formulario_registro" id="formulario_registro">
                    <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title " id="exampleModalLabel">Registro nuevo expediente</h5>
                                <div class="float-right">
                                    <button type="submit" id="boton_enviar" class="btn btn-success ">Guardar</button>
                                    <button type="button" class="btn btn-success  btn_cerrar_class ">X</button>
                                </div>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_registro">
                                <input type="hidden" id="llave_expediente" name="llave_expediente" value="si_registro">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nombre</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-square"></i>
                                                </span>

                                                <input type="text" autocomplete="off" name="nom_bovino" id="nom_bovino" class="form-control" required />
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tipo de Bovino</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-square"></i>
                                                </span>
                                                <select class="form-control" name="tipo_bovino" id="tipo_bovino" required onclick="validar_campito()">
                                                    <option value="Seleccione">Seleccione</option>
                                                    <option value="novia">Novía</option>
                                                    <option value="ternero">Ternero</option>
                                                    <option value="vaca_lechera">Vaca Lechera</option>
                                                </select>
                                            </div>

                                        </div>
                                    </div>
                                    <?php
                                    $usuario = 'root';
                                    $password = '';
                                    $db = new PDO('mysql:host=localhost;dbname=db_finca', $usuario, $password);
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Raza</label>
                                            <div class="input-group
                                                                        mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-expand-arrows-alt"></i>
                                                </span>
                                                <select class="form-control" name="raza_bovino_select" id="raza_bovino_select" required>
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php
                                                    $query = $db->prepare("SELECT int_idraza ,nva_nom_raza FROM tb_raza");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_idraza"] . '">' . $valores["nva_nom_raza"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Cantidad de Partos</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-book"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="1" required name="cant_parto_bovino" id="cant_parto_bovino" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fecha_ul_parto">Último Parto</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control disabled" placeholder="mm/dd/yyyy" required name="fecha_ult_parto" id="fecha_ult_parto" autocomplete="off" disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label>Sexo</label>
                                        <div class="form-group">

                                            <div class="icheck-primary d-inline">
                                                <input type="radio" value="masculino" id="radioPrimary1" name="sexo_bovino" checked>
                                                <label for="radioPrimary1"> Masculino</label>
                                            </div>
                                            <div class="icheck-primary d-inline">
                                                <input type="radio" value="femenino" id="radioPrimary2" name="sexo_bovino">
                                                <label for="radioPrimary2"> Femenino</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Descripción</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa fa-comments"></i>
                                                    </span>
                                                </div>
                                                <textarea name="descrip_expediente" autocomplete="off" id="descrip_expediente" class="form-control" required rows="" cols=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Propietario</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa fa-square"></i>
                                                </span>
                                                <select class="form-control" name="propietario" id="propietario">
                                                    <option value="Seleccione">Seleccione</option>
                                                    <?php $query = $db->prepare("SELECT * FROM tb_propietario");
                                                    $query->execute();
                                                    $data = $query->fetchAll();

                                                    foreach ($data as $valores) :
                                                        echo '<option value="' . $valores["int_id_propietario"] . '">' . $valores["nva_nombres_propietario"] . ' ' . $valores["nva_apellidos_propietario"] . '</option>';
                                                    endforeach;
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                  
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Imagen Bovino</label>
                                            <div class="image view view-first text-center" >
                                                <img class="thumb-image" id="img_bovino" width="100" height="100"  style=" margin-left:auto; margin-right:auto; display: block;" src="">
                                            </div>
                                            <input id="imagen_bovino" name="imagen_bovino" data-buttonText="Seleccionar" type="file" class="filestyle" data-buttonname="btn-secondary">
                                            <label style="display:none;font-size: 12px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen">La imagen no es valida</label>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Carta De Venta</label>
                                            <div class="image view view-first">
                                                <img class="thumb-image" id="img_carta_venta" width="100" height="100" style=" margin-left:auto; margin-right:auto; display: block;" src="">
                                            </div>
                                            <input id="imagen_expediente" name="imagen_expediente" data-buttonText="Seleccionar" type="file" class="filestyle" data-buttonname="btn-secondary">
                                            <label style="display:none;font-size: 10px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen">La imagen no es valida</label>

                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>
                    </div>
                </form>
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
    <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
    <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
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
    <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.js"></script>
    <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
    <script src="../Scripts/funcion_expediente.js"></script>

</body>

</html>