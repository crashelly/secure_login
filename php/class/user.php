<?php

class ProgramUser{
    private $pdo = null;
    private $email = null;
    public function __construct($DBconection,$email){
            $this->pdo = $DBconection;
            $this->email = $email;
    }


    public function getVerificationCode(){
        $query = "SELECT verificationCode FROM usuarios WHERE email =:email";
        $query = $this->pdo->prepare($query);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->execute();
    
        $result = $query->fetch(PDO::FETCH_ASSOC);
        //   token de la base de datos
        $codeToken = $result['verificationCode'];

        return $codeToken;
    }

    public function checkBooleanCheckedCode(){
        $query = "SELECT ChekedTokenCode FROM usuarios WHERE email =:email";
        $query = $this->pdo->prepare($query);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $checkedTokenCode = $result['ChekedTokenCode'];

        //  ternaria para devolver valores falseo o verdadero
        return ($checkedTokenCode == 1)? true : false;
    }



    public function setCheckTokenCode(){
        $query = "UPDATE usuarios SET ChekedTokenCode = 1 WHERE email =:email";
        $query = $this->pdo->prepare($query);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->execute();
    }

    #funcion de redireccion
    public function redirect($path){
        echo "<script>window.location.href = '$path';</script>";
    }
}



?>