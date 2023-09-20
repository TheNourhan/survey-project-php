<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css"  href="./login-system/front-end/style.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login page</title>
</head>
<body>
    <div class="login">
        <div class="div_navbar">
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid" >
                <a class="navbar-brand col-8" href="#" data-word="Questionnaire_repository">Questionnaire repository</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item col-6">
                        <a class="nav-link active" aria-current="page" href="#" data-word="Home" >Home</a>
                    </li>
                    <li class="nav-item col-4">
                        <a class="nav-link" href="#" data-word="Login">Login</a>
                    </li>
                    <li class="nav-item dropdown col-4">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"  data-word="Translation">
                        Translation
                        </a>
                        <ul class="dropdown-menu">
                        <li><button onclick='change_word("Arabic")'>Arabic</button></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><button onclick='change_word("English")'>English</button></li>
                        </ul>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
        </div>

        <div class="div_login">
            <div class="div_login_intro">
                <div class="div_login_intro_icon">
                    <!-- <i class="fa-regular fa-user"></i> -->
                    <i class="fa-solid fa-user"></i>
                </div>


<!----------------------------------- Data -------------------------------------------->
                <form action='login-system/includes/login.php' method="POST" class="div_login_intro_content">
                    <h3 data-word="Sign_In">Sign In</h3>
                    <!-- <i class="fa-solid fa-lock"></i> -->
                    <div>
                        <i class="fa-solid fa-user"></i>
                        <input type="text" name="uid" placeholder="Username">
                    </div>
                    <div>
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" name="pwd" placeholder="Password">
                    </div>
                    <button type="submit" name="submit" data-word="Login">LOGIN</button>
                </form>
<!----------------------------------- Data -------------------------------------------->



            </div>
            <div>
                <hr/>
                
                <p data-word="Don_t_have_a_account">Don't have a account ?</p><a href="register.php" data-word="REGISTER_HERE">REGISTER HERE</a>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="./login-system/front-end/index.js"> </script>
</body>
</html>