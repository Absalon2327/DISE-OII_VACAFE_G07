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
        <title>Usuarios | Registro</title>
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

        <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
        <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

        <link rel="stylesheet" href="../dist/css/   .min.css">
        <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
        <!-- Toastr -->
        <link rel="stylesheet" href="../plugins/toastr/toastr.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <?php
                require_once ('../Menus/menusidebar.php');
            ?>
            <?php
                require_once ('../Menus/loader.php');
            ?>


            <!-- CCONTENIDO DE LA PÁGINA -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                        </div>
                    </div>                  
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="card">
                        <div class="card-header bg-success">
                            <h3 class="card-title ">Usuarios</h3>
                            <div class="card-tools">
                                <a class="btn btn-success btn_nuevo" href="#md_registrar_usuario" data-toggle="modal">
                                    <i class="fas fa-plus-circle"></i>
                                    Nuevo
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="col-xs-1"></div>
                            <div class="col-xs-10"></div>
                        </div>
                        <div class="card-body">
                        <!-- TABLA EMPLEADOS -->
                            <div class="card-body p-0" id="datos_tabla"> 
                            </div>
                        </div>
                    </div>                   
                </section>  

                <!-- MODAL EDITAR --> 
                <div class="modal fade" id="md_edit_usuario">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_editar" id="formulario_editar">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Usuarios | Editar</h4>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                        >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                    <input type="hidden" id="ingreso_datos" name="ingreso_datos" value="si_actualizar_usuario">
                                    <input type="hidden" id="llave_usuario_edit" name="llave_usuario_edit" value="si_registro">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>
                                                    *
                                                </span>
                                                <label>Empleado</label>
                                                <div class="input-group mb-3">
                                                     <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                        </span>
                                                    <select class="form-control" id="empleado_usuario_edit" name="empleado_usuario_edit">
                                                    </select>
                                                </div>
                                                 <span>
                                                       *
                                                    </span>
                                                    <label for="correo_usuario_edit">Correo</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-envelope"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control" placeholder="juan@gmail.com" autocomplete="off"  required
                                                        id="correo_usuario_edit" name="correo_usuario_edit" >
                                                    </div>    
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span>
                                                       *
                                                    </span>
                                                    <label for="nombre_usuario_edit">Nombre Usuario</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-user-tie"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" placeholder="juan" autocomplete="off"
                                                        id="nombre_usuario_edit" name="nombre_usuario_edit" required>
                                                    </div>
                                                    <label for="contrasena_usuario">Seleccione una Fotografía</label>
                                                    <div class="input-group mb-3">
                                                        <input id="imagen_usuario_edit" name="imagen_usuario_edit" data-buttonText="Seleccionar" type="file" class="filestyle" data-buttonname="btn-info">
                                                        <label style="display:none;font-size: 10px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen">La imagen no es valida</label>
                                                    </div>                         
                                                </div>
                                            </div>
                                        </div>
                                    <div>
                                        <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger ">
                                            <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-info"><i class="fa fa-save"></i> Guardar</button>
                                        <span>
                                           * Campo Requerido
                                        </span>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div> 

                <!-- MODAL EDIT PASSWORD -->
                <div class="modal fade" id="md_edit_password">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_mod_pass" id="formulario_mod_pass">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Usuarios | Contraseña</h4>
                                    <button
                                        type="button"
                                        class="close"
                                        data-dismiss="modal"
                                        aria-label="Close"
                                        >
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                    <input type="hidden" id="mod_contrasena" name="mod_contrasena" value="si_mod_contrasena">
                                    <input type="hidden" id="id_usuario" name="id_usuario" value="si_registro">
                                        <div class="row">
                                            <div class="col-md-6">                                                
                                                <span>
                                                    *
                                                </span>
                                                <label for="contrasena_usuario">Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="contrasena_usuario" name="contrasena_usuario" required minlength="5">
                                                    </div>
                                            </div>
                                            <div class="col-md-6">         
                                                <span>
                                                    *
                                                </span>
                                                <label for="recontrasena_usuario">Repita su Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="recontrasena_usuario" name="recontrasena_usuario" required minlength="5">
                                                    </div>                                             
                                                
                                            </div>                                           
                                        </div>
                                    <div>
                                        <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger ">
                                            <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-info"><i class="fa fa-save"></i> Guardar</button>
                                        <span>
                                           * Campo Requerido
                                        </span>
                                    </div>
                                </div>    
                            </form>
                        </div>
                    </div>
                </div>  

                <!-- MODAL GUARDAR -->
                <div class="modal fade" id="md_registrar_usuario">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <form method="POST" name="formulario_registro" id="formulario_registro">
                                <div class="modal-header bg-success">
                                    <h4 class="modal-title">Usuarios | Nuevo</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">                               
                                    <input type="hidden" id="almacenar_datos" name="almacenar_datos" value="datonuevo">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span>
                                                    *
                                                </span>
                                                <label>Empleado</label>
                                                <div class="input-group mb-3">
                                                    <span class="input-group-text">
                                                            <i class="fas fa-user"></i>
                                                    </span>
                                                    <select class="form-control " id="empleado_usuario" name="empleado_usuario">
                                                    </select>
                                                </div>
                                                <span>
                                                    *
                                                </span>
                                                <label for="nombre_usuario">Nombre Usuario</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-user-tie"></i>
                                                        </span>
                                                    </div>
                                                    <input type="text" class="form-control  validar_campo_unico" data-quien_es="usuario_guardar" placeholder="juan" autocomplete="off"
                                                    id="nombre_usuario" name="nombre_usuario" required>
                                                </div>
                                                <span>
                                                       *
                                                </span>
                                                <label for="correo_usuario">Correo</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                         <span class="input-group-text">
                                                            <i class="fas fa-envelope"></i>
                                                        </span>
                                                    </div>
                                                    <input type="email" class="form-control" placeholder="juan@gmail.com" autocomplete="off"  required
                                                    id="correo_usuario" name="correo_usuario" >
                                                </div>    
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <span>
                                                        *
                                                    </span>
                                                    <label for="contrasena_usuario">Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="contrasena_usuario" name="contrasena_usuario" required minlength="5">
                                                    </div>
                                                    <span>
                                                        *
                                                    </span>
                                                    <label for="recontrasena_usuario">Repita su Contraseña</label>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-key"></i>
                                                            </span>
                                                        </div>
                                                        <input type="password" class="form-control" autocomplete="off"
                                                        id="recontrasena_usuario" name="recontrasena_usuario" required minlength="5">
                                                    </div>
                                                    <label for="contrasena_usuario">Seleccione una Fotografía</label>

                                                    <div class="input-group mb-3">
                                                         <input id="imagen_usuario" name="imagen_usuario" data-buttonText="Seleccionar" type="file" class="filestyle" data-buttonname="btn-info">
                                                         <label style="display:none;font-size: 10px; list-style: none; color: #ea553d; margin-top: 5px;" id="error_en_la_imagen">La imagen no es valida</label>
                                                    </div>                         
                                                </div>
                                            </div>
                                        </div>
                                    <div>
                                        <button id="limpiar" name="limpiar" type="reset" class="btn bg-danger ">
                                            <i class="fas fa-trash"></i> Limpiar</button>

                                        <button type="submit" class="btn bg-info"><i class="fa fa-save"></i> Guardar
                                        </button>
                                        <span>
                                           <small>* Campo Requerido</small> 
                                        </span>
                                    </div>
                                 </div>    
                            </form>
                        </div>
                    </div>
                </div>
            </div>            
            <footer class="main-footer">
              <div class="float-right d-none d-sm-block"></div>
              <strong>UES &copy; 2021</strong>Todos los Derechos Reservados
            </footer>
            <aside class="control-sidebar control-sidebar-dark"></aside>
        </div>
       
        <!-- jQuery -->
        <script src="../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->        
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

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

        <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>    
        <!-- jquery-validation -->
        <script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
        <script src="../plugins/jquery-validation/additional-methods.min.js"></script>

        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.js"></script>
        <script src="../plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js"></script>
        <!-- Toastr -->
        <script src="../plugins/toastr/toastr.min.js"></script>

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
        <script src="../Scripts/usuarios.js"></script> 
    </body>
    
</html>
