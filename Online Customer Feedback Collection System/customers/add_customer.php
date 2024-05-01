<?php 
include_once("./databaseConnection/connect.php");

$customer_id = "Auto";
$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$address = "";
$image = "";

if(isset($_GET['id'])) {
    $customer_id = $_GET['id'];
    $sql = "SELECT * FROM customer WHERE id = $customer_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['FirstName'];
        $last_name = $row['LastName'];
        $email = $row['Email'];
        $phone_number = $row['PhoneNumber'];
        $address = $row['Address'];
        $image = $row['image'];
    }
}
?>
<style>
 
</style>
<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Customer' : 'Add New Customer'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Customers</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Customer' : 'Add New Customer'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="customerForm" action="insert_customer.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="customer_id">Customer ID:</label>
            <input type="text" id="customer_id" name="customer_id" class="form-control" value="<?php echo $customer_id; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="form-control" value="<?php echo $first_name; ?>">
            <div id="first_name_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="form-control" value="<?php echo $last_name; ?>">
            <div id="last_name_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" class="form-control" value="<?php echo $email; ?>">
            <div id="email_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" class="form-control" value="<?php echo $phone_number; ?>">
            <div id="phone_number_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" class="form-control"><?php echo $address; ?></textarea>
            <div id="address_error" class="error-message"></div>
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
        var firstName = document.getElementById("first_name");
        var lastName = document.getElementById("last_name");
        var email = document.getElementById("email");
        var phoneNumber = document.getElementById("phone_number");
        var address = document.getElementById("address");
        var image = document.getElementById("image");

        // Validation for First Name
        if (firstName.value.trim() === "") {
            document.getElementById("first_name_error").textContent = "First Name is required";
            firstName.classList.add("error-border");
            firstName.focus();
            isValid = false;
        } else {
            document.getElementById("first_name_error").textContent = "";
            firstName.classList.remove("error-border");
        }

        // Validation for Last Name
        if (lastName.value.trim() === "") {
            document.getElementById("last_name_error").textContent = "Last Name is required";
            lastName.classList.add("error-border");
            lastName.focus();
            isValid = false;
        } else {
            document.getElementById("last_name_error").textContent = "";
            lastName.classList.remove("error-border");
        }

        // Validation for Email
        if (email.value.trim() === "") {
            document.getElementById("email_error").textContent = "Email is required";
            email.classList.add("error-border");
            email.focus();
            isValid = false;
        } else {
            document.getElementById("email_error").textContent = "";
            email.classList.remove("error-border");
        }

        // Validation for Phone Number
        if (phoneNumber.value.trim() === "") {
            document.getElementById("phone_number_error").textContent = "Phone Number is required";
            phoneNumber.classList.add("error-border");
            phoneNumber.focus();
            isValid = false;
        } else {
            document.getElementById("phone_number_error").textContent = "";
            phoneNumber.classList.remove("error-border");
        }

        // Validation for Address
        if (address.value.trim() === "") {
            document.getElementById("address_error").textContent = "Address is required";
            address.classList.add("error-border");
            address.focus();
            isValid = false;
        } else {
            document.getElementById("address_error").textContent = "";
            address.classList.remove("error-border");
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
                document.getElementById("customerForm").submit();
            }, 3000);
        }
    });
});
</script>
