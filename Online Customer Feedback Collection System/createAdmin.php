<?php
// Include the database connection file
include_once("./databaseConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $full_name = $_POST["full_name"];
    $address = $_POST["address"];
    $age = $_POST["age"];
    $email = $_POST["email"];
    $user_name = $_POST["user_name"];
    $password = md5($_POST["password"]); // Encrypt password using MD5

    // Prepare and execute SQL statement to insert data
    $sql = "INSERT INTO admin (full_name, address, age, email, user_name, password) 
            VALUES ('$full_name', '$address', '$age', '$email', '$user_name', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to success page or wherever needed
        header('location: ./');
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
