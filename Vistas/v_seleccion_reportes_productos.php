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
    
    div#productos_cate {
        cursor: pointer;
    }
    div#leche_productos {
        cursor: pointer;
    }
    /*div#btn_compras_proveedor {
        cursor: pointer;
    }
    div#btn_compras_proveedor {
        cursor: pointer;
    }*/
    
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
                              REPORTES DE PRODUCTOS
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
                          <div class="small-box bg-warning btn_categorias_producto" id="productos_cate">
                            <div class="inner">
                              <br>
                              <h5 >Productos</h5>
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
                          <div class="small-box bg-success btn_leche_producto" id="leche_productos">
                            <div class="inner">
                              <br>
                              <h5>Produccion</h5>
                              <br>
                            </div>
                            <div class="icon">
                              <i class="far fa-file-alt mr-1"></i>
                            </div>
                            <a id="btn_leche_producto" class="small-box-footer">Consultar Reporte <i class="fas fa-arrow-circle-right"></i></a>
                          </div>                          
                        </div>
                      
                        <!-- ./col -->
                      </div>
                    </div>
                </section> 
                
                <!-- FILTRO PARA COMPRAS POR PROVEEDOR -->
                <form method="POST" name="formulario_r_categoria_p" id="formulario_r_categoria_p">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-warning">
                                            <h3 class="card-title"></h3>
                                        </div>
                                        <input type="hidden" id="generar_reporte" name="generar_reporte" value="si_generar">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                  <div class="row">
                                                    <div class="col-12">
                                                      <div class="form-group text-center">
                                                        <label><h3>REPORTE DE PRODUCTO POR CATEGORIA</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="row">                                                   
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Categoria</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="producto_r_cate" name="producto_r_cate" class="form-control">
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
                                                                <input type="text" id="fecha_inicio_r_cate" name="fecha_inicio_r_cate" class="form-control form_datetime_inicio" placeholder="12-12-2021 12:00" readonly required >
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
                                                                <input type="text" id="fecha_fin_r_producto" name="fecha_fin_r_producto" class="form-control form_datetime_fin" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <button type="submit" class="btn bg-info " data-toggle="modal" data-target="#md_seleccion_producto">
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

                <!-- FILTRO PARA COMPRAS POR BOVINO -->
                <form method="POST" name="formulario_p_leche" id="formulario_p_leche">
                    
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
                                                        <label><h3>REPORTE DE PRODUCCION</h3></label>
                                                        <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                      </div>
                                                    </div>
                                                  </div>
                                                <div class="row">                                                   
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <label>Producto</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-truck"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="producto_r_leche" name="producto_r_leche" class="form-control">
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
                                                                <input type="text" id="fecha_in_r_leche_pro" name="fecha_in_r_leche_pro" class="form-control form_datetime_inicio" placeholder="12-12-2021 12:00" readonly required >
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
                                                                <input type="text" id="fecha_f_r_leche_pro" name="fecha_f_r_leche_pro" class="form-control form_datetime_fin" placeholder="12-12-2021 12:00" readonly required >
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
  <script src="../Scripts/reporte_productos.js"></script>
</body>
</html>
