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

try {
  // si es 1 ya el token se verifico
  if ($user->checkBooleanCheckedCode()) {
    #redirecciona a la pagina de cambio de contraseña

    #inicia sesion y guarda el true
    session_start();
    $_SESSION['changePassword'] = true;

    $user->redirect("'../../views/changePassword.php?email='.$email.'");
  } else {
    $user->redirect("'../../index.php'");
  }
} catch (\Throwable $e) {
  echo $e->getMessage();
}
// =============================================================


?>