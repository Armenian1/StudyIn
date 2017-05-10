<?php
require_once '/../handlers/funcs.php';

$name;
$password;
#go to parent directory
$api_key = '5425ff73-a599-4751-8759-7e170e730717';

if (isset($_POST['name'])) {
	header('Location: index.php');
	# check if empty string is "false-y"
} else if ($name && $password) {
	#$accounts = file('users.txt');
	checkProperInput($name, $password);
	$head = base64_encode(json_encode(array('alg' => 'HS256', 'typ' => 'JWT')));
	
	$claim = base64_encode(json_encode(array(
		'request' => 'register',
		'name' => $_POST['name'],
		'sha1' = > sha1($_POST['password']),
		'email' => $_POST['email'],
		'birthday' = > $_POST['birthday'])));
	
	$payload = $head + "." $claim;
	
	#redirect(/ss_administrator/index.php?request=user/$payload)
	$result = file_get_contents('/ss_administrator/index.php?request='.$api_key.'/user/'.$payload);
	if(isset($result['ttoken'])){
		#set cookie and redirect
		setcookie('tToken',$result['tToken'],time()+$result['exptToken']);
		header('Location: index.php?base=schedule');
	}
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