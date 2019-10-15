<?php require("./../config.php");?>
<?php include('./../templates/header.php');   ?>

<body>
    <?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
    require("../config/conexion.php");

    $query = "SELECT id_proyecto, nombre, tipo
              FROM Proyectos;";

    $result = $db41 -> prepare($query);
    $result -> execute();
    $proyectos = $result -> fetchAll();
    ?>
    <form action="filtro_proyecto.php" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Tipo de Proyecto"
            aria-label="Tipo de Proyecto" aria-describedby="button-addon2" name="filtro">
            <div class="input-group-append">
                <input type="submit" class="btn btn-primary" value="Filtrar">
            </div>
        </div>
    </form>

    <table class="table table-hover">
      <thead class="thead-dark" style="position: sticky; top: 0;">
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Tipo</th>
      </tr>
    </thead>
    <?php
    foreach ($proyectos as $proyecto) {
            $proy_id = $proyecto[1];
            echo "<tr> <td>$proy_id</td>
                        <td><a href= 'show_proyecto.php?id=$proy_id'>$proyecto[1]</a> </td>
                        <td>$proyecto[2]</td> </tr>";
    }
    ?>
    </table>
</html>
