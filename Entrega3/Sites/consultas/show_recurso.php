<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $recurso_numbr = $_GET["number"];
  $query = "SELECT *
            FROM recurso
            WHERE numero='$recurso_numbr';";
  $result = $db52 -> prepare($query);
  $result -> execute();
  $results = $result -> fetchAll();
?>
<br>

<div class=container>
  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Numero Recurso</th>
            <th>Comuna Tramitacion</th>
            <th>Causa Contaminacion</th>
            <th>Area Influencia</th>
            <th>Descripcion</th>
            <th>Fecha Apertura</th>
            <th>Status</th>
          </tr>
        </thead>
        <?php
        foreach ($results as $row) {
            echo "<tr> <td>$row[0]</td>
                       <td>$row[1]</td>
                       <td>$row[2]</td>
                       <td>$row[3]</td>
                       <td>$row[4]</td>
                       <td>$row[5]</td>
                       <td>$row[6]</td>
                       </tr>";
        }
        ?>
      </table>
    </div>
  </div>
</div>
