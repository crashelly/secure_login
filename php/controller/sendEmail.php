<?php 
// funcion que genera el codigo
function generarCodigoAleatorio() {
  $codigo = rand(1000, 9999);
  return $codigo;
}

// parametros para enviar el email
// la persona a la que deseamos enviar el correo
$email =$_POST["email"] ;
$to =$email ;

// asunto
$subject = "Password Update Request";
// contenido
$mailContent = "'Estimado/a '.$userDetails['first_name'].', Recientemente se envió una solicitud para restablecer la contraseña de su cuenta. Si esto fue un error, simplemente ignore este correo electrónico y nada sucederá. Para restablecer su contraseña, visite el siguiente enlace: '.$resetPassLink.' Atentamente'";

// cabeceras
//set content-type header for sending HTML email
$headers = "MIME-Version: 1.0" . "rn";
$headers .= "Content-type:text/html;charset=UTF-8" . "rn";
//additional headers
$headers .= 'From: Tu<[email protected]>' . "rn";

// genera el codigo de verificacion
$code = generarCodigoAleatorio();

echo $code;
//enviar el gmail
  mail($to,$subject,$mailContent,$headers);

include "../../db.php";

$codeToken = $pdo->prepare("INSERT INTO usuarios (verificationCode) WHERE  OR email = :email");
$query->bindParam(':username', $username, PDO::PARAM_STR);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->execute();


?>