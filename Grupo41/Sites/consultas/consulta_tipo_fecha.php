<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$tipo = $_POST["tip"];
	$inf = $_POST["inf"];
  $sup = $_POST["sup"];

 	$query = "SELECT recursos.id_recurso, recursos.causa, recursos.fecha_recurso, proyectos.tipo FROM
  recursos, asociado, proyectos WHERE recursos.id_recurso = asociado.id_recurso AND asociado.id_proyectos = proyectos.id_proyecto
  AND proyectos.tipo = '$tipo' AND recursos.fecha_recurso > '$inf' AND recursos.fecha_recurso < '$sup';";
	$result = $db -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Tipo</th>
      <th>Causa</th>
      <th>Fecha Recurso</th>
    </tr>
  <?php
	foreach ($pokemones as $pokemon) {
  		echo "<tr> <td>$pokemon[0]</td> <td>$pokemon[3]</td> <td>$pokemon[1]</td><td>$pokemon[2]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
