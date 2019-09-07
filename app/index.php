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

</body>
</html>
