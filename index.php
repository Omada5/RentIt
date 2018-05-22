<?php
session_start();

if (isset($_POST['user']) && isset($_POST['pass'])) {


$user = $_POST['user'];
$pass = $_POST['pass'];



$conn = new mysqli("localhost", "root", "", "rentit");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
   mysqli_set_charset($conn,"utf8");

   	$stmt = $conn->prepare("SELECT `id`, `password` FROM `users` WHERE `username`=?");
$stmt->bind_param( "s", $user); 

$stmt->execute();
   $stmt->store_result();

   
   $num_of_rows = $stmt->num_rows;
    
   $stmt->bind_result($id, $password);
   
   if ($num_of_rows == 1) {
  $stmt->fetch();

  
  if (password_verify($pass, $password)) {
	  
				
			session_regenerate_id(true);

			ini_set('session.cookie_httponly', 1);
			ini_set('session.use_only_cookies', 1);
			//ini_set('session.cookie_secure', 1);
	  
	  
			$_SESSION["id"] = $id;
			
			
				   					 header('Location: ./home.php');

	  
	  
  }
  else {
	  
	  
	  	form();
	?>
	
	<script>
	
	alert('Wrong username or password.');
	
	</script>
	
	<?php
	
	  
  }  
  
  
  
  
  
}
else if ($num_of_rows == 0) {
	
	form();
	?>
	
	<script>
	
	alert('Wrong username or password.');
	
	</script>
	
	<?php
	
}
 else {
	 
	 form();
	 
 }

   
   
   $stmt->close();




   
   
   

}
else if (isset($_SESSION["id"])) {
	
	
	header('Location: ./home.php');
	die();
	
}
else {


form();


}






function form() {
	
?>

<html>

<head>

<title>RentIt</title>
</head>

<body>


 <form action="./index.php" method="post">
  Username:<br>
  <input type="text" name="user" required><br>
  Password:<br>
  <input type="password" name="pass" required><br><br>
  <input type="submit" value="Submit">
</form> 



</body>

</html>

<?php
	
}

?>