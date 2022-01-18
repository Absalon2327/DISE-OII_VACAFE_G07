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
    
    div#btn_preñez {
        cursor: pointer;
    }
    div#btn_natalidad{
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
                              REPORTE DE EXPEDIENTE
                              </h2>               
                          </div>             
                      </div>
                    </div>
                </section> 
                <section class="content ">
                    <div class="container-fluid">
                      
                      <div class="row">
                        <div class="col-lg-3 col-3">
                          <!-- small box -->
                          <div class="small-box bg-warning btn_preñez" >
                            <div class="inner">
                              <br>
                              <h5 >Preñez</h5>
                              <br>
                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>

                            </div>
                            <p  class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></p>
                          </div>
                        </div>

                        <div class="col-lg-3 col-3">
                          <!-- small box -->
                          <div class="small-box bg-success btn_natalidad">
                            <div class="inner">
                              <br>
                              <h5>Natalidad</h5>
                              <br>
                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>
                            </div>
                            <a id="btn_compras_bovinos" class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                          </div>                          
                        </div>

                        <div class="col-lg-3 col-3">
                          <!-- small box -->
                          <div class="small-box bg-warning btn_dar_baja">
                            <div class="inner">
                              <br>
                              <h5>Baja</h5>
                              <br>

                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>
                            </div>
                            <a href="../Vistas/v_reporte_preñez.php" class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                          
                          </div>
                        </div>
                      
                        <div class="col-lg-3 col-3">
                          <!-- small box -->
                          <div class="small-box bg-success btn_vacunas">
                            <div class="inner">
                              <br>
                              <h5>Vacunas</h5>
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
                
                <!-- FILTRO PARA PREÑEZ -->
                <form method="POST" name="formulario_r_preñez" id="formulario_r_preñez">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-warning">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte" name="generar_reporte" value="si_generar">
                                      
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE PREÑEZ</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                  <label>Raza</label>                      
                                                <div class="row">      
                                                                 
                                                    <div class="col-8">

                                                        <div class="form-group">
                                                          
                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="raza_r" name="raza_r" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <div class="col-3">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info " data-toggle="modal" data-target="#md_seleccion_derivados">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                           
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

                <!-- FILTRO PARA COMPRAS POR BOVINO -->
                <form method="POST" name="formulario_natalidad" id="formulario_natalidad">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte" name="generar_reporte" value="si_generar">
                                        
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                    <div class="form-group text-center">
                                                        <label><h3>REPORTE DE NATALIDAD</h3></label>
                                                    </div>
                                                    </div>
                                                  </div>
                                                   <label>Nombre</label>
                                                <div class="row">    
                                                    <div class="col-8">
                                                       
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="idexpe" name="idexpe" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                             <label></label>
                                                            <button type="submit" class="btn bg-info float-sm-right">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                           
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
                <form method="POST" name="formulario_r_baja" id="formulario_r_baja">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte" name="generar_reporte" value="si_generar">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE BAJA</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                    <div class="col-2 text-center">
                                                      
                                                    </div>
                                                      <div class="col-8 text-center">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info " data-toggle="modal" data-target="#md_seleccion_derivados">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                           
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
                 <form method="POST" name="formulario_vacuna" id="formulario_vacuna">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte" name="generar_reporte" value="si_generar">
                                        
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE VACUNAS</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                            
                                                <label>Nombre</label>
                                                <div class="row">    
                                                    <div class="col-8">
                                                       
                                                        <div class="form-group">
                                                            <div class="input-group mb-3">

                                                                <div class="input-group-prepend">

                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="idexpe_vacuna" name="idexpe_vacuna" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                             <label></label>
                                                            <button type="submit" class="btn bg-info float-sm-right">
                                                                <i class="fa fa-fw fa-file-pdf"></i>
                                                               Generar Reporte
                                                            </button>
                                                           
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

  <script src="../Scripts/reporte_preñez.js"></script>
</body>
</html>
