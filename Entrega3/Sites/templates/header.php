<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> ONGs </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->
    <!-- Bootstrap -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- para que index.php pueda importarlo -->
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- para que un .php dentro de un directorio pueda importarlo -->
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <?php echo "<a class='navbar-brand' href={$INDEX_ROUTE}> Home</a>"; ?>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <?php echo "<a class='nav-link' href={$ONGS_ROUTE}>ONGs</a>"; ?>
      </li>
      <li class="nav-item">
        <?php echo "<a class='nav-link' href={$PROYECTOS_ROUTE}>Proyectos</a>"; ?>
      </li>
      <?php
        if(isset($_SESSION["type"]) && $_SESSION["type"] == "ONG"){
          echo "<li class='nav-item'>";
          echo "<a class='nav-link' href='{$MY_MOVS_ROUTE}'>Mis movilizaciones</a>";
          echo "</li>";
        }
        elseif(isset($_SESSION["type"]) && $_SESSION["type"] == "Socio"){
          echo "<li class='nav-item'>";
          echo "<a class='nav-link' href='{$CREATE_PROYECTO_ROUTE}'>Crea un Proyecto!</a>";
          echo "</li>";
        }
       ?>
    </ul>
    <?php
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
      $tipo = $_SESSION["type"];
      $nombre = $_SESSION["name"];
      echo "<span class='navbar-text'> ¡Hola {$tipo} {$nombre}! </span>";
      echo "<a class='btn btn-danger ml-2 my-2 my-sm-0' href='{$LOG_OUT_ROUTE}'>Cerrar Sesión</a>";

    } else {
      echo "<a class='btn btn-outline-success my-2 my-sm-0' href='{$SIGN_UP_ROUTE}'>Registrarse</a>";
      echo "<a class='btn btn-success ml-2 my-2 my-sm-0' href='{$LOG_IN_ROUTE}'>Iniciar Sesión</a>";
    }
    ?>
  </div>
</nav>
