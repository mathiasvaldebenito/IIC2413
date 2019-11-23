<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="ong_signup" />
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="name" class="form-control" placeholder="Nombre ONG">
            <span class="help-block text-danger"><?php echo $name_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($ong_pass_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
            <span class="help-block text-danger"><?php echo $ong_pass_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($ong_confirm_pass_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirmar contraseña">
            <span class="help-block text-danger"><?php echo $ong_confirm_pass_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Registrar">
            <input type="reset" class="btn btn-light" value="Limpiar">
        </div>
        <?php echo "<p>¿Ya estás registrado? Inicia sesión <a href=$LOG_IN_ROUTE>aquí</a>.</p>"; ?>
    </form>
</div>
