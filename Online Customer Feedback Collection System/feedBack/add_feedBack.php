<?php 
include_once("./databaseConnection/connect.php");

$feedback_id = "Auto";
$customer_name = "";
$feedback_text = "";
$rating = "";

if(isset($_GET['id'])) {
    $feedback_id = $_GET['id'];
    $sql = "SELECT * FROM feedback WHERE id = $feedback_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $customer_name = $row['customer_name'];
        $feedback_text = $row['feedback_text'];
        $rating = $row['rating'];
    }
}
?>
<style>
 
</style>
<div class="page">
    <div class="left">
        <h1><?php echo isset($_GET['id']) ? 'Edit Feedback' : 'Add New Feedback'; ?></h1>
        <ul class="breadcrumb">
            <li>
                <a href="#">Manage Feedback</a>
            </li>
            <li><i class='bx bx-chevron-right'></i></li>
            <li>
                <a class="active" href="#"><?php echo isset($_GET['id']) ? 'Edit Feedback' : 'Add New Feedback'; ?></a>
            </li>
        </ul>
    </div>
</div>

<div class="container2">
    <form id="feedbackForm" action="insert_feedback.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="feedback_id">Feedback ID:</label>
            <input type="text" id="feedback_id" name="feedback_id" class="form-control" value="<?php echo $feedback_id; ?>" readonly>
        </div>
        <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="customer_name" name="customer_name" class="form-control" value="<?php echo $customer_name; ?>">
            <div id="customer_name_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="feedback_text">Feedback Text:</label>
            <textarea id="feedback_text" name="feedback_text" class="form-control"><?php echo $feedback_text; ?></textarea>
            <div id="feedback_text_error" class="error-message"></div>
        </div>
        <div class="form-group">
            <label for="rating">Rating:</label>
            <input type="number" id="rating" name="rating" class="form-control" value="<?php echo $rating; ?>">
            <div id="rating_error" class="error-message"></div>
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
        var customerName = document.getElementById("customer_name");
        var feedbackText = document.getElementById("feedback_text");
        var rating = document.getElementById("rating");

        // Validation for Customer Name
        if (customerName.value.trim() === "") {
            document.getElementById("customer_name_error").textContent = "Customer Name is required";
            customerName.classList.add("error-border");
            customerName.focus();
            isValid = false;
        } else {
            document.getElementById("customer_name_error").textContent = "";
            customerName.classList.remove("error-border");
        }

        // Validation for Feedback Text
        if (feedbackText.value.trim() === "") {
            document.getElementById("feedback_text_error").textContent = "Feedback Text is required";
            feedbackText.classList.add("error-border");
            feedbackText.focus();
            isValid = false;
        } else {
            document.getElementById("feedback_text_error").textContent = "";
            feedbackText.classList.remove("error-border");
        }

        // Validation for Rating
        if (rating.value.trim() === "") {
            document.getElementById("rating_error").textContent = "Rating is required";
            rating.classList.add("error-border");
            rating.focus();
            isValid = false;
        } else {
            document.getElementById("rating_error").textContent = "";
            rating.classList.remove("error-border");
        }

        if (isValid) {
            // Show loading image
            document.getElementById("loader").style.display = "block";

            // Delay form submission for 3 seconds
            setTimeout(function() {
                // Submit the form
                document.getElementById("feedbackForm").submit();
            }, 3000);
        }
    });
});
</script>
