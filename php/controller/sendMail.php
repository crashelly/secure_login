<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");

include "../../db.php";
include "../class/user.php";



function generarCodigoAleatorio()
{
  $codigo = rand(1000, 9999);
  return $codigo;
}
try {
  $codeToken = generarCodigoAleatorio();
  
  // $to ='yamori2708@gmail.com' ;
  // $to = 'colchondeSpam@gmail.com';
  $to = $_POST['email'];
  
  $user = new ProgramUser($pdo, $to);

  // guarda el codigo en la base de datos
  $query = $pdo->prepare("UPDATE usuarios SET verificationCode = :tokenCode WHERE email = :email");

  $query->execute([
    ':tokenCode' => $codeToken,
    ':email' => $to
  ]);

// =========================  SEND THE EMAIL ======================

//  ========================= FINAL OF THE SEND OF THE EMAIL =============
// }

//  echo $codeToken;
  // redirije a la pagina donde checkea  el codigo
  $user->redirect("../../views/codeVerification.php?email=$to");
} catch (\Throwable $e) {
  echo $e->getMessage();
}
// =============================================================


?>