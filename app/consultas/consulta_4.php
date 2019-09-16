<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT region_tramitacion FROM recurso, comuna_region_rec
            WHERE recurso.comuna_tramitacion = comuna_region_rec.comuna_tramitacion
            AND recurso.status != 'rechazado';";

	$result = $db -> prepare($query);
	$result -> execute();
	$regiones = $result -> fetchAll();
  ?>

  <div class=container>
  <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
  <table class="table table-hover table-sm w-auto">
    <thead class="thead-dark" style="position: sticky; top: 0;">
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
