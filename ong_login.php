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
$name = $password = "";
$name_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ong_login"])){

    // Check if name is empty
    if(empty(trim($_POST["name"]))){
        $name_err = "Ingresa tu nombre de ONG.";
    } else{
        $name = trim($_POST["name"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Ingresa tu contraseña.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($name_err) && empty($password_err)){
        // Prepare a select statement
        $query = "SELECT id, name, password FROM ongs_registradas WHERE name LIKE '$name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        // Check if name exists, if yes then verify password
        if(!empty($result)){
            // Bind result variables
            $id = $result[0][0];
            $name = $result[0][1];
            $hashed_password = $result[0][2];
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["name"] = $name;
                    $_SESSION["type"] = "ONG";

                    // Redirect user to welcome page
                    header("location: index.php");
                } else{
                    // Display an error message if password is not valid
                    $password_err = "La contraseña ingresada es incorrecta.";
                }
        } else{
            // Display an error message if name doesn't exist
            $name_err = "No hay ninguna ONG registrada con ese nombre.";
        }
      }
    // Close connection
    pg_close($db41);
}
?>

<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="hidden" name="ong_login" />
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Nombre ONG">
            <span class="help-block text-danger"><?php echo $name_err; ?></span>
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
