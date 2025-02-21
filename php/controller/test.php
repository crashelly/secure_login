<?php
include "../class/user.php";
include "../../db.php";

$email = "colchondeSpam@gmail";
$user = new ProgramUser($pdo, $email);
$user->redirect("../../views/codeVerification.php?email=$email");

?>