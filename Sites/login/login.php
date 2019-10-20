<?php
require("../routes.php");
session_start();
include($ONG_LOG_IN_ROUTE);
include($SOCIO_LOG_IN_ROUTE);
require("../templates/header.php");
?>

<br>
<div class=container>
<div class="row justify-content-md-center">
<div class="card text-center text-white bg-dark w-75">
  <div class="card-body">
    <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel" data-interval="false">
      <div class="carousel-inner">
        <div class="container">
          <div class="row justify-content-md-center w-50">

          <div class="carousel-item active">
            <h2 class="card-title">Iniciar sesión como ONG</h2>
              <?php
              include('ong_login_form.php');
              ?>
          </div>

          <div class="carousel-item">
            <h2 class="card-title">Iniciar sesión como Socio</h2>
              <?php
              include('socio_login_form.php');
              ?>
          </div>

          </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only"> Anterior </span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only"> Siguiente </span>
        </a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</body>
</html>
