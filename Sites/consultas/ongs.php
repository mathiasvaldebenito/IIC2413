<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query = "SELECT nombre
            FROM ongs;";

  $result = $db52 -> prepare($query);
  $result -> execute();
  $ongs = $result -> fetchAll();
?>

<br>

<div class="container">
  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Nombre Ong</th>
          </tr>
        </thead>
        <?php foreach ($ongs as $ong) {
                echo "<tr> <td><a href= 'show_ong.php?name=$ong[0]'>$ong[0]</a> </td>
                      </tr>";
              } ?>
      </table>
    </div>
  </div>
</div>
</body>

</html>
