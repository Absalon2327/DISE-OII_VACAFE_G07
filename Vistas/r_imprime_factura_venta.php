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

    $id = $_GET['idv']; 
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
        <input type="hidden" id="idventa" name="idventa" <?php print 'value ="'.$id.'"'?>>
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
                                                    <td><span id="iva_aplicado">$00.00</span></td>
                                                </tr>
                                                <tr>
                                                    <th>Venta Total: </th>
                                                    <td><span id="total_fact">$00.00</span></td>
                                                </tr>
                                            </table>                             
                                        </div>
                                    </div>                                    
                                </div>
                                
                            </div>
                <!-- /.row -->
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
    <script src="../Scripts/imprime_factura_venta.js"></script>  
    <script>
        
    </script>
    </body> 

</html>
