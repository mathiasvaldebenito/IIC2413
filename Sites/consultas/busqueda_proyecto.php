<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

$proy_name = $_POST["busqueda_proyecto"];

$query = "SELECT nombre, tipo
            FROM Proyectos
            WHERE nombre LIKE '%$proy_name%';";

  $result = $db41 -> prepare($query);
  $result -> execute();
  $proyectos = $result -> fetchAll();
?>

  <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>Nombre</th>
            <th>Tipo</th>
            <?php if (isset($_SESSION["type"]) && $_SESSION["type"] == "Socio") { echo "<th>Se parte de este proyecto</th>"; }  ?>
          </tr>
        </thead>
        <?php foreach ($proyectos as $proyecto) {
                echo "<tr> <td><a href= 'show_proyecto_busqueda.php?name=$proyecto[0]'>$proyecto[0]</a> </td>
                      <td>$proyecto[1]</td>";
                if (isset($_SESSION["type"]) && $_SESSION["type"] == "Socio") { echo "<td> <a href= 'join_proyecto.php?name=$proyecto[0]'>Unirse</a></td> </tr>"; }
              } ?>
      </table>
    </div>
  </div>
</div>


<br>
<br>

<form action="../index.php" method="get" class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary" value="Volver atrás">
</form>

</body>

</html>
