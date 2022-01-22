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
            
        <!--<link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">  -->

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


                <!-- FROMULARIO COMPRA --> 
                <form method="POST" name="formulario_registro_compra" id="formulario_registro_compra">
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header bg-success">
                                            <h3 class="card-title">Compras | Medicamentos e Imsumos</h3>
                                        </div>
                                        <input type="hidden" id="almacenar_compra" name="almacenar_compra" value="nueva_compra">
                                        <input type="hidden" id="validando_detalle" name="validando_detalle" value="0">
                                        <input type="hidden" id="empleado_compra" name="empleado_compra" <?php print 'value ="'.$_SESSION['idempleado'].'"'?>>
                                        <div class="row">
                                            <div class="col-md-10 offset-md-1">
                                                <div class="row">
                                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>Proveedor</label>
        		                                            <div class="input-group mb-3">
        		                                                <select class="form-control" id="proveedores_compra" name="proveedores_compra" >
        		                                                 </select>
        		                                            </div>
        		                                        </div>
        		                                    </div>
                                                           
        		                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>Tipo Documento</label>
        		                                            <select class="form-control" id="tipo_doc_compra" name="tipo_doc_compra" required>
        		                                                <option value="Factura" selected="selected">Factura</option>
        		                                                <option value="Ticket">Ticket</option>
        		                                                <option value="Crédito Fiscal">Crédito Fiscal</option>
        		                                            </select>
        		                                        </div>		                                                
        		                                    </div>
        		                                    <div class="col-4">
        		                                        <div class="form-group">
        		                                            <label>No. Documento</label>
        		                                            <input type="text" class="form-control validcion_solo_numeros_fact" id="num_doc_compra" name="num_doc_compra" placeholder="123456" maxlength="6" required autocomplete="off">
        		                                        </div>
        		                                    </div>
        		                                            
        		                                    <div class="col-6">
        		                                        <div class="form-group">
        										            <label for="">Descripción</label>
        										            <input type="text" class="form-control" id="descrip_compra" name="descrip_compra" placeholder="Nueva Compra"  required autocomplete="off">
        										        </div>
        								            </div>
        									        <div class="col-3">
        		                                        <div class="form-group">
        		                                            <label>Fecha Compra</label>
        		                                            <div class="form-group mb-3">
        		                                                <input size="16" type="text" placeholder="12-12-2021 12:00" readonly class="form_datetime form-control" id="fecha_compra" name="fecha_compra" required>
        		                                            </div>
        		                                        </div>
        		                                    </div>
        		                                    <div class="col-3">
        		                                        <div class="form-group">
        		                                            <label>Fecha Sistema</label>
        		                                            <div class="input-group mb-3">
        		                                                <input type="text"  name="fecha_sistema_compra" id="fecha_sistema_compra" class="form-control" value="<?php echo date('d-m-Y G:i:s');?>" readonly="true">
        		                                            </div>
        		                                        </div>
                                                    </div>
                                                        
                                                    <div class="form-group text-center">
                                                        <a class="btn bg-info" data-toggle="modal" data-target="#md_agregar_producto">
                                                            <i class="fas fa-shopping-cart"></i>
                                                                Agregar
                                                                Producto
                                                        </a>
                                                        <a class="btn bg-danger btn_limpiar">
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
                    </section>
                    <!-- DETALLTE DE LA VENTA (TABLA) -->
                    <section class="content">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="col-12 table-responsive">
                                            <div class="col-12 table-responsive">
                                                <table id="tablaDetalleDerivados" class="table table-striped projects" width="100%">
                                                   <thead>
                                                    <th >Producto</th>
                                                    <th >Imagen</th>
                                                    <th class="text-center col-2" >Costo Unitario $</th>
                                                    <th class="text-center col-2" >Cantidad</th>
                                                    <th class="text-center col-2" >Sub Total $</th>
                                                    <th class="text-center col-2" >Acción</th>
                                                   </thead>
                                                    <tbody>

                                                   </tbody>
                                                 </table>        
                                            </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Total</label>                            
                                                     <input id="total_compra_v_i" name="total_compra_v_i" type="text" class="form-control" placeholder="$00.00" readonly="true">
                                                     <input type="hidden" name="total_compra_guardar" id="total_compra_guardar">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>Iva</label>
                                                    <input id="iva_compra_vista" name="iva_compra_vista" type="text" class="form-control" placeholder="$00.00" contenteditable="false" readonly="true">
                                                    <input type="hidden" name="iva_guardar" id="iva_guardar">
                                                </div>
                                                <div class="col-2 float-sm-right">
                                                    <label>SubTotal</label>
                                                    <input id="subtotal_compra_vista_i" name="subtotal_compra_vista_i"  type="text" class="form-control" placeholder="$00.00" contenteditable="false" readonly="true">
                                                    <input type="hidden" name="subtotal_guardar" id="subtotal_guardar">
                                                </div>
                                            <br>
                                            <br>
                                            <br>
                                            <br>
                                            <span class="text-danger" id="msg_decimales_compra"><i class="icon fas fa-exclamation-triangle"></i> Sólo se permiten 2 decimales como máximo</span>
                                            <div class="form-group float-sm-right">
                                                <button class="btn bg-success" type="submit">
                                                    <i class="fas fa-check"></i>
                                                    Comprar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </form>

                <!--MODAL DE BUSQUEDA PARA PRODUCTO-->
                <div class="modal fade" id="md_agregar_producto"> 
                    <form  method="POST" name="formulario_buscaProducto" id="formulario_buscaProducto">               
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
                                        <div class="card-body p-0" id="tb_seleccion_productos">                                        
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

                <!--MODAL SELECCION CANTIDAD COMPRAR-->
                <div class="modal fade" id="md_costo">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header bg-danger">                          
                          <h4 class="modal-title" id="titulo_modal">
                            Cantidad de Prductos Ingresados</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">                         
                         <p id="msg_adver_costo" class="text-center">...</p>
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
                <!--MODAL SELECCION CANTIDAD COMPRAR-->
                <div class="modal fade" id="md_cantidad">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">
                        <div class="modal-header bg-danger">                          
                          <h4 class="modal-title" id="titulo_modal">
                            Cantidad de Prductos Ingresados</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                         <p id="msg_adver_cant" class="text-center">...</p>                         
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
      <!-- jquery-fechas
        <script src="../plugins/bootstrap-date-time-picker/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-date-time-picker/js/bootstrap-datetimepicker.min.js"></script>
          
        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>-->

        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.js"></script>
        <script src="../plugins/bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js"></script>

        <script src="../plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="../plugins/daterangepicker/daterangepicker.js"></script>
        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>      

        <script src="../dist/js/demo.js"></script> 

        <script src="../Scripts/compra_insumos_medi.js"></script>
    
    </body>
</html>
