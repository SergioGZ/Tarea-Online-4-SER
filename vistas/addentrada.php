<!DOCTYPE html>
<html>
  <head>
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body class="cuerpo">
    <div class="centrar">	
      <div class="container centrar">
        <a href="index.php?accion=login">Inicio</a>
        <div class="container cuerpo text-center centrar">	 
          <p><h2><img class="alineadoTextoImagen" src="images/user.png" width="50px"/>Añadir Usuario</h2> </p>
        </div>
        <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
          <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>
        <?php endforeach; ?>
        <form action="index.php?accion=addentrada" method="post" enctype="multipart/form-data">
          <label for="titulo">Titulo
            <input type="text" class="form-control" name="titulo" required value="<?= $parametros["datos"]["titulo"] ?>"></label>
          <br/>
          <label for="descripcion">Descripción
            <input type="text" class="form-control" name="descripcion" value="<?= $parametros["datos"]["descripcion"] ?>"></label>
          <br/>
          <label for="txtpass">Contraseña
            <input type="password" class="form-control" name="txtpass" required value="<?= $parametros["datos"]["txtpass"] ?>"></label>
          <br/>
          <label for="imagen">Imagen <input type="file" name="imagen" class="form-control" value="<?= $parametros["datos"]["imagen"] ?>" /></label>
          </br>
          <input type="submit" value="Guardar" name="submit" class="btn btn-success">
        </form>
      </div>
  </body>
</html>