<?php
// Establish connection to the database
$servername = "localhost";
$username = "Urukundo";
$password = "rukundo@123";
$dbname = "employee_database";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve employee records
$sql = "SELECT * FROM employees";
$result = $conn->query($sql);

// Display employee records
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Employee ID: " . $row["Employee_ID"]. " - Name: " . $row["First_name"]. " " . $row["Last_name"]. " - Email: " . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
