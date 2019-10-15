<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<body>

  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $comuna = $_POST["Comuna"];
    $presupuesto = $_POST["Presupuesto"];

    echo $comuna;
    echo $presupuesto;

   	$query1 = "SELECT nombre, numero, status
              FROM recurso,denuncian,proyecto
              WHERE recurso.numero = denuncian.numero
              AND denuncian.proyecto = proyecto.nombre
              AND proyecto.comuna LIKE '%$comuna%';";
//
  	//$result = $db -> prepare($query);
  	//$result -> execute();
  	//$motions = $result -> fetchAll();
    ?>

    <div class=container>
    <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
    <table class="table table-hover table-sm w-auto">
      <thead class="thead-dark" style="position: sticky; top: 0;">
      <tr>
        <th>ONG</th>
        <th>Fecha</th>
    </tr>
    </thead>
    <?php
  	//foreach ($motions as $motion) {
    //		echo "<tr> <td>$motion[0]</td>
    //               <td>$motion[1]</td>
    //               <td>$motion[2]</td> </tr>";
  	//}
    ?>
  	</table>
