<?php
require_once('./validation.php'); 









?>

<html>

<body>

  <script src="jquery.min.js"></script>

  <link rel="stylesheet" href="jquery-ui.css">
  <script src="jquery-ui.js"></script>

<link rel="stylesheet" href="w3.css">

  
</body>


<script>
 var typos_txt = ["Κόμπακτ", "Sedan", "Convertable", "SUV", "Mini Bus", "Luxury"]; 
  var fuel_txt = ["Βενζίνη", "Πετρέλαιο", "Αέριο LPG"]; 
  var sasman_txt = ["Αυτόματο", "Xειροκίνητο"]; 
  var place_txt = ["Θεσσαλονίκη, Κέντρο"]; 
  var gps_txt = ["Οχι", "Ναι"]; 
  var isofix_txt = ["Οχι", "Ναι"]; 

 
$( function() {
    $( "#signa_datepicker" ).datepicker({     altField: "#signa",
      altFormat: "DD, d MM, yy",  onSelect: function() {
    
	var date = $( "#signa_datepicker" ).datepicker( "getDate" );

		$('#signa_datepicker2').datepicker("setDate", date);      

		$('#signa_datepicker2').datepicker('option', 'minDate', date);
		
	    	   document.getElementById("datepicker_display").style.display = "none";  

  }});
      
$('#signa_datepicker').datepicker("setDate", new Date()); 



    $( "#signa_datepicker2" ).datepicker({   altField: "#signa2",
      altFormat: "DD, d MM, yy",  onSelect: function() {
    	   document.getElementById("datepicker_display2").style.display = "none";  
	
  }});
      		$('#signa_datepicker2').datepicker('option', 'minDate', new Date());

$('#signa_datepicker2').datepicker("setDate", new Date()); 





});

		function datepicker_show() {

	   document.getElementById("datepicker_display").style.display = "block";  


}


function datepicker_show2() {

	   document.getElementById("datepicker_display2").style.display = "block";  


}

			var res_data='';


function search() {
	
	
	
	
		    var sub_date = $( "#signa_datepicker" ).datepicker( "getDate" );
 sub_date = sub_date.getFullYear() + "-"+('0' + (sub_date.getMonth()+1)).slice(-2)+"-"+('0' + sub_date.getDate()).slice(-2);

 	    var sub_date2 = $( "#signa_datepicker2" ).datepicker( "getDate" );
 sub_date2 = sub_date2.getFullYear() + "-"+('0' + (sub_date2.getMonth()+1)).slice(-2)+"-"+('0' + sub_date2.getDate()).slice(-2);

	
	var brands = $('#brands').val();

	var model = $('#model').val();

	var yearfrom = $('#yearfrom').val();

		var yearto = $('#yearto').val();

			var typos = $('#typos').val();

			var fuel = $('#fuel').val();

			var seats = $('#seats').val();

			var sasman = $('#sasman').val();


			var hpfrom = $('#hpfrom').val();

			var hpto = $('#hpto').val();
			
			var litresfrom = $('#litresfrom').val();

			var litresto = $('#litresto').val();
						
						if ($('#gps').is(":checked"))
								var gps = 1;
							else
								var gps = 0;
			

							if ($('#isofix').is(":checked"))
								var isofix = 1;
							else
								var isofix = 0;

							

			var place = $('#place').val();
			


			$.ajax({
  type: 'POST',
  url: './search.php',
  data: { sub_date: sub_date, sub_date2: sub_date2, brands: brands, model: model, yearfrom: yearfrom, yearto: yearto, typos: typos, fuel: fuel, seats: seats, sasman: sasman, hpfrom: hpfrom, hpto: hpto, litresfrom: litresfrom, litresto: litresto, gps: gps, isofix: isofix, place: place  },
  beforeSend:function(){
	document.getElementById("loading").style.display = "block";
				$( "#results" ).html('');

  },
  success:function(data){

 res_data = data;
	  	document.getElementById("loading").style.display = "none";

		var i;
		for (i = 0; i<Object.keys(data).length; i++) {
			$( "#results" ).append('<div class="w3-card-4" style="display:inline-block; margin-right:25px; margin-bottom:25px; cursor:pointer;" onclick="rent('+i+')">     <img src="img/cars/'+data[i].id+'.png" style="width:100%">     <div class="w3-container w3-center">       <p style="font-size:16px;"><b>'+data[i].brand+' '+data[i].model+' `'+data[i].year+'</b></p>     </div>   </div>');

		}
	
	
	},
  error:function(){
	document.getElementById("loading").style.display = "none";

alert('Σφάλμα φόρτωσης.');

	}
});

	

	
						}
						
						function rent(more) {
							

$("#res_img").attr("src","img/cars/"+res_data[more].id+".png");

    $('#res_img').attr('name', more);
	
	

							$( "#res_brand" ).text(res_data[more].brand);
							$( "#res_model" ).text(res_data[more].model);
							$( "#res_year" ).text('20'+res_data[more].year);
							$( "#res_fuel" ).text(fuel_txt[res_data[more].fuel - 1]);
							$( "#res_seats" ).text(res_data[more].seats);
							$( "#res_transmission" ).text(sasman_txt[res_data[more].transmission]);
							$( "#res_gps" ).text(gps_txt[res_data[more].gps]);
							$( "#res_isofix" ).text(isofix_txt[res_data[more].isofix]);
							$( "#res_hp" ).text(res_data[more].hp+'hp');
							$( "#res_litres" ).text(res_data[more].litres+'cc');
							$( "#res_type" ).text(typos_txt[res_data[more].type - 1]);
							$( "#res_place" ).text(place_txt[res_data[more].place - 1]);



$("#rent").css("display", "block");

							
						}
						
						function submit_rent() {
							
									    var sub_date = $( "#signa_datepicker" ).datepicker( "getDate" );
 sub_date = sub_date.getFullYear() + "-"+('0' + (sub_date.getMonth()+1)).slice(-2)+"-"+('0' + sub_date.getDate()).slice(-2);

 	    var sub_date2 = $( "#signa_datepicker2" ).datepicker( "getDate" );
 sub_date2 = sub_date2.getFullYear() + "-"+('0' + (sub_date2.getMonth()+1)).slice(-2)+"-"+('0' + sub_date2.getDate()).slice(-2);

						    var sub_carid = res_data[$('#res_img').attr('name')].id;
	
		var onomate = $('#onomate').val();
	var ident = $('#ident').val();
	var age = $('#age').val();
	var balance = $('#balance').val();


				$.ajax({
  type: 'POST',
  url: './rent_db.php',
  data: { sub_date: sub_date, sub_date2: sub_date2, onomate: onomate, ident: ident, age: age, balance: balance, sub_carid: sub_carid },
  beforeSend:function(){
	document.getElementById("loading").style.display = "block";

  },
  success:function(data){


  document.getElementById("loading").style.display = "none";

if (data == "1") {

window.location = "./home.php";
	
}else {
	alert('Σφάλμα φόρτωσης.');

}
  
	
	},
  error:function(){
	document.getElementById("loading").style.display = "none";

alert('Σφάλμα φόρτωσης.');

	}
});

						}

</script>


<img id="loading" src="./img/loading.gif" style="display:none; width:112px; position:fixed; bottom:1px; right:1px; z-index:3;" />



ΗΜΕΡΟΜΗΝΙΑ ΑΠΟ:  <input type="text" id="signa" size="30" style="vertical-align: middle;" disabled>&nbsp;<img src="img/calendar.png"  onclick="datepicker_show()" style="width:32px;vertical-align: middle;cursor:pointer;" />

<div id="datepicker_display" style="display:none; z-index:1; position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:rgba(54, 37, 37, 0.38);">
<div id="signa_datepicker" style="position:fixed; border-radius: 4px; top:150px; left:50%; margin-left:-152px; background: #FFFFFF; padding: 12px; "></div>
</div>
</div>

<div style="display:inline-block; font-family:Helvetica, sans-serif; text-align:center;">

ΕΩΣ:  <input type="text" id="signa2" size="30" style="vertical-align: middle;" disabled>&nbsp;<img src="img/calendar.png"  onclick="datepicker_show2()" style="width:32px;vertical-align: middle;cursor:pointer;" />

<div id="datepicker_display2" style="display:none; z-index:1; position:fixed; top:0px; left:0px; width:100%; height:100%; background-color:rgba(54, 37, 37, 0.38);">
<div id="signa_datepicker2" style="position:fixed; border-radius: 4px; top:150px; left:50%; margin-left:-152px; background: #FFFFFF; padding: 12px; "></div>
</div>
</div>

<br><br>

Μάρκα: 
<select id="brands" class="" name="brands" multiple>
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

Μοντέλο: <input type="text" id="model" name="model" size="25">

Χρονολογία απο <input type="number" id="yearfrom" name="yearfrom" size="10"  min="0" max="99">

Χρονολογία μέχρι <input type="number" id="yearto" name="yearto" size="10"  min="0" max="99">


  Τύπος Οχήματος: <select id="typos" name="typos" multiple>
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

Καύσιμο: <select id="fuel" class="" name="fuel" multiple>
  <optgroup label="Καύσιμο">

<option value="1">Βενζίνη</option>
<option value="2">Πετρέλαιο</option>
<option value="3">Αέριο LPG</option>
</optgroup>
</select>



Θέσεις: 
<select name="seats" id="seats" multiple>
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

				
				 Σασμάν: <select id="sasman" name="sasman" multiple>
  <optgroup label="Σασμάν">
    <option value="0">Αυτόματο</option>
	<option value="1">Xειροκίνητο</option>
    
  </optgroup>
  
</select>


<br><br>


 Ίπποι απο: <input type="text" id="hpfrom" name="hpfrom" size="10">

 Ίπποι μέχρι: <input type="text" id="hpto" name="hpto" size="10">


  Κυβικά απο: <input type="text" id="litresfrom" name="litresfrom" size="10">
				
				  Κυβικά μέχρι: <input type="text" id="litresto" name="litresto" size="10">

			<br><br>


GPS: <input id="gps" name="gps" type="checkbox">			
		Isofix: <input id="isofix" name="isofix" type="checkbox">			
		Περιοχή: <select id="place" name="place" multiple>
  <optgroup label="Περιοχή">
    <option value="1">Θεσσαλονίκη, Κέντρο</option>
    
  </optgroup>
  
</select>

<button id="search" name="search" onclick="search();">Αναζήτηση</button>
<br><br><br>



<div id="results" style="text-align:center;">



  
</div>


<div id="rent" style="position:fixed;width:382px;top:50%;left:50%; height:580px; margin-left:-191px;margin-top:-290px; background-color:white; -webkit-box-shadow: 2px 3px 15px -3px rgba(0,0,0,0.75);
-moz-box-shadow: 2px 3px 15px -3px rgba(0,0,0,0.75);
box-shadow: 2px 3px 15px -3px rgba(0,0,0,0.75); padding:10px; display:none;">
			<div style="position:fixed;left: calc(50% + 155px); top: calc(50% - 310px);font-size:36px; cursor:pointer; -webkit-touch-callout: none; 
    -webkit-user-select: none; 
     -khtml-user-select: none; 
       -moz-user-select: none; 
        -ms-user-select: none; 
            user-select: none; padding-left:12px; padding-right:12px; background-color:white; box-shadow: 2px 3px 15px -3px rgba(0,0,0,0.1); border-radius:50%;" onclick='document.getElementById("rent").style.display = "none";'>&#x2715;</div>
<center>
<img src="" id="res_img" name="" style="width:100%">
</center>
<div style="height:130px; overflow:auto;">
brand: <span id="res_brand"></span><br>
model:  <span id="res_model"></span><br>
year:  <span id="res_year"></span><br>
fuel:  <span id="res_fuel"></span><br>
seats:  <span id="res_seats"></span><br>
transmission:  <span id="res_transmission"></span><br>
gps:  <span id="res_gps"></span><br>
isofix:  <span id="res_isofix"></span><br>
hp:  <span id="res_hp"></span><br>
litres:  <span id="res_litres"></span><br>
type:  <span id="res_type"></span><br>
place:  <span id="res_place"></span><br>



</div>
<hr>
Ον/μο: <input type="text" id="onomate" name="onomate" size="25" required><br>
Ταυτότητα: <input type="text" id="ident" name="ident" size="25" required><br>
Ηλικία: <input type="text" id="age" name="age" size="10" required>
Αξία: <input type="text" id="balance" name="balance" size="10" required><br>
<button onclick="submit_rent();">ΟΛΟΚΛΗΡΩΣΗ</button>



</div>

<html>