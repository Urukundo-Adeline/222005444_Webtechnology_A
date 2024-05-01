<?php 
include_once("./databaseConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $feedback_id = $_POST["feedback_id"];
    $customer_name = $_POST["customer_name"];
    $feedback_text = $_POST["feedback_text"];
    $rating = $_POST["rating"];

    // Check if ID is provided for updating
    if ($feedback_id != 'Auto') {
        // Update data in the feedback table
        $sql = "UPDATE feedback SET customer_name='$customer_name', feedback_text='$feedback_text', rating='$rating' WHERE id=$feedback_id";
    } else {
        // Insert data into the feedback table
        $sql = "INSERT INTO feedback (customer_name, feedback_text, rating) 
                VALUES ('$customer_name', '$feedback_text', '$rating')";
        $sql2 = "INSERT INTO rating (Customer_ID, Feedback_name , Rating_value) 
                        VALUES ('$customer_name', '$feedback_text', '$rating')";
        
    }

    if ($conn->query($sql) === TRUE) {
        // Redirect to the feedback page
        if ($feedback_id != 'Auto') {
            header('location:./?page=feedBack&message=edit');
        } else {
            if ($conn->query($sql2) === TRUE) {

            header('location:./?page=feedBack&message=insert');
            }
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
