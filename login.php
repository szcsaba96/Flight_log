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
    <title>FlyWeb Login Page</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="icon" type="image/png" href="air.png">
</head>

<body>
    <nav>
        <a class="active" href="#home">Home</a>
        <a href="#contact">Contact</a>
        <div class="nav_right">
            ATO
        </div>
    </nav>

    <main>

        <div class="welcome">
            <h3>Welcome to FlyWeb</h3>
        </div>

        <div class="login_form">
            <form class="js-login">

                <div>
                    <label for="email">Email</label> <br>
                    <input type="email" name="email" id="email" required>
                </div>

                <div>
                    <label for="password">Password</label> <br>
                    <input type="password" name="password" id="password" required>
                </div>

                <div class="error js-error" style='display: none;'>
                </div>
                
                <div>
                    <button type="submit">Login</button>
                </div>


                <p>
                    You don't have an account? 
                    <a href="register.php">Register here.</a>
                </p>

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