<?php

header('Access-Control-Allow-Origin: *');

// Connect to database
$mysqli = new mysqli("localhost","root","","db2060275");
if ($mysqli -> connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
    exit();
}

include('import-data.php');


$sql = "SELECT *
    FROM weather 
    WHERE city ='{$_GET['city']}'
    AND weather_when >= DATE_SUB(NOW(), INTERVAL 10 SECOND)
    ORDER BY weather_when DESC limit 1";

$result = $mysqli -> query($sql);

//Error?
if($result == false){
    echo("<h4>SQL error description: " . $mysqli -> error . "</h4>");    
}

$row = $result -> fetch_assoc();
print json_encode($row);

// Free result set and close connection
$result -> free_result();
$mysqli -> close();
?>