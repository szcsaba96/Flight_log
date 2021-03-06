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
    <title>Myflights</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_myflights.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>

    <script>
    var from;
    var to;
    var type;

    function showUser(from, to, type) {
    if (from == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","ajax/getuserflights.php?from="+from + "&to=" + to + "&type=" + type,true);
        xmlhttp.send();
        }
    }

    function setFrom(str) {
        if(typeof from !== "undefined") {
            showUser(str, to, type);
        }
        from = str;
    }

    function setTo(str) {
        if(typeof to !== "undefined") {
            showUser(from, str, type);
        }
        to = str;
    }

    function setType(str) {
        if(typeof type !== "undefined") {
            window.location.href = window.location.href.replace( /[\?#].*|$/, "?from=" +from + "&to=" + to + "&type=" + str );
        }
        type = str;
        showUser(from, to, type);
    }
    </script>
       
</head>
<body>
    
    <?php include 'dashboard_body.shtml'; 
    
    if( isset($_GET['from']) && isset($_GET['to']) && isset($_GET['type']) ) {
        $from = $_GET['from'];
        $to = $_GET['to'];
        $type = $_GET['type'];

        echo "<script type='text/javascript'>
            showUser('$from', '$to', '$type');
            setFrom('$from');
            setTo('$to');
        </script>";
    }

    ?>

    <main>

        <div class="dashboard_body">
            <h3> My flights </h3>
            <hr>
            <div class="dashboard_before_after">
                
                <form>
                <ul class="side-by-side">
                    <li>
                        <label for="from">From</label> <br>
                        <input type='date' name='from' id='from' onchange='setFrom(this.value)' <?php if(isset($from) ) { echo "value=$from"; } ?> >
                    </li>
                    <li>

                        <label for="to">To</label> <br>
                        <input type='date' name='to' id='to' onchange='setTo(this.value)' <?php if(isset($to) ) { echo "value=$to"; } ?> >
                    </li>
                    <li>

                        <label for="type">Type of aircraft</label> <br>
                        <select name='type' id='type' onchange='setType(this.value)'>
                            <option> Select Type </option>
                            <option value="ULM" <?php if(isset($type) && $type=='ULM') { echo "selected"; } ?> > ULM </option>
                            <option value="PPL" <?php if(isset($type) && $type=='PPL') { echo "selected"; } ?> > PPL </option>
                            <option value="GLIDER" <?php if(isset($type) && $type=='GLIDER') { echo "selected"; } ?> > Glider </option>
                        </select>
                    </li>
                </ul>
                </form>
            </div>
            
        </div>

        <div class="dashboard_body" id="txtHint">
        </div>
         
    </main>

    <footer>
    <?php require_once "inc/footer.php" ?>
    </footer>
</body>
</html>