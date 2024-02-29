<?php
  echo "<h1>Usuario: " . $_SESSION['iduser'] . "</h1>";
?>

<html>
  <head>
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body>
    <div class="container">
      <?php include_once 'vistas/includes/header.html'; ?>
      <?php foreach ($parametros["datos"] as $a) : ?>
        <?php 
          $usuario_id = $a["usuario_id"];
        endforeach; ?>
      <a class="m-4 pt-1 btn btn-warning" href="index.php?accion=addentrada&id=<?php echo $_SESSION['iduser']; ?>"><i class="bi bi-door-open-fill"></i> Crear Entrada</a>
      <!--Mostramos los mensajes que se hayan generado al realizar el listado-->
      <?php foreach ($parametros["datos"] as $d) : ?>
      <?php foreach ($parametros["mensajes"] as $mensaje) : ?> 
      <!-- <div class="alert alert-<?= $mensaje["tipo"] ?>"><?= $mensaje["mensaje"] ?></div>-->
      <?php endforeach; ?>

      <div class="row bg-primary border border-5 border-dark">
        <div class="col-12" id="tituloentrada">
        <h2 class="text-center"><?= $d["titulo"] ?></h2>
        <h3 class="text-center">Autor: <?= $d["usuario_id"] ?></h3>
        </div>

        <div class="col-12 bg-white border border-5 border-start-0 border-end-0 border-dark" id="contenidoentrada">
          <?php if ($d["imagen"] !== NULL) : ?>
          <img class="text-center" src="fotos/<?= $d['imagen'] ?>" width="40" />
          <?php else : ?>
          <p class="text-center">----</p>
          <?php endif; ?>
          <p class="mx-auto d-flex justify-content-center"><?= $d["descripcion"] ?></p>
        </div>

        <div class="col-12">
          <h4 class="text-center mt-1">Fecha: <?= $d["fecha"] ?></h4>
        </div>
      </div>
      <div class="mt-1 mb-5">
        <a class="btn btn-secondary" href="index.php?accion=actuser&id=<?= $d['ID'] ?>">Editar</a> <a class="btn btn-secondary" href="index.php?accion=deluser&id=<?= $d['ID'] ?>">Eliminar</a>
      </div>
      <?php endforeach; ?>
    </div>
  </body>
</html>