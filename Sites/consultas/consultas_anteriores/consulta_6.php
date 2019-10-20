<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT proyecto, id_movilizacion, tipo, fecha
            FROM denuncian, convocan, movilizacion
            WHERE denuncian.numero IN (SELECT recurso.numero FROM recurso WHERE recurso.status = 'en tramite')
            AND denuncian.proyecto = convocan.nombre_proyecto
            AND convocan.id_movilizacion = movilizacion.id
            AND movilizacion.tipo = 'marcha' AND fecha > CURRENT_TIMESTAMP
            UNION
            SELECT proyecto, id_movilizacion, tipo, fecha
            FROM denuncian, convocan, movilizacion, movilizacionredes
            WHERE denuncian.numero IN (SELECT recurso.numero FROM recurso WHERE recurso.status = 'en tramite')
            AND denuncian.proyecto = convocan.nombre_proyecto
            AND convocan.id_movilizacion = movilizacion.id
            AND movilizacion.id = movilizacionredes.id
            AND movilizacion.tipo = 'redes sociales'
            AND fecha + duracion > CURRENT_TIMESTAMP;";

	$result = $db -> prepare($query);
	$result -> execute();
	$proyectos = $result -> fetchAll();
  ?>

  <div class=container>
  <div class="row justify-content-center" style="overflow: auto; max-height: 500px">
  <table class="table table-hover table-sm w-auto">
    <thead class="thead-dark" style="position: sticky; top: 0;">
    <tr>
      <th>Proyecto</th>
      <th>ID Movilización</th>
      <th>Tipo</th>
      <th>Fecha</th>
    </tr>
    </thead>
  <?php
	foreach ($proyectos as $proyecto) {
  		echo "<tr> <td>$proyecto[0]</td>
                 <td>$proyecto[1]</td>
                 <td>$proyecto[2]</td>
                 <td>$proyecto[3]</td> ";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
