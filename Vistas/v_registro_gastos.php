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
        <title>Gatos | Reportes</title>
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

        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
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
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');               
            ?>
            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid"></div>
                </section>
                <!-- FROMULARIO COMPRA -->
                <section class="content">
                    <form  method="POST" id="formulario_gasto_filtro" name="formulario_gasto_filtro">
                       
                    
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 ">
                                    <div class="card card-success">
                                        <div class="card-header">
                                            <h3 class="card-title">Gastos</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Proveedor</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-truck"></i>
                                                                </span>
                                                            </div>  
                                                            <select class="form-control select2" style="width: 70%;" id="cbx_proveedor" name="cbx_proveedor">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Fecha Inicio</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-calendar"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control
                                                            form_datetime_inicio" placeholder="01-01-2022 12:00:00" id="fecha_inicio" name="fecha_inicio" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Fecha Inicio</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-calendar"></i>
                                                                </span>
                                                            </div>
                                                            <input type="text" class="form-control
                                                            form_datetime_fin" placeholder="01-01-2022 12:00:00" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3">
                                                    <div class="form-group">
                                                        <label>Gasto en</label>
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-table"></i>
                                                                </span>
                                                            </div>
                                                            <select class="form-control select2" id="cbx_insumos" name="cbx_insumos">
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-on-primary">
                                                            <input type="checkbox" class="custom-control-input " id="rbtn_todos_proveedores" name="rbtn_todos_proveedores" checked>
                                                            <label class="custom-control-label" for="rbtn_todos_proveedores">Todos</label>
                                                        </div>
                                                    </div>
                                                </div>       
                                                <div class="col-4 text-center">
                                                    <button type="submit" class="btn bg-success ">
                                                        <i class="fa fa-eye"></i>
                                                        Mostrar
                                                    </button>
                                                </div> 
                                                <div class="col-4">

                                                    <div class="form-group">
                                                        <div class="custom-control custom-switch custom-switch-on-primary float-right">
                                                            <input type="checkbox" class="custom-control-input"  id="rbtn_todos" name="rbtn_todos">
                                                            <label class="custom-control-label" for="rbtn_todos">Todos</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <!-- /.card-body -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
                <!-- DETALLTE DE LA COMPRA (TABLA) -->
                <form  method="POST" id="formulario_vista_gasto" name="formulario_vista_gasto">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card card-danger">
                                        <div class="card-header">
                                            <h3 class="card-title">Gastos</h3>
                                            <div class="card-tools">
                                                
                                            </div>
                                        </div>
                                       <strong><p class="text-center">Gasto Comprendido del: 01-01-2022</p><p  class="text-center">al: 18-01-2022</p></strong> 
                                        <div class="card-body text-center">
                                            <canvas id="grafico_gastos" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                        </div>
                                        <div class="row">
                                            <div class="col-2">
                                            </div>
                                            <div class="col-2">
                                                <strong><p>Proveedor: Insumo</p></strong>
                                            </div>
                                        </div>
                                        <div class="card-body">                                            
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Proveedor</th>
                                                        <th>Inverión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Salinera Turcios</td>
                                                        <td>$25.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agroservicio El Frutal</td>
                                                        <td>$150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agua El Manantial</td>
                                                        <td>$30.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finca Cuscatlán</td>
                                                        <td>$350.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>                      <!-- /.card-body -->
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </section>
                 
                 </form>
            </div>
            <!-- /.content-wrapper -->
            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b>
                    3.1.0
                </div>
                <strong>UES &copy; 2021</strong>
                Todos los Derechos Reservados
            </footer>
            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here --></aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->
        <!-- jQuery -->
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- Select2 -->
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
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- DataTables  & Plugins -->
        <script src="../plugins/datatables/jquery.dataTables2.min.js"></script>
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

        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <!-- ChartJS -->
        <script src="../plugins/chart.js/Chart.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="../dist/js/demo.js"></script>
        <script src="../Scripts/registro_gastos.js"></script>
       
    </body>
</html>
<!--


                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">

                                       
                                        <div class="card-body">
                                            
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Proveedor</th>
                                                        <th>Inverión</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Salinera Turcios</td>
                                                        <td>$25.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agroservicio El Frutal</td>
                                                        <td>$150.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Agua El Manantial</td>
                                                        <td>$30.00</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finca Cuscatlán</td>
                                                        <td>$350.</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-4" style="margin-left: 49%;">
                                            <div class="table-responsive">
                                                <table class="table float-right">
                                                    <tr>
                                                        <th style="width:50%">Inversión Total:</th>
                                                        <td>$555.00</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="form-group" style="margin-left: 90%;">
                                            <button type="submit"  rel="noopener" target="_blank" class="btn btn-success">
                                                <i class="fas fa-save"></i>
                                                Guardar
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
























<table class="table table-striped" id="example1">
    <thead class="thead-dark">
        <tr>
            <th scope="col">N°</th>
            <th scope="col">Nombre</th>
            <th scope="col">Estadio</th>
            <th scope="col">Puntos</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
       /*
                       // include_once ("../dao/DaoEquipo.php");
                        $daoE=new DaoEquipo();
                        $fila=$daoE->listaEquipo();
                        foreach($fila as $key=>$value){
                        
                    ?>
        <tr>
            <th scope="row" id="id"><  echo $value->getId(); ?></th>
            <td><  echo $value->getNombre(); ?></td>
            <td>< echo $value->getEstadio(); ?></td>
            <td>< echo $value->getPuntos(); ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button href="#"  data-target="#editEquipoModal" class="edit btn btn-success btnEditar " data-toggle="modal" data-nombre='<?php echo $value->getNombre();?>' data-estadio='<?php echo $value->getEstadio();?>'  data-id='<?php echo $value->getId();?>' data-toggle="tooltip"  ><span class="fa fa-edit"></span></button>

                    <a href="#deleteEquipoModal" class="delete btn btn-danger btnBorrar" data-toggle="modal" data-id="<?php echo $value->getId();?>"><span class="fa fa-trash"></span></a>
                </div>
            </td>
        </tr>
        < }  ?>
    </tbody>
</table>
<script src=assets/js/jquery-3.4.1.min.js></script>
<script src=assets/js/bootstrap.min.js></script>
<script src="../scripts/plugins/miniplugin.js"></script>
<script src="../scripts/marcas/marca.js"></script>
<Paginacion
<script src="../resources/tablas/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="../resources/tablas/datatables.net-bs/js/dataTables.bootstrap.min.js" type="text/javascript"></script>-->
