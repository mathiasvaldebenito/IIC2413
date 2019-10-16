<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $proy_name = $_GET["name"];
  $query = "SELECT ongs.nombre, recurso.numero,recurso.causa_contaminacion
            FROM ongs,presentan,recurso
            WHERE presentan.ong=ongs.nombre
            AND presentan.numero=recurso.numero
            AND nombre LIKE '$proy_name';";
  $recurso = $db52 -> prepare($query);
  $recurso -> execute();
  $recursos = $recurso -> fetchAll();
  $query2 = "SELECT ongs.nombre, movilizacion.tipo,movilizacion.presupuesto,convocan.fecha
            FROM ongs,convocan,movilizacion
            WHERE ongs.nombre=convocan.nombre_ong
            AND convocan.id_movilizacion=movilizacion.id
            AND nombre LIKE '$proy_name';";
  $movilizacion = $db52 -> prepare($query2);
  $movilizacion -> execute();
  $movilizaciones = $movilizacion -> fetchAll();
?>

<br>



<div class=container>
  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-responsive col-md-6 table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Nombre Ong</th>
            <th>Numero Recurso</th>
            <th>Causa Contaminación</th>
          </tr>
        </thead>
        <?php
        foreach ($recursos as $rec) {
            echo "<tr> <td>$rec[0]</td>
                       <td>$rec[1]</td>
                       <td>$rec[2]</td> </tr>";
        }
        ?>
      </table>
       <table class="table table-responsive col-md-6 table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Nombre Ong</th>
            <th>Tipo Movilizacion</th>
            <th>Presupuesto</th>
            <th>Fecha</th>
          </tr>
        </thead>
        <?php
        foreach ($movilizaciones as $mov) {
            echo "<tr> <td>$mov[0]</td>
                       <td>$mov[1]</td>
                       <td>$mov[2]</td>
                       <td>$mov[3]</td> </tr>";
        }
        ?>
      </table>
    </div>
  </div>
</div>

<br>
<form action="./ongs.php" method="get" class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary" value="Volver atrás">
</form>
</div>
</body>

</html>
