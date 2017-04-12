<?php 

if(basename($_SERVER["PHP_SELF"]) == "header.php") {
	die("403 - Access Forbidden");
} else {
	session_start();
		# Get Database Information
		require_once("../assets/config/database.php");
		
		#Check if account exists already
			#if so return error
		#Else create account
		
		
		
		# Define $getbase variable
		$getbase = isset($_GET['base']) ? $_GET['base'] : "";
		$getslug = $mysqli->query("SELECT slug, title, visible from ".$prefix."pages");
		while($fetchslug = $getslug->fetch_assoc()) {
			$slugs[] = $fetchslug['slug'];
			$slugarray[] = array($fetchslug['slug'], $fetchslug['title'], $fetchslug['visible']);
		}

		#Check if Account Exists
		
		#Else, Copy user Data + Hashed Password
		
		#Copy Schedule Data
		
		#return true
	$mysqli->close();
}
?>