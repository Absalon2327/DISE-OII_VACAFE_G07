<!DOCTYPE html>
<html lang="es">
    <head>        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Produccion | Registro</title>
        <!-- Google Font: Source Sans Pro -->
        
        <link rel="stylesheet" href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
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

        <link rel="stylesheet" href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">

        <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
          <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
          <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
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
                            <h3 class="card-title ">Produccion</h3>
                            <div class="card-tools" id="registrar_leche">
                                <a class="btn btn-success " href="#mod_add_leche" data-toggle="modal">
                                    <i class="fas fa-plus-circle"></i>
                                    Nuevo
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12">
                        <div class="col-xs-1"></div>
                        <div class="col-xs-10">
                            <div id="resultados"></div>
                        </div>
                        <div class="col-xs-1"></div>
                    </div>
                    <div class="modal-body">
                        <!-- TABLA PRODUCTOS -->
                        <div class="card-body p-0" id="tablaPro"> 
                        </div>
                     </div>   
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </section>
                <!-- /.content -->
            </div>

            <!-- MODAL GUARDAR s-->
            <div class="modal fade" id="mod_add_leche">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <form method="POST" name="addLeche" id="addLeche">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title">Produccion de Leche | Nuevo</h4>
                                 <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                    >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">                               
                                <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="datonuevo">
                                <input type="hidden" id="llave_leche" name="llave_leche" value="si_registro">
                                <div class="row">
                                        <div class="col-md-6">
                                            <label for="botella_Leche">Producto</label>
                                                 <div class="input-group mb-3">
                                                    <span class="input-group-text">
                                                        <i class="fa fa-folder"></i>
                                                    </span>
                                                    <select class="form-control" name="botella_Leche" id="botella_Leche" required>
                                                    </select>
                                                    
                                                </div>
                                            <label for="cantidad_Leche">Cantidad</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="0.00"
                                                        id="cantidad_Leche" name="cantidad_Leche" required autocomplete="off"
                                                    >
                                                </div>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="precio_Leche">Costo</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <input
                                                        type="number"
                                                        class="form-control"
                                                        placeholder="0.00"
                                                        id="precio_Leche" name="precio_Leche" required autocomplete="off"
                                                    >
                                                </div>
                                                <label for="fecha_Leche">Fecha Vencimiento</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-calendar"></i>
                                                    </span>
                                                </div>
                                                <input type="text" class="form-control datefechaleche" id="fecha_Leche" name="fecha_Leche" required autocomplete="off">
                                            </div>
                                            </div>
                                        </div>
                                </div>

                                <div>
                                    <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger ">
                                        <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-info"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>

            <!-- MODAL GUARDAR CATEGORIA s-->
            <div class="modal fade" id="mod_add_categoria">
                <div class="modal-dialog modal-ml">
                    <div class="modal-content">
                        <form method="POST" name="addCategoria" id="addCategoria">
                            <div class="modal-header bg-success">
                                <h4 class="modal-title">Categoria | Nuevo</h4>
                                 <button
                                    type="button"
                                    class="close"
                                    data-dismiss="modal"
                                    aria-label="Close"
                                    >
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">                               
                                <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="datonuevoc">
                                <input type="hidden" id="llave_categoria" name="llave_categoria" value="si_registro">
                                <div class="row">
                                        <div class="col-md-6">
                                            <label for="nombre_Producto">Nombre</label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-user"></i>
                                                    </span>
                                                </div>                                            
                                                <input type="text" class="form-control" placeholder="Leche..."
                                                    id="nombre_Categoria" name="nombre_Categoria" required>
                                            </div>
                                        </div>
                                </div>

                                <div>
                                    <button id="limpiar" name="limpiar" type="reset" class="btn bg-success ">
                                        <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-success"><i class="fa fa-save"></i> Guardar</button>
                                </div>
                            </div>    
                        </form>
                    </div>
                </div>
            </div>

          <!-- MODAL ADVERTENCIA -->          
            <div class="modal fade" id="modalBajaProducto"> 
                <div class="modal-dialog">
                    <div class="modal-content "> 
                        <form method="POST" name="confirmaBaja" id="confirmaBaja">
                            <input type="hidden" name="baja_datos" id="baja_datos" value="si_baja">
                            <div class="modal-header bg-success " >
                                <h4 class="modal-title ">ADVERTENCIA!</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">Este Producto no se puede eliminar por que está relacionado con información valiosa&hellip;</p>
                                <p class="text-center">Solo se puede dar de baja&hellip;</p>
                                 <p class="text-center">¿Está seguro de realizar esta acción?</p> 
                                 <input type="hidden" name="id_producto_baja" id="id_producto_baja">    
                                
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
        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/dropzone/min/dropzone.min.js"></script>
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
        <!-- Toastr -->
        <script src="../plugins/toastr/toastr.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>  
        <script src="../Scripts/funciones_leche.js"></script> 
        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>    
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
        <script>
                $(function () {
                    //Initialize Select2 Elements
                    $('.select2').select2()

                    //Initialize Select2 Elements
                    $('.select2bs4').select2({
                    theme: 'bootstrap4'
                    })

                    //Datemask dd/mm/yyyy
                    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
                    //Datemask2 mm/dd/yyyy
                    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
                    //Money Euro
                    $('[data-mask]').inputmask()

                    //Date picker
                    $('#reservationdate').datetimepicker({
                        format: 'L'
                    });

                    //Date and time picker
                    $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });

                    //Date range picker
                    $('#reservation').daterangepicker()
                    //Date range picker with time picker
                    $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                    })
                    //Date range as a button
                    $('#daterange-btn').daterangepicker(
                    {
                        ranges   : {
                        'Today'       : [moment(), moment()],
                        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
                        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate  : moment()
                    },
                    function (start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
                    }
                    )

                    //Timepicker
                    $('#timepicker').datetimepicker({
                    format: 'LT'
                    })

                    //Bootstrap Duallistbox
                    $('.duallistbox').bootstrapDualListbox()

                    //Colorpicker
                    $('.my-colorpicker1').colorpicker()
                    //color picker with addon
                    $('.my-colorpicker2').colorpicker()

                    $('.my-colorpicker2').on('colorpickerChange', function(event) {
                    $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
                    })

                    $("input[data-bootstrap-switch]").each(function(){
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                    })

                })
                // BS-Stepper Init
               

        </script>

  
    </body>
</html>