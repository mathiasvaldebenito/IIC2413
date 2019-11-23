<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  require("../config/conexion.php");
  $proy_name = $_GET["name"];

  $nombre_socio = $SESSION['name'];
  $query = "SELECT id_socio FROM socios WHERE nombre LIKE '%$nombre_socio%';";
  $result = $db41 -> prepare($query);
  $result -> execute();
  $id = $result -> fetchAll();
  $id_socio =  $id[0][0];

  $query2 = "SELECT id_proyecto FROM proyectos WHERE nombre LIKE '%$proy_name%';";
  $result = $db41 -> prepare($query2);
  $result -> execute();
  $id = $result -> fetchAll();
  $id_proyecto =  $id[0][0];


  $insert = "INSERT INTO participa (id_socio, id_proyectos) VALUES ($id_socio,$id_proyecto);";
  $result = $db41 -> prepare($insert);
  $result -> execute();

  $query3 = "SELECT * FROM participa WHERE id_socio = '$id_socio' AND id_proyectos = '$id_proyecto' ;";
  $result = $db41 -> prepare($query3);
  $result -> execute();
  $results = $result -> fetchAll();
?>

<br>
<div class="row justify-content-center">
  <h2>Te has unido existosamente...</h2>
</div>
<br>
 <div class=container>
   <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
     <table class="table table-hover table-sm w-auto">
       <thead class="thead-dark" style="position: sticky; top: 0;">
         <tr>
           <th>Id Socio</th>
           <th>Id proyecto</th>
           <th>Proyecto</th>
         </tr>
       </thead>
       <?php
         foreach ($results as $row) {
           echo "<tr> <td>$row[0]</td>
                      <td>$row[1]</td>
                      <td>$proy_name</td> </tr>";
         }
       ?>
     </table>
   </div>
 </div>

 <form action="./proyectos.php" method="get" class="d-flex justify-content-center">
     <input type="submit" class="btn btn-primary" value="Volver atrás">
 </form>
