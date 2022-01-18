<?php 
    date_default_timezone_set('America/El_Salvador');
    @session_start();
    if (isset($_SESSION['logueado']) && $_SESSION['logueado']=="si") {

        $_SESSION['compra'] = null;
        if ($_SESSION['bloquear_pantalla']=="no") {
            // code...
            
        }else{
             
            header("Location: ../Vistas/v_bloquear_pantalla.php");
             
        }
    }else{
          header("Location: ../Vistas/index.php");
    } 
?>
<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Gastos | Registrar</title>
        <!-- Google Font: Source Sans Pro -->
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
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

        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        
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
                require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');               
            ?>

            <!-- CCONTENIDO DE LA PÁGINA -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>
                    <!-- /.container-fluid -->
                </section>
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title ">Gastos | Registrar</h3>
                            <div class="card-tools" id="registrar_leche">
                                <a class="btn btn-success " href="#mod_add_gasto" data-toggle="modal">
                                    <i class="fas fa-plus-circle"></i>
                                    Nuevo
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            
                        </div>
                        <div class="col-xs-1"></div>
                    </div>
                    <!-- TABLA GASTOS -->
                        <div class="card-body">
                            <div class="card-body p-0" id="tb_gasto"> 
                            </div>
                        </div>
                </section>
                <!-- /.content --> 
                <!-- MODAL GUARDAR s-->
                <div class="modal fade" id="mod_add_gasto">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_gasto" id="formulario_gasto">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Gastos | Nuevo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                    <input type="hidden" id="almacenar_gasto" name="almacenar_gasto" value="gastonuevo">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="cbx_insumo">Insumo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text">
                                                    <i class="fas fa-shopping-cart"></i>
                                                </span>
                                                <select class="form-control" name="cbx_insumo" id="cbx_insumo" required></select>
                                            </div>
                                        </div>
                                    
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label for="precio_Leche">Existencia</label>
                                                <div class="input-group mb-3">
                                                   <span id="icono_color" class="text-success" ><i id="icono_exis" class="fas fa-check"></i></span><p class="text-success" id="msg_existencia_actual"></p>
                                                   <input type="hidden" id="exitencia_actual" name="exitencia_actual" value="gastonuevo">
                                                 </div>
                                            </div> 
                                        </div> 
                                    </div>
                                            <!-- /.col -->
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="cantidad_insumo">Cantidad</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-dollar-sign"></i>
                                                    </span>
                                                </div>
                                                <input type="number" class="form-control" placeholder="0" id="cantidad_insumo" name="cantidad_insumo" min="0" required>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <label>Fecha y hora</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </span>
                                                </div>
                                            <input type="text" id="fecha_gasto" name="fecha_gasto" class="form-control form_datetime" placeholder="12-12-2021 12:00" readonly required >
                                            </div>
                                        </div>                                                
                                    </div>
                                    <br>
                                    <br>
                                    <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger ">
                                        <i class="fas fa-trash"></i>
                                        Limpiar
                                    </button>
                                    <button type="submit" class="btn bg-info float-sm-right">
                                        <i class="fa fa-save"></i> 
                                        Guardar
                                    </button>
                                   
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL ADVERTENCIA -->          
                <div class="modal fade" id="md_anular_gasto"> 
                    <div class="modal-dialog modal-sm">
                        <div class="modal-content "> 
                            <form method="POST" name="formulario_anular" id="formulario_anular">
                                <input type="hidden" id="anular_gasto" name="anular_gasto" value="si_anular">
                                <div class="modal-header bg-danger " >
                                    <h4 class="modal-title ">ADVERTENCIA!</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    
                                     <p class="text-center">¿Desea anular este gasto?</p> 
                                     <input type="hidden" name="idgasto" id="idgasto">
                                     <input type="hidden" name="existencia" id="existencia">
                                     <input type="hidden" name="idpro" id="idpro">    
                                    
                                </div> 
                                <div class="form-group  text-center">
                                    <button type="submit" class="btn bg-danger">
                                        Si
                                    </button>
                                    <a class="btn bg-info" data-toggle="modal" data-target="" data-dismiss="modal">
                                        No
                                    </a>                                    
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>
                <!--MODAL SELECCION EXISTENCIAS-->
                <div class="modal fade" id="md_existencias">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header bg-danger">                          
                          <h4 class="modal-title">
                            </i>Existencias</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p class="text-center">Exitencia 0</p>
                          
                          <p class="text-center">Seleccione un producto diferente.</p>
                          
                          <p class="text-center">Para añadir existencias, vaya al Módulo de Producción.</p>
                        </div>
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            <i class="far fa-times-circle"></i>Cerrar</button>
                          <a href="v_leche.php" class="btn btn-danger">
                            <i class="fas fa-angle-right"></i>Ir</a>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
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
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.js"></script>
        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
        <!-- Toastr -->
        <script src="../plugins/toastr/toastr.min.js"></script>

        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>

        <!-- DataTables  & Plugins -->
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
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>     
        <script src="../Scripts/registrar_gasto.js"></script>
       
  
    </body>
</html>