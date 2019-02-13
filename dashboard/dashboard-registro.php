<?php
   session_start();
   require './../conexion.php';
   include './../funciones.php';
   $errors = array();
   $success = array();
   if (!isset($_SESSION["log_name"])) { //Si no ha iniciado sesión redirecciona a index.php
      header("Location: index.php");
   }
   // acciones del formulario de registro de usuarios
      if (isset($_POST['btn_rusuario'])) {
         $nombres = $mysqli->real_escape_string($_POST["txt-nombre"]);
         $paterno = $mysqli->real_escape_string($_POST["txt-paterno"]);
         $materno = $mysqli->real_escape_string($_POST["txt-materno"]);
         $usuario = $mysqli->real_escape_string($_POST["txt-usuario"]);
         $password = $mysqli->real_escape_string($_POST["txt-password"]);
         $tipo_usuario = $_POST["txt-tipo"];

         $pass_hash = hashPassword($password);
         $registro = registraUsuario($nombres, $paterno, $materno, $usuario, $pass_hash, $tipo_usuario);
         if ($registro > 0) {
            $success[] = "Usuario registrado exitosamente!";
         } else {
            $errors[] = "Error al registrar usuario!";
         }
      }

   // acciones del formulario de registro de items del slider
      if (isset($_POST['btn-rslider'])) {
         $titulo = $_POST['txt-titulo'];
         $descripcion = $_POST['txt-descripcion'];
         $file = $_FILES['txt-file'];
         if ($file['type']=="image/jpg" || $file['type'] == "image/jpeg" || $file['type'] == "image/png" || $file['type'] == "image/gif") {
            switch ($file['type']) {
               case 'image/jpg':
                  $tipo = "jpg";
                  break;
               case 'image/jpeg':
                  $tipo = "jpeg";
                  break;
               case 'image/png':
                  $tipo = "png";
                  break;
               case 'image/gif':
                  $tipo = "gif";
                  break;
            }

            if (!is_dir('./../img/slider')) {
               mkdir('./../img/slider', 0777);
            }
            $upload = registraItemSlider($tipo, $titulo, $descripcion,$file['tmp_name']);
            if ($upload > 0) {
               $success[] = "Información del Slider cargada exitosamente!";
            } else {
               $errors[] = "Error al registrar el item del slider";
            }
            
         } else {
            $errors[] = "El formato del archivo no es valido";
         }
         
      }

   // acciones del formulario de registro de eventos
      if (isset($_POST['btn-reventos'])) {
         $titulo = $_POST['txt-Etitulo'];
         $descripcion = $_POST['txt-Edescripcion'];
         $file = $_FILES['txt-Efile'];
         $fecha = $_POST['txt-Efecha'];
         if ($file['type'] == "image/jpg" || $file['type'] == "image/jpeg" || $file['type'] == "image/png" || $file['type'] == "image/gif") {
            switch ($file['type']) {
               case 'image/jpg':
                  $tipo = "jpg";
                  break;
               case 'image/jpeg':
                  $tipo = "jpeg";
                  break;
               case 'image/png':
                  $tipo = "png";
                  break;
               case 'image/gif':
                  $tipo = "gif";
                  break;
            }

            if (!is_dir('./../img/events')) {
               mkdir('./../img/events', 0777);
            }
            $upload = registraEvent($titulo, $descripcion, $file['tmp_name'], $tipo, $fecha);
            if ($upload > 0) {
               $success[] = "Información del evento cargada exitosamente!";
            } else {
               $errors[] = "Error al registrar el evento";
            }

         } else {
            $errors[] = "El formato del archivo no es valido";
         }

      }
      
   // acciones del formulario de registro de convocatorias
      if (isset($_POST['btn-rconvocatoria'])) {
         $titulo = $_POST['txt-Ctitulo'];
         $descripcion = $_POST['txt-Cdescripcion'];
         $image = $_FILES['txt-Cimage'];
         $file = $_FILES['txt-Cfile'];
         $fecha = $_POST['txt-Cfecha'];
         if ($image['type'] == "image/jpg" || $image['type'] == "image/jpeg" || $image['type'] == "image/png" || $image['type'] == "image/gif") {
            switch ($image['type']) {
               case 'image/jpg':
                  $tipo = "jpg";
                  break;
               case 'image/jpeg':
                  $tipo = "jpeg";
                  break;
               case 'image/png':
                  $tipo = "png";
                  break;
               case 'image/gif':
                  $tipo = "gif";
                  break;
            }
            if ($file['type'] == "application/pdf") {
               if (!is_dir('./../img/announce')) {
                  mkdir('./../img/announce', 0777);
               }
               $upload = registraAnnounce($titulo, $descripcion, $fecha, $image['tmp_name'], $file['tmp_name'], $tipo);
               if ($upload > 0) {
                  $success[] = "Convocatoria cargada exitosamente!";
               } else {
                  $errors[] = "Error al registrar la Convocatoria";
               }
            } else {
               $errors[] = "El formato del archivo no es valido";
            }
         } else {
            $errors[] = "El formato de imagen no es valido";
         }
      }
?>
<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="./../css/bootstrap.css">
   <link rel="stylesheet" href="./../css/style.css">
   <link rel="stylesheet" href="./../css/styles.css">
   <link rel="shortcut icon" href="./../img/body-content/logo.ico" type="image/x-icon">
   <title>Dashboard</title>
</head>

<body>
   <div class="container-fluid">
      <div class="row">
         <div class="barra-lateral col-12 col-sm-auto">
            <div class="logo-d">
               <?php 
               if (isset($_SESSION["id_usuario"])) {
                  echo "<h2><span class='icon-user mr-2'></span>" . $_SESSION['log_name'] . "</h2>";
               }
               ?>
            </div>
            <nav class="menu d-flex d-sm-block justify-content-center flex-wrap sticky-top">
               <a href="dashboard-consulta.php" class="" id="consulta"><i class="icon-books"></i><span>Consultas</span></a>
               <a href="dashboard-registro.php" class="" id="registro"><i class="icon-file-text"></i><span>Registros</span></a>
               <a href="logout.php" class="mb-3"><i class="icon-exit"></i><span>Cerrar sesión</span></a>
               <?php echo resultBlocks($errors) ?>
               <?php echo resultSuccess($success) ?>
            </nav>
         </div>

         <main class="main col">
            <div class="row">
               <div class="columna col-12">
                  <div class="widget">
                     <p class="display-4 text-center">Registros</p>
                     <div class="col">
                        <ul class="nav nav-tabs mt-5 d-flex flex-wrap">
                        <?php if ($_SESSION['tipo_usuario'] == 1):?>
                           <li class="nav-item">
                              <a href="#tabUser" class="nav-link active" data-toggle="tab">Usuarios <i class="icon-user-plus"></i></a>
                           </li>
                        <?php endif;?>
                           <li class="nav-item">
                              <a href="#tabSlider" class="nav-link" data-toggle="tab">Slider <i class="icon-image"></i></a>
                           </li>
                           <li class="nav-item">
                              <a href="#tabEvents" class="nav-link" data-toggle="tab">Eventos <i class="icon-ticket"></i></a>
                           </li>
                           <li class="nav-item">
										<a href="#tabConvocatoria" class="nav-link" data-toggle="tab">Convocatorias <i class="icon-file-text"></i></a>
									</li>
                        </ul>
                        <div class="tab-content">
                           <!-- formulario de registro de usuarios -->
                           <?php if ($_SESSION['tipo_usuario'] == 1) : ?>
                              <div class="tab-pane active" id="tabUser" role="tabpanel">
                                 <form class="mt-3 needs-validation" method="post" action="<?php $_SERVER['PHP_SELF'] ?>"
                                    novalidate>
                                    <div class="card-header bg-primary text-white">
                                       <h3 class="modal-title"><i class="icon-user-plus"></i>  Registro de usuarios</h3>
                                    </div>
                                    <div class="modal-body">
                                       <div class="row mt-2">
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="nombre">Nombre(s)</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text form-control-sm icon-user-tie" id="inputGroupPrepend"></span>
                                                   </div>
                                                   <input type="text" class="form-control form-control-sm" id="nombre" name="txt-nombre"
                                                      placeholder="Nombre(s)" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                      required>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="paterno">Paterno</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text form-control-sm icon-user-tie" id="inputGroupPrepend"></span>
                                                   </div>
                                                   <input type="text" class="form-control form-control-sm" id="paterno" name="txt-paterno"
                                                      placeholder="Apellido paterno" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                      required>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="materno">Materno</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text form-control-sm icon-user-tie" id="inputGroupPrepend"></span>
                                                   </div>
                                                   <input type="text" class="form-control form-control-sm" id="materno" name="txt-materno"
                                                      placeholder="Apellido materno" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                      required>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="usario">Usuario</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text form-control-sm icon-user" id="inputGroupPrepend"></span>
                                                   </div>
                                                   <input type="text" class="form-control form-control-sm" id="usario" name="txt-usuario"
                                                      placeholder="Usuario" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                      required>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="pass">Contraseña</label>
                                                <div class="input-group">
                                                   <div class="input-group-prepend">
                                                      <span class="input-group-text form-control-sm icon-key2" id="inputGroupPrepend"></span>
                                                   </div>
                                                   <input type="text" class="form-control form-control-sm" id="pass" name="txt-password"
                                                      placeholder="Contraseña" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                      required>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="col-12 col-md-6">
                                             <div class="form-group">
                                                <label for="tipo">Tipo de usuario</label>
                                                <select id="tipo" class="custom-select" name="txt-tipo">
                                                   <option value="1">Administrador</option>
                                                   <option value="2">CDC</option>
                                                </select>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="form-group d-flex justify-content-end">
                                          <button type="submit" name="btn_rusuario" class="btn btn-outline-success rounded-pill">Registrar
                                             <i class="ml-3 icon-send"></i></button>
                                       </div>
                                    </div>
                                 </form>
                              </div>
                           <?php endif;?>
                           <!-- formulario de registro de nuevos items del slider -->
                           <?php if ($_SESSION['tipo_usuario'] == 2) : ?>
                           <div class="tab-pane text-justify active" id="tabSlider" role="tabpanel">
                           <?php else: ?>
                           <div class="tab-pane text-justify" id="tabSlider" role="tabpanel">
                           <?php endif; ?>
                              <form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
                                 novalidate>
                                 <div class="card-header bg-primary text-white">
                                    <h3 class="modal-title"><i class="icon-image"></i>  Registro de items</h3>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row mt-2">
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="titulo">Titulo</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
                                                </div>
                                                <input type="text" class="form-control" id="titulo" name="txt-titulo"
                                                   placeholder="Titulo" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                   required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="imagen">Imagen</label>
                                             <div class="input-group">
                                                <input type="file" class="custom-file-input" name="txt-file" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Elegir imagen</label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="form-group">
                                             <label>Descripción</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-paragraph-justify"></span>
                                                </div>
                                                <textarea class="form-control" aria-label="With textarea" name="txt-descripcion" required></textarea>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                       <button type="submit" name="btn-rslider" class="btn btn-outline-success rounded-pill">Registrar
                                          <i class="ml-3 icon-send"></i></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <!-- formulario de registro de nuevos eventos -->
                           <div class="tab-pane text-justify" id="tabEvents" role="tabpanel">
                              <form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
                                 novalidate>
                                 <div class="card-header bg-primary text-white">
                                    <h3 class="modal-title"><i class="icon-ticket"></i>  Registro de eventos</h3>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row mt-2">
                                       <div class="col-12 col-md-4">
                                          <div class="form-group">
                                             <label for="titulo">Titulo</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
                                                </div>
                                                <input type="text" class="form-control" id="titulo" name="txt-Etitulo"
                                                   placeholder="Titulo" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                   required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-4">
                                          <div class="form-group">
                                             <label for="fecha">Fecha de realización</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-calendar" id="my-addon"></span>
                                                </div>
                                                <input class="form-control" id="fecha" type="date" name="txt-Efecha" aria-describedby="my-addon" required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-4">
                                          <div class="form-group">
                                             <label for="imagen">Imagen</label>
                                             <div class="input-group">
                                                <input type="file" class="custom-file-input" name="txt-Efile" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Elegir imagen</label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="form-group">
                                             <label>Descripción</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-paragraph-justify"></span>
                                                </div>
                                                <textarea class="form-control" aria-label="With textarea" name="txt-Edescripcion" required></textarea>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                       <button type="submit" name="btn-reventos" class="btn btn-outline-success rounded-pill">Registrar
                                          <i class="ml-3 icon-send"></i></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                           <!-- formulario de registro de nuevas convocatorias -->
                           <div class="tab-pane text-justify" id="tabConvocatoria" role="tabpanel">
                              <form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
                                 novalidate>
                                 <div class="card-header bg-primary text-white">
                                    <h3 class="modal-title"><i class="icon-file-text"></i>  Registro de convocatorias</h3>
                                 </div>
                                 <div class="modal-body">
                                    <div class="row mt-2">
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="titulo">Titulo</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
                                                </div>
                                                <input type="text" class="form-control" id="titulo" name="txt-Ctitulo"
                                                   placeholder="Titulo" autocomplete="off" aria-describedby="inputGroupPrepend"
                                                   required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="fecha">Fecha límite</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-calendar" id="my-addon"></span>
                                                </div>
                                                <input class="form-control" id="fecha" type="date" name="txt-Cfecha" aria-describedby="my-addon" required>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="imagen">Imagen</label>
                                             <div class="input-group">
                                                <input type="file" class="custom-file-input" name="txt-Cimage" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Elegir imagen</label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12 col-md-6">
                                          <div class="form-group">
                                             <label for="imagen">Archivo PDF</label>
                                             <div class="input-group">
                                                <input type="file" accept="application/pdf" class="custom-file-input" name="txt-Cfile" id="customFile" required>
                                                <label class="custom-file-label" for="customFile">Elegir archivo</label>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-12">
                                          <div class="form-group">
                                             <label>Descripción</label>
                                             <div class="input-group">
                                                <div class="input-group-prepend">
                                                   <span class="input-group-text icon-paragraph-justify"></span>
                                                </div>
                                                <textarea class="form-control" aria-label="With textarea" name="txt-Cdescripcion" required></textarea>
                                                </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="form-group d-flex justify-content-end">
                                       <button type="submit" name="btn-rconvocatoria" class="btn btn-outline-success rounded-pill">Registrar
                                          <i class="ml-3 icon-send"></i></button>
                                    </div>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </main>
      </div>
   </div>
   <script src="./../js/jquery-3.3.1.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
   <script src="./../js/bootstrap.js"></script>
   <script src="./../js/function.js"></script>
   <script type="text/javascript">
      $('.menu').children('.active').removeClass('active');
      $("#registro").addClass('active');
      bsCustomFileInput.init(".custom-file-input");
   </script>
</body>

</html>