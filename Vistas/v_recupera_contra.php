<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | Recuperar</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-success">
    <div class="card-header text-center">
      <a class="h1"><b>La Vaca</b> Café</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">¿Olvidaste tu contraseña? Aquí puede recuperar fácilmente una nueva contraseña.</p>

       <!--ENVIO DE CORREO-->
      <form id="envio_correo" name="envio_correo" method="post">
        <input type="hidden" id="enviar_contra" name="enviar_contra" value="si_enviala">
        <span>
          *
        </span>
        <label for="contrasena">Correo</label>
        <div class="input-group mb-3">
          <input type="email" class="form-control" placeholder="E-mail" id="email_enviar" name="email_enviar" required autocomplete="off"> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Solicitar nueva contraseña</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

       <!--VERIFICACION DE CODIGO-->
      <form class="hiden" id="validando_codigo_correo" name="validando_codigo_correo" method="post" >
        <input type="hidden" id="verificar_correo" name="verificar_correo" value="si_verificar">
        <input type="hidden" id="idusuario" name="idusuario" value="correo">
        <span>
          *
        </span>
        <label for="codigo_enviado">Código</label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="codigo_enviado" name="codigo_enviado" required> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Verificar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

       <!--ACTUALIZAR NUEVA CONTRASEÑA-->
      <form class="hiden" id="nueva_contra" name="nueva_contra" method="post" >
        <input type="hidden" id="actualizar_password" name="actualizar_password" value="si_actualizar">
        <input type="hidden" id="idusuario2" name="idusuario2" value="correo">
        <span>
          *
        </span>
        <label for="new_password">Nueva Contraseña</label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="new_password" name="new_password" required> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <span>
          *
        </span>
        <label for="repit_new_password">Repita su Contraseña</label>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="repit_new_password" name="repit_new_password" required> 
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-success btn-block">Verificar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="index.php">Login</a>
      </p>
      <span>
        <small>* Campo Requerido</small>
      </span>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="../Scripts/recuperar_contrasena.js"></script>
</body>
</html>
