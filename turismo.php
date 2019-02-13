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
   <title>Turismo</title>
</head>

<body>
   <!-- menu -->
   <?php require("./menu.php"); ?>
   <!-- Contenido Principal -->
   <div class="container">
      <nav aria-label="breadcrumb">
         <ol class="breadcrumb bg-white pl-0">
            <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Turismo</li>
         </ol>
      </nav>
      <div class="row">
         <div class='col-12 col-md-6 mb-4'>
            <div class='card text-dark'>
               <div class='card-body'>
                  <h3 class='card-title'>Ex-convento de San Guillermo</h3>
                  <hr>
                  <p class='card-text'>Conoce uno de los conventos más antiguos de nuestro país y que es sin duda, la construcción más notable del municipio de Totolapan.</p>
               </div>
               <img src='./img/tour/exconvento.jpg' class='card-img-top'>
            </div>
         </div>
         <div class='col-12 col-md-6 mb-4'>
            <a href='http://www.tazimor.com.mx/nepopualco.html' target="_blank" style='text-decoration: none;'>
               <div class='card text-dark'>
                  <div class='card-body'>
                     <h3 class='card-title'>Parque de los venados</h3>
                     <hr>
                     <p class='card-text'>Es un lugar especial dónde podrás disfrutar de los aires de montaña y descansar en sus acogedoras cabañas de madera. Ve y disfruta el aroma del bosque así como el canto de las aves.</p>
                  </div>
                  <img src='./img/tour/parque_venados.jpg' class='card-img-top'>
               </div>
            </a>
         </div>
      </div>
   </div>
   <div class="container-fluid mt-4 p-0 w-100 vh-100 d-none d-md-block">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12837.641506048703!2d-98.92188267047422!3d18.98375928396695!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce14a58e99c9fb%3A0x13e37e8e6e7043ab!2sTotolapan%2C+Mor.!5e0!3m2!1ses-419!2smx!4v1550011332429" width="100%" height="100%" frameborder="0" style="border:0" allowfullscreen></iframe>
   </div>
   <!-- Footer -->
   <?php require("./footer.php"); ?>
   <script src="js/jquery-3.3.1.js"></script>
   <script src="js/bootstrap.js"></script>
   <script src="js/function.js"></script>
</body>

</html>