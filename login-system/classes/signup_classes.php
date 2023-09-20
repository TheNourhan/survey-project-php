<?php

class Signup extends DB_connect{
    
    private $table="users";

    protected function setUser($uid, $pwd, $email, $age, $edu_level, $country, $gender){

        $connDB=$this->connect();
        $sql="INSERT INTO $this->table(users_uid, users_pwd, users_email, users_age, users_eduLevel, users_country, users_gender) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt=$connDB->prepare($sql);

        $hashPwd=password_hash($pwd,PASSWORD_DEFAULT);

       if(!$stmt->execute(array($uid,$hashPwd,$email,$age,$edu_level,$country,$gender))){
            $stmt = null;// To stop run the rest of code
            header("location: ../register.php?error=stmtfaild");
            exit();
        }

        $stmt=null;

        //echo "<div style='padding:20px; background-color:yellow;'>Data addedd successFully</div>";
    }

    protected function checkUser($uid,$email){

        $connDB=$this->connect();
        $sql="SELECT users_uid FROM $this->table WHERE users_uid = ? OR users_email = ?";
        $stmt=$connDB->prepare($sql);
        
        if(!$stmt->execute(array($uid,$email))){
            $stmt = null;// To stop run the rest of code
            header("location: ../register.php?error=stmtfaild");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount()>0){
            $resultCheck=false;
        }else{
            $resultCheck=true;
        }
        return $resultCheck;
    }
    
}