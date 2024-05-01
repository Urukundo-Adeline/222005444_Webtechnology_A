<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
<?php include_once("./databaseConnection/connect.php"); ?>

<div class="container">
    <div class="page">
        <div class="left">
            <h1>Products</h1>
            <ul class="breadcrumb">
                <li><a href="./?page=add_product">Manage Products</a></li>
                <li><i class='bx bx-chevron-right'></i></li>
                <li><a class="active" href="./">Home</a></li>
            </ul>
        </div>
    </div>

    <!-- Message Display -->
    <?php if(isset($_GET['message']) && ($_GET['message'] == 'edit' || $_GET['message'] == 'insert')): ?>
        <div id="successMessage" class="success-message">Record <?php echo $_GET['message']; ?>ed successfully!</div>
    <?php elseif(isset($_GET['message']) && $_GET['message'] == 'delete'): ?>
        <div id="successMessage" class="success-message">Record deleted successfully!</div>
    <?php endif; ?>

    <!-- Table Section -->
    <div class="Table">
        <div class="cardHeader">
            <a href="./?page=add_product" class="btn-add">
                <i class='button_add'></i>
                <span class="text">Add New Product</span>
            </a>
        </div>
        <table>
            <thead>
                <tr>
                    <th>Cnt</th>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch data from the product table
                $sql = "SELECT * FROM product";
                $result = $conn->query($sql);
                $x = 0;

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        $x++;
                        echo "<tr>";
                        echo "<td>".$x."</td>";
                        echo "<td><img src='images/".$row["image"]."' alt='Product Image' style='width: 50px; height: 50px; border-radius: 50%;'></td>";
                        echo "<td>".$row["Product_name"]."</td>";
                        echo "<td>".$row["Description"]."</td>";
                        echo "<td>".$row["price"]."</td>";
                        echo "<td>";
                        echo "<a href='./?page=add_product&id=".$row["Product_Id"]."' class='action-btn update'>Update</a>";
                        echo "<a href='delete.php?table=product&id=".$row["Product_Id"]."' class='action-btn delete'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<style>
    .success-message {
        opacity: 1;
        background-color: lightgreen;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    .loading-image {
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 9999;
        display: block;
    }

    .loading-image img {
        width: 100px;
        height: 100px;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Show loading image initially
    var loadingImage = document.getElementById('loadingImage');
    var dataTable = document.querySelector('.DataTable');

    setTimeout(function() {
        loadingImage.style.display = 'none';
        dataTable.style.display = 'block';
    }, 3000);
});
</script>
</body>
</html>
