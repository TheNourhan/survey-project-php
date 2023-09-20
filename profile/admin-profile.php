<?php
    session_start();
    if (!isset($_SESSION["admin"])) {
        header("location: /survey/index.php?error=none");
        exit();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>

    <header>
        <ul class="menu-member">
            <li><a href="#" class="corner-text">noura</a></li>
            <li><a href="../login-system/includes/logout.php" class="corner-text">LOGOUT</a></li>
        </ul>
    </header>

    <div class="content">
        <form action="">
            <div class="link-wrapper">
                <a href="./admin/survey_input.php">Create Survey</a>
            </div>
            <div class="link-wrapper">
                <a href="./admin/update_survey_view.php">Update Survey</a>
            </div>
            <div class="link-wrapper">
                <a href="./admin/results_survey.php">Survey Results</a>
            </div>
        </form>
    </div>

</body>
</html>
