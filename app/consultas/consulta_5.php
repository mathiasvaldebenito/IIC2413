<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query =   "SELECT nombre_ong, id_movilizacion, tipo, presupuesto
              FROM convocan, movilizacion
              WHERE movilizacion.id = convocan.id_movilizacion
              ORDER BY nombre_ong,presupuesto DESC;";

	$result = $db -> prepare($query);
	$result -> execute();
	$ongs = $result -> fetchAll();
  ?>

  <div class=container>
  <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
  <table class="table table-hover table-sm w-auto">
    <thead class="thead-dark" style="position: sticky; top: 0;">
      <th>ONG</th>
      <th>ID Movilización</th>
      <th>Tipo</th>
      <th>Presupuesto</th>
    </tr>
    </thead>
  <?php
	foreach ($ongs as $ong) {
  		echo "<tr> <td>$ong[0]</td>
                 <td>$ong[1]</td>
                 <td>$ong[2]</td>
                 <td>$ong[3]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
