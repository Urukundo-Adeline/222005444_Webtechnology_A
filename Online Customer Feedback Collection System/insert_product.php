<?php 
include_once("./databaseConnection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $image = isset($_FILES['image']['name']) ? $_FILES['image']['name'] : '';

    // Check if ID is provided for updating
    if ($product_id != 'Auto') {
        $id = $product_id;
        // Update data in the products table
        $sql = "UPDATE product SET Product_name='$product_name', Description='$description', Price='$price', image='$image' WHERE Product_Id=$id";
    } else {
        // Insert data into the products table
        $sql = "INSERT INTO product (Product_name, Description, Price, image) 
                VALUES ('$product_name', '$description', '$price', '$image')";
    }

    if ($conn->query($sql) === TRUE) {
        if (!empty($_FILES['image']['tmp_name'])) {
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
        // Redirect to the products page
        if ($product_id != 'Auto') {
            header('location:./?page=products&message=edit');
        } else {
            header('location:./?page=products&message=insert');
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
} 
?>
