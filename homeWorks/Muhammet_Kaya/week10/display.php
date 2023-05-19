<!-- display.php -->
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "studentregistration";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Error connecting to the database. " . $conn->connect_error);
    }

    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Full Name</th><th>E-posta</th><th>Gender</th></tr>";
        
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>".$row["id"]."</td>";
            echo "<td>".$row["fullname"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["gender"]."</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    } else {
        echo "There are no registered students.";
    }

    $conn->close();
?>
