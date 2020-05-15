<?php 
#start or resume session
include('assets/handlers/common.php');

$args = isset($_GET['base']) ? $_GET['base'] : "";
#Had to change whole website to use tokens for data transfer ##unsecure however Setting cookies were dissapearing
#Url used for passing things into files is under "<URL/BASE(PAGE NAME )/RETURN TOKEN>"

unset($json);
$args2 = explode('/', rtrim($args, '/'));
$base = array_shift($args2);
$token = array_shift($args2);
if(isset($token)){
	$fix = base64decodeURL($token);
	$json = json_decode($fix, true);
}
#if token is expired end session

		switch($base) {
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