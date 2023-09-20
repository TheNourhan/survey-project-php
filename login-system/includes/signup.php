<?php

if(isset($_POST['submit'])){
    $uid        = $_POST['uid'];
    $pwd        = $_POST['pwd'];
    $pwdRepeat  = $_POST['pwdRepeat'];
    $email      = $_POST['email'];

    $age        = $_POST['age'];
    $edu_level  = $_POST['edu_level'];
    $country    = $_POST['country'];
    $gender     = $_POST['gender'];

    //Instantiate SignupContr class
    include '../classes/conn.php';
    include '../classes/signup_classes.php';
    include '../classes/signup-contr.php';
    $signup = new SignupContr($uid, $pwd, $pwdRepeat, $email, $age, $edu_level, $country, $gender);

    //Running error handlers and users signup
    $signup->signupUser();
    
    //Going to back to front page
    header("location: /profile/user-profile.php?error=none");
}