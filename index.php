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
   <title>Gobierno de Totolapan 2018-2021</title>
</head>

<body>
   <!-- menu -->
   <?php require("./menu.php"); ?>
   <!-- Contenido Principal -->
   <div class="container mt-3">
      <!-- slider -->
      <div id="carouselExampleIndicators" class="carousel slide d-none d-lg-block" data-ride="carousel">
         <?php echo ItemsSlider(); ?>
         <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
         </a>
         <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
         </a>
      </div>
      <!-- Contenido principal del la pagina -->
      <section class="row mt-5 mb-4">
         <div class="col-12 col-lg-8">
            <div class="card">
               <div class="card-body">
                  <h5 class="card-title">Turismo <i class="icon icon-airplane"></i> </h5>
                  <p class="card-text">Conoce hasta el último rincón de nuestro pueblo, estamos seguros que encontrarás
                     actividades que te llenen de diversión a ti, y a toda tu familia!</p>
               </div>
               <a href="./turismo.php" class="link"><img src="./img/body-content/turismo.jpeg" class="card-img-top" alt=""></a>
            </div>
         </div>
         <div class="col-12 col-lg-4">
            <div class="row mt-3 mt-lg-0">
               <div class="col">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Cultura <i class=" icon icon-accessibility"></i> </h5>
                        <p class="card-text">Ven a conocer el arte, cultura y tradiciones que engalardan a nuestra
                           población</p>
                     </div>
                     <a href="./cultura.php" class="link"><img src="./img/body-content/cultura.jpg" class="card-img-top img-fluid" alt=""></a>
                  </div>
               </div>
            </div>
            <div class="row mt-5">
               <div class="col">
                  <div class="card">
                     <div class="card-body">
                        <h5 class="card-title">Nuestras redes <i class="icon icon-twitch"></i> </h5>
                        <ul class="list-group list-group-flush">
                           <li class="list-group-item py-2"><a class="card-link"  href=""> <i class="text-muted icon-facebook pr-3"></i>Facebook</a></li>
                           <li class="list-group-item py-2"><a class="card-link" href=""> <i class="text-muted icon-twitter pr-3"></i>Twitter</a></li>
                           <li class="list-group-item py-2"><a class="card-link" href=""> <i class="text-muted icon-google-plus pr-3"></i>Google+</a></li>
                           <li class="list-group-item py-2"><a class="card-link" href=""> <i class="text-muted icon-youtube pr-3"></i>YouTube</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <section class="row mb-5">
         <?php echo EventosIndex(); ?>
         <?php echo ConvocatoriasIndex(); ?>         
      </section>
   </div>
   <!-- Footer -->
   <?php require("./footer.php"); ?>
   <script src="js/jquery-3.3.1.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/function.js"></script>
</body>

</html>