<div class="wrapper">
  <script>
  $('#carouselExampleFade').on('slid.bs.carousel', function () {
  var currentSlide = $('#carouselExampleFade div.active').index();
  sessionStorage.setItem('lastSlide', currentSlide);
  });
  if(sessionStorage.lastSlide){
    $("#carouselExampleFade").carousel(sessionStorage.lastSlide*1);
  }
  </script>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="hidden" name="socio_login" />
      <div class="form-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>  <?php echo (!empty($user_err)) ? 'has-error' : ''; ?>  <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
        <div class="form-row justify-content-center">
          <div class="col"><input type="text" class="form-control" name="firstname" placeholder="Nombre"></div>
          <div class="col"><input type="text" class="form-control" name="lastname" placeholder="Apellido"></div>
        </div>
        <div class="row justify-content-center">
          <div class="col-sm"><span class="help-block text-danger"><?php echo $firstname_err; ?></span></div>
          <div class="col-sm"><span class="help-block text-danger"><?php echo $lastname_err; ?></span></div>
        </div>
        <span class="help-block text-danger"><?php echo $user_err; ?></span>
      </div>
        <div class="form-group <?php echo (!empty($socio_pass_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control"  placeholder="Contraseña">
            <span class="help-block text-danger"><?php echo $socio_pass_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
        </div>
        <p>¿No tienes una cuenta? <a href="signup.php">Regístrate</a>.</p>
    </form>
</div>
