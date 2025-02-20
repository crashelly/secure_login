<?php
if(isset($_POST['enviar'])){
    if(!empty($_POST['usuario']) && !empty($_POST['asunto']) && !empty($_POST['mensaje']) && !empty($_POST['email'])){
        $name = "yisus";
        $asunto = "importa";
        $msg = "quele";
        $email = "colchondespam@gmail.com";
        $header = "From: noreply@example.com". "\r\n";
        $header.= "Reply-To: noreply@example.com". "\r\n";
        $header.="X-Mailer: PHP/". phpversion(); 
        $mail = mail($email,$asunto,$msg,$header);
        if($mail){
            echo "<h4>Mail enviado exitosamente!</h4>";
        }else{
            echo "<h4>Por favor, completa todos los campos.</h4>";
        }
    }
}
?>