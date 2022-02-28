<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: index.php");
    exit;
}


$servername = "localhost";
$username = "u641509200_full";
$password = "Dobe1523!";
$dbname = "u641509200_yard";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$upcoming_deliveries_id = $_REQUEST["deliver_id"];
$wanted_value = $_REQUEST["value"];
$sql = "UPDATE `upcoming_deliveries` SET `opt_in`=$wanted_value WHERE `id`=$upcoming_deliveries_id;";
$conn->query($sql);
$conn->close();
?>