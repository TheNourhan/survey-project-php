<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css"  href="./login-system/front-end/style.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Register user</title>
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
                        <a class="nav-link" href="index.php" data-word="Login">Login</a>
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
                    <i class="fa-solid fa-user"></i>
                </div>
<!---------------------------------- Data ------------------------------------------>
                <form action='./login-system/includes/signup.php' method="POST" class="div_register_intro_content">
                    <h3 data-word="Sign_In">Sign In</h3>
                    <div>
                        <!--<input placeholder="Last Name" type="text" />-->
                        <input type="text" name="uid" placeholder="Username" >
                    </div>
                    <div>
                        <input type="password" name="pwd" placeholder="Password">
                    </div>
                    <div>
                        <input type="password" name="pwdRepeat" placeholder="Repeat Password">
                    </div>
                    <div>
                        <input type="text" name="email" placeholder="E-mail"><br>
                    </div>
                    <div>
                        <label for="age">your age: </label><br>
                        <select name="age" id="age">
                                <option>Select One:</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                                <option value="32">32</option>
                                <option value="33">33</option>
                                <option value="34">34</option>
                                <option value="35">35</option>
                                <option value="36">36</option>
                                <option value="36">37</option>
                                <option value="36">38</option>
                                <option value="36">39</option>
                                <option value="36">40</option>
                        </select>
                    </div>
                    <div>
                        <label for="edu_level">Educational level: </label><br>
                        <select name="edu_level" id="edu_level">
                                <option>Select One:</option>
                                <option value="Primary education">Primary education</option>
                                <option value="Secondary education">Secondary education</option>
                                <option value="Bachelor’s degree">Bachelor’s degree</option>
                                <option value=" Doctor of Philosophy"> Doctor of Philosophy</option>
                        </select>
                    </div>
                    <div>
                        <label for="country">Choose a Country: </label><br>
                        <select name="country" id="country">
                                <option>Select One:</option>
                                <option value="Syria">Syria</option>
                                <option value="Saudi Arabia">Saudi Arabia</option>
                                <option value="Sudan">Sudan</option>
                                <option value="Qatar">	Qatar</option>
                                <option value="	Oman">	Oman</option>
                                <option value="Morocco">Morocco</option>
                                <option value="	Lebanon">	Lebanon</option>
                                <option value="	Libya">	Libya</option>
                                <option value="	Kuwait">	Kuwait</option>
                                <option value="	Jordan">	Jordan</option>
                                <option value="	Iraq">	Iraq</option>
                                <option value="	Egypt">	Egypt</option>
                        </select>
                    </div>
                    <div>
                        <label for="gender">Choose a Gender: </label><br>
                        <select name="gender" id="Gender">
                                <option>Select One:</option>
                                <option value="Female">Female</option>
                                <option value="Male">Male</option>
                                <option value="Other">Other</option>
                        </select>
                    </div>
                    <input type="submit" data-word="Login" name="submit" value="SIGN UP">
                </form>
<!----------------------------------------------------------------------------------------->
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="./login-system/front-end/index.js"> </script>
</body>
</html>