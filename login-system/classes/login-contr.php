<?php

class LoginContr extends Login{

    private $uid;
    private $pwd;

    public function __construct($uid, $pwd){
        $this->uid         = $uid;
        $this->pwd         = $pwd;
    }
    
    public function loginUser(){
        if($this->emptyInput()==false){
            //echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
      
        if($this->getUser($this->uid, $this->pwd)==0){
            header("location: /survey/profile/user-profile.php?error=none");
        }else{
            header("location: /survey/profile/admin-profile.php?error=none");
        }
    }         

    private function emptyInput(){
        $result;
        if(empty($this->uid) || empty($this->pwd)){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }
}