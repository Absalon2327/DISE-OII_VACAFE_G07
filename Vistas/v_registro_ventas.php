<?php 
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
  <title>Compras | Registros</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <div class="container-fluid">
                <div class="row mb-2">          
                  
                </div>
              </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">

                    <div class="card">
                      <div class="card-header bg-success">
                        <h3 class="card-title">Registro de Ventas</h3>
                        <div class="card-tools">
                          
                        </div>

                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <!-- TABLA EMPLEADOS -->
                        <div class="card-body p-0" id="tabla_registro_ventas"> 
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.container-fluid -->
            </section>


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
                                    <div class="row">
                                        <div class="col-6">
                                            <a class="btn bg-success bnt_imprimir_fact_cre" type="button" >
                                                <i class="fas fa-print"></i>
                                                Imprimir
                                            </a>
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


            <!-- MODAL DE LA VENTA REALIZADA TICKET-->
            <div class="modal fade" id="md_ver_venta_ticket">
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
                                                                                                                 
                                            <div class="col-12">
                                                <p class="text-muted float-right" id="total_v">Total: $</p>  
                                            </div>
                                            <br>
                                            <br>
                                            <div class="table-responsive">
                                                <p class="text-muted col-12" id="vendedor_v">...</p>
                                                 
                                            </div>
                                            <button class="btn bg-success bnt_imprimir_ticket_vt" type="button">
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
        </div>
      <!-- /.content-wrapper --> 
      <footer class="main-footer">
        <div class="float-right d-none d-sm-block">                    
        </div>
        <strong>UES &copy; 2021</strong>
          Todos los Derechos Reservados
      </footer>

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
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
    <!-- Page specific script -->
    <script src="../Scripts/registro_ventas.js"></script> 
    <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
</body>
</html>
