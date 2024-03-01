<?php
  session_start();
  var_dump($_SESSION['iduser']); ?>
<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body>
    <div class="container">
      <?php include_once 'vistas/includes/header.html'; ?>
      <div class="text-center">	
        <p><h2><img class="alineadoTextoImagen" src="images/user.png" width="50px"/>Actualizar Usuario</h2> </p>
      </div>
      <?php // Mostramos los mensajes procedentes del controlador que se hayn generado
            foreach ($parametros["mensajes"] as $mensaje) : ?> 
             <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
      <?php endforeach; ?>
      <form action="index.php?accion=actentrada" method="post" enctype="multipart/form-data">
        <!-- Rellenamos los campos con los valores recibidos desde el controlador -->

        <label for="titulo">Titulo
          <input type="text" class="form-control" name="titulo" value="<?= $parametros["datos"]["titulo"] ?>" required></label>
        <br/>

        <label for="descripcion">Descripción
          <input type="text" class="form-control" name="descripcion" value="<?= $parametros["datos"]["descripcion"] ?>"></label>
        <br/>

        <label for="fecha">Fecha
          <input type="date" class="form-control" name="fecha" value="<?= $parametros["datos"]["fecha"] ?>"></label>
        <br/>

        <label for="categoria_id">Categoría
          <input type="text" class="form-control" name="categoria_id" value="<?= $parametros["datos"]["categoria_id"] ?>"></label>
        <br/>


        <?php if ($parametros["datos"]["imagen"] != null && $parametros["datos"]["imagen"] != "") { ?>
          </br>Imagen actual: <img src="fotos/<?= $parametros["datos"]["imagen"] ?>" width="60" /></br>
        <?php } ?>
        </br>
        <label for="imagen">Imagen nueva:
          <input type="file" name="imagen" class="form-control" value="<?= $parametros["datos"]["imagen"] ?>" /></label>
        </br>
        <!--Creamos un campo oculto para mantener el valor del id que deseamos modificar cuando pulsemos el botón actualizar-->  
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <br/>
        <input type="submit" value="Actualizar" name="submit" class="btn btn-success">
      </form>
    </div>
  </body>
</html>