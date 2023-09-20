<?php

class SignupContr extends Signup{
    private $uid;
    private $pwd;
    private $pwdRepeat;
    private $email;

    private $age;
    private $edu_level;
    private $country;
    private $gender;

    public function __construct($uid,$pwd,$pwdRepeat,$email, $age, $edu_level, $country, $gender){
        $this->uid         = $uid;
        $this->pwd         = $pwd;
        $this->pwdRepeat   = $pwdRepeat;
        $this->email       = $email;

        $this->age         = $age;
        $this->edu_level   = $edu_level;
        $this->country     = $country;
        $this->gender      = $gender;
    }
    
    public function signupUser(){
        if($this->emptyInput()==false){
            //echo "Empty input!";
            header("location: ../../register.php?error=emptyinput");
            exit();
        }
        if($this->emptySelect()==false){
            header("location: ../../register.php?error=selectInfo");
            exit();
        }
        if($this->invalidUid()==false){
            //echo "Invalid username!";
            header("location: ../../register.php?error=username");
            exit();
        }
        if($this->invalidEmail()==false){
            //echo "Invalid email!";
            header("location: ../../register.php?error=email");
            exit();
        }
        if($this->pwdMatch()==false){
            //echo "password don't match!";
            header("location: ../../register.php?error=passwordmatch");
            exit();
        }

        if($this->uidTakenCheck()==false){
            //echo "Username or email taken!";
            header("location: ../../register.php?error=useroremailtaken");
            exit();
        }
        
        $this->setUser($this->uid, $this->pwd, $this->email, $this->age, $this->edu_level, $this->country, $this->gender);
    }

    private function emptyInput(){
        $result;
        if(empty($this->uid) || empty($this->pwd) || empty($this->pwdRepeat) || empty($this->email)){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }

    private function emptySelect(){
        $result;
        if($this->age == 'Select One:' || $this->edu_level == 'Select One:' || $this->country == 'Select One:' || $this->gender == 'Select One:'){
            $result=false;
       }else{
            $result=true;
       }
       return $result;
    }

    private function invalidUid(){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/",$this->uid)){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result;
        if(!filter_var($this->email,FILTER_VALIDATE_EMAIL)){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }

    private function pwdMatch(){
        $result;
        if($this->pwd!==$this->pwdRepeat){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }

    private function uidTakenCheck(){
        $result;
        if(!$this->checkUser($this->uid,$this->email)){
            $result=false;
        }else{
            $result=true;
        }
        return $result;
    }
}