<?php

//loome AB ühenduse
   require_once("../config_global.php");
   $database = "if15_merit26_1";
  //paneme tööle sessiooni
   session_start();
function logInUser($email, $hash){
           // GLOBALS saab kätte kõik muutujad
		   
		   $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
		   
		   $stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
			
			//küsimärkide asendus s s on string string
			$stmt->bind_param("ss", $email, $hash);
			//ab tulnud muutujad
                $stmt->bind_result($id_from_db, $email_from_db);
                $stmt->execute();
                
                // teeb päringu ja kui on tõene (st et ab oli see väärtus)
                if($stmt->fetch()){
                    
                    // Kasutaja email ja parool õiged
                    echo "Kasutaja logis sisse id=".$id_from_db;
					 // sessioon, salvestatakse serveris
                  $_SESSION['logged_in_user_id'] = $id_from_db;
				  $_SESSION['logged_in_user_email'] = $email_from_db;
					// suuname kasutaja teisele lehele
					header("Location: data.php");  
					
                }else{
                    echo "Wrong credentials!";
			    }
				
			$stmt->close();
			$mysqli->close();
		}	

     function createUser($create_email, $hash){
                 $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["server_username"], $GLOBALS["server_password"], $GLOBALS["database"]);
	// salvestan andmebaasi
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES(?,?))");
				//kirjutan välja error
                //echo $stmt->error;
                //echo $mysqli->error;
				
				// paneme muutujad küsimärkide asemele ss - string, iga muutuja kohta 1 täht
				$stmt->bind_param("ss", $create_email, $hash);
				
				// käivitab sisestuse
				$stmt->execute();
				$stmt->close();
				
				$mysqli->close();
   }
?>