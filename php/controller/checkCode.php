<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");


// 
// $resetLink = "192.168.28.194/logins/changePassword.php";
include "../../db.php";
include "../class/user.php";


// $email = $_POST['email'];
// TokenCode = $_POST['tokenCode'];
// token submiteado
$submitedTokenCode = '1823';

$email = 'colchondeSpam@gmail';
$pdo ;
$email;
// crear el objeto y conseguir el token
$user = new ProgramUser($pdo,$email);
try {
    $tokenCode = $user->getVerificationCode();
    //   verifica que ambos token coincidan
    if($tokenCode == $submitedTokenCode) {
        $user->setCheckTokenCode();
        $user->redirect("'../../views/changePassword.php?email=$email'");      
    } else {
        echo "los tokens  NO coinciden";
    }


} catch (\Throwable $e) {
    echo $e->getMessage();
}
// =============================================================


?>