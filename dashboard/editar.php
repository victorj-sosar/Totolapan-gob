<?php
require './../conexion.php';
$id = $_POST['id'];
$table = $_POST['table'];
global $mysqli;
if ($table == "usuarios") {
   $stmt = $mysqli->prepare("SELECT user, tipo FROM usuarios WHERE id=?");
   $stmt->bind_param('i', $id);
   $stmt->execute();
   $stmt->bind_result($user, $tipo);
   $stmt->fetch();
   header('Content-Type: application/json');
   $datos = array(
      'id' => $id,
      'user' => $user,
      'tipo' => $tipo
   );
   echo json_encode($datos, JSON_FORCE_OBJECT);
}
if ($table == "eventos") {
   $stmt = $mysqli->prepare("SELECT titulo, contenido, imagen, fecha FROM eventos WHERE id=?");
   $stmt->bind_param('i', $id);
   $stmt->execute();
   $stmt->bind_result($titulo, $descripcion, $imagen, $fecha);
   $stmt->fetch();
   header('Content-Type: application/json');
   $datos = array(
      'id' => $id,
      'titulo' => $titulo,
      'descripcion' => $descripcion,
      'imagen' => $imagen,
      'fecha' => $fecha
   );
   echo json_encode($datos, JSON_FORCE_OBJECT);
}
if ($table == "slider") {
   $stmt = $mysqli->prepare("SELECT imagen, titulo, descripcion FROM slider WHERE id=?");
   $stmt->bind_param('i', $id);
   $stmt->execute();
   $stmt->bind_result($imagen, $titulo, $descripcion);
   $stmt->fetch();
   header('Content-Type: application/json');
   $datos = array(
      'id' => $id,
      'titulo' => $titulo,
      'descripcion' => $descripcion,
      'imagen' => $imagen
   );
   echo json_encode($datos, JSON_FORCE_OBJECT);
}
if ($table == "convocatorias") {
   $stmt = $mysqli->prepare("SELECT titulo, descripcion, imagen, fecha, archivo FROM convocatorias WHERE id=?");
   $stmt->bind_param('i', $id);
   $stmt->execute();
   $stmt->bind_result($titulo, $descripcion, $imagen, $fecha, $archivo);
   $stmt->fetch();
   header('Content-Type: application/json');
   $datos = array(
      'id' => $id,
      'titulo' => $titulo,
      'descripcion' => $descripcion,
      'archivo' => $archivo,
      'imagen' => $imagen,
      'fecha' => $fecha
   );
   echo json_encode($datos, JSON_FORCE_OBJECT);
}