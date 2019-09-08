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

   	$query = "SELECT nombre_ong,nombre_proyecto FROM Marcha WHERE fecha < '%$date2%'
    AND fecha > '%$date1%' ;";
  	$result = $db -> prepare($query);
  	$result -> execute();
  	$motions = $result -> fetchAll();
    ?>

  	<table>
      <tr>
        <th>Ong</th>
        <th>Proyecto</th>
      </tr>
    <?php
  	foreach ($motions as $motion) {
    		echo "<tr> <td>$motion[0]</td> <td>$motion[1]</td> </tr>";
  	}
    ?>
  	</table>


<?php include('../templates/footer.html'); ?>
