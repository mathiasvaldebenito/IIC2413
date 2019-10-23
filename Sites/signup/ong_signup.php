<?php

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: $INDEX_ROUTE");
    exit;
}

// Include config file
require($CONFIG_ROUTE);
// Define variables and initialize with empty values
$name = $ong_pass = $ong_confirm_pass = "";
$name_err = $ong_pass_err = $ong_confirm_pass_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["ong_signup"])){

    // Validate name
    if(empty(trim($_POST["name"]))) {
        $name_err = "Ingresa un nombre para la ONG.";
    } else{
        $param_name = trim($_POST["name"]);
        $query = "SELECT id FROM ongs_registradas WHERE name LIKE '$param_name';";
        $result = $db41 -> prepare($query);
        $result -> execute();
        $result = $result -> fetchAll();
        if (!empty($result)) {
            $name_err = "Esta ONG ya está registrada.";
        } else{
            $query = "SELECT nombre FROM ongs WHERE nombre LIKE '$param_name';";
            $result = $db52 -> prepare($query);
            $result -> execute();
            $result = $result -> fetchAll();
            if (empty($result)) {
                $name_err = "Esta ONG no es válida para registrar.";
            } else{
                $name = $param_name;
            }
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $ong_pass_err = "Ingresa una contraseña.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $ong_pass_err = "La contraseña debe contener al menos 6 caracteres.";
    } else{
        $ong_pass = trim($_POST["password"]);
    }

    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $ong_confirm_pass_err = "Confirma tu contraseña.";
    } else{
        $ong_confirm_pass = trim($_POST["confirm_password"]);
        if(empty($ong_pass_err) && ($ong_pass != $ong_confirm_pass)){
            $ong_confirm_pass_err = "Las contraseñas no coinciden.";
        }
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($ong_pass_err) && empty($ong_confirm_pass_err)){
        $ong_pass = password_hash($ong_pass, PASSWORD_DEFAULT);
        //$res = pg_insert($db41, 'ongs_registradas', ['id' => 0, 'name' => $name, 'password' => $ong_pass]);
        $register = "INSERT INTO ongs_registradas (name, password) VALUES ('$name', '$ong_pass')";
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
        header("location: $INDEX_ROUTE");
      }
}
?>
