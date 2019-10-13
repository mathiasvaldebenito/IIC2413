<?php
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}
// Include config file
require("config/conexion.php");
// Define variables and initialize with empty values
$firstname = $lastname = $password = $confirm_password = "";
$firstname_err = $lastname_err = $user_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["socio_signup"])){

    // Validate name
    if(empty(trim($_POST["firstname"]))) {
        $firstname_err = "Ingresa un nombre.";
    }
    if(empty(trim($_POST["lastname"]))) {
        $lastname_err = "Ingresa un apellido.";
    }
    if(!empty(trim($_POST["lastname"])) && !empty(trim($_POST["firstname"]))){
        $param_firstname = trim($_POST["firstname"]);
        $param_lastname = trim($_POST["lastname"]);
        $query = "SELECT id FROM socios_registrados WHERE firstname LIKE '$param_firstname' AND lastname LIKE '$param_lastname';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        if (!empty($result)) {
            $user_err = "Este Socio ya está registrado.";
        } else{
            $firstname = $param_firstname;
            $lastname = $param_lastname;
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa una contraseña.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "La contraseña debe contener al menos 6 caracteres.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Confirma tu contraseña.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Las contraseñas no coinciden.";
        }
    }

    // Check input errors before inserting in database
    if(empty($user_err) && empty($firstname_err) && empty($lastname_err) && empty($password_err) && empty($confirm_password_err)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        $register = "INSERT INTO socios_registrados (firstname, lastname, password) VALUES ('$firstname', '$lastname', '$password');";
        $result = $db41 -> prepare($register);
      	$result -> execute();
        $query = "SELECT id FROM socios_registrados WHERE firstname LIKE '$firstname' AND lastname LIKE '$lastname';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        $id = $result[0][0];
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $firstname + "_" + $lastname;
        $_SESSION["type"] = "Socio";
        header("location: index.php");
      }

    // Close connection
    pg_close($db41);
}
?>


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
        <input type="hidden" name="socio_signup" />
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
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control" placeholder="Contraseña">
            <span class="help-block text-danger"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="confirm_password" class="form-control" placeholder="Confirmar contraseña">
            <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Registrar">
            <input type="reset" class="btn btn-light" value="Limpiar">
        </div>
        <p>¿Ya estás registrado? Inicia sesión <a href="index.php">aquí</a>.</p>
    </form>
</div>
