<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT nombre, nombre_ong, tipo, fecha FROM recursoabierto
            INNER JOIN MovilizacionMarcha
            ON recursoabierto.nombre = MovilizacionMarcha.nombre_proyecto
            WHERE fecha > CURRENT_TIMESTAMP
            UNION
            SELECT nombre, nombre_ong, tipo, fecha FROM recursoabierto
            INNER JOIN MovilizacionRedes
            ON recursoabierto.nombre = MovilizacionRedes.nombre_proyecto
            WHERE fecha + duracion > CURRENT_TIMESTAMP;";

	$result = $db -> prepare($query);
	$result -> execute();
	$regiones = $result -> fetchAll();
  ?>

	<table class="table table-hover table-sm">
    <thead class="table-head dark">
    <tr>
      <th>Nombre Proyecto</th>
      <th>ONG que convoca</th>
      <th>Tipo</th>
      <th>Fecha</th>
    </tr>
    </thead>
  <?php
	foreach ($results as $result) {
  		echo "<tr> <td>$result[0]</td> ";
      echo "<tr> <td>$result[1]</td> ";
      echo "<tr> <td>$result[2]</td> ";
      echo "<tr> <td>$result[3]</td> ";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
