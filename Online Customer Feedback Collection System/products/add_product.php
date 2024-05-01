<?php 
include_once("./databaseConnection/connect.php");

$product_id = "Auto";
$product_name = "";
$description = "";
$price = "";
$image = "";

if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $sql = "SELECT * FROM product WHERE Product_Id = $product_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $product_name = $row['Product_name'];
        $description = $row['Description'];
        $price = $row['Price'];
        $image = $row['image'];
    }
}
?>
<style>
 
</style>
<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Product' : 'Add New Product'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Products</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Product' : 'Add New Product'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="productForm" action="insert_product.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" class="form-control" value="<?php echo $product_id; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" id="product_name" name="product_name" class="form-control" value="<?php echo $product_name; ?>">
            <div id="product_name_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control"><?php echo $description; ?></textarea>
            <div id="description_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" class="form-control" value="<?php echo $price; ?>">
            <div id="price_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" accept="image/*" class="form-control">
            <div id="image_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <button type="button" id="submitBtn" class="btn-submit">Submit</button>
            <button type="reset" class="btn-reset">Reset</button>
        </div>
    </form>
</div>

<div id="loader" class="loading-image" style="display: none;">
    <img src="images/loadin.gif" alt="Loading...">
</div>

<style>
    .error-message {
        color: red;
    }
    .error-border {
        border: 1px solid red;
    }
    .loading-image {
        display: none;
    }
</style>

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("submitBtn").addEventListener("click", function(event) {
        var isValid = true;
        var productName = document.getElementById("product_name");
        var description = document.getElementById("description");
        var price = document.getElementById("price");
        var image = document.getElementById("image");

        // Validation for Product Name
        if (productName.value.trim() === "") {
            document.getElementById("product_name_error").textContent = "Product Name is required";
            productName.classList.add("error-border");
            productName.focus();
            isValid = false;
        } else {
            document.getElementById("product_name_error").textContent = "";
            productName.classList.remove("error-border");
        }

        // Validation for Description
        if (description.value.trim() === "") {
            document.getElementById("description_error").textContent = "Description is required";
            description.classList.add("error-border");
            description.focus();
            isValid = false;
        } else {
            document.getElementById("description_error").textContent = "";
            description.classList.remove("error-border");
        }

        // Validation for Price
        if (price.value.trim() === "") {
            document.getElementById("price_error").textContent = "Price is required";
            price.classList.add("error-border");
            price.focus();
            isValid = false;
        } else {
            document.getElementById("price_error").textContent = "";
            price.classList.remove("error-border");
        }

        // Validation for Image
        if (image.value.trim() === "") {
            document.getElementById("image_error").textContent = "Image is required";
            image.classList.add("error-border");
            image.focus();
            isValid = false;
        } else {
            // Check if the uploaded file is an image
            var fileExtension = image.value.split('.').pop().toLowerCase();
            if (fileExtension !== "jpg" && fileExtension !== "jpeg" && fileExtension !== "png" && fileExtension !== "gif") {
                document.getElementById("image_error").textContent = "Please upload a valid image file";
                image.classList.add("error-border");
                image.focus();
                isValid = false;
            } else {
                document.getElementById("image_error").textContent = "";
                image.classList.remove("error-border");
            }
        }

        if (isValid) {
            // Show loading image
            document.getElementById("loader").style.display = "block";

            // Delay form submission for 3 seconds
            setTimeout(function() {
                // Submit the form
                document.getElementById("productForm").submit();
            }, 3000);
        }
    });
});
</script>
