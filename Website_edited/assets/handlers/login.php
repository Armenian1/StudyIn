<?php
#	Intermediary page which logs the user in if provided existing account info,
#	returns the user to the starting page if provided a known username and
#	incorrect password, or creates a new account for the user if provided entirely
#	new information.
session_start();
include('/common.php');
ensureLoggedOut();

#go to parent directory
$api_url = "../../ss_administrator/"

#if these values are not null
if (isset($_POST['name']) && isset($_POST['password'])) {
$client_id = $_POST['name'];
$client_secret = sha1($_POST['password']);

$content = array('http' = > array (
			'header' = >"Authorization: Basic " . base64_encode("$client_id:$client_secret")
			'method' => 'GET'
			'content' = > http_build_query($data)
)
);
#Saving temp data 'header' = > "Content-type: application/x-www-form-unlencoded\r\n",

#USE 'header' = > "Content-type: user/"

$context = stream_context_create($content);

$result = file_get_contents($api_url, false, $context);
if($result == FALSE){ // ERROR HANDLE
	die('Invalid input - username or password not set: $name = ' . $name . ', $password = ' . $password);
}

$json = base64_decode($result);

#Otherwise save results to cookie
setcookie('tToken',$json['tToken'],time()+$json['exptToken']);
setcookie('rToken',$json['rToken'],time()+$json['exprToken']);
#redirect
header('Location: index.php?base=schedule');

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