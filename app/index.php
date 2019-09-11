<?php include('templates/header.html');   ?>

<body>

<div class="jumbotron jumbotron-fluid bg-dark text-white">
  <div class="container">
    <h1 class="display-4">ONGs y Movilizaciones</h1>
    <p class="lead">Aquí podrás encontrar información sobre OENEGES.</p>
  </div>
</div>

<div class=container >
<div class="row justify-content-md-center">
<div class="card text-center text-white bg-dark w-75">
  <div class="card-body">
  <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
    <div class="carousel-inner">
      <div class=container >
      <div class="row justify-content-md-center w-50">

      <div class="carousel-item active">
            <h5 class="card-title">Consulta 1</h5>
            <p class="card-text">Muestra todas las marchas planificadas para el 2020.</p>
            <form align="center" action="consultas/consulta_marchas_2020.php" method="post">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
      </div>

      <div class="carousel-item">
        <h5 class="card-title">Consulta 2</h5>
        <p class="card-text">Muestra todos los recursos abiertos entre una fecha a y una fecha b.</p>
            <form align="center" action="consultas/consultas_marchas_proximas.php" method="post">
            <div class="form-row justify-content-center">
              <label class="col-form-label mr-4"> Fecha a: </label>
                <input type="text" class="form-control col-sm-2 mr-2" id="dia1" placeholder="Día">
                <input type="text" class="form-control col-sm-2 mr-2" id="mes1" placeholder="Mes">
                <input type="text" class="form-control col-sm-2" id="ano1" placeholder="Año">
            </div>
            <div class="form-row justify-content-center mt-2">
              <div class="col-auto">
              <label class="col-form-label mr-4"> Fecha b: </label>
              </div>
                <input type="text" class="form-control col-sm-2 mr-2" id="dia2" placeholder="Día">
                <input type="text" class="form-control col-sm-2 mr-2" id="mes2" placeholder="Mes">
                <input type="text" class="form-control col-sm-2" id="ano2" placeholder="Año">
            </div>
            <input type="submit" class="btn btn-primary mt-4" value="Buscar" </input>
          </form>
      </div>

      <div class="carousel-item">
            <h5 class="card-title">Consulta 3</h5>
            <p class="card-text"> Muestra todas las ONG que participan en un recurso para algún proyecto P. </p>
            <form aling="center" action="consultas/consulta_ong_recurso_proyecto.php" method="post">
              <input type="text" class="form-control mb-4" id="proyecto" placeholder="Nombre Proyecto">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
      </div>

      <div class="carousel-item">
            <h5 class="card-title">Consulta 4</h5>
            <p class="card-text"> Entrega todas las regiones que tienen algún recurso vigente. </p>
            <form align="center" action="consultas/consulta_regiones_recurso_vigente.php" method="post">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
      </div>

      <div class="carousel-item">
            <h5 class="card-title">Consulta 5</h5>
            <p class="card-text"> Para cada ONG, entrega todas sus movilizaciones, ordenados por presupuesto anual (de más a menos). </p>
            <form align="center" action="consultas/consulta_ong_presupuesto.php" method="post">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
      </div>

      <div class="carousel-item">
            <h5 class="card-title">Consulta 6</h5>
            <p class="card-text"> Muestra todos los proyectos que tienen algún recurso en trámite, junto a todas las movilizaciones vigentes asociadas a ese proyecto. </p>
            <form align="center" action="consultas/consulta_6.php" method="post">
              <input type="submit" class="btn btn-primary" value="Buscar">
            </form>
      </div>

    </div>
      </div>
    <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only"> Anterior </span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only"> SIguiente </span>
    </a>
  </div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>
