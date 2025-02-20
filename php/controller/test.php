<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");

$resetLink = "192.168.28.194/logins/changePassword.php";


function generarCodigoAleatorio()
{
  $codigo = rand(1000, 9999);
  return $codigo;
}
try {
  $codeToken = generarCodigoAleatorio();

  echo $codeToken;
  // $to ='yamori2708@gmail.com' ;
  $to = 'sofi@gmail.com';


  include "../../db.php";
  // guarda el codigo en la base de datos
  $query = $pdo->prepare("UPDATE usuarios SET verificationCode = :tokenCode WHERE email = :email");  $var  = 9999;
  // binds the parameters for security
  // $query->bindParam(':token',$var, PDO::PARAM_INT);
  // $query->bindParam(':email', $to, PDO::PARAM_STR);
  

  $query->execute(array(
    ':tokenCode'=> $codeToken,
    ':email' => $to
  ));

  // redirije a la pagina donde checkea  el codigo
  header("Location :../../views/codeVerification.php ");
} catch (\Throwable $e) {
  echo $e->getMessage();
}
// =============================================================


?>