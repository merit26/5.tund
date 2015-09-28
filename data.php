<?php
   // kõik mis seotud andmetabeliga, lisamine ja tabeli kujul esitamine
   require_once("functions.php");
   // kui kasutaja on sisse logitud, suuname teisele lehele
   // kontrolin, kas sessioonimuutja on olemas
   if(!isset($_SESSION['logged_in_user_id'])){
	   header("Location: login.php");
   }
   
   if(isset($_GET["logout"])){
	   
	   session_destroy();
	   header("Location: login.php");
   }
   
   // muutujad väärtustega
   $car_plate=$color=$m="";
   $car_plate_error=$color_error="";
   
   // valideerida väljad
   if($_SERVER["REQUEST_METHOD"] == "POST") {
   if(isset($_POST["add_car_plate"])){

			if( empty($_POST["car_plate"]) ) {
				$car_plate_error = "See väli on kohustuslik";
			}else{
        // puhastame muutuja võimalikest üleliigsetest sümbolitest
				$car_plate = cleanInput($_POST["car_plate"]);
			}

			if ( empty($_POST["color"]) ) {
				$color_error = "See väli on kohustuslik";
			}else{
				$color = cleanInput($_POST["color"]);
			}
			
			// kui erroreid ei ole käivitan funktsioon mis sisestab andmebaasi
			
			
			if(	$car_plate_error == "" && $color_error == "")
			
			{
				$m = createCarPlate($car_plate, $color);
			if($m !=""){
				$car_plate = "";
				$color ="";
				
			}
			}
		}
}				
				// nimed ei ole olulised võib olla ka plates
				
 
   function cleanInput($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  }
  
  //küsime tabeli kujul andmed
  getALLData();
  
 ?>
 
Tere, <?= $_SESSION['logged_in_user_email']; ?> 
<a href="?logout=1">Log out</a>
   
<h2>Log in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" >
     <label > Auto nr </label>
  	<input id="car_plate" name="car_plate" type="text" value="<?=$car_plate;?>"> <?=$car_plate_error;?><br><br>
  	 <label > Värv </label>
	<input name="color" type="text" value="<?=$color;?>"> <?=$color_error;?><br><br>
  	<input type="submit" name="add_car_plate" value="Lisa">
	<p style="color:green;"><?=$m;?><?p>
  </form>
   