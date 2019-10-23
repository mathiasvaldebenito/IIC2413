<?php require("../routes.php");?>
<?php require("../templates/header.php");?>

<br>

<div class="container">
  <div class="row justify-content-center">
    <h2>Crea un Proyecto!</h2>
  </div>
</div>

<br>

<form action="register_proyecto.php" method="post">
  <div class="form-group">
    <div class="row justify-content-center">
      <div class="form-group col-md-10">
        <label>Nombre del Proyecto</label>
        <input type="text" class="form-control" name="Nombre" placeholder="Enel">
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="row justify-content-center">
      <div class="form-group col-md-5">
        <label>Comuna de ubicación del proyecto</label>
        <input type="text" class="form-control" name="Comuna" placeholder="Maipú">
      </div>
      <div class="form-group col-md-5">
        <label>Región de ubicación del proyecto</label>
        <select name="Region" class="form-control">
          <option selected>Metropolitana de Santiago</option>
          <option>I de Tarapaca</option>
          <option>II de Antofagasta</option>
          <option>III de Atacama</option>
          <option>IV de Coquimbo</option>
          <option>V de Valparaiso</option>
          <option>VI del Libertador General Bernardo O'Higgins</option>
          <option>VII del Maule</option>
          <option>VIII del Bio-Bio</option>
          <option>IX de La Araucania</option>
          <option>X de Los Lagos</option>
          <option>XI de Aysen del General Carlos Ibañez del Campo</option>
          <option>XII de Magallanes y de la Antartica Chilena</option>
          <option>XIV de Los Rios</option>
          <option>XV de Arica y Parinacota</option>
          <option>XVI de Ñuble</option>
        </select>
      </div>
    </div>
  </div>
  <div class="form-row justify-content-center">
    <div class="form-group col-md-5">
      <label>Latitud</label>
      <input type="text" class="form-control" name="Latitud" placeholder="-33.4986449">
    </div>
    <div class="form-group col-md-5">
      <label>Longitud</label>
      <input type="text" class="form-control" name="Longitud" placeholder="-70.6125454">
    </div>
  </div>
  <div class="form-row justify-content-center">
    <div class="form-group col-md-5">
      <label>Fecha de apertura</label>
      <input type="date" class="form-control" name="Fecha">
    </div>
    <div class="form-group col-md-3">
      <label>Tipo de Proyecto</label>
      <select name="Tipo" class="form-control">
        <option selected>vertedero</option>
        <option>mina</option>
        <option>central eléctrica</option>
      </select>
    </div>
    <div class="form-group col-md-2">
      <label>Operativo</label>
      <select name="Operativo" class="form-control">
        <option selected>si</option>
        <option>no</option>
      </select>
    </div>
  </div>
  <div class="form-row justify-content-center">
    <div class="form-group col-md-5">
      <a>Completa si corresponde:</a>
      <br><br>
      <label> Mineral</label>
      <input type="text" class="form-control" name="Mineral" placeholder="Cobre">
    </div>
    <div class="form-group col-md-5">
      <br><br>
      <label>Tipo de genaración</label>
      <input type="text" class="form-control" name="Tipo_generacion" placeholder="Nuclear">
    </div>
  </div>
  <div class="row justify-content-center">
    <button type="submit" class="btn btn-primary">Crear Proyecto</button>
  </div>
</form>


</body>

</html>
