
<?php 
	$servername="localhost";
	$username="test";
	$password="test";
	$db="ams";

	$conn = new mysqli($servername, $username, $password, $db);
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
