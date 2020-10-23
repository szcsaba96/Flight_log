<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "inc/config.php"; 

    Page::ForceDashboard();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlyWeb</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
</head>

<body>
<nav>
    <ul style="display:contents;">
        <li class="navbar_left">
            <div>
            <img src="logo2.png" style="height: 50px;width: 75px;">
            </div>
        </li>
        <li class="navbar_right">
            <div>
            <a href="contact.php" class="logout"> 
            <i class="far fa-envelope"></i>
                Contact
            </a>
            </div>
        </li>   
    </ul>
</nav>

    <main>

        <div class="welcome">
            <h3>Welcome to FlyWeb</h3>
        </div>

        <div class="login_form">
            <form class="js-register">

            <div class="row">
                    <div class="inline_block">
                        <label for="first_name">First Name</label> <br>
                        <input type="text" name="first_name" id="first_name" required>
                    </div>
                    <div class="inline_block">
                        <label for="last_name">Last Name</label> <br>
                        <input type="text" name="last_name" id="last_name" required>
                    </div>
            </div>

                <div>
                    <label for="birthday">Date of birth</label> <br>
                    <input type="date" id="birthday" name="birthday" required>
                </div>

                <div>
                    <label for="address">Address</label> <br>
                    <textarea name="address" id="address" rows="3" class="textar" required></textarea>
                </div>

                <div>
                    <label for="tel">Telephone number</label> <br>
                    <input type="tel" name="tel" id="tel" required>
                </div>

                <div>
                    <label for="email">Email</label> <br>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="password">Password</label> <br>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="error js-error" style='display: none;'></div>

                <div>
                    <button type="submit">Register</button>
                </div>

            </form>
            <hr>
        </div>
    </main>

    <footer>

     <a href="" class="link">Read more here.</a>
     <?php require_once "inc/footer.php" ?>
    </footer>
</body>

</html>