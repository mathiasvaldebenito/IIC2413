<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT region_tramitacion FROM tramita, comuna_region_rec
            WHERE tramita.numero NOT IN (SELECT recursocerrado.numero FROM recursocerrado)
            AND tramita.comuna = comuna_region_rec.comuna_tramitacion;";

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
