<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentregistration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Error connecting to the database.".$conn->connect_error);
    }
    

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO student (fullname, email, gender) VALUES ('$fullname', '$email', '$gender')";

    if($conn->query($sql) === TRUE){
        echo "The data has been successfully recorded.";
    }else{
        echo "An error occurred during the saving process: ".$conn->error;
    }

    $conn->close();
    
?>