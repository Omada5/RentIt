<?php
session_start();

if (isset($_SESSION["id"])) {
	
	$id = $_SESSION["id"];
	
	if (strlen($id) > 0) {
		
		
		
		$conn = new mysqli("localhost", "root", "", "rentit");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   mysqli_set_charset($conn,"utf8");

		
		
		
		
	}
else {

				header('Location: ./logout.php');
die();

}	

}
else {
	
	
					header('Location: ./logout.php');
die();
	
}


?>