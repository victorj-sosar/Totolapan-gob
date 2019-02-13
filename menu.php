<?php
   function errores($error){
      return ($error) ;
   }
   $msm="";
   if (isset($_POST["btn-enviar"])) {
      error_reporting(0);
      $destino = "alex.miranda.sanchez@gmail.com";
      $nombre = $_POST["nombre"];
      $correo = $_POST["correo"];
      $asunto = $_POST["asunto"];
      $mensaje = $_POST["mensaje"];
      $contenido = "Nombre: " . $nombre . "\nCorreo: " . $correo . "\nAsunto: " . $asunto . "\nMensaje: " . $mensaje;
      if (mail($destino, $asunto, $contenido)) {
         $msm = "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                     <strong>Correcto!</strong> El correo electrónico ha sido enviado correctamente.
                     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                  </div>";
      } else {
         $msm = "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                     <strong>Error!</strong> No se ha podido enviar el mensaje.
                     <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                     </button>
                  </div>";
      }
      
   }
?>
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-cyan d-flex justify-content-between">
   <div class="container">
      <a class="navbar-brand" href="./index.php">
         <img class="logo" src="img/body-content/logo.png" alt="">
         <span class="h4 title"><strong>TOTOLAPAN</strong></span>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav"
         aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
         <ul class="navbar-nav ml-auto">
            <li class="nav-item mr-3">
               <a class="nav-link text-white" href="./index.php"><i class="icon-home2 mr-2"></i>Inicio</a>
            </li>
            <li class="nav-item mr-3 dropdown">
               <a class="nav-link text-white" href="#" role="button" id="dropdownMenuGoberment" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><i class="icon-library mr-2"></i>Gobierno<i class="icon-chevron-down ml-3"></i></a>
               <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuAlpha">
                  <a class="dropdown-item" href="./presidente.php">Presidente Muncipal</a>
                  <a class="dropdown-item" href="./cabildo.php">Cabildo</a>
                  <a class="dropdown-item" href="./funcionarios.php">Funcionarios</a>
               </div>
            </li>
            <li class="nav-item mr-3 dropdown">
               <a class="nav-link text-white" href="#" role="button" id="dropdownMenuAlpha" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><i class="icon-hammer2 mr-2"></i>Transparencia<i class="icon-chevron-down ml-3"></i></a>
               <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuAlpha">
                  <a class="dropdown-item" target="_blank" href="https://www.infomex.org.mx/gobiernofederal/home.action">INFOMEX</a>
                  <a class="dropdown-item" target="_blank" href="https://www.imipe.org.mx/">IMIPE</a>
                  <a class="dropdown-item" target="_blank" href="http://www.transparenciamorelos.mx/totolapan">Portal
                     de Transparencia</a>
                  <a class="dropdown-item" href="#">Armonización Contable</a>
                  <a class="dropdown-item" target="_blank" href="http://inicio.inai.org.mx/SitePages/ifai.aspx">INAI</a>
                  <a class="dropdown-item" href="./convocatorias.php">Convocatorias</a>
               </div>
            </li>
            <li class="nav-item mr-3 dropdown">
               <a class="nav-link text-white" href="#" role="button" id="dropdownMenuDocs" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false"><i class="icon-profile mr-2"></i>Trámites<i class="icon-chevron-down ml-3"></i></a>
               <div class="dropdown-menu pt-0 pb-0" aria-labelledby="dropdownMenuDocs">
                  <div class="dropdown-item p-0">
                     <span class="dropdown-item">Agua Potable<i class="icon-chevron-down ml-3"></i></span>
                     <div class="pt-0 pb-0 ssbmenu">
                        <a class="dropdown-item" href="#">Recibos</a>
                        <a class="dropdown-item" href="#">Pagos</a>
                        <a class="dropdown-item" href="#">Consultas</a>
                     </div>
                  </div>
                  <a class="dropdown-item" href="#">Registro Civil</a>
                  <a class="dropdown-item" href="#">Catastro</a>
                  <a class="dropdown-item" href="#">Receptora de Rentas</a>
                  <a class="dropdown-item" href="#">Apoyos Agropecuaríos
                  </a>
               </div>
            </li>
            <li class="nav-item">
               <a class="nav-link text-white" data-toggle="modal" data-target="#contactModal"><i class="icon-bubbles mr-2"></i>Contacto</a>
            </li>

         </ul>
      </div>
   </div>
</nav>
<div class="container mt-3">
   <?php
      echo(errores($msm));
   ?>
</div>
<!-- modal de envío de correo electronico-->
<div class="modal fade" id="contactModal">
   <div class="modal-dialog modal-lg modal-dialog-centered">
      <form class="modal-content needs-validation" method="post" action="<?php $_SERVER['PHP_SELF'] ?>" novalidate>
         <div class="modal-header bg-primary text-white">
            <h3 class="modal-title">Contacto <i class="icon-bubbles"></i></h3>
            <button class="close text-white" data-dismiss="modal">
               <span>&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-12 d-flex justify-content-center"><img class="logo-contact" src="./img/body-content/bg-footer.png" alt=""></div>
            </div>
            <div class="row mt-2">
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="nombre">Nombre</label>
                     <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre"
                        autocomplete="off" required>
                  </div>
               </div>
               <div class="col-12 col-md-6">
                  <div class="form-group">
                     <label for="mail">Correo</label>
                     <div class="input-group">
                        <div class="input-group-prepend">
                           <span class="input-group-text form-control-sm" id="inputGroupPrepend">@</span>
                        </div>
                        <input type="email" class="form-control form-control-sm" id="mail" name="correo" placeholder="Correo"
                           autocomplete="off" aria-describedby="inputGroupPrepend" required>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="asunto">Asunto</label>
               <input type="text" class="form-control form-control-sm" id="asunto" name="asunto" placeholder="Asunto"
                  autocomplete="off" required>
            </div>
            <div class="form-group">
               <label for="mensaje">Mensaje</label>
               <textarea class="form-control form-control-sm" id="mensaje" name="mensaje" placeholder="Mensaje..."
                  autocomplete="off" required></textarea>
            </div>
            <div class="form-group d-flex justify-content-end">
               <button type="submit" name="btn-enviar" class="btn btn-outline-success rounded-pill">Enviar <i class="ml-3 icon-send"></i></button>
            </div>
         </div>
      </form>
   </div>
</div>
<!-- <script>
   (function () {
      'use strict';
      window.addEventListener('load', function () {
         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         var forms = $('.needs-validation');
         // Loop over them and prevent submission
         var validation = Array.prototype.filter.call(forms, function (form) {
            form.addEventListener('submit', function (event) {
               if (form.checkValidity() === false) {
                  event.preventDefault();
                  event.stopPropagation();
               }
               $(form).addClass('was-validated');
            }, false);
         });
         // cierra la alerta despues de 5 segundos
         setTimeout(() => {
            $(".alert").alert('close');
         }, 5000);
      }, false);
   })();
</script> -->