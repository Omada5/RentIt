<?php
require_once('./validation.php'); 



if (isset($_POST['brands']) && isset($_FILES["image_upload"]["name"]) && isset($_POST['model']) && isset($_POST['year']) && isset($_POST['typos']) && isset($_POST['fuel']) && isset($_POST['seats']) && isset($_POST['sasman']) && isset($_POST['hp']) && isset($_POST['litres']) && isset($_POST['place'])) {
	
	if (isset($_POST['gps']))
		$gps = 1;
	else
		$gps = 0;
	
	
	if (isset($_POST['isofix']))
		$isofix=1;
	else
		$isofix=0;
	
	
	$brands = $_POST['brands'];
	$model = $_POST['model'];
	$year = $_POST['year'];
	$typos = $_POST['typos'];
	$fuel = $_POST['fuel'];
	$seats = $_POST['seats'];
	$sasman = $_POST['sasman'];
	$hp = $_POST['hp'];
	$litres = $_POST['litres'];
	$place = $_POST['place'];

	
 $name = $_FILES["image_upload"]["name"];
 $size = $_FILES["image_upload"]["size"];
 $ext = explode(".", $name);
 $ext = end($ext);
 $allowed_ext = array("png");
 if(in_array($ext, $allowed_ext))
 {
  if($size < (1024*1024))
  {
	  
			$stmt = $conn->prepare("INSERT INTO `cars`(`brand`, `model`, `year`, `fuel`, `seats`, `transmission`, `gps`, `isofix`, `hp`, `litres`, `type`, `place`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssiiiiiiiiii", $brands, $model, $year, $fuel, $seats, $sasman, $gps, $isofix, $hp, $litres, $typos, $place);

$stmt->execute();
  $last_id = $conn->insert_id;

$stmt->close();		


   $new_image = '';
   $new_name = $last_id.'.'.$ext;
   $path = 'img/cars/' . $new_name;
   list($width, $height) = getimagesize($_FILES["image_upload"]["tmp_name"]);
   if($ext == 'png')
   {
    $new_image = imagecreatefrompng($_FILES["image_upload"]["tmp_name"]);
   }
   if($ext == 'jpg' || $ext == 'jpeg')  
            {  
               $new_image = imagecreatefromjpeg($_FILES["image_upload"]["tmp_name"]);  
            }
            $new_width=380;
            $new_height = ($height/$width)*380;
            $tmp_image = imagecreatetruecolor($new_width, $new_height);
			if ($ext == 'png') {
				
				        $background = imagecolorallocate($new_image, 255, 255, 255);
        // removing the black from the placeholder
        imagecolortransparent($new_image, $background);

        // turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
        imagealphablending($new_image, false);

        // turning on alpha channel information saving (to ensure the full range of transparency is preserved)
        imagesavealpha($new_image, true);

		
        $background = imagecolorallocate($tmp_image, 255, 255, 255);
        // removing the black from the placeholder
        imagecolortransparent($tmp_image, $background);

        // turning off alpha blending (to ensure alpha channel information is preserved, rather than removed (blending with the rest of the image in the form of black))
        imagealphablending($tmp_image, false);

        // turning on alpha channel information saving (to ensure the full range of transparency is preserved)
        imagesavealpha($tmp_image, true);
			}
            imagecopyresampled($tmp_image, $new_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			if ($ext == 'png') {
    imagepng($tmp_image,$path);		
	}
			else {
            imagejpeg($tmp_image, $path, 100);
			}

            imagedestroy($tmp_image);
			
			
			

            imagedestroy($new_image);
			

			header("Location: ./home.php");
			

  }
  else
  {
   echo 'Image File size must be less than 1 MB';
   header( "refresh:3;url=./add_car.php" );
  }
 }
 else
 {
  echo 'Invalid Image File';
     header( "refresh:3;url=./add_car.php" );

 }

	

	
}

else {

?>


<html>
<body>
<meta charset="UTF-8">

<center>

<div style="display:inline-block;vertical-align: middle;text-align:left;
-webkit-box-shadow: 0px 0px 8px -1px rgba(0,0,0,0.75);
-moz-box-shadow: 0px 0px 8px -1px rgba(0,0,0,0.75);
  box-shadow: 0 3px 6px rgba(0,0,0,0.16), 0 3px 6px rgba(0,0,0,0.23); padding: 8px; border-radius:6px;">
  
  <form method="post" action="./add_car.php" id="upload_image" enctype="multipart/form-data">
  
<div style="display:inline-block; font-family:Helvetica, sans-serif; text-align:left;">

Φωτογραφία:     <input type="file" id="file_up" name="image_upload" id="image_upload" required/>

<br><br>

Μάρκα: 
<select id="brands" class="" name="brands" required>
  <optgroup label="Μάρκα">

<option value="Abarth">Abarth</option>
<option value="AC">AC</option>
<option value="Acura">Acura</option>
<option value="Aixam">Aixam</option>
<option value="AlfaRomeo">AlfaRomeo</option>
<option value="ALPINA">ALPINA</option>
<option value="Artega">Artega</option>
<option value="AsiaMotors">AsiaMotors</option>
<option value="AstonMartin">AstonMartin</option>
<option value="Audi">Audi</option>
<option value="Austin">Austin</option>
<option value="AustinHealey">AustinHealey</option>
<option value="Bentley">Bentley</option>
<option value="BMW">BMW</option>
<option value="Borgward">Borgward</option>
<option value="Brilliance">Brilliance</option>
<option value="Bugatti">Bugatti</option>
<option value="Buick">Buick</option>
<option value="Cadillac">Cadillac</option>
<option value="Casalini">Casalini</option>
<option value="Caterham">Caterham</option>
<option value="Chatenet">Chatenet</option>
<option value="Chevrolet">Chevrolet</option>
<option value="Chrysler">Chrysler</option>
<option value="Citroën">Citroën</option>
<option value="Cobra">Cobra</option>
<option value="Corvette">Corvette</option>
<option value="Dacia">Dacia</option>
<option value="Daewoo">Daewoo</option>
<option value="Daihatsu">Daihatsu</option>
<option value="DeTomaso">DeTomaso</option>
<option value="Dodge">Dodge</option>
<option value="Donkervoort">Donkervoort</option>
<option value="DSAutomobiles">DSAutomobiles</option>
<option value="Ferrari">Ferrari</option>
<option value="Fiat">Fiat</option>
<option value="Fisker">Fisker</option>
<option value="Ford">Ford</option>
<option value="GACGonow">GACGonow</option>
<option value="Gemballa">Gemballa</option>
<option value="GMC">GMC</option>
<option value="Grecav">Grecav</option>
<option value="Hamann">Hamann</option>
<option value="Holden">Holden</option>
<option value="Honda">Honda</option>
<option value="Hummer">Hummer</option>
<option value="Hyundai">Hyundai</option>
<option value="Infiniti">Infiniti</option>
<option value="Isuzu">Isuzu</option>
<option value="Iveco">Iveco</option>
<option value="Jaguar">Jaguar</option>
<option value="Jeep">Jeep</option>
<option value="Kia">Kia</option>
<option value="Koenigsegg">Koenigsegg</option>
<option value="KTM">KTM</option>
<option value="Lada">Lada</option>
<option value="Lamborghini">Lamborghini</option>
<option value="Lancia">Lancia</option>
<option value="LandRover">LandRover</option>
<option value="Landwind">Landwind</option>
<option value="Lexus">Lexus</option>
<option value="Ligier">Ligier</option>
<option value="Lincoln">Lincoln</option>
<option value="Lotus">Lotus</option>
<option value="Mahindra">Mahindra</option>
<option value="Maserati">Maserati</option>
<option value="Maybach">Maybach</option>
<option value="Mazda">Mazda</option>
<option value="McLaren">McLaren</option>
<option value="Mercedes-Benz">Mercedes-Benz</option>
<option value="MG">MG</option>
<option value="Microcar">Microcar</option>
<option value="MINI">MINI</option>
<option value="Mitsubishi">Mitsubishi</option>
<option value="Morgan">Morgan</option>
<option value="Nissan">Nissan</option>
<option value="NSU">NSU</option>
<option value="Oldsmobile">Oldsmobile</option>
<option value="Opel">Opel</option>
<option value="Pagani">Pagani</option>
<option value="Peugeot">Peugeot</option>
<option value="Piaggio">Piaggio</option>
<option value="Plymouth">Plymouth</option>
<option value="Pontiac">Pontiac</option>
<option value="Porsche">Porsche</option>
<option value="Proton">Proton</option>
<option value="Renault">Renault</option>
<option value="Rolls-Royce">Rolls-Royce</option>
<option value="Rover">Rover</option>
<option value="Ruf">Ruf</option>
<option value="Saab">Saab</option>
<option value="Santana">Santana</option>
<option value="Seat">Seat</option>
<option value="Skoda">Skoda</option>
<option value="Smart">Smart</option>
<option value="speedART">speedART</option>
<option value="Spyker">Spyker</option>
<option value="Ssangyong">Ssangyong</option>
<option value="Subaru">Subaru</option>
<option value="Suzuki">Suzuki</option>
<option value="Talbot">Talbot</option>
<option value="Tata">Tata</option>
<option value="TECHART">TECHART</option>
<option value="Tesla">Tesla</option>
<option value="Toyota">Toyota</option>
<option value="Trabant">Trabant</option>
<option value="Triumph">Triumph</option>
<option value="TVR">TVR</option>
<option value="Volkswagen">Volkswagen</option>
<option value="Volvo">Volvo</option>
<option value="Wartburg">Wartburg</option>
<option value="Westfield">Westfield</option>
<option value="Wiesmann">Wiesmann</option>

</optgroup>

</select>

Μοντέλο: <input type="text" id="model" name="model" size="25" required>

Χρονολογία: <input type="number" id="year" name="year" size="10"  min="0" max="99" required>


  Τύπος Οχήματος: <select id="typos" name="typos">
  <optgroup label="Όχημα">
   <option value="1">Κόμπακτ</option>
   	<option value="2">Sedan</option>
    <option value="3">Convertable</option>
	<option value="4">SUV</option>
	<option value="5">Mini Bus</option>
	<option value="6">Luxury</option>
    
  </optgroup>
  
</select>

<br><br>


Καύσιμο: <select id="fuel" class="" name="fuel" required>
  <optgroup label="Καύσιμο">

<option value="1">Βενζίνη</option>
<option value="2">Πετρέλαιο</option>
<option value="3">Αέριο LPG</option>
</optgroup>
</select>

Θέσεις: 
<select name="seats" id="seats" required>
  <optgroup label="Θέσεις">

                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
				  </optgroup>
	
                </select>

				
 Σασμάν: <select id="sasman" name="sasman" required>
  <optgroup label="Σασμάν">
    <option value="0" selected>Αυτόματο</option>
	<option value="1">Xειροκίνητο</option>
    
  </optgroup>
  
</select>

<br><br>


 Ίπποι: <input type="text" id="hp" name="hp" size="10" required>
 
  Κυβικά: <input type="text" id="litres" name="litres" size="10" required>
				
			<br><br>

GPS: <input id="gps" name="gps" type="checkbox">			
		Isofix: <input id="isofix" name="isofix" type="checkbox">			
		Περιοχή: <select id="place" name="place" required>
  <optgroup label="Περιοχή">
    <option value="1">Θεσσαλονίκη, Κέντρο</option>
    
  </optgroup>
  
</select>

		

<br><br>

</div>
</center>
<br>
<hr style="border-bottom: 1px solid #989898;">




<div id="cash_compl" style="text-align:center;">
<br>



<input type="submit" value="ΟΛΟΚΛΗΡΩΣΗ"/>
<br>
</div>
   </form>

</div>


</body>

</html>

<?php

}

?>