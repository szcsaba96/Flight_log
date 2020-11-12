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
    <title>Documents</title>
    <link rel="stylesheet" href="css/style_main.css">
    <link rel="stylesheet" href="css/style_innerpage.css">
    <link rel="stylesheet" href="css/style_document.css">
    <link rel="icon" type="image/png" href="inc/images/air.png">
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
            xmlhttp.open("GET", "ajax/getfleet.php?type=" + type, true);
            xmlhttp.send();
        }
    }
    </script>

</head>

<body>

    <?php include 'dashboard_body.shtml'; ?>

    <main>

        <div class="dashboard_body">
            <h2> Scanned documents </h2>
            <hr>
            <div>

                <div class="info info1">
                    <p>
                        <i class="fas fa-info-circle"></i> The scans of your documents improve the process of verifying
                        your flight experience, licences and validity of your flight ratings. Each file submitted will
                        be approved by the staff.
                    </p>
                </div>

                <div class="info info1">
                    <p>
                        <i class="fas fa-info-circle"></i>
                        No scanned documents found.
                    </p>
                </div>

                <!-- Trigger/Open The Modal -->
                <div class="add_button" style="float: left;">
                    <button id="myBtn">Add scanned documents</button>
                </div>

                <!-- The Modal -->
                <div id="myModal" class="modal">

                    <!-- Modal content -->
                    <div class="modal-content">
                        <div class="modal_header">
                            <span class="close">&times;</span>
                            <h4>
                                Graphical (jpg, png, bmp, gif) and pdf formats are allowed. If the document has been
                                scanned to two different files, you should select both of these files. They will be
                                automatically merged to a single PDF file.
                            </h4>
                        </div>
                        <hr style="margin-left: 20px; margin-right: 20px">
                        <div class="modal_formpage">

                            <form class="form1 js-add_doc" method="POST" enctype="multipart/form-data">

                                <div class="modal_table" style="table-layout: unset; ">

                                    <div class="table-colgroup">
                                        <div class="table-col col-1"></div>
                                        <div class="table-col col-2"></div>
                                    </div>


                                    <div class="table-row">
                                        <div class="table-cell">
                                            <label for="type">Document type</label>
                                            <select name="type" id="type" required>
                                                <option> Select Type </option>
                                                <option value="PPLA"> PPL(A) </option>
                                                <option value="CPLA"> CPL(A) </option>
                                                <option value="ATPL"> ATPL(A) </option>
                                                <option value="SPL"> SPL </option>
                                                <option value="ULM"> FI ULM </option>
                                                <option value="radio"> Radio </option>
                                                <option value="med1"> Medical class 1 </option>
                                                <option value="med2"> Medical class 2 </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="table-row">
                                        <div class="table-cell">
                                            <label for="descr">Description</label>
                                            <input type="text" name="descr" id="descr" class="descr">
                                        </div>
                                    </div>

                                    <div class="table-row">
                                        <div class="table-cell">
                                            <label for="file1">Page 1</label>
                                            <input type="file" name="file1" id="file1"
                                                style="margin-left: 60px; width: 425px;display: inline-block;"
                                                accept="image/jpeg,image/gif,image/png,image/bmp,application/pdf">
                                        </div>
                                    </div>

                                    <div class="table-row">
                                        <div class="table-cell">
                                            <label for="file2">Page 2</label>
                                            <input type="file" name="file2" id="file2"
                                                style="margin-left: 60px; width: 425px;display: inline-block;"
                                                accept="image/jpeg,image/gif,image/png,image/bmp,application/pdf">
                                        </div>
                                    </div>

                                    <?php // TABLE END ?>
                                </div>

                                <div class="add_button">
                                    <button type="submit">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>


            <div class="dashboard_body" id="txtHint">
            </div>

    </main>

    <footer>
        <?php require_once "inc/footer.php" ?>
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
        </script>
    </footer>
</body>

</html>