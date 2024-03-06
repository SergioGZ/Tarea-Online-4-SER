<?php
  //var_dump($_SESSION['iduser']);
  //var_dump($parametros["datos"]);
  if (!isset($_SESSION['iduser'])) {
    header('Location: index.php');
  }

  require 'TCPDF/tcpdf.php';

  function generarPDF($id, $nick, $titulo, $descripcion, $imagen, $fecha)
{
    // Crear una instancia de TCPDF
    $pdf = new TCPDF();

    // Establecer metadatos del documento
    $pdf->SetCreator($id);
    $pdf->SetAuthor($nick);
    $pdf->SetTitle($titulo);

    // Agregar una página al PDF
    $pdf->AddPage();

    // Agregar texto al PDF
    $pdf->SetFont('times', '', 12);
    $pdf->Cell(0, 10, $fecha, 0, 1);
    $pdf->Cell(0, 10, $nick, 0, 1);
    $pdf->Cell(0, 10, $titulo, 0, 1);
    $pdf->Cell(0, 10, $descripcion, 0, 1);

    // Agregar una imagen al PDF
    $imagePath = $imagen; // Reemplaza con la ruta de tu imagen
    $pdf->Image($imagePath, 10, 60, 80, 60, 'JPEG'); // Parámetros: URL/ruta, x, y, ancho, alto, formato

    // Guardar el PDF en el servidor o mostrarlo en el navegador
    $pdf->Output('entrada.pdf', 'I');
}

$id = $_SESSION['iduser'];
$titulo = $parametros["datos"]["titulo"];
$descripcion = $parametros["datos"]["descripcion"];
$nick = $parametros["datos"]["nick"];
$fecha = $parametros["datos"]["fecha"];
// Mostrar la imagen si está definida
if (!empty($parametros["datos"]["imagen"])) {
  $imagen =  $parametros["datos"]["imagen"];
} else {
  $imagen =  "No hay imagen disponible.";
}

// Verificar si se ha enviado la solicitud
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Llamar a la función para generar el PDF cuando se reciba la solicitud
    generarPDF($id, $nick, $titulo, $descripcion, $imagen, $fecha);
}
?>

<html>
  <head>
    <?php require_once 'includes/head.php'; ?>
  </head>
  <body>
    <div class="container bg-white" style="height:100vh">
      <?php include_once 'vistas/includes/header.html'; ?>
      <div class="tituloentrada mt-3">
        <h2 class="text-center mx-auto border border-3 border-dark p-2" style="width:fit-content"><?= $parametros["datos"]["titulo"] ?></h2>
        <h3 class="text-center">Autor: <?= $parametros["datos"]["nick"] ?></h3><h3 class="text-center">Categoría: <?= $parametros["datos"]["nombreCategoria"] ?></h3>
      </div>
      <div class="imagen">
        <?php if ($parametros["datos"]["imagen"] !== NULL) : ?>
        <img class="mx-auto d-flex justify-content-center mt-3" style="max-width: 350px;" src="fotos/<?= $parametros["datos"]['imagen'] ?>" />
        <?php else : ?>
        <p class="text-center">----</p>
        <?php endif; ?>
      </div>
      <div class="contenidoentrada mt-3 mx-auto text-center" style="max-width: 500px;">
        <p><?= $parametros["datos"]["descripcion"] ?></p>
      </div>
      <div class="fecha mt-3">
        <h4 class="text-center mt-1">Fecha: <?= $parametros["datos"]["fecha"] ?></h4>
      </div>
      <form action="" method="post">
        <button class="btn btn-primary ms-5 mt-5" type="submit">Generar PDF</button>
      </form>
    </div>
  </body>
</html>