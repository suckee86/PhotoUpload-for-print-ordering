<html>
	<head>
    <title>Best Duo Fotó - Online képkidolgozás</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.min.css">
    <style>
        /*img {
            position: relative;
            width: auto;
            height: 5%;
        }*/
		@media screen and (min-width: 600px) {
			#darab{
				max-width: 30px;
				height: auto;
			}
		}

		body {
            background-image: url("bgimg.jpg");
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-position: cover; 
        }
        span{
            text-shadow: 1px 1px #000000;
        }
		table, td, tr {
			color: white;
		}

		select{
			min-width: 75px;
		}
	</style>
	</head>
<body>
	<script>
		function darabmind(){
			var db = document.getElementById("dbmind").value;
			var x = document.getElementsByClassName('mydb');
			for(i = 0; i < x.length; i++) {
  				x[i].value = db;
			}
		}

		function meretmindre(){
			var m = document.getElementById("mindmeret").value;
			var x = document.getElementsByClassName('mymeret');
			for(i = 0; i < x.length; i++) {
  				x[i].value = m;
			}
		}
	</script>	
<?php
session_start();
if (isset($_POST["e-mail"])){
	$email = '';
	$simamail = $_POST["e-mail"];
	$_SESSION["email"] = $simamail;
	$email = $_POST["e-mail"] . date("Y-m-d");
} else {
	$email = '';
	$email = $_SESSION["email"] . date("Y-m-d");
}

$target_dir = "uploads/$email/";
if(!is_dir($target_dir)){
    mkdir($target_dir);
}
$valid_formats = array("jpg", "png", "gif", "zip", "bmp");
$max_file_size = 4092*1024;
$path = "uploads/$email/"; // Upload directory
$count = 0;

if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
	// Loop $_FILES to exeicute all files
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 4) {
	        continue; // Skip file if any error found
	    }	       
	    if ($_FILES['files']['error'][$f] == 0) {	           
	        if ($_FILES['files']['size'][$f] > $max_file_size) {
	            $message[] = "$name mérete túl nagy!.";
	            continue; // Skip large files
	        }
			elseif( ! in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_formats) ){
				$message[] = "$name nem érvényes kép";
				continue; // Skip invalid file formats
			}
	        else{ // No error found! Move uploaded files 
	            if(move_uploaded_file($_FILES["files"]["tmp_name"][$f], $path.$name))
	            $count++; // Number of successfully uploaded file
	        }
	    }
	}
}
$images = glob($path."*");
echo '<div class="w3-mobile w3-display-topmiddle w3-half w3-card-4 w3-margin-bottom w3-animate-zoom w3-text-white" style="max-width:1000px">
	  <br><span align="center">Kérjük állítsa be a mennyiségre és a méretekre vonatkozó értékeket.</span><br><br>
	  <span align="center">Beállíthatja egységesre a mennyiségeket és a méreteket az alábbi eszközök segítségével:</span><br><br>
	  <div class="w3-half">
		  <span>Mennyiség:</span><input type="text" class="w3-mobile" id="dbmind" style="width:15%">
		  <button type="button" class="w3-button w3-pale-blue w3-small w3-padding-small" style="vertical-align:middle" onclick="darabmind()">Mindegyikre</button>
	  </div>
	  <div class="w3-half">
	  <span>Méret:</span>
	  <select class="w3-mobile" id="mindmeret" name="meretmind">
	  <option value="9x13">9x13</option>
	  <option value="10x15">10x15</option>
	  <option value="13x18">13x18</option>
	  <option value="15x21">15x21</option>
	  <option value="18x24">18x24</option>
	  <option value="20x30">20x30</option>
	  <option value="30x40">30x40</option>
	  <option value="30x45">30x45</option>
	</select>
	  <button type="button" class="w3-button w3-pale-blue w3-small w3-padding-small" style="vertical-align:middle" onclick="meretmindre()">Mindegyikre</button>
  </div>
  <br><br><br>
	<hr class="w3-hide-small">	  
  <form action="rendel.php" class="w3-container w3-text-white" style="width:100%" method="post" enctype="multipart/form-data">';
foreach($images as $image) {
	echo '<div class="w3-container w3-center w3-mobile">
		  <img class="w3-image w3-center w3-mobile" width="400" height="200" src="'.$image.'" /><br>
		  <span>Mennyiség: </span><input type="text" id="darab" class="mydb w3-mobile" name="db[]" placeholder="db" required>
		  <span>Méret: </span>
		  <select class="mymeret w3-mobile" name="meret[]">
		  	<option value="9x13">9x13</option>
		  	<option value="10x15">10x15</option>
		  	<option value="13x18">13x18</option>
		  	<option value="15x21">15x21</option>
		  	<option value="18x24">18x24</option>
		  	<option value="20x30">20x30</option>
		  	<option value="30x40">30x40</option>
		  	<option value="30x45">30x45</option>
		</select>
		<p><a href="delete.php?file=' . $image . '"><i class="fa fa-trash"></i></a></p>
		<input type="hidden" id="neve" name="neve[]" value="'.$image.'">
		  <br><br><br></div>';
}
echo '<br><span>Kérjük töltse ki a megrendeléshez szükséges további adatokat:</span><br><br>
      <span>Megrendelő teljes neve:</span><br>
      <input type="text" style="width:100%" name="ufneve" required><br><br>
      <span>Telefonszám:</span><br>
      <input type="text" style="width:100%" name="uftelefon" required><br><br>
      <span>E-mail cím:</span>
      <input type="text" style="width:100%" name="ufemail" value="' . $simamail . '"><br><br>
      <span>Megjegyzés:</span>
      <input type="text" style="width:100%" name="ufmegjegy"><br><br>
';
echo '<input type="submit" class="w3-button w3-section w3-pale-blue w3-ripple" name="elkuld" value="Megrendelés">';
echo '</form>';


?>
</body>
<html>