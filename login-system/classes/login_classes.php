<?php

class Login extends DB_connect{
    
    private $table="users";

    protected function getUser($uid, $pwd){
        
        // cheak if username or email are found
        $connDB=$this->connect();
        $sql="SELECT users_pwd FROM $this->table WHERE (users_uid = ? OR users_email = ?)";
        $stmt=$connDB->prepare($sql);

       if(!$stmt->execute(array($uid,$uid))){
            $stmt = null;// To stop run the rest of code
            header("location: ../../index.php?error=stmtfaild");
            exit();
        }

        if($stmt->rowCount()==0){
            $stmt=null;
            header("location: ../../index.php?error=usernotfound");
            exit();
        }
        
        $pwdHashed=$stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd=password_verify($pwd, $pwdHashed[0]["users_pwd"]);

        // cheak if password was correct
        if($checkPwd==false){
            $stmt=null;
            header("location: ../../index.php?error=wrongpassword");
            exit();

        }elseif($checkPwd==true){

            $connDB=$this->connect();
            $sql="SELECT * FROM $this->table WHERE users_uid = ? OR users_email = ? AND users_pwd = ?";
            $stmt=$connDB->prepare($sql);
            
            if(!$stmt->execute(array($uid,$uid,$pwdHashed[0]["users_pwd"]))){
                $stmt = null;// To stop run the rest of code
                header("location: ../index.php?error=stmtfaild");
                exit();
            }

            if($stmt->rowCount()==0){
                $stmt=null;
                header("location: ../index.php?error=usernotfound");
                exit();
            }

            $user=$stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION["userid"] =$user[0]["usere_id"];
            $_SESSION["useruid"]=$user[0]["users_uid"];

            // To check if the user is an administrator
            $connDB=$this->connect();
            $sql="SELECT u_type FROM users WHERE users_uid = ? OR users_email = ?";
            $stmt=$connDB->prepare($sql);

            if(!$stmt->execute(array($uid,$uid))){
                $stmt = null;// To stop run the rest of code
                header("location: ../index.php?error=stmtfaild");
                exit();
            }

            $type=$stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $stmt=null;

            $_SESSION["userType"] = $type[0]["u_type"];
            $_SESSION["admin"] = $type[0]["u_type"];
            
            return $type[0]["u_type"];
        }
        $stmt=null;
    }  

}