<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query =   "SELECT nombre_ong, nombre_proyecto,presupuesto,tipo
              FROM movilizacionmarcha
              UNION
              SELECT nombre_ong,nombre_proyecto,presupuesto,tipo
              FROM movilizacionredes
              ORDER BY nombre_ong,presupuesto DESC";
	$result = $db -> prepare($query);
	$result -> execute();
	$ongs = $result -> fetchAll();
  ?>

	<table class="table table-hover table-sm">
    <thead class="table-head dark">
      <th>Nombre ONG</th>
      <th>Nombre Proyecto</th>
      <th>Presupuesto</th>
      <th>Tipo</th>
    </tr>
    </thead>
  <?php
	foreach ($ongs as $ong) {
  		echo "<tr>

      <td>$ong[0]</td>
      <td>$ong[1]</td>
      <td>$ong[2]</td>
      <td>$ong[3]</td>

      </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
