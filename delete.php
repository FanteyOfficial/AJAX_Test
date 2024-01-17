<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mastroianni";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the user ID from the GET parameters
$userId = $_POST['id'];

// Delete the user from the database
$sql = "DELETE FROM `esempio` WHERE `id` = $userId";

if ($conn->query($sql) === TRUE) {
    echo "User deleted successfully";
} else {
    echo "Error deleting user: " . $conn->error;
}

$conn->close();

?>
