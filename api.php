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

$rows = array();
foreach ($res as $r) {
    $rows[] = array('id' => $r[0], 'user' => $r[1]);
}

echo json_encode($rows);

$conn->close();

?>
