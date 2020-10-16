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
    <title>Main page</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_myflights.css">
    <link rel="icon" type="image/png" href="air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    var type;


    function getFleet(type) {
    if (type == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax/getfleet.php?type=" + type,true);
        xmlhttp.send();
        }
    }

    function getFleetReg(reg) {
    if (reg == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax/getfleet.php?reg_number=" + reg,true);
        xmlhttp.send();
        }
    }

    </script>
       
</head>
<body>
    
    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="in1 dashboard_body">
            <h2> Fleet </h2>
            <hr>
            <div class="dashboard_before_after">
                
                <form>
                
                <ul class="side-by-side">
                    <li>
                        <label for="type">Type of aircraft</label> <br>
                        <select name="type" id="type" onchange="getFleet(this.value)">
                            <option> Select Type </option>
                            <option value="all"> ALL </option>
                            <option value="ULM"> ULM </option>
                            <option value="PPL"> PPL </option>
                            <option value="GLIDER"> Glider </option>
                        </select>
                    </li>

                    <li>
                        <label for="reg">Registration number</label> <br>
                        <input type="text" name="reg" id="reg" placeholder="YR-0000" onchange="getFleetReg(this.value)">
                    </li>
                </ul>

                
                </form>
            </div>
            
        </div>


        <div class="in1 dashboard_body" id="txtHint">
        </div>
         
    </main>

    <footer>
    <?php require_once "inc/footer.php" ?>
    </footer>
</body>
</html>