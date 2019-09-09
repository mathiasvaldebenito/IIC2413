<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Oe ne jes </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre OENEGES.</p>

  <br>

  <h2 align="center"> ¿Quieres buscar un ONG por PAIS y/o nombre?</h2>

  <form align="center" action="consultas/consulta_tipo_nombre.php" method="post">
    Pais:
    <input type="text" name="pais">
    <br/>
    Nombre:
    <input type="text" name="nombre">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>

  <h2 align="center">Consulta 1</h2>

  <form align="center" action="consultas/consulta_marchas_2020.php" method="post">

    <input type="submit" value="Buscar">

  </form>


  <h2 align="center"> Consulta 2 </h2>

  <form align="center" action="consultas/consultas_marchas_proximas.php" method="post">
    <h3>Fecha 1</h3>
    Día:
    <input type="text" name="dia1">
    <br/>
    Mes:
    <input type="text" name="mes1">
    <br/>
    Año:
    <input type="text" name="ano1">
    <br/>
    <h3>Fecha 2</h3>
    Día:
    <input type="text" name="dia2">
    <br/>
    Mes:
    <input type="text" name="mes2">
    <br/>
    Año:
    <input type="text" name="ano2">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <h2>Consulta 3</h2>

  <form aling="center" action="consultas/consulta_ong_recurso_proyecto.php" method="post">
    Proyecto:
    <input type="text" name="proyecto">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <h2 align="center">Consulta 4</h2>

  <form align="center" action="consultas/consulta_regiones_recurso_vigente.php" method="post">

    <input type="submit" value="Buscar">

  </form>

</body>
</html>
