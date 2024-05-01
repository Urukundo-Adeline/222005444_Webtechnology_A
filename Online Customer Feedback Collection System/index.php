<?php session_start(); ?>
<?php
if(!isset($_SESSION['id']))
{	
     header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        /* General Styles */
        .success-message {
            background-color: lightgreen;
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            margin-bottom: 20px;
            display: none; /* Initially hide the message */
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header Styles */
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        
        /* Navigation Styles */
        .breadcrumb {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            list-style-type: none;
            margin: 0;
            padding: 0;
        }
        
        .breadcrumb li {
            display: inline;
            margin-left: 10px;
        }
        
        .breadcrumb li i {
            margin: 0 5px;
        }
        
        /* Button Styles */
        .btn-add {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-left: auto; /* Pushes it to the right */
        }
        
        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
        
        /* Action Button Styles */
        .action-btn {
            display: inline-block;
            padding: 8px 12px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 3px;
            text-decoration: none;
            margin-right: 5px;
        }
        
        .action-btn.update {
            background-color: #17a2b8;
        }
        
        .action-btn.delete {
            background-color: #dc3545;
        }
            /* Form Styles */
 .container2 {
    width: 150%; /*   */
    margin: 20px auto; /*   */
}

/* Add   CSS for the page header */
.page {
    margin-bottom: 20px; /* Add some spacing between page header and form */
}

.page .left {
    width: 100%;
    text-align: center; /* Center the content within the page header */
}

.page h1 {
    margin-bottom: 10px; /* Add some spacing below the heading */
}

/* Rest of your existing CSS styles */


.form-group {
    margin-bottom: 20px;
}

label {
    font-weight: bold;
}

input[type="text"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 5px;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus {
    outline: none;
    border-color: #007bff; /* Blue border color on focus */
}

textarea {
    resize: vertical; /* Allow vertical resizing of textarea */
}

/* Button Styles */
.btn-submit,
.btn-reset {
    display: inline-block;
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.btn-submit {
    background-color: #007bff; /* Blue button color */
    color: #fff;
}

.btn-reset {
    background-color: #dc3545; /* Red button color */
    color: #fff;
}

.btn-submit:hover,
.btn-reset:hover {
    opacity: 0.8;
}

/* Error Message Styles */
.error-message {
    color: red;
    margin-top: 5px;
}

/* Loading Image Styles */
.loading-image {
    display: none;
    text-align: center;
}

.loading-image img {
    width: 50px;
    height: 50px;
}

    </style>
 
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
  </head>
  <body>
  <?php 
 $page = isset($_GET['page']) ? $_GET['page'] : 'HomePage';
 ?>
    <div class="grid-container">

      <!-- Header -->

      <?php include_once("includes/header.php"); ?>
      <!-- End Header -->

      <!-- Sidebar -->
 <?php include_once("includes/sideBar.php"); ?>
      <!-- End Sidebar -->

      <!-- Main -->
 

      <?php 
               if(is_file($page.'.php')){
                include $page.'.php';
            }else{
                if(is_dir($page) && is_file($page.'/index.php')){
                    include $page.'/index.php';
                }
          else{
                    if($page=='add_feedBack'){
                        include_once 'feedBack/'.$page.'.php';
                    }else if($page=='add_customer'){
                       include_once 'customers/'.$page.'.php';
                    }else if($page=='add_employee'){
                        include_once 'employees/'.$page.'.php';
                    }else if($page=='add_employee'){
                        include_once 'employees/'.$page.'.php';
                    }else iF($page=='add_product'){
                        include_once 'products/'.$page.'.php';
                    }else if($page=='add_order'){
                        include_once 'orders/'.$page.'.php';
                    }
                    else{
                    echo '<h4 class="text-center fw-bolder">Page Not Found</h4>';
                    }
                }
            }
            ?>
       <!-- End Main -->

    </div>
    <script>
    // JavaScript to hide the message after 3 seconds
    document.addEventListener("DOMContentLoaded", function() {
        var welcomeMessage = document.getElementById('welcomeMessage');

        setTimeout(function() {
            welcomeMessage.style.display = 'none';
        }, 3000);
    });
</script>

   </body>
</html>