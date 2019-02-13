<?php
   // -----------------------MENSAJES DE ALERTA----------------------
      // muestra las alertas de errores
         function resultBlocks($erros) {
            if (count($erros) > 0) {
               foreach ($erros as $error) {
                  echo "<div class='alert alert-danger alert-dismissible text-center fade show position-absolute' role='alert'> $error </div>";
               }
            }
         }
      // muestra las alertas de operaciones exitosas
         function resultSuccess($success) {
            if (count($success) > 0) {
               foreach ($success as $alert) {
                  echo "<div class='alert alert-success alert-dismissible text-center fade show position-absolute' role='alert'> $alert </div>";
               }
            }
         }
   // ---------------------------------------------------------------


   // ---------------lOGIN DE USUARIOS ADMINISTRADORES---------------
      function login($usuario, $password) {
         global $mysqli;
         $stmt = $mysqli->prepare("SELECT id, tipo, pass, nombres FROM usuarios WHERE user = ? LIMIT 1");
         $stmt->bind_param("s", $usuario);
         $stmt->execute();
         $stmt->store_result();
         $rows = $stmt->num_rows;
         if ($rows > 0) {
               $stmt->bind_result($id, $tipo, $pass, $log_name);
               $stmt->fetch();
               $validaPassw = password_verify($password, $pass);
               if ($validaPassw) {
                  $_SESSION['id_usuario'] = $id;
                  $_SESSION['tipo_usuario'] = $tipo;
                  $_SESSION['log_name'] = $log_name;
                  header("location: ./index.php");
               } else {

                  $erros = "La contraseña es incorrecta";
               }
         } else {
            $erros = "El nombre de usuario no existe";
         }
         return $erros;
      }
   // ---------------------------------------------------------------


   // -----------REGISTRO DE NUEVOS ELEMENTOS DEL SISTEMA------------
      // ******REGISTRO DE USUARIOS*******
         //hashea la contraseña para evitar ser observada
            function hashPassword($password) {
               $hash = password_hash($password, PASSWORD_DEFAULT);
               return $hash;
            }
         // Registra nuevos usuarios como administradores
            function registraUsuario($nombres, $paterno, $materno, $usuario, $pass_hash, $tipo_usuario) {
               global $mysqli;
               $estatus = 1;
               $stmt = $mysqli->prepare("INSERT INTO usuarios (nombres, paterno, materno, user, pass, tipo, estatus) VALUES(?,?,?,?,?,?,?)");
               $stmt->bind_param('sssssii', $nombres, $paterno, $materno, $usuario, $pass_hash, $tipo_usuario, $estatus);

               if($stmt->execute()){
                  return 1;
               }else{
                  return 0;
               }
            }
      // *********************************

      // *******REGISTRO DE SLIDER********
         function registraItemSlider($tipo, $titulo, $descripcion, $temp) {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT * FROM slider");
            $stmt->execute();
            $stmt->store_result();
            $item = ($stmt->num_rows + 1);
            $estatus = 1;
            $imagen = "slider_" . $item . "." . $tipo;
            move_uploaded_file($temp, './../img/slider/' . $imagen);
            $stmt = $mysqli->prepare("INSERT INTO slider (imagen, titulo, descripcion, estatus) VALUES(?,?,?,?)");
            $stmt->bind_param('sssi', $imagen, $titulo, $descripcion, $estatus);

            if ($stmt->execute()) {
               return 1;
            } else {
               return 0;
            }
         }
      // *********************************
         
      // *******REGISTRO DE EVENTOS*******
         function registraEvent($titulo, $descripcion, $temp, $tipo, $fecha) {
               global $mysqli;
               $estatus = 1;
               $stmt = $mysqli->prepare("SELECT * FROM eventos");
               $stmt->execute();
               $stmt->store_result();
               $item = ($stmt->num_rows + 1);
               $imagen = "evento_" . $item . "." . $tipo;
               move_uploaded_file($temp, './../img/events/' . $imagen);
               $stmt = $mysqli->prepare("INSERT INTO eventos (titulo, contenido, imagen, fecha, estatus) VALUES(?,?,?,?,?)");
               $stmt->bind_param('ssssi', $titulo, $descripcion, $imagen, $fecha, $estatus);

               if ($stmt->execute()) {
                  return 1;
               } else {
                  return 0;
               }
         }
      // *********************************

      // ****REGISTRO DE CONVOCATORIAS****
         function registraAnnounce($titulo, $descripcion, $fecha, $image, $file, $tipo) {
               global $mysqli;
               $stmt = $mysqli->prepare("SELECT * FROM convocatorias");
               $stmt->execute();
               $stmt->store_result();
               $estatus = 1;
               $item = ($stmt->num_rows + 1);
               $imagen = "convocatoria_" . $item . "." . $tipo;
               move_uploaded_file($image, './../img/announce/' . $imagen);
               $archivo = "convocatoria_" . $item . ".pdf";
               move_uploaded_file($file, './../docs/' . $archivo);
               $stmt = $mysqli->prepare("INSERT INTO convocatorias (titulo, descripcion, fecha, imagen, archivo, estatus) VALUES(?,?,?,?,?.?)");
               $stmt->bind_param('sssssi', $titulo, $descripcion, $fecha, $imagen, $archivo, $estatus);
               if ($stmt->execute()) {
                  return 1;
               } else {
                  return 0;
               }
         }
      // *********************************
   // ---------------------------------------------------------------


   // ------------ACTUALIZACIÓN DEL CONTENIDO DEL SISTEMA------------
      // ******ACTUALIZACIÓN DE USUARIOS*******
         function actualizaUser($id, $user, $pass, $tipo) {
            global $mysqli;
            if ($pass != '') {
               $stmt = $mysqli->prepare("UPDATE usuarios SET user=?, pass=?, tipo=? WHERE id=?");
               $stmt->bind_param('ssii', $user, $pass, $tipo, $id);
            } else {
               $stmt = $mysqli->prepare("UPDATE usuarios SET user=?, tipo=? WHERE id=?");
               $stmt->bind_param('sii', $user, $tipo, $id);
            }
            if ($stmt->execute()) {
               return 1;
            } else {
               return 0;
            }
         }
      // *************************************   
   
      // ******ACTUALIZACIÓN DEL SLIDER*******
         function actualizaSlider($id, $titulo, $descripcion, $temp, $tipo) {
            global $mysqli;
            if ($temp == '' && $tipo == '') {
               $stmt = $mysqli->prepare("UPDATE slider SET titulo=?, descripcion=? WHERE id=?");
               $stmt->bind_param('ssi', $titulo, $descripcion, $id);
            } else {
               $imagen = "slider_" . $id . "." . $tipo;
               move_uploaded_file($temp, './../img/slider/' . $imagen);
               $stmt = $mysqli->prepare("UPDATE slider SET titulo=?, descripcion=?, imagen=? WHERE id=?");
               $stmt->bind_param('sssi', $titulo, $descripcion,$imagen, $id);
            }
            if ($stmt->execute()) {
               return 1;
            } else {
               return 0;
            }
         }
      // *************************************

      // ******ACTUALIZACIÓN DE EVENTOS*******
         function actualizaEvents($id, $titulo, $descripcion, $fecha, $temp, $tipo) {
            global $mysqli;
            if ($temp == '' && $tipo == '') {
               $stmt = $mysqli->prepare("UPDATE eventos SET titulo=?, contenido=?, fecha=? WHERE id=?");
               $stmt->bind_param('sssi', $titulo, $descripcion, $fecha, $id);
            } else {
               $imagen = "evento_" . $id . "." . $tipo;
               move_uploaded_file($temp, './../img/events/' . $imagen);
               $stmt = $mysqli->prepare("UPDATE eventos SET titulo=?, contenido=?, imagen=?, fecha=? WHERE id=?");
               $stmt->bind_param('ssssi', $titulo, $descripcion, $imagen, $fecha, $id);
            }
            if ($stmt->execute()) {
               return 1;
            } else {
               return 0;
            }
         }
      // *************************************

      // ******ACTUALIZACIÓN DE CATEGORIAS*******
         function actualizaAnnounce($id, $titulo, $descripcion, $fecha, $temp, $tipo, $file) {
            global $mysqli;
            if ($temp == '' && $tipo == '' && $file == '') {
               $stmt = $mysqli->prepare("UPDATE convocatorias SET titulo=?, descripcion=?, fecha=? WHERE id=?");
               $stmt->bind_param('sssi', $titulo, $descripcion, $fecha, $id);
            }
            if($temp != '' && $tipo != '' && $file == ''){
               $imagen = "convocatoria_".$id.".".$tipo;
               move_uploaded_file($temp, './../img/announce/'.$imagen);
               $stmt = $mysqli->prepare("UPDATE convocatorias SET titulo=?, descripcion=?, imagen=?, fecha=? WHERE id=?");
               $stmt->bind_param('ssssi', $titulo, $descripcion, $imagen, $fecha, $id);
            }
            if($temp != '' && $tipo != '' && $file != ''){
               $imagen = "convocatoria_".$id.".".$tipo;
               move_uploaded_file($temp, './../img/announce/'.$imagen);
               $archivo = "convocatoria_".$id.".pdf";
               move_uploaded_file($file, './../docs/'.$archivo);
               $stmt = $mysqli->prepare("UPDATE convocatorias SET titulo=?, descripcion=?, imagen=?, archivo=?, fecha=? WHERE id=?");
               $stmt->bind_param('sssssi', $titulo, $descripcion, $imagen, $archivo, $fecha, $id);
            }
            if($temp == '' && $tipo == '' && $file != ''){
               $archivo = "convocatoria_".$id.".pdf";
               move_uploaded_file($file, './../docs/'.$archivo);
               $stmt = $mysqli->prepare("UPDATE categorias SET titulo=?, descripcion=?, archivo=?, fecha=? WHERE id=?");
               $stmt->bind_param('ssssi', $titulo, $descripcion, $archivo, $fecha, $id);
            }
            if ($stmt->execute()) {
               return 1;
            } else {
               return 0;
            }
         }
      // *********************************
   // ---------------------------------------------------------------
         

   // --------------CONSULTA DE INFORMACIÓN DEL SISTEMA--------------
      // ******CONSULTA DE USUARIOS*******
         function consultaUsuarios() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT usuarios.id, usuarios.nombres, usuarios.paterno, usuarios.materno, usuarios.user, tipo_usuario.descripcion FROM usuarios INNER JOIN tipo_usuario ON usuarios.tipo = tipo_usuario.id WHERE usuarios.estatus=1");
            $stmt->execute();
            $stmt->store_result();
            $numUsuarios = $stmt->num_rows;
            echo "
               <div class='table-responsive mt-3' id='tab-user'>
                  <table class='table table-striped'>
                     <thead class='thead-dark'>
                        <tr>
                           <th class='text-center'>#</th>
                           <th class='text-center'>Nombre</th>
                           <th class='text-center'>Paterno</th>
                           <th class='text-center'>Materno</th>
                           <th class='text-center'>Usuario</th>
                           <th class='text-center'>Tipo</th>";
                           if ($_SESSION['tipo_usuario'] == 1) {
                              echo "<th class='text-center'></th>
                              <th class='text-center'></th>";
                           }
                           echo"</tr>
                     </thead>
                     <tbody>";
            for ($i = 0; $i < $numUsuarios; $i++) {
               $stmt->bind_result($id, $name, $patern, $matern, $usuario, $tipo);
               $stmt->fetch();
               echo "<tr>
                        <td class='text-center'>$id</td>
                        <td class='text-center'>$name</td>
                        <td class='text-center'>$patern</td>
                        <td class='text-center'>$matern</td>
                        <td class='text-center'>$usuario</td>
                        <td class='text-center'>$tipo</td>"; 
                        if ($_SESSION['tipo_usuario'] ==1){
                           echo "<td class='text-center' width='5%'><button class='delete icon-bin2 btn btn-outline-danger'>
                           <td class='text-center' width='5%'><button data-toggle='modal' data-target='#editUsers' class='edit icon-pencil2 btn btn-outline-primary'>";
                        }
                        echo "<input type='hidden' value='$id'><span class='d-none'>usuarios</span></button></td>
                     </tr>";
            }
            echo "</tbody>
                  </table>
               </div>";
         }
      // *********************************

      // ******CONSULTA DEL SLIDER********
         function ConsultaSlider() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT id, imagen, titulo, descripcion FROM slider WHERE estatus=1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            echo "
               <div class='table-responsive mt-3'>
                  <table class='table table-striped'>
                     <thead class='thead-dark'>
                        <tr>
                           <th class='text-center'>#</th>
                           <th class='text-center'>Titulo</th>
                           <th class='text-center'>Descripcion</th>
                           <th class='text-center'>Imágen</th>
                           <th class='text-center'></th>
                           <th class='text-center'></th>
                        </tr>
                     </thead>
                     <tbody>";
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($id, $imagen, $titulo, $descripcion);
               $stmt->fetch();
               echo "<tr>
                        <td class='text-center'>$id</td>
                        <td class='text-center' width='20%'>$titulo</td>
                        <td class='text-justify'>$descripcion</td>
                        <td class='text-center'><img src='./../img/slider/$imagen' class='d-block img-fluid' width='500px'></td>
                        <td class='text-center' width='5%'><button class='delete icon-bin2 btn btn-outline-danger'>
                        <input type='hidden' value='$id'><span class='d-none'>slider</span></button></td>
                        <td class='text-center' width='5%'><button data-toggle='modal' data-target='#editSlider' class='edit icon-pencil2 btn btn-outline-primary'>
                        <input type='hidden' value='$id'><span class='d-none'>slider</span></button></td>
                     </tr>";
            }
            echo "</tbody>
                  </table>
               </div>";
         }
      // *********************************

      // ******CONSULTA DE EVENTOS********
         function ConsultaEventos() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT id, titulo, contenido, imagen, fecha FROM eventos WHERE estatus=1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            echo "
               <div class='table-responsive mt-3'>
                  <table class='table table-striped'>
                     <thead class='thead-dark'>
                        <tr>
                           <th class='text-center'>#</th>
                           <th class='text-center'>Titulo</th>
                           <th class='text-center'>Contenido</th>
                           <th class='text-center'>Fecha</th>
                           <th class='text-center'>Imágen</th>
                           <th class='text-center'></th>
                           <th class='text-center'></th>
                        </tr>
                     </thead>
                     <tbody>";
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($id, $titulo, $descripcion, $imagen, $fecha);
               $stmt->fetch();
               echo "<tr>
                        <td scope='row' class='text-center'>$id</td>
                        <td class='text-center' width='20%'>$titulo</td>
                        <td class='text-justify'>$descripcion</td>
                        <td class='text-center' width='15%'>$fecha</td>
                        <td class='text-center' width='15%'><img src='./../img/events/$imagen' class='d-block img-fluid' width='500px'></td>
                        <td class='text-center' width='5%'><button class='delete icon-bin2 btn btn-outline-danger'>
                        <input type='hidden' value='$id'><span class='d-none'>eventos</span></button></td>
                        <td class='text-center' width='5%'><button data-toggle='modal' data-target='#editEvents' class='edit icon-pencil2 btn btn-outline-primary'>
                        <input type='hidden' value='$id'><span class='d-none'>eventos</span></button></td>
                     </tr>";
            }
            echo "</tbody>
                  </table>
               </div>";
         }
      // *********************************

      // ****CONSULTA DE CONVOCATORIAS****
         function ConsultaAnnounce() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT id, titulo, descripcion, fecha, archivo FROM convocatorias WHERE estatus=1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            echo "
               <div class='table-responsive mt-3'>
                  <table class='table table-striped'>
                     <thead class='thead-dark'>
                        <tr>
                           <th class='text-center'>#</th>
                           <th class='text-center'>Titulo</th>
                           <th class='text-center'>Descripción</th>
                           <th class='text-center'>Fecha</th>
                           <th class='text-center'>Archivo</th>
                           <th class='text-center'></th>
                           <th class='text-center'></th>
                        </tr>
                     </thead>
                     <tbody>";
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($id, $titulo, $descripcion, $fecha, $file);
               $stmt->fetch();
               echo "<tr>
                        <td scope='row' class='text-center'>$id</td>
                        <td class='text-center' width='20%'>$titulo</td>
                        <td class='text-justify'>$descripcion</td>
                        <td class='text-center' width='15%'>$fecha</td>
                        <td class='text-center'><a target='_blank' href='./../docs/$file' class='btn btn-outline-danger icon-file-pdf'></td>
                        <td class='text-center' width='5%'><button class='delete icon-bin2 btn btn-outline-danger'>
                        <input type='hidden' value='$id'><span class='d-none'>convocatorias</span></button></td>
                        <td class='text-center' width='5%'><button data-toggle='modal' data-target='#editAnnounce' class='edit icon-pencil2 btn btn-outline-primary'>
                        <input type='hidden' value='$id'><span class='d-none'>convocatorias</span></button></td>
                     </tr>";
            }
            echo "</tbody>
                  </table>
               </div>";
         }
      // *********************************

   // ---------------------------------------------------------------
   

   // -----------------LLENA EL CONTENIDO DEL SISTEMA----------------
      // ******LLENADO DEL SLIDER*********
         function ItemsSlider() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT imagen, titulo, descripcion FROM slider WHERE estatus=1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            echo "<ol class='carousel-indicators'>";
            for ($i = 0; $i < $numItems; $i++) {
               if ($i == 0) {
                  echo "<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
               } else {
                  echo "<li data-target='#carouselExampleIndicators' data-slide-to='$i'></li>";
               }
            }
            echo "</ol>
            <div class='carousel-inner'>";
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($imagen, $titulo, $descripcion);
               $stmt->fetch();
               if ($i == 0) {
                  echo "<div class='carousel-item active'>
                           <img src='./img/slider/$imagen' class='d-block img-fluid'>
                           <div class='carousel-caption d-none d-md-block information'>
                              <h3>$titulo</h3>
                              <p>$descripcion</p>
                           </div>
                        </div>";
               } else {
                  echo "<div class='carousel-item'>
                        <img src='./img/slider/$imagen' class='d-block img-fluid'>
                        <div class='carousel-caption d-none d-md-block information'>
                           <h3>$titulo</h3>
                           <p>$descripcion</p>
                        </div>
                     </div>";
               }
            }
            echo "</div>";
         }
      // *********************************

      // ******LLENADO DE EVENTOS*********
         function Eventos() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT titulo, contenido, imagen, fecha FROM eventos WHERE estatus=1 ORDER BY fecha ASC");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($titulo, $descripcion, $imagen, $fecha);
               $stmt->fetch();
               echo "<div class='col-12 col-md-6 mb-4'>
                        <div class='card bg-light text-secondary events'>
                           <img src='./img/events/$imagen' class='card-img-top'>
                           <div class='card-body'>
                              <h3 class='card-title text-primary text-center'>$titulo</h3>
                              <p class='card-text text-justify'>$descripcion</p>
                           </div>
                           <div class='card-footer'>
                              <p class='card-text text-right'>Fecha de realización: <strong>$fecha</strong></p>
                           </div>
                        </div>
                     </div>";
            }
         }
      // *********************************

      // ******LLENADO DE EVENTOS EN INDEX*********
         function EventosIndex() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT titulo, contenido, imagen, fecha FROM eventos WHERE estatus=1 ORDER BY fecha ASC LIMIT 1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($titulo, $descripcion, $imagen, $fecha);
               $stmt->fetch();
               echo "<div class='col-12 col-md-6'>
                        <a href='./eventos.php' style='text-decoration: none;'>
                           <div class='card text-dark events'>
                              <div class='card-body'>
                                 <h3 class='card-title'>Eventos <i class='icon icon-feed'></i></h3>
                                 <hr>
                                 <h5 class='card-text'>$titulo</h5>
                                 <p class='card-text'>$descripcion</p>
                              </div>
                              <div class='card-footer bg-transparent'>
                                 <p class='card-text text-right'><small class='text-muted'>Fecha: $fecha</small></p>
                              </div>
                              <img src='./img/events/$imagen' class='card-img-top'>
                           </div>
                        </a>
                     </div>";
            }
         }
      // *********************************

      // ****LLENADO DE CONVOCATORIAS*****
         function Announcement() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT titulo, descripcion, fecha, archivo, imagen FROM convocatorias WHERE estatus=1 ORDER BY fecha ASC");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($titulo, $descripcion, $fecha, $archivo, $imagen);
               $stmt->fetch();
               echo "<div class='col-12 col-md-4 mb-4'>
                        <a href='./docs/$archivo' target='_blank' style='text-decoration: none;'>
                           <div class='card text-secondary announce'>
                              <img class='card-img-top' src='./img/announce/$imagen'>
                              <div class='card-body'>
                                 <h5 class='card-title text-primary text-center'>$titulo</h5>
                                 <p class='card-text text-justify'>$descripcion</p>
                              </div>
                              <div class='card-footer'>
                                 <p class='card-text text-right'>Fecha límite: <strong>$fecha</strong></p>
                              </div>
                           </div>
                        </a>
                     </div>";
            }
         }
      // *********************************
      // ******LLENADO DE CONVOCATORIAS EN INDEX*********
         function ConvocatoriasIndex() {
            global $mysqli;
            $stmt = $mysqli->prepare("SELECT titulo, descripcion, fecha, imagen FROM convocatorias WHERE estatus=1 ORDER BY fecha ASC LIMIT 1");
            $stmt->execute();
            $stmt->store_result();
            $numItems = $stmt->num_rows;
            for ($i = 0; $i < $numItems; $i++) {
               $stmt->bind_result($titulo, $descripcion, $fecha, $imagen);
               $stmt->fetch();
               echo "<div class='col-12 col-md-6 mt-sm-4 mt-md-0'>
                        <a href='./convocatorias.php' style='text-decoration: none;'>
                           <div class='card text-dark events'>
                              <div class='card-body'>
                                 <h3 class='card-title'>Convocatorias <i class='icon icon-info'></i></h3>
                                 <hr>
                                 <h5 class='card-text'>$titulo</h5>
                                 <p class='card-text'>$descripcion</p>
                              </div>
                              <div class='card-footer bg-transparent'>
                                 <p class='card-text text-right'><small class='text-muted'>Fecha: $fecha</small></p>
                              </div>
                              <img src='./img/announce/$imagen' class='card-img-top'>
                           </div>
                        </a>
                     </div>";
            }
         }
      // *********************************
   // ---------------------------------------------------------------
?>