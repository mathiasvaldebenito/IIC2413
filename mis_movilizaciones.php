<?php require("config.php");?>
<?php include('templates/header.php');   ?>

<?php
  require("config/conexion.php");
  $name = $_SESSION["name"];
  $query =   "SELECT nombre_ong, id_movilizacion, tipo, presupuesto, fecha
              FROM convocan, movilizacion
              WHERE movilizacion.id = convocan.id_movilizacion
              AND nombre_ong LIKE '%$name%';";

  $result = $db52 -> prepare($query);
  $result -> execute();
  $ongs = $result -> fetchAll();
?>
<br>
<div class=container>
<div class="row justify-content-center" style="overflow: auto; max-height: 500px">
<table class="table table-hover table-sm w-auto">
  <thead class="thead-dark" style="position: sticky; top: 0;">
    <th>ONG</th>
    <th>ID Movilización</th>
    <th>Tipo</th>
    <th>Presupuesto</th>
    <th>Fecha</th>
  </tr>
  </thead>
<?php
foreach ($ongs as $ong) {
    echo "<tr> <td>$ong[0]</td>
               <td>$ong[1]</td>
               <td>$ong[2]</td>
               <td>$ong[3]</td>
               <td>$ong[4]</td> </tr>";
}
?>
</table>

</html>
