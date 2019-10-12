<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $var = $_POST["tip"];

  $query = "SELECT socios.nombre, proyectos.id_proyecto, proyectos.nombre,
  COUNT(asociado.id_recurso) FROM socios, participa, proyectos, asociado
  WHERE socios.id_socio = participa.id_socio AND participa.id_proyectos = proyectos.id_proyecto
   AND proyectos.id_proyecto = asociado.id_proyectos
   GROUP BY socios.nombre, proyectos.id_proyecto, proyectos.nombre
   ORDER BY socios.nombre, COUNT(asociado.id_recurso) DESC;";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Nombre Socio</th>
      <th>Id Proyecto</th>
      <th>Nombre Proyecto</th>
      <th>Cantidad Recursos</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td> ";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
