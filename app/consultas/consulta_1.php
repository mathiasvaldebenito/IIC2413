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

    <div class=container>
    <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
    <table class="table table-hover table-sm w-auto">
      <thead class="thead-dark" style="position: sticky; top: 0;">
      <tr>
        <th>ONG</th>
        <th>Proyecto</th>
        <th>Fecha</th>
      </tr>
    </thead>
    <?php
  	foreach ($motions as $motion) {
    		echo "<tr> <td>$motion[0]</td>
                   <td>$motion[1]</td>
                   <td>$motion[2]</td> </tr>";
  	}
    ?>
  	</table>



<?php include('../templates/footer.html'); ?>
