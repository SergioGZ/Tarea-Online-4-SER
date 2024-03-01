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
        <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach; ?>
        <form action="index.php?accion=addentrada" method="post" enctype="multipart/form-data">
          <input type="hidden" name="id" value="<?php echo $_SESSION['iduser'] ?>">
          <label for="titulo" class="mt-2">Titulo
            <input type="text" class="form-control" name="titulo" required value="<?= $parametros["datos"]["titulo"] ?>"></label>
          <br/>
          <label for="descripcion" class="mt-2">Descripción
            <input type="text" class="form-control" name="descripcion" value="<?= $parametros["datos"]["descripcion"] ?>"></label>
          <br/>
          <label for="categoria_id" class="mt-2">Categoría
            <input type="text" class="form-control" name="categoria_id" required value="<?= $parametros["datos"]["categoria_id"] ?>"></label>
          <br/>
          <label for="fecha" class="mt-2">Fecha
            <input type="date" class="form-control" name="fecha" required value="<?= $parametros["datos"]["fecha"] ?>"></label>
          <br/>
          <label for="imagen" class="mt-2">Imagen <input type="file" name="imagen" class="form-control" value="<?= $parametros["datos"]["imagen"] ?>" /></label>
          </br>
          <input type="submit" value="Guardar" name="submit" class="btn btn-success mt-2">
        </form>
      </div>
  </body>
</html>