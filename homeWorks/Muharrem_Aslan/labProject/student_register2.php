<?php
// Database connection details
$hostname = 'localhost'; // Replace with your MySQL server host
$username = 'root'; // Replace with your MySQL username
$password = ''; // Replace with your MySQL password
$database = 'student'; // Replace with your MySQL database name

// Create a connection to MySQL
$mysqli = new mysqli($hostname, $username, $password, $database);

// Check if the connection was successful
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Prepare the SQL statement to create the "students" table if it doesn't exist
$createTableQuery = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(255),
    gender ENUM('Male', 'Female')
)";

// Execute the create table query
if (!$mysqli->query($createTableQuery)) {
    echo 'Table creation failed: (' . $mysqli->errno . ') ' . $mysqli->error;
}

// Validate form data
$fullName = $_POST['full_name'];
$email = $_POST['email'];
$gender = $_POST['gender'];

// Perform server-side validation
$errors = array();

if (empty($fullName)) {
    $errors[] = 'Full Name is required';
}

if (empty($email)) {
    $errors[] = 'Email Address is required';
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Invalid Email Address';
}

if (empty($gender)) {
    $errors[] = 'Gender is required';
}

// Insert data into the database if there are no validation errors
if (empty($errors)) {
    // Prepare the SQL statement to insert data into the "students" table
    $insertQuery = "INSERT INTO students (full_name, email, gender) VALUES (?, ?, ?)";

    // Create a prepared statement
    $stmt = $mysqli->prepare($insertQuery);

    // Bind the parameters to the prepared statement
    $stmt->bind_param('sss', $fullName, $email, $gender);

    // Execute the prepared statement
    if ($stmt->execute()) {
        echo 'Data inserted successfully!<br>';
        echo 'Current Informatıon ıs above!<br>';
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
    } else {
        echo 'Error: (' . $stmt->errno . ') ' . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
else 
{
    // Display validation errors
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
}


// Close the database connection
$mysqli->close();
?>