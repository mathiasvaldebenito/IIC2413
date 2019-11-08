<?php
require("routes.php");
include("templates/header.php");
?>
<div class="jumbotron jumbotron-fluid bg-dark text-white">
  <div class="container">
    <h1 class="display-4">Socios, ONGs y Movilizaciones</h1>
    <p class="lead">Aquí podrás encontrar información sobre Socios, ONGs, Proyectos de Multinacionales, Movilizaciones y más.</p>
  </div>
</div>
</body>

<div class=container>
  <div class="row justify-content-center">
    <div class="col-sm">
  <form action="consultas/busqueda_proyecto.php" method="post">
    <div class="input-group my-3">
        <input type="text" class="form-control" placeholder="Busqueda Proyecto por nombre"
        aria-label="Busqueda Proyecto por nombre" aria-describedby="button-addon2" name="busqueda_proyecto">
        <div class="input-group-append">
            <input type="submit" class="btn btn-primary" value="Buscar">
        </form>
        </div>
        </div>
        </div>
        </div>
        </div>



        <div class=container>
          <div class="row justify-content-center">
            <div class="col-sm">
          <form action="consultas/busqueda_ong.php" method="post">
            <div class="input-group my-3">
                <input type="text" class="form-control" placeholder="Busqueda ONG por nombre"
                aria-label="Busqueda ONG por nombre" aria-describedby="button-addon2" name="busqueda_ong">
                <div class="input-group-append">
                    <input type="submit" class="btn btn-primary" value="Buscar
                    ">
                </form>
                </div>
              </div>
              </div>
              </div>
              </div>

                <div class=container>
                    <div class="row justify-content-center">
                      <div class="col-sm">
                    <form action="consultas/busqueda_recurso.php" method="post">
                      <div class="input-group my-3">
                          <input type="text" class="form-control" placeholder="Busqueda Recurso por causa contaminación"
                          aria-label="Busqueda Recurso por causa contaminación" aria-describedby="button-addon2" name="busqueda_recurso">
                          <div class="input-group-append">
                              <input type="submit" class="btn btn-primary" value="Buscar">
                          </form>
                          </div>
                        </div>
                        </div>
                        </div>
                        </div>


</html>
