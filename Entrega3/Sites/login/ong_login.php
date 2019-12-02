<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: $INDEX_ROUTE");
    exit;
}

// Include config file
require($CONFIG_ROUTE);

// Define variables and initialize with empty values
$name = $ong_pass = "";
$name_err = $ong_pass_err = "";

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
        $ong_pass_err = "Ingresa tu contraseña.";
    } else{
        $ong_pass = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($name_err) && empty($ong_pass_err)){
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
                if(password_verify($ong_pass, $hashed_password)){
                    // Password is correct, so start a new session
                    session_start();

                    // Store data in session variables
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["name"] = $name;
                    $_SESSION["type"] = "ONG";

                    // Redirect user to welcome page
                    header("location: $INDEX_ROUTE");
                } else{
                    // Display an error message if password is not valid
                    $ong_pass_err = "La contraseña ingresada es incorrecta.";
                }
        } else{
            // Display an error message if name doesn't exist
            $name_err = "No hay ninguna ONG registrada con ese nombre.";
        }
      }
}
?>
