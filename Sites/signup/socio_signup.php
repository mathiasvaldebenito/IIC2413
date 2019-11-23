<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: $INDEX_ROUTE");
    exit;
}
// Include config file
require($CONFIG_ROUTE);
// Define variables and initialize with empty values
$socio_name = $socio_pass = $socio_confirm_pass = "";
$firstname_err = $lastname_err = $user_err = $socio_pass_err = $socio_confirm_pass_err = "";

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
        $param_name = trim($_POST["firstname"])." ".trim($_POST["lastname"]);
        $query = "SELECT id FROM socios_registrados WHERE name LIKE '$param_name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        if (!empty($result)) {
            $user_err = "Este Socio ya está registrado.";
        } else{
            $query = "SELECT nombre FROM socios WHERE nombre LIKE '$param_name';";
            $result = $db41 -> prepare($query);
            $result -> execute();
            $result = $result -> fetchAll();
            if (empty($result)) {
                $user_err = "Este Socio no es válido para registrar.";
            } else{
                $socio_name = $param_name;
            }
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $socio_pass_err = "Ingresa una contraseña.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $socio_pass_err = "La contraseña debe contener al menos 6 caracteres.";
    } else{
        $socio_pass = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $socio_confirm_pass_err = "Confirma tu contraseña.";
    } else{
        $socio_confirm_pass = trim($_POST["confirm_password"]);
        if(empty($socio_pass_err) && ($socio_pass != $socio_confirm_pass)){
            $socio_confirm_pass_err = "Las contraseñas no coinciden.";
        }
    }

    // Check input errors before inserting in database
    if(empty($user_err) && empty($firstname_err) && empty($lastname_err) && empty($socio_pass_err) && empty($socio_confirm_pass_err)){
        $socio_pass = password_hash($socio_pass, PASSWORD_DEFAULT);
        $register = "INSERT INTO socios_registrados (name, password) VALUES ('$socio_name', '$socio_pass');";
        $result = $db41 -> prepare($register);
      	$result -> execute();
        $query = "SELECT id FROM socios_registrados WHERE name LIKE '$socio_name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        $id = $result[0][0];
        session_start();

        // Store data in session variables
        $_SESSION["loggedin"] = true;
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $socio_name;
        $_SESSION["type"] = "Socio";
        header("location: $INDEX_ROUTE");
      }
}
?>
