<?php
   require './conexion.php';
   include './funciones.php';
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="css/bootstrap.css">
   <link rel="stylesheet" href="css/style.css">
   <link rel="stylesheet" href="css/styles.css">
   <link rel="shortcut icon" href="./img/body-content/logo.ico" type="image/x-icon">
   <title>Convocatorias</title>
</head>

<body>
   <!-- menu -->
   <?php require("./menu.php"); ?>
   <!-- Contenido Principal -->
   <div class="container my-3">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
            <li class="breadcrumb-item">Transparencia</li>
            <li class="breadcrumb-item active" aria-current="page">Convocatorias</li>
         </ol>
      </nav>
      <div class="row">
         <?php echo Announcement(); ?>
      </div>
   </div>
   <!-- Footer -->
   <?php require("./footer.php"); ?>
   <script src="js/jquery-3.3.1.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/function.js"></script>
</body>

</html>