<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $var = $_POST["tip"];

  $query = "SELECT proyectos.id_proyecto, proyectos.tipo, proyectos.nombre,
   proyectos.operativo, recursos.id_recurso, recursos.estatus_limite
   FROM proyectos, asociado, recursos WHERE proyectos.id_proyecto = asociado.id_proyectos
   AND asociado.id_recurso = recursos.id_recurso AND proyectos.operativo = 'si'
   AND recursos.estatus_limite = 'aprobado' ORDER BY proyectos.id_proyecto;";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>ID Proyecto</th>
      <th>Tipo</th>
      <th>Nombre Proyecto</th>
      <th>Operativo</th>
      <th>ID Recurso</th>
      <th>Status</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[0]</td> <td>$p[1]</td> <td>$p[2]</td> <td>$p[3]</td> <td>$p[4]</td> <td>$p[5]</td>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
