<?php
// Establish connection to the database
$servername = "localhost";
$username = "Urukundo";
$password = "rukundo@123";
$dbname = "customer_feedback_collection";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to retrieve customer records
$sql = "SELECT * FROM customer";
$result = $conn->query($sql);

// Display customer records
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Customer ID: " . $row["CustID"]. " - Name: " . $row["FirstName"]. " " . $row["LastName"]. " - Email: " . $row["Email"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
