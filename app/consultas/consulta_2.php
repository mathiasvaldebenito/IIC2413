<?php include('../templates/header.html');   ?>

<body>

  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");
  	$day1 = $_POST["dia1"];
    $month1 = $_POST["mes1"];
    $year1 = $_POST["ano1"];
    $day2 = $_POST["dia2"];
    $month2 = $_POST["mes2"];
    $year2 = $_POST["ano2"];
    $date1 = $year1."-".$month1."-".$day1;
    $date2 = $year2."-".$month2."-".$day2;

   	$query = "SELECT numero, fecha_apertura FROM recurso
              WHERE fecha_apertura < '%$date2%' AND fecha_apertura > '%$date1%';";

  	$result = $db -> prepare($query);
  	$result -> execute();
  	$recursos = $result -> fetchAll();
    ?>

    <div class=container>
    <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
    <table class="table table-hover table-sm w-auto">
      <thead class="thead-dark" style="position: sticky; top: 0;">
      <tr>
        <th>Recurso</th>
        <th>Fecha Apertura</th>
      </tr>
      </thead>
    <?php
  	foreach ($recursos as $recurso) {
    		echo "<tr> <td>$recurso[0]</td> <td>$recurso[1]</td> </tr>";
  	}
    ?>
  	</table>


<?php include('../templates/footer.html'); ?>
