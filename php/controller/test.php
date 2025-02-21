<?php
// default
ini_set("SMTP", "smtp.gmail.com");
ini_set("sendmail_from", "yamori2708@gmail.com");
ini_set("smtp_port", "465");

$resetLink = "192.168.28.194/logins/changePassword.php";
include "../../db.php";

$email = $_POST['email'];

try {
  $to = 'sofi@gmail.com';
  $to = 'sofi@gmail.com';
  $query = "SELECT ChekedTokenCode FROM usuarios WHERE email =:email";
  $query = $pdo->prepare($query);
  $query->bindParam(':email', $email, PDO::PARAM_STR);
  $query->execute();
  $result = $query->fetch(PDO::FETCH_ASSOC);
  $codeToken = $result['ChekedTokenCode'];
  
  if ($codeToken == "0") {
    # code...
    echo $codeToken;
  }else{
    echo "<script>window.location.href = '../../views/changePassword.php?email=$email';</script>";
  }

  
} catch (\Throwable $e) {
  echo $e->getMessage();
}
// =============================================================


?>