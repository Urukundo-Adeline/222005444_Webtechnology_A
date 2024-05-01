<?php 
include_once("./databaseConnection/connect.php");

$employee_id = "Auto";
$first_name = "";
$last_name = "";
$email = "";
$image = "";

if(isset($_GET['id'])) {
    $employee_id = $_GET['id'];
    $sql = "SELECT * FROM employee WHERE Employee_ID = $employee_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $first_name = $row['First_name'];
        $last_name = $row['Last_name'];
        $email = $row['Email'];
        $image = $row['image'];
    }
}
?>
<style>
 
</style>
<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add New Employee'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Employees</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Employee' : 'Add New Employee'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="employeeForm" action="insert_employee.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="employee_id">Employee ID:</label>
            <input type="text" id="employee_id" name="employee_id" class="form-control" value="<?php echo $employee_id; ?>" readonly>
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
                document.getElementById("employeeForm").submit();
            }, 3000);
        }
    });
});
</script>
