<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $name = $_SESSION["name"];
  $query =   "SELECT nombre_ong, nombre_proyecto, tipo, presupuesto, fecha
              FROM convocan, movilizacion
              WHERE movilizacion.id = convocan.id_movilizacion
              AND trim(nombre_ong) LIKE '%$name%';";

  $result = $db52 -> prepare($query);
  $result -> execute();
  $results = $result -> fetchAll();
?>

<div class="container">
  <div class="row justify-content-center">
    <h2>Mis movilizaciones</h2>
  </div>
  <br>

  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>ONG</th>
            <th>Proyecto</th>
            <th>Tipo</th>
            <th>Presupuesto</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <?php foreach ($results as $row) {
                echo "<tr> <td>$row[0]</td>
                           <td>$row[1]</td>
                           <td>$row[2]</td>
                           <td>$row[3]</td>
                           <td>$row[4]</td> </tr>";
        } ?>
      </table>
    </div>
  </div>

  <br>
  <br>

  <div class="row justify-content-center">
    <h2>Planifica una movilización</h2>
  </div>

  <br>

  <form action="planificacion_proyecto.php" method="post">
    <div class="form-row justify-content-center">
      <div class="col-2">
        <input type="text" class="form-control" name="Comuna" placeholder="Comuna">
      </div>
      <div class="col-2">
        <input type="text" class="form-control" name="Presupuesto"  placeholder="Presupuesto">
      </div>
    </div>
    <br>
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-primary">Planificar</button>
    </div>
  </form>

</div>

<br>

</body>

</html>
