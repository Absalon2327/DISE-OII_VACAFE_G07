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

    $id = $_GET['idc']; 
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Venta | Factura</title>
        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    </head>
    <body>
        <input type="hidden" id="idcompra" name="idcompra" <?php print 'value ="'.$id.'"'?>>
        <div class="wrapper">
           
            <!-- Main content -->
            <section class="invoice">
                <!-- title row -->
                <!-- info row -->
                <div class="invoice p-3 mb-3">
                                   <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            <img src="../dist/img/logo-n.png" alt="user-avatar" class="img-circle img-fluid">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col
                                            text-center">
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
                                            <img src="../dist/img/ues-a.png" alt="user-avatar" class="img
                                                img-fluid float-right">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="row invoice-info">
                                        <div class="col-sm-4 invoice-col">
                                            Proveedor
                                            <address>
                                                <strong id="proveedor">El Frutal</strong>                   
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            Tipo de Documento
                                            <address>
                                                <strong id="tipo_doc">Factura</strong>                      
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-4 invoice-col">
                                            No.Documento
                                           <address>
                                                <strong id="num_doc">15</strong>                            
                                            </address>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-4">                
                                            Descripción
                                            <address>
                                                <strong id="descrip">Nueva Compra de Insumos</strong> 
                                            </address>
                                        </div>
                                        <div class="col-sm-4">                
                                            Fecha de Compra
                                            <address>
                                                <strong id="fecha_compra">dd/mm/yyyy</strong> 
                                            </address>
                                        </div>
                                        <div class="col-sm-4">                
                                            Fecha de Sistema
                                            <address>
                                                <strong id="fecha_sistema">dd/mm/yyyy</strong> 
                                            </address>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                    <!-- Table row -->
                                    <div class="row">
                                        <div class="col-12 table-responsive">
                                            <div id="tb_Detalle_Insumos_Ver"></div> 
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
                                                         <td><span id="sub_total_compra">$00.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Iva 13%:</th>
                                                        <td><span id="iva_compra">$00.00</span></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Venta Total: </th>
                                                        <td><span id="total_compra">$00.00</span></td>
                                                    </tr>
                                                </table>                             
                                            </div>
                                        </div>                                    
                                    </div>                                    
                </div>
            </section>
            <!-- /.content -->
        </div>
        <!-- ./wrapper -->
        <!-- Page specific script -->
       
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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
    <script src="../Scripts/imprime_factura_compra.js"></script>  
    <script>
        
    </script>
    </body> 

</html>
