<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
	$nombre = $_POST["nombre"];
  $pais = $_POST["pais"];

 	$query = "SELECT nombre,pais FROM ongs WHERE pais LIKE '%$pais%' AND nombre LIKE '%$nombre%';";
	$result = $db -> prepare($query);
	$result -> execute();
	$ongs = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre</th>
      <th>pais</th>
    </tr>
  <?php
	foreach ($ongs as $ong) {
  		echo "<tr> <td>$ong[0]</td> <td>$ong[1]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
