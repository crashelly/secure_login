<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");


// 
// $resetLink = "192.168.28.194/logins/changePassword.php";
include "../../db.php";
include "../class/user.php";


$email = $_POST['email'];
 $submitedTokenCode = $_POST['tokenCode'];
// token submiteado
// $submitedTokenCode = '1823';

// $email = 'colchondeSpam@gmail';
// echo "el email es $email y el token es $submitedTokenCode";

// crear el objeto y conseguir el token
$user = new ProgramUser($pdo,$email);
try {
    $tokenCode = $user->getVerificationCode();
    //   verifica que ambos token coincidan
    if($tokenCode == $submitedTokenCode) {
        $user->setCheckTokenCode();
        $user->redirect("../../views/changePassword.php?email=$email");      
    } else {
        echo "<script>alert('los tokens NO coinciden seras redirijido otra vez ...'); window.location.href = '../../views/codeVerification.php?email=$email';</script>";
    }


} catch (\Throwable $e) {
    echo $e->getMessage();
}
// =============================================================


?>