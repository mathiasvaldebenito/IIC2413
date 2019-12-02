<?php require("../routes.php");?>
<?php require("../templates/header.php");?>
<br>

<div class="container">
  <div class="row justify-content-center">
    <h2>Recurso</h2>
  </div>
</div>

<br>

<?php
    #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");
  $nro_recurso = $_GET["name"];

  $query = "SELECT recurso.numero, presentan.ong, denuncian.proyecto,
                   recurso.causa_contaminacion, recurso.status, recurso.comuna_tramitacion,
                   comuna_region_rec.region_tramitacion, recurso.area_influencia,
                  recurso.fecha_apertura, recurso.descripcion
            FROM recurso, presentan, denuncian, comuna_region_rec
            WHERE recurso.numero = presentan.numero
            AND recurso.numero = denuncian.numero
            AND recurso.comuna_tramitacion = comuna_region_rec.comuna_tramitacion
            AND recurso.numero = '$nro_recurso';";

  $query2 = "SELECT fecha_dictamen
             FROM recurso, recursocerrado
             WHERE recurso.numero = recursocerrado.numero
             AND recurso.numero = '$nro_recurso';";

  $result = $db52 -> prepare($query);
  $result -> execute();
  $recursos = $result -> fetchAll();

  $result2 = $db52 -> prepare($query2);
  $result2 -> execute();
  $fecha_dictamen = $result2 -> fetchAll();
  $dictamen = $fecha_dictamen[0][0];

  $numero = $recursos[0][0];
  $proyecto = $recursos[0][2];
  $causa_contaminacion = $recursos[0][3];
  $status = $recursos[0][4];
  $comuna = $recursos[0][5];
  $region = $recursos[0][6];
  $area = $recursos[0][7];
  $fecha = $recursos[0][8];
  $descripcion = $recursos[0][9];

?>

<br>

<div class="container">
  <div class="row justify-content-center">
    <div class="card" style="width: 100rem;">
      <div class="card-header">
        Recurso
      </div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Número: <?php  echo "<a>$numero</a>"; ?></li>
        <li class="list-group-item">ONGs que participan: <?php foreach ($recursos as $recurso) { echo "<a>$recurso[1]|</a>"; } ?></li>
        <li class="list-group-item">En contra del proyecto: <?php  echo "<a>$proyecto</a>"; ?></li>
        <li class="list-group-item">Causa de contaminación: <?php  echo "<a>$causa_contaminacion</a>"; ?></li>
        <li class="list-group-item">Status: <?php  echo "<a>$status</a>"; ?></li>
        <li class="list-group-item">Comuna: <?php  echo "<a>$comuna</a>"; ?></li>
        <li class="list-group-item">Región: <?php  echo "<a>$region</a>"; ?></li>
        <li class="list-group-item">Área de influencia: <?php  echo "<a>$area Km</a>"; ?></li>
        <li class="list-group-item">Fecha de apertura: <?php  echo "<a>$fecha</a>"; ?></li>
        <li class="list-group-item">Descripción: <?php  echo "<a>$descripcion</a>"; ?></li>
        <?php if ($dictamen) { echo "<li class='list-group-item'>Fecha de Dictamen: $dictamen </li>"; } ?>
      </ul>
    </div>
  </div>
</div>



<br>
<br>

<form action="../index.php" method="get" class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary" value="Volver inicio">
</form>

</body>

</html>
