<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");


include "../../db.php";
include "../class/user.php";

$email = $_POST['email'];
$password = $_POST['password'];


// creacion del objeto usuarios
$user = new ProgramUser($pdo, $email);
#si envio los datos del formulario
if (isset($_POST['email']) && isset($_POST['password'])) {
  try {
    // si es 1 ya el token se verifico
    if ($user->checkBooleanCheckedCode()) {
      $user->setPassword($password);
      $user->alerta("contraseña cambiada exitosamente");
      sleep(2);
      $user->redirect("../../index.php");

      exit();
  
    } else {
      $user->alerta("UPS...");
      $user->redirect("../../index.php");
      exit();
    }
  } catch (\Throwable $e) {
    echo $e->getMessage();
    exit();
  }
  
}else{
  $user->alerta("llene todos los campos");
  $user->redirect("'../../views/changePassword.php'");
  exit();
}

// =============================================================


?>