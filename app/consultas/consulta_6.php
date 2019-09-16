<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT proyecto, id_movilizacion, tipo, fecha
            FROM denuncian, convocan, movilizacion
            WHERE denuncian.numero NOT IN (SELECT recursocerrado.numero FROM recursocerrado)
            AND denuncian.proyecto = convocan.nombre_proyecto
            AND convocan.id_movilizacion = movilizacion.id
            AND movilizacion.tipo = 'marcha' AND fecha > CURRENT_TIMESTAMP
            UNION
            SELECT proyecto, id_movilizacion, tipo, fecha
            FROM denuncian, convocan, movilizacion, movilizacionredes
            WHERE denuncian.numero NOT IN (SELECT recursocerrado.numero FROM recursocerrado)
            AND denuncian.proyecto = convocan.nombre_proyecto
            AND convocan.id_movilizacion = movilizacion.id
            AND movilizacion.id = movilizacionredes.id
            AND movilizacion.tipo = 'redes sociales'
            AND fecha + duracion > CURRENT_TIMESTAMP;";

	$result = $db -> prepare($query);
	$result -> execute();
	$regiones = $result -> fetchAll();
  ?>

	<table class="table table-hover table-sm">
    <thead class="table-head dark">
    <tr>
      <th>Proyecto</th>
      <th>ID Movilización</th>
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
