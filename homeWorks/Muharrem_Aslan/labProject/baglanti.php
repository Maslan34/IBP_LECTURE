<?php
// database connection 
$hostname = 'localhost'; 
$username = 'root'; 
$password = ''; 
$database = 'student'; 


// creating a php connection
$mysqli = new mysqli($hostname, $username, $password, $database);

// checking if connection is established
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}else{
    echo "Başarılı";
    $mysqli->close();
}

// closing connection

    
?>