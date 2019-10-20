<?php
  try {
    #Pide las variables para conectarse a la base de datos.
    require('data.php');
    # Se crea la instancia de PDO
    $db52 = new PDO("pgsql:dbname=$databaseName52;host=localhost;port=5432;user=$user52;password=$password52");
    $db41 = new PDO("pgsql:dbname=$databaseName41;host=localhost;port=5432;user=$user41;password=$password41");
  } catch (Exception $e) {
    echo "No se pudo conectar a la base de datos: $e";
  }
?>
