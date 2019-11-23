<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $var = $_POST["region"];


  $query = "SELECT * FROM proyectos, ubicacionproyecto, lugarproyecto
	  WHERE proyectos.id_proyecto = ubicacionproyecto.id_proyectos
	  AND ubicacionproyecto.comuna = lugarproyecto.comuna
	  AND lugarproyecto.region = '$var' AND Proyectos.tipo = 'vertedero';";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Id</th>
      <th>Nombre</th>
      <th>Tipo</th>
      <th>Latitud</th>
      <th>Longitud</th>
      <th>Fecha Apertura</th>
      <th>Operativo</th>
      <th>Comuna</th>
      <th>Región</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[6]</td> <td>$p[1]</td> <td>$p[0]</td> <td>$p[2]</td> <td>$p[3]</td> <td>$p[4]</td> <td>$p[5]</td> <td>$p[10]</td> <td>$p[12]</td>";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
