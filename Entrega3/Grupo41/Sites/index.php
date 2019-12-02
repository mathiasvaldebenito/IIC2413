<?php include('templates/header.html');   ?>

<body>
  <h1 align="center">Entrega 2 Grupo 41 </h1>
  <p style="text-align:center;">Aquí podrás ver las distintas consultas</p>


  <br>

  <h3 align="center"> ¿Quieres buscar un proyecto por tipo?</h3>
  <h4 align="center">Ingresa 'vertedero', 'mina' o 'central eléctrica'</h4>

  <form align="center" action="consultas/consulta_tipo.php" method="post">
    Tipo:
    <input type="text" name="tip">
    <br/>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>



  <br>
  <br>
  <br>

  <h3 align="center">Busca los vertederos en distintas regiones</h3>
  <h4 align="center">Escriba alguno de los nombres de la lista</h4>

  <?php
  #Primero obtenemos todos los tipos de pokemones
  require("config/conexion.php");
  $result = $db -> prepare("SELECT DISTINCT region FROM lugarproyecto;");
  $result -> execute();
  $dataCollected = $result -> fetchAll();
  ?>
  <?php
  #Para cada tipo agregamos el tag <option value=value_of_param> visible_value </option>
  foreach ($dataCollected as $d) {
    echo "<option value=$d[0]>$d[0]</option>";
  }
  ?>


  <form align="center" action="consultas/consulta_vertedero_region.php" method="post">
    Región:
    <input type="text" name="region">
    <br/>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>

  <br>
  <br>
  <br>
  <br>




  <br>

  <h3 align="center"> Recursos entre dos fechas</h3>
  <h3 align="center"> Con fecha en formato: 'yyyy-mm-dd'</h3>

  <form align="center" action="consultas/consulta_tipo_fecha.php" method="post">
    Tipo proyecto:
    <input type="text" name="tip">
    <br/>
    Límite inferior:
    <input type="text" name="inf">
    <br/>
    Límite superior:
    <input type="text" name="sup">
    <br/>
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>




    <br>

    <h3 align="center">Regiones con recursos vigentes</h3>

    <form align="center" action="consultas/consulta_recurso_vigente.php" method="post">
      <br/>
      <br/><br/>
      <input type="submit" value="Ver">
    </form>


    <br>

    <h3 align="center"> Socios y sus proyectos ordenados por #recursos</h3>

    <form align="center" action="consultas/consulta_socio_proyecto_recursos.php" method="post">
      <br/>
      <br/><br/>
      <input type="submit" value="Ver">
    </form>

    <br>

    <h3 align="center"> Proyectos operativos con recurso aprobado</h3>

    <form align="center" action="consultas/consulta_proyectos_op_con_rec.php" method="post">
      <br/>
      <br/><br/>
      <input type="submit" value="Ver">
    </form>
</body>
</html>
