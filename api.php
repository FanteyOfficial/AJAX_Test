<?php

//read post param
$param = $_POST["t"];

//connect to db
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mastroianni";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

//query
$sql = "SELECT * FROM `esempio` WHERE `nome` LIKE '%$param%'";

//execute query
$result = $conn->query($sql);

$res = $result->fetch_all();
foreach ($res as $r) {
    echo '<div class="user">' . $r[1] . ' <button class="delete-btn" data-id="' . $r[0] . '">Delete</button></div>';
}

?>
