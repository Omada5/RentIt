<?php
require_once('./validation.php'); 



if (isset($_POST['sub_date']) && isset($_POST['sub_date2']) && isset($_POST['onomate']) && isset($_POST['ident']) && isset($_POST['age']) && isset($_POST['balance']) && isset($_POST['sub_carid'])) {


$sub_date= $_POST['sub_date'];
$sub_date2= $_POST['sub_date2'];
$onomate= $_POST['onomate'];
$ident= $_POST['ident'];
$age= $_POST['age'];
$balance= $_POST['balance'];
$sub_carid = $_POST['sub_carid'];


			$stmt = $conn->prepare("INSERT INTO `rents`(`pickup_date`, `return_date`, `car_id`, `ident`, `name`, `age`, `balance`) VALUES (?,?,?,?,?,?,?)");
$stmt->bind_param("ssissid", $sub_date, $sub_date2, $sub_carid, $ident, $onomate, $age, $balance);

$stmt->execute();

$stmt->close();		

echo '1';


}
else {
	
	
	die("Error");
	
	
}

?>