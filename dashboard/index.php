<?php
   require './../conexion.php';
   include './../funciones.php';
   session_start();
   $errores = array();
	if (isset($_POST['enviar'])) {
		$user = $mysqli->real_escape_string($_POST['user']);
		$pass = $mysqli->real_escape_string($_POST['pass']);
		$errores[] = login($user, $pass);
	}
	//Comprobacion de sesión abierta
	if(isset($_SESSION["log_name"])){ //Si no ha iniciado sesión redirecciona a index.php
		header("Location: dashboard-consulta.php");
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
   <title>Login</title>
</head>

<body>
   <div class="container-fluid bg-login pt-2">
      <div class="container h-100">
         <?php echo resultBlocks($errores); ?>
         <div class="row h-100 d-flex justify-content-center align-items-center">
            <div class="col-12 col-md-4">
               <form class="card bg-dark-transparent border-transparent needs-validation" method="post" action="<?php $_SERVER['PHP_SELF'] ?>"
                  novalidate>
                  <div class="card-header text-white border-transparent">
                     <h3 class="modal-title text-center">Login <i class="icon-user-check"></i></h3>
                  </div>
                  <div class="card-body">
                  <div class="row">
                     <div class="col-12 d-flex justify-content-center"><a href="./../"><img class="logo-contact" src="./../img/body-content/bg-footer.png" alt=""></a></div>
                  </div>
                     <div class="row mt-2">
                        <div class="col-12">
                           <div class="form-group">
                              <label for="user" class="text-white-50">Usuario</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text form-control-sm icon-user" id="inputGroupPrepend"></span>
                                 </div>
                                 <input type="text" class="form-control form-control-sm" id="user" name="user"
                                    placeholder="Usuario" autocomplete="off" aria-describedby="inputGroupPrepend"
                                    required>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-12">
                           <div class="form-group">
                              <label for="pass" class="text-white-50">Contraseña</label>
                              <div class="input-group">
                                 <div class="input-group-prepend">
                                    <span class="input-group-text form-control-sm icon-lock" id="inputGroupPrepend"></span>
                                 </div>
                                 <input type="password" class="form-control form-control-sm" id="pass" name="pass"
                                    placeholder="Contraseña" autocomplete="off" aria-describedby="inputGroupPrepend"
                                    required>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="form-group d-flex justify-content-end mt-2">
                        <button type="submit" name="enviar" class="btn btn-block btn-outline-success rounded-pill">Iniciar
                           <i class="ml-3 icon-enter"></i></button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <script src="./../js/jquery-3.3.1.js"></script>
   <script src="./../js/bootstrap.js"></script>
   <script src="./../js/function.js"></script>
</body>

</html>