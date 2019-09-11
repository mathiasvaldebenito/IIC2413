<?php include('../templates/header.html');   ?>

<body>
  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $proyecto = $_POST["proyecto"];

    $query = "SELECT nombre_ong FROM recursoabierto,presentan WHERE
    recursoabierto.numero_recurso = presentan.numero_recurso AND
    nombre LIKE '%$proyecto%';";
    $result = $db -> prepare($query);
    $result -> execute();
    $ongs = $result -> fetchAll();
    ?>

    <table class="table table-hover table-sm">
      <thead class="table-head dark">
      <tr>
        <th>ONG</th>
      </tr>
      </thead>
    <?php
    foreach ($ongs as $ong) {
        echo "<tr> <td>$ong[0]</td> </tr>";
    }
    ?>
    </table>




<?php include('../templates/footer.html'); ?>
