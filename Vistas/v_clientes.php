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
        <title>Clientes | Registro</title>
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

        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <link rel="stylesheet" href="../dist/css/   .min.css">
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
                            <h3 class="card-title ">Clientes</h3>
                            <div class="card-tools">
                                <a class="btn btn-success " href="#modalAddCliente" data-toggle="modal">
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

                        <!-- TABLA CLIENTES -->
                        <div class="card-body">
                            <div class="card-body p-0" id="tablaCl"> 
                            </div>
                         </div>
                </section>

                <!-- MODAL GUARDAR -->
                <div class="modal fade" id="modalAddCliente">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_cliente" id="formulario_cliente">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Clientes | Nuevo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                        <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="datonuevo">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="dui_cliente">*Dui</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-newspaper"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="12345678-9"
                                                    id="dui_cliente" name="dui_cliente" required="required"  class="form-control" data-inputmask='"mask": "99999999-9"' data-mask autocomplete="off">
                                                </div>
                                                <label for="nombre_cliente">*Nombres</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Juan..."
                                                    id="nombre_cliente" name="nombre_cliente" required="required" autocomplete="off">
                                                </div>
                                                <label for="direc_cliente">*Dirección</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-map-marked"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control" placeholder="Santo Domingo..."
                                                        id="direc_cliente" name="direc_cliente" required="required" autocomplete="off">
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="telefono_cliente">*Teléfono</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-phone-alt"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="1234-5678" id="telefono_cliente" name="telefono_cliente" required="required" data-inputmask='"mask": "9999-9999"' data-mask autocomplete="off">
                                                    </div>
                                                    <label for="apellido_cliente">*Apellidos</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Mejía..." id="apellido_cliente" name="apellido_cliente" required="required" autocomplete="off">
                                                    </div>                                                             
                                                </div>
                                            </div>
                                        </div>                                    
                                        <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger">
                                            <i class="fas fa-trash"></i> 
                                            Limpiar
                                        </button>
                                        <span><small>*Este Campos es obligatorio</small></span>
                                        <button type="submit" class="btn bg-info float-sm-right">
                                            <i class="fa fa-save"></i>
                                            Guardar
                                        </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- MODAL EDITAR -->
                <div class="modal fade" id="modalClienteEdit">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <form method="POST" name="editClientes" id="editClientes">
                                    <div class="modal-header bg-success">
                                        <h4 class="modal-title">Clientes | Editar</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <div class="modal-body">
                                            <input type="hidden" name="editar_datos" value="datoeditar">
                                            <input type="hidden" name="id_cliente_edit" id="id_cliente_edit">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label >Dui</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-newspaper"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="12345678-9"
                                                        id="dui_cliente_edit" name="dui_cliente_edit" required="required" data-inputmask='"mask": "99999999-9"' data-mask>
                                                    </div>
                                                    <label >Nombres</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="Juan..."
                                                        id="nombre_Cliente_edit" name="nombre_Cliente_edit" required="required">
                                                    </div>
                                                    <label for="direc_cliente_edit">Dirección</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-map-marked"></i>
                                                            </span>
                                                        </div>
                                                        <input
                                                            type="text"
                                                            class="form-control"
                                                            placeholder="Santo Domingo..."
                                                            id="direc_cliente_edit" name="direc_cliente_edit" required="required"
                                                        >
                                                    </div>
                                                </div>
                                                <!-- /.col -->
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label >Teléfono</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-phone-alt"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="1234-5678"
                                                                id="telefono_Cliente_edit" name="telefono_Cliente_edit" required="required" data-inputmask='"mask": "9999-9999"' data-mask>
                                                        </div>
                                                        <label >Apellidos</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-user"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control" placeholder="Mejía..."
                                                                id="apellido_Cliente_edit" name="apellido_Cliente_edit" required="required">
                                                        </div>
                                                        <label for="estado_Cliente">Estado</label>  
                                                        <div class="form-group clearfix">
                                                            <div class="icheck-primary d-inline">
                                                                <input type="radio" value="activo" id="radio_activo_edit" name="estado_cliente_editar" checked>
                                                                <label for="radio_activo_edit">
                                                                    Activo
                                                                </label>
                                                            </div>
                                                            <div class="icheck-primary d-inline">
                                                                <input type="radio" value="inactivo" id="radio_inactivo_edit" name="estado_cliente_editar" >
                                                                <label for="radio_inactivo_edit">
                                                                    Inactivo
                                                                </label>
                                                            </div>                                              
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer float-right">
                                                <button type="submit" class="btn bg-success" >
                                                    <i class="fa fa-check"></i>Listo
                                                </button>
                                            </div>
                                    </div>
                                
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!-- MODAL ADVERTENCIA -->          
                <div class="modal fade" id="modalBajaCliente"> 
                    <div class="modal-dialog">
                        <div class="modal-content "> 
                            <form method="POST" name="confirmaBaja" id="confirmaBaja">
                                <input type="hidden" name="baja_datos" value="datobaja">
                                <div class="modal-header bg-success " >
                                    <h4 class="modal-title ">ADVERTENCIA!</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p class="text-center">Este Cliente no se puede eliminar por que está relacionado con información valiosa&hellip;</p>
                                     <p class="text-center">¿Está seguro de realizar esta acción?</p> 
                                     <input type="hidden" name="id_baja" id="id_baja">    
                                    
                                </div> 
                                <div class="form-group  text-center">
                                    <button type="submit" class="btn bg-success">
                                    Si
                                    </button>
                                    <a class="btn bg-success" data-toggle="modal" data-target="" data-dismiss="modal">
                                           No
                                    </a>                                    
                                </div>    
                            </form>
                        </div>
                    </div>
                </div> 
                <footer class="main-footer">
                    <div class="float-right d-none d-sm-block"></div>
                    <strong>UES &copy; 2021</strong>Todos los Derechos Reservados
                </footer>
                <aside class="control-sidebar control-sidebar-dark"></aside>  

            </div>
               
        </div>
       
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
        <script src="../Scripts/clientes.js"></script>    
  
    </body>
</html>
