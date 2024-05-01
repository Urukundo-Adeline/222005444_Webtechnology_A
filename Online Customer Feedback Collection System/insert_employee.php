<?php 
include_once("./databaseConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $employee_id = $_POST["employee_id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

    // Check if ID is provided for updating
    if ($employee_id != 'Auto') {
        $id = $employee_id;
        // Update data in the employees table
        $sql = "UPDATE employee SET First_name='$first_name', Last_name='$last_name', Email='$email', image='$image' WHERE Employee_ID=$id";
    } else {
        // Insert data into the employees table
        $sql = "INSERT INTO employee (First_name, Last_name, Email, image) 
                VALUES ('$first_name', '$last_name', '$email', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
        // Redirect to the employees page
        if ($employee_id != 'Auto') {
            header('location:./?page=employees&message=edit');
        } else {
            header('location:./?page=employees&message=insert');
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
