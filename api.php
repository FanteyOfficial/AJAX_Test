<?php

//read post param
$param = $_GET["t"];

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
    echo $r[1] . "<br>";
}

$conn->close();
?>