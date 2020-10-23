<?php 
    //allow the config
    define('__CONFIG__', true);
    //require the config
    require_once "inc/config.php"; 

    Page::ForceLogin();

    $User = new User($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fleet</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_myflights.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
       
</head>
<body>
    
    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="in1 dashboard_body">
            <h2> My user profile </h2>
            <hr>
            
            <div>

            <form class="form2 js-change_profile">

                <label for="first_name">First name</label>
                <input type="text" id="first_name">

                <label for="last_name">Last name</label>
                <input type="text" id="last_name" >

                <label for="mobile">Mobile number</label>
                <input type="tel" id="mobile" >


                <label for="birthday">Date of birth</label>
                <input type="date" id="birthday">

                <label for="address">Address</label>
                <input type="text" id="address">

                <label for="email">Email</label>
                <input type="email" id="email">

                <p></p>

                <span>
                    <button type="submit">Save</button>
                </span>
                
                

            </form>

                
            </div>
            
        </div>
         
    </main>

    <footer>
    <?php require_once "inc/footer.php" ?>
    </footer>
</body>
</html>