<?php
session_start();
if (!isset($_SESSION["admin"])) {
    header("location: /survey/index.php?error=none");
    exit();
}

include '../../login-system/classes/conn.php';
include 'control-panal.php';
$excelFile = new ControlPanal();
$excelFile->downloadExcelFile();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey results</title>
    
    <link rel="stylesheet" href="result.css">
</head>
<body>
    
        <h1>The Survey results</h1>

        <?php
        $surveyList = new ControlPanal();
        $surveyList->DisplaySurveyResults();  
        ?>
</body>
</html>