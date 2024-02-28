<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mi pequeño Blog</title>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;700;800&display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet" />
  <!--Bootstrap-->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@latest/font/bootstrap-icons.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!--enlace pdf-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!--enlaceckeditor-->
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <!-- Enlace css -->
  <link href="../CSS/style.css" rel="stylesheet" />


</head>

<body>
  <?php
  if (isset($_GET['error'])) {
    if ($_GET['error'] == "datos") {
      echo '<div class="alert alert-danger" style="margin-top:5px;">' . "Tu nombre de usuario y/o tu contraseña no son correctos, Vuelva a probar <br/>" . '</div>';
    } elseif ($_GET['error'] == "fuera") {
      echo '<div class="alert alert-danger" style="margin-top:5px;">' . "No puede acceder  directamente en esta página, debe iniciar sesión <br/>" . '</div>';
    }
  }
  ?>

  <div class="encabezado text-center">
    <h1><img class="alineadoTextoImagen" src="../Images/usuarios.png" />Mi Pequeño Blog</h1>
  </div>
  <div class="centrar">
    <div class="container cuerpo text-center">
      <p>
      <h2><img class="alineadoTextoImagen" src="../Images/user.png" width="50px" /> Login de Usuario:</h2>
      </p>
    </div>
    <div class="container">
      <form action="../Index.php?accion=login" method="POST">
        <label for="name">Usuario:
          <input type="text" name="usuario" class="form-control" />
        </label>
        <br />
        <label for="password">Contraseña:
          <input type="password" name="password" class="form-control" />
          <br />
          <input type="submit" value="Enviar" name="submit" class="btn btn-success" />
      </form>
    </div>
  </div>
  <?php require "includes/footer.php"; ?>
</body>

</html>