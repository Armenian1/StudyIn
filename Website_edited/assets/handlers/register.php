<?php
require_once '/../handlers/funcs.php';

$name;
$password;

#if these values are not null
if (isset($_POST['name']) && isset($_POST['password'])) {
	$_SESSION['name'] = $_POST['name'];
	$_SESSION['password'] = $_POST['password'];
	$_SESSION['password2'] = $_POST['password2'];
	$_SESSION['birthday'] = $_POST['birthday'];
	$_SESSION['email'] = $_POST['email'];	
}

if (isset($_SESSION['name'])) {
	header('Location: studyin.php');
	# check if empty string is "false-y"
} else if ($name && $password) {
	$accounts = file('users.txt');
	checkProperInput($name, $password);
	$head = base64_encode(
	'{
		"alg": "HS256",
		"typ": "JWT"
	}');
	
	$claim = base64_encode(sprintf('{
		"token_type":"Bearer",
		"name": "$1",
		"birthday": "0000-00-00"
		"email": "$2"
		"ip": "$3"
	}'$_SESSION['name'],$_SESSION['email'] ,getRealIpAddr()));
	
	$payload = $head + "." $claim;
	
	redirect(/ss_administrator/index.php?request=user/$payload)
} else {
	die('Invalid input - username or password not set: $name = ' . $name . ', $password = ' . $password);
}

# Kills the page if provided improper input, else gives detailed description of what went wrong
function checkProperInput($name, $password) {
	# check if username is alphanumeric, lowercase, and 3-20 characters long
	if (preg_match('/^[a-z0-9]{3,20}$/', $name) == 0 ||
		# check if password begins with number, ends with special char, and is 6-12 chars long
		# ^ ignore that, just check if the password is 3-20 chars long, otherwise it's all fair game.
		// preg_match('/^[0-9].{4,10}[^a-z0-9]$/i', $password) == 0) {
		preg_match('/^.{3,20}$/i', $password) == 0) {
		die('Invalid input - username or password does not match specifications. You entered: "'
			. $name . ':' . $password . '" What we got from that was: "'
			. preg_match('/^[a-z0-9]{3,8}$/', $name) . ':'
			. preg_match('/^[0-9].{4,10}[^a-z0-9]$/i', $password)
			. '" (1:1 would have passed)');
	}
}

# Sets a cookie touch(filename) store the exact time of a succesful login
function setDate() {
	date_default_timezone_set('America/Los_Angeles');
	$date = date("D y M d, g:i:s a");
	# set expire time to one week
	$expireTime = time() + 60*60*24*7;
	setcookie('date', $date, $expireTime);
}
?>