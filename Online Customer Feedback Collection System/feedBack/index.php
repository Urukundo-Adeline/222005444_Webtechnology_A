<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeedBack</title>
 
</head>
<body>
 <?php include_once("./databaseConnection/connect.php");
 ?>
    <div class="container">
         <div class="page">
            <div class="left">
                <h1> FeedBack</h1>
                <ul class="breadcrumb">
                    <li><a href="./?page=add_feedBack">Manage FeedBack</a></li>
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
                
                <a href="./?page=add_feedBack" class="btn-add">
                    <i class='button_add'></i>
                    <span class="text">Add New FeedBack</span>
                </a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Cnt</th>
                        <th>Customer Names</th>
                        <th>FeedBack Message</th>
                        <th>Rating</th>
                        <th>Rate</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch data from the sales table
                    // Modify the PHP code to fit your needs
                    ?>
                    <tr>
                    <?php
            // Fetch data from the sales table
            $sql = "SELECT * FROM feedback order by id desc";
            $result = $conn->query($sql);
            $x = 0;

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    $x++;
                    echo "<tr>";
                    echo "<td>".$x."</td>";
                    echo "<td>".$row["customer_name"]."</td>";
                    echo "<td>".$row["feedback_text"]."</td>";
                    echo "<td>".$row["rating"]."</td>";
                    echo "<td>".$row["submission_date"]."</td>";
                   
               echo" <td>  <a href='./?page=add_feedBack&id=".$row["id"]."' class='action-btn update'>Update</a>";
               echo "<a href='delete.php?table=feedback&id=".$row["id"]."' class='action-btn delete'>Delete</a>";
               echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found</td></tr>";
            }
            ?>
                    </tr>
                    <!-- Repeat the above row structure for each record -->
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

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
