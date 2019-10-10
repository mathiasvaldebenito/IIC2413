<?php include('../templates/header.html');   ?>

<body>

  <?php
  require("../config/conexion.php"); #Llama a conexión, crea el objeto PDO y obtiene la variable $db

  $var = $_POST["tip"];

  $query = "SELECT recursos.id_recurso, recursos.causa, recursos.comuna_tramite,
  lugartramite.region_tramite, recursos.estatus_limite FROM recursos,
  ubicaciontramite, lugartramite WHERE recursos.id_recurso = ubicaciontramite.id_recurso
  AND ubicaciontramite.comuna_tramite = lugartramite.comuna_tramite AND
  (recursos.estatus_limite = 'aprobado' OR recursos.estatus_limite = 'en trámite')
  ORDER BY lugartramite.region_tramite;";
  $result = $db -> prepare($query);
  $result -> execute();
  $dataCollected = $result -> fetchAll(); #Obtiene todos los resultados de la consulta en forma de un arreglo
  ?>

  <table>
    <tr>
      <th>Region Trámite</th>
      <th>Comuna Trámite</th>
      <th>Id</th>
      <th>Causa</th>
      <th>Status</th>
    </tr>
  <?php
  foreach ($dataCollected as $p) {
    echo "<tr> <td>$p[3]</td> <td>$p[2]</td> <td>$p[0]</td> <td>$p[1]</td> <td>$p[4]</td> ";
  }
  ?>
  </table>

<?php include('../templates/footer.html'); ?>
