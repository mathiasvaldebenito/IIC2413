<?php
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: $INDEX_ROUTE");
    exit;
}

// Include config file
require($CONFIG_ROUTE);

// Define variables and initialize with empty values
$firstname = $lastname = $socio_pass = "";
$firstname_err = $lastname_err = $user_err = $socio_pass_err = "";

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
        $socio_pass_err = "Ingresa tu contraseña.";
    } else{
        $socio_pass = trim($_POST["password"]);
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
          if(password_verify($socio_pass, $hashed_password)){
              // Password is correct, so start a new session
              session_start();

              // Store data in session variables
              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["name"] = $firstname.' '.$lastname;
              $_SESSION["type"] = "Socio";

              // Redirect user to welcome page
              header("location: $INDEX_ROUTE");
          } else{
              // Display an error message if password is not valid
              $socio_pass_err = "La contraseña ingresada es incorrecta.";
          }
        } else{
            $user_err = "Este Socio no está registrado.";
        }
    }
}
?>
