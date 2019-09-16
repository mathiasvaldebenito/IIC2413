<?php include('../templates/header.html');   ?>

<body>


  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

   	$query = "SELECT nombre_ong,nombre_proyecto,fecha
              FROM movilizacionmarcha, convocan
              WHERE movilizacionmarcha.id = convocan.id_movilizacion
              AND fecha < '%2021-01-01%' AND fecha > '%2019-12-31%';";
  	$result = $db -> prepare($query);
  	$result -> execute();
  	$motions = $result -> fetchAll();
    ?>
    <div class="jumbotron jumbotron-fluid bg-dark text-white">
      <div class="container">
        <h1 class="display-4">ONGs y Movilizaciones</h1>
        <p class="lead">Aquí podrás encontrar información sobre OENEGES.</p>
      </div>
    </div>

  	<table class="table table-hover table-sm">
      <thead class="table-head dark">
      <tr>
        <th>ONG</th>
        <th>Proyecto</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <?php
  	foreach ($motions as $motion) {
    		echo "<tr> <td>$motion[0]</td> <td>$motion[1]</td> <td>$motion[2]</td> </tr>";
  	}
    ?>
  	</table>



<?php include('../templates/footer.html'); ?>
