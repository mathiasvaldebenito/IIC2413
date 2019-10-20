<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="hidden" name="ong_login" />
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Nombre ONG">
            <span class="help-block text-danger"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($ong_pass_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control"  placeholder="Contraseña">
            <span class="help-block text-danger"><?php echo $ong_pass_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
        </div>
        <p>¿No tienes una cuenta? <a href="signup.php">Regístrate</a>.</p>
    </form>
</div>
