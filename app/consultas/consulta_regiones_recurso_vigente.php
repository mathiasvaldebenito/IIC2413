<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT region FROM recursoabierto
            INNER JOIN comuna_region_rec
            ON recursoabierto.comuna_tramitacion = comuna_region_rec.comuna;";
	$result = $db -> prepare($query);
	$result -> execute();
	$regiones = $result -> fetchAll();
  ?>

  <table class="table table-hover table-sm">
    <thead class="table-head dark">
    <tr>
      <th>Región</th>
    </tr>
    </thead>
  <?php
	foreach ($regiones as $region) {
  		echo "<tr> <td>$region[0]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
