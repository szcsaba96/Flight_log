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
    <link rel="stylesheet" href="css/style_fleet.css">
    <link rel="stylesheet" href="css/style_innerpage.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    var type;

    function ajaxCalls(str1, str2) {
    
        var sendString;
        
        if( (str1 == "type"  || str1 == "reg") && str2 == "" ) {
            document.getElementById("tableHint").innerHTML = "";
            return;
        } else {

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {

                if (this.readyState == 4 && this.status == 200) {
                    if(str1 == "type"  || str1 == "reg") {
                        document.getElementById("tableHint").innerHTML = this.responseText;
                    }
                }
            };

            if( str1 == "type" ) {
                sendString = "ajax/getfleet.php?type=" + str2;
                console.log(sendString);
            } else if ( str1 == "reg" ) {
                sendString = "ajax/getfleet.php?reg_number=" + str2;
            } else {
                
                formData = document.getElementById("insertForm").elements;
                sendString = "ajax/insertfleet.php?reg=" + formData[0].value + "&type=" + formData[1].value + "&model=" + formData[2].value + "&manufacturer=" + formData[3].value + "&short_name=" + formData[4].value + "&hours=" + formData[5].value + "&landings=" + formData[6].value;
            }
            console.log(sendString);
            xmlhttp.open("POST", sendString, true);
            xmlhttp.send();
        }
    }

    function changeView() {
        var searchFleetForm = document.querySelector(".dashboard_body");
        var changeViews = document.querySelector(".in1 div");
        
        var button = changeViews.querySelector("button");
        var form = changeViews.querySelector("form");
        

        if (searchFleetForm.style.display === "none") {
            searchFleetForm.style.display = "block";

            button.innerText = "Add an aircraft";
            button.style.backgroundColor = "#337ab7";
            form.style.display = "none";

        } else {
            searchFleetForm.style.display = "none";

            button.innerText = "Go back and search from fleet";
            button.style.backgroundColor = "#5cb85c";
            form.style.display = "block";
        }
    }


    </script>
       
</head>
<body>
    
    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="dashboard_body">

            
            <h2> Fleet </h2>
            <hr>
            <div class="dashboard_before_after">
                
                <form style="margin-left: 20%;">
                
                <ul class="side-by-side">
                    <li>
                        <label for="type">Type of aircraft</label> <br>
                        <select name="type" id="type" onchange="ajaxCalls('type', this.value)">
                            <option> Select Type </option>
                            <option value="all"> ALL </option>
                            <option value="ULM"> ULM </option>
                            <option value="PPL"> PPL </option>
                            <option value="GLIDER"> Glider </option>
                        </select>
                    </li>

                    <li>
                        <label for="reg">Registration number</label> <br>
                        <input type="text" name="reg" id="reg" placeholder="YR-0000" onchange="ajaxCalls('reg', this.value)">
                    </li>
                </ul>

                </form>
            </div>
        </div>

        <div class="in1 dashboard_body" id="tableHint">
        </div>

        <!-- If Instructor, can add aircraft to fleet -->
        <div class="in1 dashboard_body">
        
        <div class="add add_button" style="float: left;">
            <button onClick="changeView()">Add an aircraft</button>

            <form class="form1" style="display: none; margin-top: 20px;" id="insertForm">
                <label for="reg">Registration number</label>
                <input type="text" name="reg" id="reg">

                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value=""> -- SELECT TYPE -- </option>
                    <option value="ULM"> ULM </option>
                    <option value="GLIDER"> GLIDER </option>
                    <option value="PPL"> PPL </option>
                </select>

                <label for="model">Model</label>
                <input type="text" name="model" id="model">

                <label for="manufacturer">Manufacturer</label>
                <input type="text" name="manufacturer", id="manufacturer">

                <label for="short_name">Short name</label>
                <input type="text" name="short_name" id="short_name">

                <label for="hours">Hours</label>
                <input type="number" name="hours" id="hours">

                <label for="landings">Landings</label>
                <input type="text" name="landings" id="landings">

                <br>

                <button onClick="ajaxCalls('insertForm', 'form1')" style="margin-top: 20px;"> Add </button>

            </form>
        </div>
    </main>

    <footer>
    <?php require_once "inc/footer.php" ?>
    </footer>
</body>
</html>