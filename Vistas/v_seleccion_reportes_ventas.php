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
  <title>Pantall Principal | Index</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="../plugins/jqvmap/jqvmap.min.css">

  <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">

  <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.min.css">
</head>
<style>
    
    div#ventas_generales {
        cursor: pointer;
    }
    div#ventas_bovinos {
        cursor: pointer;
    }
    div#ventas_insumos {
        cursor: pointer;
    }
   
    
</style>
  
<body class="hold-transition sidebar-mini">
    <div class="wrapper">

            <?php
               require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');
            ?>         
        <div class="content-wrapper ">
                
                <section class="content">
                    <div class="container-fluid">
                      <div class="card card-success">
                          <div class="card-header ">                          
                              <h2 class="text-center">
                              REPORTES DE VENTAS
                              </h2>               
                          </div>             
                      </div>
                    </div>
                </section> 
                <section class="content ">
                    <div class="container-fluid">
                      
                      <div class="row">
                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-warning filtro_ventas_generales" id="ventas_generales">
                            <div class="inner">
                              <br>
                              <h5 >Ventas Generales</h5>
                              <br>
                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>

                            </div>
                            <p  class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></p>
                          </div>
                        </div>

                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-success filtro_ventas_bovinos" id="ventas_bovinos">
                            <div class="inner">
                              <br>
                              <h5>Bovinos</h5>
                              <br>
                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>
                            </div>
                            <a id="btn_compras_bovinos" class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                          </div>                          
                        </div>

                        <div class="col-lg-4 col-4">
                          <!-- small box -->
                          <div class="small-box bg-warning filtro_ventas_insumos" id="ventas_insumos">
                            <div class="inner">
                              <br>
                              <h5>Insumos Y Medicamentos</h5>
                              <br>

                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>
                            </div>
                            <a class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                          
                          </div>
                        </div>
                        
                        <!-- ./col -->
                      </div>
                    </div>
                </section> 
                
                <!-- FILTRO PARA VENTAS GENERALES -->
                <form method="POST" name="formulario_r_ventas_g" id="formulario_r_ventas_g">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-warning">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte_ventas_g" name="generar_reporte_ventas_g" value="si_generar">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE VENTAS GENERALES</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="row">                                                   
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Empleado</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="empleados_ventas_g" name="empleados_ventas_g" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha inicio</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_inicio_r_ventas_g" name="fecha_inicio_r_ventas_g" class="form-control form_datetime_inicio" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha fin</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_fin_r_ventas_g" name="fecha_fin_r_ventas_g" class="form-control form_datetime_fin" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info ">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                            <a class="btn bg-danger btn_limpiar ">
                                                                <i class="fa fa-trash"></i>
                                                                Limpiar
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-4">       
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                              <input type="checkbox" class="custom-control-input" id="rbtn_empleado_g" name="rbtn_empleado_g" onclick="myFunction()">
                                                              <label class="custom-control-label" for="rbtn_empleado_g">Empleado</label>
                                                            </div>
                                                        </div>                                                       
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!-- FILTRO PARA VENTAS DE BOVINO -->
                <form method="POST" name="formulario_b_ventas" id="formulario_b_ventas">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte_ventas_b" name="generar_reporte_ventas_b" value="si_generar">                                        
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE COMPRAS DE BOVINOS</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="row">                                                   
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Empleado</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="empleados_ventas_b" name="empleados_ventas_b" class="form-control" disabled="true">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha inicio</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_in_r_ventas_b" name="fecha_in_r_ventas_b" class="form-control form_datetime_inicio" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha fin</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_f_r_ventas_b" name="fecha_f_r_ventas_b" class="form-control form_datetime_fin" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Categoría</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-list-ul"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="categoria_r_ventas_b" name="categoria_r_ventas_b" class="form-control">
                                                                    <option value="Seleccione">Seleccione</option>
                                                                    <option value="novia">Novía</option>
                                                                    <option value="ternero">Ternero</option>
                                                                    <option value="vaca_lechera">Vaca Lechera</option>
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-4">       
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                              <input type="checkbox" class="custom-control-input" id="rbtn_empleado" name="rbtn_empleado">
                                                              <label class="custom-control-label" for="rbtn_empleado">Empleado</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                              <input type="checkbox" class="custom-control-input" id="rbtn_categoria" name="rbtn_categoria" onclick="myFunction()">
                                                              <label class="custom-control-label" for="rbtn_categoria">Categorias</label>
                                                            </div>
                                                        </div>
                                                    </div>          
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info " >
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                            <a class="btn bg-danger btn_limpiar ">
                                                                <i class="fa fa-trash"></i>
                                                                Limpiar
                                                            </a>
                                                        </div>
                                                    </div>
                                                                                                       
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!-- FILTRO PARA VENTAS DE INSUMOS -->
                <form method="POST" name="formulario_ins_ventas" id="formulario_ins_ventas">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-warning">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte_insu" name="generar_reporte_insu" value="si_generar">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE COMPRAS DE MEDICAMENTOS E INSUMOS</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="row">                                                   
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Proveedor</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="empleados_ventas_ins" name="empleados_ventas_ins" class="form-control" disabled="true">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha inicio</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_in_r_compras_insu" name="fecha_in_r_compras_insu" class="form-control form_datetime_inicio" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Fecha fin</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_f_r_compras_ins" name="fecha_f_r_compras_ins" class="form-control form_datetime_fin" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Categoría</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-list-ul"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="categoria_r_compras_ins" name="categoria_r_compras_ins" class="form-control">
                                                                    <option value="Seleccione">Seleccione</option>
                                                                    <option value="MEDICAMENTOS">MEDICAMENTOS</option>
                                                                    <option value="INSUMOS">INSUMOS</option>
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                    </div>
                                                    <div class="col-4">       
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                              <input type="checkbox" class="custom-control-input" id="rbtn_proveedor_ins" name="rbtn_proveedor_ins">
                                                              <label class="custom-control-label" for="rbtn_proveedor_ins">Proveedor</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="custom-control custom-switch custom-switch-on-primary">
                                                              <input type="checkbox" class="custom-control-input" id="rbtn_categoria_ins" name="rbtn_categoria_ins" onclick="myFunction()">
                                                              <label class="custom-control-label" for="rbtn_categoria_ins">Categorias</label>
                                                            </div>
                                                        </div>
                                                    </div>          
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info " data-toggle="modal" data-target="#md_seleccion_derivados">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                            <a class="btn bg-danger btn_limpiar ">
                                                                <i class="fa fa-trash"></i>
                                                                Limpiar
                                                            </a>
                                                        </div>
                                                    </div>
                                                                                                       
                                                </div>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>


        </div>

        
            



            
        
        <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.1.0
                </div>
                    <strong>UES &copy; 2021</strong> Todos los Derechos Reservados
        </footer>
    </div>     
    <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>
  <!-- Sparkline -->
  <script src="../plugins/sparklines/sparkline.js"></script>
  <!-- JQVMap -->
  <script src="../plugins/jqvmap/jquery.vmap.min.js"></script>
  <script src="../plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
  <!-- jQuery Knob Chart -->
  <script src="../plugins/jquery-knob/jquery.knob.min.js"></script>
  <!-- daterangepicker -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- Summernote -->
  <script src="../plugins/summernote/summernote-bs4.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard.js"></script>
   <!-- jquery-validation -->
  <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
  <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

  <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

  <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
  <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>
  <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

  <script src="../Scripts/reportes_ventas.js"></script>
</body>
</html>
