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

// Query to retrieve rating records
$sql = "SELECT * FROM rating";
$result = $conn->query($sql);

// Display rating records
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Customer ID: " . $row["CustomerID"]. " - Feedback Name: " . $row["Feedback_name"]. " - Rating Value: " . $row["Rating_Value"]. " - Date: " . $row["date"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
