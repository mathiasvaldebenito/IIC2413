<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<br>
<div class="container">
  <div class="row justify-content-center">
    <h2>Mis movilizaciones</h2>
  </div>
</div>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $name = $_SESSION["name"];
  $query =   "SELECT nombre_ong, nombre_proyecto, tipo, presupuesto, fecha
              FROM convocan, movilizacion
              WHERE movilizacion.id = convocan.id_movilizacion
              AND nombre_ong LIKE '%$name%';";

  $result = $db52 -> prepare($query);
  $result -> execute();
  $ongs = $result -> fetchAll();
?>
<br>

<div class="row justify-content-center" style="overflow: auto; max-height: 400px;">
<table class="table table-hover table-md w-auto">
  <thead class="thead-dark" style="position: sticky; top: 0;">
    <th>ONG</th>
    <th>Proyecto</th>
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

</div>

<br>
<br>
<br>


<div class="container">
  <div class="row justify-content-center">
    <h2><u>Planifica una movilización</u></h2>
  </div>
</div>

<br>

<form action="planificacion_proyecto.php" method="post">
  <div class="form-row justify-content-center">
    <div class="col-2">
      <label for="formGroupComuna">Comuna</label>
      <input type="text" class="form-control" name="Comuna" placeholder="Comuna">
    </div>
    <div class="col-2">
      <label for="formGroupPresupuesto">Presupuesto</label>
      <input type="text" class="form-control" name="Presupuesto"  placeholder="Presupuesto">
    </div>
  </div>

  <br>

  <div class="container">
    <div class="row justify-content-center">
      <button type="submit" class="btn btn-primary">Planifica una Movilización</button>
    </div>
  </div>

</form>

<br>

</html>
