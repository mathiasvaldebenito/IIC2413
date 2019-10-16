<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $filtro = $_POST["filtro"];

    $query = "SELECT id_proyecto, nombre, tipo
              FROM Proyectos
              WHERE tipo='$filtro';";

    $result = $db41 -> prepare($query);
    $result -> execute();
    $proyectos = $result -> fetchAll();
    ?>
    <div class="row justify-content-center">
    <div class="d-inline-flex" style="overflow: auto; max-height: 500px;">
      <table class="table table-hover table-md w-auto">
        <thead class="thead-dark" style="position: sticky; top: 0;">
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
          </tr>
        </thead>
    <?php
    foreach ($proyectos as $proyecto) {
            echo "<tr> <td>$proyecto[0]</td>
                        <td>$proyecto[1]</td>
                        <td>$proyecto[2]</td> </tr>";
    }
    ?>
    </table>
    </div>
    </div>
<br>
<form action="./proyectos.php" method="get" class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary" value="Volver atrás">
</form>
</div>
</body>

</html>
