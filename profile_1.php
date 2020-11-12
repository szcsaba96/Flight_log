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
    <title>Profile</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_myflights.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

</head>

<body>

    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="dashboard_body">
            <h2> My user profile </h2>
            <hr>

            <div style="margin-top: 2%;">

                <form class="form2">

                    <label for="first_name">First name</label>
                    <input type="text" id="first_name" value="<?php echo $User->getFirstName();?>" onchange="setFirstName(this.value)">

                    <label for="last_name">Last name</label>
                    <input type="text" id="last_name" value="<?php echo $User->getLastName();?>">

                    <label for="mobile">Mobile number</label>
                    <input type="tel" id="mobile" value="<?php echo $User->getMobile();?>">

                    <label for="birthday">Date of birth</label>
                    <input type="date" id="birthday" value="<?php echo $User->getBirth();?>">

                    <label for="address">Address</label>
                    <input type="text" id="address" value="<?php echo $User->getAddress();?>">

                    <label for="email">Email</label>
                    <input type="email" id="email" value="<?php echo $User->getEmail();?>">

                    <p></p>

                    <span>
                        <button type="submit" onclick="onSubmit()">Save</button>
                    </span>
                </form>
            </div>
        </div>
    </main>

    <footer>
        <?php require_once "inc/footer.php" ?>
        <script>

            var firstName;

            function ajaxCall(id, value) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    document.getElementById(id).innerHTML = this.responseText;
                    }
                };
                xhttp.open("POST", "ajax/change2.php?col=" + id + "&value=" + value, true);
                xhttp.send();
            }

            function onSubmit() {
                if( firstName ) {
                    ajaxCall("first_name", firstName);
                }
            }

            function setFirstName(str) {
                firstName = str;
            }

        </script>
    </footer>
</body>

</html>