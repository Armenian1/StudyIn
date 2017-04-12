<?php 
#start or resume session
session_start();
include('common.php');
#if token is expired end session
	if ($_SESSION['exp_token'] == 
		
		# Define $getbase variable
		$getbase = isset($_GET['base']) ? $_GET['base'] : "";

		switch($getbase) {
			case NULL:
			case "admin":
				include("assets/template/header.php");
				include("ss_administrator/login.php");
			case "register":
				include("assets/template/header.php");
				include("assets/includes/register.php");
				include("assets/template/header.php");
			default:
				include("assets/template/header.php");
				include("assets/includes/login.php");
				include("assets/template/header.php");
				break;
		}
$mysqli->close();
?>