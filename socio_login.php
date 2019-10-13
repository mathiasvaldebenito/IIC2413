<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require("config/conexion.php");

// Define variables and initialize with empty values
$firstname = $lastname = $password = "";
$firstname_err = $lastname_err = $user_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["socio_login"])){

    // Check if name is empty
    if(empty(trim($_POST["firstname"]))) {
        $firstname_err = "Ingresa tu nombre.";
    } else {
        $firstname = trim($_POST["firstname"]);
    }
    if(empty(trim($_POST["lastname"]))) {
        $lastname_err = "Ingresa tu apellido.";
    } else {
        $lastname = trim($_POST["lastname"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa tu contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }

    if(!empty(trim($_POST["lastname"])) && !empty(trim($_POST["firstname"])) && !empty(trim($_POST["password"]))) {
        $query = "SELECT id, firstname, lastname, password FROM socios_registrados
                  WHERE firstname LIKE '$firstname' AND lastname LIKE '$lastname';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        if (!empty($result)) {
          $id = $result[0][0];
          $firstname = $result[0][1];
          $lastname = $result[0][2];
          $hashed_password = $result[0][3];
          if(password_verify($password, $hashed_password)){
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["name"] = $firstname + "_" + $lastname;
              $_SESSION["type"] = "Socio";

              // Redirect user to welcome page
              header("location: index.php");
          } else{
              // Display an error message if password is not valid
              $password_err = "La contraseña ingresada es incorrecta.";
          }
        } else{
            $user_err = "Este Socio no está registrado.";
        }
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
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <input type="password" name="password" class="form-control"  placeholder="Contraseña">
            <span class="help-block text-danger"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Iniciar Sesión">
        </div>
        <p>¿No tienes una cuenta? <a href="signup.php">Regístrate</a>.</p>
    </form>
</div>
