<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query = "SELECT nombre, tipo
            FROM Proyectos;";

  $result = $db41 -> prepare($query);
  $result -> execute();
  $proyectos = $result -> fetchAll();
?>

<div class=container>
  <div class="row justify-content-center">
  <form action="filtro_proyecto.php" method="post">
    <div class="input-group my-3">
        <input type="text" class="form-control" placeholder="Tipo de Proyecto"
        aria-label="Tipo de Proyecto" aria-describedby="button-addon2" name="filtro">
        <div class="input-group-append">
            <input type="submit" class="btn btn-primary" value="Filtrar">
        </div>
    </div>
  </form>
  </div>

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
                echo "<tr> <td><a href= 'show_proyecto.php?name=$proyecto[0]'>$proyecto[0]</a> </td>
                      <td>$proyecto[1]</td>";
                if (isset($_SESSION["type"]) && $_SESSION["type"] == "Socio") { echo "<td> <a href= 'join_proyecto.php?name=$proyecto[0]'>Unirse</a></td> </tr>"; }
              } ?>
      </table>
    </div>
  </div>
</div>

</html>
