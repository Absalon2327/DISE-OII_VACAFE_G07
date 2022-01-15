 <?php 
    @session_start(); 
    if (isset($_SESSION['logueado']) && $_SESSION['logueado']=="si") {
        if ($_SESSION['bloquear_pantalla']=="no") {
            // code...
            
        }else{
             
            header("Location: ../Vistas/v_bloquear_pantalla.php");
             
        }
    }else{
          header("Location: ../Vistas/index.php");
    }

    
?>           


            <nav class="main-header navbar navbar-expand navbar-white navbar-light">    
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-widget="pushmenu"
                            href="#"
                            role="button"
                        >
                            <i class="fas fa-bars"></i>
                        </a>
                    </li>
                </ul>
                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">                   
                    
                    <li class="nav-item dropdown">
                       
                            <a class="nav-link brand-link" data-toggle="dropdown" href="javascript:void(0)" >
                              <!--<i class="fas fa-user-tie"></i>-->
                              <div class="user-block">
                                    <img src="<?php print $_SESSION['foto'] ?>" class="img-circle img-bordered-sm" style="opacity: .8">
                                    <strong id="usuario_session"><?php print $_SESSION['usuario']?></strong>
                              </div>
                              
                            </a>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                                <a href="../Vistas/v_perfil_usuario.php" class="dropdown-item">
                                    <i class="fas fa-user mr-2"></i> Perfil                            
                                </a>
                                <a href="../Vistas/v_bloquear_pantalla.php" class="dropdown-item">
                                    <i class="fas fa-lock mr-2"></i> Bloquear                               
                                </a>
                              <div class="dropdown-divider"></div>
                                <a href="../Vistas/destruir_sesion.php" class="dropdown-item">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Salir                           
                                </a>                              
                            </div>
                    </li>                    
                </ul>
            </nav>      
            
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- LOGO-->
                <a href="../Vistas/v_principal.php" class="brand-link">
                    <img src="../dist/img/logito.png" alt="La Vaca Café" class="brand-image img-circle elevation-3"
                        style="opacity: .8">
                    <span class="brand-text font-weight-light"> FINCA "LA VACA CAFÉ" </span>
                </a>
                <div class="sidebar">  
                    <!-- MENU LATERAL -->
                    <nav class="mt-2">
                        <ul
                            class="nav nav-pills nav-sidebar flex-column"
                            data-widget="treeview"
                            role="menu"
                            data-accordion="false"
                        >
                            <!-- PAGINAS -->
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-dollar-sign"></i>
                                    <p>
                                        Ventas
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_venta_bovinos.php" class="nav-link">
                                            <p>Bovinos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_venta_derivados.php" class="nav-link">
                                            <p>Leche y Derivados</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_registro_ventas.php" class="nav-link">
                                            <p>Registro</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <p>
                                        Compras
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_nueva_compra_bovinos.php" class="nav-link">
                                            <p>Bovinos</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_nueva_compra_insumosmedi.php" class="nav-link">
                                            <p>Medicamentos e Insumos</p>
                                        </a>
                                    </li>
                                </ul>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_registro_compras.php" class="nav-link">
                                            <p>Registro</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Productos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_producto.php" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Nuevo Producto</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="javascript:void(0)" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>Inventario</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-dot-circle"></i>
                                    <p>
                                        Producción
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_leche.php" class="nav-link">
                                            <p>Nuevo Ingreso</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-plus-square"></i>
                                    <p>
                                        Control de salud
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_expediente.php" class="nav-link">
                                            <p>Expediente</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_vacunas.php" class="nav-link">
                                            <p>Vacunas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_preñez.php" class="nav-link">
                                            <p>Preñez</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_natalidad.php" class="nav-link">
                                            <p>Natalidad</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_mortalidad.php" class="nav-link">
                                            <p>Baja</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-table"></i>
                                    <p>
                                        Gastos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/r_gastos.php" class="nav-link">
                                            <p>Registro de Facturas</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-book"></i>
                                    <p>
                                        Reportes
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_seleccion_reportes_compras.php" class="nav-link">
                                            <p>Compras</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_seleccion_reportes_ventas.php" class="nav-link">
                                            <p>Ventas</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/r_gastos.php" class="nav-link">
                                            <p>Gastos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <p>Producción de leche</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>
                                        Recursos
                                        <i class="fas fa-angle-left right"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="../Vistas/v_empleados.php" class="nav-link">
                                            <p>Empleados</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_clientes.php" class="nav-link">
                                            <p>Clientes</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link">
                                            <p>Proveedores</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="../Vistas/v_usuarios.php" class="nav-link">
                                            <p>Usuarios</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </aside>