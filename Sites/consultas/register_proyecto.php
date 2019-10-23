<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $nombre = $_POST["Nombre"];
  $comuna = $_POST["Comuna"];
  $region = $_POST["Region"];
  $latitud = (float) $_POST["Latitud"];
  $longitud = (float) $_POST["Longitud"];
  $fecha = $_POST["Fecha"];
  $tipo = $_POST["Tipo"];
  $operativo = $_POST["Operativo"];
  $mineral = $_POST["Mineral"];
  $tipo_generacion = $_POST["Tipo_generacion"];

  //db41
  //inser in LugarProyecto CHECK
  $insert = "INSERT INTO lugarproyecto (comuna, region) VALUES ('$comuna', '$region');";
  //echo $insert;
  $result = $db41 -> prepare($insert);
  $result -> execute();

  $query = "SELECT MAX(id_proyecto) FROM proyectos;";
  $result = $db41 -> prepare($query);
  $result -> execute();
  $last_id = $result -> fetchAll();
  $curr_id = $last_id[0][0] + 1;

  //insert in Proyectos CHECK
  $insert = "INSERT INTO proyectos (tipo, nombre, latitud, longitud, fecha_apertura, operativo, id_proyecto)
             VALUES ('$tipo', '$nombre',$latitud,$longitud,'$fecha','$operativo',$curr_id);";
  $result = $db41 -> prepare($insert);
  $result -> execute();

  //insert in Mineria o Energia
  if($tipo == 'mina'){
    $insert = "INSERT INTO mineria (id_proyectos, mineral) VALUES ($curr_id, '$mineral');";
    $result = $db41 -> prepare($insert);
    $result -> execute();
  }
  if($tipo == 'central eléctrica'){
    $insert = "INSERT INTO energia (id_proyectos, tipo_generacion) VALUES ($curr_id, '$tipo_generacion');";
    $result = $db41 -> prepare($insert);
    $result -> execute();
  }

  //insert in UbicacionProyecto CHECK
  $insert = "INSERT INTO ubicacionproyecto (id_proyectos, latitud, longitud, comuna)
             VALUES ($curr_id, $latitud, $longitud,'$comuna');";
  $result = $db41 -> prepare($insert);
  $result -> execute();

  //insert in Participacion CHECK
  $nombre_socio = $SESSION['name'];
  $query = "SELECT id_socio FROM socios WHERE nombre LIKE '%$nombre_socio%';";
  $result = $db41 -> prepare($query);
  $result -> execute();
  $id = $result -> fetchAll();
  $id_socio =  $id[0][0];

  //insertar en participa
  $insert = "INSERT INTO participa (id_socio, id_proyectos) VALUES ($id_socio,$curr_id);";
  $result = $db41 -> prepare($insert);
  $result -> execute();

  //db52

  //insert in Comuna_region_proy
  //$insert = "INSERT INTO comuna_region_proy (comuna, region) VALUES ('$comuna', '$region');";
  //$result = $db52 -> prepare($insert);
  //$result -> execute();

  //insert in Proyecto
  //if($tipo=='mina'){
  //  $insert = "INSERT INTO proyecto (nombre, comuna, latitud, longitud, fecha_apertura, operativo, tipo)
  //             VALUES ('$nombre', '$comuna', $latitud, $longitud, '$fecha', '$operativo', 1);";
  //  $result = $db52 -> prepare($insert);
  //  $result -> execute();

  //  $insert = "INSERT INTO proyectomina (nombre, mineral) VALUES ('$nombre', '$mineral');";
  //  $result = $db52 -> prepare($insert);
  //  $result -> execute();
  //}
  //if($tipo == 'central eléctrica') {
  //  $insert = "INSERT INTO proyecto (nombre, comuna, latitud, longitud, fecha_apertura, operativo, tipo)
  //             VALUES ('$nombre', '$comuna', $latitud, $longitud, '$fecha', '$operativo', 2);";
  //  $result = $db52 -> prepare($insert);
  //  $result -> execute();

  //  $insert = "INSERT INTO proyectoelectrica (nombre, tipo_generacion)
  //             VALUES ('$nombre', '$tipo_generacion');";
  //  $result = $db52 -> prepare($insert);
  //  $result -> execute();
  //}
  //if($tipo == 'vertedero') {
  //  $insert = "INSERT INTO proyecto (nombre, comuna, latitud, longitud, fecha_apertura, operativo, tipo)
  //             VALUES ('$nombre', '$comuna', $latitud, $longitud, '$fecha', '$operativo', 3);";
  //  $result = $db52 -> prepare($insert);
  //  $result -> execute();
  //}

?>
<br>
<div class="row justify-content-center">
  <h2>Tu proyecto ha sido creado existosamente...</h2>
</div>
<br>
 <div class=container>
   <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
     <table class="table table-hover table-sm w-auto">
       <thead class="thead-dark" style="position: sticky; top: 0;">
         <tr>
           <th>Nombre</th>
           <th>tipo</th>
           <th>latitud</th>
           <th>longitud</th>
           <th>fecha de apertura</th>
           <th>operativo</th>
         </tr>
       </thead>
       <?php
       $query = "SELECT * FROM proyectos WHERE id_proyecto = $curr_id;";
       $result = $db41 -> prepare($query);
       $result -> execute();
       $results = $result -> fetchAll();
         foreach ($results as $row) {
           echo "<tr> <td>$row[1]</td>
                      <td>$row[0]</td>
                      <td>$row[2]</td>
                      <td>$row[3]</td>
                      <td>$row[4]</td>
                      <td>$row[5]</td> </tr>";
         }
       ?>
     </table>
   </div>
 </div>

 <form action="./create_proyecto.php" method="get" class="d-flex justify-content-center">
     <input type="submit" class="btn btn-primary" value="Volver atrás">
 </form>
