<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $filtro = $_POST["filtro"];

  $query = "SELECT id_proyecto, nombre, tipo
            FROM Proyectos
            WHERE tipo LIKE '%$filtro%';";

  $result = $db41 -> prepare($query);
  $result -> execute();
  $proyectos = $result -> fetchAll();
?>

<div class="container">
  <div class="row justify-content-center">
    <table class="table table-hover">
      <thead class="thead-dark" style="position: sticky; top: 0;">
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Tipo</th>
        </tr>
      </thead>
      <?php
      foreach ($proyectos as $proyecto) {
              echo "<tr> <td>$proyecto[0]</td>
                          <td>$proyecto[1]</td>
                          <td>$proyecto[2]</td> </tr>";
      }
      ?>
    </table>
    <br>
    <form action="./proyectos.php" method="get" class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary" value="Volver atrás">
    </form>
  </div>
</div>

<br>

</body>

</html>
