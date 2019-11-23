<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $comuna = $_POST["Comuna"];
  $presupuesto = $_POST["Presupuesto"];

 	$query = "SELECT rechazado.nombre, tipo, rechazado, aprobado, movilizaciones
            FROM (SELECT nombre, tipo, COUNT(recurso.status) as rechazado
            FROM recurso,denuncian,proyecto
            WHERE recurso.numero = denuncian.numero
            AND denuncian.proyecto = proyecto.nombre
            AND proyecto.comuna LIKE '$comuna'
            AND recurso.status LIKE 'rechazado'
            GROUP BY nombre) AS rechazado,
            (SELECT nombre, COUNT(recurso.status) as aprobado
            FROM recurso,denuncian,proyecto
            WHERE recurso.numero = denuncian.numero
            AND denuncian.proyecto = proyecto.nombre
            AND proyecto.comuna LIKE '$comuna'
            AND recurso.status LIKE 'aprobado'
            GROUP BY nombre) AS aprobado,
            (SELECT nombre_proyecto, COUNT(*) as movilizaciones
            FROM convocan
            GROUP BY nombre_proyecto) as movilizaciones
            WHERE rechazado.nombre = aprobado.nombre
            AND rechazado.nombre = nombre_proyecto
            AND (rechazado > aprobado OR movilizaciones < 60);";

	$result = $db52 -> prepare($query);
	$result -> execute();
	$proyectos = $result -> fetchAll();
  $contents = [1 => 'spam', 2 => 'video', 3 => 'imagenes'];
  $presupuesto = floor($presupuesto / count($proyectos));
  $query = "SELECT MAX(id) FROM movilizacion;";
  $result = $db52 -> prepare($query);
  $result -> execute();
  $last_id = $result -> fetchAll();
  $curr_id = $last_id[0][0] + 1;
  $ong = $_SESSION["name"];
  foreach ($proyectos as $proyecto){
    $proy_name = $proyecto[0];
    $content = $contents[$proyecto[1]];
    $type = rand(0,1); // 0: marcha, 1: rrss
    $id = $curr_id;
    $asistencia = rand(100,10000);
    $insert = "SELECT generar_movilizaciones($id, $type, $presupuesto, $asistencia,
       '$comuna', '$ong', '$proy_name', '$content')";
    $result = $db52 -> prepare($insert);
    $result -> execute();
    $curr_id += 1;
  }
?>

<div class=container>
  <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
    <table class="table table-hover table-sm w-auto">
      <thead class="thead-dark" style="position: sticky; top: 0;">
        <tr>
          <th>ONG</th>
          <th>Proyecto</th>
          <th>Fecha</th>
        </tr>
      </thead>
      <?php
        $id = $last_id[0][0];
        $query = "SELECT * FROM convocan WHERE id_movilizacion > $id;";
        $result = $db52 -> prepare($query);
      	$result -> execute();
      	$results = $result -> fetchAll();
        foreach ($results as $row) {
          echo "<tr> <td>$row[1]</td>
                     <td>$row[2]</td>
                     <td>$row[3]</td> </tr>";
        }
      ?>
    </table>
  </div>
</div>

</body>
</html>
