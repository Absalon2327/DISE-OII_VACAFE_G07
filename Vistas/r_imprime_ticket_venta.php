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
        <title>Venta | Ticket</title>
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
            <section class="invoice col-4">
                <!-- title row -->
                <!-- info row -->
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
                                                                                                             
                                        <div class="col-12">
                                            <p class="text-muted float-right" id="total_v">Total: $</p>  
                                        </div>
                                        <br>
                                        <br>
                                        <div class="table-responsive">
                                            <p class="text-muted col-12" id="vendedor_v">...</p>
                                             
                                        </div>
                                        
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
    <script src="../Scripts/imprime_ticket_venta.js"></script>  
    <script>
        
    </script>
    </body> 

</html>
