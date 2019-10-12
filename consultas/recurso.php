<?php include('./../templates/header.html');   ?>
<?php include('./../templates/layout_consultas.html');   ?>

<body>
  <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $proyecto = $_POST["proyecto"];

    $query = "SELECT ong, presentan.numero, proyecto FROM presentan, denuncian
              WHERE presentan.numero = denuncian.numero
              AND proyecto LIKE '%$proyecto%';";

    $result = $db52 -> prepare($query);
    $result -> execute();
    $ongs = $result -> fetchAll();
    ?>

    <div class=container>
    <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
    <table class="table table-hover table-sm w-auto">
      <thead class="thead-dark" style="position: sticky; top: 0;">
      <tr>
        <th>ONG</th>
        <th>Recurso</th>
        <th>Proyecto</th>
      </tr>
      </thead>
    <?php
    foreach ($ongs as $ong) {
        echo "<tr> <td>$ong[0]</td>
                   <td>$ong[1]</td>
                   <td>$ong[2]</td> </tr>";
    }
    ?>
    </table>

<?php include('../templates/footer.html'); ?>
