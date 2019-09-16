<?php include('../templates/header.html');   ?>

<body>
  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $proyecto = $_POST["proyecto"];

    $query = "SELECT ong, numero, proyecto FROM presentan, denuncian
              WHERE presentan.numero = denuncian.numero
              AND proyecto LIKE '%$proyecto%';";
    $result = $db -> prepare($query);
    $result -> execute();
    $ongs = $result -> fetchAll();
    ?>

    <table class="table table-hover table-sm">
      <thead class="table-head dark">
      <tr>
        <th>ONG</th>
        <th>Recurso</th>
        <th>Proyecto</th>
      </tr>
      </thead>
    <?php
    foreach ($ongs as $ong) {
        echo "<tr> <td>$ong[0]</td> </tr>";
    }
    ?>
    </table>




<?php include('../templates/footer.html'); ?>
