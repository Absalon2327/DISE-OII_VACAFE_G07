<!DOCTYPE html>
<html lang="es">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Login | Administrador</title>

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
      <!-- Theme style -->
      <link rel="stylesheet" href="../dist/css/adminlte.min.css">
      <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    </head>

    <body class="hold-transition lockscreen ">

    <!-- DIEÑO DE LOGIN -->
    <div class="login-box lockscreen-wrapper">
      <div class="card card-outline card-success">
        <div class="card-header text-center">
          <a class="h1"><b>La Vaca</b> Café</a>
        </div>
        <div class="lockscreen-wrapper"> 

          <!-- User name -->
          <div class="lockscreen-name">Administrador</div>

          <!-- START LOCK SCREEN ITEM -->
          <div class="lockscreen-item">
            <!-- lockscreen image -->
            <div class="lockscreen-image">
              <img src="../dist/img/user-icon.png" alt="User Image">
            </div>
            <!-- /.lockscreen-image -->

            <!-- lockscreen credentials (contains the form) -->
            <form id="formulario_login" class="lockscreen-credentials">
                <div class="input-group">
                  <input type="hidden" name="iniciar_sesion" value="si_nueva">
                  <input type="password" class="form-control" placeholder="Contraseña" id="contrasena" name="contrasena" required="true">
                  <div class="input-group-append">
                    <button type="submit" class="btn">
                      <i class="fas fa-arrow-right text-muted"></i>
                    </button>
                  </div>
                </div>
                <br>
                <p class="mb-1">
                  <a href="v_recupera_contra.php">No Recuerdo mi Contraseña</a>
                </p>
            </form>    
        </div>
      </div>
      <div class="lockscreen-footer text-center">
        <strong>UES &copy; 2021</strong> Todos los Derechos Reservados
      </div>
    </div>


   

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="../Scripts/inicio_sesion.js" type="text/javascript" charset="utf-8" async defer></script>
  </body>
</html>