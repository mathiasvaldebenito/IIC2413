<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
$proy_name = $_POST["busqueda_recurso"];

  $query = "SELECT recurso.numero, recurso.causa_contaminacion
            FROM recurso
            WHERE recurso.causa_contaminacion LIKE '%$proy_name%';";
  $recurso = $db52 -> prepare($query);
  $recurso -> execute();
  $recursos = $recurso -> fetchAll();
?>

<br>

<div class=container>
  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Causa Contaminación</th>
            <th>Numero Recurso</th>
          </tr>
        </thead>
        <?php
        foreach ($recursos as $rec) {
            echo "<tr> <td>$rec[1]</td>
            <td><a href= 'recursos.php?name=$rec[0]'>$rec[0]</a></td></tr>";
        }
        ?>
      </table>

    </div>
  </div>
</div>

<br>

<form action="../index.php" method="get" class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary" value="Volver atrás">
</form>

</body>

</html>
