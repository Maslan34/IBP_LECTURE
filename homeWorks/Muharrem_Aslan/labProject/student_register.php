<?php

//establish connection
include("baglanti.php");

// getting form data
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// creating  sql statement to create the students table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(255),
    gender ENUM('Male', 'Female')
)";

// executing the query
if (!$mysqli->query($createTableQuery)) {
    echo 'Table creation failed: (' . $mysqli->errno . ') ' . $mysqli->error;
}



// validation parts
$errors = array();

if (empty($fullName)) {
    $errors[] = 'Full Name is required';
}

if (empty($email)) {
    $errors[] = 'Email Address is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) { // This filter checks that wheter the email is appropriate form or not.
    $errors[] = 'Invalid Email Address';
}

if (empty($gender)) {
    $errors[] = 'Gender is required';
}

// inserting data into the database 
if (empty($errors)) {
    // preparing  the sql 
    $insertQuery = "INSERT INTO students (full_name, email, gender) VALUES (?, ?, ?)";

    $stmt = $mysqli->prepare($insertQuery);

    // executing the query
    if ($stmt->execute()) {
        echo 'Data inserted successfully!';
    } else {
        echo 'Error: (' . $stmt->errno . ') ' . $stmt->error;
    }

    // closing statement
    $stmt->close();
}
else 
{
    // printing errors
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}

// Lıstıng students ınformation

$conn = mysqli_connect($hostname, $username, $password, $database);
$query = "SELECT * FROM students";
$result = mysqli_query($conn, $query);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Full Name: " . $row["full_name"]. " - Email: " . $row["email"]. " - Gender: " . $row["gender"]. "<br>";
    }
} else {
    echo "Veritabanında hiç kayıt bulunamadı.";
}



?>
