<?php


try {
    $name = "yisus";
    $asunto = "importa";
    $msg = "quele";
    $email = "colchondespam@gmail.com";
    $header = "From: noreply@example.com". "\r\n";
    $header.= "Reply-To: noreply@example.com". "\r\n";
    $header.="X-Mailer: PHP/". phpversion(); 
    $mail = mail($email,$asunto,$msg,$header);
} catch (\Throwable $th) {
    echo $th->getMessage();
    throw $th;
}
      
    

?>