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
 ?>
 
Tere, <?= $_SESSION['logged_in_user_email']; ?> 
<a href="?logout=1">Logi välja</a>
   