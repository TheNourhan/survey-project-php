<?php
session_start();
    include '../../login-system/classes/conn.php';
    include 'get_answers.php';
    
    if (isset($_POST['submit_download'])) {
        $yourAnswers = new SurveyAnswer();
        $yourAnswers->downloadAnswers($_SESSION['answeredQuestions']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style.css"/>
    <title>Download your answers</title>
</head>
<body>

    <h1>Thank you for completing the survey!</h1>

    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <input type="submit" name="submit_download" value="Download your answers">
    </form>

</body>
</html>