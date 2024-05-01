<?php 
include_once("./databaseConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $customer_id = $_POST["customer_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

    // Check if ID is provided for updating
    if ($customer_id != 'Auto') {
        $id = $customer_id;
        // Update data in the customers table
        $sql = "UPDATE customer SET FirstName='$first_name', LastName='$last_name', Email='$email', PhoneNumber='$phone_number', Address='$address', image='$image' WHERE id=$id";
    } else {
        // Insert data into the customers table
        $sql = "INSERT INTO customer (FirstName, LastName, Email, PhoneNumber, Address, image) 
                VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
        // Redirect to the customers page
        if ($customer_id != 'Auto') {
            header('location:./?page=customers&message=edit');
        } else {
            header('location:./?page=customers&message=insert');
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
