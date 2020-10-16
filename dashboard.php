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
    <link rel="stylesheet" href="css/style_innerpage.css">
    <link rel="stylesheet" href="css/style_iconfonts.css">
    <link rel="icon" type="image/png" href="air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
       
</head>
<body>

    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="in1 dashboard_body">
        <h3>Dashboard</h3>

        <div class="container">
        <hr>
            <div class="dashboard_before_after">
                <div class="workspace">

                

                <!-- Trigger/Open The Modal -->
                <button id="myBtn" class="btn">Enter a flight into the system</button>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <div class="modal_header">
                        <h3>Flight details</h3>
                    </div>
                    <hr style="margin-left: 20px; margin-right: 20px">
                        <div class="modal_formpage">

                        <form class="form1 js-addflight" method="GET">

                            <div class="modal_table">

                                <div class="table-colgroup">
                                    <div class="table-col col-1"></div>
                                    <div class="table-col col-2"></div>
                                </div>
                            

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="flight_date">Day</label>
                                        <input type="date" name="flight_date" id="flight_date" class="input_areas" required>
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                    
                                    <label for="type1">Type of aircraft</label>
                                    <select name="type1" id="type1" required onchange="changeType(this.value)">
                                        <option> Select Type </option>
                                        <option value="ULM"> ULM  </option>
                                        <option value="PPL"> PPL </option>
                                        <option value="GLIDER"> GLIDER </option>
                                    </select>

                                    </div>

                                    <div class='table-cell' id="txtHint" name="txtHint"> 
                                        
                                    </div>

                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="pilot">Pilot</label>
                                        <input type="text" name="pilot" id="pilot" class="input_areas" value="<?php echo $User->getName(); ?>" readonly style="background-color: grey; cursor: not-allowed;">
                                    </div>
                                    <div class="table-cell">
                                        <label for="instructor">Instructor</label>
                                        <input type="text" name="instructor" id="instructor" class="input_areas" required>
                                        <div class="error js-error" style='display: none;'></div>
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="dep_place">Departure place</label>
                                        <input type="text" name="dep_place" id="dep_place" class="input_areas" required placeholder="ICAO Code">
                                    </div>
                                    <div class="table-cell">
                                        <label for="arr_place">Arrival place</label>
                                        <input type="text" name="arr_place" id ="arr_place" class="input_areas" required placeholder="ICAO Code">
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="flight_time">Flight time</label>
                                        <input type="text" name="flight_time" id="flight_time" class="input_areas" required placeholder="HH:MM - HH:MM" pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9] (-) ([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$">
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="flights">Number of flights</label>
                                        <input type="number" name="flights" id="flights" class="input_areas" required min="1">
                                    </div>
                                </div>

                            <?php // TABLE END ?>
                            </div>

                            <div class="add_button">
                                <button type="submit">Save</button>
                        </div>

                        <?php 
                        $a = new DateTime('14:37');
                        $b = new DateTime('16:02');
                        $interval = $a->diff($b);
                        
                        echo $interval->format("%H:%I");
                        ?>
                        
            
                        </form>
                        </div>
                    </div>
                </div>
            </div>



            </div>
            <script>

            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("myBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal 
            btn.onclick = function() {
            modal.style.display = "block";
            }   

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
                }
            }

            function changeType(type) {
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
                xmlhttp.open("GET","ajax/modal_type.php?type="+ type,true);
                xmlhttp.send();
                }
            }
            </script>
        </div>

        <table>
            <tr>
                <td>
                <div >        
                <div class="info_box_inline info_box1 info_box_table">
                    <div class="table-colgroup">
                        <div class="table-col col-1"></div>
                        <div class="table-col"></div>
                        <div class="table-col"></div>
                    </div>
                    
                    <div class="table-row info_box1_row">
                        <div class="table-cell info_box1_left"><span class="icon-glider_icon" style="margin-top: 15px; margin-left: 15px;"></span> </div>
                        <div class="table-cell"></div>
                        <div class="table-cell">My flights</div>
                    </div>

                    <div class="table-row info_box1_row">
                        <div class="table-cell"></div>
                        <div class="table-cell">Last flight</div>
                        <div class="table-cell"> 
                        <?php

                        echo $User->lastFlight($User->user_id, "GLIDER") ;
                        ?>
                        </div>
                    </div>

                    <div class="table-row info_box1_row">
                        <div class="table-cell"></div>
                        <div class="table-cell">Total hours</div>
                        <div class="table-cell"> 
                        <?php
                            echo $User -> totalHours($User->user_id, "GLIDER");

                        ?>
                        </div>
                    </div>

                    <div class="table-row info_box1_row table-foot">
                        <div class="table-cell"><a href="myflights.php" style="text-decoration: none; color: #f0ad4e;"> View details </a></div>
                        <div class="table-cell"></div>
                        <div class="table-cell"><a href="myflights.php"><i class="fas fa-info-circle"></i></a></div>
                    </div>
                    </div>
                    </div>
                </div>
                </td>
                <td>
                <div style="margin-left: 80px; margin-bottom: 65px;">
                    <div class="info_box_inline info_box2 info_box_table">
                        <div class="table-colgroup">
                            <div class="table-col col-1"></div>
                                <div class="table-col"></div>
                                    <div class="table-col"></div>
                                        </div>
                                        <div class="table-row info_box1_row">
                                            <div class="table-cell info_box1_left"><span class="icon-2555195" style="margin-top: 15px; margin-left: 15px;"></span> </div>
                                            <div class="table-cell"></div>
                                            <div class="table-cell">My flights</div>
                                        </div>

                                        <div class="table-row info_box1_row">
                                            <div class="table-cell"></div>
                                            <div class="table-cell">Last flight</div>
                                            <div class="table-cell"> 
                                            <?php

                                            echo $User->lastFlight($User->user_id, "ULM") ;
                                            ?>
                                            </div>
                                        </div>

                                        <div class="table-row info_box1_row">
                                            <div class="table-cell"></div>
                                            <div class="table-cell">Total hours</div>
                                            <div class="table-cell"> 
                                            <?php
                                                echo $User -> totalHours($User->user_id, "ULM");
                                            ?>
                                            </div>
                                        </div>

                                        <div class="table-row info_box1_row table-foot">
                                            <div class="table-cell"><a href="myflights.php" style="text-decoration: none; color: #5cb85c;"> View details </a></div>
                                            <div class="table-cell"></div>
                                            <div class="table-cell"><a href="myflights.php"><i class="fas fa-info-circle"></i></a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </td>
            </tr>

            <tr>
                <td>
                <div >        
                <div class="info_box_inline info_box3 info_box_table">
                    <div class="table-colgroup">
                        <div class="table-col col-1"></div>
                        <div class="table-col"></div>
                        <div class="table-col"></div>
                    </div>
                    
                    <div class="table-row info_box1_row">
                        <div class="table-cell info_box1_left"><span class="icon-aircraft" style="margin-top: 15px; margin-left: 15px;"></span> </div>
                        <div class="table-cell"></div>
                        <div class="table-cell">My flights</div>
                    </div>

                    <div class="table-row info_box1_row">
                        <div class="table-cell"></div>
                        <div class="table-cell">Last flight</div>
                        <div class="table-cell"> 
                        <?php

                        echo $User->lastFlight($User->user_id, "PPL") ;
                        ?>
                        </div>
                    </div>

                    <div class="table-row info_box1_row">
                        <div class="table-cell"></div>
                        <div class="table-cell">Total hours</div>
                        <div class="table-cell"> 
                        <?php
                            echo $User -> totalHours($User->user_id, "PPL");

                        ?>
                        </div>
                    </div>

                    <div class="table-row info_box1_row table-foot">
                        <div class="table-cell"><a href="myflights.php" style="text-decoration: none; color: #d9534f;"> View details</a> </div>
                        <div class="table-cell"></div>
                        <div class="table-cell"><a href="myflights.php"><i class="fas fa-info-circle"></i></a></div>
                    </div>
                    </div>
                    </div>
                </div>
                </td>
            </tr>

        </table>
        </div>
        </div>
    </main>

    <footer>
    <?php require_once "inc/footer.php" ?>
    </footer>
</body>
</html>