<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Oe ne jes </h1>
  <p style="text-align:center;">Aquí podrás encontrar información sobre OENEGES.</p>

  <br>

  <h3 align="center"> ¿Quieres buscar un ONG por PAIS y/o nombre?</h3>

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

  <h3 align="center"> Consulta 2 </h3>

  <form align="center" action="consultas/consultas_marchas_proximas.php" method="post">
    <h2>Fecha 1</h2>
    Día:
    <input type="text" name="dia1">
    <br/>
    Mes:
    <input type="text" name="mes1">
    <br/>
    Año:
    <input type="text" name="ano1">
    <br/>
    <h2>Fecha 2</h2>
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

  <h3>Consulta 3</h3>

  <form aling="center" action="consultas/consulta_ong_recurso_proyecto.php" method="post">

  </form>

</body>
</html>
