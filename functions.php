<?php

//loome AB �henduse
   require_once("../config_global.php");
   $database = "if15_merit26_1";
  

function logInUser($email, $hash){
           // muutuja v�ljaspool funktsiooni
		   
		   $mysqli = new mysqli($GLOBALS["servername"], $GLOBALS["username"], $GLOBALS["password"], $GLOBALS["database"]);
		   
		   $stmt = $mysqli->prepare("SELECT id, email FROM user_sample WHERE email=? AND password=?");
			
			//k�sim�rkide asendus s s on string string
			$stmt->bind_param("ss", $email, $hash);
			//ab tulnud muutujad
                $stmt->bind_result($id_from_db, $email_from_db);
                $stmt->execute();
                
                // teeb p�ringu ja kui on t�ene (st et ab oli see v��rtus)
                if($stmt->fetch()){
                    
                    // Kasutaja email ja parool �iged
                    echo "Kasutaja logis sisse id=".$id_from_db;
                    
                }else{
                    echo "Wrong credentials!";
			    }
				
			$stmt->close();
		}	

  function createUser($create_email, $hash){

	// salvestan andmebaasi
				$stmt = $mysqli->prepare("INSERT INTO user_sample (email, password) VALUES(?,?))");
				//kirjutan v�lja error
                //echo $stmt->error;
                //echo $mysqli->error;
				
				// paneme muutujad k�sim�rkide asemele ss - string, iga muutuja kohta 1 t�ht
				$stmt->bind_param("ss", $create_email, $hash);
				
				// k�ivitab sisestuse
				$stmt->execute();
				$stmt->close();
				$mysqli->close();
   }
?>