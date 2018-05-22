<?php
require_once('./validation.php'); 


header('Content-type: application/json');

if (isset($_POST['sub_date']) && isset($_POST['sub_date2']) && isset($_POST['model']) && isset($_POST['yearfrom']) && isset($_POST['yearto']) && isset($_POST['hpfrom']) && isset($_POST['hpto']) && isset($_POST['litresfrom']) && isset($_POST['litresto']) && isset($_POST['gps']) && isset($_POST['isofix'])) {


$sub_date= $_POST['sub_date'];
$sub_date2= $_POST['sub_date2'];
$model= $_POST['model'];
$yearfrom= $_POST['yearfrom'];
$yearto= $_POST['yearto'];
$hpfrom= $_POST['hpfrom'];
$hpto= $_POST['hpto'];
$litresfrom= $_POST['litresfrom'];
$litresto= $_POST['litresto'];
$gps= $_POST['gps'];
$isofix= $_POST['isofix'];


$where = '1';


   	$stmt = $conn->prepare("SELECT `car_id` FROM `rents` WHERE `pickup_date`<=? AND `return_date`>=?");
$stmt->bind_param( "ss", $sub_date2, $sub_date); 

$stmt->execute();
   $stmt->store_result();

   $car_id_data = '';
    
   $stmt->bind_result($car_id);
   
  while ($stmt->fetch()) {
	   
	  $car_id_data = $car_id_data.' AND id!='.$car_id.'';
	  
	  
  }
$stmt->close();

$where = $where.$car_id_data;

if (strlen($model) > 0)
	$where=$where." AND model LIKE '%".$model."%'";

if (strlen($yearfrom) > 0)
	$where=$where." AND `year`>=".$yearfrom."";

if (strlen($yearto) > 0)
	$where=$where." AND `year`<=".$yearto."";


if (strlen($hpfrom) > 0)
	$where=$where." AND `hp`>=".$hpfrom."";

if (strlen($hpto) > 0)
	$where=$where." AND `hp`<=".$hpto."";

if (strlen($litresfrom) > 0)
	$where=$where." AND `litres`>=".$litresfrom."";

if (strlen($litresto) > 0)
	$where=$where." AND `litres`<=".$litresto."";

if ($gps == 1)
	$where=$where." AND `gps`=1";

if ($isofix == 1)
	$where=$where." AND `isofix`=1";


$data = '';
if (isset($_POST['brands'])) {
	$data_input= $_POST['brands'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR brand='".$data_value."'";
}
$data = $data.')';
	}
}
$where=$where.$data;



$data = '';
if (isset($_POST['typos'])) {
	$data_input= $_POST['typos'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR type=".$data_value."";
}
$data = $data.')';
	}
}
$where=$where.$data;





$data = '';
if (isset($_POST['fuel'])) {
	$data_input= $_POST['fuel'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR fuel=".$data_value."";
}
$data = $data.')';
	}
}
$where=$where.$data;





$data = '';
if (isset($_POST['seats'])) {
	$data_input= $_POST['seats'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR seats=".$data_value."";
}
$data = $data.')';
	}
}
$where=$where.$data;



$data = '';
if (isset($_POST['sasman'])) {
	$data_input= $_POST['sasman'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR transmission=".$data_value."";
}
$data = $data.')';
	}
}
$where=$where.$data;


$data = '';
if (isset($_POST['place'])) {
	$data_input= $_POST['place'];
	if (!empty($data_input)) {
		$data = ' AND (0';
foreach ($data_input as $data_value) {
$data = $data." OR place=".$data_value."";
}
$data = $data.')';
	}
}
$where=$where.$data;


   	$stmt = $conn->prepare("SELECT * FROM `cars` WHERE $where");

$stmt->execute();
   $stmt->store_result();

    
   $stmt->bind_result($id, $brand, $model, $year, $fuel, $seats, $transmission, $gps, $isofix, $hp, $litres, $type, $place);

   $json = [];	  
  while ($stmt->fetch()) {
	  
	  
        $json[] = array('id'=>$id, 'brand'=>$brand, 'model'=>$model, 'year'=>$year, 'fuel'=>$fuel, 'seats'=>$seats, 'transmission'=>$transmission, 'gps'=>$gps, 'isofix'=>$isofix, 'hp'=>$hp, 'litres'=>$litres, 'type'=>$type, 'place'=>$place);
	  
	  
  }
$stmt->close();
 
echo(json_encode($json));


}
else {
	
	
	die("Error");
	
	
}

?>