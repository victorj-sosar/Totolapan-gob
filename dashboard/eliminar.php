<?php
require './../conexion.php';
$id = $_POST['id'];
$table = $_POST['table'];
global $mysqli;
if ($table=="usuarios") {
   $stmt = $mysqli->prepare("UPDATE usuarios SET estatus=2 WHERE id=?");
   $stmt->bind_param('i', $id);
}
if ($table == "eventos") {
   $stmt = $mysqli->prepare("UPDATE eventos SET estatus=2 WHERE id=?");
   $stmt->bind_param('i', $id);
}
if ($table == "slider") {
   $stmt = $mysqli->prepare("UPDATE slider SET estatus=2 WHERE id=?");
   $stmt->bind_param('i', $id);
}
if ($table == "convocatorias") {
   $stmt = $mysqli->prepare("UPDATE convocatorias SET estatus=2 WHERE id=?");
   $stmt->bind_param('i', $id);
}
if ($stmt->execute()) {
   echo "<div class='alert alert-success alert-dismissible text-center fade show position-absolute' role='alert'> Elemento eliminado exitosamente </div>";
} else {
   echo 'Error al eliminar el elemento';
}