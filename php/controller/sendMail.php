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
try {
  $name = "usuario";
  $asunto = "Recuperacion de contraseña";
  $msg = "Recientemente se envio una solicitud para restablecer la contraseña de su cuenta. Si esto fue un error, simplemente ignore este correo electronico . Para restablecer su contraseña, pegue el siguiente codido de verificacion: $codeToken en la pagina web que esta en su navegador Atentamente recuperacion@sena.net";
  // $email = "colchondespam@gmail.com";
  $email = $to;
  $header = "From: noreply@example.com". "\r\n";
  $header.= "Reply-To: noreply@example.com". "\r\n";
  $header.="X-Mailer: PHP/". phpversion(); 
  $mail = mail($email,$asunto,$msg,$header);
} catch (\Throwable $th) {
  echo $th->getMessage();
  throw $th;
}


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