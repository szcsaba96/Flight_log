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
    <title>Planning</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_innerpage.css">
    <link rel="stylesheet" href="fullcalendar/fullcalendar.min.css" />
    <link rel="stylesheet" href="css/calendar.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <script src="js/modal.js"></script>

       
</head>
<body>
    
    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="dashboard_body">

            
            <h2> Planning </h2>
            <hr>

            <div class="add_button" style="float: left; margin-top: 1%;">
                <button type="submit" id="bookButton" onClick="initModal('bookModal', 'bookButton', 0)">Book</button>
            </div>

            <!-- The Modal -->
            <div id="bookModal" class="modal">

                <!-- Modal content -->
                <div class="modal-content" style="width: 30%;">
                    <span class="close">&times;</span>
                    <div class="modal_header">
                        <h3>Book a flight</h3>
                    </div>
                    <hr style="margin-left: 20px; margin-right: 20px">
                    <div class="modal_formpage">

                        <form class="form1 js-createBooking" method="GET">

                            <div class="modal_table">

                                <div class="table-colgroup">
                                    <div class="table-col col-1"></div>
                                </div>


                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="aircraft_reg">Aircraft Registration</label>
                                        <select name="aircraft_reg" id="aircraft_reg">
                                        <option value="">Select aircraft</option>
                                            <?php 
                                                $list = $con -> prepare("SELECT aircraft_reg FROM fleet ORDER BY aircraft_reg DESC");
                                                $list -> execute();

                                                while($data = $list->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value='";
                                                    echo $data['aircraft_reg'];
                                                    echo "' >";
                                                    echo $data['aircraft_reg'];
                                                    echo "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="date_book">Date</label>
                                        <input type="date" name="date_book" id="date_book">
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="time_book">Time</label>
                                        <input type="text" name="time_book" id="time_book"
                                            class="input_areas" required placeholder="hh:mm - hh:mm"
                                            pattern="^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9] (-) ([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$">
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="pilot">Pilot</label>
                                        <input type="text" name="pilot" id="pilot" class="input_areas"
                                            value="<?php echo $User->getName(); ?>" readonly
                                            style="background-color: grey; cursor: not-allowed;">
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="instructor_book">Instructor</label>
                                        <select name="instructor_book" id="instructor_book">
                                        <option value="">Choose instructor</option>
                                            <?php 
                                                $list = $con -> prepare("SELECT user_id, first_name, last_name FROM users WHERE instructor = 1");
                                                $list -> execute();

                                                while($data = $list->fetch(PDO::FETCH_ASSOC)) {
                                                    echo "<option value='";
                                                    echo $data['user_id'];
                                                    echo "' >";
                                                    echo $data['last_name']." ".$data['first_name'];
                                                    echo "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="table-row">
                                    <div class="table-cell">
                                        <label for="comm_book">Comments</label>
                                        <textarea name="comm_book" id="comm_book" cols="30" rows="3"></textarea>
                                        
                                    </div>
                                </div>

                                <!-- TABLE END -->
                            </div>

                            <div class="add_button">
                                <button type="submit">Create booking</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require_once "inc/footer.php" ?>
        
        <div class="in1" id="fullCalendar_dashboard">

            <!-- INCLUDE FULLCALENDAR -->
            <script src="fullcalendar/lib/jquery.min.js"></script>
            <script src="fullcalendar/lib/moment.min.js"></script>
            <script src="fullcalendar/fullcalendar.min.js"></script>
            <script src="js/calendar.js"></script>

            <div class="response"></div>
            <div id='calendar'></div>
        </div>
        <!-- Dashboard body end -->
        </div>
    </main>

    <footer>
    <?php 
        if(isset($_GET['modal']) && $_GET['modal'] == "set" ) {
            echo "<script type='text/javascript'> initModal('bookModal', 'bookButton', 0) </script>";
        }
    ?>
    </footer>
</body>
</html>