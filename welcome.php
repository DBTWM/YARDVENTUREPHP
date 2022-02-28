<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";


// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }

        .active {
            color: green;
        }

        .skipped {
            color: #EAAA00;
        }

        .skipped_h1 {
            -webkit-text-decoration-line: line-through; /* Safari */
            text-decoration-line: line-through;
        }
    </style>
</head>
<body>
<h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>.<br>Welcome To Yard Ventures PHP
    Coding Challenge</h1>
<p>
    <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
    <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
</p>
<center><p>
    <div class="card-columns">
        <?php

        $usr_id = $_SESSION["id"];
        $sql = "SELECT * FROM `upcoming_deliveries` WHERE `usr`=$usr_id;";
        $result = $link->query($sql);

        if ($result->num_rows > 0) {


            while ($row = $result->fetch_assoc()) {

                if (strtotime($row["datetime"]) < time()) {
                    echo "This delivery is now outdated!";
                } else {

                    $delivery_id_active = $row["id"] . '_span';
                    $delivery_id_header = $row["id"] . '_header';
                    $delivery_id = $row["id"];
                    if ($row["opt_in"] == 1) {
                        $active_or_not = "<span id='$delivery_id_active' class='active'>Active</span>";
                        $line_through = "";
                        $button_text = "Skip delivery";
                    } else {
                        $active_or_not = "<span id='$delivery_id_active' class='skipped'>Will Be Skipped</span>";
                        $line_through = "skipped_h1";
                        $button_text = "Undo skipping";
                    }

                    $newDate = date("l, dS", strtotime($row["datetime"])) . " of " . date("F", strtotime($row["datetime"]));
                    echo "<div class='card text-center' style='width: 90%;'>
  <div class='card-body'>
    <h5 id='$delivery_id_header' class='card-title $line_through'>$newDate</h5>
   <strong> <p class='card-text'>Status: $active_or_not</p> </strong><br>
    <a href='#' class='btn btn-primary' id='$delivery_id' onclick='change_opt($delivery_id)'>$button_text</a>
  </div>
</div>";
                }
            }
        } else {
            echo "0 results";
        }
        $link->close();


        ?>
    </div>
    </p> </center>

<script>
    function change_opt(id) {
        var btn_txt = $('#' + id).text();
        if (btn_txt == "Undo skipping") {
            $('#' + id + '_header').removeClass("skipped_h1");
            document.getElementById(id + '_span').innerHTML = "Active";
            $('#' + id + '_span').toggleClass("active skipped");
            document.getElementById(id).innerHTML = "Skip delivery";
            $.ajax({
                type: "GET",
                url: 'http://yard.twm.lt/opt_in_change.php?deliver_id=' + id + '&value=1',
                success: function (data) {
                    var success_txt = $('#' + id + '_header').text() + ' was updated on the servers to have a delivery';
                    alert(success_txt);
                }
            });
        } else {
            $('#' + id + '_header').toggleClass("skipped_h1");
            document.getElementById(id + '_span').innerHTML = "Will Be Skipped";
            $('#' + id + '_span').toggleClass("active skipped");
            document.getElementById(id).innerHTML = "Undo skipping";
            $.ajax({
                type: "GET",
                url: 'http://yard.twm.lt/opt_in_change.php?deliver_id=' + id + '&value=0',
                success: function (data) {
                    var success_txt = $('#' + id + '_header').text() + ' was updated on the servers to NOT have a delivery';
                    alert(success_txt);
                }
            });
        }

    }
</script>
</body>
</html>