<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("location: /survey/index.php?error=none");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Survey</title>
    
    <link rel="stylesheet" href="delete.css"/>
</head>
<body>
    
        <h1>Update Survey</h1>

        <?php

        // Usage:
        include '../../login-system/classes/conn.php';
        include 'control-panal.php';
        $surveyList = new ControlPanal();
        $surveyList->displaySurveysList();


        ?>
  
</body>
</html>