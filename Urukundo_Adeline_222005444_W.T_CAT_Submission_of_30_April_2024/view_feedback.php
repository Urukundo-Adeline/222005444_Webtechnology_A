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

// Query to retrieve feedback records
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

// Display feedback records
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id"]. " - Feedback: " . $row["feedback_text"]. " - Rating: " . $row["rating"]. " - Submission Date: " . $row["submission_date"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
