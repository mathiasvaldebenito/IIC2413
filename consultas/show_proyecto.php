<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $proy_id = $_GET["id"];
  $query = "SELECT denuncian.proyecto, tipo, numero
            FROM proyecto, denuncian
            WHERE denuncian.proyecto = proyecto.nombre
            AND nombre LIKE '$proy_id';";
  $result = $db52 -> prepare($query);
  $result -> execute();
  $results = $result -> fetchAll();
?>
<br>
<div class=container>
<div class="row justify-content-center" style="overflow: auto; max-height: 500px">
<table class="table table-hover table-sm w-auto">
  <thead class="thead-dark" style="position: sticky; top: 0;">
    <th>Proyecto</th>
    <th>Tipo</th>
    <th>Recurso</th>
  </tr>
  </thead>
<?php
foreach ($results as $row) {
    echo "<tr> <td>$row[0]</td>
               <td>$row[1]</td>
               <td>$row[2]</td> </tr>";
}
?>
</table>

</html>
