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

 
    public function setPassword($password){
        $password_hash = password_hash($password, PASSWORD_BCRYPT);
        $query = "UPDATE usuarios SET password_hash =:password,ChekedTokenCode = 0 WHERE email =:email";
        $query = $this->pdo->prepare($query);
        
        $query->bindParam(':password', $password_hash, PDO::PARAM_STR);
        $query->bindParam(':email', $this->email, PDO::PARAM_STR);
        $query->execute();
    }

    #funcion de redireccion
    public function redirect($path){
        try{
            echo "<script>window.location.href = '$path';</script>";
            // header("Location: $path");
        }catch (\Throwable $th) {
            echo $th->getMessage();
        }
    }

    public function alerta($messagge){
        echo "<script>alert('$messagge');</script>";
        // header("Location: ../../index.php");
    }
}



?>