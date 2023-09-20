<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="user.css">

</head>
<body>

    <header>
        <ul class="menu-member">
            <?php if(isset($_SESSION["userid"])) { ?>
                <li><a href="#"><?php echo $_SESSION["useruid"];?></a></li>
                <li><a href='../login-system/includes/logout.php' class="header-login-a">LOGOUT</a></li>
            <?php } else { ?>
                <li><a href="../register.php">SIGN UP</a></li>
                <li><a href="../index.php" class="header-login-a">LOGIN</a></li>
            <?php } ?>
        </ul>
    </header>

    <h1>Welcome <?php echo $_SESSION["useruid"];?></h1>

    <ul>
        
            
            <div id="">
                <li>
                    <a href="./survey/form1.php">programming languages</a>
                    <p>The most common programming languages ​​and their uses.</p>
                </li>
            </div>
            
            <div id="">
                <li>
                    <a href="./survey/form2.php">E-learning</a>
                    <p>E-learning, its spread, effectiveness and efficiency, and how people deal with it.</p>
                </li>
            </div>
            </here>
    </ul>

</body>
</html>