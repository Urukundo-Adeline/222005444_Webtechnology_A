
<?php

$databaseHost = 'localhost';
$databaseName = 'customer_feedback_collection';
$databaseUsername = 'root';
$databasePassword = '';

$conn = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName); 

if($conn){
	echo "";
}else {
	 echo "error while connectiong";
}
?>