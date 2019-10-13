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
$name = $password = $confirm_password = "";
$name_err = $password_err = $confirm_password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ong_signup"])){

    // Validate name
    if(empty(trim($_POST["name"]))) {
        $name_err = "Ingresa un nombre para la ONG.";
    } else{
        $param_name = $_POST["name"];
        $query = "SELECT id FROM ongs_registradas WHERE name LIKE '$param_name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        if (!empty($result)) {
            $name_err = "Esta ONG ya está registrada.";
        } else{
            $name = trim($_POST["name"]);
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
    if(empty($name_err) && empty($password_err) && empty($confirm_password_err)){
        $password = password_hash($password, PASSWORD_DEFAULT);
        //$res = pg_insert($db41, 'ongs_registradas', ['id' => 0, 'name' => $name, 'password' => $password]);
        $register = "INSERT INTO ongs_registradas (name, password) VALUES ('$name', '$password')";
        $result = $db41 -> prepare($register);
      	$result -> execute();
        $query = "SELECT id FROM ongs_registradas WHERE name LIKE '$name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        $id = $result[0][0];
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $name;
        $_SESSION["type"] = "ONG";

        // Redirect user to welcome page
        header("location: index.php");
      }

    // Close connection
    pg_close($db41);
}
?>

<div class="wrapper">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="hidden" name="ong_signup" />
        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
            <input type="text" name="name" class="form-control" placeholder="Nombre ONG">
            <span class="help-block text-danger"><?php echo $name_err; ?></span>
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
