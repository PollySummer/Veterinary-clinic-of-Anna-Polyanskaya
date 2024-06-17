<?php

session_start();

if(isset($_SESSION['animalowner'])){
	unset($_SESSION['animalowner']);

	header("Location: ../index.php");
}

?>