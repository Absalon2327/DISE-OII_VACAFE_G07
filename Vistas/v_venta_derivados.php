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
        <title>Compra | Nueva</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
         <!-- DataTables -->
        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- daterange picker -->
        <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
       
        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css">

        <link rel="stylesheet" href="../plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
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

        <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
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
            <!-- CONTENIDO DE LA PAGINA -->
            <div class="content-wrapper">               
                <section class="content-header">
                    <div class="container-fluid">                        
                    </div>
                </section>


                <!-- FROMULARIO VENTA --> 
                <form method="POST" name="formulario_registro_venta" id="formulario_registro_venta">
                    
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title">Ventas | Derivados</h3>
                                        </div>
                                        <input type="hidden" id="almacenar_venta" name="almacenar_venta" value="nueva_venta">
                                        <input type="hidden" id="empleado_venta" name="empleado_venta" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Cliente</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>  
                                                                <select id="cliente_venta_d" name="cliente_venta_d" class="form-control">
                                                                </select>   
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Fecha</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-calendar"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="fecha_venta_d" name="fecha_venta_d" class="form-control form_datetime" placeholder="12-12-2021 12:00" readonly required >
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Vendedor</label>
                                                            <div class="input-group mb-3">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="fas fa-user"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" id="vendedor_d" name="vendedor_d" class="form-control" <?php print 'value ="'.$_SESSION['empleado'].'"'?> readonly required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label>Tipo Documento</label>
                                                            <div class="input-group mb-3"> 
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                         <i class="fa fa-file-alt"></i>
                                                                    </span>
                                                                </div>     
                                                                <select class="form-control" id="tipo_doc_venta" name="tipo_doc_venta" required>
                                                                    <option value="Ticket" selected="selected">Ticket</option>
                                                                    <option value="Factura" >Factura</option>
                                                                    <option value="Crédito Fiscal" >Crédito Fiscal</option>
                                                                </select>
                                                            </div>   
                                                        </div>                                                      
                                                    </div>
                                                    <div class="col-4">
                                                        <div class="form-group">
                                                            <a class="btn bg-success " data-toggle="modal" data-target="#md_seleccion_derivados">
                                                                <i class="fas fa-shopping-cart"></i>
                                                                Agregar
                                                                Producto
                                                            </a>
                                                            <a class="btn bg-success btn_limpiar ">
                                                                <i class="fa fa-trash"></i>
                                                                Limpiar
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-6">                 
                                                    </div>
                                                    <div class="col-2">
                                                        <div class="form-group  float-right">
                                                            <label >No. </label>
                                                            <label id="num_fact">000000</label>
                                                            <input type="hidden" id="num_fact_guardar" name="num_fact_guardar">
                                                            
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

                    <!-- DETALLTE DE LA VENTA (TABLA) -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="col-12 table-responsive">
                                            <table id="tablaDetalleVentaD" class="table table-striped projects" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>Producto</th>
                                                        <th class="text-center col-2">Imagen</th>
                                                        <th class="text-center col-2">Precio Unitario $</th>
                                                        <th class="text-center col-2">Cantidad</th>
                                                        <th class="text-center col-2">Sub Total $</th>
                                                        <th class="text-center col-2">Acción</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 

                                                </tbody>
                                            </table>
                                            <div class="form-group float-sm-right">
                                                <div class="col-2 float-sm-right">
                                                    <label>Total</label>
                                                    <input type="text" id="total_v_venta_d" name="total_v_venta_d" class="form-control" placeholder="$00.00" readonly>
                                                     <input type="hidden" id="total_g_venta_d" name="total_g_venta_d">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Iva</label>
                                                    <input type="text" id="iva_v_venta_d" name="iva_v_venta_d" class="form-control" placeholder="$00.00" readonly>
                                                     <input type="hidden" id="iva_g_venta_d" name="iva_g_venta_d" >
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>SubTotal</label>
                                                    <input type="text" id="subtotal_v_venta_d" name="subtotal_v_venta_d" class="form-control" placeholder="$00.00" readonly >
                                                     <input type="hidden" id="subtotal_g_venta_d" name="subtotal_g_venta_d">
                                                </div>
                                            </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <span class="text-danger" id="msg_decimales"><i class="icon fas fa-exclamation-triangle"></i> Sólo se permiten 2 decimales como máximo</span>
                                            <div class="form-group float-sm-right">
                                                <button type="submit" class="btn bg-success">
                                                    <i class="fas fa-check"></i>
                                                    Vender
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!--MODAL DE SLECCIONE-->
                <div class="modal fade" id="md_seleccion_derivados"> 
                    <form  method="POST" name="formulario_busca_derivado" id="formulario_busca_derivado">              
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Añadir Producto</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card">
                                        <!-- TABLA QUE MUESTRA LOS PRODUCTOS -->
                                        <div class="card-body p-0" id="tb_seleccion_derivados">                                       
                                        </div>
                                            <!-- /.card-body -->
                                    </div>
                                </div>
                                <div class="modal-footer float-right">
                                    <a class="btn bg-success btn_listo" data-dismiss="modal" >
                                        <i class="fa fa-check"></i>Listo
                                    </a>
                                </div>
                            </div>
                        </div>
                    </form>       
                </div>

                <!-- MODAL FACTURA, CRÉDITO-->
                <div class="modal fade" id="md_ver_venta">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_registro_ventas" id="formulario_registro_ventas">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Venta</h4>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="invoice p-3 mb-3">
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                <img src="../dist/img/logo-n.png" alt="user-avatar" class="img-circle img-fluid">
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col text-center">
                                                <address>
                                                    <h4>
                                                        <strong>FINCA LA VACA CAFÉ</strong>
                                                    </h4>
                                                    CALLE LA INDIA
                                                    <br>
                                                    COMUNIDAD EL PROGRESO
                                                    <br>
                                                    POLIGONO A, LOTE 4
                                                    <br>
                                                    BARRIO SAN JUAN,
                                                    COJUTEPEQUE.
                                                    </address>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                <img src="../dist/img/ues-a.png" alt="user-avatar" class="img img-fluid float-right">
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                                Cliente
                                                <address>
                                                    <strong id="nom_cliente_fact">...</strong>
                                                    <br>
                                                    <br>
                                                    <span>Dui: </span><strong id="dui_cliente_fact"></strong>
                                                    <br>
                                                    <span>Dirección: </span> <strong id="direc_cliente_fact"></strong>
                                                    <br>
                                                    <span>Telefono: (503)</span>  <strong id="tel_cliente_fact"></strong>
                                                    <br>
                                                </address>
                                            </div>
                                                <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                Tipo de Documento
                                                <address>
                                                    <strong id="tipo_doc_ver_fact">...</strong>
                                                    <br>
                                                    <br>
                                                    <span> No.Documento: </span><strong id="num_doc_ver_fact">#000000</strong>
                                                    <br>
                                                    <span>Fecha: </span><strong id="fecha_fact">dd/mm/yyyy</strong> 
                                                    <br>
                                                    <span>Hora: </span><strong id="hora_fact">hh:mm:ss</strong> 
                                                </address>
                                            </div>
                                                <!-- /.col -->
                                            <div class="col-sm-4 invoice-col">
                                                Vendedor
                                                <address>
                                                    <strong id="vendedor_fact">...</strong>   
                                                    <br>
                                                    <br>
                                                    <span>Fecha Sistema: </span><strong id="fecha_fact_sis">dd/mm/yyyy</strong> 
                                                    <br>
                                                    <span>Hora Sistema: </span><strong id="hora_fact_sis">hh:mm:ss</strong> 
                                                </address>
                                            </div>
                                            <!-- /.col -->
                                        </div>                               
                                        <!-- /.row -->
                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <div id="tb_Detalle_Derivados_Ver"></div> 
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <div class="dropdown-divider"></div>
                                        <div class="row">
                                            <div class="col-8">
                                            </div>
                                            <div class="col-4">
                                                <div class="table-responsive">
                                                    <table class="table" width="100%">                             
                                                        <tr>
                                                            <th style="width:50%">Sub Total:</th>
                                                             <td><span id="sub_total_fact">$00.00</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Iva 13%:</th>
                                                            <td><span id="iva_fact">$00.00</span></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Venta Total: </th>
                                                            <td><span id="total_fact">$00.00</span></td>
                                                        </tr>
                                                    </table>                             
                                                </div>
                                            </div>                                    
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <button class="btn bg-success" type="button" data-dismiss="modal">
                                                    <i class="fas fa-print"></i>
                                                    Imprimir
                                                </button>
                                            </div>
                                            
                                            <div class="col-6">
                                                <button class="btn bg-success float-sm-right" type="button" data-dismiss="modal">
                                                    <i class="fas fa-check"></i>
                                                    Listo
                                                </button>
                                            </div>
                                            
                                             
                                        </div>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>

                <!--MODAL TICKET-->
                <div class="modal fade" id="md_ticket_previo">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form method="POST" name="formulario_registro_ventas_t" id="formulario_registro_ventas_t">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title" id="tipo_doc_t_v">...</h4>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="invoice p-3 mb-3">
                                        <div class="row invoice-info">
                                            <div class="col-sm-2 invoice-col user-block">
                                                <img src="../dist/img/logo-n.png" alt="user image" class="img-circle img-bordered-sm">
                                            </div>
                                            
                                            <address class="text-center">
                                                <h4>
                                                     <strong>FINCA LA VACA CAFÉ</strong>
                                                </h4>
                                                Calle la India,
                                                <br>
                                                Comunidad el Progreso,
                                                <br>
                                                poligono A, lote #4,
                                                <br>
                                                barrio San Juan,
                                                Cojutepeque, Cuscatlán.
                                            </address> 

                                            <div class="col-sm-2 invoice-col user-block">
                                                <img src="../dist/img/ues-a.png" alt="user-avatar" class="img-circle img-bordered-sm float-right">
                                            </div>
                                            <br>
                                            <p class="text-muted">NRC: </p><p class="text-muted col-4" id="nrc_v"> ...    </p> <p class="text-muted">NIT: </p> <p class="text-muted col-6" id="nit_v"> ...</p>
                                            
                                            <br>
                                            <p class="text-muted col-12 text-center" id="nit_v"> Giro: Compra y Venta de Ganado</p>
                                            
                                            <br>
                                            <p class="text-muted col-6 text-center" id="fecha_v">dd/mm/yyyy</p><p class="text-muted text-center col-6" id="hora_v">hh:mm:ss</p>                                            
                                            <br>
                                            <p class="text-muted col-12 text-center" id="cliente_v">...</p>                       
                                            <br>
                                            <p class="text-muted text-center col-12" id="ticket_v">000000</p>
                                                    
                                            
                                            <!-- /.col -->
                                           
                                        </div>
                                        
                                        <p class="text-muted col-12 text-center" id="ticket_v">-----------------------------------------------------------------------------------</p>
                                        <!-- Table row -->
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <div id="tb_Detalle_Derivados_Ver_t"></div> 
                                            </div>
                                            <!-- /.col -->
                                        </div>
                                        <p class="text-muted col-12 text-center" id="ticket_v">-----------------------------------------------------------------------------------</p>
                                        <div class="row">
                                            <div class="col-12 table-responsive">
                                                <div class="table-responsive">
                                                    <p class="text-muted text-center col-12" id="subt_v">Sumas: $</p>
                                                    <p class="text-muted text-center col-12" id="total_v">Total Cancelado: $</p>  
                                                </div>
                                                <br>
                                                <br>
                                                <div class="table-responsive">
                                                    <p class="text-muted col-12" id="vendedor_v">...</p>
                                                     
                                                </div>
                                                <button class="btn bg-success" type="button" data-dismiss="modal">
                                                        <i class="fas fa-print"></i>
                                                        Imprimir
                                                </button>
                                                <div class="form-group float-sm-right">
                                                    <button class="btn bg-success" type="button" data-dismiss="modal">
                                                        <i class="fas fa-check"></i>
                                                        Listo
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

                <!--MODAL SELECCION EXISTENCIAS-->
                <div class="modal fade" id="md_existencias_actualizar">
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
                          <p id="msg_adver" class="text-center">Esta cantidad solicitada supera la exixtencia actual.</p>
                          <p id="exitencia_adver" class="text-center">Existencia : 0</p>
                          <p id="producto_adver" class="text-center">Producto: ...</p>
                        </div>
                        <div class="modal-footer justify-content-between">                          
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            </i>Aceptar</button>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>

                <!--MODAL PRECIOS-->
                <div class="modal fade" id="md_precio_actualizar">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header bg-danger">                          
                          <h4 class="modal-title">
                            </i>PRECIOS</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p id="msg_adver_precios" class="text-center">...</p>
                          
                        </div>
                        <div class="modal-footer justify-content-between">                          
                          <button type="button" class="btn btn-danger" data-dismiss="modal">
                            </i>Aceptar</button>
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
           
            <aside class="control-sidebar control-sidebar-dark">
            </aside>           
        </div>
       
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
        <!-- AdminLTE App -->
        <script src="../dist/js/adminlte.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

        
        <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
        <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
        <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
        <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
     
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>

        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>      

        <script src="../dist/js/demo.js"></script> 

        <script src="../Scripts/venta_derivados.js"></script>       

      
    </body>
</html>
