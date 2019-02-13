<?php
session_start();
require './../conexion.php';
include './../funciones.php';
$success = array();
$errors = array();
if (!isset($_SESSION["log_name"])) { //Si no ha iniciado sesión redirecciona a index.php
	header("Location: index.php");
}
if (isset($_POST['table'])) {
	$id = $_POST['id'];
	$table = $_POST['table'];
}
if (isset($_POST['btn-gusers'])) {
	$id = $_POST['txt-EUid'];
	$user = $_POST['txt-EUser'];
	$pass = $_POST['txt-EUpass'];
	$tipo = $_POST['txt-Utipo'];
	if ($pass != '') {
		$pass = hashPassword($pass);
	}
	$update = actualizaUser($id, $user, $pass, $tipo);
	if ($update > 0) {
		$success[] = "Información del usuario actualizada exitosamente!";
	} else {
		$errors[] = "Error al actualizar el usuario";
	}

}
if (isset($_POST['btn-gslider'])) {
	$id = $_POST['txt-ESid'];
	$titulo = $_POST['txt-EStitulo'];
	$descripcion = $_POST['txt-ESdescripcion'];
	if ($_FILES['txt-ESfile']['name'] != null) {
		$file = $_FILES['txt-ESfile'];
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
			$update = actualizaSlider($id, $titulo, $descripcion, $file['tmp_name'], $tipo);
			if ($update > 0) {
				$success[] = "Información del Slider actualizada exitosamente!";
			} else {
				$errors[] = "Error al actualizar el item del slider";
			}

		} else {
			$errors[] = "El formato del archivo no es valido";
		}
	} else {
		$update = actualizaSlider($id, $titulo, $descripcion, '', '');
		if ($update > 0) {
			$success[] = "Información del Slider actualizada exitosamente!";
		} else {
			$errors[] = "Error al actualizar el item del slider";
		}
	}	
}
if (isset($_POST['btn-gevents'])) {
	$id = $_POST['txt-EEid'];
	$titulo = $_POST['txt-EEtitulo'];
	$fecha = $_POST['txt-EEfecha'];
	$descripcion = $_POST['txt-EEdescripcion'];
	if ($_FILES['txt-EEfile']['name'] != null) {
		$file = $_FILES['txt-EEfile'];
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
			$update = actualizaEvents($id, $titulo, $descripcion, $fecha, $file['tmp_name'], $tipo);
			if ($update > 0) {
				$success[] = "Información del evento actualizada exitosamente!";
			} else {
				$errors[] = "Error al actualizar el evento";
			}
		} else {
			$errors[] = "El formato del archivo no es valido";
		}
	} else {
		$update = actualizaEvents($id, $titulo, $descripcion, $fecha, '', '');
		if ($update > 0) {
			$success[] = "Información del evento actualizada exitosamente!";
		} else {
			$errors[] = "Error al actualizar el evento";
		}
	}
}
if (isset($_POST['btn-gannounce'])) {
	$id = $_POST['txt-ECid'];
	$titulo = $_POST['txt-ECtitulo'];
	$fecha = $_POST['txt-ECfecha'];
	$descripcion = $_POST['txt-ECdescripcion'];
	$tipo = '';
	$imagen = '';
	$file ='';
	if ($_FILES['txt-ECimagen']['name'] != null) {
		$imagen = $_FILES['txt-ECimagen'];
		if ($imagen['type'] == "image/jpg" || $imagen['type'] == "image/jpeg" || $imagen['type'] == "image/png" || $imagen['type'] == "image/gif") {
			switch ($imagen['type']) {
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
			$imagen = $imagen['tmp_name'];
		} else {
			$errors[] = "El formato del archivo no es valido";
		}
	}
	if ($_FILES['txt-ECfile']['name'] != null) {
		$file = $_FILES['txt-ECfile'];
		if ($file['type'] == "application/pdf") {
			$file = $file['tmp_name'];
		}
	}
	$update = actualizaAnnounce($id, $titulo, $descripcion, $fecha, $imagen, $tipo, $file);
	if ($update > 0) {
		$success[] = "Información de la convocatoria actualizada exitosamente!";
	} else {
		$errors[] = "Error al actualizar convocatoria";
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
					<a href="logout.php"><i class="icon-exit"></i><span>Cerrar sesión</span></a>
					<div id="alertas"></div>
					<?php echo resultBlocks($errors) ?>
					<?php echo resultSuccess($success) ?>
				</nav>
			</div>

			<main class="main col">
				<div class="row contenido">
					<div class="columna col-12">
						<div class="widget">
							<p class="display-4 text-center">Consultas</p>
							<div class="col">
								<ul class="nav nav-tabs mt-5 d-flex flex-wrap">
									<li class="nav-item">
										<a href="#tabUser" class="nav-link active" data-toggle="tab">Usuarios <i class="icon-user"></i></a>
									</li>
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
									<div class="tab-pane active" id="tabUser" role="tabpanel">
										<?php echo consultaUsuarios(); ?>
									</div>
									<div class="tab-pane text-justify" id="tabSlider" role="tabpanel">
										<?php echo ConsultaSlider(); ?>
									</div>
									<div class="tab-pane text-justify" id="tabEvents" role="tabpanel">
										<?php echo ConsultaEventos(); ?>
									</div>
									<div class="tab-pane text-justify" id="tabConvocatoria" role="tabpanel">
										<?php echo ConsultaAnnounce(); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>
		</div>
		<!-- modal de edición de usuarios -->
		<div class="modal fade" id="editUsers" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h3 class="modal-title text-white" id="my-modal-title"><i class="icon-user mr-2"></i>Editar usuario</h3>
						<button class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="mt-3 needs-validation" method="post" action="<?php $_SERVER['PHP_SELF'] ?>"
						 novalidate>
							<div class="row mt-2">
								<div class="col-12">
									<input type="hidden" name="txt-EUid" id="Uid">
									<div class="form-group">
										<label for="Uuser">Usuario</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-user" id="inputGroupPrepend"></span>
											</div>
											<input type="text" class="form-control" id="Uuser" name="txt-EUser" placeholder="Usuario" autocomplete="off"
											 aria-describedby="inputGroupPrepend" required>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="Utipo">tipo de usuario</label>
										<select id="Utipo" class="custom-select" name="txt-Utipo">
											<option value="1">Administrador</option>
											<option value="2">CDC</option>
										</select>
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<label for="Upass">Nueva Contraseña</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-lock" id="my-addon"></span>
											</div>
											<input class="form-control" id="Upass" type="text" name="txt-EUpass" placeholder="Nueva contraseña" aria-describedby="my-addon">
										</div>
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" name="btn-gusers" class="btn btn-outline-success rounded-pill">Guardar
									<i class="ml-3 icon-send"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- modal de edición del slider -->
		<div class="modal fade" id="editSlider" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h3 class="modal-title text-white" id="my-modal-title"><i class="icon-image mr-2"></i>Editar item</h3>
						<button class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
						 novalidate>
							<div class="row mt-2">
								<div class="col-12">
									<input type="hidden" name="txt-ESid" id="Sid">
									<div class="form-group">
										<label for="Stitulo">Titulo</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
											</div>
											<input type="text" class="form-control" id="Stitulo" name="txt-EStitulo" placeholder="Titulo" autocomplete="off"
											 aria-describedby="inputGroupPrepend" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4 mb-4">
									<label for="SDimagen">Imágen actual</label>
									<img id="SDimagen" src="" class="img-fluid">
								</div>
								<div class="col-12 col-md-8">
									<div class="form-group">
										<label for="imagen">Imágen</label>
										<div class="input-group">
											<input type="file" class="custom-file-input" name="txt-ESfile" id="Simagen">
											<label class="custom-file-label" for="Simagen">Elegir imágen</label>
											<small id="passwordHelpBlock" class="form-text text-muted text-justify">* Seleccione un nuevo archivo solo
												sí desea cambiar la imágen del Slider</small>
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
											<textarea style="height: 150px;" class="form-control" id="Sdescripcion" aria-label="With textarea" name="txt-ESdescripcion"
											 required></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" name="btn-gslider" class="btn btn-outline-success rounded-pill">Guardar<i class="ml-3 icon-send"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- modal de edición de eventos -->
		<div class="modal fade" id="editEvents" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h3 class="modal-title text-white" id="my-modal-title"><i class="icon-ticket mr-2"></i>Editar evento</h3>
						<button class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
						 novalidate>
							<div class="row mt-2">
								<div class="col-12 col-md-6">
									<input type="hidden" name="txt-EEid" id="Evid">
									<div class="form-group">
										<label for="Evtitulo">Titulo</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
											</div>
											<input type="text" class="form-control" id="Evtitulo" name="txt-EEtitulo" placeholder="Titulo" autocomplete="off"
											 aria-describedby="inputGroupPrepend" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="Evfecha">Fecha de realización</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-calendar" id="my-addon"></span>
											</div>
											<input class="form-control" id="Evfecha" type="date" name="txt-EEfecha" aria-describedby="my-addon" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4 mb-4">
									<label for="SDimagen">Imágen actual</label>
									<img id="EDimagen" src="" class="img-fluid">
								</div>
								<div class="col-12 col-md-8">
									<div class="form-group">
										<label for="imagen">Imágen</label>
										<div class="input-group">
											<input type="file" class="custom-file-input" name="txt-EEfile" id="customFile">
											<label class="custom-file-label" for="customFile">Elegir imagen</label>
											<small id="passwordHelpBlock" class="form-text text-muted text-justify">* Seleccione un nuevo archivo solo
												sí desea cambiar la imágen del evento</small>
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
											<textarea style="height: 150px;" class="form-control" id="Evdescripcion" aria-label="With textarea" name="txt-EEdescripcion"
											 required></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" name="btn-gevents" class="btn btn-outline-success rounded-pill">Guardar
									<i class="ml-3 icon-send"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- modal de edición de Convocatorias -->
		<div class="modal fade" id="editAnnounce" tabindex="-1" role="dialog" aria-labelledby="my-modal-title" aria-hidden="true">
			<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header bg-success">
						<h3 class="modal-title text-white" id="my-modal-title"><i class="icon-file-text mr-2"></i>Editar convocatoria</h3>
						<button class="close text-white" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="mt-3 needs-validation" method="post" enctype="multipart/form-data" action="<?php $_SERVER['PHP_SELF'] ?>"
						 novalidate>
							<div class="row mt-2">
								<div class="col-12 col-md-8">
									<input type="hidden" name="txt-ECid" id="Cid">
									<div class="form-group">
										<label for="Ctitulo">Titulo</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-font-size" id="inputGroupPrepend"></span>
											</div>
											<input type="text" class="form-control" id="Ctitulo" name="txt-ECtitulo" placeholder="Titulo" autocomplete="off"
											 aria-describedby="inputGroupPrepend" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-4">
									<div class="form-group">
										<label for="Cfecha">Fecha de realización</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-calendar" id="my-addon"></span>
											</div>
											<input class="form-control" id="Cfecha" type="date" name="txt-ECfecha" aria-describedby="my-addon" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-3 mb-4">
									<label for="CDimagen">Imágen actual</label>
									<img id="CDimagen" src="" class="img-fluid">
								</div>
								<div class="col-12 col-md-9">
									<div class="form-group">
										<label for="imagen">Imágen</label>
										<div class="input-group">
											<input type="file" class="custom-file-input" name="txt-ECimagen" id="customFile">
											<label class="custom-file-label" for="customFile">Elegir imagen</label>
											<small id="passwordHelpBlock" class="form-text text-muted text-justify">* Seleccione un nuevo archivo solo
												sí desea cambiar la imágen del evento</small>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="CAfile">Archivo actual</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text icon-attachment" id="my-addon"></span>
											</div>
											<input class="form-control" id="Cfile" type="text" name="txt-ECAfile" aria-describedby="my-addon" required>
										</div>
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group">
										<label for="imagen">Archivo</label>
										<div class="input-group">
											<input type="file" accept="application/pdf" class="custom-file-input" name="txt-ECfile" id="customFile">
											<label class="custom-file-label" for="customFile">Elegir archivo</label>
											<small id="passwordHelpBlock" class="form-text text-muted text-justify">* Seleccione un nuevo archivo solo
												sí desea cambiar el documento de la convocatoria</small>
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
											<textarea style="height: 150px;" class="form-control" id="Cdescripcion" aria-label="With textarea" name="txt-ECdescripcion"
											 required></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group d-flex justify-content-end">
								<button type="submit" name="btn-gannounce" class="btn btn-outline-success rounded-pill">Guardar
									<i class="ml-3 icon-send"></i></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="./../js/jquery-3.3.1.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
	<script src="./../js/bootstrap.js"></script>
	<script src="./../js/function.js"></script>
	<script type="text/javascript">
		$('.menu').children('.active').removeClass('active');
		$("#consulta").addClass('active');
		bsCustomFileInput.init(".custom-file-input");
	</script>
</body>

</html>