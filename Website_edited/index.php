<?php 
#start or resume session
include('assets/handlers/common.php');
#if token is expired end session
	$getbase = isset($_GET['base']) ? $_GET['base'] : "";

		switch($getbase) {
			#case NULL:
			#case "admin":
				#include("assets/template/header.php");
				#include("ss_administrator/login.php");
			case "register":
				include("assets/template/header.php");
				include("assets/includes/register.php");
				include("assets/template/footer.php");
				break;
			case "schedule":
				include("assets/template/header.php");
				include("assets/includes/schedule.php");
				include("assets/template/footer.php");
				break;
			case "login":
				include("assets/template/header.php");
				include("assets/includes/main.php");
				include("assets/template/footer.php");
				break;
			default:
				#header('Location: ./index.php?base=login');
				include("assets/template/header.php");
				include("assets/includes/main.php");
				include("assets/template/footer.php");
				break;
		}
?>