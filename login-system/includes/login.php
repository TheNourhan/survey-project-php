<?php

$uid;
$pwd;

if(isset($_POST['submit'])){
    $uid        = $_POST['uid'];
    $pwd        = $_POST['pwd'];

    //Instantiate LoginContr class
    include '../classes/conn.php';
    include '../classes/login_classes.php';
    include '../classes/login-contr.php';
    $login = new LoginContr($uid, $pwd);

    //Running error handlers and users Login
    $login->loginUser();
    
    //Going to back to front page
    //header("location: /login/profile/user-profile.php?error=none");
}