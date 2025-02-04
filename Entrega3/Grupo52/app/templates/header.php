<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> ONGs </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>

    <!-- para que sea index.php pueda importarlo -->
    <!-- <link rel="stylesheet" href="styles/mystyles.css"> -->
    <!-- para que una consulta.php pueda importarlo -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="index.php"> Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="ongs.php">ONGs</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="proyectos.php">Proyectos</a>
      </li>
    </ul>
    <?php session_start();
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      $tipo = $_SESSION["type"];
      $nombre = $_SESSION["name"];
      echo "<span class='navbar-text'> ¡Hola {$tipo} {$nombre}! </span>";
      echo '<a class="btn btn-danger ml-2 my-2 my-sm-0" href="logout.php">Cerrar Sesión</a>';
    } else {
      echo '<a class="btn btn-outline-success my-2 my-sm-0" href="signup.php">Registrarse</a>';
      echo '<a class="btn btn-success ml-2 my-2 my-sm-0" href="login.php">Iniciar Sesión</a>';
    }
    ?>
  </div>
</nav>
