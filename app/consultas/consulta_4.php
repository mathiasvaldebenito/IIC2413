<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT region_tramitacion FROM recurso, tramita, comuna_region_rec
            WHERE tramita.numero = recurso.numero AND recurso.status != 'rechazado'
            AND tramita.comuna = comuna_region_rec.comuna_tramitacion;";

	$result = $db -> prepare($query);
	$result -> execute();
	$regiones = $result -> fetchAll();
  ?>

  <table class="table table-hover table-sm">
    <thead class="thead-dark">
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
