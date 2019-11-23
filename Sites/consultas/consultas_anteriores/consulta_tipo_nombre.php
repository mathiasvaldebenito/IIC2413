<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$nacionalidad = $_POST["nacionalidad"];
	$nombre = $_POST["nombre"];
  $apellido = $_POST["apellido"];

 	$query = "SELECT id,nombre, apellido, nacionalidad FROM socio2 WHERE
   nacionalidad LIKE '%$nacionalidad%' AND apellido LIKE '%$apellido%'
    AND nombre LIKE '%$nombre%' ORDER BY apellido;";
	$result = $db -> prepare($query);
	$result -> execute();
	$pokemones = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>ID</th>
      <th>Nombre</th>
      <th>Apellido</th>
      <th>Nacionalidad</th>
    </tr>
  <?php
	foreach ($pokemones as $pokemon) {
  		echo "<tr> <td>$pokemon[0]</td> <td>$pokemon[1]</td> <td>$pokemon[2]</td><td>$pokemon[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
